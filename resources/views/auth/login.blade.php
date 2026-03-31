@extends('layouts.auth')

@section('title', 'VANTIX STAY - Login')

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
        min-height: 700px;
    }
    
    /* Image Side - Now on Right for Login */
    .auth-image {
        position: relative;
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
    
    /* Form Side */
    .auth-form {
        padding: 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
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
    
    /* Form Groups - single column for login */
    .form-group {
        margin-bottom: 25px;
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
        padding: 16px 20px 16px 55px;
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
    
    /* Options Row (Remember + Forgot) */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
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
        font-size: 14px;
    }
    
    .forgot-link {
        color: var(--gold-primary);
        font-size: 14px;
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
        padding: 16px;
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
    
    /* Register Link */
    .auth-footer {
        text-align: center;
        color: var(--text-secondary);
        font-size: 14px;
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
    
    .alert-success {
        padding: 15px 20px;
        border-radius: 16px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        background: rgba(76, 175, 80, 0.1);
        border: 1px solid #4caf50;
        color: #4caf50;
    }
    
    /* Animations with different directions for login */
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
            <!-- Image Side - On Right -->
            <div class="auth-image">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800" alt="Luxury Villa">
                <div class="auth-image-overlay">
                    <h3>Welcome Back</h3>
                    <p>Sign in to continue your luxury journey</p>
                </div>
            </div>
            
            <!-- Form Side - On Left: LOGIN -->
            <div class="auth-form">
                <div class="auth-header">
                    <h2>Sign In</h2>
                    <p>Access your exclusive residence dashboard</p>
                </div>
                
                <!-- Alert Error (hidden by default) -->
                <div class="alert-error" id="loginError" style="display: none;">
                    <i class="fas fa-exclamation-circle"></i>
                    <span id="errorMessage">Invalid email or password</span>
                </div>
                
                <!-- Alert Success (hidden by default) -->
                <div class="alert-success" id="loginSuccess" style="display: none;">
                    <i class="fas fa-check-circle"></i>
                    <span id="successMessage">Login successful! Redirecting...</span>
                </div>
                
                <!-- Login Form - Dummy Backend -->
                <form id="loginForm" onsubmit="return handleLogin(event)">
                    <!-- Email Field -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" 
                                   id="email"
                                   name="email" 
                                   class="auth-input" 
                                   placeholder="Email Address"
                                   required>
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
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
                    
                    <!-- Remember Me & Forgot Password dengan Custom Checkbox SVG -->
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
                    <p>Don't have an account? <a href="{{ route('register') }}">Create Account</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Dummy credentials untuk demo
    const DUMMY_CREDENTIALS = {
        email: "admin@vantix.com",
        password: "123456"
    };
    
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
    
    function goToRegister() {
        alert("📝 Create Account\n\nYou would be redirected to the registration page.\n(Demo feature)");
    }
    
    function handleLogin(event) {
        event.preventDefault();
        
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const rememberCheckbox = document.getElementById('rememberCheckbox');
        const errorAlert = document.getElementById('loginError');
        const successAlert = document.getElementById('loginSuccess');
        
        // Hide any existing alerts
        errorAlert.style.display = 'none';
        successAlert.style.display = 'none';
        
        // Validate input
        if (!email || !password) {
            showError('Please fill in both email and password.');
            return false;
        }
        
        // Check credentials
        if (email === DUMMY_CREDENTIALS.email && password === DUMMY_CREDENTIALS.password) {
            // Login success
            if (rememberCheckbox.checked) {
                localStorage.setItem('rememberedEmail', email);
                console.log('Credentials saved for next time');
            } else {
                localStorage.removeItem('rememberedEmail');
            }
            
            showSuccess('Login successful! Redirecting to dashboard...');
            
            // Simulate redirect after 1.5 seconds
            setTimeout(function() {
                // In real implementation: window.location.href = "/dashboard";
                alert('🎉 Welcome to Vantix Stay Dashboard!\n\n(Redirect would happen here in a real app)');
                // Reset form if needed
                // window.location.href = "/";
            }, 1500);
        } else {
            // Login failed
            let errorMsg = 'Invalid email or password.';
            if (email !== DUMMY_CREDENTIALS.email && password !== DUMMY_CREDENTIALS.password) {
                errorMsg = 'Invalid email and password. Try: admin@vantix.com / 123456';
            } else if (email !== DUMMY_CREDENTIALS.email) {
                errorMsg = 'Email not found. Try: admin@vantix.com';
            } else if (password !== DUMMY_CREDENTIALS.password) {
                errorMsg = 'Incorrect password. Try: 123456';
            }
            showError(errorMsg);
        }
        
        return false;
    }
    
    function showError(message) {
        const errorAlert = document.getElementById('loginError');
        const errorMessageSpan = document.getElementById('errorMessage');
        errorMessageSpan.textContent = message;
        errorAlert.style.display = 'flex';
        
        // Auto hide after 5 seconds
        setTimeout(function() {
            if (errorAlert.style.display === 'flex') {
                errorAlert.style.display = 'none';
            }
        }, 5000);
    }
    
    function showSuccess(message) {
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
        
        // Add demo credential hint
        console.log('Demo credentials: admin@vantix.com / 123456');
    });
    
    // Add Enter key support
    document.getElementById('loginForm').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            handleLogin(event);
        }
    });
</script>
@endsection