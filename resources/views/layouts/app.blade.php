<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            overflow-x: hidden;
        }

        /* Sidebar */
        #sidebar {
            width: 240px;
            min-height: 100vh;
            transition: all .3s ease;
        }

        #sidebar.collapsed {
            width: 70px;
        }

        #sidebar .menu-text {
            transition: .2s;
        }

        #sidebar.collapsed .menu-text {
            display: none;
        }

        #sidebar .nav-link {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #333;
            border-radius: 10px;
        }

        #sidebar .nav-link:hover {
            background: #f1f3f5;
        }

        #sidebar .nav-link.active {
            background: #e9ecef;
            font-weight: 600;
        }

        /* Main Content */
        #mainContent {
            transition: all .3s ease;
            flex-grow: 1;
        }

        /* Mobile Sidebar */
        @media (max-width: 991px) {
            #sidebar {
                position: fixed;
                left: -240px;
                top: 0;
                z-index: 1050;
                background: #fff;
                box-shadow: 0 0 15px rgba(0, 0, 0, .15);
            }

            #sidebar.mobile-show {
                left: 0;
            }

            .overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .3);
                z-index: 1040;
            }

            .overlay.show {
                display: block;
            }
        }
    </style>
</head>

<body>

    <div class="overlay" id="overlay"></div>

    <div class="d-flex">

        <!-- SIDEBAR -->
        <aside id="sidebar" class="border-end bg-white">

            <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                <span class="fw-bold menu-text">My Dashboard</span>
            </div>

            <nav class="p-3">

                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active':'' }}">
                    <i class="bi bi-house"></i>
                    <span class="menu-text">Dashboard</span>
                </a>

                <a href="{{ route('stock-in.index') }}"
                    class="nav-link {{ request()->routeIs('stock-in.*') ? 'active':'' }}">
                    <i class="bi bi-box-arrow-in-down"></i>
                    <span class="menu-text">Stock In</span>
                </a>

                <a href="{{ route('products.index') }}"
                    class="nav-link {{ request()->routeIs('products.*') ? 'active':'' }}">
                    <i class="bi bi-box-seam"></i>
                    <span class="menu-text">Products</span>
                </a>

                <a href="{{ route('employees.index') }}"
                    class="nav-link {{ request()->routeIs('employees.*') ? 'active':'' }}">
                    <i class="bi bi-people"></i>
                    <span class="menu-text">Employees</span>
                </a>

                <a href="{{ route('suppliers.index') }}"
                    class="nav-link {{ request()->routeIs('suppliers.*') ? 'active':'' }}">
                    <i class="bi bi-truck"></i>
                    <span class="menu-text">Suppliers</span>
                </a>

            </nav>
        </aside>


        <!-- MAIN -->
        <div id="mainContent">

            <!-- TOPBAR -->
            <header class="border-bottom bg-light">
                <div class="container-fluid py-3 d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center gap-3">

                        <button id="menuToggle" class="btn btn-outline-secondary">
                            <i class="bi bi-list"></i>
                        </button>

                        <div>
                            {{ $header ?? '' }}
                        </div>

                    </div>


                    <div class="dropdown">
                        @auth
                        <a class="text-decoration-none dropdown-toggle"
                            href="#"
                            data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                        @endauth
                    </div>

                </div>
            </header>


            <main class="p-4">
                {{ $slot }}
            </main>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('menuToggle');
        const overlay = document.getElementById('overlay');

        toggle.addEventListener('click', function() {

            if (window.innerWidth <= 991) {
                sidebar.classList.toggle('mobile-show');
                overlay.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
            }

        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('mobile-show');
            overlay.classList.remove('show');
        });
    </script>

</body>

</html>