<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;



class BookingController extends Controller
{
    public function AddBooking(Request $request)
    {

        $request->validate([
            'room_id' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in'
        ]);

        $room = Room::findOrFail($request->room_id);
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);

        $days = $checkIn->diffInDays($checkOut);

        if ($days < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Minimal booking 1 hari'
            ]);
        }

        $existingBooking = Booking::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                    ->orWhereBetween('check_out', [$request->check_in, $request->check_out]);
            })->exists();

        if ($existingBooking) {
            return response()->json([
                'success' => false,
                'message' => 'Ruangan sudah terisi untuk selected date'
            ], 400);
        }

        $totalPrice = $days * $room->price;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        try {
            Configuration::setXenditKey(config('xendit.api_key'));
            $apiInstance = new InvoiceApi();

            $externalId = 'BOOK-' . time();

            $params = [
                'external_id' => $externalId,
                'amount' => (int) $totalPrice,
                'payer_email' => Auth::user()->email ?? 'guest@gmail.com',
                'description' => 'Booking Aprtement',



            ];

            // CREATE INVOICE

            $invoice = $apiInstance->createInvoice($params);

            //update booking

            $booking->update([
                'order_id' => $externalId,
                'payment_url' => $invoice['invoice_url']
            ]);


            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil lanjut pembayaran',
                'data' => $booking,
                'payment_url' => $invoice['invoice_url']
            ]);
        } catch (\Exception $e) {

            // 🔥 LOG ERROR BIAR KELIHATAN
            Log::error('XENDIT ERROR: ' . $e->getMessage());

            // tetap return booking walaupun payment gagal
            return response()->json([
                'success' => false,
                'message' => 'Booking berhasil tapi payment error',
                'booking' => $booking,
                'error_midtrans' => $e->getMessage()
            ]);
        }
    }

    public function handleCallBack(Request $request)
    {
        $serverKey = config('midtarns.server.key');

        $hashed = hash(
            "sha512",
            $request->order_id .
                $request->status_code .
                $request->gross_amount .
                $serverKey
        );

        if ($hashed != $request->signature_key) {
            return response()->json(['message' => 'Invalid Signature'], 403);
        }

        $booking = Booking::where('order_id', $request->order_id)->first();

        if (!$booking) {
            return response()->json(['message' => 'Booking not found']);
        }

        if ($request->transaction_status == 'settlement') {
            $booking->update([
                'status' => 'approved',
                'payment_status' => 'paid'
            ]);
        } elseif ($request->transaction_status == 'pending') {
            $booking->update([
                'parment_status' => 'pending'
            ]);
        } elseif ($request->transaction_status == 'expire') {
            $booking->update([
                'status' => 'cancelled',
                'payment_status' => 'expired'
            ]);
        }

        return response()->json(['message' => 'Ok']);
    }
}
