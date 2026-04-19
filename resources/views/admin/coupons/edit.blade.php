@extends('layouts.admin')
@section('title', 'Edit Coupon')
@section('page-title', 'Edit Coupon')
@section('content')
<div class="card border-0 shadow-sm" style="max-width:600px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">@csrf @method('PUT') @include('admin.coupons._form', ['coupon' => $coupon])
            <div class="d-flex gap-2 mt-4"><button type="submit" class="btn btn-veloria">Update Coupon</button><a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
        </form>
    </div>
</div>
@endsection
