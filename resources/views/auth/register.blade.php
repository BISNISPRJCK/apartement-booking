@extends('layouts.auth')

@section('title', 'VANTIX STAY - Register')

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
        min-height: 580px;
    }
    
    /* Image Side - Now on Right for Register */
    .auth-image {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #0A0A0A 0%, #1A140E 100%);
        order: 2;
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
    
    /* Form Side - Now on Left for Register */
    .auth-form {
        padding: 40px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        order: 1;
    }
    
    .auth-header {
        margin-bottom: 30px;
    }
    
    .auth-header h2 {
        font-size: 42px;
        font-weight: 600;
        background: var(--gold-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
    }
    
    .auth-header p {
        color: var(--text-secondary);
        font-size: 16px;
    }
    
    /* Form Groups */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 0;
    }
    
    .form-group {
        margin-bottom: 16px;
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
    }
    
    .auth-input {
        width: 100%;
        padding: 13px 20px 13px 50px;
        background: var(--bg-primary);
        border: 2px solid var(--border-color);
        border-radius: 16px;
        color: var(--text-primary);
        font-size: 16px;
        transition: all 0.3s;
    }
    
    .auth-input:focus {
        outline: none;
        border-color: var(--gold-primary);
        box-shadow: 0 0 0 4px rgba(253, 185, 49, 0.1);
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
    
    /* Checkbox */
    .checkbox-custom {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        color: var(--text-secondary);
        font-size: 14px;
        margin-bottom: 25px;
    }
    
    .checkbox-custom input {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: var(--gold-primary);
    }
    
    /* Button */
    .auth-btn {
        width: 100%;
        padding: 13px;
        background: var(--gold-gradient);
        border: none;
        border-radius: 16px;
        color: #0A0A0A;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 30px;
    }
    
    .auth-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(253, 185, 49, 0.3);
    }
    
    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .divider-line {
        flex: 1;
        height: 1px;
        background: var(--border-color);
    }
    
    .divider-text {
        color: var(--text-secondary);
        font-size: 14px;
    }
    
    /* Social Buttons */
    .social-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }
    
    .social-btn {
        flex: 1;
        padding: 14px;
        background: var(--bg-primary);
        border: 2px solid var(--border-color);
        border-radius: 16px;
        color: var(--text-primary);
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 14px;
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
    
    /* Login Link */
    .auth-footer {
        text-align: center;
        color: var(--text-secondary);
        font-size: 14px;
    }
    
    .auth-footer a {
        color: var(--gold-primary);
        text-decoration: none;
        font-weight: 600;
    }
    
    .auth-footer a:hover {
        text-decoration: underline;
    }
    
    /* Alert */
    .alert-error {
        padding: 15px 20px;
        border-radius: 16px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        background: rgba(244, 67, 54, 0.1);
        border: 1px solid #f44336;
        color: #f44336;
    }
    
    /* Animations with different directions for register */
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
    
    .auth-form {
        animation: slideInLeft 0.6s ease;
    }
    
    .auth-image {
        animation: slideInRight 0.6s ease;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .auth-form {
            padding: 40px;
        }
        
        .auth-header h2 {
            font-size: 32px;
        }
    }
    
    @media (max-width: 768px) {
        .auth-grid {
            grid-template-columns: 1fr;
        }
        
        .auth-image {
            display: none;
        }
        
        .auth-form {
            padding: 30px;
        }
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
        
        .social-buttons {
            flex-wrap: wrap;
        }
        
        .social-btn {
            min-width: calc(50% - 8px);
        }
    }
</style>

<div class="auth-container">
    <div class="auth-bg"></div>
    <div class="auth-wrapper">
        <div class="auth-grid">
            <!-- Image Side - Now on Right -->
            <div class="auth-image">
                <img src="https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=800" alt="Luxury Penthouse">
                <div class="auth-image-overlay">
                    <h3>Join the Elite Circle</h3>
                    <p>Create your account to access exclusive residences</p>
                </div>
            </div>
            
            <!-- Form Side - Now on Left -->
            <div class="auth-form">
                <div class="auth-header">
                    <h2>Create Account</h2>
                    <p>Start your luxury journey with Vantix Stay</p>
                </div>
                
                @if($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first() }}
                    </div>
                @endif
                
                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf

                    <!-- First & Last Name -->
                    <div class="form-row">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" 
                                    name="first_name" 
                                    class="auth-input" 
                                    placeholder="First Name"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" 
                                    name="last_name" 
                                    class="auth-input" 
                                    placeholder="Last Name"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" 
                                name="email" 
                                class="auth-input" 
                                placeholder="Email Address"
                                required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" 
                                id="password"
                                name="password" 
                                class="auth-input" 
                                placeholder="Password"
                                required>
                            <button type="button" class="toggle-password-btn" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" 
                                id="password_confirmation"
                                name="password_confirmation" 
                                class="auth-input" 
                                placeholder="Confirm Password"
                                required>
                            <button type="button" class="toggle-password-btn" onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <label class="checkbox-custom">
                        <input type="checkbox" name="terms" required>
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
                    <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
        alert(`Redirecting to ${provider} login...\n\nThis is a demo feature.`);
    }
    
    function showTerms() {
        alert('Terms of Service:\n\nBy registering, you agree to our terms. This is a demo version.');
        return false;
    }
    
    function showPrivacy() {
        alert('Privacy Policy:\n\nYour data is safe with us. This is a demo version.');
        return false;
    }
</script>
@endsection