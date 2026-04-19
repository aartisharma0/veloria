<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') - Veloria Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        {{-- Desktop Sidebar (hidden on mobile/tablet) --}}
        <div class="admin-sidebar d-none d-lg-flex flex-column flex-shrink-0" style="width: 260px;">
            @include('partials.admin-sidebar-content')
        </div>

        {{-- Mobile/Tablet Offcanvas Sidebar --}}
        <div class="offcanvas offcanvas-start p-0" tabindex="-1" id="adminSidebar" style="width: 280px; background: linear-gradient(180deg, var(--veloria-dark), #2d2d2d);">
            <button type="button" class="btn-close btn-close-white position-absolute" data-bs-dismiss="offcanvas" aria-label="Close" style="top: 15px; right: 15px; z-index: 10;"></button>
            <div class="d-flex flex-column h-100 overflow-auto">
                @include('partials.admin-sidebar-content')
            </div>
        </div>

        {{-- Main Content --}}
        <div class="flex-grow-1 min-vh-100" style="background: #f5f5f5;">
            {{-- Top bar --}}
            <nav class="navbar navbar-light bg-white border-bottom px-3 px-md-4 py-2">
                <div class="d-flex align-items-center gap-2">
                    {{-- Mobile hamburger --}}
                    <button class="btn btn-link text-dark d-lg-none p-1 me-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar" aria-label="Toggle sidebar">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <h5 class="mb-0 fw-semibold" style="font-size: 1.1rem;">@yield('page-title', 'Dashboard')</h5>
                </div>
                <div class="d-flex align-items-center gap-2 gap-md-3">
                    <a href="{{ route('home') }}" class="btn btn-sm px-2 px-md-3 d-none d-sm-inline-flex" style="border: 1.5px solid var(--veloria-primary); color: var(--veloria-primary); border-radius: 20px; font-size: 0.8rem;" target="_blank">
                        <i class="bi bi-eye me-1"></i><span class="d-none d-md-inline">View Store</span>
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-link d-sm-none p-1" style="color: var(--veloria-primary);" target="_blank" title="View Store">
                        <i class="bi bi-eye fs-5"></i>
                    </a>
                    <div class="dropdown">
                        <a class="text-dark position-relative" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-bell fs-5"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-3 shadow-sm border-0 notification-dropdown">
                            <h6 class="mb-2 fw-semibold">Notifications</h6>
                            <p class="text-muted small mb-0">No new notifications</p>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Page Content --}}
            <div class="p-3 p-md-4">
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

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select.form-select, select.form-control').not('.no-select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                minimumResultsForSearch: 5
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
