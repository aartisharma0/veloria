@extends('layouts.app')
@section('title', 'My Orders')

@section('content')
<div class="container py-4">
    <div class="row">
        @include('frontend.account._sidebar')
        <div class="col-lg-9">
            <h5 class="fw-bold mb-3">My Orders</h5>
            @forelse($orders as $order)
            @php $sc = ['pending'=>'warning','processing'=>'info','shipped'=>'primary','delivered'=>'success','cancelled'=>'danger']; @endphp
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-2">
                        <div>
                            <span class="fw-semibold">{{ $order->order_number }}</span>
                            <span class="badge bg-{{ $sc[$order->status] ?? 'secondary' }} ms-2">{{ ucfirst($order->status) }}</span>
                        </div>
                        <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mb-2">
                        @foreach($order->items->take(3) as $item)
                        <div class="d-flex align-items-center gap-2 bg-light rounded p-2">
                            @if($item->product && $item->product->primaryImage())
                                <img src="{{ ($item->product->primaryImageUrl()) }}" class="rounded" style="width:35px;height:35px;object-fit:cover;">
                            @endif
                            <small>{{ Str::limit($item->product->name ?? 'Product',20) }} x{{ $item->qty }}</small>
                        </div>
                        @endforeach
                        @if($order->items->count() > 3)<small class="text-muted align-self-center">+{{ $order->items->count()-3 }} more</small>@endif
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold" style="color:var(--veloria-primary);">&#8377;{{ number_format($order->total,0) }}</span>
                        <a href="{{ route('account.orders.show', $order->id) }}" class="btn btn-sm btn-outline-dark">View Details</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="bi bi-bag fs-1" style="color:var(--veloria-primary-light);"></i>
                <h5 class="mt-3">No orders yet</h5>
                <a href="{{ route('products.index') }}" class="btn btn-veloria mt-2">Start Shopping</a>
            </div>
            @endforelse
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
