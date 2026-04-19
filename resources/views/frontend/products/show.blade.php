@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="container py-4">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Shop</a></li>
            @if($product->category)<li class="breadcrumb-item"><a href="{{ route('products.index', ['category'=>$product->category->slug]) }}" class="text-decoration-none">{{ $product->category->name }}</a></li>@endif
            <li class="breadcrumb-item active">{{ Str::limit($product->name, 30) }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        {{-- Images --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-3">
                @if($product->images && count($product->images) > 0)
                    @php
                        $firstImg = str_starts_with($product->images[0], 'http') ? $product->images[0] : asset('storage/' . $product->images[0]);
                    @endphp
                    <img src="{{ $firstImg }}" class="img-fluid rounded mb-3" id="mainImage" style="width:100%;max-height:500px;object-fit:contain;">
                    <div class="d-flex gap-2 overflow-auto">
                        @foreach($product->images as $img)
                            @php $imgUrl = str_starts_with($img, 'http') ? $img : asset('storage/' . $img); @endphp
                            <img src="{{ $imgUrl }}" class="rounded border" style="width:70px;height:70px;object-fit:cover;cursor:pointer;" onclick="document.getElementById('mainImage').src=this.src">
                        @endforeach
                    </div>
                @else
                    <img src="{{ $product->primaryImageUrl() }}" class="img-fluid rounded">
                @endif
            </div>
        </div>

        {{-- Details --}}
        <div class="col-md-6">
            <p class="product-category mb-1 text-uppercase">{{ $product->category->name ?? '' }}</p>
            <h2 class="fw-bold mb-2" style="font-family:'Playfair Display',serif;">{{ $product->name }}</h2>

            {{-- Rating --}}
            @php $avg = $product->averageRating(); @endphp
            @if($avg)
                <div class="d-flex align-items-center gap-2 mb-3">
                    @for($i=1;$i<=5;$i++)<i class="bi bi-star{{ $i<=round($avg)?'-fill':'' }} text-warning"></i>@endfor
                    <span class="small text-muted">({{ $product->reviews()->where('approved',true)->count() }} reviews)</span>
                </div>
            @endif

            {{-- Price --}}
            <div class="d-flex align-items-center gap-3 mb-3">
                <span class="fs-3 fw-bold" style="color:var(--veloria-primary);">&#8377;{{ number_format($product->price,0) }}</span>
                @if($product->compare_price)
                    <span class="text-muted text-decoration-line-through fs-5">&#8377;{{ number_format($product->compare_price,0) }}</span>
                    <span class="badge bg-success">{{ round((($product->compare_price-$product->price)/$product->compare_price)*100) }}% off</span>
                @endif
            </div>

            <p class="text-muted small mb-3">{{ $product->description }}</p>

            {{-- Stock --}}
            <p class="mb-3">
                @if($product->isInStock())
                    <span class="text-success fw-semibold"><i class="bi bi-check-circle me-1"></i>In Stock ({{ $product->stock }} available)</span>
                @else
                    <span class="text-danger fw-semibold"><i class="bi bi-x-circle me-1"></i>Out of Stock</span>
                @endif
            </p>

            {{-- Add to Cart Form --}}
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                {{-- Variants --}}
                @if($product->variants->count())
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Select Variant</label>
                    <select name="variant_id" class="form-select">
                        <option value="">Default</option>
                        @foreach($product->variants as $v)
                            <option value="{{ $v->id }}" {{ $v->stock <=0 ? 'disabled' : '' }}>
                                {{ $v->size }} / {{ $v->color }} — ₹{{ number_format($product->price + $v->price_modifier, 0) }} {{ $v->stock<=0?'(Out of stock)':'' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="d-flex gap-3 mb-3 align-items-center">
                    <label class="form-label fw-semibold small mb-0">Qty:</label>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-outline-secondary d-flex align-items-center justify-content-center" style="width:38px;height:38px;border-radius:50%;padding:0;" onclick="changeQty(-1, {{ min(10,$product->stock) }})">
                            <i class="bi bi-dash fs-5"></i>
                        </button>
                        <input type="number" name="qty" id="qtyInput" value="1" min="1" max="{{ min(10,$product->stock) }}" class="form-control text-center fw-bold mx-2 no-select2" style="width:55px;height:38px;" readonly>
                        <button type="button" class="btn d-flex align-items-center justify-content-center" style="width:38px;height:38px;border-radius:50%;padding:0;background:var(--veloria-primary);color:white;border:none;" onclick="changeQty(1, {{ min(10,$product->stock) }})">
                            <i class="bi bi-plus fs-5"></i>
                        </button>
                    </div>
                    <small class="text-muted">Max {{ min(10,$product->stock) }}</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-veloria btn-lg flex-grow-1" id="addToCartBtn" {{ !$product->isInStock()?'disabled':'' }}>
                        <i class="bi bi-bag-plus me-2"></i>Add to Bag
                    </button>
                    @auth
                    <form action="{{ route('wishlist.toggle') }}" method="POST" class="d-inline">@csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-outline-secondary btn-lg"><i class="bi bi-heart{{ auth()->user()->wishlists->contains('product_id',$product->id)?'-fill':'' }}"></i></button>
                    </form>
                    @endauth
                </div>
            </form>

            {{-- SKU --}}
            @if($product->sku)<p class="mt-3 small text-muted">SKU: {{ $product->sku }}</p>@endif

            {{-- Share --}}
            <div class="mt-3 pt-3 border-top">
                <span class="small fw-semibold me-2">Share:</span>
                @php $shareUrl = urlencode(request()->url()); $shareText = urlencode($product->name . ' - Veloria'); @endphp
                <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank" class="btn btn-sm btn-outline-success me-1" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="btn btn-sm btn-outline-primary me-1" title="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com/intent/tweet?text={{ $shareText }}&url={{ $shareUrl }}" target="_blank" class="btn btn-sm btn-outline-dark me-1" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="https://pinterest.com/pin/create/button/?url={{ $shareUrl }}&description={{ $shareText }}" target="_blank" class="btn btn-sm btn-outline-danger me-1" title="Pinterest"><i class="bi bi-pinterest"></i></a>
                <button class="btn btn-sm btn-outline-secondary" onclick="navigator.clipboard.writeText('{{ request()->url() }}').then(()=>{this.innerHTML='<i class=\'bi bi-check\'></i> Copied';setTimeout(()=>this.innerHTML='<i class=\'bi bi-link-45deg\'></i>',1500)})" title="Copy Link"><i class="bi bi-link-45deg"></i></button>
            </div>
        </div>
    </div>

    {{-- Reviews --}}
    <div class="mt-5">
        <h4 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">Customer Reviews</h4>

        @auth
        @php
            $existingReview = auth()->user()->reviews()->where('product_id', $product->id)->first();
            $hasPurchased = auth()->user()->orders()->where('status', '!=', 'cancelled')->whereHas('items', fn($q) => $q->where('product_id', $product->id))->exists();
        @endphp
        @if($existingReview)
            <div class="card border-0 shadow-sm mb-4" style="background:var(--veloria-pink-soft);">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        <h6 class="fw-semibold mb-0">You reviewed this product</h6>
                    </div>
                    <div class="mb-1">
                        @for($i=1;$i<=5;$i++)<i class="bi bi-star{{ $i<=$existingReview->rating?'-fill':'' }} text-warning"></i>@endfor
                    </div>
                    @if($existingReview->body)<p class="small text-muted mb-1">{{ $existingReview->body }}</p>@endif
                    @if(!$existingReview->approved)<small class="text-muted"><i class="bi bi-clock me-1"></i>Pending approval</small>@endif
                </div>
            </div>
        @elseif($hasPurchased || auth()->user()->isAdmin())
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-semibold mb-3">Write a Review</h6>
                <form action="{{ route('products.review', $product) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold d-block">Your Rating</label>
                        <input type="hidden" name="rating" id="ratingInput" value="5" required>
                        <div class="d-flex align-items-center gap-1" id="starRating">
                            @for($i=1;$i<=5;$i++)
                                <i class="bi bi-star-fill fs-4 star-btn" data-value="{{ $i }}" style="color: var(--veloria-primary); cursor: pointer; transition: transform 0.15s;"></i>
                            @endfor
                            <span class="ms-2 small fw-semibold" id="ratingText" style="color: var(--veloria-primary);">5 Stars - Excellent!</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea name="body" class="form-control" rows="3" placeholder="Share your experience with this product..."></textarea>
                    </div>
                    <button class="btn btn-veloria btn-sm"><i class="bi bi-send me-1"></i> Submit Review</button>
                </form>
            </div>
        </div>
        @endif
        @endauth

        @forelse($reviews as $review)
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>{{ $review->user->name }}</strong>
                        <div>@for($i=1;$i<=5;$i++)<i class="bi bi-star{{ $i<=$review->rating?'-fill':'' }} text-warning" style="font-size:0.8rem;"></i>@endfor</div>
                    </div>
                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                </div>
                @if($review->body)<p class="mt-2 mb-0 small">{{ $review->body }}</p>@endif
            </div>
        </div>
        @empty
        <p class="text-muted">No reviews yet. Be the first to review!</p>
        @endforelse
        {{ $reviews->links() }}
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count())
    <div class="mt-5">
        <h4 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">You May Also Like</h4>
        <div class="row g-3">
            @foreach($relatedProducts as $rp)
            <div class="col-6 col-md-3">
                <div class="card product-card h-100">
                    <a href="{{ route('products.show', $rp->slug) }}">
                        <img src="{{ $rp->primaryImage() ? ($rp->primaryImageUrl()) : 'https://via.placeholder.com/300x350/f0f0f0/999?text=No+Image' }}" class="card-img-top product-image" alt="{{ $rp->name }}">
                    </a>
                    <div class="card-body p-2">
                        <h6 class="small fw-semibold product-title">{{ $rp->name }}</h6>
                        <span class="product-price">&#8377;{{ number_format($rp->price,0) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Recently Viewed --}}
    @if(isset($recentProducts) && $recentProducts->count())
    <div class="mt-5">
        <h4 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">Recently Viewed</h4>
        <div class="row g-3">
            @foreach($recentProducts as $rp)
            <div class="col-6 col-md-3">
                <div class="card product-card h-100">
                    <a href="{{ route('products.show', $rp->slug) }}">
                        <img src="{{ $rp->primaryImageUrl() }}" class="card-img-top product-image" alt="{{ $rp->name }}">
                    </a>
                    <div class="card-body p-2">
                        <h6 class="small fw-semibold product-title">{{ $rp->name }}</h6>
                        <span class="product-price">&#8377;{{ number_format($rp->price,0) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
function changeQty(delta, max) {
    const input = document.getElementById('qtyInput');
    let val = parseInt(input.value) + delta;
    if (val < 1) val = 1;
    if (val > max) val = max;
    input.value = val;
}

// Star rating
const ratingLabels = {1: '1 Star - Poor', 2: '2 Stars - Fair', 3: '3 Stars - Good', 4: '4 Stars - Very Good', 5: '5 Stars - Excellent!'};
document.querySelectorAll('.star-btn').forEach(star => {
    star.addEventListener('click', function() {
        const val = parseInt(this.dataset.value);
        document.getElementById('ratingInput').value = val;
        document.getElementById('ratingText').textContent = ratingLabels[val];

        document.querySelectorAll('.star-btn').forEach((s, i) => {
            if (i < val) {
                s.classList.replace('bi-star', 'bi-star-fill');
                s.classList.add('bi-star-fill');
                s.classList.remove('bi-star');
                s.style.color = 'var(--veloria-primary)';
                s.style.transform = 'scale(1.2)';
            } else {
                s.classList.replace('bi-star-fill', 'bi-star');
                s.classList.add('bi-star');
                s.classList.remove('bi-star-fill');
                s.style.color = '#ccc';
                s.style.transform = 'scale(1)';
            }
        });
        setTimeout(() => {
            document.querySelectorAll('.star-btn').forEach(s => s.style.transform = 'scale(1)');
        }, 200);
    });

    star.addEventListener('mouseenter', function() {
        const val = parseInt(this.dataset.value);
        document.querySelectorAll('.star-btn').forEach((s, i) => {
            s.style.transform = i < val ? 'scale(1.15)' : 'scale(1)';
            s.style.color = i < val ? 'var(--veloria-primary)' : '#ddd';
        });
    });
});

document.getElementById('starRating')?.addEventListener('mouseleave', function() {
    const current = parseInt(document.getElementById('ratingInput').value);
    document.querySelectorAll('.star-btn').forEach((s, i) => {
        s.style.transform = 'scale(1)';
        if (i < current) {
            s.classList.add('bi-star-fill');
            s.classList.remove('bi-star');
            s.style.color = 'var(--veloria-primary)';
        } else {
            s.classList.add('bi-star');
            s.classList.remove('bi-star-fill');
            s.style.color = '#ccc';
        }
    });
});

// Image zoom on hover
const mainImage = document.getElementById('mainImage');
if (mainImage) {
    const container = mainImage.parentElement;
    container.style.overflow = 'hidden';
    container.style.cursor = 'zoom-in';

    mainImage.addEventListener('mousemove', function(e) {
        const rect = this.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;
        this.style.transformOrigin = x + '% ' + y + '%';
        this.style.transform = 'scale(1.8)';
    });

    mainImage.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
        this.style.transformOrigin = 'center center';
    });
}
</script>
@endpush
@endsection
