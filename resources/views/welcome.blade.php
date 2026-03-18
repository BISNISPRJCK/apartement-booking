<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vantix Stay - Apartemen Modern & Nyaman</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=HeadlandOne&family=Inter&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* ===== RESET & VARIABLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-dark: #081123;
            --primary-blue: #222A3A;
            --accent-green: #4EB149;
            --accent-green-hover: #3d8f3a;
            --text-white: #FFFFFF;
            --text-white-50: rgba(255, 255, 255, 0.5);
            --text-white-80: rgba(255, 255, 255, 0.8);
            --text-dark: #081123;
            --text-gray: rgba(0, 0, 0, 0.6);
            --border-light: #C3B8B8;
            --bg-light: #F7F7F7;
            --shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            --shadow-lg: 0px 8px 8px rgba(0, 0, 0, 0.25);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #FFFFFF;
        }

        /* ===== CONTAINER ===== */
        .landing-page {
            position: relative;
            width: 1440px;
            max-width: 100%;
            margin: 0 auto;
            background: #FFFFFF;
        }

        /* ===== TYPOGRAPHY ===== */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        .headland {
            font-family: 'HeadlandOne', serif;
        }

       /* ===== HEADER / NAVBAR DENGAN JARAK YANG SESUAI ===== */
.header {
    position: fixed;
    width: 1440px;
    max-width: 100%;
    height: 80px;
    left: 50%;
    transform: translateX(-50%);
    top: 0;
    z-index: 1000;
    transition: var(--transition);
}

.navbar {
    position: absolute;
    width: 100%;
    height: 80px;
    background: linear-gradient(90deg, #081123 8.17%, rgba(106, 113, 121, 0.8) 99.52%);
    box-shadow: var(--shadow), var(--shadow-lg);
}

/* Logo */
.logo {
    position: absolute;
    width: 90px;
    height: 45px;
    left: 40px;
    top: 17px;
    background: #3a4a6b;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 12px;
    text-decoration: none;
    transition: var(--transition);
    overflow: hidden;
}

.logo:hover {
    background: #4a5a7b;
    transform: scale(1.02);
}

.logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* Navigation Menu */
.nav-menu {
    position: absolute;
    display: flex;
    gap: 40px; /* Jarak antar menu diperbesar */
    left: 500px; /* Posisi mulai dari kiri */
    top: 25px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-menu li {
    position: relative;
}

.nav-menu li a {
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 18px;
    line-height: 28px;
    text-decoration: none;
    color: rgba(255, 250, 250, 0.5);
    transition: var(--transition);
    position: relative;
    padding: 3px 0;
}

.nav-menu li:nth-child(1) a {
    color: #FFFBFB;
}

.nav-menu li a:hover {
    color: #FFFBFB !important;
}

.nav-menu li a::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 2px;
    background: var(--accent-green);
    transition: var(--transition);
}

.nav-menu li a:hover::after {
    width: 80%;
}

.nav-menu li.active a {
    color: #FFFBFB !important;
    font-weight: 600;
}

.nav-menu li.active a::after {
    width: 80%;
    background: var(--accent-green);
}
/* Booking Now Button - dengan shadow sesuai tema */
.booking-now {
    position: absolute;
    left: 1100px;
    top: 10px;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 16px;
    letter-spacing: 0.5px;
    color: #FFFFFF;
    text-decoration: none;
    padding: 10px 22px;
    background: linear-gradient(90deg, #081123 8.17%, rgba(26, 35, 50, 0.95) 99.52%);
    border-radius: 40px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Shadow gelap sesuai tema */
    transition: var(--transition);
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    z-index: 5;
    overflow: hidden;
}

/* Efek background shimmer */
.booking-now::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
    transition: left 0.6s ease;
    border-radius: 40px;
    pointer-events: none;
}

.booking-now:hover::before {
    left: 100%;
}

/* Icon panah */
.booking-now::after {
    content: '→';
    font-size: 20px;
    font-weight: 400;
    transition: transform 0.3s ease;
    opacity: 0.9;
}

/* Hover effect */
.booking-now:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5); /* Shadow lebih gelap saat hover */
    background: linear-gradient(90deg, #0f1a30 8.17%, rgba(36, 45, 60, 0.95) 99.52%);
    border-color: rgba(255, 255, 255, 0.25);
}

.booking-now:hover::after {
    transform: translateX(8px);
}

.booking-now:active {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
}

/* Responsive Design dengan jarak yang menyesuaikan */
@media (max-width: 1440px) {
    .header { width: 100%; }
    
    .nav-menu {
        left: auto;
        right: 200px; /* Berdasarkan posisi dari kanan */
        gap: 35px;
    }
    
    .nav-menu li a { font-size: 16px; }
    
    .booking-now {
        left: auto;
        right: 40px;
        font-size: 16px;
    }
}

@media (max-width: 1280px) {
    .nav-menu {
        right: 180px;
        gap: 30px;
    }
}

@media (max-width: 1150px) {
    .nav-menu {
        right: 160px;
        gap: 25px;
    }
}

@media (max-width: 1024px) {
    .nav-menu {
        right: 140px;
        gap: 20px;
    }
    
    .nav-menu li a { font-size: 15px; }
    .booking-now { font-size: 15px; right: 30px; }
}

