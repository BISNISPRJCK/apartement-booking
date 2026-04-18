@extends('adminlte::master')

@section('body')

<div class="wrapper">

{{-- Navbar --}}
<nav class="main-header navbar navbar-expand">

<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" data-widget="pushmenu" href="#">
<i class="fas fa-bars"></i>
</a>
</li>
</ul>

<span class="navbar-brand ml-3 text-white">
Super Admin Panel
</span>

</nav>

{{-- Sidebar --}}
<aside class="main-sidebar elevation-4">

<a href="#" class="brand-link">
<span class="brand-text font-weight-light">
Super Admin
</span>
</a>

<div class="sidebar">

<nav>
<ul class="nav nav-pills nav-sidebar flex-column">

<li class="nav-item">
<a href="/superadmin/dashboard" class="nav-link">
<i class="nav-icon fas fa-tachometer-alt"></i>
<p>Dashboard</p>
</a>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fas fa-users"></i>
<p>Manage Admin</p>
</a>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fas fa-database"></i>
<p>System Settings</p>
</a>
</li>

</ul>
</nav>

</div>

</aside>

{{-- Content --}}
<div class="content-wrapper p-3">
@yield('content')
</div>

</div>

@stop