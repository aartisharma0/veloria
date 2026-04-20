@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Hero Section with floating particles --}}
    <section class="hero-section">
        <div class="hero-particles" id="heroParticles"></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-7 text-center text-lg-start">
                    <p class="text-uppercase small fw-semibold mb-2 mb-md-3" style="letter-spacing: 3px; color: var(--veloria-primary-light);">New Season Collection</p>
                    <h1 class="fw-bold mb-3 hero-title" style="font-family: 'Playfair Display', serif; line-height: 1.1;">
                        Discover Your<br>
                        <span style="color: var(--veloria-primary-light);">Signature Style</span>
                    </h1>
                    <p class="hero-tagline mb-3 mb-md-4" style="font-family: 'Playfair Display', serif;">
                        "Where every piece tells your story"
                    </p>
                    <p class="mb-4 opacity-75 d-none d-md-block">Curated collections of fashion essentials that celebrate individuality, elegance, and modern sophistication.</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-2 gap-sm-3">
                        <a href="{{ route('products.index') }}" class="btn btn-veloria btn-lg px-4 px-md-5">
                            Shop Now <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="{{ route('products.index', ['sort' => 'newest']) }}" class="btn btn-veloria-outline btn-lg px-4" style="color: white; border-color: rgba(255,255,255,0.4);">
                            Explore Trends
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3D Rotating Cube Showcase --}}
    <section class="py-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-white mb-4 mb-lg-0">
                    <p class="text-uppercase small fw-semibold mb-2" style="letter-spacing: 3px; color: var(--veloria-primary-light);">Explore Collections</p>
                    <h2 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; font-size: 2.2rem;">
                        Curated For<br><span style="color: var(--veloria-primary-light);">Every Occasion</span>
                    </h2>
                    <p class="opacity-75 mb-4">From everyday essentials to special occasion outfits — discover pieces that define your unique style.</p>

                    <div class="d-flex flex-wrap gap-3">
                        <div class="text-center">
                            <div class="fs-2 fw-bold counter" data-target="500" style="color: var(--veloria-primary-light);">0</div>
                            <small class="opacity-60">Products</small>
                        </div>
                        <div style="border-left: 1px solid rgba(255,255,255,0.15); margin: 0 10px;"></div>
                        <div class="text-center">
                            <div class="fs-2 fw-bold counter" data-target="50" style="color: var(--veloria-primary-light);">0</div>
                            <small class="opacity-60">Brands</small>
                        </div>
                        <div style="border-left: 1px solid rgba(255,255,255,0.15); margin: 0 10px;"></div>
                        <div class="text-center">
                            <div class="fs-2 fw-bold counter" data-target="10000" style="color: var(--veloria-primary-light);">0</div>
                            <small class="opacity-60">Happy Customers</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex justify-content-center">
                    <div class="cube-scene">
                        <div class="cube" id="cube3d">
                            <div class="cube-face cube-front">
                                <i class="bi bi-handbag"></i>
                                <span>Women</span>
                            </div>
                            <div class="cube-face cube-back">
                                <i class="bi bi-watch"></i>
                                <span>Accessories</span>
                            </div>
                            <div class="cube-face cube-right">
                                <i class="bi bi-person-standing"></i>
                                <span>Men</span>
                            </div>
                            <div class="cube-face cube-left">
                                <i class="bi bi-stars"></i>
                                <span>Beauty</span>
                            </div>
                            <div class="cube-face cube-top">
                                <i class="bi bi-bag-heart"></i>
                                <span>New In</span>
                            </div>
                            <div class="cube-face cube-bottom">
                                <i class="bi bi-boot"></i>
                                <span>Footwear</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Floating 3D orbs --}}
        <div class="floating-orb" style="top:20%;left:5%;width:80px;height:80px;"></div>
        <div class="floating-orb" style="top:60%;right:8%;width:50px;height:50px;animation-delay:2s;"></div>
        <div class="floating-orb" style="bottom:10%;left:30%;width:35px;height:35px;animation-delay:4s;"></div>
    </section>

    {{-- Features Bar --}}
    <section class="features-bar">
        <div class="container">
            <div class="row text-center g-2 g-md-3">
                <div class="col-6 col-md-3">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-truck fs-5 fs-md-4 feature-icon"></i>
                        <div class="text-start">
                            <div class="fw-semibold feature-title">Free Delivery</div>
                            <div class="text-muted feature-subtitle">On orders above &#8377;999</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-arrow-return-left fs-5 fs-md-4 feature-icon"></i>
                        <div class="text-start">
                            <div class="fw-semibold feature-title">Easy Returns</div>
                            <div class="text-muted feature-subtitle">30-day policy</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-shield-check fs-5 fs-md-4 feature-icon"></i>
                        <div class="text-start">
                            <div class="fw-semibold feature-title">Secure Payment</div>
                            <div class="text-muted feature-subtitle">100% protected</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-gem fs-5 fs-md-4 feature-icon"></i>
                        <div class="text-start">
                            <div class="fw-semibold feature-title">Premium Quality</div>
                            <div class="text-muted feature-subtitle">Handpicked styles</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Shop by Category --}}
    <section class="py-4 py-md-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-3 mb-md-4">
                <div>
                    <h3 class="fw-bold section-heading mb-0 section-title" style="font-family: 'Playfair Display', serif;">Shop by Category</h3>
                </div>
                <a href="{{ route('products.index') }}" class="text-decoration-none small fw-semibold" style="color: var(--veloria-primary);">
                    View All <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="row g-2 g-md-3">
                @forelse($categories as $category)
                    <div class="col-4 col-sm-4 col-md-3 col-lg-2">
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-decoration-none text-dark">
                            <div class="category-card text-center p-2 p-md-3 h-100">
                                <div class="category-icon mx-auto mb-2">
                                    <i class="bi bi-handbag fs-5 fs-md-4"></i>
                                </div>
                                <h6 class="mb-0 fw-semibold category-name">{{ $category->name }}</h6>
                                @if($category->children->count() > 0)
                                    <small class="text-muted d-none d-md-block" style="font-size: 0.7rem;">{{ $category->children->count() }} subcategories</small>
                                @endif
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-4" style="background: var(--veloria-pink-soft); border-radius: 12px;">
                            <i class="bi bi-gem fs-3" style="color: var(--veloria-primary);"></i>
                            <h6 class="mt-2 mb-1">Collections Coming Soon</h6>
                            <p class="text-muted small mb-0">We're curating the finest pieces for you.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    <section class="py-4 py-md-5" style="background: var(--veloria-pink-soft);">
        <div class="container">
            <div class="text-center mb-3 mb-md-5">
                <p class="text-uppercase small fw-semibold mb-1" style="letter-spacing: 3px; color: var(--veloria-primary);">Handpicked For You</p>
                <h3 class="fw-bold section-heading text-center section-title" style="font-family: 'Playfair Display', serif;">Featured Collection</h3>
            </div>
            <div class="row g-2 g-md-4">
                @forelse($featuredProducts as $product)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="card product-card h-100 position-relative">
                            @auth
                            <form action="{{ route('wishlist.toggle') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="wishlist-btn {{ auth()->user()->wishlists->contains('product_id', $product->id) ? 'active' : '' }}" title="Wishlist">
                                    <i class="bi bi-heart{{ auth()->user()->wishlists->contains('product_id', $product->id) ? '-fill' : '' }}"></i>
                                </button>
                            </form>
                            @endauth
                            @if($product->compare_price && $product->compare_price > $product->price)
                                <span class="badge position-absolute top-0 start-0 m-2 px-2 py-1" style="background: var(--veloria-primary); font-size: 0.65rem; z-index: 2;">
                                    -{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}%
                                </span>
                            @endif
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->primaryImageUrl() }}" class="card-img-top product-image" alt="{{ $product->name }}">
                            </a>
                            <div class="card-body d-flex flex-column p-2 p-md-3">
                                <p class="product-category mb-1">{{ $product->category->name ?? '' }}</p>
                                <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    <h6 class="card-title fw-semibold mb-1 mb-md-2 product-title">{{ $product->name }}</h6>
                                </a>
                                <div class="mt-auto">
                                    <div class="d-flex align-items-center gap-1 gap-md-2 mb-2">
                                        <span class="product-price">&#8377;{{ number_format($product->price, 0) }}</span>
                                        @if($product->compare_price)
                                            <span class="product-old-price">&#8377;{{ number_format($product->compare_price, 0) }}</span>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="qty" value="1">
                                        <button type="submit" class="btn btn-veloria btn-sm w-100">
                                            <i class="bi bi-bag-plus me-1"></i><span class="d-none d-sm-inline">Add to </span>Bag
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-handbag fs-1" style="color: var(--veloria-primary-light);"></i>
                            <h5 class="mt-3" style="font-family: 'Playfair Display', serif;">Curating the Finest Pieces</h5>
                            <p class="text-muted">Our featured collection is being handpicked. Check back soon!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Style Inspiration Banners --}}
    <section class="py-4 py-md-5">
        <div class="container">
            <div class="row g-3 g-md-4">
                <div class="col-md-6">
                    <div class="p-4 p-md-5 rounded-4 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--veloria-dark), #555);">
                        <p class="text-uppercase small fw-semibold mb-2" style="letter-spacing: 2px; color: var(--veloria-primary-light); font-size: 0.75rem;">Women's Edit</p>
                        <h3 class="fw-bold mb-3 banner-heading" style="font-family: 'Playfair Display', serif;">Effortless<br>Elegance</h3>
                        <a href="{{ route('products.index', ['category' => 'women']) }}" class="btn btn-sm px-3 px-md-4 py-2" style="background: white; color: var(--veloria-dark); font-weight: 600; border-radius: 25px;">
                            Shop Now <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 p-md-5 rounded-4 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--veloria-primary), var(--veloria-primary-dark));">
                        <p class="text-uppercase small fw-semibold mb-2" style="letter-spacing: 2px; opacity: 0.8; font-size: 0.75rem;">Men's Edit</p>
                        <h3 class="fw-bold mb-3 banner-heading" style="font-family: 'Playfair Display', serif;">Modern<br>Sophistication</h3>
                        <a href="{{ route('products.index', ['category' => 'men']) }}" class="btn btn-sm px-3 px-md-4 py-2" style="background: white; color: var(--veloria-primary-dark); font-weight: 600; border-radius: 25px;">
                            Shop Now <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- New Arrivals --}}
    <section class="py-4 py-md-5 bg-white">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-3 mb-md-4">
                <div>
                    <p class="text-uppercase small fw-semibold mb-1" style="letter-spacing: 3px; color: var(--veloria-primary);">Just Dropped</p>
                    <h3 class="fw-bold section-heading mb-0 section-title" style="font-family: 'Playfair Display', serif;">New Arrivals</h3>
                </div>
                <a href="{{ route('products.index') }}" class="text-decoration-none small fw-semibold" style="color: var(--veloria-primary);">
                    View All <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="row g-2 g-md-4">
                @forelse($latestProducts as $product)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="card product-card h-100 position-relative">
                            @auth
                            <form action="{{ route('wishlist.toggle') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="wishlist-btn {{ auth()->user()->wishlists->contains('product_id', $product->id) ? 'active' : '' }}" title="Wishlist">
                                    <i class="bi bi-heart{{ auth()->user()->wishlists->contains('product_id', $product->id) ? '-fill' : '' }}"></i>
                                </button>
                            </form>
                            @endauth
                            <span class="badge position-absolute top-0 start-0 m-2 px-2 py-1 bg-dark" style="font-size: 0.65rem; z-index: 2;">NEW</span>
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->primaryImageUrl() }}" class="card-img-top product-image" alt="{{ $product->name }}">
                            </a>
                            <div class="card-body d-flex flex-column p-2 p-md-3">
                                <p class="product-category mb-1">{{ $product->category->name ?? '' }}</p>
                                <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    <h6 class="card-title fw-semibold mb-1 mb-md-2 product-title">{{ $product->name }}</h6>
                                </a>
                                <div class="mt-auto">
                                    <div class="d-flex align-items-center gap-1 gap-md-2 mb-2">
                                        <span class="product-price">&#8377;{{ number_format($product->price, 0) }}</span>
                                        @if($product->compare_price)
                                            <span class="product-old-price">&#8377;{{ number_format($product->compare_price, 0) }}</span>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="qty" value="1">
                                        <button type="submit" class="btn btn-veloria btn-sm w-100">
                                            <i class="bi bi-bag-plus me-1"></i><span class="d-none d-sm-inline">Add to </span>Bag
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-stars fs-1" style="color: var(--veloria-primary-light);"></i>
                            <h5 class="mt-3" style="font-family: 'Playfair Display', serif;">Fresh Drops Coming Soon</h5>
                            <p class="text-muted">New arrivals are on their way. Stay tuned!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 3D Flip Cards - Why Choose Veloria --}}
    <section class="py-5" style="background: linear-gradient(135deg, #fdf2f8, #f8f8f8);">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-uppercase small fw-semibold mb-1" style="letter-spacing: 3px; color: var(--veloria-primary);">Why Veloria?</p>
                <h3 class="fw-bold section-title" style="font-family: 'Playfair Display', serif;">The Veloria Difference</h3>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4 col-sm-6">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <i class="bi bi-gem fs-1"></i>
                                <h5 class="fw-bold mt-3">Premium Quality</h5>
                                <p class="small opacity-75">Handpicked fabrics & materials</p>
                            </div>
                            <div class="flip-card-back">
                                <i class="bi bi-check-circle fs-2 mb-2"></i>
                                <p class="small">Every product goes through 5-step quality checks. We source only from certified manufacturers with ethical practices.</p>
                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-light mt-2">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <i class="bi bi-truck fs-1"></i>
                                <h5 class="fw-bold mt-3">Express Delivery</h5>
                                <p class="small opacity-75">2-3 days across India</p>
                            </div>
                            <div class="flip-card-back">
                                <i class="bi bi-lightning fs-2 mb-2"></i>
                                <p class="small">Free shipping on orders above Rs.999. Same-day dispatch for orders before 2 PM. Track your order in real-time.</p>
                                <a href="{{ route('pages.shipping') }}" class="btn btn-sm btn-light mt-2">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <i class="bi bi-arrow-return-left fs-1"></i>
                                <h5 class="fw-bold mt-3">Easy Returns</h5>
                                <p class="small opacity-75">30-day hassle-free returns</p>
                            </div>
                            <div class="flip-card-back">
                                <i class="bi bi-shield-check fs-2 mb-2"></i>
                                <p class="small">Don't love it? Return within 30 days for a full refund. Free pickup from your doorstep. No questions asked.</p>
                                <a href="{{ route('pages.returns') }}" class="btn btn-sm btn-light mt-2">Return Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Newsletter --}}
    <section class="newsletter-section py-4 py-md-5">
        <div class="container text-center px-4">
            <i class="bi bi-envelope-heart fs-3 fs-md-2" style="color: var(--veloria-primary);"></i>
            <h3 class="fw-bold mt-3 mb-2 section-title" style="font-family: 'Playfair Display', serif;">Join the Veloria Family</h3>
            <p class="text-muted mb-4 small">Be the first to know about new collections, exclusive deals, and style inspiration.</p>
            <form class="newsletter-form mx-auto" action="{{ route('subscribe') }}" method="POST">
                @csrf
                <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                    <input type="email" name="email" class="form-control newsletter-input @error('email') is-invalid @enderror" placeholder="Enter your email address" value="{{ old('email') }}" required>
                    <button class="btn btn-veloria px-4 flex-shrink-0" type="submit" style="border-radius: 25px;">Subscribe</button>
                </div>
            </form>
            <p class="small text-muted mt-2">No spam, unsubscribe anytime.</p>
        </div>
    </section>
@endsection
