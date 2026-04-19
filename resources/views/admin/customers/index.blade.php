@extends('layouts.admin')
@section('title', 'Customers')
@section('page-title', 'Customers')

@section('content')
<form class="d-flex gap-2 mb-4" method="GET">
    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name or email..." value="{{ request('search') }}" style="max-width:250px;">
    <button class="btn btn-sm btn-outline-dark"><i class="bi bi-search"></i></button>
</form>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light"><tr><th>Name</th><th>Email</th><th>Phone</th><th>Orders</th><th>Status</th><th>Joined</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
                @forelse($customers as $c)
                <tr>
                    <td class="fw-semibold">{{ $c->name }}</td>
                    <td class="small">{{ $c->email }}</td>
                    <td class="small">{{ $c->phone ?? '—' }}</td>
                    <td><span class="badge bg-light text-dark">{{ $c->orders_count }}</span></td>
                    <td><span class="badge {{ $c->is_active ? 'bg-success' : 'bg-danger' }}">{{ $c->is_active ? 'Active' : 'Blocked' }}</span></td>
                    <td class="small text-muted">{{ $c->created_at->format('M d, Y') }}</td>
                    <td class="text-end">
                        <form action="{{ route('admin.customers.toggle', $c) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm {{ $c->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                {{ $c->is_active ? 'Block' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No customers yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $customers->links() }}</div>
@endsection
