@extends('layouts.app')

@section('title', 'VANTIX STAY - Properties')

@section('content')
<!-- Hero Section -->
<section class="hero" style="height: 50vh; min-height: 400px;">
    <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1920');"></div>
    <div class="hero-content" data-aos="fade-up">
        <div class="hero-subtitle">EXCLUSIVE COLLECTION</div>
        <h1>Our <span>Properties</span></h1>
        <p>Discover our curated collection of ultra-luxury residences</p>
    </div>
</section>

<!-- Filter Section -->
<section style="padding: 60px 60px 0;">
    <div class="container">
        <form action="{{ route('property') }}" method="GET" class="filter-form">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <input type="text" name="search" class="form-input" placeholder="Search residences..." value="{{ request('search') }}" style="padding: 15px; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; color: var(--text-primary);">
                
                <select name="type" class="form-select" style="padding: 15px; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; color: var(--text-primary);">
                    <option value="">All Types</option>
                    @foreach($apartmentTypes as $type)
                        <option value="{{ strtolower($type['name']) }}" {{ request('type') == strtolower($type['name']) ? 'selected' : '' }}>{{ $type['name'] }}</option>
                    @endforeach
                </select>
                
                <select name="price_range" class="form-select" style="padding: 15px; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; color: var(--text-primary);">
                    <option value="">All Prices</option>
                    <option value="0-2000000" {{ request('price_range') == '0-2000000' ? 'selected' : '' }}>Under Rp 2M</option>
                    <option value="2000000-4000000" {{ request('price_range') == '2000000-4000000' ? 'selected' : '' }}>Rp 2M - Rp 4M</option>
                    <option value="4000000-6000000" {{ request('price_range') == '4000000-6000000' ? 'selected' : '' }}>Rp 4M - Rp 6M</option>
                    <option value="6000000-999999999" {{ request('price_range') == '6000000-999999999' ? 'selected' : '' }}>Above Rp 6M</option>
                </select>
                
                <select name="sort" class="form-select" style="padding: 15px; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; color: var(--text-primary);">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
                
                <button type="submit" class="btn-gold" style="padding: 15px;">APPLY FILTERS</button>
                <a href="{{ route('property') }}" class="btn-outline-gold" style="display: flex; align-items: center; justify-content: center;">RESET</a>
            </div>
        </form>
    </div>
</section>

<!-- Properties Grid -->
<section style="padding: 60px;">
    <div class="container">
        <div class="apartments-grid">
            @forelse($properties as $property)
            <div class="apartment-card" data-aos="fade-up">
                <div class="card-image">
                    <img src="{{ $property->image }}" alt="{{ $property->title }}">
                    @if($property->is_popular)
                        <div class="card-badge">POPULAR</div>
                    @endif
                </div>
                <div class="card-content">
                    <h3>{{ $property->title }}</h3>
                    <div class="price">Rp {{ number_format($property->price_min / 1000000, 1) }}M <span>/ annum</span></div>
                    <div class="features">
                        <span><i class="fas fa-bed"></i> {{ $property->bedroom }} Beds</span>
                        <span><i class="fas fa-bath"></i> {{ $property->bathroom }} Baths</span>
                        <span><i class="fas fa-expand"></i> {{ $property->area }}m²</span>
                    </div>
                    <button onclick="openModal({{ json_encode($property) }})" class="btn-gold" style="width: 100%; text-align: center; cursor: pointer;">VIEW DETAILS</button>
                </div>
            </div>
            @empty
            <div style="text-align: center; grid-column: 1/-1; padding: 60px;">
                <i class="fas fa-building" style="font-size: 60px; color: var(--gold-primary); margin-bottom: 20px; display: inline-block;"></i>
                <h3>No Residences Found</h3>
                <p>Please try different search criteria</p>
                <a href="{{ route('property') }}" class="btn-gold" style="margin-top: 20px; display: inline-block;">VIEW ALL</a>
            </div>
            @endforelse
        </div>
        
        @if($properties->hasPages())
        <div style="margin-top: 50px; display: flex; justify-content: center;">
            {{ $properties->links() }}
        </div>
        @endif
    </div>
</section>

