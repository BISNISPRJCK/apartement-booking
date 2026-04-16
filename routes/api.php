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
// Route::post('/xendit/callback', [BookingController::class, 'xenditCallback']);

Route::middleware('auth:sanctum')->group(function () {

  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/profile', [ProfileController::class, 'getProfile']);
  Route::post('/profile', [ProfileController::class, 'updateProfile']);


  // Booking with tokens

  // Route::post('/bookings', [BookingController::class, 'AddBooking']);
  Route::post('/booking', [BookingController::class, 'createBooking']);
  Route::post('/booking/{id}/customer', [BookingController::class, 'fillCustomerData']);
  Route::post('/booking/{id}/payment-method', [BookingController::class, 'choosePayment']);
  Route::post('/booking/{id}/upload', [BookingController::class, 'uploadPayment']);
  Route::post('/testimonials', [TestimonialController::class, 'store']);

  // Booking with user

  Route::get('/my-bookings', [BookingController::class, 'myBookings']);

  //Booking with Admin
  Route::get('/bookings', [BookingController::class, 'getAllBookings']);
  Route::get('/bookings/{id}/approve', [BookingController::class, 'approveBooking']);
  Route::get('/bookings/{id}/cancel', [BookingController::class, 'cancelBooking']);
});

// Booking


// testimonial
Route::get('/testimonials', [TestimonialController::class, 'getLatestTestimonials']);
Route::get('/rooms/{id}/testimonials', [TestimonialController::class, 'getByRoom']);
