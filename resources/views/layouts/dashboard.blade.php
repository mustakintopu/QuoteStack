<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>QuoteStack Dashboard</title>

    <!-- Styles & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f8fafc;
            --dark: #0f172a;
            --border: #e2e8f0;
        }

        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }



        body {
            background-color: var(--light);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }

        body.dark-mode {
    background-color: #121212; /* dark background */
    color: #f0f0f0;            /* light text */
}

body.dark-mode a,
body.dark-mode .sidebar-link.active,
body.dark-mode .sidebar-link:hover {
    color: #60a5fa; /* brighter blue for links in dark */
}

body.dark-mode .card {
    background-color: #1e1e1e;
    color: #f0f0f0;
}

body.dark-mode .navbar {
    background-color: #1a1a1a;
    color: #f0f0f0;
}

body.dark-mode .sidebar {
    background-color: #1a1a1a;
    color: #ccc;
    border-right: 1px solid #333;
}

body.dark-mode .btn-logout {
    border-color: #ef4444;
    color: #ef4444;
    background-color: transparent;
}

body.dark-mode .btn-logout:hover {
    background-color: #660000;
    color: #fff;
}


        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        /* Navbar Styling */
        .navbar {
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            height: 70px;
            background: #fff;
            z-index: 1000;
            padding: 0 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .navbar.sidebar-collapsed {
            left: 80px;
        }

        .navbar .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 260px;
            background: #fff;
            padding: 1.5rem;
            border-right: 1px solid var(--border);
            z-index: 1001;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .sidebar.collapsed {
            width: 80px;
            padding: 1.5rem 0.75rem;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            margin-bottom: 2rem;
            white-space: nowrap;
        }

        .sidebar.collapsed .sidebar-brand {
            gap: 0;
            justify-content: center;
        }

        .sidebar-brand i {
            font-size: 1.75rem;
            color: var(--primary);
            min-width: 1.75rem;
        }

        .sidebar-brand span {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .sidebar-brand span {
            opacity: 0;
            width: 0;
            pointer-events: none;
        }

        .sidebar h4 {
            font-size: 0.75rem;
            color: var(--secondary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 1.5rem 0 1rem;
            padding-left: 0.5rem;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed h4 {
            opacity: 0;
            margin: 0.5rem 0;
            pointer-events: none;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--secondary);
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            white-space: nowrap;
            position: relative;
        }

        .sidebar-link i {
            font-size: 1.2rem;
            min-width: 1.2rem;
            text-align: center;
        }

        .sidebar-link span {
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .sidebar-link {
            justify-content: center;
            padding: 0.75rem;
            width: 45px;
            margin-left: auto;
            margin-right: auto;
        }

        .sidebar.collapsed .sidebar-link span {
            opacity: 0;
            width: 0;
            pointer-events: none;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: #e0f2fe;
            color: #2563eb;
        }

        .sidebar.collapsed .sidebar-link:hover::after {
            content: attr(data-title);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: var(--dark);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            white-space: nowrap;
            margin-left: 0.75rem;
            z-index: 1002;
            pointer-events: none;
        }

        .sidebar.collapsed .sidebar-link:hover::before {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 6px solid transparent;
            border-right-color: var(--dark);
            margin-left: -6px;
            z-index: 1002;
            pointer-events: none;
        }

        .btn-logout {
            width: 100%;
            margin-top: auto;
            padding: 0.75rem 1rem;
            background: transparent;
            color: #dc2626;
            border: 1px solid #dc2626;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            justify-content: center;
            white-space: nowrap;
        }

        .sidebar.collapsed .btn-logout {
            padding: 0.75rem;
            border-radius: 0.5rem;
        }

        .sidebar.collapsed .btn-logout span {
            opacity: 0;
            width: 0;
            pointer-events: none;
        }

        .btn-logout:hover {
            background-color: #fee2e2;
        }

        .content {
            margin-left: 260px;
            padding: 2rem;
            padding-top: 90px;
            transition: all 0.3s ease;
        }

        .content.sidebar-collapsed {
            margin-left: 80px;
        }

        .toggle-sidebar {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #334155;
            margin-right: 1rem;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .toggle-sidebar:hover {
            background-color: var(--light);
        }

        /* Card and Content Styling */
        .card {
            background: #fff;
            border-radius: 1rem;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06) !important;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border);
            padding: 1.25rem;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: var(--dark);
        }

        .card-body {
            padding: 1.25rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .welcome-section {
            background: linear-gradient(to right, #ffffff, #f8fafc);
            padding: 1.5rem;
            border-radius: 1rem;
            margin: -2rem -2rem 2rem -2rem;
            border-bottom: 1px solid var(--border);
        }

        .stat-card {
            padding: 1.75rem;
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            border-radius: 1rem;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            background: rgba(255, 255, 255, 0.2);
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon i {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .stat-label {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.25rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 600;
            color: white;
            margin: 0;
            line-height: 1.2;
        }

        .stat-desc {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            margin: 0.5rem 0 0 0;
        }

        .empty-state {
            padding: 2rem;
        }

        .empty-state-icon {
            width: 64px;
            height: 64px;
            background: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .empty-state-icon i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .table > :not(caption) > * > * {
            padding: 1rem 0.75rem;
        }

        .table thead th {
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .progress {
            overflow: visible;
        }

        .progress-bar {
            position: relative;
            overflow: visible;
            background: linear-gradient(to right, var(--primary), var(--primary-hover));
        }

        .bg-primary-subtle {
            background-color: #e0f2fe !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        /* User Profile in Navbar */
        .navbar-profile {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
        }

        .profile-info {
            text-align: right;
        }

        .profile-info h6 {
            margin: 0;
            font-weight: 600;
            color: var(--dark);
        }

        .profile-info span {
            font-size: 0.75rem;
            color: var(--secondary);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }

            .sidebar.show {
                transform: translateX(0);
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            .navbar,
            .content {
                left: 0;
                margin-left: 0 !important;
            }

            .navbar.sidebar-collapsed {
                left: 0;
            }

            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .overlay.show {
                opacity: 1;
                visibility: visible;
            }
        }

        /* Animated Progress Bar */
        .progress {
            height: 8px;
            margin: 0.5rem 0;
            background-color: var(--light);
            border-radius: 1rem;
            overflow: hidden;
        }

        .progress-bar {
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            border-radius: 1rem;
            transition: width 0.6s ease;
        }

        /* Badge Styling */
        .badge {
            padding: 0.35rem 0.65rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 0.5rem;
        }

        .badge-primary {
            background-color: #e0f2fe;
            color: var(--primary);
        }

        .badge-success {
            background-color: #dcfce7;
            color: var(--success);
        }

        .badge-warning {
            background-color: #fef3c7;
            color: var(--warning);
        }

        .badge-danger {
            background-color: #fee2e2;
            color: var(--danger);
        }

        /* Additional Dashboard Styles */
        .welcome-section {
            background: linear-gradient(to right, #ffffff, #f8fafc);
            padding: 1.5rem;
            border-radius: 1rem;
            margin: -2rem -2rem 2rem -2rem;
            border-bottom: 1px solid var(--border);
        }

        .stat-card {
            padding: 1.75rem;
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            border-radius: 1rem;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            background: rgba(255, 255, 255, 0.2);
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon i {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .stat-label {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.25rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 600;
            color: white;
            margin: 0;
            line-height: 1.2;
        }

        .stat-desc {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            margin: 0.5rem 0 0 0;
        }

        .empty-state {
            padding: 2rem;
        }

        .empty-state-icon {
            width: 64px;
            height: 64px;
            background: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .empty-state-icon i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .table > :not(caption) > * > * {
            padding: 1rem 0.75rem;
        }

        .table thead th {
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .progress {
            overflow: visible;
        }

        .progress-bar {
            position: relative;
            overflow: visible;
            background: linear-gradient(to right, var(--primary), var(--primary-hover));
        }

        .bg-primary-subtle {
            background-color: #e0f2fe !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }
    </style>
</head>
@php
    $theme = auth()->check() ? auth()->user()->settings['theme'] ?? 'light' : 'light';
@endphp
<body class="{{ $theme === 'dark' ? 'dark-mode' : 'light-mode' }}">



    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-quote-left"></i>
            <span>QuoteStack</span>
        </div>

        <div class="nav-section">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('quotes.create') }}" class="sidebar-link {{ request()->is('quotes/create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i>
                <span>Add Quote</span>
            </a>
            <a href="{{ route('quotes.favorites') }}" class="sidebar-link {{ request()->is('favorites') ? 'active' : '' }}">
                <i class="fas fa-star"></i>
                <span>Favorites</span>
            </a>
            <a href="{{ route('quotes.index') }}" class="sidebar-link {{ request()->is('quotes') ? 'active' : '' }}">
                <i class="fas fa-quote-right"></i>
                <span>All Quotes</span>
            </a>
            <a href="{{ route('tags.index') }}" class="sidebar-link {{ request()->is('tags*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i>
                <span>Tags</span>
            </a>
        </div>

        <div class="nav-section">
            <h4>Account</h4>
            <a href="{{ route('profile') }}" class="sidebar-link {{ request()->is('profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
            <a href="{{ route('settings') }}" class="sidebar-link {{ request()->is('settings') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </div>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: auto;">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <!-- Navbar -->
   <nav class="navbar">
    <button class="toggle-sidebar" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>
    <span class="navbar-brand">Dashboard</span>
    <div class="navbar-profile">
        <div class="profile-info">
            <h6>{{ auth()->user()->name }}</h6>
            <span>{{ auth()->user()->email }}</span>
        </div>
        <a href="{{ route('profile') }}">
            <img
                src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                alt="Profile"
                class="profile-image"
            >
        </a>
    </div>
</nav>


    <!-- Main Content -->
    <main class="content">
        @yield('content')
    </main>

    <!-- Overlay for mobile -->
    <div class="overlay"></div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Get DOM elements
        const sidebar = document.querySelector('.sidebar');
        const navbar = document.querySelector('.navbar');
        const content = document.querySelector('.content');
        const overlay = document.querySelector('.overlay');
        const sidebarToggle = document.getElementById('sidebarToggle');

        // Add tooltip data attributes
        document.querySelectorAll('.sidebar-link').forEach(link => {
            const span = link.querySelector('span');
            if (span) {
                link.setAttribute('data-title', span.textContent.trim());
            }
        });

        // Toggle sidebar function
        function toggleSidebar() {
            if (window.innerWidth <= 992) {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                navbar.classList.toggle('sidebar-collapsed');
                content.classList.toggle('sidebar-collapsed');
            }
        }

        // Event listeners
        sidebarToggle.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Handle window resize
        function handleResize() {
            if (window.innerWidth <= 992) {
                // Mobile view
                sidebar.classList.remove('collapsed');
                navbar.classList.remove('sidebar-collapsed');
                content.classList.remove('sidebar-collapsed');

                if (sidebar.classList.contains('show')) {
                    overlay.classList.add('show');
                }
            } else {
                // Desktop view
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        }

        // Add resize listener and initial check
        window.addEventListener('resize', handleResize);
        handleResize();
    </script>
    @stack('scripts')

</body>
</html>