@media (max-width: 900px) {
    .nav-menu {
        right: 120px;
        gap: 15px;
    }
}

@media (max-width: 768px) {
    .mobile-menu-btn { display: flex; }
    
    .nav-menu {
        position: fixed;
        top: 80px;
        left: -100%;
        width: 100%;
        height: calc(100vh - 80px);
        background: linear-gradient(135deg, #081123 0%, #1a2635 100%);
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 40px; /* Jarak lebih besar di mobile */
        transition: left 0.3s ease;
        z-index: 100;
        right: auto; /* Reset right positioning */
    }
    
    .nav-menu.active { left: 0; }
    .nav-menu li a { font-size: 20px; }
    .booking-now { right: 70px; }
    
    .mobile-menu-btn.active span:nth-child(1) {
        transform: rotate(45deg) translate(4px, 4px);
    }
    .mobile-menu-btn.active span:nth-child(2) { opacity: 0; }
    .mobile-menu-btn.active span:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -5px);
    }
    
    .header.scrolled {
        height: 65px;
    }
    .header.scrolled .logo {
        top: 10px;
        width: 75px;
        height: 38px;
    }
    .header.scrolled .nav-menu { top: 18px; }
    .header.scrolled .booking-now {
        top: 12px;
        padding: 6px 16px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .logo {
        width: 70px;
        height: 38px;
        left: 20px;
        top: 21px;
    }
    .booking-now {
        font-size: 14px;
        right: 50px;
        padding: 8px 16px;
    }
    .mobile-menu-btn { right: 20px; }
}

        /* Mobile menu button */
        .mobile-menu-btn {
            display: none;
            position: absolute;
            right: 40px;
            top: 25px;
            width: 35px;
            height: 30px;
            background: transparent;
            border: none;
            cursor: pointer;
            flex-direction: column;
            justify-content: space-between;
            padding: 6px 0;
            z-index: 20;
        }

        .mobile-menu-btn span {
            width: 100%;
            height: 2px;
            background: white;
            border-radius: 2px;
            transition: var(--transition);
        }

        /* Navbar Scroll Effects */
        .header.scrolled {
            height: 70px;
            background: rgba(8, 17, 35, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .header.scrolled .navbar {
            background: transparent;
            box-shadow: none;
        }

        .header.scrolled .logo {
            top: 12px;
            width: 85px;
            height: 42px;
        }

        .header.scrolled .nav-menu {
            top: 22px;
        }

        .header.scrolled .nav-menu li a {
            font-size: 17px;
        }

        .header.scrolled .booking-now {
            top: 15px;
            padding: 8px 20px;
            font-size: 15px;
        }

        .header.hide {
            transform: translate(-50%, -100%);
        }

        .header.show {
            transform: translate(-50%, 0);
            animation: slideDown 0.5s ease-out;
        }

        /* ===== HERO SECTION ===== */
        .hero-section {
            position: relative;
            width: 100%;
            height: 901px;
            margin-top: 80px;
            filter: drop-shadow(var(--shadow-lg));
        }

        .hero-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=1635&q=80');
            background-size: cover;
            background-position: center;
            top: 0;
            left: 0;
        }

        .hero-content {
            position: relative;
            width: 1217px;
            max-width: 90%;
            margin: 0 auto;
            top: 184px;
            text-align: center;
            z-index: 1;
        }

        .hero-title {
            font-family: 'HeadlandOne', serif;
            font-size: 40px;
            line-height: 50px;
            color: var(--text-white);
            margin-bottom: 24px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            line-height: 36px;
            color: var(--text-white-50);
            margin-bottom: 35px;
        }

        .search-box {
            width: 570px;
            max-width: 90%;
            height: 70px;
            margin: 0 auto;
            position: relative;
            filter: drop-shadow(var(--shadow));
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 10px;
            width: 40px;
            height: 50px;
            background: #ccc;
            border-radius: 8px 0 0 8px;
            z-index: 1;
        }

        .search-input {
            width: 100%;
            height: 100%;
            background: var(--text-white);
            border-radius: 8px;
            border: none;
            padding: 0 70px 0 70px;
            font-family: 'Inter', sans-serif;
            font-size: 20px;
            color: rgba(0, 0, 0, 0.5);
            transition: var(--transition);
        }

        .search-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px var(--accent-green);
        }

        /* ===== EXPLORE APARTMENT TYPES ===== */
        .explore-section {
            position: relative;
            width: 100%;
            height: 567px;
            background: var(--primary-blue);
        }

        .explore-title {
            position: absolute;
            width: 567px;
            height: 80px;
            left: 50%;
            transform: translateX(-50%);
            top: 100px;
            font-family: 'HeadlandOne', serif;
            font-size: 42px;
            line-height: 80px;
            text-align: center;
            color: var(--text-white);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .apartment-types {
            position: absolute;
            display: flex;
            gap: 69px;
            left: 50%;
            transform: translateX(-50%);
            top: 241px;
        }

        .type-card {
            width: 262px;
            height: 248px;
            border: 1px solid var(--text-white-80);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .type-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent-green);
            box-shadow: 0 10px 20px rgba(78, 177, 73, 0.3);
        }

        .type-icon {
            width: 74px;
            height: 74px;
            background: var(--text-white);
            border-radius: 50%;
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .type-card:hover .type-icon {
            transform: rotate(360deg);
        }

        .type-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 32px;
            line-height: 80px;
            color: var(--text-white);
        }

        .type-properties {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 24px;
            line-height: 80px;
            color: var(--text-white-80);
        }

        /* ===== ABOUT SECTION ===== */
        .about-section {
            position: relative;
            width: 1375px;
            max-width: 95%;
            height: 1040px;
            margin: 100px auto;
        }

        .about-content {
            position: relative;
            height: 100%;
        }

        .about-text {
            position: absolute;
            width: 898px;
            left: 96px;
            top: 0;
        }

        .about-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 42px;
            line-height: 80px;
            color: var(--text-dark);
            margin-bottom: 17px;
            position: relative;
            display: inline-block;
        }

        .about-title::after {
            content: '';
            position: absolute;
            bottom: 10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--accent-green);
            border-radius: 2px;
        }

        .about-description {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            line-height: 60px;
            color: var(--text-dark);
            max-width: 650px;
        }

        .about-image1 {
            position: absolute;
            width: 504px;
            height: 383px;
            left: 871px;
            top: 111px;
            background: url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80');
            background-size: cover;
            background-position: center;
            box-shadow: var(--shadow-lg);
            border-radius: 8px;
            transition: var(--transition);
        }

        .about-image1:hover {
            transform: scale(1.02);
        }

        .about-image2 {
            position: absolute;
            width: 540px;
            height: 522px;
            left: 0;
            top: 518px;
            background: url('https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?ixlib=rb-4.0.3&auto=format&fit=crop&w=1680&q=80');
            background-size: cover;
            background-position: center;
            box-shadow: var(--shadow-lg);
            border-radius: 8px;
            transition: var(--transition);
        }

        .about-image2:hover {
            transform: scale(1.02);
        }

        .about-text2 {
            position: absolute;
            width: 679px;
            left: 598px;
            top: 539px;
        }

        /* ===== OUR PACKAGES ===== */
        .packages-section {
            position: relative;
            width: 1533px;
            max-width: 100%;
            height: 791px;
            margin: 0 auto;
        }

        .packages-header {
            position: absolute;
            width: 443.03px;
            left: 50%;
            transform: translateX(-50%);
            top: 0;
            text-align: center;
        }

        .packages-title {
            font-family: 'HeadlandOne', serif;
            font-size: 42px;
            line-height: 80px;
            color: #000000;
            border: 1px solid #000000;
            width: 347px;
            margin: 0 auto;
            padding: 0 20px;
            transition: var(--transition);
        }

        .packages-title:hover {
            background: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
        }

        .packages-divider {
            width: 443.03px;
            height: 0;
            border: 1px solid rgba(0, 0, 0, 0.5);
            margin-top: 10px;
        }

        .packages-container {
            position: absolute;
            display: flex;
            gap: 42px;
            top: 168px;
            left: 50%;
            transform: translateX(-50%);
        }

        .package-card {
            width: 487px;
            height: 540px;
            filter: drop-shadow(var(--shadow));
            transition: var(--transition);
        }

        .package-card:hover {
            transform: translateY(-10px);
            filter: drop-shadow(0 12px 12px rgba(0, 0, 0, 0.3));
        }

        .card-bg {
            width: 487px;
            height: 549px;
            background: var(--primary-blue);
            box-shadow: var(--shadow-lg);
            border-radius: 8px;
            position: relative;
            top: -10px;
            transition: var(--transition);
        }

        .package-card:hover .card-bg {
            background: #2a3343;
        }

        .card-image {
            width: 434px;
            height: 279px;
            background: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80');
            background-size: cover;
            background-position: center;
            border: 1px solid #EFEFEF;
            border-radius: 8px;
            margin: 21px auto 0;
            transition: var(--transition);
        }

        .package-card:hover .card-image {
            transform: scale(1.02);
        }

        .card-content {
            margin: 21px 28px 0;
        }

        .card-type {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            line-height: 36px;
            color: var(--text-white-80);
        }

        .card-name {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            line-height: 42px;
            color: var(--text-white);
            margin: 15px 0;
        }

        .card-price {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            line-height: 36px;
            color: rgba(0, 108, 249, 0.5);
            margin-bottom: 84px;
        }

        .view-detail-btn {
            display: inline-block;
            width: 122px;
            height: 35px;
            background: var(--accent-green);
            border-radius: 4px;
            border: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 14px;
            line-height: 35px;
            color: var(--text-white);
            text-align: center;
            text-decoration: none;
            margin-left: 332px;
            cursor: pointer;
            transition: var(--transition);
        }

        .view-detail-btn:hover {
            background: var(--accent-green-hover);
            transform: scale(1.05);
        }

        .packages-dots {
            position: absolute;
            display: flex;
            gap: 9px;
            left: 50%;
            transform: translateX(-50%);
            top: 750px;
        }

        .dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            cursor: pointer;
            transition: var(--transition);
        }

        .dot:hover {
            transform: scale(1.2);
        }

        .dot-active {
            background: #C3B8B8;
        }

        .dot-inactive {
            background: #D9D9D9;
        }

        /* ===== AVAILABILITY SECTION ===== */
        .availability-section {
            position: relative;
            width: 1294px;
            max-width: 90%;
            height: 400px;
            margin: 0 auto;
        }

        .availability-box {
            width: 100%;
            height: 400px;
            border: 1px solid #000000;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .availability-box:hover {
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-green);
        }

        .availability-title {
            font-family: 'HeadlandOne', serif;
            font-size: 42px;
            line-height: 53px;
            color: #000000;
            margin-bottom: 34px;
        }

        .cities {
            font-family: 'Poppins', sans-serif;
            font-size: 36px;
            line-height: 54px;
            color: #000000;
            margin-bottom: 70px;
        }

        .contact-btn {
            display: inline-block;
            width: 380px;
            height: 73px;
            background: var(--accent-green);
            border: 1px solid #4EB149;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            line-height: 73px;
            color: var(--text-white);
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .contact-btn:hover {
            background: var(--accent-green-hover);
            transform: scale(1.02);
        }

        /* ===== TESTIMONI SECTION ===== */
        .testimoni-section {
            position: relative;
            width: 100%;
            height: 729px;
            background: rgba(217, 217, 217, 0.2);
            margin-top: 50px;
        }

        .testimoni-header {
            position: absolute;
            width: 1126px;
            max-width: 90%;
            left: 50%;
            transform: translateX(-50%);
            top: 0;
            text-align: center;
        }

        .testimoni-title {
            font-family: 'HeadlandOne', serif;
            font-size: 40px;
            line-height: 50px;
            color: #000000;
            margin-bottom: 18px;
        }

        .testimoni-subtitle {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            line-height: 36px;
            color: rgba(0, 0, 0, 0.8);
        }

        .testimoni-container {
            position: absolute;
            display: flex;
            gap: 37px;
            left: 50%;
            transform: translateX(-50%);
            top: 267px;
        }

        .testimoni-card {
            width: 444px;
            height: 365px;
            background: var(--text-white);
            box-shadow: var(--shadow), var(--shadow-lg);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            transition: var(--transition);
        }

        .testimoni-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .testimoni-avatar {
            width: 70px;
            height: 70px;
            background: url('https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&auto=format&fit=crop&w=1760&q=80');
            background-size: cover;
            background-position: center;
            border-radius: 50%;
            margin: 0 auto 11px;
            border: 3px solid var(--accent-green);
            transition: var(--transition);
        }

        .testimoni-card:hover .testimoni-avatar {
            transform: scale(1.1);
        }

        .testimoni-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 24px;
            line-height: 36px;
            color: #000000;
            text-align: center;
        }

        .testimoni-city {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            line-height: 30px;
            color: rgba(0, 0, 0, 0.6);
            text-align: center;
            margin-bottom: 20px;
        }

        .testimoni-rating {
            display: flex;
            gap: 0;
            margin-bottom: 77px;
        }

        .star {
            width: 52px;
            height: 52px;
            background: #F0BC0F;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            transition: var(--transition);
        }

        .star:hover {
            transform: rotate(180deg) scale(1.1);
        }

        .testimoni-text {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            line-height: 36px;
            text-align: center;
            color: rgba(0, 0, 0, 0.6);
            max-width: 418px;
        }

        /* ===== FAQ SECTION ===== */
        .faq-section {
            position: relative;
            width: 100%;
            height: 795px;
            background: var(--bg-light);
        }

        .faq-container {
            position: absolute;
            width: 1020px;
            max-width: 90%;
            left: 50%;
            transform: translateX(-50%);
            top: 49px;
        }

        .faq-title {
            font-family: 'HeadlandOne', serif;
            font-size: 40px;
            line-height: 50px;
            text-align: center;
            color: #000000;
            margin-bottom: 69px;
        }

        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 42px;
        }

        .faq-item {
            width: 1000px;
            max-width: 100%;
            height: 100px;
            background: var(--text-white);
            border: 0.1px solid #BCBDBE;
            box-shadow: var(--shadow);
            border-radius: 8px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            position: relative;
            cursor: pointer;
            transition: var(--transition);
        }

        .faq-item:hover {
            transform: translateX(10px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-green);
        }

        .faq-question {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            line-height: 36px;
            color: #000000;
            flex: 1;
        }

        .faq-icon {
            width: 54px;
            height: 54px;
            position: relative;
        }

        .faq-icon::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 24px;
            height: 24px;
            border-left: 2px solid #000000;
            border-bottom: 2px solid #000000;
            transform: translate(-50%, -50%) rotate(-45deg);
            transition: var(--transition);
        }

        .faq-icon.active::after {
            transform: translate(-50%, -50%) rotate(135deg);
        }

        .faq-answer {
            position: absolute;
            top: 100px;
            left: 0;
            width: 100%;
            padding: 20px 24px;
            background: #f9f9f9;
            border-radius: 0 0 8px 8px;
            font-size: 18px;
            color: var(--text-gray);
            box-shadow: var(--shadow);
        }

        /* ===== CONTACT SECTION ===== */
        .contact-section {
            position: relative;
            width: 100%;
            padding: 46px 0;
            background: var(--bg-light);
        }

        .contact-wrapper {
            width: 1440px;
            max-width: 90%;
            margin: 0 auto;
            padding: 0 62px;
        }

        .contact-info {
            display: flex;
            gap: 64px;
            margin-bottom: 64px;
        }

        .info-left {
            flex: 1;
        }

        .info-title {
            font-family: 'HeadlandOne', serif;
            font-size: 40px;
            line-height: 50px;
            color: #000000;
            margin-bottom: 24px;
        }

        .info-description {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            line-height: 36px;
            color: var(--text-gray);
            max-width: 835px;
        }

        .contact-details {
            margin-top: 30px;
        }

        .contact-detail-item {
            display: flex;
            align-items: center;
            gap: 36px;
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .contact-detail-item:hover {
            transform: translateX(10px);
            color: var(--accent-green);
        }

        .detail-icon {
            width: 42px;
            height: 42px;
            background: var(--primary-blue);
            border-radius: 50%;
            transition: var(--transition);
        }

        .contact-detail-item:hover .detail-icon {
            background: var(--accent-green);
            transform: rotate(360deg);
        }

        .detail-text {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            line-height: 36px;
            color: var(--text-gray);
        }

        .info-right {
            width: 458px;
            height: 457px;
            background: #e0e0e0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 24px;
            transition: var(--transition);
        }

        .info-right:hover {
            transform: scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        .form-section {
            width: 1064px;
            max-width: 100%;
            margin-top: 64px;
        }

        .form-title {
            font-family: 'HeadlandOne', serif;
            font-size: 36px;
            line-height: 45px;
            color: #000000;
            margin-bottom: 50px;
        }

        .form-row {
            display: flex;
            gap: 64px;
            margin-bottom: 42px;
        }

        .form-group {
            flex: 1;
        }

        .form-input {
            width: 100%;
            height: 80px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            padding: 0 32px;
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            color: #737373;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-green);
            box-shadow: 0 0 0 3px rgba(78, 177, 73, 0.2);
            transform: scale(1.02);
        }

        .form-textarea {
            width: 100%;
            height: 284px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            padding: 24px 32px;
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            color: #737373;
            resize: none;
            transition: var(--transition);
        }

        .form-textarea:focus {
            outline: none;
            border-color: var(--accent-green);
            box-shadow: 0 0 0 3px rgba(78, 177, 73, 0.2);
        }

        .send-btn {
            width: 400px;
            height: 84px;
            background: var(--accent-green);
            border-radius: 8px;
            border: none;
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            line-height: 84px;
            color: var(--text-white);
            margin: 64px auto 0;
            display: block;
            cursor: pointer;
            text-align: center;
            transition: var(--transition);
        }

        .send-btn:hover {
            background: var(--accent-green-hover);
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
        }

        /* ===== SUPPORTED BY SECTION ===== */
        .supported-section {
            position: relative;
            width: 1294px;
            max-width: 90%;
            height: 304px;
            margin: 0 auto;
        }

        .supported-box {
            width: 100%;
            height: 304px;
            background: rgba(217, 217, 217, 0.2);
            box-shadow: var(--shadow);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .supported-box:hover {
            box-shadow: var(--shadow-lg);
        }

        .supported-title {
            font-family: 'HeadlandOne', serif;
            font-size: 32px;
            line-height: 40px;
            color: #737373;
            margin-bottom: 55px;
        }

        .supported-logos {
            display: flex;
            gap: 110px;
        }

        .logo-circle {
            width: 120px;
            height: 120px;
            background: #D9D9D9;
            border-radius: 50%;
            transition: var(--transition);
        }

        .logo-circle:hover {
            transform: scale(1.2) rotate(360deg);
            background: var(--accent-green);
        }

        /* ===== FOOTER ===== */
        .footer {
            position: relative;
            width: 100%;
            margin-top: 50px;
        }

        .footer-main {
            width: 100%;
            height: 583px;
            background: #0C162A;
        }

        .footer-content {
            display: flex;
            gap: 150px;
            padding: 130px 126px;
            max-width: 1440px;
            margin: 0 auto;
        }

        .footer-logo-section {
            width: 473px;
        }

        .footer-logo {
            display: block;
            width: 182px;
            height: 94px;
            background: #3a4a6b;
            border-radius: 8px;
            margin-bottom: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-logo:hover {
            background: #4a5a7b;
            transform: scale(1.05);
        }

        .footer-tagline {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 24px;
            line-height: 36px;
            color: var(--text-white);
            margin-bottom: 136px;
        }

        .social-icons {
            display: flex;
            gap: 42px;
        }

        .social-icon {
            display: block;
            width: 42px;
            height: 42px;
            background: #EFEFEF;
            border-radius: 50%;
            transition: var(--transition);
        }

        .social-icon:hover {
            transform: translateY(-5px) scale(1.1);
            background: var(--accent-green);
        }

        .footer-links {
            display: flex;
            gap: 115px;
        }

        .link-column {
            display: flex;
            flex-direction: column;
        }

        .link-header {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 28px;
            line-height: 42px;
            color: var(--text-white);
            margin-bottom: 62px;
        }

        .link-item {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            line-height: 42px;
            color: var(--text-white);
            text-decoration: none;
            margin-bottom: 50px;
            transition: var(--transition);
            position: relative;
            display: inline-block;
        }

        .link-item::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-green);
            transition: var(--transition);
        }

        .link-item:hover::after {
            width: 100%;
        }

        .link-item:hover {
            color: var(--accent-green);
            transform: translateX(10px);
        }

        .copyright {
            width: 100%;
            height: 84px;
            background: #0C162A;
            border-top: 2px solid var(--text-white);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
        }

        .copyright-icon {
            width: 38px;
            height: 38px;
            border: 2px solid var(--text-white);
            border-radius: 50%;
            position: relative;
            transition: var(--transition);
        }

        .copyright-icon:hover {
            transform: rotate(360deg);
            border-color: var(--accent-green);
        }

        .copyright-icon::after {
            content: '©';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
        }

        .copyright-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 20px;
            line-height: 30px;
            color: var(--text-white);
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes gentlePulse {
            0% { box-shadow: 0 6px 15px rgba(78, 177, 73, 0.4); }
            50% { box-shadow: 0 6px 20px rgba(78, 177, 73, 0.7), 0 0 0 3px rgba(78, 177, 73, 0.2); }
            100% { box-shadow: 0 6px 15px rgba(78, 177, 73, 0.4); }
        }

        @keyframes slideDown {
            from { transform: translate(-50%, -100%); }
            to { transform: translate(-50%, 0); }
        }

        .hero-content, .explore-section, .about-section, .packages-section,
        .availability-section, .testimoni-section, .faq-section,
        .contact-section, .supported-section, .footer {
            animation: fadeIn 1s ease-out;
        }

        /* ===== UTILITY CLASSES ===== */
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            animation: fadeIn 0.5s ease-out;
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 1440px) {
            .header { width: 100%; }
            
            .nav-menu {
                left: auto;
                right: 300px;
                gap: 25px;
            }
            
            .nav-menu li a { font-size: 16px; }
            
            .booking-now {
                left: auto;
                right: 40px;
                font-size: 16px;
            }
            
            .apartment-types { gap: 30px; }
            .type-card { width: 220px; }
            .packages-container { gap: 20px; }
            .package-card { width: 400px; }
            .card-bg { width: 400px; }
            .card-image { width: 350px; }
            .view-detail-btn { margin-left: 250px; }
            .testimoni-container { gap: 20px; }
            .testimoni-card { width: 380px; }
            .footer-content { gap: 100px; padding: 100px 60px; }
        }

        @media (max-width: 1024px) {
            .nav-menu {
                right: 160px;
                gap: 20px;
            }
            
            .nav-menu li a { font-size: 15px; }
            .booking-now { font-size: 15px; right: 30px; }
        }

        @media (max-width: 768px) {
            .mobile-menu-btn { display: flex; }
            
            .nav-menu {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background: linear-gradient(135deg, #081123 0%, #1a2635 100%);
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 30px;
                transition: left 0.3s ease;
                z-index: 100;
            }
            
            .nav-menu.active { left: 0; }
            .nav-menu li a { font-size: 20px; }
            .booking-now { right: 70px; }
            
            .mobile-menu-btn.active span:nth-child(1) {
                transform: rotate(45deg) translate(4px, 4px);
            }
            .mobile-menu-btn.active span:nth-child(2) { opacity: 0; }
            .mobile-menu-btn.active span:nth-child(3) {
                transform: rotate(-45deg) translate(5px, -5px);
            }
            
            .header.scrolled {
                height: 65px;
            }
            .header.scrolled .logo {
                top: 10px;
                width: 75px;
                height: 38px;
            }
            .header.scrolled .nav-menu { top: 18px; }
            .header.scrolled .booking-now {
                top: 12px;
                padding: 6px 16px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .logo {
                width: 70px;
                height: 38px;
                left: 20px;
                top: 21px;
            }
            .booking-now {
                font-size: 14px;
                right: 50px;
            }
            .mobile-menu-btn { right: 20px; }
        }
    </style>
</head>
<body>
    <div class="landing-page">
        <!-- Header / Navbar -->
        <header class="header">
            <nav class="navbar">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Vantix Stay">
                </a>

                <ul class="nav-menu">
                    <li><a href="{{ url('/') }}">HOME</a></li>
                    <li><a href="{{ url('/property') }}">PROPERTY</a></li>
                    <li><a href="{{ url('/about') }}">ABOUT</a></li>
                    <li><a href="{{ url('/contact') }}">CONTACT</a></li>
                </ul>

                <a href="{{ url('/booking') }}" class="booking-now">BOOKING NOW</a>

                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-bg"></div>
            <div class="hero-content">
                <h1 class="hero-title">Selamat Datang di Vantix Stay</h1>
                <p class="hero-subtitle">Temukan apartemen modern dan nyaman untuk pengalaman menginap yang lebih menyenangkan</p>
                <form class="search-box" action="{{ url('/property') }}" method="GET">
                    <div class="search-icon"></div>
                    <input type="text" name="search" class="search-input" placeholder="Cari apartemen..." value="{{ request('search') }}">
                </form>
            </div>
        </section>

        <!-- Explore Apartment Types -->
        <section class="explore-section">
            <h2 class="explore-title">Explore Apartment Types</h2>
            <div class="apartment-types">
                <a href="{{ url('/property?type=commercial') }}" class="type-card">
                    <div class="type-icon"></div>
                    <span class="type-name">Commercial</span>
                    <span class="type-properties">10 Properties</span>
                </a>
                <a href="{{ url('/property?type=warehouse') }}" class="type-card">
                    <div class="type-icon"></div>
                    <span class="type-name">Warehouse</span>
                    <span class="type-properties">10 Properties</span>
                </a>
                <a href="{{ url('/property?type=villa') }}" class="type-card">
                    <div class="type-icon"></div>
                    <span class="type-name">Villa</span>
                    <span class="type-properties">10 Properties</span>
                </a>
                <a href="{{ url('/property?type=homestay') }}" class="type-card">
                    <div class="type-icon"></div>
                    <span class="type-name">Homestay</span>
                    <span class="type-properties">10 Properties</span>
                </a>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section">
            <div class="about-content">
                <div class="about-text">
                    <h3 class="about-title">Vantix Stay</h3>
                    <p class="about-description">Morem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus.</p>
                </div>
                <div class="about-image1"></div>
                <div class="about-image2"></div>
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
                <div class="package-card">
                    <div class="card-bg">
                        <div class="card-image"></div>
                        <div class="card-content">
                            <span class="card-type">Tipe 1</span>
                            <h3 class="card-name">Grand Asia Afrika Apartement</h3>
                            <p class="card-price">Price IDR 100,000 - 500,000</p>
                            <a href="{{ url('/property/1') }}" class="view-detail-btn">View Detail</a>
                        </div>
                    </div>
                </div>
                
                <div class="package-card">
                    <div class="card-bg">
                        <div class="card-image"></div>
                        <div class="card-content">
                            <span class="card-type">Tipe 2</span>
                            <h3 class="card-name">Sudirman Suites</h3>
                            <p class="card-price">Price IDR 300,000 - 800,000</p>
                            <a href="{{ url('/property/2') }}" class="view-detail-btn">View Detail</a>
                        </div>
                    </div>
                </div>
                
                <div class="package-card">
                    <div class="card-bg">
                        <div class="card-image"></div>
                        <div class="card-content">
                            <span class="card-type">Tipe 3</span>
                            <h3 class="card-name">Malioboro Residence</h3>
                            <p class="card-price">Price IDR 150,000 - 350,000</p>
                            <a href="{{ url('/property/3') }}" class="view-detail-btn">View Detail</a>
                        </div>
                    </div>
                </div>
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
                <p class="cities">Jakarta | Bandung | Yogyakarta | Malang | Bogor</p>
                <a href="{{ url('/contact') }}" class="contact-btn">Contact Us</a>
            </div>
        </section>

        <!-- Testimoni Section -->
        <section class="testimoni-section">
            <div class="testimoni-header">
                <h2 class="testimoni-title">Our Testimoni</h2>
                <p class="testimoni-subtitle">Jorem ipsum dolor sit amet consectetur Jorem ipsum dolor sit amet consecteturJorem ipsum</p>
            </div>
            
            <div class="testimoni-container">
                <div class="testimoni-card">
                    <div class="testimoni-avatar"></div>
                    <h4 class="testimoni-name">Alexander Thomas</h4>
                    <p class="testimoni-city">Bandung</p>
                    <div class="testimoni-rating">
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                    </div>
                    <p class="testimoni-text">Rorem ipsum dolor sit amet consectetur Rorem ipsum dolor sit amet consectetur</p>
                </div>
                
                <div class="testimoni-card">
                    <div class="testimoni-avatar"></div>
                    <h4 class="testimoni-name">Sarah Wijaya</h4>
                    <p class="testimoni-city">Jakarta</p>
                    <div class="testimoni-rating">
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                    </div>
                    <p class="testimoni-text">Pelayanan sangat baik, apartemen bersih dan nyaman</p>
                </div>
                
                <div class="testimoni-card">
                    <div class="testimoni-avatar"></div>
                    <h4 class="testimoni-name">Budi Santoso</h4>
                    <p class="testimoni-city">Surabaya</p>
                    <div class="testimoni-rating">
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                    </div>
                    <p class="testimoni-text">Pengalaman menginap yang tak terlupakan, recommended!</p>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="faq-container">
                <h2 class="faq-title">Popular Question</h2>
                <div class="faq-list">
                    <div class="faq-item" onclick="toggleFaq(this)">
                        <span class="faq-question">Can I cancel or modify my reservation ?</span>
                        <span class="faq-icon"></span>
                    </div>
                    <div class="faq-item" onclick="toggleFaq(this)">
                        <span class="faq-question">What facilities are included in the apartment ?</span>
                        <span class="faq-icon"></span>
                    </div>
                    <div class="faq-item" onclick="toggleFaq(this)">
                        <span class="faq-question">Is there a minimum stay requirement?</span>
                        <span class="faq-icon"></span>
                    </div>
                    <div class="faq-item" onclick="toggleFaq(this)">
                        <span class="faq-question">How do I book an apartment?</span>
                        <span class="faq-icon"></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="contact-wrapper">
                @if(session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="contact-info">
                    <div class="info-left">
                        <h2 class="info-title">Get in Touch</h2>
                        <p class="info-description">Yorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Etiam eu turpis molestie, dictum est a, mattis tellus. Etiam eu turpis molestie, dictum est a, mattis tellus.</p>
                        
                        <div class="contact-details">
                            <div class="contact-detail-item">
                                <div class="detail-icon"></div>
                                <span class="detail-text">(123) 546 8972</span>
                            </div>
                            <div class="contact-detail-item">
                                <div class="detail-icon"></div>
                                <span class="detail-text">vantix@gmail.com</span>
                            </div>
                            <div class="contact-detail-item">
                                <div class="detail-icon"></div>
                                <span class="detail-text">Kota Bandung, Jawa Barat</span>
                            </div>
                            <div class="contact-detail-item">
                                <div class="detail-icon"></div>
                                <span class="detail-text">www.vantix.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="info-right">
                        Map Location
                    </div>
                </div>
                
                <div class="form-section">
                    <h3 class="form-title">Send us a message</h3>
                    <form action="{{ url('/contact/send') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" name="name" class="form-input" placeholder="Your name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-input" placeholder="Email Address" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <input type="tel" name="phone" class="form-input" placeholder="Phone" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" class="form-input" placeholder="Subject" required>
                            </div>
                        </div>
                        <textarea name="message" class="form-textarea" placeholder="Message" required></textarea>
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
                    <div class="logo-circle"></div>
                    <div class="logo-circle"></div>
                    <div class="logo-circle"></div>
                    <div class="logo-circle"></div>
                    <div class="logo-circle"></div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-main">
                <div class="footer-content">
                    <div class="footer-logo-section">
                        <a href="{{ url('/') }}" class="footer-logo">Vantix Stay</a>
                        <p class="footer-tagline">Apartment modern dan nyaman untuk pengalaman menginap terbaik</p>
                        <div class="social-icons">
                            <a href="#" class="social-icon"></a>
                            <a href="#" class="social-icon"></a>
                            <a href="#" class="social-icon"></a>
                            <a href="#" class="social-icon"></a>
                        </div>
                    </div>
                    <div class="footer-links">
                        <div class="link-column">
                            <h4 class="link-header">Company</h4>
                            <a href="{{ url('/') }}" class="link-item">Home</a>
                            <a href="{{ url('/property') }}" class="link-item">Property</a>
                            <a href="{{ url('/about') }}" class="link-item">About</a>
                            <a href="{{ url('/contact') }}" class="link-item">Contact</a>
                        </div>
                        <div class="link-column">
                            <h4 class="link-header">Support</h4>
                            <a href="#" class="link-item">Help center</a>
                            <a href="#" class="link-item">Tweet</a>
                            <a href="#" class="link-item">Feedback</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="copyright-icon"></div>
                <span class="copyright-text">Copyright {{ date('Y') }} by Vantix Stay. All Rights Reserved.</span>
            </div>
        </footer>
    </div>

    <!-- JavaScript -->
    <script>
        // FAQ Toggle
        function toggleFaq(element) {
            const icon = element.querySelector('.faq-icon');
            icon.classList.toggle('active');
            
            const answer = element.querySelector('.faq-answer');
            if (answer) {
                answer.remove();
            } else {
                const newAnswer = document.createElement('div');
                newAnswer.className = 'faq-answer';
                newAnswer.textContent = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
                element.appendChild(newAnswer);
            }
        }

        // Navbar Scroll Effect
        let lastScrollTop = 0;
        const header = document.querySelector('.header');
        const scrollThreshold = 100;

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > scrollThreshold) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                header.classList.add('hide');
                header.classList.remove('show');
            } else {
                header.classList.remove('hide');
                header.classList.add('show');
            }
            
            lastScrollTop = scrollTop;
        });

        // Active Menu State
        function setActiveMenu() {
            const currentPath = window.location.pathname;
            const navItems = document.querySelectorAll('.nav-menu li');
            
            navItems.forEach(item => item.classList.remove('active'));
            
            document.querySelectorAll('.nav-menu a').forEach(link => {
                const href = link.getAttribute('href');
                if (href === currentPath || 
                    (currentPath.includes('property') && href.includes('property')) ||
                    (currentPath === '/about' && href === '/about') ||
                    (currentPath === '/contact' && href === '/contact') ||
                    (currentPath === '/' && href === '/')) {
                    link.parentElement.classList.add('active');
                }
            });
        }

        // Mobile Menu
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navMenu = document.querySelector('.nav-menu');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                this.classList.toggle('active');
                navMenu.classList.toggle('active');
                document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : 'auto';
            });
        }

        // Close mobile menu on link click
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    mobileMenuBtn?.classList.remove('active');
                    navMenu?.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            });
        });

        // Close mobile menu on outside click
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (!e.target.closest('.navbar') && navMenu?.classList.contains('active')) {
                    mobileMenuBtn?.classList.remove('active');
                    navMenu?.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                mobileMenuBtn?.classList.remove('active');
                navMenu?.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            header.classList.add('show');
            setActiveMenu();

            // Auto-hide alert
            const alert = document.querySelector('.alert-success');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.style.display = 'none', 300);
                }, 5000);
            }
        });

        // Search animation
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.addEventListener('focus', () => searchInput.parentElement.style.transform = 'scale(1.02)');
            searchInput.addEventListener('blur', () => searchInput.parentElement.style.transform = 'scale(1)');
        }

        // Package card hover
        document.querySelectorAll('.package-card').forEach(card => {
            card.addEventListener('mouseenter', () => card.style.zIndex = '10');
            card.addEventListener('mouseleave', () => card.style.zIndex = '1');
        });

        // Dots click
        document.querySelectorAll('.dot').forEach((dot, index) => {
            dot.addEventListener('click', function() {
                document.querySelectorAll('.dot').forEach(d => d.classList.remove('dot-active'));
                this.classList.add('dot-active');
            });
        });
    </script>
</body>
</html>