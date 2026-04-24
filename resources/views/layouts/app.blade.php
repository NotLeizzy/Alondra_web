<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- MAIN WRAPPER -->
<div class="d-flex flex-column min-vh-100">

    <!-- HEADER -->
    <header class="border-bottom bg-light">

        <div class="container-fluid py-2 d-flex justify-content-between align-items-center">

            <!-- LEFT: PAGE TITLE -->
            <div>
                {{ $header ?? '' }}
            </div>

            <!-- RIGHT: USER DROPDOWN -->
            <div class="dropdown text-end">

                @auth
                    <a class="text-decoration-none dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">

                        Logged in as: <strong>{{ Auth::user()->name }}</strong>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li class="px-3 py-2">
                            <small class="text-muted">Account</small><br>
                            <strong>{{ Auth::user()->name }}</strong>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    Logout
                                </button>
                            </form>
                        </li>

                    </ul>
                @endauth

            </div>

        </div>

    </header>

    <!-- PAGE CONTENT -->
    <main class="flex-grow-1 p-4">

        {{ $slot }}

    </main>

</div>

<!-- Bootstrap JS (IMPORTANT for dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>