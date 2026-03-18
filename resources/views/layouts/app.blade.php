<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Vantix Stay - Apartemen Modern & Nyaman')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=HeadlandOne&family=Inter&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (opsional, bisa pakai CSS biasa) -->
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body>
    <div class="landing-page">
        @include('partials.header')
        
        <main>
            @yield('content')
        </main>
        
        @include('partials.footer')
    </div>
    
    @stack('scripts')
</body>
</html>