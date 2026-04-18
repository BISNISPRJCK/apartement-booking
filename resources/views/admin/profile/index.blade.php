@extends('layouts.admin')

@section('content')
<div class="profile-container">
    {{-- Header Profile --}}
    <div class="profile-header">
        <h1 class="profile-title">Profile</h1>
        <div class="filter-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M6 12H18M10 18H14" stroke="#000080" stroke-width="2" stroke-linecap="round"/>
                <circle cx="6" cy="6" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="18" cy="12" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="12" cy="18" r="2" stroke="#000080" stroke-width="2"/>
            </svg>
        </div>
        <div class="profile-divider"></div>
    </div>

    {{-- Form Profile --}}
    <div class="profile-form-wrapper">
        <form action="#" method="POST">
            @csrf
            @method('PUT')

            {{-- Row 1: First Name & Last Name --}}
            <div class="form-row">
                <div class="form-group">
                    <label>First Name</label>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your first name" value="John">
                    </div>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your last name" value="Doe">
                    </div>
                </div>
            </div>

            {{-- Row 2: Email --}}
            <div class="form-group full-width">
                <label>Email</label>
                <div class="input-field">
                    <input type="email" placeholder="Enter your email" value="john.doe@example.com">
                </div>
            </div>

            {{-- Row 3: Password --}}
            <div class="form-group full-width">
                <label>Password</label>
                <div class="input-field password-field">
                    <input type="password" placeholder="Password">
                    <button type="button" class="eye-icon" onclick="togglePassword(this)">
                        <svg width="24" height="24" viewBox="0 0 32 32" fill="none">
                            <path d="M16 6C8 6 2 16 2 16C2 16 8 26 16 26C24 26 30 16 30 16C30 16 24 6 16 6Z" stroke="#737373" stroke-width="2"/>
                            <path d="M16 20C18.2091 20 20 18.2091 20 16C20 13.7909 18.2091 12 16 12C13.7909 12 12 13.7909 12 16C12 18.2091 13.7909 20 16 20Z" stroke="#737373" stroke-width="2"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Button Edit Profile --}}
            <div class="button-wrapper">
                <button type="submit" class="edit-profile-btn">Edit Profile</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
/* ========================================
   PROFILE PAGE - HEADER TETAP BESAR, FORM DIPERKECIL
   ======================================== */

/* Container utama */
.profile-container {
    position: relative;
    width: 100%;
    max-width: 1050px;
    margin: 0 auto;
}

/* ========== HEADER - TETAP UKURAN BESAR ========== */
.profile-header {
    position: relative;
    width: 100%;
    height: 61px;
    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
}

.profile-title {
    position: absolute;
    left: 2px;
    top: 0;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 32px;
    line-height: 48px;
    color: #000080;
    margin: 0;
}

.filter-icon {
    position: absolute;
    right: 0;
    top: 19px;
    width: 24px;
    height: 24px;
    cursor: pointer;
}

.filter-icon svg {
    width: 24px;
    height: 24px;
}

.profile-divider {
    position: absolute;
    width: 100%;
    left: -0.01px;
    bottom: 0;
    border: 1px solid #000080;
}

/* ========== FORM WRAPPER - DIPERKECIL ========== */
.profile-form-wrapper {
    position: relative;
    max-width: 600px;
    margin: 60px auto 0;
}

/* ========== FORM ROW ========== */
.form-row {
    display: flex;
    gap: 30px;
    margin-bottom: 20px;
}

/* Form Group - DIPERKECIL */
.form-group {
    position: relative;
    width: 285px;
    height: 85px;
}

.form-group.full-width {
    width: 100%;
    height: 85px;
    margin-bottom: 20px;
}

/* Label - DIPERKECIL */
.form-group label {
    position: absolute;
    top: 0;
    left: 0;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    color: #000080;
}

/* Input Field - DIPERKECIL */
.input-field {
    position: absolute;
    top: 34px;
    left: 0;
    width: 100%;
    height: 51px;
    border: 1px solid #000080;
    border-radius: 6px;
    background: transparent;
    display: flex;
    align-items: center;
    padding: 0 0 0 16px;
}

/* Input styling - DIPERKECIL */
.input-field input {
    width: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    color: rgba(115, 115, 115, 0.5);
}

.input-field input:focus {
    color: #000080;
}

.input-field input::placeholder {
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    color: rgba(115, 115, 115, 0.5);
}

/* Password Field */
.password-field {
    padding: 0 0 0 16px;
}

.password-field input {
    flex: 1;
}

/* Eye Icon - DIPERKECIL */
.eye-icon {
    background: transparent;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    margin-right: 12px;
    width: 24px;
    height: 24px;
}

.eye-icon svg {
    width: 24px;
    height: 24px;
}

.eye-icon:hover svg path {
    stroke: #000080;
}

/* ========== BUTTON EDIT PROFILE - DIPERKECIL ========== */
.button-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.edit-profile-btn {
    width: 285px;
    height: 51px;
    background: #1261C8;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 6px;
    border: none;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 18px;
    line-height: 27px;
    color: #FFFFFF;
    cursor: pointer;
    transition: all 0.3s ease;
}

.edit-profile-btn:hover {
    background: #0e4fa0;
    transform: translateY(-2px);
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
}

.edit-profile-btn:active {
    transform: translateY(0);
}

/* ========== RESPONSIVE ========== */
@media (max-width: 1024px) {
    .profile-container {
        padding: 0 20px;
    }
}

@media (max-width: 768px) {
    .profile-title {
        font-size: 24px;
        line-height: 36px;
    }
    
    .filter-icon {
        top: 6px;
    }
    
    .filter-icon svg {
        width: 20px;
        height: 20px;
    }
    
    .profile-form-wrapper {
        margin-top: 40px;
    }
    
    .form-row {
        flex-direction: column;
        gap: 0;
    }
    
    .form-group {
        width: 100%;
    }
    
    .form-group label {
        font-size: 14px;
    }
    
    .input-field {
        top: 30px;
        height: 46px;
        padding-left: 14px;
    }
    
    .input-field input,
    .input-field input::placeholder {
        font-size: 14px;
    }
    
    .edit-profile-btn {
        width: 100%;
        max-width: 285px;
        height: 46px;
        font-size: 16px;
    }
}

@media (max-width: 576px) {
    .profile-form-wrapper {
        margin-top: 30px;
    }
}
</style>
@endpush

@push('scripts')
<script>
    function togglePassword(button) {
        const inputField = button.previousElementSibling;
        const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
        inputField.setAttribute('type', type);
        
        const paths = button.querySelectorAll('path');
        if (type === 'text') {
            paths.forEach(path => path.setAttribute('stroke', '#000080'));
        } else {
            paths.forEach(path => path.setAttribute('stroke', '#737373'));
        }
    }
</script>
@endpush