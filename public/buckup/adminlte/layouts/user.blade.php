@extends('adminlte::page')

@section('title', 'User Dashboard')

@section('content_header')
    <h1>User Dashboard</h1>
@stop

@section('content')
    @yield('content')
@stop

@section('sidebar')
<ul class="nav nav-pills nav-sidebar flex-column">

<li class="nav-item">
<a href="/dashboard" class="nav-link">
<i class="fas fa-home"></i>
<p>Dashboard</p>
</a>
</li>

<li class="nav-item">
<a href="/user/profile" class="nav-link">
<i class="fas fa-user"></i>
<p>Profile</p>
</a>
</li>

<li class="nav-item">
<a href="/user/packages" class="nav-link">
<i class="fas fa-box"></i>
<p>Packages</p>
</a>
</li>

<li class="nav-item">
<a href="/user/riwayat" class="nav-link">
<i class="fas fa-history"></i>
<p>Riwayat</p>
</a>
</li>

</ul>
@stop