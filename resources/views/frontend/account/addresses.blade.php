@extends('layouts.app')
@section('title', 'My Addresses')

@section('content')
<div class="container py-4">
    <div class="row">
        @include('frontend.account._sidebar')
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">My Addresses</h5>
                <button class="btn btn-veloria btn-sm" data-bs-toggle="modal" data-bs-target="#addAddressModal"><i class="bi bi-plus me-1"></i> Add Address</button>
            </div>

            <div class="row g-3">
                @forelse($addresses as $addr)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 {{ $addr->is_default ? 'border-2' : '' }}" style="{{ $addr->is_default ? 'border-color:var(--veloria-primary) !important;' : '' }}">
                        <div class="card-body small">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-light text-dark text-uppercase">{{ $addr->type }}</span>
                                @if($addr->is_default)<span class="badge" style="background:var(--veloria-primary);color:white;">Default</span>@endif
                            </div>
                            <strong>{{ $addr->full_name }}</strong><br>
                            {{ $addr->street }}<br>
                            {{ $addr->city }}, {{ $addr->state }} {{ $addr->zip }}<br>
                            {{ $addr->country }}
                            @if($addr->phone)<br><i class="bi bi-phone"></i> {{ $addr->phone }}@endif
                            <div class="mt-3 d-flex gap-2">
                                <button class="btn btn-sm" style="border:1.5px solid var(--veloria-primary);color:var(--veloria-primary);" data-bs-toggle="modal" data-bs-target="#editAddr{{ $addr->id }}"><i class="bi bi-pencil me-1"></i>Edit</button>
                                <form action="{{ route('account.addresses.destroy', $addr) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this address?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-geo-alt fs-1" style="color:var(--veloria-primary-light);"></i>
                    <h5 class="mt-3">No addresses saved</h5>
                    <p class="text-muted">Add a shipping address to speed up checkout.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Edit Address Modals (outside card to prevent overflow issues) --}}
@foreach($addresses as $addr)
<div class="modal fade" id="editAddr{{ $addr->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('account.addresses.update', $addr) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-header"><h6 class="modal-title fw-semibold">Edit Address</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <select name="type" class="form-select no-select2">
                            <option value="shipping" {{ $addr->type=='shipping'?'selected':'' }}>Shipping</option>
                            <option value="billing" {{ $addr->type=='billing'?'selected':'' }}>Billing</option>
                        </select>
                    </div>
                    <div class="mb-3"><input type="text" name="full_name" class="form-control" placeholder="Full Name" value="{{ $addr->full_name }}" required></div>
                    <div class="mb-3"><input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $addr->phone }}"></div>
                    <div class="mb-3"><textarea name="street" class="form-control" placeholder="Street Address" rows="2" required>{{ $addr->street }}</textarea></div>
                    <div class="row g-2">
                        <div class="col-6 mb-3"><input type="text" name="city" class="form-control" placeholder="City" value="{{ $addr->city }}" required></div>
                        <div class="col-6 mb-3"><input type="text" name="state" class="form-control" placeholder="State" value="{{ $addr->state }}" required></div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6 mb-3"><input type="text" name="zip" class="form-control" placeholder="PIN Code" value="{{ $addr->zip }}" required></div>
                        <div class="col-6 mb-3"><input type="text" name="country" class="form-control" placeholder="Country" value="{{ $addr->country }}" required></div>
                    </div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="is_default" value="1" {{ $addr->is_default?'checked':'' }}><label class="form-check-label small">Set as default</label></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-veloria">Update Address</button></div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- Add Address Modal --}}
<div class="modal fade" id="addAddressModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('account.addresses.store') }}" method="POST">@csrf
                <div class="modal-header"><h6 class="modal-title fw-semibold">Add Address</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><select name="type" class="form-select no-select2"><option value="shipping">Shipping</option><option value="billing">Billing</option></select></div>
                    <div class="mb-3"><input type="text" name="full_name" class="form-control" placeholder="Full Name" required></div>
                    <div class="mb-3"><input type="text" name="phone" class="form-control" placeholder="Phone"></div>
                    <div class="mb-3"><textarea name="street" class="form-control" placeholder="Street Address" rows="2" required></textarea></div>
                    <div class="row g-2">
                        <div class="col-6 mb-3"><input type="text" name="city" class="form-control" placeholder="City" required></div>
                        <div class="col-6 mb-3"><input type="text" name="state" class="form-control" placeholder="State" required></div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6 mb-3"><input type="text" name="zip" class="form-control" placeholder="PIN Code" required></div>
                        <div class="col-6 mb-3"><input type="text" name="country" class="form-control" value="India" required></div>
                    </div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="is_default" value="1"><label class="form-check-label small">Set as default</label></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-veloria">Save Address</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
