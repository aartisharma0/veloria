@extends('layouts.app')
@section('title', 'Privacy Policy')

@section('content')
<div class="container py-5" style="max-width:850px;">
    <h2 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">Privacy Policy</h2>
    <p class="text-muted mb-4">Last updated: {{ date('F Y') }}</p>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">1. Information We Collect</h5>
        <ul>
            <li><strong>Personal Information:</strong> Name, email, phone number, shipping/billing address when you create an account or place an order.</li>
            <li><strong>Payment Information:</strong> Card details are processed securely by Stripe and are never stored on our servers.</li>
            <li><strong>Usage Data:</strong> Pages visited, products viewed, search queries, and browser information to improve our services.</li>
        </ul>
    </div></div>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">2. How We Use Your Information</h5>
        <ul>
            <li>To process and deliver your orders</li>
            <li>To send order confirmations and status updates via email</li>
            <li>To send promotional offers and newsletters (only if you subscribe)</li>
            <li>To improve our website and customer experience</li>
            <li>To prevent fraud and ensure security</li>
        </ul>
    </div></div>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">3. Data Protection</h5>
        <p>We implement industry-standard security measures including:</p>
        <ul>
            <li>SSL encryption for all data transmission</li>
            <li>Bcrypt hashing for passwords</li>
            <li>PCI-DSS compliant payment processing via Stripe</li>
            <li>Rate limiting to prevent brute force attacks</li>
            <li>CSRF protection on all forms</li>
        </ul>
    </div></div>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">4. Cookies</h5>
        <p>We use session cookies to maintain your login status and shopping cart. We also use localStorage for dark mode preference and first-visit detection. No third-party tracking cookies are used.</p>
    </div></div>

    <div class="card border-0 shadow-sm mb-4"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">5. Your Rights</h5>
        <p>You have the right to:</p>
        <ul>
            <li>Access your personal data through your account profile</li>
            <li>Update or correct your information at any time</li>
            <li>Request deletion of your account by contacting us</li>
            <li>Unsubscribe from marketing emails at any time</li>
        </ul>
    </div></div>

    <div class="card border-0 shadow-sm"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">6. Contact</h5>
        <p>For privacy-related questions, please <a href="{{ route('contact') }}" style="color:var(--veloria-primary);">contact us</a> or email support@veloria.com.</p>
    </div></div>
</div>
@endsection
