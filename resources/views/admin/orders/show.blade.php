@extends('layouts.admin')
@section('title', 'Order ' . $order->order_number)
@section('page-title', 'Order ' . $order->order_number)

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">Order Items</h6></div>
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light"><tr><th>Product</th><th>Variant</th><th>Price</th><th>Qty</th><th>Total</th></tr></thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td class="d-flex align-items-center gap-2">
                                @if($item->product && $item->product->primaryImage())
                                    <img src="{{ ($item->product->primaryImageUrl()) }}" class="rounded" style="width:40px;height:40px;object-fit:cover;">
                                @endif
                                <span class="small fw-semibold">{{ $item->product->name ?? 'Deleted Product' }}</span>
                            </td>
                            <td class="small">{{ $item->variant ? $item->variant->size . '/' . $item->variant->color : '—' }}</td>
                            <td class="small">&#8377;{{ number_format($item->unit_price,0) }}</td>
                            <td>{{ $item->qty }}</td>
                            <td class="fw-semibold">&#8377;{{ number_format($item->total,0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white">
                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <table class="table table-sm mb-0">
                            <tr><td class="text-muted">Subtotal</td><td class="text-end">&#8377;{{ number_format($order->subtotal,0) }}</td></tr>
                            @if($order->discount > 0)<tr><td class="text-success">Discount</td><td class="text-end text-success">-&#8377;{{ number_format($order->discount,0) }}</td></tr>@endif
                            <tr><td class="text-muted">Tax (GST)</td><td class="text-end">&#8377;{{ number_format($order->tax,0) }}</td></tr>
                            <tr><td class="text-muted">Shipping</td><td class="text-end">&#8377;{{ number_format($order->shipping_cost,0) }}</td></tr>
                            <tr class="fw-bold"><td>Total</td><td class="text-end" style="color:var(--veloria-primary);">&#8377;{{ number_format($order->total,0) }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if($order->shippingAddress)
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">Shipping Address</h6></div>
            <div class="card-body small">
                <strong>{{ $order->shippingAddress->full_name }}</strong><br>
                {{ $order->shippingAddress->street }}<br>
                {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->zip }}<br>
                {{ $order->shippingAddress->country }}
                @if($order->shippingAddress->phone)<br><i class="bi bi-phone"></i> {{ $order->shippingAddress->phone }}@endif
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">Update Status</h6></div>
            <div class="card-body">
                <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <select name="status" class="form-select">
                            @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                                <option value="{{ $s }}" {{ $order->status==$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Tracking Number</label>
                        <input type="text" name="tracking_number" class="form-control form-control-sm" value="{{ $order->tracking_number }}">
                    </div>
                    <button class="btn btn-veloria btn-sm w-100">Update Status</button>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">Customer</h6></div>
            <div class="card-body small">
                <strong>{{ $order->user->name }}</strong><br>{{ $order->user->email }}
                @if($order->user->phone)<br>{{ $order->user->phone }}@endif
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">Payment</h6></div>
            <div class="card-body small">
                <div>Method: <strong class="text-uppercase">{{ $order->payment_method }}</strong></div>
                @if($order->payment)
                    <div>Status: <span class="badge bg-{{ $order->payment->status=='completed'?'success':($order->payment->status=='failed'?'danger':'warning') }}">{{ ucfirst($order->payment->status) }}</span></div>
                    @if($order->payment->transaction_id)<div>Txn: <code>{{ $order->payment->transaction_id }}</code></div>@endif
                    @if($order->payment->paid_at)<div>Paid: {{ $order->payment->paid_at->format('M d, Y h:i A') }}</div>@endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
