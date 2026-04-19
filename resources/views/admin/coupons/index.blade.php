@extends('layouts.admin')
@section('title', 'Coupons')
@section('page-title', 'Coupons')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <p class="text-muted mb-0">{{ $coupons->total() }} coupons</p>
    <a href="{{ route('admin.coupons.create') }}" class="btn btn-veloria btn-sm"><i class="bi bi-plus-lg me-1"></i> Add Coupon</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light"><tr><th>Code</th><th>Type</th><th>Value</th><th>Min Order</th><th>Uses Left</th><th>Expires</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
                @forelse($coupons as $c)
                <tr>
                    <td><code class="fw-bold">{{ $c->code }}</code></td>
                    <td class="text-uppercase small">{{ $c->type }}</td>
                    <td class="fw-semibold">{{ $c->type=='percent' ? $c->value.'%' : '₹'.$c->value }}</td>
                    <td class="small">{{ $c->min_order ? '₹'.number_format($c->min_order,0) : '—' }}</td>
                    <td>{{ $c->uses_left ?? '∞' }}</td>
                    <td class="small">{{ $c->expires_at ? $c->expires_at->format('M d, Y') : 'Never' }}</td>
                    <td><span class="badge {{ $c->isValid() ? 'bg-success' : 'bg-secondary' }}">{{ $c->isValid() ? 'Active' : 'Expired' }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('admin.coupons.edit', $c) }}" class="btn btn-sm btn-outline-dark me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.coupons.destroy', $c) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-4 text-muted">No coupons yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $coupons->links() }}</div>
@endsection
