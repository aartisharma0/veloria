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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">

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
                @auth
                <a class="position-relative text-dark" href="{{ route('wishlist.index') }}" title="Wishlist">
                    <i class="bi bi-heart fs-5"></i>
                </a>
                @endauth
                <a class="position-relative text-dark" href="{{ route('cart.index') }}" title="Cart">
                    <i class="bi bi-bag fs-5"></i>
                    @if(($cartCount ?? 0) > 0)<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="font-size: 0.5rem; background: var(--veloria-primary);">{{ $cartCount }}</span>@endif
                </a>
                <button class="navbar-toggler border-0 p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-4" style="color: var(--veloria-dark);"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarMain">
                {{-- Search bar with autocomplete --}}
                <div class="position-relative mx-auto my-2 my-lg-0 w-100" style="max-width: 480px;">
                    <form class="d-flex search-bar" action="{{ route('products.index') }}" method="GET">
                        <input type="search" name="q" id="searchInput" class="form-control no-select2" placeholder="Search for fashion, brands..." aria-label="Search" autocomplete="off" value="{{ request('q') }}">
                        <button class="btn btn-search" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <div id="searchResults" class="position-absolute w-100 bg-white rounded-3 shadow-lg mt-1" style="z-index:1060;display:none;max-height:400px;overflow-y:auto;"></div>
                </div>

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
                                <li><a class="dropdown-item py-2" href="{{ route('account.profile') }}"><i class="bi bi-person me-2 text-muted"></i>My Profile</a></li>
                                <li><a class="dropdown-item py-2" href="{{ route('account.orders') }}"><i class="bi bi-bag me-2 text-muted"></i>My Orders</a></li>
                                <li><a class="dropdown-item py-2" href="{{ route('wishlist.index') }}"><i class="bi bi-heart me-2 text-muted"></i>Wishlist</a></li>
                                <li><a class="dropdown-item py-2" href="{{ route('account.addresses') }}"><i class="bi bi-geo-alt me-2 text-muted"></i>Addresses</a></li>
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

                    @auth
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link position-relative" href="{{ route('wishlist.index') }}" title="Wishlist">
                            <i class="bi bi-heart fs-5"></i>
                            @if(($wishlistCount ?? 0) > 0)<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="font-size: 0.55rem; background: var(--veloria-primary);">{{ $wishlistCount }}</span>@endif
                        </a>
                    </li>
                    @endauth
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}" title="Cart">
                            <i class="bi bi-bag fs-5"></i>
                            @if(($cartCount ?? 0) > 0)<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="font-size: 0.55rem; background: var(--veloria-primary);">{{ $cartCount }}</span>@endif
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
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="{{ route('products.index', ['sort'=>'newest']) }}" style="letter-spacing: 1px;">NEW IN</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="{{ route('products.index', ['category'=>'women']) }}">WOMEN</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="{{ route('products.index', ['category'=>'men']) }}">MEN</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="{{ route('products.index', ['category'=>'kids']) }}">KIDS</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="{{ route('products.index', ['category'=>'footwear']) }}">FOOTWEAR</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="{{ route('products.index', ['category'=>'accessories']) }}">ACCESSORIES</a></li>
                <li class="nav-item"><a class="nav-link text-dark small fw-semibold px-0" href="{{ route('products.index', ['category'=>'beauty']) }}">BEAUTY</a></li>
                <li class="nav-item"><a class="nav-link small fw-semibold px-0" href="{{ route('products.index') }}" style="color: var(--veloria-primary);">ALL</a></li>
            </ul>
        </div>
    </div>

    {{-- Toast Notifications --}}
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        @if(session('success'))
        <div class="toast show border-0 shadow-lg" role="alert" data-bs-autohide="true" data-bs-delay="4000">
            <div class="toast-body d-flex align-items-center gap-2 py-3 px-4" style="background: #d4edda; color: #155724; border-radius: 10px;">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <span class="fw-semibold">{{ session('success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast" style="font-size:0.7rem;"></button>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="toast show border-0 shadow-lg" role="alert" data-bs-autohide="true" data-bs-delay="5000">
            <div class="toast-body d-flex align-items-center gap-2 py-3 px-4" style="background: #f8d7da; color: #721c24; border-radius: 10px;">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <span class="fw-semibold">{{ session('error') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast" style="font-size:0.7rem;"></button>
            </div>
        </div>
        @endif
    </div>

    {{-- Validation Errors (keep as inline for forms) --}}
    @if($errors->any())
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>Please fix the errors below.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

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
                        <li class="mb-2"><a href="{{ route('products.index', ['sort'=>'newest']) }}" class="text-decoration-none">New Arrivals</a></li>
                        <li class="mb-2"><a href="{{ route('products.index', ['category'=>'women']) }}" class="text-decoration-none">Women</a></li>
                        <li class="mb-2"><a href="{{ route('products.index', ['category'=>'men']) }}" class="text-decoration-none">Men</a></li>
                        <li class="mb-2"><a href="{{ route('products.index', ['category'=>'accessories']) }}" class="text-decoration-none">Accessories</a></li>
                        <li class="mb-2"><a href="{{ route('products.index') }}" class="text-decoration-none">All Products</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <h6 class="text-white mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem;">Help</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ route('contact') }}" class="text-decoration-none">Contact Us</a></li>
                        <li class="mb-2"><a href="{{ route('pages.shipping') }}" class="text-decoration-none">Shipping & Delivery</a></li>
                        <li class="mb-2"><a href="{{ route('pages.returns') }}" class="text-decoration-none">Returns & Exchanges</a></li>
                        <li class="mb-2"><a href="{{ route('pages.size-guide') }}" class="text-decoration-none">Size Guide</a></li>
                        <li class="mb-2"><a href="{{ route('pages.faqs') }}" class="text-decoration-none">FAQs</a></li>
                        <li class="mb-2"><a href="{{ route('pages.terms') }}" class="text-decoration-none">Terms & Conditions</a></li>
                        <li class="mb-2"><a href="{{ route('pages.privacy') }}" class="text-decoration-none">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <h6 class="text-white mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem;">Stay Connected</h6>
                    <p class="small">Subscribe for exclusive offers, new drops, and style inspiration.</p>
                    <form class="mt-2" action="{{ route('subscribe') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-sm">
                            <input type="email" name="email" class="form-control border-0" placeholder="Your email address" required style="background: rgba(255,255,255,0.1); color: white;">
                            <button class="btn px-3" type="submit" style="background: var(--veloria-primary); color: white;">
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

    {{-- Dark Mode Toggle --}}
    <button id="darkModeToggle" class="dark-mode-toggle" title="Toggle Dark Mode">
        <i class="bi bi-moon-fill"></i>
    </button>

    {{-- Back to Top Button --}}
    <button id="backToTop" class="btn position-fixed d-flex align-items-center justify-content-center shadow-lg" style="bottom:30px;right:30px;width:45px;height:45px;border-radius:50%;background:var(--veloria-primary);color:white;border:none;z-index:1050;display:none !important;opacity:0;transition:opacity 0.3s;">
        <i class="bi bi-arrow-up fs-5"></i>
    </button>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Dark Mode
            const darkToggle = document.getElementById('darkModeToggle');
            const savedTheme = localStorage.getItem('veloria_theme');
            if (savedTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
                darkToggle.innerHTML = '<i class="bi bi-sun-fill"></i>';
            }
            darkToggle.addEventListener('click', function() {
                const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                if (isDark) {
                    document.documentElement.removeAttribute('data-theme');
                    localStorage.setItem('veloria_theme', 'light');
                    this.innerHTML = '<i class="bi bi-moon-fill"></i>';
                } else {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('veloria_theme', 'dark');
                    this.innerHTML = '<i class="bi bi-sun-fill"></i>';
                }
            });

            // Select2
            $('select.form-select, select.form-control').not('.no-select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                minimumResultsForSearch: 5
            });

            // === 3D: Animated Counter ===
            const counterObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const target = parseInt(el.dataset.target);
                        const duration = 2000;
                        const step = target / (duration / 16);
                        let current = 0;
                        const timer = setInterval(() => {
                            current += step;
                            if (current >= target) {
                                el.textContent = target.toLocaleString() + '+';
                                clearInterval(timer);
                            } else {
                                el.textContent = Math.floor(current).toLocaleString();
                            }
                        }, 16);
                        counterObserver.unobserve(el);
                    }
                });
            }, { threshold: 0.5 });
            document.querySelectorAll('.counter').forEach(el => counterObserver.observe(el));

            // === 3D: Cube mouse interaction ===
            const cube = document.getElementById('cube3d');
            if (cube) {
                cube.parentElement.addEventListener('mouseenter', () => {
                    cube.style.animationPlayState = 'paused';
                });
                cube.parentElement.addEventListener('mouseleave', () => {
                    cube.style.animationPlayState = 'running';
                });
            }

            // === EFFECT 1: Hero Floating Particles ===
            const heroParticles = document.getElementById('heroParticles');
            if (heroParticles) {
                for (let i = 0; i < 25; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.width = (Math.random() * 6 + 3) + 'px';
                    particle.style.height = particle.style.width;
                    particle.style.animationDuration = (Math.random() * 8 + 6) + 's';
                    particle.style.animationDelay = (Math.random() * 10) + 's';
                    particle.style.opacity = Math.random() * 0.3;
                    heroParticles.appendChild(particle);
                }
            }

            // === EFFECT 2: Product Card 3D Tilt ===
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = ((y - centerY) / centerY) * -6;
                    const rotateY = ((x - centerX) / centerX) * 6;

                    this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
                    this.classList.add('tilt-active');
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
                    this.classList.remove('tilt-active');
                });
            });

            // === EFFECT 3: Confetti on Order Success ===
            if (window.location.pathname.includes('/checkout/success')) {
                launchConfetti();
            }

            function launchConfetti() {
                const colors = ['#d63384', '#ff69b4', '#ffd700', '#00d2ff', '#7b68ee', '#ff6347', '#32cd32', '#ff1493'];
                const shapes = ['circle', 'square'];

                for (let i = 0; i < 80; i++) {
                    setTimeout(() => {
                        const confetti = document.createElement('div');
                        confetti.classList.add('confetti-piece');
                        confetti.style.left = Math.random() * 100 + 'vw';
                        confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                        confetti.style.width = (Math.random() * 10 + 5) + 'px';
                        confetti.style.height = confetti.style.width;
                        confetti.style.borderRadius = shapes[Math.floor(Math.random() * shapes.length)] === 'circle' ? '50%' : '2px';
                        confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                        confetti.style.animationDelay = '0s';
                        document.body.appendChild(confetti);

                        setTimeout(() => confetti.remove(), 4000);
                    }, i * 40);
                }
            }

            // Auto-dismiss toasts
            $('.toast[data-bs-autohide="true"]').each(function() {
                var toast = new bootstrap.Toast(this);
                toast.show();
            });

            // Back to Top
            const backToTop = document.getElementById('backToTop');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 400) {
                    backToTop.style.display = 'flex';
                    backToTop.style.cssText += 'display:flex !important;opacity:1;';
                } else {
                    backToTop.style.cssText += 'display:none !important;opacity:0;';
                }
            });
            backToTop.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Scroll Reveal Animation
            const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.product-card, .category-card, .card, section > .container > .row > div').forEach(el => {
                el.classList.add('fade-in-up');
                observer.observe(el);
            });

            // Add to cart button animation
            $(document).on('submit', 'form[action*="cart/add"]', function() {
                const btn = $(this).find('button[type="submit"]');
                const original = btn.html();
                btn.html('<i class="bi bi-check-lg me-1"></i> Added!').css({
                    'background': '#28a745',
                    'border-color': '#28a745',
                    'transform': 'scale(1.05)'
                });
                setTimeout(function() {
                    btn.html(original).css({
                        'background': '',
                        'border-color': '',
                        'transform': ''
                    });
                }, 1200);

                // Pulse cart badge
                $('.badge.rounded-pill').addClass('badge-pulse');
                setTimeout(() => $('.badge.rounded-pill').removeClass('badge-pulse'), 500);
            });

            // Wishlist heart animation
            $(document).on('click', '.wishlist-btn', function() {
                const icon = $(this).find('i');
                $(this).css('transform', 'scale(1.3)');
                setTimeout(() => $(this).css('transform', 'scale(1)'), 200);
            });

            // Live Search Autocomplete
            let searchTimer;
            $('#searchInput').on('input', function() {
                const query = $(this).val().trim();
                clearTimeout(searchTimer);

                if (query.length < 2) {
                    $('#searchResults').hide().html('');
                    return;
                }

                searchTimer = setTimeout(function() {
                    $.get('{{ route("search.autocomplete") }}', { q: query }, function(data) {
                        if (data.length === 0) {
                            $('#searchResults').html('<div class="p-3 text-center text-muted small">No products found</div>').show();
                            return;
                        }

                        let html = '';
                        data.forEach(function(item) {
                            html += `<a href="${item.url}" class="d-flex align-items-center gap-3 p-2 px-3 text-decoration-none text-dark border-bottom" style="transition:background 0.2s;" onmouseover="this.style.background='var(--veloria-pink-soft)'" onmouseout="this.style.background='white'">
                                <img src="${item.image}" class="rounded" style="width:42px;height:42px;object-fit:cover;">
                                <div class="flex-grow-1">
                                    <div class="fw-semibold small">${item.name}</div>
                                    <small class="text-muted">${item.category}</small>
                                </div>
                                <span class="fw-bold small" style="color:var(--veloria-primary);">${item.price}</span>
                            </a>`;
                        });
                        html += `<a href="/shop?q=${encodeURIComponent(query)}" class="d-block text-center py-2 small fw-semibold text-decoration-none" style="color:var(--veloria-primary);">View all results for "${query}" <i class="bi bi-arrow-right"></i></a>`;
                        $('#searchResults').html(html).show();
                    });
                }, 300);
            });

            // Hide search results on click outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#searchInput, #searchResults').length) {
                    $('#searchResults').hide();
                }
            });

            $('#searchInput').on('focus', function() {
                if ($('#searchResults').html().trim()) $('#searchResults').show();
            });

            // Smooth scroll for anchor links
            $('a[href^="#"]').on('click', function(e) {
                const target = $(this.getAttribute('href'));
                if (target.length) {
                    e.preventDefault();
                    $('html, body').animate({ scrollTop: target.offset().top - 80 }, 500);
                }
            });

            // Discount popup for first-time visitors (shows once)
            if (!localStorage.getItem('veloria_visited')) {
                setTimeout(function() {
                    showDiscountPopup();
                }, 5000); // Show after 5 seconds
            }
        });

        // First-time visitor discount popup
        function showDiscountPopup() {
            const overlay = document.createElement('div');
            overlay.className = 'spin-wheel-overlay';
            overlay.innerHTML = `
                <div class="bg-white rounded-4 shadow-lg p-4 p-md-5 text-center position-relative" style="max-width:420px;width:90%;animation:fadeIn 0.3s ease;">
                    <button onclick="closeDiscount()" class="btn-close position-absolute" style="top:15px;right:15px;"></button>
                    <div class="mb-3">
                        <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width:70px;height:70px;background:var(--veloria-pink-soft);">
                            <i class="bi bi-gift fs-2" style="color:var(--veloria-primary);"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold" style="font-family:'Playfair Display',serif;">Welcome to Veloria!</h4>
                    <p class="text-muted">Get <strong style="color:var(--veloria-primary);font-size:1.5rem;">20% OFF</strong> on your first order</p>
                    <div class="bg-light rounded-3 p-3 mb-3">
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <code class="fs-5 fw-bold" style="color:var(--veloria-primary);letter-spacing:3px;">WELCOME20</code>
                            <button onclick="copyCode('WELCOME20')" class="btn btn-sm btn-outline-dark"><i class="bi bi-clipboard"></i></button>
                        </div>
                    </div>
                    <a href="/shop" class="btn btn-veloria w-100 py-2" onclick="closeDiscount()">
                        Start Shopping <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <p class="small text-muted mt-2 mb-0">Min. order &#8377;500 | Valid for new users</p>
                </div>
            `;
            document.body.appendChild(overlay);
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) closeDiscount();
            });
        }

        function closeDiscount() {
            localStorage.setItem('veloria_visited', 'true');
            const overlay = document.querySelector('.spin-wheel-overlay');
            if (overlay) overlay.remove();
        }

        function copyCode(code) {
            navigator.clipboard.writeText(code).then(() => {
                const btn = event.target.closest('button');
                const original = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check"></i>';
                btn.classList.add('btn-success');
                btn.classList.remove('btn-outline-dark');
                setTimeout(() => {
                    btn.innerHTML = original;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-outline-dark');
                }, 1500);
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
