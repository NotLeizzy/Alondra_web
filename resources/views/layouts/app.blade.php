<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Alondra Shoe Shop') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #ef4444 100%);
            --sidebar-bg: #f8fafc;
            --active-bg: #fff1f2;
            --active-color: #ef4444;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Sidebar */
        #sidebar {
            width: 260px;
            min-height: 100vh;
            background: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
            border-right: 1px solid #f1f5f9;
        }

        #sidebar.collapsed {
            left: -260px;
        }

        .sidebar-brand {
            padding: 2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s;
            overflow: hidden;
            white-space: nowrap;
        }

        #sidebar.collapsed .sidebar-brand {
            /* No longer needed for mini-state as we hide it completely */
        }

        .brand-logo {
            background: var(--primary-gradient);
            min-width: 42px;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .brand-text-wrapper {
            transition: opacity 0.2s, transform 0.3s;
        }

        #sidebar.collapsed .brand-text-wrapper {
            opacity: 0;
            width: 0;
            pointer-events: none;
            transform: translateX(-10px);
        }

        .brand-name {
            font-weight: 700;
            font-size: 1.1rem;
            line-height: 1.2;
        }

        .brand-subtitle {
            font-size: 0.75rem;
            color: var(--text-muted);
            display: block;
        }

        #sidebar .nav-link {
            margin: 0.25rem 1rem;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-muted);
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.2s;
            white-space: nowrap;
            overflow: hidden;
        }

        #sidebar.collapsed .nav-link {
            /* No longer needed for mini-state as we hide it completely */
        }

        #sidebar .nav-link i {
            font-size: 1.3rem;
            min-width: 24px;
            text-align: center;
        }

        #sidebar .nav-link span {
            transition: opacity 0.2s;
        }

        #sidebar.collapsed .nav-link span {
            /* No longer needed for mini-state as we hide it completely */
        }

        #sidebar .nav-link:hover {
            background: #f1f5f9;
            color: var(--text-main);
        }

        #sidebar .nav-link.active {
            background: var(--active-bg);
            color: var(--active-color);
        }

        /* Main Content */
        #mainContent {
            margin-left: 260px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
        }

        #mainContent.expanded {
            margin-left: 0;
        }

        .topbar {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .logout-link {
            color: var(--text-main);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-link:hover {
            color: var(--active-color);
        }

        /* Cards and Tables */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .table thead th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem;
            border: none;
        }

        .table tbody td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .btn-gradient {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: opacity 0.2s;
        }

        .btn-gradient:hover {
            color: white;
            opacity: 0.9;
        }

        /* Badges */
        .badge-unit {
            background: #e0e7ff;
            color: #4f46e5;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.8rem;
        }

        /* Mobile */
        @media (max-width: 991px) {
            #sidebar {
                left: -260px !important;
                box-shadow: 10px 0 15px -3px rgba(0, 0, 0, 0.1);
            }
            #sidebar.show {
                left: 0 !important;
            }
            #mainContent {
                margin-left: 0 !important;
            }
            .topbar {
                padding: 1rem 1.5rem;
                justify-content: space-between;
            }
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(4px);
            z-index: 999;
            display: none;
            transition: all 0.3s;
        }

        .sidebar-overlay.show {
            display: block;
        }
    </style>
    @stack('styles')
</head>

<body>

    <!-- SIDEBAR -->
    <aside id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">
                <i class="bi bi-person-walking"></i>
            </div>
            <div class="brand-text-wrapper">
                <span class="brand-name text-danger">Alondra <span class="text-primary">Shoe Shop</span></span>
                <span class="brand-subtitle">Stock Management</span>
            </div>
        </div>

        <nav>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active':'' }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('stock-in.index') }}" class="nav-link {{ request()->routeIs('stock-in.*') ? 'active':'' }}">
                <i class="bi bi-box-arrow-in-down"></i>
                <span>Stock In</span>
            </a>

            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active':'' }}">
                <i class="bi bi-box-seam"></i>
                <span>Stocks</span>
            </a>

            <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*') ? 'active':'' }}">
                <i class="bi bi-truck"></i>
                <span>Suppliers</span>
            </a>
            
            <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active':'' }}">
                <i class="bi bi-people"></i>
                <span>Employees</span>
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <div id="mainContent">
        <header class="topbar sticky-top border-bottom shadow-sm">
            <!-- Toggle Button -->
            <button class="btn btn-link p-0 border-0 text-dark" id="sidebarToggle">
                <i class="bi bi-text-indent-left fs-2" id="toggleIcon"></i>
            </button>

            <!-- Brand for Mobile -->
            <div class="d-lg-none mx-auto">
                <span class="fw-bold text-danger">Alondra <span class="text-primary">Shoe Shop</span></span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-link btn btn-link p-0 border-0 align-baseline">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="d-none d-sm-inline">Logout</span>
                </button>
            </form>
        </header>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <main class="p-4">
            {{ $slot }}
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggle = document.getElementById('sidebarToggle');
            const toggleIcon = document.getElementById('toggleIcon');
            const overlay = document.getElementById('sidebarOverlay');

            // Handle Toggling
            toggle.addEventListener('click', function() {
                if (window.innerWidth >= 992) {
                    // Desktop: Collapse/Expand
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');
                    
                    // Update Icon
                    if (sidebar.classList.contains('collapsed')) {
                        toggleIcon.classList.replace('bi-text-indent-left', 'bi-text-indent-right');
                    } else {
                        toggleIcon.classList.replace('bi-text-indent-right', 'bi-text-indent-left');
                    }
                } else {
                    // Mobile: Show/Hide
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                    document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
                }
            });

            // Close sidebar on overlay click
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            });

            // Handle responsive resizing
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 992) {
                    overlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>