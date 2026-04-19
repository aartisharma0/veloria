@extends('layouts.admin')
@section('title', 'Categories')
@section('page-title', 'Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">{{ $categories->total() }} categories found</p>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-veloria btn-sm"><i class="bi bi-plus-lg me-1"></i> Add Category</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Image</th><th>Name</th><th>Parent</th><th>Products</th><th>Status</th><th>Order</th><th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td>
                        @if($cat->image)
                            <img src="{{ Storage::url($cat->image) }}" alt="" class="rounded" style="width:45px;height:45px;object-fit:cover;">
                        @else
                            <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:45px;height:45px;"><i class="bi bi-image text-muted"></i></div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $cat->name }}<br><small class="text-muted">{{ $cat->slug }}</small></td>
                    <td><span class="text-muted">{{ $cat->parent->name ?? '—' }}</span></td>
                    <td><span class="badge bg-light text-dark">{{ $cat->products_count }}</span></td>
                    <td>
                        <span class="badge {{ $cat->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $cat->is_active ? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td>{{ $cat->sort_order }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-outline-dark me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No categories yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $categories->links() }}</div>
@endsection
