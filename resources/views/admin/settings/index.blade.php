@extends('layouts.admin')
@section('title', 'Settings')
@section('page-title', 'Store Settings')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            {{-- General --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white"><h6 class="mb-0 fw-semibold"><i class="bi bi-shop me-2" style="color:var(--veloria-primary);"></i>General</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Store Name</label>
                            <input type="text" name="store_name" class="form-control" value="{{ $settings['store_name'] }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Tagline</label>
                            <input type="text" name="tagline" class="form-control" value="{{ $settings['tagline'] }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Store Email</label>
                            <input type="email" name="store_email" class="form-control" value="{{ $settings['store_email'] }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Store Phone</label>
                            <input type="text" name="store_phone" class="form-control" value="{{ $settings['store_phone'] }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Store Address</label>
                            <textarea name="store_address" class="form-control" rows="2">{{ $settings['store_address'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pricing & Tax --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white"><h6 class="mb-0 fw-semibold"><i class="bi bi-currency-rupee me-2" style="color:var(--veloria-primary);"></i>Pricing & Shipping</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Currency</label>
                            <input type="text" name="currency" class="form-control" value="{{ $settings['currency'] }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Currency Symbol</label>
                            <input type="text" name="currency_symbol" class="form-control" value="{{ $settings['currency_symbol'] }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Tax Rate (%)</label>
                            <input type="number" name="tax_rate" class="form-control" value="{{ $settings['tax_rate'] }}" step="0.01" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Free Shipping Min ({{ $settings['currency_symbol'] }})</label>
                            <input type="number" name="free_shipping_min" class="form-control" value="{{ $settings['free_shipping_min'] }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Shipping Fee ({{ $settings['currency_symbol'] }})</label>
                            <input type="number" name="shipping_fee" class="form-control" value="{{ $settings['shipping_fee'] }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">COD Max Amount ({{ $settings['currency_symbol'] }})</label>
                            <input type="number" name="cod_max_amount" class="form-control" value="{{ $settings['cod_max_amount'] }}" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Media --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white"><h6 class="mb-0 fw-semibold"><i class="bi bi-share me-2" style="color:var(--veloria-primary);"></i>Social Media Links</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold"><i class="bi bi-facebook me-1"></i>Facebook</label>
                            <input type="url" name="facebook_url" class="form-control" value="{{ $settings['facebook_url'] }}" placeholder="https://facebook.com/veloria">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold"><i class="bi bi-instagram me-1"></i>Instagram</label>
                            <input type="url" name="instagram_url" class="form-control" value="{{ $settings['instagram_url'] }}" placeholder="https://instagram.com/veloria">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold"><i class="bi bi-twitter-x me-1"></i>Twitter/X</label>
                            <input type="url" name="twitter_url" class="form-control" value="{{ $settings['twitter_url'] }}" placeholder="https://x.com/veloria">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold"><i class="bi bi-youtube me-1"></i>YouTube</label>
                            <input type="url" name="youtube_url" class="form-control" value="{{ $settings['youtube_url'] }}" placeholder="https://youtube.com/veloria">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold"><i class="bi bi-pinterest me-1"></i>Pinterest</label>
                            <input type="url" name="pinterest_url" class="form-control" value="{{ $settings['pinterest_url'] }}" placeholder="https://pinterest.com/veloria">
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEO --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white"><h6 class="mb-0 fw-semibold"><i class="bi bi-search me-2" style="color:var(--veloria-primary);"></i>SEO</h6></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ $settings['meta_title'] }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3">{{ $settings['meta_description'] }}</textarea>
                        <small class="text-muted">Recommended: 150-160 characters</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            {{-- Actions --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <button type="submit" class="btn btn-veloria w-100 mb-3"><i class="bi bi-check-lg me-2"></i>Save Settings</button>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="maintenance_mode" id="maintenance" {{ $settings['maintenance_mode'] ? 'checked' : '' }}>
                        <label class="form-check-label small" for="maintenance">Maintenance Mode</label>
                    </div>
                    <small class="text-muted">When enabled, only admins can access the store.</small>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">System Info</h6></div>
                <div class="card-body small">
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Laravel</span><span class="fw-semibold">{{ app()->version() }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">PHP</span><span class="fw-semibold">{{ PHP_VERSION }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Environment</span><span class="badge bg-{{ app()->environment('production') ? 'success' : 'warning' }}">{{ app()->environment() }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Debug Mode</span><span class="badge bg-{{ config('app.debug') ? 'danger' : 'success' }}">{{ config('app.debug') ? 'ON' : 'OFF' }}</span></div>
                    <div class="d-flex justify-content-between"><span class="text-muted">Timezone</span><span class="fw-semibold">{{ config('app.timezone') }}</span></div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
