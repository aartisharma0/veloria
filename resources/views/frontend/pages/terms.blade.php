@extends('layouts.app')
@section('title', 'Terms & Conditions')

@section('content')
<div class="container py-5" style="max-width:850px;">
    <h2 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">Terms & Conditions</h2>
    <p class="text-muted mb-4">Last updated: {{ date('F Y') }}</p>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">1. General</h5>
        <p>By accessing and using the Veloria website, you agree to be bound by these Terms and Conditions. Veloria reserves the right to update these terms at any time without prior notice.</p>
    </div></div>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">2. Account Registration</h5>
        <p>To place orders, you must create an account with accurate information. You are responsible for maintaining the confidentiality of your account credentials. You must be at least 18 years old to use our services.</p>
    </div></div>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">3. Orders & Pricing</h5>
        <p>All prices are listed in Indian Rupees (INR) and include applicable taxes unless stated otherwise. Veloria reserves the right to modify prices at any time. Once an order is placed and payment is confirmed, the price at the time of purchase will be honored.</p>
    </div></div>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">4. Payments</h5>
        <p>We accept payments via Credit/Debit Cards (processed securely by Stripe) and Cash on Delivery (COD). All card payments are encrypted and we never store your card information on our servers.</p>
    </div></div>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">5. Shipping & Delivery</h5>
        <p>Delivery timelines are estimates and may vary. Free shipping is available on orders above Rs.999. For complete shipping details, please visit our <a href="{{ route('pages.shipping') }}" style="color:var(--veloria-primary);">Shipping & Delivery</a> page.</p>
    </div></div>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">6. Returns & Refunds</h5>
        <p>We offer a 30-day return policy for most items. For complete details, please visit our <a href="{{ route('pages.returns') }}" style="color:var(--veloria-primary);">Returns & Exchanges</a> page.</p>
    </div></div>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">7. User Content & Reviews</h5>
        <p>By submitting reviews, you grant Veloria the right to use, display, and moderate your content. Reviews must be honest and based on genuine purchases. Veloria reserves the right to remove any content deemed inappropriate.</p>
    </div></div>

    <div class="card border-0 shadow-sm"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">8. Contact</h5>
        <p>For questions about these terms, please <a href="{{ route('contact') }}" style="color:var(--veloria-primary);">contact us</a>.</p>
    </div></div>
</div>
@endsection
