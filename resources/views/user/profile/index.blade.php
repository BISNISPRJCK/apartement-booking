@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <div class="packages-header-bar">
        <h1>Profile</h1>
    </div>
@stop

@section('content')
<div class="profile-wrapper">

    <form class="profile-card">

        <div class="row">

            {{-- First Name --}}
            <div class="col-md-6 mb-3">
                <label class="profile-label">First Name</label>
                <input type="text" class="form-control profile-input" placeholder="Enter your first name">
            </div>

            {{-- Last Name --}}
            <div class="col-md-6 mb-3">
                <label class="profile-label">Last Name</label>
                <input type="text" class="form-control profile-input" placeholder="Enter your last name">
            </div>

        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label class="profile-label">Email</label>
            <input type="email" class="form-control profile-input" placeholder="Enter your email">
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label class="profile-label">Password</label>

            <div class="password-wrapper">
                <input type="password" class="form-control profile-input" placeholder="Password">
                <span class="toggle-eye">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
        </div>

        {{-- Button --}}
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-edit-profile">
                Edit Profile
            </button>
        </div>

    </form>

</div>
@stop