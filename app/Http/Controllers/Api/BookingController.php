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
        $externalId = 'BOOK-' . time();

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'pending',
            'order_id' => $externalId
        ]);

        try {
            Configuration::setXenditKey(config('xendit.api_key'));
            $apiInstance = new InvoiceApi();



            $params = [
                'external_id' => $externalId,
                'amount' => (int) $totalPrice,
                'payer_email' => Auth::user()->email ?? 'guest@gmail.com',
                'description' => 'Booking Aprtment',



            ];

            // CREATE INVOICE

            $invoice = $apiInstance->createInvoice($params);

            //update booking

            $booking->update([
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

    public function xenditCallback(Request $request)
    {
        Log::info('XENDIT CALLBACK:', $request->all());

        $externalId = $request->external_id;

        LOG::info('EXTERNAL ID DARI XENDIT', [
            'external_id' => $externalId
        ]);
        $status = $request->status;

        $booking = Booking::where('order_id', $externalId)->first();

        if (!$booking) {
            Log::error('BOOKING TIDAK DITEMUKAN', [
                'external_id' => $externalId
            ]);

            return response()->json(['message' => 'Booking not found'], 404);
        }

        LOG::info('BOOKING DITEMUKAN', [
            'id' => $booking->id,
            'order_id' => $booking->order_id
        ]);

        // kalau ada booking 

        if ($request->status == 'PAID') {
            $booking->update([
                'status' => 'approved',
                'payment_status' => 'paid',
            ]);
        }

        return response()->json(['message' => 'OK']);
    }
}
