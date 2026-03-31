@extends('layouts.app')

@section('title', 'VANTIX STAY - Contact')

@section('content')
<!-- Hero Section -->
<section class="hero" style="height: 50vh; min-height: 400px;">
    <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1920');"></div>
    <div class="hero-content" data-aos="fade-up">
        <div class="hero-subtitle">GET IN TOUCH</div>
        <h1>Contact <span>Us</span></h1>
        <p>Our concierge team is ready to assist you 24/7</p>
    </div>
</section>

<!-- Contact Section -->
<section style="padding: 80px 60px;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px;">
            <!-- Contact Info -->
            <div>
                <h2 style="font-size: 36px; margin-bottom: 20px; background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Let's Talk</h2>
                <p style="color: var(--text-secondary); line-height: 1.8; margin-bottom: 40px;">Have questions about our residences? Our team is here to help. Fill out the form and we'll get back to you within 24 hours.</p>
                
                <div class="contact-info-list">
                    <div class="contact-item" data-aos="fade-right">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4>Visit Us</h4>
                            <p>Jalan Jenderal Sudirman Kav. 52-53, Jakarta 12190</p>
                        </div>
                    </div>
                    
                    <div class="contact-item" data-aos="fade-right" data-aos-delay="50">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4>Call Us</h4>
                            <p>+62 21 5080 8888</p>
                            <p>+62 811 8888 1234 (WhatsApp)</p>
                        </div>
                    </div>
                    
                    <div class="contact-item" data-aos="fade-right" data-aos-delay="100">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4>Email Us</h4>
                            <p>concierge@vantixstay.com</p>
                            <p>reservations@vantixstay.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item" data-aos="fade-right" data-aos-delay="150">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4>Visiting Hours</h4>
                            <p>Monday - Friday: 09:00 - 20:00</p>
                            <p>Saturday: 10:00 - 18:00</p>
                            <p>Sunday: By Appointment Only</p>
                            <p style="color: var(--gold-primary); margin-top: 10px;">Private Viewing Available</p>
                        </div>
                    </div>
                </div>
                
                <div class="social-media" data-aos="fade-up">
                    <h4>Follow Us</h4>
                    <div class="social-links-contact">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form-wrapper" data-aos="fade-left">
                <h3 style="font-size: 28px; margin-bottom: 30px;">Send us a message</h3>
                
                @if(session('success'))
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert-error">
                        @foreach($errors->all() as $error)
                            <p><i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <textarea name="message" class="form-control" placeholder="Your Message" rows="5" required>{{ old('message') }}</textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">SEND MESSAGE</button>
                </form>
            </div>
        </div>
        
        <!-- Map Section -->
        <div style="margin-top: 80px;" data-aos="fade-up">
            <h3 style="font-size: 28px; margin-bottom: 30px; text-align: center;">Find Us</h3>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521123456789!2d107.56074691445679!3d-6.903274578666488!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid"
                    width="100%"
                    height="400"
                    style="border:0; border-radius: 16px;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section style="padding: 80px 60px; background: var(--bg-secondary);">
    <div class="container">
        <h3 style="font-size: 32px; margin-bottom: 40px; text-align: center; background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Frequently Asked Questions</h3>
        <div style="max-width: 800px; margin: 0 auto;">
            <div class="faq-item" data-aos="fade-up">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>What is the minimum lease period?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>The minimum lease period is 12 months for all residences. For the Presidential Suite, we offer flexible terms starting from 6 months.</p>
                </div>
            </div>
            
            <div class="faq-item" data-aos="fade-up" data-aos-delay="50">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Are pets allowed?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Yes, we welcome pets in select residences. Additional terms and conditions apply, including a pet deposit.</p>
                </div>
            </div>
            
            <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>What amenities are included?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>All residents have access to our world-class amenities including infinity pool, fitness center, spa, private lounge, and 24/7 concierge service.</p>
                </div>
            </div>
            
            <div class="faq-item" data-aos="fade-up" data-aos-delay="150">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Is parking available?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Yes, each residence comes with dedicated parking spaces. Valet service is also available 24/7.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .contact-info-list {
        margin-bottom: 40px;
    }
    
    .contact-item {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        padding: 15px;
        background: var(--bg-card);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        transition: all 0.3s;
    }
    
    .contact-item:hover {
        transform: translateX(10px);
        border-color: var(--gold-primary);
    }
    
    .contact-icon {
        width: 50px;
        height: 50px;
        background: rgba(253, 185, 49, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .contact-icon i {
        font-size: 24px;
        color: var(--gold-primary);
    }
    
    .contact-item h4 {
        font-size: 18px;
        margin-bottom: 8px;
    }
    
    .contact-item p {
        color: var(--text-secondary);
        font-size: 14px;
        margin-bottom: 5px;
    }
    
    .social-media h4 {
        font-size: 18px;
        margin-bottom: 15px;
    }
    
    .social-links-contact {
        display: flex;
        gap: 15px;
    }
    
    .social-links-contact a {
        width: 45px;
        height: 45px;
        background: var(--bg-card);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold-primary);
        font-size: 20px;
        transition: all 0.3s;
        border: 1px solid var(--border-color);
    }
    
    .social-links-contact a:hover {
        background: var(--gold-gradient);
        color: #0A0A0A;
        transform: translateY(-3px);
    }
    
    .contact-form-wrapper {
        background: var(--bg-card);
        padding: 40px;
        border-radius: 24px;
        border: 1px solid var(--border-color);
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-group {
        width: 100%;
    }
    
    .form-control {
        width: 100%;
        padding: 14px 16px;
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        color: var(--text-primary);
        font-family: 'Montserrat', sans-serif;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--gold-primary);
        box-shadow: 0 0 10px rgba(253, 185, 49, 0.2);
    }
    
    .form-control::placeholder {
        color: var(--text-secondary);
    }
    
    textarea.form-control {
        resize: vertical;
        margin-bottom: 20px;
    }
    
    .submit-btn {
        width: 100%;
        padding: 16px;
        background: var(--gold-gradient);
        border: none;
        border-radius: 12px;
        color: #0A0A0A;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(253, 185, 49, 0.4);
    }
    
    .alert-success {
        background: rgba(76, 175, 80, 0.2);
        border: 1px solid #4CAF50;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        color: #4CAF50;
    }
    
    .alert-error {
        background: rgba(244, 67, 54, 0.2);
        border: 1px solid #f44336;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        color: #f44336;
    }
    
    .faq-item {
        background: var(--bg-card);
        border-radius: 12px;
        margin-bottom: 15px;
        border: 1px solid var(--border-color);
        overflow: hidden;
    }
    
    .faq-question {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .faq-question:hover {
        background: rgba(253, 185, 49, 0.05);
    }
    
    .faq-question i {
        transition: transform 0.3s;
    }
    
    .faq-question.active i {
        transform: rotate(180deg);
    }
    
    .faq-answer {
        padding: 0 20px;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s;
        color: var(--text-secondary);
        line-height: 1.6;
    }
    
    .faq-answer.show {
        padding: 0 20px 20px;
        max-height: 200px;
    }
    
    .map-container {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }
    
    @media (max-width: 768px) {
        section {
            padding: 60px 20px !important;
        }
        
        .contact-form-wrapper {
            padding: 25px;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    function toggleFaq(element) {
        element.classList.toggle('active');
        const answer = element.nextElementSibling;
        answer.classList.toggle('show');
    }
</script>
@endsection