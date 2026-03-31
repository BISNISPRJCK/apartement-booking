<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>THE RESIDENCE | Sewa Apartemen Ultra Premium</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Montserrat:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
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
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 500;
        }

        /* Premium Gold Colors */
        :root {
            --gold-primary: #FDB931;
            --gold-secondary: #FFD700;
            --gold-dark: #D4AF37;
            --gold-light: #F5E56B;
            --gold-glow: rgba(255, 215, 0, 0.6);
            --gold-gradient: linear-gradient(135deg, #FDB931 0%, #FFD700 30%, #F5E56B 50%, #FFD700 70%, #FDB931 100%);
            --gold-gradient-vertical: linear-gradient(180deg, #FFD700 0%, #FDB931 50%, #D4AF37 100%);
        }

        /* Dark Mode (Default) */
        body.dark-mode {
            --bg-primary: #0A0A0A;
            --bg-secondary: #1A1A1A;
            --bg-card: rgba(255, 255, 255, 0.03);
            --text-primary: #FFFFFF;
            --text-secondary: rgba(255, 255, 255, 0.7);
            --border-color: rgba(253, 185, 49, 0.3);
            --footer-bg: #050505;
            --card-bg: rgba(255, 255, 255, 0.03);
        }

        /* Light Mode */
        body.light-mode {
            --bg-primary: #FFFFFF;
            --bg-secondary: #F8F8F8;
            --bg-card: rgba(0, 0, 0, 0.02);
            --text-primary: #1A1A1A;
            --text-secondary: rgba(0, 0, 0, 0.7);
            --border-color: rgba(253, 185, 49, 0.4);
            --footer-bg: #F5F5F5;
            --card-bg: rgba(0, 0, 0, 0.02);
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        /* Custom Cursor */
        .cursor {
            width: 10px;
            height: 10px;
            background: var(--gold-primary);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 10000;
            transition: transform 0.2s;
            box-shadow: 0 0 15px var(--gold-glow);
        }

        .cursor-follower {
            width: 35px;
            height: 35px;
            border: 2px solid var(--gold-primary);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 10000;
            transition: transform 0.1s;
            box-shadow: 0 0 20px var(--gold-glow);
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

        /* Glow Animation */
        @keyframes goldGlow {
            0%, 100% {
                text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
            }
            50% {
                text-shadow: 0 0 25px rgba(255, 215, 0, 0.8);
            }
        }

        @keyframes shimmerGold {
            0% {
                background-position: -200% center;
            }
            100% {
                background-position: 200% center;
            }
        }

        /* Theme Toggle Button */
        .theme-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 55px;
            height: 55px;
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

        .theme-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 0 30px rgba(253, 185, 49, 0.5);
        }

        .theme-toggle i {
            font-size: 24px;
            color: #0A0A0A;
            transition: transform 0.3s;
        }

        .theme-toggle:hover i {
            transform: rotate(180deg);
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 30px 60px;
            z-index: 1000;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            background: transparent;
        }

        .navbar.scrolled {
            padding: 20px 60px;
            background: var(--bg-primary);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
        }

        .nav-container {
            max-width: 1600px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Logo Container with Image */
        .logo {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-img {
            height: 50px;
            width: auto;
            transition: all 0.3s ease;
        }

        body.light-mode .logo-img {
            filter: drop-shadow(0 0 5px rgba(253, 185, 49, 0.3));
        }

        .logo-img:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 0 12px var(--gold-glow));
        }

        .logo h1 {
            font-size: 32px;
            font-weight: 300;
            letter-spacing: 4px;
            background: var(--gold-gradient);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmerGold 3s linear infinite;
            margin: 0;
        }

        .nav-links {
            display: flex;
            gap: 50px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-primary);
            font-weight: 300;
            font-size: 14px;
            letter-spacing: 1px;
            transition: all 0.3s;
            position: relative;
        }

        .nav-links a::before {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gold-gradient);
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 10px var(--gold-primary);
        }

        .nav-links a:hover::before,
        .nav-links a.active::before {
            width: 100%;
        }

        .nav-links a:hover {
            color: var(--gold-primary);
            text-shadow: 0 0 8px var(--gold-glow);
        }

        /* Hero Section with Parallax */
        .hero {
            height: 100vh;
            position: relative;
            background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1920');
            background-size: cover;
            background-position: center;
            opacity: 0.3;
            animation: zoomIn 20s infinite alternate;
        }

        body.light-mode .hero-bg {
            opacity: 0.1;
        }

        @keyframes zoomIn {
            from { transform: scale(1); }
            to { transform: scale(1.1); }
        }

        .hero-content {
            z-index: 2;
            max-width: 900px;
            padding: 0 20px;
        }

        .hero-subtitle {
            font-size: 12px;
            letter-spacing: 6px;
            text-transform: uppercase;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 300;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
            animation: goldGlow 2s ease-in-out infinite;
        }

        .hero-subtitle::before,
        .hero-subtitle::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40px;
            height: 1px;
            background: var(--gold-gradient);
        }

        .hero-subtitle::before {
            left: -50px;
        }

        .hero-subtitle::after {
            right: -50px;
        }

        .hero h1 {
            font-size: 96px;
            font-weight: 500;
            margin-bottom: 30px;
            line-height: 1.1;
            letter-spacing: -2px;
            color: var(--text-primary);
        }

        .hero h1 span {
            background: var(--gold-gradient);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-style: italic;
            animation: shimmerGold 3s linear infinite;
        }

        .hero p {
            font-size: 16px;
            color: var(--text-secondary);
            margin-bottom: 50px;
            line-height: 1.8;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .btn-gold {
            display: inline-block;
            padding: 16px 48px;
            background: var(--gold-gradient);
            background-size: 200% auto;
            color: #0A0A0A;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 2px;
            font-size: 14px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            z-index: 1;
            border-radius: 50px;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
        }

        .btn-gold::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
            transition: left 0.6s;
            z-index: -1;
        }

        .btn-gold:hover::before {
            left: 100%;
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
            animation: shimmerGold 1s linear infinite;
        }

        .btn-outline-gold {
            display: inline-block;
            padding: 16px 48px;
            background: transparent;
            color: var(--gold-primary);
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 2px;
            font-size: 14px;
            border: 2px solid transparent;
            border-image: var(--gold-gradient);
            border-image-slice: 1;
            transition: all 0.4s;
            margin-left: 20px;
            position: relative;
            overflow: hidden;
            border-radius: 50px;
        }

        .btn-outline-gold:hover {
            background: var(--gold-gradient);
            color: #0A0A0A;
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.4);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
        }

        .mouse {
            width: 30px;
            height: 50px;
            border: 2px solid var(--gold-primary);
            border-radius: 20px;
            position: relative;
            box-shadow: 0 0 15px var(--gold-glow);
        }

        .mouse::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 10px;
            background: var(--gold-gradient);
            animation: scroll 2s infinite;
        }

        @keyframes scroll {
            0% { transform: translateX(-50%) translateY(0); opacity: 1; }
            100% { transform: translateX(-50%) translateY(20px); opacity: 0; }
        }

        /* Section Styles */
        section {
            padding: 120px 60px;
            position: relative;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 56px;
            margin-bottom: 20px;
            font-weight: 400;
            letter-spacing: -1px;
            background: var(--gold-gradient);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmerGold 3s linear infinite;
        }

        .section-subtitle {
            text-align: center;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 80px;
            font-weight: 300;
        }

        /* Apartment Cards */
        .apartments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 50px;
            margin-top: 50px;
        }

        .apartment-card {
            background: var(--bg-card);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .apartment-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(253, 185, 49, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.6s;
            z-index: 0;
        }

        .apartment-card:hover::before {
            opacity: 1;
        }

        .apartment-card:hover {
            transform: translateY(-15px);
            border-color: var(--gold-primary);
            box-shadow: 0 0 40px rgba(253, 185, 49, 0.3);
        }

        .card-image {
            height: 350px;
            overflow: hidden;
            position: relative;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .apartment-card:hover .card-image img {
            transform: scale(1.1);
        }

        .card-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--gold-gradient);
            color: #0A0A0A;
            padding: 5px 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            z-index: 1;
            box-shadow: 0 0 15px var(--gold-glow);
        }

        .card-content {
            padding: 35px;
            position: relative;
            z-index: 1;
        }

        .card-content h3 {
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 500;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .price {
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 36px;
            font-weight: 600;
            margin: 20px 0;
            font-family: 'Montserrat', sans-serif;
            display: inline-block;
            animation: goldGlow 2s ease-in-out infinite;
        }

        .price span {
            font-size: 14px;
            font-weight: 300;
            color: var(--text-secondary);
            -webkit-text-fill-color: var(--text-secondary);
        }

        .features {
            display: flex;
            gap: 25px;
            margin: 25px 0;
            padding-top: 25px;
            border-top: 1px solid var(--border-color);
        }

        .features i {
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-right: 8px;
        }

        .features span {
            color: var(--text-secondary);
        }

        /* Facilities */
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-top: 50px;
        }

        .facility-item {
            text-align: center;
            padding: 50px 30px;
            background: var(--bg-card);
            border-radius: 30px;
            transition: all 0.5s;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .facility-item::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(253, 185, 49, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.6s;
        }

        .facility-item:hover::before {
            opacity: 1;
        }

        .facility-item:hover {
            transform: translateY(-10px);
            border-color: var(--gold-primary);
            box-shadow: 0 0 30px rgba(253, 185, 49, 0.2);
        }

        .facility-item i {
            font-size: 60px;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 25px;
            display: inline-block;
            animation: goldGlow 2s ease-in-out infinite;
        }

        .facility-item h3 {
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: 500;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .facility-item p {
            color: var(--text-secondary);
        }

        /* Testimonials */
        .testimonials-section {
            background: var(--bg-secondary);
        }

        .testimonials-slider {
            margin-top: 50px;
            padding: 20px;
        }

        .testimonial-card {
            background: var(--bg-card);
            backdrop-filter: blur(10px);
            padding: 50px;
            border-radius: 30px;
            border: 1px solid var(--border-color);
            margin: 20px;
            transition: all 0.3s;
        }

        .testimonial-card:hover {
            border-color: var(--gold-primary);
            box-shadow: 0 0 40px rgba(253, 185, 49, 0.2);
        }

        .quote-icon {
            font-size: 60px;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0.5;
            margin-bottom: 20px;
        }

        .testimonial-text {
            font-size: 20px;
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: 30px;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
        }

        .client-info h4 {
            font-size: 18px;
            margin-bottom: 5px;
            font-weight: 600;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .client-info p {
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 12px;
            letter-spacing: 1px;
        }

        /* CTA Section */
        .cta-section {
            background: var(--gold-gradient);
            text-align: center;
            padding: 100px 60px;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4), transparent);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-section h2 {
            font-size: 56px;
            margin-bottom: 20px;
            color: #0A0A0A;
            font-weight: 500;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
        }

        .cta-section p {
            margin-bottom: 40px;
            color: rgba(10, 10, 10, 0.8);
            font-size: 18px;
        }

        .btn-dark {
            display: inline-block;
            padding: 16px 48px;
            background: #0A0A0A;
            color: var(--gold-primary);
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 2px;
            transition: all 0.4s;
            border-radius: 50px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .btn-dark:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            color: var(--gold-light);
        }

        /* Footer */
        footer {
            background: var(--footer-bg);
            padding: 80px 60px 40px;
            border-top: 1px solid var(--border-color);
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 60px;
            margin-bottom: 60px;
        }

        .footer-section h3 {
            font-size: 20px;
            margin-bottom: 25px;
            font-weight: 500;
            letter-spacing: 1px;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .footer-section p {
            color: var(--text-secondary);
            line-height: 1.8;
            font-size: 14px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            background: var(--bg-card);
            color: var(--gold-primary);
            border-radius: 50%;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background: var(--gold-gradient);
            color: #0A0A0A;
            transform: translateY(-3px);
            box-shadow: 0 0 20px var(--gold-glow);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 40px;
            border-top: 1px solid var(--border-color);
            color: var(--text-secondary);
            font-size: 12px;
        }

        /* Swiper Pagination Custom */
        .swiper-pagination-bullet {
            background: var(--gold-primary);
            opacity: 0.5;
        }

        .swiper-pagination-bullet-active {
            background: var(--gold-gradient);
            opacity: 1;
            box-shadow: 0 0 10px var(--gold-glow);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero h1 {
                font-size: 64px;
            }
            
            section {
                padding: 80px 30px;
            }
            
            .section-title {
                font-size: 48px;
            }
            
            .logo-img {
                height: 35px;
            }
            
            .logo h1 {
                font-size: 28px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 20px;
            }
            
            .navbar.scrolled {
                padding: 15px 20px;
            }
            
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 42px;
            }
            
            .hero-subtitle::before,
            .hero-subtitle::after {
                width: 20px;
            }
            
            .hero-subtitle::before {
                left: -30px;
            }
            
            .hero-subtitle::after {
                right: -30px;
            }
            
            section {
                padding: 60px 20px;
            }
            
            .section-title {
                font-size: 36px;
            }
            
            .btn-outline-gold {
                margin-left: 0;
                margin-top: 20px;
                display: block;
            }
            
            .apartments-grid {
                grid-template-columns: 1fr;
            }
            
            .testimonial-card {
                padding: 30px;
            }
            
            .testimonial-text {
                font-size: 16px;
            }
            
            .cta-section h2 {
                font-size: 36px;
            }
            
            .theme-toggle {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
            }
            
            .theme-toggle i {
                font-size: 20px;
            }
            
            .logo-img {
                height: 30px;
            }
            
            .logo h1 {
                font-size: 24px;
                letter-spacing: 2px;
            }
            
            .logo {
                gap: 10px;
            }
        }
    </style>
</head>
<body class="dark-mode">

<!-- Custom Cursor -->
<div class="cursor"></div>
<div class="cursor-follower"></div>

<!-- Theme Toggle Button -->
<button class="theme-toggle" id="themeToggle">
    <i class="fas fa-moon"></i>
</button>

<!-- Navigation -->
<nav class="navbar" id="navbar">
    <div class="nav-container">
        <div class="logo" data-aos="fade-right">
            <img src="{{ asset('assets/logo_vs.png') }}" alt="Logo" class="logo-img">
            <h1>THE RESIDENCE</h1>
        </div>
        <ul class="nav-links">
            <li><a href="#home" class="active">HOME</a></li>
            <li><a href="#apartments">RESIDENCES</a></li>
            <li><a href="#facilities">AMENITIES</a></li>
            <li><a href="#testimonials">TESTIMONIALS</a></li>
            <li><a href="#contact">CONTACT</a></li>
        </ul>
    </div>
</nav>

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
        <div class="mouse"></div>
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
                    <a href="#" class="btn-gold" style="width: 100%; text-align: center;">VIEW DETAILS</a>
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
                        ['name' => 'Isabella Rossi', 'position' => 'Fashion Designer', 'text' => 'I\'ve lived in luxury properties worldwide, but The Residence sets a new standard. The attention to detail and privacy is exceptional.'],
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

<!-- Footer -->
<footer id="contact">
    <div class="footer-content">
        <div class="footer-section" data-aos="fade-up">
            <h3>THE RESIDENCE</h3>
            <p>Redefining luxury living in the heart of Jakarta's most prestigious district. Where elegance meets exclusivity.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        
        <div class="footer-section" data-aos="fade-up" data-aos-delay="50">
            <h3>CONTACT</h3>
            <p><i class="fas fa-map-marker-alt" style="background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-right: 10px;"></i> Jalan Jenderal Sudirman Kav. 52-53, Jakarta 12190</p>
            <p style="margin-top: 15px;"><i class="fas fa-phone" style="background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-right: 10px;"></i> +62 21 5080 8888</p>
            <p style="margin-top: 15px;"><i class="fas fa-envelope" style="background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-right: 10px;"></i> concierge@theresidence.com</p>
        </div>
        
        <div class="footer-section" data-aos="fade-up" data-aos-delay="100">
            <h3>VISITING HOURS</h3>
            <p>Monday - Friday: 09:00 - 20:00</p>
            <p>Saturday: 10:00 - 18:00</p>
            <p>Sunday: By Appointment Only</p>
            <p style="margin-top: 15px; background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Private Viewing Available</p>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2024 THE RESIDENCE. All Rights Reserved. An Icon of Luxury Living.</p>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: false,
        offset: 100
    });
    
    // Theme Toggle Functionality
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;
    const themeIcon = themeToggle.querySelector('i');
    
    // Check for saved theme preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
        body.classList.remove('dark-mode');
        body.classList.add('light-mode');
        themeIcon.classList.remove('fa-moon');
        themeIcon.classList.add('fa-sun');
    }
    
    // Theme toggle click handler
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
        
        // Refresh AOS and Swiper to adapt to new theme
        AOS.refresh();
    });
    
    // Initialize Swiper
    const swiper = new Swiper('.testimonials-slider', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Active link highlighting
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-links a');
    
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (scrollY >= (sectionTop - sectionHeight / 3)) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
    
    // Custom cursor
    const cursor = document.querySelector('.cursor');
    const cursorFollower = document.querySelector('.cursor-follower');
    
    document.addEventListener('mousemove', (e) => {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
        
        setTimeout(() => {
            cursorFollower.style.left = e.clientX + 'px';
            cursorFollower.style.top = e.clientY + 'px';
        }, 50);
    });
    
    document.addEventListener('mouseenter', () => {
        cursor.style.opacity = '1';
        cursorFollower.style.opacity = '1';
    });
    
    document.addEventListener('mouseleave', () => {
        cursor.style.opacity = '0';
        cursorFollower.style.opacity = '0';
    });
    
    // Hover effect for buttons and cards
    const hoverElements = document.querySelectorAll('.btn-gold, .btn-outline-gold, .btn-dark, .apartment-card, .facility-item');
    
    hoverElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursor.style.transform = 'scale(2)';
            cursorFollower.style.transform = 'scale(1.5)';
        });
        
        el.addEventListener('mouseleave', () => {
            cursor.style.transform = 'scale(1)';
            cursorFollower.style.transform = 'scale(1)';
        });
    });
</script>
</body>
</html>