@extends('layouts.admin')
@section('title', 'Subscribers')
@section('page-title', 'Newsletter Subscribers')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
    <div>
        <span class="badge px-3 py-2" style="background: var(--veloria-primary); font-size: 0.85rem;">
            <i class="bi bi-people me-1"></i> {{ $totalCount }} Total Subscribers
        </span>
    </div>
    <div class="d-flex gap-2">
        <form class="d-flex gap-2" method="GET">
            <input type="text" name="search" class="form-control form-control-sm no-select2" placeholder="Search email..." value="{{ request('search') }}" style="max-width:220px;">
            <button class="btn btn-sm btn-outline-dark"><i class="bi bi-search"></i></button>
        </form>
        <a href="{{ route('admin.subscribers.export') }}" class="btn btn-sm btn-outline-success">
            <i class="bi bi-download me-1"></i> Export CSV
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Email Address</th>
                    <th>Subscribed On</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscribers as $sub)
                <tr>
                    <td class="text-muted small">{{ $sub->id }}</td>
                    <td>
                        <i class="bi bi-envelope me-2" style="color: var(--veloria-primary);"></i>
                        <span class="fw-semibold">{{ $sub->email }}</span>
                    </td>
                    <td class="small text-muted">
                        {{ $sub->created_at->format('M d, Y') }}
                        <br>
                        <small>{{ $sub->created_at->diffForHumans() }}</small>
                    </td>
                    <td class="text-end">
                        <form action="{{ route('admin.subscribers.destroy', $sub) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this subscriber?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">
                        <i class="bi bi-envelope fs-3 d-block mb-2"></i>
                        No subscribers yet
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $subscribers->links() }}</div>
@endsection
