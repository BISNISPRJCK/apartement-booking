<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Booking;


class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable',

        ]);

        $user = $request->user();

        $booking = Booking::where('id', $request->booking_id)
            ->where('user_id', $user->id)
            ->first();

        if (!$booking) {
            return response()->json([
                'message' => 'booking tidak ditemukan'
            ], 404);
        }

        // optional hanya boleh jika booking selesai

        if ($booking->status !== 'confirmed') {
            return response()->json([
                'message' => 'Belum Bisa Memberikan testimoni'
            ]);
        }

        // cek sudah pernah review atau belum
        $already = Testimonial::where('booking_id', $booking->id)->first();

        if ($already) {
            return response()->json([
                'message' => 'Anda sudah memberikan testimoni'
            ]);
        }

        $testimonial = Testimonial::create([
            'user_id' => $user->id,
            'room_id' => $booking->room_id,
            'booking_id' => $booking->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Testimonial berhasil ditambahkan',
            'data' => $testimonial
        ]);
    }

    public function getByRoom($room_id)
    {
        $data = Testimonial::with('user')
            ->where('room_id', $room_id)
            ->latest()
            ->get();

        return response()->json($data);
    }
}
