@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">Checkout</h3>

    <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
        @csrf
        <div class="row g-4">
            <div class="col-lg-7">
                {{-- Shipping Address --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-semibold"><i class="bi bi-geo-alt me-2" style="color:var(--veloria-primary);"></i>Shipping Address</h6>
                        <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                            <i class="bi bi-plus"></i> Add New
                        </button>
                    </div>
                    <div class="card-body">
                        @forelse($addresses as $addr)
                        <div class="form-check border rounded p-3 mb-2 {{ $addr->is_default ? 'border-2' : '' }}" style="{{ $addr->is_default ? 'border-color:var(--veloria-primary) !important;' : '' }}">
                            <input class="form-check-input" type="radio" name="shipping_address_id" value="{{ $addr->id }}" id="addr{{ $addr->id }}" {{ ($defaultAddress && $defaultAddress->id == $addr->id) ? 'checked' : '' }} required>
                            <label class="form-check-label w-100" for="addr{{ $addr->id }}">
                                <strong>{{ $addr->full_name }}</strong> @if($addr->is_default)<span class="badge" style="background:var(--veloria-primary);font-size:0.65rem;">Default</span>@endif<br>
                                <small class="text-muted">{{ $addr->street }}, {{ $addr->city }}, {{ $addr->state }} {{ $addr->zip }}<br>{{ $addr->country }} @if($addr->phone)| {{ $addr->phone }}@endif</small>
                            </label>
                        </div>
                        @empty
                        <div class="alert alert-warning mb-0"><i class="bi bi-exclamation-triangle me-2"></i>Please add a shipping address first.</div>
                        @endforelse
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white"><h6 class="mb-0 fw-semibold"><i class="bi bi-credit-card me-2" style="color:var(--veloria-primary);"></i>Payment Method</h6></div>
                    <div class="card-body">
                        <div class="form-check border rounded p-3 mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" value="stripe" id="pmStripe" checked onchange="toggleStripeCard()">
                            <label class="form-check-label" for="pmStripe">
                                <strong>Credit / Debit Card</strong>
                                <small class="text-muted d-block">Pay securely with your card (Powered by Stripe)</small>
                            </label>
                        </div>

                        {{-- Stripe Card Input (inline) --}}
                        <div id="stripeCardSection" class="border rounded p-3 mb-2 ms-4" style="background:#fafafa;">
                            <label class="form-label small fw-semibold">Card Details</label>
                            <div id="card-element" class="form-control py-3" style="height:auto;"></div>
                            <div id="card-errors" class="text-danger small mt-1"></div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <i class="bi bi-shield-lock-fill text-success"></i>
                                <small class="text-muted">Your card info is encrypted and never stored on our servers.</small>
                            </div>
                        </div>

                        <div class="form-check border rounded p-3">
                            <input class="form-check-input" type="radio" name="payment_method" value="cod" id="pmCod" onchange="toggleStripeCard()">
                            <label class="form-check-label" for="pmCod">
                                <strong>Cash on Delivery</strong>
                                <small class="text-muted d-block">Pay when your order arrives</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white"><h6 class="mb-0 fw-semibold"><i class="bi bi-receipt me-2" style="color:var(--veloria-primary);"></i>Order Summary</h6></div>
                    <div class="card-body">
                        @foreach($cartItems as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $item['product']->primaryImageUrl() }}" class="rounded" style="width:40px;height:40px;object-fit:cover;">
                                <div><small class="fw-semibold">{{ Str::limit($item['name'],25) }}</small><br><small class="text-muted">Qty: {{ $item['qty'] }}</small></div>
                            </div>
                            <small class="fw-semibold">&#8377;{{ number_format($item['total'],0) }}</small>
                        </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between small mb-1"><span>Subtotal</span><span>&#8377;{{ number_format($subtotal,0) }}</span></div>
                        @if($discount > 0)<div class="d-flex justify-content-between small mb-1 text-success"><span>Discount</span><span>-&#8377;{{ number_format($discount,0) }}</span></div>@endif
                        <div class="d-flex justify-content-between small mb-1"><span>Tax (GST 18%)</span><span>&#8377;{{ number_format($tax,0) }}</span></div>
                        <div class="d-flex justify-content-between small mb-1"><span>Shipping</span><span>{{ $shipping == 0 ? 'FREE' : '₹'.$shipping }}</span></div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5"><span>Total</span><span style="color:var(--veloria-primary);">&#8377;{{ number_format($total,0) }}</span></div>
                        @if($addresses->isEmpty())
                            <div class="alert alert-warning small mt-3 mb-0 text-center">
                                <i class="bi bi-exclamation-triangle me-1"></i>Please add a shipping address to continue.
                            </div>
                            <button type="button" class="btn btn-secondary w-100 mt-2 py-2" disabled>
                                <i class="bi bi-lock me-2"></i>Place Order & Pay
                            </button>
                        @else
                            <button type="submit" id="submitBtn" class="btn btn-veloria w-100 mt-3 py-2">
                                <i class="bi bi-lock me-2"></i>Place Order & Pay
                            </button>
                        @endif
                        <p class="text-center small text-muted mt-2 mb-0"><i class="bi bi-shield-check me-1"></i>Secure & encrypted checkout</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hidden field for Stripe token --}}
        <input type="hidden" name="stripeToken" id="stripeToken">
    </form>
