<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        /* wrapper sebagai container utama */
        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        /* main area untuk sidebar dan content */
        .main {
            display: flex;
            flex: 1 1 auto;
            overflow: hidden;
            min-height: 0;
        }

        /* sidebar styling */
        .sidebar {
            width: 287px;
            background: linear-gradient(
                180deg,
                #1E1E1E 18.81%,
                #827B67 70.99%,
                #E4D3A0 100%
            );
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        /* sidebar-custom sebagai container fleksibel */
        .sidebar-custom {
            display: flex;
            flex-direction: column;
            height: 100%;
            background: transparent;
        }

        /* menu mengambil ruang yang tersisa */
        .sidebar-custom .nav {
            flex: 1 1 auto;
        }

        /* logout di bagian bawah */
        .sidebar-logout {
            margin-top: auto;
            padding: 5px;
        }

        /* content wrapper - sebagai container untuk konten dan footer */
        .content-wrapper {
            flex: 1;
            background: #1E1E1E;
            color: #FFD700;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        /* Container untuk konten utama */
        .main-content {
            flex: 1;
            padding: 20px 24px;
        }

        /* navbar styling */
        .navbar-custom {
            background: linear-gradient(
                90deg,
                #1E1E1E 50%,
                #E4D3A0 100%
            );
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            min-height: 50px;
            flex-shrink: 0;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white !important;
        }

        .navbar-search {
            width: 236px;
            height: 39px;
            background: #D9D9D9;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 8px;
            border: none;
            padding-left: 12px;
            padding-right: 40px;
        }

        .navbar-search:focus {
            outline: none;
        }

        .navbar-search-wrapper {
            position: relative;
        }

        .navbar-search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #555;
        }

        .navbar-custom .navbar-center {
            position: absolute;
            left: 10%;
            transform: translateX(-50%);
            font-weight: 600;
            font-size: 18px;
            letter-spacing: 0.5px;
            color: #FFD700 !important;
        }

        /* footer styling - hanya di dalam content-wrapper */
        .footer-custom {
            background: #615515;
            border: 2px solid rgba(245, 229, 107, 0.5);
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            flex-shrink: 0;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #F5E56B;
            font-size: 15px;
            font-weight: 500;
        }

        .footer-content i {
            color: #F5E56B;
        }

        .logout-divider {
            border-top: 1px solid #737373;
            margin-bottom: 10px;
        }

        .logout-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(109, 104, 90, 0.8);
            font-size: 20px;
            text-decoration: none;
            padding-left: 50px;
            padding-top: 10px;
            padding-bottom: 10px;
            transition: 0.3s;
        }

        .logout-item:hover {
            color: #FFD700;
        }

        .sidebar-custom .nav-link {
            color: #958D75;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: 0.3s;
        }

        .sidebar-custom .nav-link svg {
            fill: currentColor;
        }

        .sidebar-custom .nav-link:hover {
            color: #FFD700;
            background: rgba(255,255,255,0.1);
            padding-left: 12px;
        }

        .sidebar-custom .nav-link.active {
            color: #FFD700;
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="wrapper">
        @include('dashboard.layouts.partials.navbar')

        <div class="main">
            @include('dashboard.layouts.partials.sidebar')

            <div class="content-wrapper">
                <div class="main-content">
                    @yield('content')
                </div>
                @include('dashboard.layouts.partials.footer')
            </div>
        </div>
    </div>

    @include('dashboard.layouts.partials.scripts')
</body>
</html>