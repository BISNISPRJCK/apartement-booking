@extends('layouts.app')

@section('title', 'Vantix Stay - Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg" style="background-image: url('{{ asset('images/hero-bg.jpg') }}')"></div>
    <div class="hero-content">
        <h1 class="hero-title">Selamat Datang di Vantix Stay</h1>
        <p class="hero-subtitle">Temukan apartemen modern dan nyaman untuk pengalaman menginap yang lebih menyenangkan</p>
        
        <form action="{{ route('property') }}" method="GET" class="search-box">
            <div class="search-icon">
                <svg width="40" height="50" viewBox="0 0 40 50" fill="none">
                    <path d="M18.3333 31.6667C25.6971 31.6667 31.6667 25.6971 31.6667 18.3333C31.6667 10.9695 25.6971 5 18.3333 5C10.9695 5 5 10.9695 5 18.3333C5 25.6971 10.9695 31.6667 18.3333 31.6667Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M35 35L27.75 27.75" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <input type="text" name="search" class="search-input" placeholder="Cari apartemen..." value="{{ request('search') }}">
        </form>
    </div>
</section>

<!-- Explore Apartment Types -->
<section class="explore-section">
    <h2 class="explore-title">Explore Apartment Types</h2>
    <div class="apartment-types">
        @foreach($apartmentTypes as $type)
        <a href="{{ route('property', ['type' => strtolower($type['name'])]) }}" class="type-card">
            <div class="type-icon">
                @include("icons.{$type['icon']}")
            </div>
            <span class="type-name">{{ $type['name'] }}</span>
            <span class="type-properties">{{ $type['count'] }} Properties</span>
        </a>
        @endforeach
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="about-content">
        <div class="about-text">
            <h3 class="about-title">Vantix Stay</h3>
            <p class="about-description">Morem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus.</p>
        </div>
        <div class="about-image1" style="background-image: url('{{ asset('images/about-1.jpg') }}')"></div>
        <div class="about-image2" style="background-image: url('{{ asset('images/about-2.jpg') }}')"></div>
        <div class="about-text2">
            <h3 class="about-title">Vantix Stay</h3>
            <p class="about-description">Morem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus.</p>
        </div>
    </div>
</section>

<!-- Our Packages -->
<section class="packages-section">
    <div class="packages-header">
        <h2 class="packages-title">Our Packages</h2>
        <div class="packages-divider"></div>
    </div>
    
    <div class="packages-container">
        @forelse($properties as $property)
        <div class="package-card">
            <div class="card-bg">
                <div class="card-image" style="background-image: url('{{ asset('storage/' . $property->image) }}')"></div>
                <div class="card-content">
                    <span class="card-type">{{ $property->type }}</span>
                    <h3 class="card-name">{{ $property->title }}</h3>
                    <p class="card-price">Price IDR {{ number_format($property->price_min) }} - {{ number_format($property->price_max) }}</p>
                    <a href="{{ route('property.detail', $property->id) }}" class="view-detail-btn">View Detail</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-8">
            <p class="text-gray-500">Belum ada properti tersedia.</p>
        </div>
        @endforelse
    </div>
    
    <div class="packages-dots">
        <span class="dot dot-inactive"></span>
        <span class="dot dot-active"></span>
        <span class="dot dot-inactive"></span>
    </div>
</section>

<!-- Availability Section -->
<section class="availability-section">
    <div class="availability-box">
        <h2 class="availability-title">Available At</h2>
        <p class="cities">{{ implode(' | ', $cities) }}</p>
        <a href="{{ route('contact') }}" class="contact-btn">Contact Us</a>
    </div>
</section>

<!-- Testimoni Section -->
<section class="testimoni-section">
    <div class="testimoni-header">
        <h2 class="testimoni-title">Our Testimoni</h2>
        <p class="testimoni-subtitle">Jorem ipsum dolor sit amet consectetur Jorem ipsum dolor sit amet consecteturJorem ipsum</p>
    </div>
    
    <div class="testimoni-container">
        @forelse($testimonials as $testimonial)
        <div class="testimoni-card">
            <div class="testimoni-avatar" style="background-image: url('{{ asset('storage/' . $testimonial->avatar) }}')"></div>
            <h4 class="testimoni-name">{{ $testimonial->name }}</h4>
            <p class="testimoni-city">{{ $testimonial->city }}</p>
            <div class="testimoni-rating">
                @for($i = 1; $i <= 5; $i++)
                    <span class="star {{ $i <= $testimonial->rating ? 'active' : '' }}"></span>
                @endfor
            </div>
            <p class="testimoni-text">{{ $testimonial->message }}</p>
        </div>
        @empty
        <div class="col-span-3 text-center py-8">
            <p class="text-gray-500">Belum ada testimoni.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="faq-container">
        <h2 class="faq-title">Popular Question</h2>
        <div class="faq-list">
            @forelse($faqs as $faq)
            <div class="faq-item" onclick="toggleFaq({{ $faq->id }})">
                <span class="faq-question">{{ $faq->question }}</span>
                <span class="faq-icon" id="faq-icon-{{ $faq->id }}"></span>
                <div class="faq-answer" id="faq-answer-{{ $faq->id }}" style="display: none;">
                    {{ $faq->answer }}
                </div>
            </div>
            @empty
            <div class="text-center py-8">
                <p class="text-gray-500">Belum ada FAQ.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="contact-wrapper">
        <div class="contact-info">
            <div class="info-left">
                <h2 class="info-title">Get in Touch</h2>
                <p class="info-description">Yorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Etiam eu turpis molestie, dictum est a, mattis tellus. Etiam eu turpis molestie, dictum est a, mattis tellus.</p>
                
                <div class="contact-details">
                    <div class="contact-detail-item">
                        <div class="detail-icon">
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                                <path d="M31.5 26.25V31.5C31.5 32.4946 31.1049 33.4484 30.4017 34.1517C29.6984 34.8549 28.7446 35.25 27.75 35.25C23.2862 34.8426 19.0128 33.2222 15.3975 30.555C12.0431 28.1122 9.38778 24.8786 7.74 21.1125C5.78836 16.7383 5.08952 11.898 5.7375 7.14C5.82068 6.48993 6.09074 5.87994 6.51008 5.3826C6.92942 4.88526 7.47679 4.52388 8.0925 4.3425C8.70821 4.16112 9.3635 4.16788 9.97573 4.36192C10.588 4.55596 11.1286 4.92874 11.538 5.4345L15.5925 10.4475C15.9812 10.9454 16.2056 11.5556 16.2308 12.1917C16.2559 12.8278 16.0805 13.4537 15.735 13.98L13.9125 16.8C13.6775 17.1569 13.546 17.5735 13.5339 18.0028C13.5218 18.4321 13.6296 18.8549 13.845 19.224C15.1886 21.6621 17.0579 23.7675 19.32 25.41C20.1825 26.0625 21.24 26.25 22.26 25.83L25.38 24.675C25.9219 24.4819 26.5088 24.4512 27.0669 24.5863C27.625 24.7215 28.1275 25.0162 28.5075 25.4325L33.075 30.45C33.5486 30.9779 33.8309 31.6527 33.8682 32.3647C33.9055 33.0767 33.695 33.7775 33.2775 34.35C32.7634 35.0386 32.0771 35.5894 31.2908 35.9459C30.5044 36.3024 29.644 36.4524 28.785 36.3825" stroke="#222A3A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="detail-text">{{ setting('phone', '(123) 546 8972') }}</span>
                    </div>
                    
                    <div class="contact-detail-item">
                        <div class="detail-icon">
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                                <path d="M5.25 8.75H36.75V31.5C36.75 32.4946 36.3549 33.4484 35.6517 34.1517C34.9484 34.8549 33.9946 35.25 33 35.25H9C8.00544 35.25 7.05161 34.8549 6.34835 34.1517C5.64509 33.4484 5.25 32.4946 5.25 31.5V8.75Z" stroke="#222A3A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M36.75 8.75L21 22.75L5.25 8.75" stroke="#222A3A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="detail-text">{{ setting('email', 'vantix@gmail.com') }}</span>
                    </div>
                    
                    <div class="contact-detail-item">
                        <div class="detail-icon">
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                                <path d="M21 3.5C17.6848 3.5 14.5054 4.81741 12.1614 7.16141C9.81741 9.50541 8.5 12.6848 8.5 16C8.5 25.25 21 38.5 21 38.5C21 38.5 33.5 25.25 33.5 16C33.5 12.6848 32.1826 9.50541 29.8386 7.16141C27.4946 4.81741 24.3152 3.5 21 3.5Z" stroke="#222A3A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 21C23.7614 21 26 18.7614 26 16C26 13.2386 23.7614 11 21 11C18.2386 11 16 13.2386 16 16C16 18.7614 18.2386 21 21 21Z" stroke="#222A3A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="detail-text">{{ setting('address', 'Kota Bandung, Jawa Barat') }}</span>
                    </div>
                    
                    <div class="contact-detail-item">
                        <div class="detail-icon">
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                                <path d="M31.5 7H10.5C8.84315 7 7.5 8.34315 7.5 10V32C7.5 33.6569 8.84315 35 10.5 35H31.5C33.1569 35 34.5 33.6569 34.5 32V10C34.5 8.34315 33.1569 7 31.5 7Z" stroke="#222A3A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15 14H27" stroke="#222A3A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15 21H27" stroke="#222A3A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15 28H21" stroke="#222A3A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="detail-text">{{ setting('website', 'www.vantix.com') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="info-right">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.6091242787!2d107.56074691445679!3d-6.903274578666488!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid"
                    width="100%"
                    height="100%"
                    style="border:0; border-radius: 8px;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </div>
        
        <div class="form-section">
            <h3 class="form-title">Send us a message</h3>
            
            @if(session('success'))
                <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" 
                               name="name" 
                               class="form-input @error('name') is-invalid @enderror" 
                               placeholder="Your name"
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" 
                               name="email" 
                               class="form-input @error('email') is-invalid @enderror" 
                               placeholder="Email Address"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <input type="tel" 
                               name="phone" 
                               class="form-input @error('phone') is-invalid @enderror" 
                               placeholder="Phone"
                               value="{{ old('phone') }}"
                               required>
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" 
                               name="subject" 
                               class="form-input @error('subject') is-invalid @enderror" 
                               placeholder="Subject"
                               value="{{ old('subject') }}"
                               required>
                        @error('subject')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <textarea name="message" 
                          class="form-textarea @error('message') is-invalid @enderror" 
                          placeholder="Message"
                          required>{{ old('message') }}</textarea>
                @error('message')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                
                <button type="submit" class="send-btn">Send message</button>
            </form>
        </div>
    </div>
</section>

<!-- Supported By -->
<section class="supported-section">
    <div class="supported-box">
        <h3 class="supported-title">Supported By</h3>
        <div class="supported-logos">
            @for($i = 1; $i <= 5; $i++)
                <div class="logo-circle" style="background-image: url('{{ asset('images/partner-' . $i . '.png') }}')"></div>
            @endfor
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function toggleFaq(id) {
    const answer = document.getElementById('faq-answer-' + id);
    const icon = document.getElementById('faq-icon-' + id);
    
    if (answer.style.display === 'none') {
        answer.style.display = 'block';
        icon.classList.add('active');
    } else {
        answer.style.display = 'none';
        icon.classList.remove('active');
    }
}

// Auto-hide alert after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
    }
});
</script>
@endpush