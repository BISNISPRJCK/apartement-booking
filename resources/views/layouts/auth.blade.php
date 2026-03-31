<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'VANTIX STAY - Authentication')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Montserrat:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            overflow-x: hidden;
        }

        /* Premium Gold Colors */
        :root {
            --gold-primary: #FDB931;
            --gold-secondary: #FFD700;
            --gold-dark: #D4AF37;
            --gold-light: #F5E56B;
            --gold-glow: rgba(255, 215, 0, 0.6);
            --gold-gradient: linear-gradient(135deg, #FDB931 0%, #FFD700 30%, #F5E56B 50%, #FFD700 70%, #FDB931 100%);
        }

        /* Dark Mode (Default) */
        body.dark-mode {
            --bg-primary: #0A0A0A;
            --bg-secondary: #1A1A1A;
            --bg-card: rgba(255, 255, 255, 0.03);
            --text-primary: #FFFFFF;
            --text-secondary: rgba(255, 255, 255, 0.7);
            --border-color: rgba(253, 185, 49, 0.3);
        }

        /* Light Mode */
        body.light-mode {
            --bg-primary: #FFFFFF;
            --bg-secondary: #F8F8F8;
            --bg-card: rgba(0, 0, 0, 0.02);
            --text-primary: #1A1A1A;
            --text-secondary: rgba(0, 0, 0, 0.7);
            --border-color: rgba(253, 185, 49, 0.4);
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gold-gradient);
            border-radius: 2px;
        }

        /* Theme Toggle Button in Corner */
        .theme-toggle-auth {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gold-gradient);
            cursor: pointer;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 20px rgba(253, 185, 49, 0.3);
            border: none;
        }

        .theme-toggle-auth:hover {
            transform: scale(1.1);
            box-shadow: 0 0 30px rgba(253, 185, 49, 0.5);
        }

        .theme-toggle-auth i {
            font-size: 22px;
            color: #0A0A0A;
            transition: transform 0.3s;
        }

        .theme-toggle-auth:hover i {
            transform: rotate(180deg);
        }

        /* Back to Home Link */
        .back-home {
            position: fixed;
            top: 30px;
            left: 30px;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .back-home:hover {
            background: var(--gold-gradient);
            color: #0A0A0A;
            transform: translateX(-5px);
        }

        .back-home i {
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .back-home {
                top: 20px;
                left: 20px;
                padding: 8px 15px;
                font-size: 12px;
            }
            
            .theme-toggle-auth {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="dark-mode">

<!-- Back to Home Button -->
<a href="{{ route('home') }}" class="back-home">
    <i class="fas fa-arrow-left"></i>
    <span>Back to Home</span>
</a>

<!-- Theme Toggle Button -->
<button class="theme-toggle-auth" id="themeToggleAuth">
    <i class="fas fa-moon"></i>
</button>

<main>
    @yield('content')
</main>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: false,
        offset: 100
    });
    
    // Theme Toggle Functionality
    const themeToggle = document.getElementById('themeToggleAuth');
    const body = document.body;
    const themeIcon = themeToggle.querySelector('i');
    
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
        body.classList.remove('dark-mode');
        body.classList.add('light-mode');
        themeIcon.classList.remove('fa-moon');
        themeIcon.classList.add('fa-sun');
    }
    
    themeToggle.addEventListener('click', () => {
        if (body.classList.contains('dark-mode')) {
            body.classList.remove('dark-mode');
            body.classList.add('light-mode');
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
            localStorage.setItem('theme', 'light');
        } else {
            body.classList.remove('light-mode');
            body.classList.add('dark-mode');
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
            localStorage.setItem('theme', 'dark');
        }
        AOS.refresh();
    });
</script>

@stack('scripts')
</body>
</html>