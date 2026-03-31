@extends('layouts.app')

@section('title', 'VANTIX STAY - Home')

@section('content')
<!-- Hero Section -->
<section id="home" class="hero">
    <div class="hero-bg"></div>
    <div class="hero-content" data-aos="fade-up" data-aos-duration="1500">
        <div class="hero-subtitle">SINCE 2024</div>
        <h1>Where <span>Luxury</span><br>Meets Elegance</h1>
        <p>Experience the pinnacle of sophisticated living in the heart of the city.<br>Curated for those who appreciate the finest things in life.</p>
        <a href="#apartments" class="btn-gold">DISCOVER MORE</a>
        <a href="#contact" class="btn-outline-gold">INQUIRE NOW</a>
    </div>
    <div class="scroll-indicator">
    <div class="arrow-down">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
</section>

<!-- Apartments Section -->
<section id="apartments">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Exclusive Residences</h2>
        <p class="section-subtitle" data-aos="fade-up">Crafted for the discerning few</p>
        
        <div class="apartments-grid">
            @php
                $apartments = [
                    ['name' => 'The Grand Suite', 'price' => 'Rp 1.8M', 'bed' => 3, 'bath' => 3, 'size' => '185m²', 'img' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800'],
                    ['name' => 'The Royal Penthouse', 'price' => 'Rp 3.2M', 'bed' => 4, 'bath' => 5, 'size' => '320m²', 'img' => 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=800'],
                    ['name' => 'The Presidential', 'price' => 'Rp 5.5M', 'bed' => 5, 'bath' => 6, 'size' => '450m²', 'img' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800']
                ];
            @endphp
            
            @foreach($apartments as $index => $apt)
            <div class="apartment-card" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                <div class="card-image">
                    <img src="{{ $apt['img'] }}" alt="{{ $apt['name'] }}">
                    <div class="card-badge">EXCLUSIVE</div>
                </div>
                <div class="card-content">
                    <h3>{{ $apt['name'] }}</h3>
                    <div class="price">{{ $apt['price'] }} <span>/ annum</span></div>
                    <div class="features">
                        <span><i class="fas fa-bed"></i> {{ $apt['bed'] }} Bedrooms</span>
                        <span><i class="fas fa-bath"></i> {{ $apt['bath'] }} Bathrooms</span>
                        <span><i class="fas fa-expand"></i> {{ $apt['size'] }}</span>
                    </div>
                    <a href="{{ route('property.detail', $index + 1) }}" class="btn-gold" style="width: 100%; text-align: center;">VIEW DETAILS</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section id="facilities">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">World-Class Amenities</h2>
        <p class="section-subtitle" data-aos="fade-up">Designed for the extraordinary lifestyle</p>
        
        <div class="facilities-grid">
            @php
                $facilities = [
                    ['icon' => 'fas fa-water', 'name' => 'Infinity Edge Pool', 'desc' => '75ft sky pool with panoramic city views'],
                    ['icon' => 'fas fa-dumbbell', 'name' => 'Private Fitness Center', 'desc' => 'State-of-the-art equipment with personal trainers'],
                    ['icon' => 'fas fa-spa', 'name' => 'Luxury Spa & Wellness', 'desc' => 'Full-service spa with treatment rooms'],
                    ['icon' => 'fas fa-champagne-glasses', 'name' => 'Private Lounge', 'desc' => 'Members-only club with curated experiences'],
                    ['icon' => 'fas fa-concierge-bell', 'name' => '24K Concierge', 'desc' => 'White-glove service for every need'],
                    ['icon' => 'fas fa-car', 'name' => 'Valet Parking', 'desc' => 'Chauffeur-driven luxury fleet']
                ];
            @endphp
            
            @foreach($facilities as $index => $facility)
            <div class="facility-item" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                <i class="{{ $facility['icon'] }}"></i>
                <h3>{{ $facility['name'] }}</h3>
                <p>{{ $facility['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="testimonials-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Resident Testimonials</h2>
        <p class="section-subtitle" data-aos="fade-up">What our distinguished residents say</p>
        
        <div class="swiper testimonials-slider" data-aos="fade-up">
            <div class="swiper-wrapper">
                @php
                    $testimonials = [
                        ['name' => 'Alexander Chen', 'position' => 'CEO, LuxCorp', 'text' => 'The epitome of luxury living. Every detail is meticulously crafted, and the service is unparalleled. This is not just a residence; it\'s a lifestyle.'],
                        ['name' => 'Isabella Rossi', 'position' => 'Fashion Designer', 'text' => 'I\'ve lived in luxury properties worldwide, but Vantix Stay sets a new standard. The attention to detail and privacy is exceptional.'],
                        ['name' => 'William Hartono', 'position' => 'Investor', 'text' => 'The perfect blend of sophistication and comfort. The amenities are world-class, and the location is unbeatable. Truly a masterpiece.'],
                        ['name' => 'Natasha Kowalski', 'position' => 'Art Curator', 'text' => 'Living here feels like being in a five-star resort every day. The architecture, the service, the community - everything is perfection.']
                    ];
                @endphp
                
                @foreach($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <p class="testimonial-text">"{{ $testimonial['text'] }}"</p>
                        <div class="client-info">
                            <h4>{{ $testimonial['name'] }}</h4>
                            <p>{{ $testimonial['position'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<div class="cta-section">
    <div class="cta-content" data-aos="zoom-in">
        <h2>Experience The Extraordinary</h2>
        <p>Schedule a private tour of our exclusive residences</p>
        <a href="#contact" class="btn-dark">INQUIRE NOW</a>
    </div>
</div>
@endsection