@extends('layouts.app')

@section('title', 'VANTIX STAY - Testimonials')

@section('content')
<!-- Hero Section -->
<section class="hero" style="height: 50vh; min-height: 400px;">
    <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1920');"></div>
    <div class="hero-content" data-aos="fade-up">
        <div class="hero-subtitle">WHAT THEY SAY</div>
        <h1>Resident <span>Testimonials</span></h1>
        <p>Discover why our residents love calling Vantix Stay home</p>
    </div>
</section>

<!-- Testimonials Grid -->
<section style="padding: 80px 60px;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto 60px; text-align: center;">
            <h2 style="font-size: 36px; margin-bottom: 20px; background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Voices of Excellence</h2>
            <p style="color: var(--text-secondary);">Hear from our distinguished residents who have experienced the pinnacle of luxury living at Vantix Stay.</p>
        </div>
        
        <div class="testimonials-grid">
            @php
                $testimonials = [
                    [
                        'name' => 'Alexander Chen',
                        'position' => 'CEO, LuxCorp',
                        'rating' => 5,
                        'text' => 'The epitome of luxury living. Every detail is meticulously crafted, and the service is unparalleled. This is not just a residence; it\'s a lifestyle.',
                        'date' => 'February 2025',
                        'image' => 'https://randomuser.me/api/portraits/men/1.jpg'
                    ],
                    [
                        'name' => 'Isabella Rossi',
                        'position' => 'Fashion Designer',
                        'rating' => 5,
                        'text' => 'I\'ve lived in luxury properties worldwide, but Vantix Stay sets a new standard. The attention to detail and privacy is exceptional.',
                        'date' => 'January 2025',
                        'image' => 'https://randomuser.me/api/portraits/women/2.jpg'
                    ],
                    [
                        'name' => 'William Hartono',
                        'position' => 'Investor',
                        'rating' => 5,
                        'text' => 'The perfect blend of sophistication and comfort. The amenities are world-class, and the location is unbeatable. Truly a masterpiece.',
                        'date' => 'December 2024',
                        'image' => 'https://randomuser.me/api/portraits/men/3.jpg'
                    ],
                    [
                        'name' => 'Natasha Kowalski',
                        'position' => 'Art Curator',
                        'rating' => 5,
                        'text' => 'Living here feels like being in a five-star resort every day. The architecture, the service, the community - everything is perfection.',
                        'date' => 'November 2024',
                        'image' => 'https://randomuser.me/api/portraits/women/4.jpg'
                    ],
                    [
                        'name' => 'Michael Tan',
                        'position' => 'Tech Entrepreneur',
                        'rating' => 5,
                        'text' => 'The attention to detail is remarkable. From the concierge service to the facilities, everything exceeds expectations.',
                        'date' => 'October 2024',
                        'image' => 'https://randomuser.me/api/portraits/men/5.jpg'
                    ],
                    [
                        'name' => 'Sarah Wijaya',
                        'position' => 'Executive Director',
                        'rating' => 4,
                        'text' => 'A truly exceptional living experience. The location is perfect, and the team goes above and beyond for residents.',
                        'date' => 'September 2024',
                        'image' => 'https://randomuser.me/api/portraits/women/6.jpg'
                    ]
                ];
            @endphp
            
            @foreach($testimonials as $index => $testimonial)
            <div class="testimonial-item" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                <div class="testimonial-rating">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star" style="color: {{ $i <= $testimonial['rating'] ? '#FFD700' : '#666' }}; font-size: 14px;"></i>
                    @endfor
                </div>
                <p class="testimonial-text">"{{ $testimonial['text'] }}"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}">
                    </div>
                    <div class="author-info">
                        <h4>{{ $testimonial['name'] }}</h4>
                        <p>{{ $testimonial['position'] }}</p>
                        <span class="testimonial-date">{{ $testimonial['date'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Overall Rating Summary -->
        <div class="rating-summary" data-aos="fade-up">
            <div class="rating-score">
                <div class="score-number">4.9</div>
                <div class="score-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="score-text">Average Rating from 200+ Reviews</div>
            </div>
            <div class="rating-bars">
                <div class="rating-bar-item">
                    <span class="rating-label">5 Stars</span>
                    <div class="rating-bar">
                        <div class="rating-bar-fill" style="width: 85%;"></div>
                    </div>
                    <span class="rating-percent">85%</span>
                </div>
                <div class="rating-bar-item">
                    <span class="rating-label">4 Stars</span>
                    <div class="rating-bar">
                        <div class="rating-bar-fill" style="width: 12%;"></div>
                    </div>
                    <span class="rating-percent">12%</span>
                </div>
                <div class="rating-bar-item">
                    <span class="rating-label">3 Stars</span>
                    <div class="rating-bar">
                        <div class="rating-bar-fill" style="width: 2%;"></div>
                    </div>
                    <span class="rating-percent">2%</span>
                </div>
                <div class="rating-bar-item">
                    <span class="rating-label">2 Stars</span>
                    <div class="rating-bar">
                        <div class="rating-bar-fill" style="width: 1%;"></div>
                    </div>
                    <span class="rating-percent">1%</span>
                </div>
                <div class="rating-bar-item">
                    <span class="rating-label">1 Stars</span>
                    <div class="rating-bar">
                        <div class="rating-bar-fill" style="width: 0%;"></div>
                    </div>
                    <span class="rating-percent">0%</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Testimonials Section -->
<section style="padding: 80px 60px; background: var(--bg-secondary);">
    <div class="container">
        <h3 style="font-size: 32px; margin-bottom: 40px; text-align: center; background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Video Testimonials</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px;">
            <div class="video-card" data-aos="fade-up">
                <div class="video-thumbnail">
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800" alt="Video Thumbnail">
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <h4 style="margin-top: 15px;">A Day in The Residence</h4>
                <p style="color: var(--text-secondary);">Take a virtual tour of our luxury facilities</p>
            </div>
            <div class="video-card" data-aos="fade-up" data-aos-delay="50">
                <div class="video-thumbnail">
                    <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800" alt="Video Thumbnail">
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <h4 style="margin-top: 15px;">Resident Experience</h4>
                <p style="color: var(--text-secondary);">Hear directly from our residents</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<div class="cta-section">
    <div class="cta-content" data-aos="zoom-in">
        <h2>Join Our Community</h2>
        <p>Experience the Vantix Stay difference for yourself</p>
        <a href="{{ route('contact') }}" class="btn-dark">SCHEDULE A TOUR</a>
    </div>
</div>

<style>
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }
    
    .testimonial-item {
        background: var(--bg-card);
        border-radius: 20px;
        padding: 30px;
        border: 1px solid var(--border-color);
        transition: all 0.3s;
    }
    
    .testimonial-item:hover {
        transform: translateY(-5px);
        border-color: var(--gold-primary);
        box-shadow: 0 10px 30px rgba(253, 185, 49, 0.1);
    }
    
    .testimonial-rating {
        margin-bottom: 15px;
    }
    
    .testimonial-text {
        font-size: 16px;
        line-height: 1.7;
        color: var(--text-primary);
        margin-bottom: 20px;
        font-style: italic;
    }
    
    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .author-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
    }
    
    .author-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .author-info h4 {
        font-size: 16px;
        margin-bottom: 3px;
    }
    
    .author-info p {
        font-size: 12px;
        color: var(--gold-primary);
        margin-bottom: 3px;
    }
    
    .testimonial-date {
        font-size: 11px;
        color: var(--text-secondary);
    }
    
    .rating-summary {
        background: var(--bg-card);
        border-radius: 20px;
        padding: 40px;
        border: 1px solid var(--border-color);
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 50px;
    }
    
    .score-number {
        font-size: 64px;
        font-weight: 700;
        color: var(--gold-primary);
        line-height: 1;
    }
    
    .score-stars {
        margin: 15px 0 10px;
    }
    
    .score-stars i {
        color: #FFD700;
        font-size: 18px;
    }
    
    .score-text {
        color: var(--text-secondary);
        font-size: 14px;
    }
    
    .rating-bar-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .rating-label {
        width: 70px;
        font-size: 14px;
        color: var(--text-secondary);
    }
    
    .rating-bar {
        flex: 1;
        height: 8px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        overflow: hidden;
    }
    
    .rating-bar-fill {
        height: 100%;
        background: var(--gold-gradient);
        border-radius: 4px;
    }
    
    .rating-percent {
        width: 40px;
        font-size: 14px;
        color: var(--text-secondary);
        text-align: right;
    }
    
    .video-card {
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .video-card:hover {
        transform: translateY(-5px);
    }
    
    .video-thumbnail {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
    }
    
    .video-thumbnail img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: var(--gold-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    
    .play-button i {
        color: #0A0A0A;
        font-size: 24px;
        margin-left: 5px;
    }
    
    .video-card:hover .play-button {
        transform: translate(-50%, -50%) scale(1.1);
    }
    
    @media (max-width: 768px) {
        section {
            padding: 60px 20px !important;
        }
        
        .testimonials-grid {
            grid-template-columns: 1fr;
        }
        
        .rating-summary {
            grid-template-columns: 1fr;
            gap: 30px;
            padding: 25px;
        }
        
        .score-number {
            font-size: 48px;
        }
    }
</style>
@endsection