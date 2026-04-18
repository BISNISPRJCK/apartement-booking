@extends('adminlte::page')

@section('title', 'Super Admin Dashboard')

@section('content_header')
    <h1>Super Admin Dashboard</h1>
@stop

@section('content')
    @yield('content')
@stop

@section('sidebar')
<ul class="nav nav-pills nav-sidebar flex-column">

<li class="nav-item">
<a href="/superadmin/dashboard" class="nav-link">
<i class="fas fa-crown"></i>
<p>Dashboard</p>
</a>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="fas fa-users"></i>
<p>Users</p>
</a>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="fas fa-user-shield"></i>
<p>Admins</p>
</a>
</li>

</ul>
@stop