@extends('layouts.admin')
@section('title', 'Products')
@section('page-title', 'Products')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
    <form class="d-flex gap-2 flex-wrap" method="GET">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search products..." value="{{ request('search') }}" style="max-width:200px;">
        <select name="status" class="form-select form-select-sm" style="max-width:140px;">
            <option value="">All Status</option>
            <option value="active" {{ request('status')=='active'?'selected':'' }}>Active</option>
            <option value="draft" {{ request('status')=='draft'?'selected':'' }}>Draft</option>
            <option value="inactive" {{ request('status')=='inactive'?'selected':'' }}>Inactive</option>
        </select>
        <button class="btn btn-sm btn-outline-dark"><i class="bi bi-search"></i></button>
    </form>
    <a href="{{ route('admin.products.create') }}" class="btn btn-veloria btn-sm"><i class="bi bi-plus-lg me-1"></i> Add Product</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->primaryImage())
                            <img src="{{ ($product->primaryImageUrl()) }}" class="rounded" style="width:50px;height:50px;object-fit:cover;">
                        @else
                            <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:50px;height:50px;"><i class="bi bi-image text-muted"></i></div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-semibold">{{ Str::limit($product->name, 35) }}</div>
                        <small class="text-muted">SKU: {{ $product->sku ?? 'N/A' }} | {{ $product->variants_count }} variants</small>
                    </td>
                    <td class="small">{{ $product->category->name ?? '—' }}</td>
                    <td>
                        <span class="fw-semibold">&#8377;{{ number_format($product->price, 0) }}</span>
                        @if($product->compare_price)<br><small class="text-muted text-decoration-line-through">&#8377;{{ number_format($product->compare_price,0) }}</small>@endif
                    </td>
                    <td><span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">{{ $product->stock }}</span></td>
                    <td>
                        @php $sc = ['active'=>'success','draft'=>'warning','inactive'=>'secondary']; @endphp
                        <span class="badge bg-{{ $sc[$product->status] ?? 'secondary' }}">{{ ucfirst($product->status) }}</span>
                        @if($product->featured)<br><span class="badge bg-info mt-1">Featured</span>@endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-dark me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No products yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $products->links() }}</div>
@endsection
