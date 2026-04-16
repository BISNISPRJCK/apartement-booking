@extends('dashboard.layouts.app')

@section('title', 'Profile')

@section('content')

<div class="profile-page">
    <!-- Header Section yang sudah diperlebar -->
    <div class="profile-header">
        <h1 class="profile-title">Profile</h1>
        <div class="filter-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M6 12H18M10 18H14" stroke="#FFD700" stroke-width="2" stroke-linecap="round"/>
                <circle cx="6" cy="6" r="2" stroke="#FFD700" stroke-width="2"/>
                <circle cx="18" cy="12" r="2" stroke="#FFD700" stroke-width="2"/>
                <circle cx="12" cy="18" r="2" stroke="#FFD700" stroke-width="2"/>
            </svg>
        </div>
        <div class="profile-divider"></div>
    </div>

    <!-- Form Section yang sudah diperkecil dan di tengah -->
    <div class="profile-form-container">
        <div class="form-wrapper">
            <form action="#" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Row 1: First Name dan Last Name -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <div class="input-wrapper">
                            <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" value="John">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <div class="input-wrapper">
                            <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" value="Doe">
                        </div>
                    </div>
                </div>
                
                <!-- Row 2: Email -->
                <div class="form-group-full">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" placeholder="Enter your email" value="john.doe@example.com">
                    </div>
                </div>
                
                <!-- Row 3: Password -->
                <div class="form-group-full">
                    <label for="password">Password</label>
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="password" name="password" placeholder="Password">
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <svg width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 6C8 6 2 16 2 16C2 16 8 26 16 26C24 26 30 16 30 16C30 16 24 6 16 6Z" stroke="#737373" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 20C18.2091 20 20 18.2091 20 16C20 13.7909 18.2091 12 16 12C13.7909 12 12 13.7909 12 16C12 18.2091 13.7909 20 16 20Z" stroke="#737373" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Tombol Edit Profile -->
                <div class="button-container">
                    <button type="submit" class="btn-edit-profile">Edit Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .profile-page {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Profile Header - DIPERLEBAR (HANYA HEADER) */
    .profile-header {
        position: relative;
        width: 100%;
        max-width: 1200px; /* Diperlebar dari 900px menjadi 1200px */
        height: 60px; /* Sedikit lebih tinggi */
        margin-bottom: 40px;
        flex-shrink: 0;
        margin-left: auto;
        margin-right: auto;
    }

    .profile-title {
        position: absolute;
        width: auto;
        height: auto;
        left: 0;
        top: 0;
        font-family: 'Poppins', sans-serif;
        font-style: normal;
        font-weight: 500;
        font-size: 32px; /* Diperbesar dari 28px menjadi 32px */
        line-height: 48px;
        color: #FFD700;
        margin: 0;
        padding: 0;
    }

    .filter-icon {
        position: absolute;
        width: 24px; /* Diperbesar dari 20px menjadi 24px */
        height: 24px;
        right: 0;
        top: 12px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .filter-icon:hover {
        transform: rotate(90deg);
    }

    .filter-icon svg {
        width: 24px;
        height: 24px;
    }

    .profile-divider {
        position: absolute;
        width: 100%;
        height: -5px;
        left: 0;
        bottom: 0;
        border: 2px solid #615515; /* Dipertebal dari 1px menjadi 2px */
    }

    /* Profile Form Container - TETAP SAMA (TIDAK DIPERLEBAR) */
    .profile-form-container {
        position: relative;
        width: 100%;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Form wrapper - TETAP SAMA */
    .form-wrapper {
        width: 100%;
        max-width: 700px; /* Tetap 700px, tidak berubah */
        margin: 0 auto;
    }

    /* Form Row - TETAP SAMA */
    .form-row {
        display: flex;
        gap: 30px;
        margin-bottom: 20px;
    }

    .form-group {
        flex: 1;
        position: relative;
        height: 90px;
    }

    .form-group-full {
        position: relative;
        height: 90px;
        margin-bottom: 20px;
    }

    /* Label styling - TETAP SAMA */
    .form-group label,
    .form-group-full label {
        position: absolute;
        top: 0;
        left: 0;
        font-family: 'Poppins', sans-serif;
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 24px;
        color: #FFD700;
        margin: 0;
    }

    /* Input wrapper - TETAP SAMA */
    .input-wrapper {
        position: absolute;
        top: 34px;
        left: 0;
        width: 100%;
        height: 56px;
        border: 1px solid #615515;
        border-radius: 8px;
        background: transparent;
        display: flex;
        align-items: center;
        padding: 0 0 0 20px;
    }

    /* Input field styling - TETAP SAMA */
    .input-wrapper input {
        width: 100%;
        background: transparent;
        border: none;
        outline: none;
        font-family: 'Poppins', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 18px;
        line-height: 27px;
        color: rgba(115, 115, 115, 0.5);
    }

    .input-wrapper input:focus {
        color: #FFD700;
    }

    /* Password wrapper khusus - TETAP SAMA */
    .password-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-right: 20px;
    }

    .password-wrapper input {
        flex: 1;
    }

    .toggle-password {
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        margin-left: auto;
    }

    .toggle-password svg {
        width: 24px;
        height: 24px;
    }

    .toggle-password:hover svg path {
        stroke: #FFD700;
    }

    /* Button container - TETAP SAMA */
    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    /* Button Edit Profile - TETAP SAMA */
    .btn-edit-profile {
        width: 300px;
        height: 56px;
        background: #1261C8;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 8px;
        border: none;
        font-family: 'Poppins', sans-serif;
        font-style: normal;
        font-weight: 500;
        font-size: 20px;
        line-height: 30px;
        color: #FFFFFF;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-edit-profile:hover {
        background: #0e4fa0;
        transform: translateY(-2px);
        box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.3);
    }

    .btn-edit-profile:active {
        transform: translateY(0);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .profile-header {
            max-width: 95%;
            padding: 0 20px;
        }
    }

    @media (max-width: 768px) {
        .profile-header {
            max-width: 100%;
            padding: 0 20px;
            height: 50px;
        }
        
        .profile-title {
            font-size: 24px;
            line-height: 36px;
        }
        
        .filter-icon {
            top: 6px;
            width: 20px;
            height: 20px;
        }
        
        .filter-icon svg {
            width: 20px;
            height: 20px;
        }

        .form-wrapper {
            max-width: 100%;
            padding: 0 20px;
        }

        .form-row {
            flex-direction: column;
            gap: 15px;
        }

        .input-wrapper input {
            font-size: 16px;
            line-height: 24px;
        }

        .btn-edit-profile {
            width: 100%;
            max-width: 280px;
            font-size: 18px;
            height: 50px;
        }
    }
    
    @media (max-height: 650px) {
        .profile-header {
            margin-bottom: 20px;
            height: 50px;
        }
        
        .profile-title {
            font-size: 24px;
            line-height: 36px;
        }
        
        .form-row, .form-group-full {
            margin-bottom: 15px;
        }
        
        .form-group, .form-group-full {
            height: 80px;
        }
        
        .input-wrapper {
            top: 30px;
            height: 50px;
            padding-left: 16px;
        }
        
        .btn-edit-profile {
            height: 50px;
            font-size: 18px;
            margin-top: 10px;
        }
        
        label {
            font-size: 14px !important;
        }
        
        input {
            font-size: 16px !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    }
</script>
@endpush