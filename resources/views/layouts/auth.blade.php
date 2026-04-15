<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Login') - Veloria</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-11 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                {{-- Brand --}}
                <div class="text-center mb-4 auth-brand">
                    <a href="{{ route('home') }}" class="text-white text-decoration-none">
                        <i class="bi bi-gem"></i>
                        <h2 class="fw-bold mt-3" style="font-family: 'Playfair Display', serif; letter-spacing: 4px;">VELORIA</h2>
                        <p class="fst-italic" style="opacity: 0.7; font-family: 'Playfair Display', serif;">Where every piece tells your story</p>
                    </a>
                </div>

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Card --}}
                <div class="card auth-card">
                    <div class="card-body p-4 p-md-5">
                        @yield('content')
                    </div>
                </div>

                <p class="text-center mt-3 small" style="color: rgba(255,255,255,0.35);">
                    &copy; {{ date('Y') }} Veloria. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
