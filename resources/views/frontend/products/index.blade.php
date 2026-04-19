@extends('layouts.app')
@section('title', 'Shop')

@section('content')
<div class="container py-4">
    <div class="row">
        {{-- Filters Sidebar --}}
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Filters</h6>
                    <form method="GET" action="{{ route('products.index') }}" id="filterForm">
                        @if(request('q'))<input type="hidden" name="q" value="{{ request('q') }}">@endif
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Category</label>
                            @foreach($categories as $cat)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="{{ $cat->slug }}" id="cat{{ $cat->id }}" {{ request('category')==$cat->slug?'checked':'' }} onchange="document.getElementById('filterForm').submit()">
                                    <label class="form-check-label small" for="cat{{ $cat->id }}">{{ $cat->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Price Range</label>
                            <div class="d-flex gap-2">
                                <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="{{ request('min_price') }}">
                                <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Sort By</label>
                            <select name="sort" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit()">
                                <option value="newest" {{ request('sort')=='newest'?'selected':'' }}>Newest First</option>
                                <option value="price_low" {{ request('sort')=='price_low'?'selected':'' }}>Price: Low to High</option>
                                <option value="price_high" {{ request('sort')=='price_high'?'selected':'' }}>Price: High to Low</option>
                                <option value="name" {{ request('sort')=='name'?'selected':'' }}>Name: A-Z</option>
                            </select>
                        </div>
                        <button class="btn btn-veloria btn-sm w-100">Apply Filters</button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm w-100 mt-2">Clear All</a>
                    </form>
                </div>
            </div>
        </div>

        {{-- Products Grid --}}
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="mb-0 text-muted small">{{ $products->total() }} products found</p>
                @if(request('q'))<span class="badge bg-light text-dark">Search: "{{ request('q') }}" <a href="{{ route('products.index') }}" class="text-dark ms-1"><i class="bi bi-x"></i></a></span>@endif
            </div>
            <div class="row g-2 g-md-3">
                @forelse($products as $product)
                <div class="col-6 col-md-4">
                    <div class="card product-card h-100 position-relative">
                        @auth
                        <form action="{{ route('wishlist.toggle') }}" method="POST">@csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="wishlist-btn {{ auth()->user()->wishlists->contains('product_id', $product->id) ? 'active' : '' }}" title="Wishlist">
                                <i class="bi bi-heart{{ auth()->user()->wishlists->contains('product_id', $product->id) ? '-fill' : '' }}"></i>
                            </button>
                        </form>
                        @endauth
                        @if($product->compare_price && $product->compare_price > $product->price)
                            <span class="badge position-absolute top-0 start-0 m-2" style="background:var(--veloria-primary);font-size:0.65rem;z-index:2;">-{{ round((($product->compare_price-$product->price)/$product->compare_price)*100) }}%</span>
                        @endif
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->primaryImageUrl() }}" class="card-img-top product-image" alt="{{ $product->name }}">
                        </a>
                        <div class="card-body d-flex flex-column p-2 p-md-3">
                            <p class="product-category mb-1">{{ $product->category->name ?? '' }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                                <h6 class="card-title fw-semibold mb-1 product-title">{{ $product->name }}</h6>
                            </a>
                            <div class="mt-auto">
                                <div class="d-flex align-items-center gap-1 mb-2">
                                    <span class="product-price">&#8377;{{ number_format($product->price,0) }}</span>
                                    @if($product->compare_price)<span class="product-old-price">&#8377;{{ number_format($product->compare_price,0) }}</span>@endif
                                </div>
                                <form action="{{ route('cart.add') }}" method="POST">@csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    <button class="btn btn-veloria btn-sm w-100"><i class="bi bi-bag-plus me-1"></i><span class="d-none d-sm-inline">Add to </span>Bag</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-search fs-1" style="color:var(--veloria-primary-light);"></i>
                    <h5 class="mt-3">No products found</h5>
                    <p class="text-muted">Try adjusting your filters or search terms.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-veloria">View All Products</a>
                </div>
                @endforelse
            </div>
            <div class="mt-4">{{ $products->links() }}</div>
        </div>
    </div>
</div>
@endsection
