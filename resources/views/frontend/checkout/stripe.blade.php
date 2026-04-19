@extends('layouts.app')
@section('title', 'Payment')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="text-center mb-4">
                <i class="bi bi-credit-card fs-1" style="color:var(--veloria-primary);"></i>
                <h4 class="fw-bold mt-2" style="font-family:'Playfair Display',serif;">Complete Payment</h4>
                <p class="text-muted">Order: {{ $order->order_number }}</p>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                        <span>Amount to Pay</span>
                        <span style="color:var(--veloria-primary);">&#8377;{{ number_format($order->total, 2) }}</span>
                    </div>

                    <form action="{{ route('checkout.stripe.process', $order) }}" method="POST" id="payment-form">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold small">Card Details</label>
                            <div id="card-element" class="form-control py-3"></div>
                            <div id="card-errors" class="text-danger small mt-2"></div>
                        </div>
                        <button type="submit" id="submit-btn" class="btn btn-veloria w-100 py-2">
                            <i class="bi bi-lock me-2"></i>Pay &#8377;{{ number_format($order->total, 0) }}
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted"><i class="bi bi-shield-check me-1"></i>Secured by Stripe. We never store your card details.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config("services.stripe.key") }}');
    const elements = stripe.elements();
    const card = elements.create('card', {
        style: { base: { fontSize: '16px', color: '#3a3a3a', '::placeholder': { color: '#aab7c4' } } }
    });
    card.mount('#card-element');

    card.on('change', function(event) {
        document.getElementById('card-errors').textContent = event.error ? event.error.message : '';
    });

    document.getElementById('payment-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

        const { token, error } = await stripe.createToken(card);
        if (error) {
            document.getElementById('card-errors').textContent = error.message;
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-lock me-2"></i>Pay ₹{{ number_format($order->total, 0) }}';
        } else {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'stripeToken';
            input.value = token.id;
            this.appendChild(input);
            this.submit();
        }
    });
</script>
@endpush
