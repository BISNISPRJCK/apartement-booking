<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\RoomCategoryController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TestimonialController;

Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);

Route::get('/room-categories', [RoomCategoryController::class, 'index']);

//User

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 🔥 WEBHOOK (HARUS DI SINI - TANPA AUTH)
Route::post('/midtrans/callback', [BookingController::class, 'handleCallback']);

Route::middleware('auth:sanctum')->group(function () {

  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/profile', [ProfileController::class, 'getProfile']);
  Route::post('/profile', [ProfileController::class, 'updateProfile']);


  // Booking with tokens

  Route::post('/bookings', [BookingController::class, 'AddBooking']);
  Route::post('/testimonials', [TestimonialController::class, 'store']);
});

// Booking


// testimonial
Route::get('/rooms/{id}/testimonials', [TestimonialController::class, 'getByRoom']);


Route::get('/test-midtrans', function () {

  \Midtrans\Config::$serverKey = "PASTE_SERVER_KEY_KAMU_DISINI";
  \Midtrans\Config::$isProduction = false;

  $params = [
    'transaction_details' => [
      'order_id' => 'TEST-' . time(),
      'gross_amount' => 10000,
    ],
  ];

  try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    return response()->json([
      'snap_token' => $snapToken
    ]);
  } catch (\Exception $e) {
    return response()->json([
      'error' => $e->getMessage()
    ]);
  }
});