<!-- Modal Popup -->
<div id="propertyModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <button class="modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-left">
                <img id="modalImage" src="" alt="Property" class="modal-image">
                <div class="modal-description">
                    <h4>Description</h4>
                    <p id="modalDescription"></p>
                </div>
            </div>
            <div class="modal-right">
                <div class="modal-type">
                    <span id="modalType"></span>
                </div>
                <h2 id="modalTitle" class="modal-title"></h2>
                <div class="modal-location">
                    <i class="fas fa-map-marker-alt"></i>
                    <span id="modalLocation"></span>
                </div>
                
                <div class="modal-features">
                    <h4>Hotel Features</h4>
                    <div class="features-grid">
                        <div class="feature-item">
                            <i class="fas fa-wifi"></i>
                            <span>Free Wi-Fi</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-bed"></i>
                            <span>King Bed</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-hot-tub"></i>
                            <span>Bathtub</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-swimming-pool"></i>
                            <span>Swimming Pool</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-mug-hot"></i>
                            <span>Coffee Maker</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-tv"></i>
                            <span>Smart TV</span>
                        </div>
                    </div>
                </div>
                
                <div class="modal-price">
                    <h4>Price</h4>
                    <p id="modalPrice"></p>
                </div>
                
                <div class="modal-booking">
                    <div class="booking-dates">
                        <div class="date-box">
                            <label>Check in</label>
                            <input type="date" id="checkIn" class="date-input" value="2026-12-12">
                        </div>
                        <div class="date-box">
                            <label>Check Out</label>
                            <input type="date" id="checkOut" class="date-input" value="2026-12-24">
                        </div>
                    </div>
                    <div class="guest-box">
                        <label>Guest</label>
                        <select id="guestCount" class="guest-select">
                            <option value="1">1 Guest</option>
                            <option value="2" selected>2 Guest</option>
                            <option value="3">3 Guest</option>
                            <option value="4">4 Guest</option>
                            <option value="5">5 Guest</option>
                            <option value="6">6 Guest</option>
                        </select>
                    </div>
                    <button class="booking-now-modal" onclick="bookNow()">Booking Now</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-input, .form-select {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 12px 16px;
        color: var(--text-primary);
        font-family: 'Montserrat', sans-serif;
        transition: all 0.3s;
    }
    
    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: var(--gold-primary);
    }
    
    .form-input::placeholder {
        color: var(--text-secondary);
    }
    
    /* Pagination Styling */
    .pagination {
        display: flex;
        gap: 10px;
        list-style: none;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .pagination .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-primary);
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .pagination .page-item.active .page-link {
        background: var(--gold-gradient);
        color: #0A0A0A;
        border-color: transparent;
    }
    
    .pagination .page-item .page-link:hover {
        border-color: var(--gold-primary);
        transform: translateY(-2px);
    }
    
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 10000;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(5px);
    }
    
    .modal.show {
        display: flex;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .modal-content {
        background: var(--bg-primary);
        border-radius: 16px;
        width: 90%;
        max-width: 1200px;
        position: relative;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.3s ease;
        /* Hilangkan max-height dan overflow pada desktop */
        max-height: none;
        overflow: visible;
    }
    
    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .modal-header {
        position: sticky;
        top: 0;
        background: var(--bg-primary);
        padding: 15px 20px;
        display: flex;
        justify-content: flex-end;
        border-bottom: 1px solid var(--border-color);
        z-index: 10;
    }
    
    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--text-primary);
        transition: all 0.3s;
        padding: 5px 10px;
        border-radius: 8px;
    }
    
    .modal-close:hover {
        background: rgba(253, 185, 49, 0.2);
        color: var(--gold-primary);
        transform: rotate(90deg);
    }
    
    .modal-body {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        padding: 30px;
        /* Hilangkan max-height dan overflow pada desktop */
        max-height: none;
        overflow: visible;
    }
    
    .modal-left {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .modal-image {
        width: 100%;
        height: 350px;
        object-fit: cover;
        border-radius: 12px;
    }
    
    .modal-description h4 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--gold-primary);
    }
    
    .modal-description p {
        color: var(--text-secondary);
        line-height: 1.6;
        font-size: 14px;
    }
    
    .modal-right {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .modal-type span {
        display: inline-block;
        background: rgba(253, 185, 49, 0.15);
        color: var(--gold-primary);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .modal-title {
        font-size: 28px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
    }
    
    .modal-location {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-secondary);
        font-size: 14px;
    }
    
    .modal-location i {
        color: var(--gold-primary);
    }
    
    .modal-features h4 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--text-primary);
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    
    .feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        background: var(--bg-card);
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
    
    .feature-item i {
        color: var(--gold-primary);
        font-size: 18px;
        width: 24px;
    }
    
    .feature-item span {
        color: var(--text-secondary);
        font-size: 13px;
    }
    
    .modal-price h4 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--text-primary);
    }
    
    .modal-price p {
        font-size: 24px;
        font-weight: 700;
        color: var(--gold-primary);
    }
    
    .modal-booking {
        background: var(--bg-card);
        border-radius: 12px;
        padding: 20px;
        border: 1px solid var(--border-color);
    }
    
    .booking-dates {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .date-box label,
    .guest-box label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--text-secondary);
    }
    
    .date-input,
    .guest-select {
        width: 100%;
        padding: 10px;
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-primary);
        font-family: 'Montserrat', sans-serif;
    }
    
    .date-input:focus,
    .guest-select:focus {
        outline: none;
        border-color: var(--gold-primary);
    }
    
    .guest-box {
        margin-bottom: 20px;
    }
    
    .booking-now-modal {
        width: 100%;
        padding: 14px;
        background: var(--gold-gradient);
        border: none;
        border-radius: 8px;
        color: #0A0A0A;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .booking-now-modal:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(253, 185, 49, 0.4);
    }
    
    /* Hanya untuk layar di bawah 900px (mobile/tablet) - scroll diaktifkan */
    @media (max-width: 900px) {
        .modal-content {
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .modal-body {
            grid-template-columns: 1fr;
            padding: 20px;
            max-height: none;
            overflow: visible;
        }
        
        .modal-image {
            height: 250px;
        }
        
        .modal-title {
            font-size: 24px;
        }
        
        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    /* Mobile kecil - tetap bisa scroll */
    @media (max-width: 600px) {
        .modal-content {
            width: 95%;
            max-height: 85vh;
            overflow-y: auto;
        }
        
        .booking-dates {
            grid-template-columns: 1fr;
        }
        
        .features-grid {
            grid-template-columns: 1fr;
        }
    }
    
    /* Desktop (di atas 900px) - tidak ada scroll */
    @media (min-width: 901px) {
        .modal-content {
            overflow: visible;
            max-height: none;
        }
        
        .modal-body {
            overflow: visible;
            max-height: none;
        }
        
        /* Hilangkan scrollbar pada body saat modal terbuka di desktop */
        body.modal-open-desktop {
            overflow: hidden;
        }
    }
</style>

<script>
    function openModal(property) {
        // Set modal content
        document.getElementById('modalImage').src = property.image;
        document.getElementById('modalType').innerHTML = property.type || 'Luxury Suite';
        document.getElementById('modalTitle').innerHTML = property.title;
        document.getElementById('modalLocation').innerHTML = property.location || property.city || 'Jakarta, Indonesia';
        document.getElementById('modalDescription').innerHTML = property.description || property.long_description || 'Experience unparalleled luxury in this exquisite residence. Every detail has been carefully crafted to provide the ultimate living experience.';
        
        const priceMin = property.price_min / 1000000;
        const priceMax = property.price_max / 1000000;
        document.getElementById('modalPrice').innerHTML = `Rp ${priceMin.toFixed(1)}M - ${priceMax.toFixed(1)}M <span style="font-size: 14px; color: var(--text-secondary);">/ annum</span>`;
        
        // Store property data for booking
        window.currentProperty = property;
        
        // Show modal
        document.getElementById('propertyModal').classList.add('show');
        document.body.style.overflow = 'hidden';
        
        // Untuk desktop, tambahkan class khusus
        if (window.innerWidth >= 901) {
            document.body.classList.add('modal-open-desktop');
        }
    }
    
    function closeModal() {
        document.getElementById('propertyModal').classList.remove('show');
        document.body.style.overflow = '';
        document.body.classList.remove('modal-open-desktop');
    }
    
    function bookNow() {
        const checkIn = document.getElementById('checkIn').value;
        const checkOut = document.getElementById('checkOut').value;
        const guest = document.getElementById('guestCount').value;
        
        // Close modal first
        closeModal();
        
        // Redirect to login page with booking data in session/sessionStorage
        const bookingData = {
            property: window.currentProperty,
            checkIn: checkIn,
            checkOut: checkOut,
            guest: guest
        };
        
        // Store booking data in sessionStorage
        sessionStorage.setItem('pendingBooking', JSON.stringify(bookingData));
        
        // Redirect to login page
        window.location.href = "{{ route('login') }}";
    }
    
    // Close modal when clicking outside
    document.getElementById('propertyModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('propertyModal').classList.contains('show')) {
            closeModal();
        }
    });
    
    // Handle resize untuk menyesuaikan scroll behavior
    window.addEventListener('resize', function() {
        if (document.getElementById('propertyModal').classList.contains('show')) {
            if (window.innerWidth >= 901) {
                document.body.classList.add('modal-open-desktop');
            } else {
                document.body.classList.remove('modal-open-desktop');
            }
        }
    });
</script>
@endsection