@extends('layouts.auth')

@section('title', 'VANTIX STAY - Authentication')

@section('content')
<style>
    /* Auth Container */
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-primary);
        position: relative;
        overflow: hidden;
        padding: 20px;
    }
    
    /* Animated Background */
    .auth-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }
    
    .auth-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 20% 80%, rgba(253, 185, 49, 0.08), transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(253, 185, 49, 0.05), transparent 50%);
    }
    
    .auth-wrapper {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        background: var(--bg-card);
        border-radius: 32px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        border: 1px solid var(--border-color);
        position: relative;
        z-index: 1;
        backdrop-filter: blur(10px);
    }
    
    .auth-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 700px;
        position: relative;
    }
    
    /* Container untuk form dan image dengan efek transisi */
    .auth-form-container,
    .auth-image-container {
        position: relative;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }
    
    /* Form styling */
    .auth-form {
        padding: 50px 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        height: 100%;
    }
    
    /* Image styling */
    .auth-image {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background: linear-gradient(135deg, #0A0A0A 0%, #1A140E 100%);
    }
    
    .auth-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .auth-image:hover img {
        transform: scale(1.05);
    }
    
    .auth-image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 40px;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
        color: white;
    }
    
    .auth-image-overlay h3 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 10px;
        font-family: 'Cormorant Garamond', serif;
    }
    
    .auth-image-overlay p {
        font-size: 14px;
        opacity: 0.8;
    }
    
    /* DEFAULT: LOGIN MODE - Gambar di KIRI, Form di KANAN */
    .auth-image-container {
        order: 1;
        animation: slideInLeft 0.5s ease;
    }
    
    .auth-form-container {
        order: 2;
        animation: slideInRight 0.5s ease;
    }
    
    /* REGISTER MODE (swap) - Form di KIRI, Gambar di KANAN */
    .auth-grid.swap .auth-form-container {
        order: 1;
        animation: slideInLeft 0.5s ease;
    }
    
    .auth-grid.swap .auth-image-container {
        order: 2;
        animation: slideInRight 0.5s ease;
    }
    
    /* Animations */
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Form Groups */
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 0;
    }
    
    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .input-icon {
        position: absolute;
        left: 20px;
        color: var(--gold-primary);
        font-size: 18px;
        z-index: 2;
    }
    
    .auth-input {
        width: 100%;
        padding: 14px 20px 14px 55px;
        background: var(--bg-primary);
        border: 2px solid var(--border-color);
        border-radius: 16px;
        color: var(--text-primary);
        font-size: 15px;
        transition: all 0.3s;  background: var(--bg-primary);
        border: none;

        box-shadow:
            inset 4px 4px 10px rgba(0,0,0,0.25),
            inset -4px -4px 10px rgba(255,255,255,0.03);
    }
    
    .auth-input:focus {
        outline: none;
        border-color: var(--gold-primary);
        box-shadow:
            inset 2px 2px 6px rgba(0,0,0,0.3),
            inset -2px -2px 6px rgba(255,255,255,0.05),
            0 0 0 2px rgba(253, 185, 49, 0.2);
    }
    
    .toggle-password-btn {
        position: absolute;
        right: 20px;
        background: none;
        border: none;
        color: var(--text-secondary);
        cursor: pointer;
        font-size: 18px;
    }
    
    /* Options Row (Remember + Forgot) */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    /* Custom Checkbox Premium dengan SVG */
    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        user-select: none;
    }

    .checkbox-wrapper input {
        display: none;
    }

    .checkbox-box {
        width: 22px;
        height: 22px;
        border-radius: 6px;
        border: 2px solid var(--border-color);
        background: var(--bg-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .checkbox-box svg {
        width: 16px;
        height: 16px;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.3s ease;
    }

    .checkbox-wrapper input:checked + .checkbox-box {
        border-color: var(--gold-primary);
        background: var(--gold-gradient);
    }

    .checkbox-wrapper input:checked + .checkbox-box svg {
        opacity: 1;
        transform: scale(1);
    }

    .checkbox-label {
        color: var(--text-secondary);
        font-size: 13px;
    }
    
    .checkbox-custom {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        color: var(--text-secondary);
        font-size: 13px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .checkbox-custom input {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: var(--gold-primary);
    }
    
    .forgot-link {
        color: var(--gold-primary);
        font-size: 13px;
        text-decoration: none;
        font-weight: 500;
        transition: opacity 0.2s;
        cursor: pointer;
    }
    
    .forgot-link:hover {
        text-decoration: underline;
        opacity: 0.9;
    }
    
    /* Button */
    .auth-btn {
        width: 100%;
        padding: 14px;
        background: var(--gold-gradient);
        border: none;
        border-radius: 16px;
        color: #0A0A0A;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 25px;
        box-shadow:
        6px 6px 15px rgba(0,0,0,0.3),
        -6px -6px 15px rgba(255,255,255,0.05);
    }
    
    .auth-btn:hover {
        transform: translateY(-2px);
        box-shadow:
            8px 8px 20px rgba(0,0,0,0.4),
            -8px -8px 20px rgba(255,255,255,0.05);
    }
    
    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .divider-line {
        flex: 1;
        height: 1px;
        background: var(--border-color);
    }
    
    .divider-text {
        color: var(--text-secondary);
        font-size: 13px;
    }
    
    /* Social Buttons */
    .social-buttons {
        display: flex;
        gap: 12px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }
    
    .social-btn {
        flex: 1;
        padding: 12px;
        background: var(--bg-primary);
        border: 2px solid var(--border-color);
        border-radius: 16px;
        color: var(--text-primary);
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 500;
    }
    
    .social-btn:hover {
        border-color: var(--gold-primary);
        transform: translateY(-2px);
    }
    
    .social-btn.google:hover {
        background: #DB4437;
        border-color: #DB4437;
        color: white;
    }
    
    .social-btn.facebook:hover {
        background: #4267B2;
        border-color: #4267B2;
        color: white;
    }
    
    .social-btn.apple:hover {
        background: #000;
        border-color: #000;
        color: white;
    }
    
    .social-btn.twitter:hover {
        background: #1DA1F2;
        border-color: #1DA1F2;
        color: white;
    }
    
    /* Auth Footer Link */
    .auth-footer {
        text-align: center;
        color: var(--text-secondary);
        font-size: 13px;
    }
    
    .auth-footer a {
        color: var(--gold-primary);
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
    }
    
    .auth-footer a:hover {
        text-decoration: underline;
    }
    
    /* Header */
    .auth-header {
        margin-bottom: 25px;
    }
    
    .auth-header h2 {
        font-size: 36px;
        font-weight: 600;
        background: var(--gold-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }
    
    .auth-header p {
        color: var(--text-secondary);
        font-size: 14px;
    }
    
    /* Alert */
    .alert-error {
        padding: 12px 18px;
        border-radius: 16px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        background: rgba(244, 67, 54, 0.1);
        border: 1px solid #f44336;
        color: #f44336;
    }
    
    .alert-success {
        padding: 12px 18px;
        border-radius: 16px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        background: rgba(76, 175, 80, 0.1);
        border: 1px solid #4caf50;
        color: #4caf50;
    }
    
    /* Fade transition untuk konten */
    .fade-out {
        animation: fadeOut 0.2s ease forwards;
    }
    
    .fade-in {
        animation: fadeIn 0.3s ease forwards;
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* ============ RESPONSIVE DESIGN ============ */
    
    /* Tablet Landscape (max-width: 1200px) */
    @media (max-width: 1200px) {
        .auth-form {
            padding: 40px 50px;
        }
        
        .auth-header h2 {
            font-size: 32px;
        }
        
        .auth-image-overlay h3 {
            font-size: 24px;
        }
        
        .auth-image-overlay p {
            font-size: 12px;
        }
        
        .auth-image-overlay {
            padding: 30px;
        }
    }
    
    /* Tablet Portrait (max-width: 992px) */
    @media (max-width: 992px) {
        .auth-container {
            padding: 15px;
        }
        
        .auth-wrapper {
            border-radius: 24px;
        }
        
        .auth-grid {
            min-height: 600px;
        }
        
        .auth-form {
            padding: 35px 40px;
        }
        
        .auth-header h2 {
            font-size: 28px;
        }
        
        .auth-header p {
            font-size: 13px;
        }
        
        .form-row {
            gap: 12px;
        }
        
        .auth-input {
            padding: 12px 18px 12px 50px;
            font-size: 14px;
        }
        
        .input-icon {
            font-size: 16px;
            left: 18px;
        }
        
        .auth-btn {
            padding: 12px;
            font-size: 14px;
        }
        
        .social-btn {
            padding: 10px;
            font-size: 12px;
        }
        
        .auth-image-overlay h3 {
            font-size: 20px;
        }
        
        .auth-image-overlay {
            padding: 25px;
        }
    }
    
    /* Mobile Landscape (max-width: 768px) */
    @media (max-width: 768px) {
        .auth-container {
            padding: 10px;
            align-items: flex-start;
            padding-top: 60px;
        }
        
        .auth-grid {
            grid-template-columns: 1fr;
            min-height: auto;
        }
        
        /* Sembunyikan gambar di mobile */
        .auth-image-container {
            display: none !important;
        }
        
        /* Form mengambil full width */
        .auth-form-container {
            order: 1 !important;
            width: 100%;
        }
        
        .auth-form {
            padding: 30px 25px;
        }
        
        .auth-header {
            text-align: center;
        }
        
        .auth-header h2 {
            font-size: 28px;
        }
        
        .auth-header p {
            font-size: 13px;
        }
        
        /* Form rows jadi column di mobile */
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
        
        .form-group {
            margin-bottom: 18px;
        }
        
        .form-row .form-group:last-child {
            margin-bottom: 18px;
        }
        
        .auth-input {
            padding: 12px 16px 12px 48px;
            font-size: 14px;
        }
        
        .input-icon {
            font-size: 15px;
            left: 16px;
        }
        
        /* Social buttons grid di mobile */
        .social-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        
        .social-btn {
            padding: 10px;
            font-size: 12px;
        }
        
        /* Options row di mobile */
        .form-options {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        
        .auth-btn {
            padding: 12px;
            font-size: 14px;
        }
        
        /* Alert di mobile */
        .alert-error, 
        .alert-success {
            padding: 10px 15px;
            font-size: 12px;
        }
    }
    
    /* Mobile Small (max-width: 480px) */
    @media (max-width: 480px) {
        .auth-container {
            padding: 8px;
            padding-top: 50px;
        }
        
        .auth-wrapper {
            border-radius: 20px;
        }
        
        .auth-form {
            padding: 25px 20px;
        }
        
        .auth-header h2 {
            font-size: 24px;
        }
        
        .auth-header p {
            font-size: 12px;
        }
        
        .auth-input {
            padding: 11px 14px 11px 45px;
            font-size: 13px;
            border-radius: 14px;
        }
        
        .input-icon {
            font-size: 14px;
            left: 14px;
        }
        
        .toggle-password-btn {
            right: 14px;
            font-size: 16px;
        }
        
        .checkbox-label,
        .forgot-link,
        .checkbox-custom span,
        .auth-footer {
            font-size: 12px;
        }
        
        .social-buttons {
            gap: 8px;
        }
        
        .social-btn {
            padding: 8px;
            font-size: 11px;
            border-radius: 14px;
        }
        
        .social-btn i {
            font-size: 14px;
        }
        
        .auth-btn {
            padding: 11px;
            font-size: 13px;
            border-radius: 14px;
        }
        
        .divider-text {
            font-size: 12px;
        }
        
        .alert-error, 
        .alert-success {
            padding: 8px 12px;
            font-size: 11px;
            border-radius: 14px;
        }
        
        .checkbox-box {
            width: 20px;
            height: 20px;
        }
        
        .checkbox-box svg {
            width: 14px;
            height: 14px;
        }
    }
    
    /* Height adjustment untuk mobile */
    @media (max-height: 700px) and (max-width: 768px) {
        .auth-container {
            padding-top: 40px;
        }
        
        .auth-form {
            padding: 20px 25px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .auth-header {
            margin-bottom: 20px;
        }
        
        .auth-header h2 {
            font-size: 24px;
        }
        
        .auth-btn {
            margin-bottom: 20px;
        }
    }
    
    /* Landscape mode untuk mobile */
    @media (max-width: 900px) and (orientation: landscape) {
        .auth-container {
            padding-top: 30px;
        }
        
        .auth-form {
            padding: 20px 30px;
        }
        
        .auth-grid {
            min-height: auto;
        }
        
        .form-group {
            margin-bottom: 12px;
        }
        
        .auth-header {
            margin-bottom: 15px;
        }
        
        .social-buttons {
            margin-bottom: 15px;
        }
    }

    .auth-wrapper {
    max-width: 1400px;
    width: 100%;
    margin: 0 auto;
    background: var(--bg-card);
    border-radius: 32px;
    overflow: hidden;
    
    /* Neumorphic Shadow */
    box-shadow: 
        20px 20px 60px rgba(0,0,0,0.35),
        -20px -20px 60px rgba(255,255,255,0.03);
        
    border: 1px solid var(--border-color);
    position: relative;
    z-index: 1;
    backdrop-filter: blur(10px);
    
    animation: neumorphFloat 0.8s ease;
}

@keyframes neumorphFloat {
    0% {
        opacity: 0;
        transform: translateY(30px) scale(0.96);
        box-shadow: none;
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
        box-shadow: 
            20px 20px 60px rgba(0,0,0,0.35),
            -20px -20px 60px rgba(255,255,255,0.03);
    }
}

.auth-wrapper:hover {
    transform: translateY(-5px);
    transition: 0.4s ease;
    
    box-shadow: 
        25px 25px 70px rgba(0,0,0,0.45),
        -25px -25px 70px rgba(255,255,255,0.04);
}


</style>

<div class="auth-container">
    <div class="auth-bg"></div>
    <div class="auth-wrapper">
        <div class="auth-grid" id="authGrid">
            <!-- IMAGE CONTAINER - Default di KIRI (untuk Login) -->
            <div class="auth-image-container" id="imageContainer">
                <!-- Login Image (default) -->
                <div id="loginImageContent" class="auth-image">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800" alt="Luxury Villa">
                    <div class="auth-image-overlay">
                        <h3>Welcome Back</h3>
                        <p>Sign in to continue your luxury journey</p>
                    </div>
                </div>
                
                <!-- Register Image (hidden initially) -->
                <div id="registerImageContent" class="auth-image" style="display: none;">
                    <img src="https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=800" alt="Luxury Penthouse">
                    <div class="auth-image-overlay">
                        <h3>Join the Elite Circle</h3>
                        <p>Create your account to access exclusive residences</p>
                    </div>
                </div>
            </div>
            
            <!-- FORM CONTAINER - Default di KANAN (untuk Login) -->
            <div class="auth-form-container" id="formContainer">
                <!-- LOGIN FORM (default) -->
                <div id="loginFormContent" class="auth-form">
                    <div class="auth-header">
                        <h2>Sign In</h2>
                        <p>Access your exclusive residence dashboard</p>
                    </div>
                    
                    <div class="alert-error" id="loginError" style="display: none;">
                        <i class="fas fa-exclamation-circle"></i>
                        <span id="errorMessage">Invalid email or password</span>
                    </div>
                    
                    <div class="alert-success" id="loginSuccess" style="display: none;">
                        <i class="fas fa-check-circle"></i>
                        <span id="successMessage">Login successful! Redirecting...</span>
                    </div>
                    
                    <form id="loginForm" onsubmit="return handleLogin(event)">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                <input type="email" id="email" name="email" class="auth-input" placeholder="Email Address" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-icon"><i class="fas fa-lock"></i></span>
                                <input type="password" id="password" name="password" class="auth-input" placeholder="Password" required>
                                <button type="button" class="toggle-password-btn" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-options">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" id="rememberCheckbox" name="remember">
                                <div class="checkbox-box">
                                    <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.8333 14.5818L10.9 12.6818C10.6556 12.4374 10.3502 12.3152 9.984 12.3152C9.61778 12.3152 9.30089 12.4485 9.03333 12.7152C8.78889 12.9596 8.66667 13.2707 8.66667 13.6485C8.66667 14.0263 8.78889 14.3374 9.03333 14.5818L11.9 17.4485C12.1667 17.7152 12.4778 17.8485 12.8333 17.8485C13.1889 17.8485 13.5 17.7152 13.7667 17.4485L19.4333 11.7818C19.7 11.5152 19.8276 11.204 19.816 10.8485C19.8044 10.4929 19.6769 10.1818 19.4333 9.91516C19.1667 9.64849 18.8502 9.50982 18.484 9.49916C18.1178 9.48849 17.8009 9.61604 17.5333 9.88182L12.8333 14.5818Z" fill="#0A0A0A"/>
                                    </svg>
                                </div>
                                <span class="checkbox-label">Remember me</span>
                            </label>
                            <a class="forgot-link" onclick="forgotPassword()">Forgot password?</a>
                        </div>
                        
                        <button type="submit" class="auth-btn">
                            <i class="fas fa-arrow-right-to-bracket"></i>
                            SIGN IN
                        </button>
                    </form>
                    
                    <div class="divider">
                        <div class="divider-line"></div>
                        <span class="divider-text">or continue with</span>
                        <div class="divider-line"></div>
                    </div>
                    
                    <div class="social-buttons">
                        <button type="button" class="social-btn google" onclick="socialLogin('google')">
                            <i class="fab fa-google"></i> Google
                        </button>
                        <button type="button" class="social-btn facebook" onclick="socialLogin('facebook')">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </button>
                        <button type="button" class="social-btn apple" onclick="socialLogin('apple')">
                            <i class="fab fa-apple"></i> Apple
                        </button>
                        <button type="button" class="social-btn twitter" onclick="socialLogin('twitter')">
                            <i class="fab fa-twitter"></i> Twitter
                        </button>
                    </div>
                    
                    <div class="auth-footer">
                        <p>Don't have an account? <a onclick="switchToRegister()">Create Account</a></p>
                    </div>
                </div>
                
                <!-- REGISTER FORM (hidden initially) -->
                <div id="registerFormContent" class="auth-form" style="display: none;">
                    <div class="auth-header">
                        <h2>Create Account</h2>
                        <p>Start your luxury journey with Vantix Stay</p>
                    </div>
                    
                    <div class="alert-error" id="registerError" style="display: none;">
                        <i class="fas fa-exclamation-circle"></i>
                        <span id="registerErrorMessage"></span>
                    </div>
                    
                    <form id="registerForm" onsubmit="return handleRegister(event)">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-icon"><i class="fas fa-user"></i></span>
                                    <input type="text" id="first_name" name="first_name" class="auth-input" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-icon"><i class="fas fa-user"></i></span>
                                    <input type="text" id="last_name" name="last_name" class="auth-input" placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                <input type="email" id="reg_email" name="email" class="auth-input" placeholder="Email Address" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-icon"><i class="fas fa-lock"></i></span>
                                <input type="password" id="reg_password" name="password" class="auth-input" placeholder="Password" required>
                                <button type="button" class="toggle-password-btn" onclick="togglePassword('reg_password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-icon"><i class="fas fa-lock"></i></span>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="auth-input" placeholder="Confirm Password" required>
                                <button type="button" class="toggle-password-btn" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <label class="checkbox-custom">
                            <input type="checkbox" id="termsCheckbox" required>
                            <span>I agree to the <a href="#" onclick="showTerms()" style="color: var(--gold-primary);">Terms of Service</a> and <a href="#" onclick="showPrivacy()" style="color: var(--gold-primary);">Privacy Policy</a></span>
                        </label>
                        
                        <button type="submit" class="auth-btn">
                            <i class="fas fa-user-plus"></i>
                            CREATE ACCOUNT
                        </button>
                    </form>
                    
                    <div class="divider">
                        <div class="divider-line"></div>
                        <span class="divider-text">or continue with</span>
                        <div class="divider-line"></div>
                    </div>
                    
                    <div class="social-buttons">
                        <button type="button" class="social-btn google" onclick="socialLogin('google')">
                            <i class="fab fa-google"></i> Google
                        </button>
                        <button type="button" class="social-btn facebook" onclick="socialLogin('facebook')">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </button>
                        <button type="button" class="social-btn apple" onclick="socialLogin('apple')">
                            <i class="fab fa-apple"></i> Apple
                        </button>
                        <button type="button" class="social-btn twitter" onclick="socialLogin('twitter')">
                            <i class="fab fa-twitter"></i> Twitter
                        </button>
                    </div>
                    
                    <div class="auth-footer">
                        <p>Already have an account? <a onclick="switchToLogin()">Sign In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentMode = 'login'; // 'login' or 'register'
    
    function switchToRegister() {
        if (currentMode === 'login') {
            currentMode = 'register';
            
            // Add swap class ke grid untuk menukar posisi
            const grid = document.getElementById('authGrid');
            grid.classList.add('swap');
            
            // Fade out current content
            const loginForm = document.getElementById('loginFormContent');
            const loginImage = document.getElementById('loginImageContent');
            
            loginForm.classList.add('fade-out');
            loginImage.classList.add('fade-out');
            
            setTimeout(() => {
                // Hide login content
                loginForm.style.display = 'none';
                loginImage.style.display = 'none';
                
                // Show register content
                const registerForm = document.getElementById('registerFormContent');
                const registerImage = document.getElementById('registerImageContent');
                
                registerForm.style.display = 'flex';
                registerImage.style.display = 'block';
                
                // Remove fade-out and add fade-in
                loginForm.classList.remove('fade-out');
                loginImage.classList.remove('fade-out');
                registerForm.classList.add('fade-in');
                registerImage.classList.add('fade-in');
                
                setTimeout(() => {
                    registerForm.classList.remove('fade-in');
                    registerImage.classList.remove('fade-in');
                }, 300);
            }, 200);
            
            // Update URL hash
            window.location.hash = 'register';
        }
        return false;
    }
    
    function switchToLogin() {
        if (currentMode === 'register') {
            currentMode = 'login';
            
            // Remove swap class untuk mengembalikan posisi
            const grid = document.getElementById('authGrid');
            grid.classList.remove('swap');
            
            // Fade out current content
            const registerForm = document.getElementById('registerFormContent');
            const registerImage = document.getElementById('registerImageContent');
            
            registerForm.classList.add('fade-out');
            registerImage.classList.add('fade-out');
            
            setTimeout(() => {
                // Hide register content
                registerForm.style.display = 'none';
                registerImage.style.display = 'none';
                
                // Show login content
                const loginForm = document.getElementById('loginFormContent');
                const loginImage = document.getElementById('loginImageContent');
                
                loginForm.style.display = 'flex';
                loginImage.style.display = 'block';
                
                // Remove fade-out and add fade-in
                registerForm.classList.remove('fade-out');
                registerImage.classList.remove('fade-out');
                loginForm.classList.add('fade-in');
                loginImage.classList.add('fade-in');
                
                setTimeout(() => {
                    loginForm.classList.remove('fade-in');
                    loginImage.classList.remove('fade-in');
                }, 300);
            }, 200);
            
            // Update URL hash
            window.location.hash = 'login';
        }
        return false;
    }
    
    // Check URL hash on load
    function checkHash() {
        if (window.location.hash === '#register') {
            // Langsung tukar tanpa animasi
            currentMode = 'register';
            const grid = document.getElementById('authGrid');
            grid.classList.add('swap');
            
            document.getElementById('loginFormContent').style.display = 'none';
            document.getElementById('loginImageContent').style.display = 'none';
            document.getElementById('registerFormContent').style.display = 'flex';
            document.getElementById('registerImageContent').style.display = 'block';
        }
    }
    
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const icon = passwordInput.parentElement.querySelector('.toggle-password-btn i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    
    function socialLogin(provider) {
        alert(`✨ ${provider.charAt(0).toUpperCase() + provider.slice(1)} login demo:\n\nIn a real app, you would be redirected to ${provider} OAuth.`);
    }
    
    function forgotPassword() {
        alert("🔐 Password Reset\n\nA reset link would be sent to your email address.\n(Demo feature)");
    }
    
    function showTerms() {
        alert('Terms of Service:\n\nBy registering, you agree to our terms. This is a demo version.');
        return false;
    }
    
    function showPrivacy() {
        alert('Privacy Policy:\n\nYour data is safe with us. This is a demo version.');
        return false;
    }
    
    function handleLogin(event) {
        event.preventDefault();
        
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const rememberCheckbox = document.getElementById('rememberCheckbox');
        const errorAlert = document.getElementById('loginError');
        const successAlert = document.getElementById('loginSuccess');
        
        errorAlert.style.display = 'none';
        successAlert.style.display = 'none';
        
        if (!email || !password) {
            showLoginError('Please fill in both email and password.');
            return false;
        }
        
        // Demo credentials check
        if (email === 'admin@vantix.com' && password === '123456') {
            if (rememberCheckbox.checked) {
                localStorage.setItem('rememberedEmail', email);
            } else {
                localStorage.removeItem('rememberedEmail');
            }
            
            showLoginSuccess('Login successful! Redirecting to dashboard...');
            
            setTimeout(function() {
                window.location.href = '/';
            }, 1500);
        } else {
            showLoginError('Invalid email or password. Try: admin@vantix.com / 123456');
        }
        
        return false;
    }
    
    function handleRegister(event) {
        event.preventDefault();
        
        const firstName = document.getElementById('first_name').value.trim();
        const lastName = document.getElementById('last_name').value.trim();
        const email = document.getElementById('reg_email').value.trim();
        const password = document.getElementById('reg_password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const termsCheckbox = document.getElementById('termsCheckbox');
        const errorAlert = document.getElementById('registerError');
        const errorMessageSpan = document.getElementById('registerErrorMessage');
        
        errorAlert.style.display = 'none';
        
        if (!firstName || !lastName || !email || !password || !confirmPassword) {
            errorMessageSpan.textContent = 'Please fill in all fields.';
            errorAlert.style.display = 'flex';
            return false;
        }
        
        if (password !== confirmPassword) {
            errorMessageSpan.textContent = 'Passwords do not match.';
            errorAlert.style.display = 'flex';
            return false;
        }
        
        if (password.length < 6) {
            errorMessageSpan.textContent = 'Password must be at least 6 characters.';
            errorAlert.style.display = 'flex';
            return false;
        }
        
        if (!termsCheckbox.checked) {
            errorMessageSpan.textContent = 'You must agree to the Terms of Service and Privacy Policy.';
            errorAlert.style.display = 'flex';
            return false;
        }
        
        alert(`✨ Registration successful!\n\nWelcome ${firstName} ${lastName}!\nEmail: ${email}\n\nPlease login with your new account.`);
        
        // Switch to login form after successful registration
        switchToLogin();
        
        // Auto-fill email in login form
        document.getElementById('email').value = email;
        
        return false;
    }
    
    function showLoginError(message) {
        const errorAlert = document.getElementById('loginError');
        const errorMessageSpan = document.getElementById('errorMessage');
        errorMessageSpan.textContent = message;
        errorAlert.style.display = 'flex';
        
        setTimeout(function() {
            if (errorAlert.style.display === 'flex') {
                errorAlert.style.display = 'none';
            }
        }, 5000);
    }
    
    function showLoginSuccess(message) {
        const successAlert = document.getElementById('loginSuccess');
        const successMessageSpan = document.getElementById('successMessage');
        successMessageSpan.textContent = message;
        successAlert.style.display = 'flex';
    }
    
    // Load remembered email on page load
    document.addEventListener('DOMContentLoaded', function() {
        const rememberedEmail = localStorage.getItem('rememberedEmail');
        if (rememberedEmail) {
            const emailInput = document.getElementById('email');
            if (emailInput) {
                emailInput.value = rememberedEmail;
            }
            const rememberCheckbox = document.getElementById('rememberCheckbox');
            if (rememberCheckbox) {
                rememberCheckbox.checked = true;
            }
        }
        
        // Check URL hash
        checkHash();
        
        console.log('Demo credentials: admin@vantix.com / 123456');
    });
</script>
@endsection