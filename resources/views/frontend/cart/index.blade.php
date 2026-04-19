@extends('layouts.app')
@section('title', 'Shopping Bag')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">Shopping Bag</h3>

    @if(count($cartItems) > 0)
    <div class="row g-4">
        <div class="col-lg-8">
            @foreach($cartItems as $key => $item)
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <img src="{{ $item['product']->primaryImageUrl() }}" class="rounded" style="width:100px;height:100px;object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="fw-semibold mb-1">{{ $item['name'] }}</h6>
                                    @if($item['size'] || $item['color'])<small class="text-muted">{{ $item['size'] }} {{ $item['color'] }}</small>@endif
                                </div>
                                <span class="fw-bold" style="color:var(--veloria-primary);">&#8377;{{ number_format($item['total'],0) }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-2">
                                <div class="d-flex align-items-center gap-2">
                                    {{-- Minus button --}}
                                    @if($item['qty'] > 1)
                                    <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="key" value="{{ $key }}">
                                        <input type="hidden" name="qty" value="{{ $item['qty'] - 1 }}">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center" style="width:32px;height:32px;border-radius:50%;padding:0;">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                    </form>
                                    @else
                                    <button class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center" style="width:32px;height:32px;border-radius:50%;padding:0;" disabled>
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    @endif

                                    {{-- Quantity display --}}
                                    <span class="fw-bold px-2" style="min-width:30px;text-align:center;">{{ $item['qty'] }}</span>

                                    {{-- Plus button --}}
                                    @php $maxStock = min(10, $item['product']->stock); @endphp
                                    @if($item['qty'] < $maxStock)
                                    <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="key" value="{{ $key }}">
                                        <input type="hidden" name="qty" value="{{ $item['qty'] + 1 }}">
                                        <button type="submit" class="btn btn-sm d-flex align-items-center justify-content-center" style="width:32px;height:32px;border-radius:50%;padding:0;background:var(--veloria-primary);color:white;border:none;">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </form>
                                    @else
                                    <button class="btn btn-secondary btn-sm d-flex align-items-center justify-content-center" style="width:32px;height:32px;border-radius:50%;padding:0;" disabled title="Max stock reached">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                    @endif

                                    <span class="small text-muted ms-1">x &#8377;{{ number_format($item['price'],0) }}</span>
                                </div>

                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <button class="btn btn-sm btn-outline-danger" style="border-radius:50%;width:32px;height:32px;padding:0;"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Order Summary</h6>
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Subtotal</span><span>&#8377;{{ number_format($subtotal,0) }}</span></div>
                    @if($discount > 0)
                        <div class="d-flex justify-content-between mb-2 text-success">
                            <span>Discount ({{ $couponCode }})</span>
                            <span>-&#8377;{{ number_format($discount,0) }}
                                <form action="{{ route('cart.coupon.remove') }}" method="POST" class="d-inline">@csrf @method('DELETE')
                                    <button class="btn btn-link text-danger p-0 ms-1" style="font-size:0.7rem;"><i class="bi bi-x-circle"></i></button>
                                </form>
                            </span>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Tax (GST 18%)</span><span>&#8377;{{ number_format($tax,0) }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Shipping</span><span>{{ $subtotal >= 999 ? 'FREE' : '₹99' }}</span></div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-3"><span>Total</span><span style="color:var(--veloria-primary);">&#8377;{{ number_format($total,0) }}</span></div>

                    @if(!$couponCode)
                    <form action="{{ route('cart.coupon.apply') }}" method="POST" class="d-flex gap-2 mb-3">
                        @csrf
                        <input type="text" name="coupon_code" class="form-control form-control-sm" placeholder="Coupon code" style="text-transform:uppercase;">
                        <button class="btn btn-sm btn-outline-dark">Apply</button>
                    </form>
                    @endif

                    @auth
                        <a href="{{ route('checkout.index') }}" class="btn btn-veloria w-100"><i class="bi bi-lock me-2"></i>Proceed to Checkout</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-veloria w-100"><i class="bi bi-person me-2"></i>Login to Checkout</a>
                    @endauth
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm w-100 mt-2">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-bag fs-1" style="color:var(--veloria-primary-light);"></i>
        <h5 class="mt-3">Your bag is empty</h5>
        <p class="text-muted">Looks like you haven't added anything yet.</p>
        <a href="{{ route('products.index') }}" class="btn btn-veloria">Start Shopping</a>
    </div>
    @endif
</div>
@endsection
