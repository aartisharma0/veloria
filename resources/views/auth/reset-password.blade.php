@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
    <h4 class="fw-bold text-center mb-1" style="font-family: 'Playfair Display', serif;">Reset Password</h4>
    <p class="text-muted text-center mb-4 small">Create your new password</p>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

        <div class="mb-3">
            <label class="form-label fw-semibold small">Email</label>
            <input type="email" class="form-control" value="{{ $email ?? old('email') }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold small">New Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Min 8 chars, mixed case, number & symbol">
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold small">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-veloria w-100 py-2 mb-3">
            <i class="bi bi-lock me-2"></i>Reset Password
        </button>
    </form>
@endsection
