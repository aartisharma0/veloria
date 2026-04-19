@extends('layouts.app')
@section('title', 'Order Confirmed')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 text-center">
            <div class="mb-4">
                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;background:rgba(40,167,69,0.1);">
                    <i class="bi bi-check-lg fs-1 text-success"></i>
                </div>
                <h3 class="fw-bold" style="font-family:'Playfair Display',serif;">Order Confirmed!</h3>
                <p class="text-muted">Thank you for shopping with Veloria</p>
            </div>

            <div class="card border-0 shadow-sm text-start mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div><small class="text-muted">Order Number</small><br><strong>{{ $order->order_number }}</strong></div>
                        <div class="text-end"><small class="text-muted">Date</small><br><strong>{{ $order->created_at->format('M d, Y') }}</strong></div>
                    </div>
                    <hr>
                    @foreach($order->items as $item)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div><small class="fw-semibold">{{ $item->product->name ?? 'Product' }}</small><br><small class="text-muted">Qty: {{ $item->qty }}</small></div>
                        <small class="fw-semibold">&#8377;{{ number_format($item->total,0) }}</small>
                    </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between fw-bold"><span>Total Paid</span><span style="color:var(--veloria-primary);">&#8377;{{ number_format($order->total,0) }}</span></div>

                    @if($order->shippingAddress)
                    <hr>
                    <small class="text-muted">Delivering to:</small>
                    <p class="small mb-0">{{ $order->shippingAddress->full_name }}, {{ $order->shippingAddress->street }}, {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->zip }}</p>
                    @endif
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-center flex-wrap">
                <a href="{{ route('invoice.download', $order) }}" target="_blank" class="btn btn-outline-dark"><i class="bi bi-receipt me-1"></i>Download Invoice</a>
                <a href="{{ route('account.orders') }}" class="btn btn-veloria">View My Orders</a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Continue Shopping</a>
            </div>
        </div>
    </div>
</div>
@endsection
