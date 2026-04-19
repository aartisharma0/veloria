@extends('layouts.admin')
@section('title', 'Enquiries')
@section('page-title', 'Customer Enquiries')

@section('content')
<form class="d-flex gap-2 mb-4" method="GET">
    <select name="status" class="form-select form-select-sm" style="max-width:150px;">
        <option value="">All</option>
        <option value="new" {{ request('status')=='new'?'selected':'' }}>New</option>
        <option value="read" {{ request('status')=='read'?'selected':'' }}>Read</option>
        <option value="replied" {{ request('status')=='replied'?'selected':'' }}>Replied</option>
    </select>
    <button class="btn btn-sm btn-outline-dark"><i class="bi bi-funnel"></i></button>
</form>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light"><tr><th>Name</th><th>Subject</th><th>Email</th><th>Status</th><th>Date</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
                @forelse($enquiries as $e)
                @php $bc = ['new'=>'danger','read'=>'info','replied'=>'success']; @endphp
                <tr class="{{ $e->status==='new' ? 'fw-semibold' : '' }}">
                    <td>{{ $e->name }}</td>
                    <td class="small">{{ Str::limit($e->subject, 30) }}</td>
                    <td class="small">{{ $e->email }}</td>
                    <td><span class="badge bg-{{ $bc[$e->status] ?? 'secondary' }}">{{ ucfirst($e->status) }}</span></td>
                    <td class="small text-muted">{{ $e->created_at->diffForHumans() }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.enquiries.show', $e) }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-eye"></i></a>
                        <form action="{{ route('admin.enquiries.destroy', $e) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">No enquiries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $enquiries->links() }}</div>
@endsection
