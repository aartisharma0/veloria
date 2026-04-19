@extends('layouts.auth')

@section('title', 'Create Account')

@section('content')
    <h4 class="fw-bold text-center mb-1" style="font-family: 'Playfair Display', serif;">Join Veloria</h4>
    <p class="text-muted text-center mb-4 small">Create your account and start your style journey</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold small">Full Name</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-person" style="color: var(--veloria-secondary);"></i></span>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       id="name" name="name" value="{{ old('name') }}"
                       placeholder="Your full name" required autofocus autocomplete="name">
            </div>
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold small">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-envelope" style="color: var(--veloria-secondary);"></i></span>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}"
                       placeholder="you@example.com" required autocomplete="email">
            </div>
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label fw-semibold small">Phone <span class="text-muted fw-normal">(optional)</span></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-phone" style="color: var(--veloria-secondary);"></i></span>
                <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                       id="phone" name="phone" value="{{ old('phone') }}"
                       placeholder="Your phone number" autocomplete="off">
            </div>
            @error('phone')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold small">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-lock" style="color: var(--veloria-secondary);"></i></span>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password"
                       placeholder="Create a strong password" required autocomplete="new-password">
                <button class="btn btn-outline-secondary border-start-0" type="button" onclick="togglePassword('password', this)">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <div class="form-text small" style="font-size: 0.72rem;">Min 8 characters with uppercase, lowercase, number & symbol.</div>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-semibold small">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-lock-fill" style="color: var(--veloria-secondary);"></i></span>
                <input type="password" class="form-control"
                       id="password_confirmation" name="password_confirmation"
                       placeholder="Re-enter your password" required autocomplete="new-password">
            </div>
        </div>

        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" value="1" {{ old('terms') ? 'checked' : '' }} style="border-color: var(--veloria-primary);">
                <label class="form-check-label small" for="terms">
                    I agree to the <a href="{{ route('pages.terms') }}" target="_blank" class="text-decoration-none" style="color: var(--veloria-primary);">Terms</a> & <a href="{{ route('pages.privacy') }}" target="_blank" class="text-decoration-none" style="color: var(--veloria-primary);">Privacy Policy</a>
                </label>
            </div>
            @error('terms')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-veloria w-100 py-2 mb-3">
            Create Account <i class="bi bi-arrow-right ms-2"></i>
        </button>

        <p class="text-center text-muted small mb-0">
            Already have an account? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold" style="color: var(--veloria-primary);">Sign In</a>
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
