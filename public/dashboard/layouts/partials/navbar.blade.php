<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm position-relative">
    <div class="container-fluid">
        <!-- Hamburger Menu Button -->
        <button class="hamburger-menu" id="hamburgerMenu" onclick="toggleSidebar()">
            <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 14H35M7 21H35M7 28H35" stroke="#918972" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
        </button>

        <!-- Brand / Title -->
        <a class="navbar-brand navbar-center" href="#">Mr. John</a>

        <!-- Search Bar -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <form class="navbar-search-wrapper">
                    <input 
                        type="text" 
                        class="navbar-search"
                        placeholder="Search..."
                    >
                    <i class="fas fa-search navbar-search-icon"></i>
                </form>
            </li>
        </ul>
    </div>
</nav>