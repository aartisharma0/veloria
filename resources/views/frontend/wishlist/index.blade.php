@extends('layouts.app')
@section('title', 'Wishlist')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">My Wishlist</h3>

    @if($wishlists->count())
    <div class="row g-3">
        @foreach($wishlists as $w)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card product-card h-100 position-relative">
                <form action="{{ route('wishlist.toggle') }}" method="POST">@csrf
                    <input type="hidden" name="product_id" value="{{ $w->product->id }}">
                    <button type="submit" class="wishlist-btn active" title="Remove"><i class="bi bi-heart-fill"></i></button>
                </form>
                <a href="{{ route('products.show', $w->product->slug) }}">
                    <img src="{{ $w->product->primaryImageUrl() }}" class="card-img-top product-image">
                </a>
                <div class="card-body p-2 p-md-3 d-flex flex-column">
                    <p class="product-category mb-1">{{ $w->product->category->name ?? '' }}</p>
                    <h6 class="fw-semibold product-title">{{ $w->product->name }}</h6>
                    <div class="mt-auto">
                        <span class="product-price">&#8377;{{ number_format($w->product->price,0) }}</span>
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-2">@csrf
                            <input type="hidden" name="product_id" value="{{ $w->product->id }}">
                            <input type="hidden" name="qty" value="1">
                            <button class="btn btn-veloria btn-sm w-100"><i class="bi bi-bag-plus me-1"></i>Add to Bag</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $wishlists->links() }}</div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-heart fs-1" style="color:var(--veloria-primary-light);"></i>
        <h5 class="mt-3">Your wishlist is empty</h5>
        <p class="text-muted">Save items you love by clicking the heart icon.</p>
        <a href="{{ route('products.index') }}" class="btn btn-veloria">Browse Products</a>
    </div>
    @endif
</div>
@endsection
