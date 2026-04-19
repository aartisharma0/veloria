@extends('layouts.admin')
@section('title', 'Reviews')
@section('page-title', 'Reviews')

@section('content')
<form class="d-flex gap-2 mb-4" method="GET">
    <select name="status" class="form-select form-select-sm" style="max-width:160px;">
        <option value="">All Reviews</option>
        <option value="approved" {{ request('status')=='approved'?'selected':'' }}>Approved</option>
        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
    </select>
    <button class="btn btn-sm btn-outline-dark"><i class="bi bi-funnel"></i></button>
</form>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light"><tr><th>Customer</th><th>Product</th><th>Rating</th><th>Review</th><th>Status</th><th>Date</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
                @forelse($reviews as $r)
                <tr>
                    <td class="small fw-semibold">{{ $r->user->name ?? 'Deleted' }}</td>
                    <td class="small">{{ Str::limit($r->product->name ?? 'Deleted', 25) }}</td>
                    <td>
                        @for($i=1;$i<=5;$i++)<i class="bi bi-star{{ $i<=$r->rating?'-fill':'' }} text-warning" style="font-size:0.8rem;"></i>@endfor
                    </td>
                    <td class="small">{{ Str::limit($r->body, 50) }}</td>
                    <td><span class="badge {{ $r->approved ? 'bg-success' : 'bg-warning' }}">{{ $r->approved ? 'Approved' : 'Pending' }}</span></td>
                    <td class="small text-muted">{{ $r->created_at->format('M d, Y') }}</td>
                    <td class="text-end">
                        <form action="{{ route('admin.reviews.toggle', $r) }}" method="POST" class="d-inline">@csrf @method('PATCH')
                            <button class="btn btn-sm {{ $r->approved ? 'btn-outline-warning' : 'btn-outline-success' }}">{{ $r->approved ? 'Unapprove' : 'Approve' }}</button>
                        </form>
                        <form action="{{ route('admin.reviews.destroy', $r) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No reviews yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $reviews->links() }}</div>
@endsection
