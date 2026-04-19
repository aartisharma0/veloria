@extends('layouts.app')
@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="container py-4">
    <div class="row">
        @include('frontend.account._sidebar')
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Order {{ $order->order_number }}</h5>
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{ route('invoice.download', $order) }}" target="_blank" class="btn btn-sm btn-outline-dark"><i class="bi bi-receipt me-1"></i>Invoice</a>
                    @php $sc = ['pending'=>'warning','processing'=>'info','shipped'=>'primary','delivered'=>'success','cancelled'=>'danger']; @endphp
                    <span class="badge bg-{{ $sc[$order->status] ?? 'secondary' }} px-3 py-2">{{ ucfirst($order->status) }}</span>
                </div>
            </div>

            @if($order->tracking_number)
            <div class="alert alert-info small mb-3"><i class="bi bi-truck me-2"></i>Tracking: <strong>{{ $order->tracking_number }}</strong></div>
            @endif

            <div class="card border-0 shadow-sm mb-4">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light"><tr><th>Product</th><th>Price</th><th>Qty</th><th class="text-end">Total</th></tr></thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td class="d-flex align-items-center gap-2">
                                    @if($item->product && $item->product->primaryImage())<img src="{{ ($item->product->primaryImageUrl()) }}" class="rounded" style="width:45px;height:45px;object-fit:cover;">@endif
                                    <div>
                                        <span class="fw-semibold small">{{ $item->product->name ?? 'Product' }}</span>
                                        @if($item->variant)<br><small class="text-muted">{{ $item->variant->size }} / {{ $item->variant->color }}</small>@endif
                                    </div>
                                </td>
                                <td class="small">&#8377;{{ number_format($item->unit_price,0) }}</td>
                                <td>{{ $item->qty }}</td>
                                <td class="text-end fw-semibold">&#8377;{{ number_format($item->total,0) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">
                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <div class="d-flex justify-content-between small mb-1"><span>Subtotal</span><span>&#8377;{{ number_format($order->subtotal,0) }}</span></div>
                            @if($order->discount > 0)<div class="d-flex justify-content-between small mb-1 text-success"><span>Discount</span><span>-&#8377;{{ number_format($order->discount,0) }}</span></div>@endif
                            <div class="d-flex justify-content-between small mb-1"><span>Tax</span><span>&#8377;{{ number_format($order->tax,0) }}</span></div>
                            <div class="d-flex justify-content-between small mb-1"><span>Shipping</span><span>&#8377;{{ number_format($order->shipping_cost,0) }}</span></div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between fw-bold"><span>Total</span><span style="color:var(--veloria-primary);">&#8377;{{ number_format($order->total,0) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                @if($order->shippingAddress)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body small">
                            <h6 class="fw-semibold mb-2">Shipping Address</h6>
                            <strong>{{ $order->shippingAddress->full_name }}</strong><br>
                            {{ $order->shippingAddress->street }}<br>
                            {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->zip }}<br>
                            {{ $order->shippingAddress->country }}
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body small">
                            <h6 class="fw-semibold mb-2">Payment</h6>
                            <div>Method: <strong class="text-uppercase">{{ $order->payment_method }}</strong></div>
                            @if($order->payment)
                                <div>Status: <span class="badge bg-{{ $order->payment->status=='completed'?'success':'warning' }}">{{ ucfirst($order->payment->status) }}</span></div>
                                @if($order->payment->paid_at)<div>Paid: {{ $order->payment->paid_at->format('M d, Y h:i A') }}</div>@endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
