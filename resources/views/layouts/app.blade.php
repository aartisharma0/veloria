<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Veloria - Where every piece tells your story. Fashion & Lifestyle E-Commerce.">

    <title>@yield('title', 'Veloria') - Where Every Piece Tells Your Story</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    {{-- Top announcement bar --}}
    <div class="top-bar text-center">
        <div class="container">
            <i class="bi bi-gem me-1"></i> Free Shipping on orders above &#8377;999 | Use code <strong>VELORIA10</strong> for 10% off
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-veloria sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex flex-column" href="{{ route('home') }}">
                <span class="fw-bold brand-logo" style="font-family: 'Playfair Display', serif; letter-spacing: 3px;">VELORIA</span>
                <span class="tagline d-none d-sm-block" style="font-family: 'Playfair Display', serif; font-style: italic;">Where every piece tells your story</span>
            </a>

            {{-- Mobile icons (visible before hamburger on small screens) --}}
            <div class="d-flex align-items-center gap-3 d-lg-none order-lg-last">
                <a class="position-relative text-dark" href="#" title="Wishlist">
                    <i class="bi bi-heart fs-5"></i>
                </a>
                <a class="position-relative text-dark" href="#" title="Cart">
                    <i class="bi bi-bag fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="font-size: 0.5rem; background: var(--veloria-primary);">0</span>
                </a>
                <button class="navbar-toggler border-0 p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-4" style="color: var(--veloria-dark);"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarMain">
                {{-- Search bar --}}
                <form class="d-flex mx-auto my-2 my-lg-0 search-bar w-100" style="max-width: 480px;" action="#" method="GET">
                    <input type="search" name="q" class="form-control" placeholder="Search for fashion, brands..." aria-label="Search">
                    <button class="btn btn-search" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-person me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i> Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                <li class="px-3 py-2 border-bottom">
                                    <small class="text-muted">Welcome back,</small>
                                    <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                </li>
                                <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2 text-muted"></i>My Profile</a></li>
                                <li><a class="dropdown-item py-2" href="#"><i class="bi bi-bag me-2 text-muted"></i>My Orders</a></li>
                                <li><a class="dropdown-item py-2" href="#"><i class="bi bi-heart me-2 text-muted"></i>Wishlist</a></li>
                                <li><a class="dropdown-item py-2" href="#"><i class="bi bi-geo-alt me-2 text-muted"></i>Addresses</a></li>
                                @if(Auth::user()->isAdmin())
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}" style="color: var(--veloria-primary);"><i class="bi bi-speedometer2 me-2"></i>Admin Panel</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest

                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link position-relative" href="#" title="Wishlist">
                            <i class="bi bi-heart fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="font-size: 0.55rem; background: var(--veloria-primary);">0</span>
                        </a>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link position-relative" href="#" title="Cart">
                            <i class="bi bi-bag fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="font-size: 0.55rem; background: var(--veloria-primary);">0</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Category Navigation --}}
    <div class="d-none d-lg-block bg-white border-bottom">
        <div class="container">
            <ul class="nav justify-content-center py-2 gap-4">
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="#" style="letter-spacing: 1px;">NEW IN</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="#">WOMEN</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="#">MEN</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="#">KIDS</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="#">FOOTWEAR</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="#">ACCESSORIES</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="#">BEAUTY</a></li>
                <li class="nav-item"><a class="nav-link small fw-semibold px-0" href="#" style="color: var(--veloria-primary);">SALE</a></li>
            </ul>
        </div>
    </div>

    {{-- Flash Messages --}}
    <div class="container mt-3">
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
    </div>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer-veloria mt-4 mt-md-5 pt-4 pt-md-5 pb-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 col-12">
                    <h4 class="footer-brand mb-2" style="font-family: 'Playfair Display', serif; letter-spacing: 3px;">VELORIA</h4>
                    <p class="small fst-italic mb-3" style="color: rgba(255,255,255,0.5);">Where every piece tells your story</p>
                    <p class="small">Curating timeless fashion and lifestyle essentials for those who value elegance, quality, and self-expression.</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-pinterest"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="text-white mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem;">Shop</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-decoration-none">New Arrivals</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">Women</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">Men</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">Accessories</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">Sale</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <h6 class="text-white mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem;">Help</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-decoration-none">Contact Us</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">Shipping & Delivery</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">Returns & Exchanges</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">Size Guide</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">FAQs</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <h6 class="text-white mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem;">Stay Connected</h6>
                    <p class="small">Subscribe for exclusive offers, new drops, and style inspiration.</p>
                    <form class="mt-2">
                        <div class="input-group input-group-sm">
                            <input type="email" class="form-control border-0" placeholder="Your email address" style="background: rgba(255,255,255,0.1); color: white;">
                            <button class="btn px-3" type="button" style="background: var(--veloria-primary); color: white;">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="footer-divider my-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small mb-0" style="color: rgba(255,255,255,0.4);">&copy; {{ date('Y') }} Veloria. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <span class="small me-3" style="color: rgba(255,255,255,0.4);">Secure Payments</span>
                    <i class="bi bi-credit-card-2-front me-2" style="color: rgba(255,255,255,0.5);"></i>
                    <i class="bi bi-paypal me-2" style="color: rgba(255,255,255,0.5);"></i>
                    <i class="bi bi-shield-check" style="color: rgba(255,255,255,0.5);"></i>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
