@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    {{-- Welcome --}}
    <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, var(--veloria-dark), #555); color: white;">
        <div class="card-body py-4 px-4">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                <div>
                    <h4 class="fw-bold mb-1 fs-5 fs-md-4" style="font-family: 'Playfair Display', serif;">Welcome back, {{ Auth::user()->name }}!</h4>
                    <p class="mb-0 opacity-75 small">Here's what's happening with your store today.</p>
                </div>
                <span class="badge px-3 py-2 align-self-start" style="background: var(--veloria-primary); font-size: 0.75rem;">
                    <i class="bi bi-calendar3 me-1"></i> {{ now()->format('M d, Y') }}
                </span>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
            <div class="card border-0 shadow-sm stat-card stat-revenue">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Revenue</p>
                            <h4 class="fw-bold mb-0">&#8377;{{ number_format($stats['revenue'], 0) }}</h4>
                        </div>
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="bi bi-currency-rupee fs-4 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
            <div class="card border-0 shadow-sm stat-card stat-orders">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Orders</p>
                            <h4 class="fw-bold mb-0">{{ $stats['total_orders'] }}</h4>
                        </div>
                        <div class="rounded-circle p-3" style="background: rgba(214,51,132,0.1);">
                            <i class="bi bi-bag-check fs-4" style="color: var(--veloria-primary);"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
            <div class="card border-0 shadow-sm stat-card stat-products">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Products</p>
                            <h4 class="fw-bold mb-0">{{ $stats['total_products'] }}</h4>
                        </div>
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="bi bi-handbag fs-4 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
            <div class="card border-0 shadow-sm stat-card stat-customers">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Customers</p>
                            <h4 class="fw-bold mb-0">{{ $stats['total_users'] }}</h4>
                        </div>
                        <div class="rounded-circle bg-info bg-opacity-10 p-3">
                            <i class="bi bi-people fs-4 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Recent Orders --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h6 class="fw-semibold mb-0">Recent Orders</h6>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm" style="border: 1.5px solid var(--veloria-primary); color: var(--veloria-primary); border-radius: 20px; font-size: 0.75rem;">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="small fw-semibold">Order #</th>
                                    <th class="small fw-semibold">Customer</th>
                                    <th class="small fw-semibold">Total</th>
                                    <th class="small fw-semibold">Status</th>
                                    <th class="small fw-semibold">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                    <tr>
                                        <td class="small fw-semibold">{{ $order->order_number }}</td>
                                        <td class="small">{{ $order->user->name ?? 'N/A' }}</td>
                                        <td class="small fw-semibold">&#8377;{{ number_format($order->total, 0) }}</td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'warning',
                                                    'processing' => 'info',
                                                    'shipped' => 'primary',
                                                    'delivered' => 'success',
                                                    'cancelled' => 'danger',
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}" style="font-size: 0.7rem;">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="small text-muted">{{ $order->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                            No orders yet
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-semibold mb-0">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm text-start py-2" style="border: 1.5px solid #e0e0e0; border-radius: 8px;">
                            <i class="bi bi-plus-circle me-2" style="color: var(--veloria-primary);"></i> Add New Product
                        </a>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-sm text-start py-2" style="border: 1.5px solid #e0e0e0; border-radius: 8px;">
                            <i class="bi bi-folder-plus me-2 text-success"></i> Add Category
                        </a>
                        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="btn btn-sm text-start py-2" style="border: 1.5px solid #e0e0e0; border-radius: 8px;">
                            <i class="bi bi-bag-check me-2 text-info"></i> Pending Orders
                            @if($stats['pending_orders'] > 0)
                                <span class="badge rounded-pill float-end" style="background: var(--veloria-primary); font-size: 0.7rem;">{{ $stats['pending_orders'] }}</span>
                            @endif
                        </a>
                        <a href="{{ route('admin.coupons.create') }}" class="btn btn-sm text-start py-2" style="border: 1.5px solid #e0e0e0; border-radius: 8px;">
                            <i class="bi bi-ticket-perforated me-2 text-warning"></i> Create Coupon
                        </a>
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm text-start py-2" style="border: 1.5px solid #e0e0e0; border-radius: 8px;">
                            <i class="bi bi-star me-2" style="color: var(--veloria-primary);"></i> Manage Reviews
                        </a>
                    </div>
                </div>
            </div>

            {{-- Store Info --}}
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-semibold mb-0">Store Status</h6>
                </div>
                <div class="card-body">
                    @if($stats['pending_orders'] > 0)
                        <div class="alert py-2 small mb-2 border-0" style="background: rgba(214,51,132,0.08); color: var(--veloria-primary-dark);">
                            <i class="bi bi-exclamation-circle me-1"></i>
                            {{ $stats['pending_orders'] }} pending order(s) need attention
                        </div>
                    @endif
                    <div class="alert py-2 small mb-0 border-0" style="background: #f0f0f0; color: var(--veloria-grey);">
                        <i class="bi bi-gem me-1" style="color: var(--veloria-primary);"></i>
                        Veloria Admin Panel is ready
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
