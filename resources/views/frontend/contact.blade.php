@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="font-family:'Playfair Display',serif;">Get in Touch</h2>
        <p class="text-muted">Have a question, suggestion, or feedback? We'd love to hear from you.</p>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width:60px;height:60px;background:var(--veloria-pink-soft);">
                        <i class="bi bi-envelope fs-4" style="color:var(--veloria-primary);"></i>
                    </div>
                    <h6 class="fw-bold">Email Us</h6>
                    <p class="text-muted small">support@veloria.com</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width:60px;height:60px;background:var(--veloria-pink-soft);">
                        <i class="bi bi-phone fs-4" style="color:var(--veloria-primary);"></i>
                    </div>
                    <h6 class="fw-bold">Call Us</h6>
                    <p class="text-muted small">+91 98765 43210<br>Mon-Sat, 10AM-7PM</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width:60px;height:60px;background:var(--veloria-pink-soft);">
                        <i class="bi bi-geo-alt fs-4" style="color:var(--veloria-primary);"></i>
                    </div>
                    <h6 class="fw-bold">Visit Us</h6>
                    <p class="text-muted small">123 Fashion Street<br>Mumbai, India 400001</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h5 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">Send us a Message</h5>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Your Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Subject <span class="text-danger">*</span></label>
                                <select name="subject" class="form-select @error('subject') is-invalid @enderror" required>
                                    <option value="">Select a topic</option>
                                    <option value="Order Issue" {{ old('subject')=='Order Issue'?'selected':'' }}>Order Issue</option>
                                    <option value="Product Query" {{ old('subject')=='Product Query'?'selected':'' }}>Product Query</option>
                                    <option value="Return/Exchange" {{ old('subject')=='Return/Exchange'?'selected':'' }}>Return / Exchange</option>
                                    <option value="Payment Issue" {{ old('subject')=='Payment Issue'?'selected':'' }}>Payment Issue</option>
                                    <option value="Feedback" {{ old('subject')=='Feedback'?'selected':'' }}>Feedback</option>
                                    <option value="Other" {{ old('subject')=='Other'?'selected':'' }}>Other</option>
                                </select>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Message <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="5" placeholder="Describe your query in detail..." required>{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-veloria px-4"><i class="bi bi-send me-2"></i>Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
