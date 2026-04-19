@extends('layouts.app')
@section('title', 'FAQs')

@section('content')
<div class="container py-5" style="max-width:850px;">
    <h2 class="fw-bold mb-2" style="font-family:'Playfair Display',serif;">Frequently Asked Questions</h2>
    <p class="text-muted mb-4">Find quick answers to common questions about Veloria.</p>

    @php
    $faqs = [
        'Orders & Shipping' => [
            ['How long does delivery take?', 'Standard delivery takes 5-7 business days. Express delivery takes 2-3 business days. Metro cities typically receive orders faster.'],
            ['Is free shipping available?', 'Yes! We offer free shipping on all orders above ₹999. Orders below ₹999 have a flat shipping fee of ₹99.'],
            ['Can I track my order?', 'Yes. Once your order is shipped, you\'ll receive a tracking number via email. You can also track it from the My Orders section in your account.'],
            ['Do you deliver internationally?', 'Currently, we only deliver within India. International shipping is coming soon.'],
        ],
        'Returns & Refunds' => [
            ['What is the return policy?', 'We offer a 30-day return policy. Items must be unused, with original tags and packaging intact. Some categories like innerwear and beauty products are non-returnable.'],
            ['How do I initiate a return?', 'Login to your account, go to My Orders, select the order, and click Request Return. Our courier partner will pick up the item from your address.'],
            ['When will I receive my refund?', 'Refunds are processed within 5-7 business days after we receive and inspect the returned item. Card refunds may take an additional 2-3 days to reflect.'],
        ],
        'Payment' => [
            ['What payment methods do you accept?', 'We accept Credit Cards, Debit Cards (via Stripe), and Cash on Delivery (COD). UPI and Net Banking support coming soon.'],
            ['Is my payment information secure?', 'Absolutely. All payments are processed through Stripe, a PCI-DSS Level 1 certified payment processor. We never store your card details on our servers.'],
            ['Can I pay via Cash on Delivery?', 'Yes, COD is available for orders up to ₹10,000. You can select COD as your payment method during checkout.'],
        ],
        'Account & General' => [
            ['How do I create an account?', 'Click Register in the top menu and fill in your details. You\'ll need a strong password with uppercase, lowercase, number, and symbol.'],
            ['I forgot my password. What do I do?', 'Click Forgot Password on the login page. You\'ll receive a link to reset your password via email.'],
            ['How can I contact customer support?', 'You can reach us through our Contact Us page, email us at support@veloria.com, or call +91 98765 43210 (Mon-Sat, 10AM-7PM).'],
            ['Do you offer discounts for first-time buyers?', 'Yes! Use code WELCOME20 for 20% off your first order (min. order ₹500). We also have regular promotions and seasonal sales.'],
        ],
    ];
    @endphp

    @foreach($faqs as $section => $questions)
    <h5 class="fw-bold mt-4 mb-3"><i class="bi bi-chat-square-text me-2" style="color:var(--veloria-primary);"></i>{{ $section }}</h5>
    <div class="accordion mb-3" id="faq{{ Str::slug($section) }}">
        @foreach($questions as $i => $qa)
        <div class="accordion-item border-0 shadow-sm mb-2 rounded overflow-hidden">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-semibold small" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ Str::slug($section) . $i }}">
                    {{ $qa[0] }}
                </button>
            </h2>
            <div id="faq{{ Str::slug($section) . $i }}" class="accordion-collapse collapse" data-bs-parent="#faq{{ Str::slug($section) }}">
                <div class="accordion-body small text-muted">{{ $qa[1] }}</div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach

    <div class="text-center mt-5 p-4 rounded" style="background:var(--veloria-pink-soft);">
        <h5 class="fw-bold">Still have questions?</h5>
        <p class="text-muted mb-3">Our support team is here to help.</p>
        <a href="{{ route('contact') }}" class="btn btn-veloria"><i class="bi bi-chat-dots me-2"></i>Contact Us</a>
    </div>
</div>
@endsection
