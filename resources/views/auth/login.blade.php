@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <h4 class="fw-bold text-center mb-1" style="font-family: 'Playfair Display', serif;">Welcome Back</h4>
    <p class="text-muted text-center mb-4 small">Sign in to your Veloria account</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold small">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-envelope" style="color: var(--veloria-secondary);"></i></span>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}"
                       placeholder="you@example.com" required autofocus autocomplete="email">
            </div>
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold small">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-lock" style="color: var(--veloria-secondary);"></i></span>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password"
                       placeholder="Enter your password" required autocomplete="current-password">
                <button class="btn btn-outline-secondary border-start-0" type="button" onclick="togglePassword('password', this)">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="border-color: var(--veloria-primary);">
                <label class="form-check-label small" for="remember">Remember me</label>
            </div>
            <a href="{{ route('password.request') }}" class="small text-decoration-none" style="color: var(--veloria-primary);">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-veloria w-100 py-2 mb-3">
            Sign In <i class="bi bi-arrow-right ms-2"></i>
        </button>

        <p class="text-center text-muted small mb-0">
            New to Veloria? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold" style="color: var(--veloria-primary);">Create Account</a>
        </p>
    </form>

    <script>
        function togglePassword(fieldId, btn) {
            const field = document.getElementById(fieldId);
            const icon = btn.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
@endsection
