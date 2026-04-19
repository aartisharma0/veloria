@extends('layouts.admin')
@section('title', 'Add Product')
@section('page-title', 'Add Product')

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.products._form')
    <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-veloria"><i class="bi bi-check-lg me-1"></i> Create Product</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form>
@endsection
