@if (request()->is('admin/*'))

    {{-- ADMIN SIDEBAR --}}
    <li class="nav-item">
        <a href="/admin/dashboard" class="nav-link">
            <i class="fas fa-chart-bar"></i>
            <p>Dashboard Admin</p>
        </a>
    </li>

@elseif (request()->is('superadmin/*'))

    {{-- SUPERADMIN SIDEBAR --}}
    <li class="nav-item">
        <a href="/superadmin/dashboard" class="nav-link">
            <i class="fas fa-crown"></i>
            <p>Dashboard Superadmin</p>
        </a>
    </li>

@else

    {{-- USER SIDEBAR --}}
    <li class="nav-item">
        <a href="/dashboard" class="nav-link">
            <i class="fas fa-home"></i>
            <p>Dashboard User</p>
        </a>
    </li>

@endif