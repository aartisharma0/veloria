@extends('layouts.admin')
@section('title', 'Enquiry from ' . $enquiry->name)
@section('page-title', 'Enquiry Details')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold">{{ $enquiry->subject }}</h6>
                @php $bc = ['new'=>'danger','read'=>'info','replied'=>'success']; @endphp
                <span class="badge bg-{{ $bc[$enquiry->status] ?? 'secondary' }}">{{ ucfirst($enquiry->status) }}</span>
            </div>
            <div class="card-body">
                <div class="mb-3 p-3 rounded" style="background:var(--veloria-pink-soft);">
                    <p class="mb-0" style="white-space:pre-wrap;">{{ $enquiry->message }}</p>
                </div>
                <small class="text-muted">Received {{ $enquiry->created_at->format('M d, Y \a\t h:i A') }} ({{ $enquiry->created_at->diffForHumans() }})</small>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">Customer Info</h6></div>
            <div class="card-body small">
                <div class="mb-2"><i class="bi bi-person me-2" style="color:var(--veloria-primary);"></i><strong>{{ $enquiry->name }}</strong></div>
                <div class="mb-2"><i class="bi bi-envelope me-2" style="color:var(--veloria-primary);"></i><a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a></div>
                @if($enquiry->phone)<div class="mb-2"><i class="bi bi-phone me-2" style="color:var(--veloria-primary);"></i>{{ $enquiry->phone }}</div>@endif
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">Update Status</h6></div>
            <div class="card-body">
                <form action="{{ route('admin.enquiries.status', $enquiry) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select mb-2">
                        @foreach(['new','read','replied'] as $s)
                            <option value="{{ $s }}" {{ $enquiry->status==$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-veloria btn-sm w-100">Update</button>
                </form>
                <a href="mailto:{{ $enquiry->email }}?subject=Re: {{ urlencode($enquiry->subject) }}" class="btn btn-outline-dark btn-sm w-100 mt-2">
                    <i class="bi bi-reply me-1"></i>Reply via Email
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
