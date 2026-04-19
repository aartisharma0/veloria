@extends('layouts.app')
@section('title', 'Shipping & Delivery')

@section('content')
<div class="container py-5" style="max-width:850px;">
    <h2 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">Shipping & Delivery</h2>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-truck me-2" style="color:var(--veloria-primary);"></i>Delivery Options</h5>
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-light"><tr><th>Shipping Method</th><th>Delivery Time</th><th>Cost</th></tr></thead>
                    <tbody>
                        <tr><td>Standard Delivery</td><td>5-7 business days</td><td>&#8377;99</td></tr>
                        <tr><td>Express Delivery</td><td>2-3 business days</td><td>&#8377;199</td></tr>
                        <tr><td class="fw-semibold">Free Shipping</td><td>5-7 business days</td><td class="fw-semibold text-success">FREE (orders above &#8377;999)</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2" style="color:var(--veloria-primary);"></i>Where We Deliver</h5>
            <p>We currently deliver across <strong>all major cities and towns in India</strong>. We cover 25,000+ PIN codes across the country.</p>
            <ul>
                <li>Metro cities (Delhi, Mumbai, Bangalore, Chennai, Kolkata, Hyderabad) — fastest delivery</li>
                <li>Tier 2 cities — 5-7 business days</li>
                <li>Remote areas — 7-10 business days</li>
            </ul>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-box-seam me-2" style="color:var(--veloria-primary);"></i>Order Tracking</h5>
            <p>Once your order is shipped, you'll receive a <strong>tracking number via email</strong>. You can also track your order from:</p>
            <ol>
                <li>Login to your account</li>
                <li>Go to <strong>My Orders</strong></li>
                <li>Click on the order to see tracking details</li>
            </ol>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-info-circle me-2" style="color:var(--veloria-primary);"></i>Important Notes</h5>
            <ul class="mb-0">
                <li>Orders placed before <strong>2:00 PM</strong> are dispatched the same day</li>
                <li>Delivery times are estimates and may vary during sale periods or holidays</li>
                <li>Someone must be available at the delivery address to receive the package</li>
                <li>Cash on Delivery (COD) is available for orders up to &#8377;10,000</li>
            </ul>
        </div>
    </div>

    <div class="text-center mt-4">
        <p class="text-muted">Have questions about shipping? <a href="{{ route('contact') }}" style="color:var(--veloria-primary);">Contact us</a></p>
    </div>
</div>
@endsection
