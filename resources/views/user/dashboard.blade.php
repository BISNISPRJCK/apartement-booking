@extends('adminlte::page')

@section('title', 'Dashboard User')

@section('content_header')
    <h1 style="font-weight: 700; color: #ffd700;">✨ Dashboard User</h1>
@stop

@section('content')

<!-- Welcome Card -->
<div class="welcome-box mb-4">
    <div class="welcome-text">
        <h2>👋 Welcome back, Client!</h2>
        <p>Selamat datang di dashboard <strong>Vantix</strong>. Pantau aktivitas, booking, dan informasi akun kamu dengan mudah.</p>
    </div>
</div>

<!-- Quick Stats -->
<div class="row mt-4 g-4">

    <div class="col-lg-4 col-6">
        <div class="small-box custom-box text-center">
            <div class="inner">
                <h3>150</h3>
                <p>📅 Total Bookings</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box custom-box text-center">
            <div class="inner">
                <h3>12</h3>
                <p>🎯 Active Package</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box custom-box text-center">
            <div class="inner">
                <h3>5</h3>
                <p>⏳ Pending Requests</p>
            </div>
        </div>
    </div>

</div>

<!-- Info Section -->
<div class="info-section mt-5">
    <div class="info-card">
        <h4>📌 Information</h4>
        <p>
            ✅ Pastikan data kamu selalu update.<br>
            📞 Jika ada kendala, hubungi <strong>support Vantix</strong>.
        </p>
    </div>
</div>

@stop