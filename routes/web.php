<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Halaman Utama
Route::get('/', [PageController::class, 'home'])->name('home');

// Halaman Property
Route::get('/property', [PageController::class, 'property'])->name('property');

// Halaman Detail Property
Route::get('/property/{id}', [PageController::class, 'propertyDetail'])->name('property.detail');

// Halaman About
Route::get('/about', [PageController::class, 'about'])->name('about');

// Halaman Testimonials
Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');

// Halaman Contact
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Kirim Pesan Contact (POST)
Route::post('/contact/send', [PageController::class, 'sendMessage'])->name('contact.send');

// ============= AUTHENTICATION ROUTES with SLIDING EFFECT =============

// Auth Page (Single Page with Sliding Effect)
Route::get('/login', function () {
    return view('auth.index'); // Menggunakan file baru auth/index.blade.php
})->name('login');

Route::get('/register', function () {
    return view('auth.index'); // Menggunakan file yang sama
})->name('register');

// Login Submit (AJAX or Regular POST)
Route::post('/login', function (Request $request) {
    // Demo credentials (hardcoded)
    $demoUsers = [
        'user@vantixstay.com' => 'password123',
        'admin@vantixstay.com' => 'admin123',
        'test@vantixstay.com' => 'test123',
        'admin@vantix.com' => '123456', // Untuk demo sliding
    ];
    
    // Check if credentials match
    if (isset($demoUsers[$request->email]) && $demoUsers[$request->email] === $request->password) {
        // Store user in session
        Session::put('user', [
            'email' => $request->email,
            'name' => explode('@', $request->email)[0],
            'logged_in' => true
        ]);
        
        // Cek apakah request dari AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Login successful!',
                'redirect' => route('home')
            ]);
        }
        
        // Check if there's pending booking
        $pendingBooking = Session::get('pending_booking');
        if ($pendingBooking) {
            Session::forget('pending_booking');
            return redirect()->route('property')->with('success', 'Login successful! Please complete your booking.');
        }
        
        return redirect()->route('home')->with('success', 'Welcome back!');
    }
    
    // Login failed
    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid email or password. Try: admin@vantix.com / 123456'
        ], 401);
    }
    
    return back()->withErrors([
        'email' => 'Invalid email or password. Try: user@vantixstay.com / password123',
    ])->withInput();
})->name('login.submit');

// Register Submit (AJAX or Regular POST)
Route::post('/register', function (Request $request) {
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'required|string|min:4',
    ]);
    
    // Simpan user ke session (no database)
    $fullName = $request->first_name . ' ' . $request->last_name;
    Session::put('user', [
        'email' => $request->email,
        'name' => $fullName,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'logged_in' => true
    ]);
    
    // Cek apakah request dari AJAX
    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Account created successfully!',
            'redirect' => route('home')
        ]);
    }
    
    return redirect()->route('home')->with('success', 'Account created successfully! Welcome to Vantix Stay.');
    })->name('register.submit');

    // Logout Route
    Route::post('/logout', function () {
        Session::forget('user');
        Session::forget('pending_booking');
        
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully!',
                'redirect' => route('home')
            ]);
        }
        
        return redirect()->route('home')->with('success', 'You have been logged out.');
    })->name('logout');

    // ============= BOOKING ROUTES =============
    // Halaman Booking
    Route::get('/booking', [PageController::class, 'index'])->name('booking.index');

    // Proses Booking (POST)
    Route::post('/booking/store', [PageController::class, 'storeBooking'])->name('booking.store');

// user client
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    });

    Route::get('/user/profile', function () {
        return view('user.profile.index');
    });
    Route::get('/user/packages', function () {
        return view('user.packages.index');
    });
    Route::get('/user/riwayat', function () {
        return view('user.riwayat.index');
    });
// dashboard admin
    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', function () {
        return view('admin.dashboard');
        });

        Route::get('/profile', function () {
        return view('admin.profile.index');
        });

        Route::get('/booking', function () {
        return view('admin.booking.index');
        });

        Route::get('/invoice', function () {
        return view('admin.invoice.index');
        });

        Route::get('/users', function () {
        return view('admin.users.index');
        });

        /* CMS */
        Route::get('/cms/product', function () {
        return view('admin.cms.product');
        });

        Route::get('/cms/contact', function () {
        return view('admin.cms.contact');
        });

        Route::get('/cms/about', function () {
        return view('admin.cms.about');
        });

});
// dashboard super admin
    Route::get('/superadmin/dashboard', function () {
        return view('superadmin.dashboard');
    });