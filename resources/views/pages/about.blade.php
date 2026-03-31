@extends('layouts.app')

@section('title', 'VANTIX STAY - About Us')

@section('content')
<!-- Hero Section -->
<section class="hero" style="height: 50vh; min-height: 400px;">
    <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1920');"></div>
    <div class="hero-content" data-aos="fade-up">
        <div class="hero-subtitle">OUR STORY</div>
        <h1>About <span>Vantix Stay</span></h1>
        <p>Discover the legacy behind the pinnacle of luxury living</p>
    </div>
</section>

<!-- About Content -->
<section style="padding: 80px 60px;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 48px; margin-bottom: 30px; background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Redefining Luxury Living</h2>
            <p style="color: var(--text-secondary); line-height: 1.8; margin-bottom: 40px;">Founded in 2024, Vantix Stay has emerged as the epitome of sophisticated urban living. Our commitment to excellence and attention to detail sets us apart as the premier choice for discerning residents who seek nothing but the finest.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 50px; margin-top: 60px;">
            <div data-aos="fade-right">
                <h3 style="font-size: 28px; margin-bottom: 20px; color: var(--gold-primary);">Our Mission</h3>
                <p style="color: var(--text-secondary); line-height: 1.8;">To provide unparalleled luxury living experiences that exceed the expectations of the world's most discerning individuals. We strive to create spaces that inspire, comfort, and elevate the human spirit.</p>
            </div>
            <div data-aos="fade-left">
                <h3 style="font-size: 28px; margin-bottom: 20px; color: var(--gold-primary);">Our Vision</h3>
                <p style="color: var(--text-secondary); line-height: 1.8;">To become the most sought-after luxury residence brand in Southeast Asia, setting new standards in hospitality, design, and personalized service.</p>
            </div>
        </div>
        
        <div style="margin-top: 80px;">
            <h3 style="font-size: 32px; margin-bottom: 40px; text-align: center; background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Our Core Values</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                <div class="value-card" data-aos="fade-up" data-aos-delay="0">
                    <i class="fas fa-crown" style="font-size: 48px; color: var(--gold-primary); margin-bottom: 20px; display: inline-block;"></i>
                    <h4 style="font-size: 22px; margin-bottom: 15px;">Excellence</h4>
                    <p style="color: var(--text-secondary);">We pursue perfection in every detail, from design to service delivery.</p>
                </div>
                <div class="value-card" data-aos="fade-up" data-aos-delay="50">
                    <i class="fas fa-gem" style="font-size: 48px; color: var(--gold-primary); margin-bottom: 20px; display: inline-block;"></i>
                    <h4 style="font-size: 22px; margin-bottom: 15px;">Integrity</h4>
                    <p style="color: var(--text-secondary);">We operate with transparency, honesty, and ethical principles.</p>
                </div>
                <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-lightbulb" style="font-size: 48px; color: var(--gold-primary); margin-bottom: 20px; display: inline-block;"></i>
                    <h4 style="font-size: 22px; margin-bottom: 15px;">Innovation</h4>
                    <p style="color: var(--text-secondary);">We embrace cutting-edge technology and design concepts.</p>
                </div>
                <div class="value-card" data-aos="fade-up" data-aos-delay="150">
                    <i class="fas fa-heart" style="font-size: 48px; color: var(--gold-primary); margin-bottom: 20px; display: inline-block;"></i>
                    <h4 style="font-size: 22px; margin-bottom: 15px;">Service</h4>
                    <p style="color: var(--text-secondary);">We prioritize our residents' needs with genuine care and attention.</p>
                </div>
            </div>
        </div>
        
        <!-- Stats Section -->
        <div style="margin-top: 100px; display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; text-align: center;">
            <div class="stat-item" data-aos="fade-up">
                <div class="stat-number" style="font-size: 48px; font-weight: 700; color: var(--gold-primary);">5+</div>
                <div class="stat-label" style="color: var(--text-secondary);">Luxury Properties</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="50">
                <div class="stat-number" style="font-size: 48px; font-weight: 700; color: var(--gold-primary);">200+</div>
                <div class="stat-label" style="color: var(--text-secondary);">Happy Residents</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-number" style="font-size: 48px; font-weight: 700; color: var(--gold-primary);">24/7</div>
                <div class="stat-label" style="color: var(--text-secondary);">Concierge Service</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="150">
                <div class="stat-number" style="font-size: 48px; font-weight: 700; color: var(--gold-primary);">100%</div>
                <div class="stat-label" style="color: var(--text-secondary);">Satisfaction Rate</div>
            </div>
        </div>
        
        <!-- Leadership Team -->
        <div style="margin-top: 100px;">
            <h3 style="font-size: 32px; margin-bottom: 40px; text-align: center; background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Leadership Team</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px;">
                <div class="team-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="team-avatar" style="width: 180px; height: 180px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; border: 3px solid var(--gold-primary);">
                        <img src="https://randomuser.me/api/portraits/men/10.jpg" alt="James Anderson" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <h4 style="font-size: 22px; margin-bottom: 5px;">James Anderson</h4>
                    <p style="color: var(--gold-primary); margin-bottom: 15px;">CEO & Founder</p>
                    <p style="color: var(--text-secondary);">20+ years experience in luxury real estate development.</p>
                </div>
                <div class="team-card" data-aos="fade-up" data-aos-delay="50">
                    <div class="team-avatar" style="width: 180px; height: 180px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; border: 3px solid var(--gold-primary);">
                        <img src="https://randomuser.me/api/portraits/women/10.jpg" alt="Maria Gonzalez" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <h4 style="font-size: 22px; margin-bottom: 5px;">Maria Gonzalez</h4>
                    <p style="color: var(--gold-primary); margin-bottom: 15px;">Head of Operations</p>
                    <p style="color: var(--text-secondary);">Expert in luxury hospitality management.</p>
                </div>
                <div class="team-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-avatar" style="width: 180px; height: 180px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; border: 3px solid var(--gold-primary);">
                        <img src="https://randomuser.me/api/portraits/men/11.jpg" alt="David Chen" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <h4 style="font-size: 22px; margin-bottom: 5px;">David Chen</h4>
                    <p style="color: var(--gold-primary); margin-bottom: 15px;">Chief Architect</p>
                    <p style="color: var(--text-secondary);">Award-winning architect with international portfolio.</p>
                </div>
                <div class="team-card" data-aos="fade-up" data-aos-delay="150">
                    <div class="team-avatar" style="width: 180px; height: 180px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; border: 3px solid var(--gold-primary);">
                        <img src="https://randomuser.me/api/portraits/women/11.jpg" alt="Sofia Wijaya" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <h4 style="font-size: 22px; margin-bottom: 5px;">Sofia Wijaya</h4>
                    <p style="color: var(--gold-primary); margin-bottom: 15px;">Interior Design Director</p>
                    <p style="color: var(--text-secondary);">Renowned for creating timeless luxury interiors.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<div class="cta-section">
    <div class="cta-content" data-aos="zoom-in">
        <h2>Experience The Extraordinary</h2>
        <p>Schedule a private tour of our exclusive residences</p>
        <a href="{{ route('contact') }}" class="btn-dark">INQUIRE NOW</a>
    </div>
</div>

<style>
    .value-card, .team-card {
        text-align: center;
        padding: 30px 20px;
        background: var(--bg-card);
        border-radius: 20px;
        border: 1px solid var(--border-color);
        transition: all 0.3s;
    }
    
    .value-card:hover, .team-card:hover {
        transform: translateY(-10px);
        border-color: var(--gold-primary);
        box-shadow: 0 10px 30px rgba(253, 185, 49, 0.15);
    }
    
    .stat-item {
        padding: 20px;
        background: var(--bg-card);
        border-radius: 16px;
        border: 1px solid var(--border-color);
    }
    
    @media (max-width: 768px) {
        section {
            padding: 60px 20px !important;
        }
        
        .stat-item {
            padding: 15px;
        }
        
        .stat-number {
            font-size: 32px !important;
        }
    }
</style>
@endsection
