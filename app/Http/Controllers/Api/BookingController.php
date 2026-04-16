<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Illuminate\Support\Str;


use function Symfony\Component\Clock\now;

class BookingController extends Controller
{
    // public function AddBooking(Request $request)
    // {

    //     $request->validate([
    //         'room_id' => 'required',
    //         'check_in' => 'required|date',
    //         'check_out' => 'required|date|after:check_in'
    //     ]);

    //     $user = Auth::user();

    //     // cek profile lengkap
    //     if (!$user->phone || !$user->address || !$user->ktp_photo) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'lengkapi profil terlebih dahulu'
    //         ], 400);
    //     }

    //     $room = Room::findOrFail($request->room_id);

    //     // cek status room 
    //     if ($room->status !== 'available') {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'kamar tidak tersedia'
    //         ], 400);
    //     }
    //     $checkIn = Carbon::parse($request->check_in);
    //     $checkOut = Carbon::parse($request->check_out);

    //     $days = $checkIn->diffInDays($checkOut);

    //     if ($days < 1) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Minimal booking 1 hari'
    //         ]);
    //     }

    //     $existingBooking = Booking::where('room_id', $request->room_id)
    //         ->where(function ($query) use ($request) {
    //             $query->where('check_in', '<', $request->check_out)
    //                 ->where('check_out', '>', $request->check_in);
    //         })
    //         ->where('status', '!=', 'cancelled')
    //         ->exists();

    //     if ($existingBooking) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Ruangan sudah terisi untuk selected date'
    //         ], 400);
    //     }

    //     $totalPrice = $days * $room->price;
    //     $externalId = 'BOOK-' . Str::uuid();
    //     DB::beginTransaction();


    //     try {
    //         $booking = Booking::create([
    //             'user_id' => Auth::id(),
    //             'room_id' => $request->room_id,
    //             'check_in' => $request->check_in,
    //             'check_out' => $request->check_out,
    //             'total_price' => $totalPrice,
    //             'status' => 'pending',
    //             'payment_status' => 'pending',
    //             'order_id' => $externalId
    //         ]);

    //         Configuration::setXenditKey(config('xendit.api_key'));
    //         $apiInstance = new InvoiceApi();



    //         $params = [
    //             'external_id' => $externalId,
    //             'amount' => (int) $totalPrice,
    //             'payer_email' => Auth::user()->email ?? 'guest@gmail.com',
    //             'description' => 'Booking Apartement Room #' . $room->room_number,
    //             'expiry_date' => Carbon::now()->addHours(24)->toIso8601String(),



    //         ];

    //         // CREATE INVOICE

    //         $invoice = $apiInstance->createInvoice($params);

    //         //update booking

    //         $booking->update([
    //             'payment_url' => $invoice['invoice_url']
    //         ]);

    //         DB::commit();


    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Booking berhasil lanjut pembayaran',
    //             'data' => $booking,
    //             'payment_url' => $invoice['invoice_url']
    //         ]);
    //     } catch (\Exception $e) {

    //         // 🔥 LOG ERROR BIAR KELIHATAN
    //         Log::error('XENDIT ERROR: ' . $e->getMessage());

    //         // tetap return booking walaupun payment gagal
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Booking berhasil tapi payment error',
    //             'booking' => $booking,
    //             'error_midtrans' => $e->getMessage()
    //         ]);
    //     }
    // }

    // public function xenditCallback(Request $request)
    // {
    //     Log::info('XENDIT CALLBACK:', $request->all());

    //     $externalId = $request->external_id;

    //     LOG::info('EXTERNAL ID DARI XENDIT', [
    //         'external_id' => $externalId
    //     ]);
    //     $status = $request->status;

    //     $booking = Booking::where('order_id', $externalId)->first();

    //     if (!$booking) {
    //         Log::error('BOOKING TIDAK DITEMUKAN', [
    //             'external_id' => $externalId
    //         ]);

    //         return response()->json(['message' => 'Booking not found'], 404);
    //     }

    //     LOG::info('BOOKING DITEMUKAN', [
    //         'id' => $booking->id,
    //         'order_id' => $booking->order_id
    //     ]);

    //     // kalau ada booking 

    //     if ($request->status == 'PAID') {
    //         $booking->update([
    //             'status' => 'approved',
    //             'payment_status' => 'paid',
    //         ]);
    //     }

    //     return response()->json(['message' => 'OK']);
    // }

    public function createBooking(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in'
        ]);


        // wajib login
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Harus Login terlebih dahulu',
            ], 401);
        }

        $user = Auth::user();

        // cek user sudah punya booking belum selesai

        $existingUserBooking = Booking::where('user_id', $user->id)
            ->whereIn('status', ['pending'])
            ->first();

        if ($existingUserBooking) {
            return response()->json([
                'message' => 'anda masi memiliki booking yang belum selesai',
                'booking' => $existingUserBooking
            ], 400);
        }

        $room = Room::findOrFail($request->room_id);
        $days = Carbon::parse($request->check_in)->diffInDays(Carbon::parse($request->check_out));
        if ($days < 1) {
            return response()->json([
                'message' => 'Minimal booking 1 hari'
            ], 400);
        }

        // cek double booking 

        $existingBooking = Booking::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->where('check_in', '<', $request->check_out)
                    ->where('check_out', '>', $request->check_in);
            })->whereIn('status', ['pending', 'approved'])->exists();

        if ($existingBooking) {
            return response()->json([
                'message' => 'Kamar sudah dibooking pada tanggal tersebut'
            ], 400);
        }
        $total = $days * $room->price;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_price' => $total,
            'status' => 'pending',
            'payment_status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Booking dibuat',
            'booking' => $booking
        ]);
    }

    public function fillCustomerData(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required'
        ]);

        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $booking->update([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'payment_status' => 'waiting_payment'
        ]);

        return response()->json([
            'message' => 'Data berhasil disimpan',
            'booking' => $booking
        ]);
    }


    public function choosePayment(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:transfer, qris'
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update([
            'payment_method' => $request->payment_method
        ]);


        return response()->json([
            'message' => 'Metode pembayaran dipilih',
            'payment_info' => [
                'method' => $request->payment_method,
                'bank' => 'BCA',
                'account_number' => '1234567890',
                'qris' => 'QRIS_IMAGE_URL',
                'total' => $booking->total_price
            ]
        ]);
    }

    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image'
        ]);

        $booking = Booking::findOrFail($id);

        $path = $request->file('payment_proof')->store('payments', 'public');

        $booking->update([
            'payment_proof' => $path,
            'payment_status' => 'waiting_confirmation'
        ]);

        return response()->json([
            'message' => 'pembayaran berhasil dikirim'
        ]);
    }


    public function myBookings(Request $request)
    {
        $user = $request->user();

        $data = Booking::with('room')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }


    public function getAllBookings()
    {
        $data = Booking::with(['user', 'room'])
            ->latest()
            ->get();


        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }


    public function approveBooking($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan'
            ], 404);
        }

        if ($booking->status === 'approved') {
            return response()->json([
                'success' => false,
                'message' => 'Booking sudah di approve'
            ]);
        }

        $booking->update([
            'status' => 'approved',
            'payment_status' => 'paid'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil di approve',
            'data' => $booking
        ]);
    }

    public function cancelBooking($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan'
            ], 404);
        }

        $booking->update([
            'status' => 'cancelled'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibatalkan'
        ]);
    }
}
