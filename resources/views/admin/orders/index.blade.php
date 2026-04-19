@extends('layouts.admin')
@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')
<form class="d-flex gap-2 flex-wrap mb-4" method="GET">
    <input type="text" name="search" class="form-control form-control-sm" placeholder="Order # or customer..." value="{{ request('search') }}" style="max-width:220px;">
    <select name="status" class="form-select form-select-sm" style="max-width:150px;">
        <option value="">All Status</option>
        @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
            <option value="{{ $s }}" {{ request('status')==$s?'selected':'' }}>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <button class="btn btn-sm btn-outline-dark"><i class="bi bi-search"></i></button>
</form>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr><th>Order #</th><th>Customer</th><th>Items</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                @php $sc = ['pending'=>'warning','processing'=>'info','shipped'=>'primary','delivered'=>'success','cancelled'=>'danger']; @endphp
                <tr>
                    <td class="fw-semibold small">{{ $order->order_number }}</td>
                    <td class="small">{{ $order->user->name ?? 'N/A' }}<br><small class="text-muted">{{ $order->user->email ?? '' }}</small></td>
                    <td><span class="badge bg-light text-dark">{{ $order->items->count() }}</span></td>
                    <td class="fw-semibold">&#8377;{{ number_format($order->total,0) }}</td>
                    <td class="small text-uppercase">{{ $order->payment_method }}</td>
                    <td><span class="badge bg-{{ $sc[$order->status] ?? 'secondary' }}">{{ ucfirst($order->status) }}</span></td>
                    <td class="small text-muted">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="text-end"><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-eye"></i></a></td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-4 text-muted">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $orders->links() }}</div>
@endsection
