@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Hero Section --}}
    <section class="hero-section">
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
                        <a href="#" class="btn btn-veloria btn-lg px-4 px-md-5">
                            Shop Now <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="#" class="btn btn-veloria-outline btn-lg px-4" style="color: white; border-color: rgba(255,255,255,0.4);">
                            Explore Trends
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
                <a href="#" class="text-decoration-none small fw-semibold" style="color: var(--veloria-primary);">
                    View All <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="row g-2 g-md-3">
                @forelse($categories as $category)
                    <div class="col-4 col-sm-4 col-md-3 col-lg-2">
                        <a href="#" class="text-decoration-none text-dark">
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
                            <button class="wishlist-btn" title="Add to wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                            @if($product->compare_price && $product->compare_price > $product->price)
                                <span class="badge position-absolute top-0 start-0 m-2 px-2 py-1" style="background: var(--veloria-primary); font-size: 0.65rem; z-index: 2;">
                                    -{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}%
                                </span>
                            @endif
                            <img src="{{ $product->primaryImage() ?? 'https://via.placeholder.com/300x350/f0f0f0/999?text=Coming+Soon' }}"
                                 class="card-img-top product-image" alt="{{ $product->name }}">
                            <div class="card-body d-flex flex-column p-2 p-md-3">
                                <p class="product-category mb-1">{{ $product->category->name ?? '' }}</p>
                                <h6 class="card-title fw-semibold mb-1 mb-md-2 product-title">{{ $product->name }}</h6>
                                <div class="mt-auto">
                                    <div class="d-flex align-items-center gap-1 gap-md-2 mb-2">
                                        <span class="product-price">&#8377;{{ number_format($product->price, 0) }}</span>
                                        @if($product->compare_price)
                                            <span class="product-old-price">&#8377;{{ number_format($product->compare_price, 0) }}</span>
                                        @endif
                                    </div>
                                    <button class="btn btn-veloria btn-sm w-100">
                                        <i class="bi bi-bag-plus me-1"></i><span class="d-none d-sm-inline">Add to </span>Bag
                                    </button>
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
                        <a href="#" class="btn btn-sm px-3 px-md-4 py-2" style="background: white; color: var(--veloria-dark); font-weight: 600; border-radius: 25px;">
                            Shop Now <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 p-md-5 rounded-4 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--veloria-primary), var(--veloria-primary-dark));">
                        <p class="text-uppercase small fw-semibold mb-2" style="letter-spacing: 2px; opacity: 0.8; font-size: 0.75rem;">Men's Edit</p>
                        <h3 class="fw-bold mb-3 banner-heading" style="font-family: 'Playfair Display', serif;">Modern<br>Sophistication</h3>
                        <a href="#" class="btn btn-sm px-3 px-md-4 py-2" style="background: white; color: var(--veloria-primary-dark); font-weight: 600; border-radius: 25px;">
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
                <a href="#" class="text-decoration-none small fw-semibold" style="color: var(--veloria-primary);">
                    View All <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="row g-2 g-md-4">
                @forelse($latestProducts as $product)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="card product-card h-100 position-relative">
                            <button class="wishlist-btn" title="Add to wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                            <span class="badge position-absolute top-0 start-0 m-2 px-2 py-1 bg-dark" style="font-size: 0.65rem; z-index: 2;">NEW</span>
                            <img src="{{ $product->primaryImage() ?? 'https://via.placeholder.com/300x350/f0f0f0/999?text=Coming+Soon' }}"
                                 class="card-img-top product-image" alt="{{ $product->name }}">
                            <div class="card-body d-flex flex-column p-2 p-md-3">
                                <p class="product-category mb-1">{{ $product->category->name ?? '' }}</p>
                                <h6 class="card-title fw-semibold mb-1 mb-md-2 product-title">{{ $product->name }}</h6>
                                <div class="mt-auto">
                                    <div class="d-flex align-items-center gap-1 gap-md-2 mb-2">
                                        <span class="product-price">&#8377;{{ number_format($product->price, 0) }}</span>
                                        @if($product->compare_price)
                                            <span class="product-old-price">&#8377;{{ number_format($product->compare_price, 0) }}</span>
                                        @endif
                                    </div>
                                    <button class="btn btn-veloria btn-sm w-100">
                                        <i class="bi bi-bag-plus me-1"></i><span class="d-none d-sm-inline">Add to </span>Bag
                                    </button>
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

    {{-- Newsletter --}}
    <section class="newsletter-section py-4 py-md-5">
        <div class="container text-center px-4">
            <i class="bi bi-envelope-heart fs-3 fs-md-2" style="color: var(--veloria-primary);"></i>
            <h3 class="fw-bold mt-3 mb-2 section-title" style="font-family: 'Playfair Display', serif;">Join the Veloria Family</h3>
            <p class="text-muted mb-4 small">Be the first to know about new collections, exclusive deals, and style inspiration.</p>
            <form class="newsletter-form mx-auto">
                <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                    <input type="email" class="form-control newsletter-input" placeholder="Enter your email address">
                    <button class="btn btn-veloria px-4 flex-shrink-0" type="button" style="border-radius: 25px;">Subscribe</button>
                </div>
            </form>
            <p class="small text-muted mt-2">No spam, unsubscribe anytime.</p>
        </div>
    </section>
@endsection
