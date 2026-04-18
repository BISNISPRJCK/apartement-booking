@extends('adminlte::master')
@stack('styles')
@stack('scripts')

@section('body')
<div class="wrapper">
    {{-- Navbar --}}
    <nav class="main-header navbar navbar-expand">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>    
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item search-item">
                <form class="navbar-search">
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="admin-search" placeholder="Search...">
                    </div>
                </form>
            </li>
        </ul>
    </nav>

    {{-- Sidebar --}}
    <aside class="main-sidebar elevation-4">
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">Admin</span>
        </a>

        <div class="sidebar">
            <nav>
                <ul class="nav nav-pills nav-sidebar flex-column">
                    {{-- Menu Profile --}}
                    <li class="nav-item first-menu">
                        <a href="/admin/profile" class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>Profile</p>
                        </a>
                    </li>

                    {{-- Menu Booking --}}
                    <li class="nav-item">
                        <a href="/admin/booking" class="nav-link {{ request()->is('admin/booking') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Booking</p>
                        </a>
                    </li>

                    {{-- Menu Invoice --}}
                    <li class="nav-item">
                        <a href="/admin/invoice" class="nav-link {{ request()->is('admin/invoice') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>Invoice</p>
                        </a>
                    </li>

                    {{-- Menu Data User --}}
                    <li class="nav-item">
                        <a href="/admin/users" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-database"></i>
                            <p>Data User</p>
                        </a>
                    </li>

                    {{-- Divider --}}
                    <li class="nav-item sidebar-divider"><hr></li>

                    {{-- Menu CMS dengan Dropdown --}}
                    <li class="nav-item has-treeview {{ request()->is('admin/cms*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/cms*') ? 'active' : '' }}" onclick="toggleDropdown(event)">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>CMS <i class="fas fa-angle-right right"></i></p>
                        </a>
                        <ul class="nav nav-treeview" style="display: {{ request()->is('admin/cms*') ? 'block' : 'none' }};">
                            <li class="nav-item">
                                <a href="/admin/cms/product" class="nav-link sub-link {{ request()->is('admin/cms/product') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/cms/contact" class="nav-link sub-link {{ request()->is('admin/cms/contact') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-envelope"></i>
                                    <p>Contact</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/cms/about" class="nav-link sub-link {{ request()->is('admin/cms/about') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-info-circle"></i>
                                    <p>About</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                {{-- Divider sebelum logout --}}
                <div class="logout-divider"></div>

                {{-- Logout Button --}}
                <div class="logout-footer">
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </nav>
        </div>
    </aside>

    {{-- Content --}}
    <div class="content-wrapper p-3">
        @yield('content')
    </div>
</div>

<script>
    function toggleDropdown(event) {
        event.preventDefault();
        const submenu = event.currentTarget.nextElementSibling;
        const icon = event.currentTarget.querySelector('.right');
        
        if (submenu.style.display === 'none' || submenu.style.display === '') {
            submenu.style.display = 'block';
            icon.classList.remove('fa-angle-right');
            icon.classList.add('fa-angle-down');
        } else {
            submenu.style.display = 'none';
            icon.classList.remove('fa-angle-down');
            icon.classList.add('fa-angle-right');
        }
    }
</script>
@stop

@section('adminlte_css')
<style>
/* ========================================
   HAMBURGER MENU - SELALU MUNCUL DI SEMUA LAYAR
   ======================================== */
.navbar-nav .nav-link[data-widget="pushmenu"] {
    display: flex !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* ========================================
   SEARCH BOX
   ======================================== */
.search-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    height: 100%;
}

.admin-search {
    width: 200px;
    height: 35px;
    background: #D9D9D9;
    border-radius: 6px;
    border: none;
    padding-left: 10px;
    padding-right: 32px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    font-size: 13px;
    margin: 0;
    vertical-align: middle;
}

.search-icon {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #555;
    font-size: 12px;
    pointer-events: none;
}

.admin-search:focus {
    outline: none;
}

.admin-search::placeholder {
    font-size: 12px;
}

/* ========================================
   NAVBAR - SEJAJAR DENGAN BRAND SIDEBAR
   ======================================== */
body .main-header.navbar {
    height: 55px !important;
    min-height: 55px !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    background: linear-gradient(90deg, #000080 50.48%, rgba(0, 0, 128, 0.2) 99.52%) !important;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25) !important;
    border: none !important;
    display: flex !important;
    align-items: center !important;
}

.main-header.navbar .navbar-nav {
    display: flex;
    align-items: center;
}

.main-header.navbar .navbar-nav .nav-link {
    color: #fff !important;
    padding: 8px 12px !important;
    display: flex;
    align-items: center;
}

.main-header.navbar .navbar-nav .nav-link i {
    color: #fff !important;
    font-size: 20px;
}

/* Search item alignment */
.search-item {
    display: flex !important;
    align-items: center !important;
    height: 100%;
}

.navbar-search {
    display: flex;
    align-items: center;
    height: 100%;
    margin: 0;
}

/* ========================================
   SIDEBAR
   ======================================== */
.main-sidebar {
    background: linear-gradient(180deg, #000080 36.54%, rgba(0, 0, 128, 0.2) 86.06%) !important;
    box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.25) !important;
    border: none !important;
}

.sidebar {
    display: flex !important;
    flex-direction: column !important;
    height: 100% !important;
    justify-content: space-between !important;
}

.sidebar nav {
    flex: 1 !important;
}

/* ----- Brand - SEJAJAR DENGAN NAVBAR ----- */
.main-sidebar .brand-link {
    background: transparent !important;
    border: none !important;
    padding: 15px 20px !important;
    height: 55px !important;
    display: flex !important;
    align-items: center !important;
}

.main-sidebar .brand-text {
    color: white !important;
    font-weight: 600;
    font-size: 16px;
}

/* ----- Menu Item ----- */
.first-menu {
    margin-top: 10px !important;
}

.main-sidebar .nav-sidebar .nav-link {
    color: rgba(255, 255, 255, 0.6) !important;
    font-size: 16px !important;
    font-weight: 400 !important;
    margin-bottom: 12px !important;
    padding: 10px 16px !important;
    border-radius: 8px !important;
    transition: all 0.3s ease !important;
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
}

.main-sidebar .nav-sidebar .nav-link:hover {
    background: rgba(73, 73, 226, 0.2) !important;
    border-radius: 8px !important;
    color: #fff !important;
    transform: translateX(5px);
}

.main-sidebar .nav-sidebar .nav-link.active {
    background: rgba(73, 73, 226, 0.2) !important;
    border-radius: 8px !important;
    color: #fff !important;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25) !important;
}

/* ----- Icon ----- */
.main-sidebar .nav-sidebar .nav-icon {
    color: rgba(255, 255, 255, 0.6) !important;
    font-size: 20px !important;
    width: 28px !important;
    text-align: center !important;
}

.main-sidebar .nav-sidebar .nav-link:hover .nav-icon,
.main-sidebar .nav-sidebar .nav-link.active .nav-icon {
    color: #fff !important;
}

/* ----- Menu Text & Arrow ----- */
.main-sidebar .nav-sidebar .nav-link p {
    margin: 0 !important;
    font-size: 16px !important;
    flex: 1;
}

.main-sidebar .nav-sidebar .nav-link .right {
    margin-left: auto;
    font-size: 14px;
    transition: transform 0.3s ease;
    color: rgba(255, 255, 255, 0.6);
}

.main-sidebar .nav-sidebar .nav-link:hover .right,
.main-sidebar .nav-sidebar .nav-link.active .right {
    color: #fff;
}

.menu-open .nav-link .right {
    transform: rotate(90deg);
}

/* ----- Divider ----- */
.sidebar-divider {
    margin: 15px 0 !important;
    list-style: none;
}

.sidebar-divider hr {
    border: none;
    height: 1px;
    background: rgba(255, 255, 255, 0.15);
    margin: 0;
}

/* ----- Sub Menu Dropdown ----- */
.nav-treeview {
    margin-left: 60px;
    margin-top: 5px;
    margin-bottom: 10px;
    padding-left: 10;
    list-style: none;
    display: none;
}

.nav-treeview .nav-link {
    font-size: 14px !important;
    margin-bottom: 8px !important;
    padding: 8px 16px 8px 45px !important;
    border-left: 2px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    color: rgba(255, 255, 255, 0.5) !important;
}

.nav-treeview .nav-link:hover {
    background: rgba(73, 73, 226, 0.1) !important;
    border-left: 2px solid rgba(255, 255, 255, 0.5) !important;
    transform: translateX(3px);
    color: #fff !important;
}

.nav-treeview .nav-link.active {
    background: rgba(73, 73, 226, 0.2) !important;
    color: #fff !important;
    border-left: 2px solid rgba(255, 255, 255, 0.8) !important;
}

.nav-treeview .nav-icon {
    font-size: 16px !important;
    width: 22px !important;
    color: rgba(255, 255, 255, 0.5) !important;
}

.nav-treeview .nav-link:hover .nav-icon,
.nav-treeview .nav-link.active .nav-icon {
    color: #fff !important;
}

.nav-treeview .nav-link p {
    font-size: 14px !important;
    margin: 0 !important;
}

/* ========================================
   LOGOUT
   ======================================== */
.logout-divider {
    height: 1px;
    background: rgba(255, 255, 255, 0.15);
    margin: 20px 16px;
}

.logout-footer {
    margin-bottom: 20px;
}

.logout-link {
    margin-bottom: 0 !important;
}

.logout-link:hover {
    background: rgba(220, 53, 69, 0.2) !important;
}

.logout-link:hover .nav-icon,
.logout-link:hover p {
    color: #ff6b6b !important;
}

/* ========================================
   CONTENT - UKURAN AWAL
   ======================================== */
.content-wrapper {
    margin-top: 0 !important;
    background: #ffffff !important;
}

.content-wrapper .content,
.content-wrapper .content .container-fluid,
body:not(.layout-fixed) .content-wrapper {
    background: #ffffff !important;
}

/* ========================================
   RESPONSIVE
   ======================================== */

/* Tablet & Mobile (max-width: 768px) */
@media (max-width: 768px) {
    /* Search box disembunyikan di mobile */
    .navbar-nav.ml-auto .search-item {
        display: none !important;
    }
    
    /* HAMBURGER MENU TETAP MUNCUL */
    .navbar-nav .nav-link[data-widget="pushmenu"] {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    body .main-header.navbar {
        height: 50px !important;
        min-height: 50px !important;
    }
    
    .main-sidebar .brand-link {
        height: 50px !important;
        padding: 10px 20px !important;
    }

    .main-header.navbar .navbar-nav .nav-link i {
        font-size: 18px;
    }

    .first-menu {
        margin-top: 8px !important;
    }

    .main-sidebar .nav-sidebar .nav-link {
        font-size: 14px !important;
        margin-bottom: 8px !important;
        padding: 8px 12px !important;
        gap: 10px !important;
    }

    .main-sidebar .nav-sidebar .nav-icon {
        font-size: 18px !important;
        width: 24px !important;
    }

    .main-sidebar .nav-sidebar .nav-link p {
        font-size: 14px !important;
    }

    .nav-treeview .nav-link {
        font-size: 12px !important;
        padding: 6px 12px 6px 40px !important;
    }

    .nav-treeview .nav-link p {
        font-size: 12px !important;
    }

    .main-sidebar .brand-text {
        font-size: 14px;
    }

    .logout-divider {
        margin: 15px 12px;
    }

    .logout-footer {
        margin-bottom: 15px;
    }
}

/* Tablet (769px - 992px) */
@media (min-width: 769px) and (max-width: 992px) {
    .admin-search {
        width: 160px;
        height: 32px;
        font-size: 12px;
    }

    .search-icon {
        font-size: 11px;
        right: 8px;
    }

    .admin-search::placeholder {
        font-size: 11px;
    }

    .first-menu {
        margin-top: 8px !important;
    }

    .main-sidebar .nav-sidebar .nav-link {
        font-size: 14px !important;
        padding: 8px 12px !important;
    }

    .main-sidebar .nav-sidebar .nav-link p {
        font-size: 14px !important;
    }
}

/* Mobile Kecil (max-width: 480px) */
@media (max-width: 480px) {
    body .main-header.navbar {
        height: 45px !important;
        min-height: 45px !important;
    }
    
    .main-sidebar .brand-link {
        height: 45px !important;
        padding: 8px 20px !important;
    }
    
    .navbar-nav .nav-link[data-widget="pushmenu"] {
        display: flex !important;
        visibility: visible !important;
    }

    .main-header.navbar .navbar-nav .nav-link {
        padding: 6px 10px !important;
    }

    .main-header.navbar .navbar-nav .nav-link i {
        font-size: 16px;
    }
}

/* Desktop (min-width: 992px) - Hamburger menu tetap ada */
@media (min-width: 992px) {
    .navbar-nav .nav-link[data-widget="pushmenu"] {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
}
</style>
@stop