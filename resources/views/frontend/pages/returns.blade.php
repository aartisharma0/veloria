@extends('layouts.app')
@section('title', 'Returns & Exchanges')

@section('content')
<div class="container py-5" style="max-width:850px;">
    <h2 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">Returns & Exchanges</h2>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-arrow-return-left me-2" style="color:var(--veloria-primary);"></i>30-Day Return Policy</h5>
            <p>We want you to love every piece you buy from Veloria. If you're not completely satisfied, you can return or exchange your item within <strong>30 days</strong> of delivery.</p>
            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <div class="p-3 rounded" style="background:var(--veloria-pink-soft);">
                        <h6 class="fw-bold text-success"><i class="bi bi-check-circle me-1"></i> Eligible for Return</h6>
                        <ul class="small mb-0">
                            <li>Unused items with original tags</li>
                            <li>Items in original packaging</li>
                            <li>Wrong size or color received</li>
                            <li>Defective or damaged products</li>
                            <li>Product doesn't match description</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded bg-light">
                        <h6 class="fw-bold text-danger"><i class="bi bi-x-circle me-1"></i> Not Eligible</h6>
                        <ul class="small mb-0">
                            <li>Used, washed, or altered items</li>
                            <li>Innerwear and lingerie</li>
                            <li>Beauty products (opened/used)</li>
                            <li>Jewellery and accessories (hygiene reasons)</li>
                            <li>Items purchased during clearance sales</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-arrow-repeat me-2" style="color:var(--veloria-primary);"></i>How to Return</h5>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:40px;height:40px;background:var(--veloria-primary);color:white;font-weight:bold;">1</div>
                    <div><strong>Initiate Return</strong><br><small class="text-muted">Go to My Orders, select the order, and click "Request Return"</small></div>
                </div>
                <div class="d-flex gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:40px;height:40px;background:var(--veloria-primary);color:white;font-weight:bold;">2</div>
                    <div><strong>Pack the Item</strong><br><small class="text-muted">Pack the item in its original packaging with all tags attached</small></div>
                </div>
                <div class="d-flex gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:40px;height:40px;background:var(--veloria-primary);color:white;font-weight:bold;">3</div>
                    <div><strong>Pickup / Drop-off</strong><br><small class="text-muted">Our courier partner will pick it up, or you can drop it at the nearest center</small></div>
                </div>
                <div class="d-flex gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:40px;height:40px;background:var(--veloria-primary);color:white;font-weight:bold;">4</div>
                    <div><strong>Refund</strong><br><small class="text-muted">Refund processed within 5-7 business days after we receive the item</small></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-currency-rupee me-2" style="color:var(--veloria-primary);"></i>Refund Policy</h5>
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-light"><tr><th>Payment Method</th><th>Refund Method</th><th>Timeline</th></tr></thead>
                    <tbody>
                        <tr><td>Credit/Debit Card</td><td>Original card</td><td>5-7 business days</td></tr>
                        <tr><td>UPI / Net Banking</td><td>Original account</td><td>3-5 business days</td></tr>
                        <tr><td>Cash on Delivery</td><td>Bank transfer / Veloria credit</td><td>7-10 business days</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <p class="text-muted">Need help with a return? <a href="{{ route('contact') }}" style="color:var(--veloria-primary);">Contact our support team</a></p>
    </div>
</div>
@endsection
