<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Alondra Shoe Shop') }}</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #ef4444 100%);
            --text-main: #1e293b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: var(--text-main);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            width: 100%;
            max-width: 450px;
            background: white;
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .auth-logo {
            background: var(--primary-gradient);
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin: 0 auto 1.5rem;
        }

        .brand-text {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-text h4 {
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .form-control {
            background: #f1f5f9;
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            font-weight: 500;
        }

        .form-control:focus {
            background: #f1f5f9;
            box-shadow: 0 0 0 2px #e2e8f0;
        }

        .btn-gradient {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
            transition: opacity 0.2s;
            margin-top: 1rem;
        }

        .btn-gradient:hover {
            color: white;
            opacity: 0.9;
        }

        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #64748b;
        }

        .auth-footer a {
            color: #ef4444;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <div class="auth-logo">
            <i class="bi bi-person-walking"></i>
        </div>
        
        <div class="brand-text">
            <h4>Alondra <span class="text-danger">Shoe Shop</span></h4>
            <p class="text-muted small">Elevate your inventory management</p>
        </div>

        {{ $slot }}
    </div>
</body>

</html>
