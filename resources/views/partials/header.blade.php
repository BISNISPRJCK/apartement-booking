<header class="header">
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            @if(Storage::exists('public/logo.png'))
                <img src="{{ asset('storage/logo.png') }}" alt="Vantix Stay">
            @else
                <span>Vantix Stay</span>
            @endif
        </a>
        
        <ul class="nav-menu">
            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}">HOME</a>
            </li>
            <li class="{{ request()->routeIs('property*') ? 'active' : '' }}">
                <a href="{{ route('property') }}">PROPERTY</a>
            </li>
            <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                <a href="{{ route('about') }}">ABOUT</a>
            </li>
            <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                <a href="{{ route('contact') }}">CONTACT</a>
            </li>
        </ul>
        
        <a href="{{ route('property') }}" class="booking-now">BOOKING NOW</a>
    </nav>
</header>

@push('styles')
<style>
    .nav-menu li.active a {
        color: #FFFBFB !important;
        font-weight: 600;
    }
    .nav-menu li a {
        transition: color 0.3s ease;
    }
    .nav-menu li a:hover {
        color: #FFFBFB !important;
    }
</style>
@endpush