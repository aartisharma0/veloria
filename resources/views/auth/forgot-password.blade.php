@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('content')
    <h4 class="fw-bold text-center mb-1" style="font-family: 'Playfair Display', serif;">Forgot Password?</h4>
    <p class="text-muted text-center mb-4 small">Enter your email and we'll send you a reset link</p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold small">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-envelope" style="color: var(--veloria-secondary);"></i></span>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
            </div>
            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-veloria w-100 py-2 mb-3">
            <i class="bi bi-envelope me-2"></i>Send Reset Link
        </button>

        <p class="text-center text-muted small mb-0">
            Remember your password? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold" style="color: var(--veloria-primary);">Sign In</a>
        </p>
    </form>
@endsection
