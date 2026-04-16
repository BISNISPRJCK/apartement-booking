@extends('adminlte::page')

@section('title', 'Riwayat')

@section('content_header')
<div class="packages-header-bar">
    <div class="riwayat-wrapper">
    <h1>Riwayat Booking</h1>
    </div>
</div>
@stop

@section('content')
<div class="riwayat-wrapper">

    {{-- ITEM 1 --}}
    <div class="riwayat-card">
        
        {{-- IMAGE --}}
        <div class="riwayat-image">
            <img src="https://images.unsplash.com/photo-1501183638710-841dd1904471" alt="">
        </div>

        {{-- CONTENT --}}
        <div class="riwayat-content">

            <div class="riwayat-title">
                Grand Asia Afrika Apartement
            </div>

            <div class="riwayat-line"></div>

            <div class="riwayat-info">
                <p>Tipe 1 : 2 Guest</p>
                <p>Tanggal Booking : 10 - 14 Januari 2026</p>
                <p>Total Pembayaran : IDR 5,000,000</p>

                <div class="riwayat-status">
                    <span>Status :</span>
                    <span class="badge success">Selesai</span>
                </div>
            </div>

        </div>
    </div>


    {{-- ITEM 2 --}}
    <div class="riwayat-card">
        
        <div class="riwayat-image">
            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267" alt="">
        </div>

        <div class="riwayat-content">

            <div class="riwayat-title">
                Luxury Villa Bandung
            </div>

            <div class="riwayat-line"></div>

            <div class="riwayat-info">
                <p>Tipe 2 : 3 Guest</p>
                <p>Tanggal Booking : 12 - 14 Januari 2026</p>
                <p>Total Pembayaran : IDR 2,000,000</p>

                <div class="riwayat-status">
                    <span>Status :</span>
                    <span class="badge cancel">Dibatalkan</span>
                </div>
            </div>

        </div>
    </div>

</div>
@stop