</div>

{{-- Add Address Modal --}}
<div class="modal fade" id="addAddressModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('account.addresses.store') }}" method="POST">
                @csrf
                <div class="modal-header"><h6 class="modal-title fw-semibold">Add Shipping Address</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <input type="hidden" name="type" value="shipping">
                    <div class="mb-3"><input type="text" name="full_name" class="form-control" placeholder="Full Name" required></div>
                    <div class="mb-3"><input type="text" name="phone" class="form-control" placeholder="Phone Number"></div>
                    <div class="mb-3"><textarea name="street" class="form-control" placeholder="Street Address" rows="2" required></textarea></div>
                    <div class="row g-2">
                        <div class="col-6 mb-3"><input type="text" name="city" class="form-control" placeholder="City" required></div>
                        <div class="col-6 mb-3"><input type="text" name="state" class="form-control" placeholder="State" required></div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6 mb-3"><input type="text" name="zip" class="form-control" placeholder="PIN Code" required></div>
                        <div class="col-6 mb-3"><input type="text" name="country" class="form-control" placeholder="Country" value="India" required></div>
                    </div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="is_default" value="1" id="addrDefault"><label class="form-check-label small" for="addrDefault">Set as default</label></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-veloria">Save Address</button></div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ $stripeKey }}');
    const elements = stripe.elements();
    const card = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#3a3a3a',
                fontFamily: 'Inter, sans-serif',
                '::placeholder': { color: '#aab7c4' }
            },
            invalid: { color: '#dc3545' }
        }
    });
    card.mount('#card-element');

    card.on('change', function(event) {
        document.getElementById('card-errors').textContent = event.error ? event.error.message : '';
    });

    function toggleStripeCard() {
        const isStripe = document.getElementById('pmStripe').checked;
        document.getElementById('stripeCardSection').style.display = isStripe ? 'block' : 'none';
        document.getElementById('submitBtn').innerHTML = isStripe
            ? '<i class="bi bi-lock me-2"></i>Pay & Place Order'
            : '<i class="bi bi-bag-check me-2"></i>Place Order (COD)';
    }

    document.getElementById('checkoutForm').addEventListener('submit', async function(e) {
        const isStripe = document.getElementById('pmStripe').checked;

        if (!isStripe) return; // COD - normal form submit

        e.preventDefault();

        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing payment...';

        const { token, error } = await stripe.createToken(card);

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-lock me-2"></i>Pay & Place Order';
        } else {
            document.getElementById('stripeToken').value = token.id;
            this.submit();
        }
    });
</script>
@endpush
@endsection
