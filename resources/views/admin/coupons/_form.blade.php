<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Coupon Code <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $coupon->code ?? '') }}" required style="text-transform:uppercase;">
        @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
        <select name="type" class="form-select" required>
            <option value="percent" {{ old('type', $coupon->type ?? '') == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
            <option value="flat" {{ old('type', $coupon->type ?? '') == 'flat' ? 'selected' : '' }}>Flat Amount (₹)</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Value <span class="text-danger">*</span></label>
        <input type="number" name="value" class="form-control" value="{{ old('value', $coupon->value ?? '') }}" step="0.01" min="0" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Minimum Order (₹)</label>
        <input type="number" name="min_order" class="form-control" value="{{ old('min_order', $coupon->min_order ?? '') }}" step="0.01" min="0">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Uses Left</label>
        <input type="number" name="uses_left" class="form-control" value="{{ old('uses_left', $coupon->uses_left ?? '') }}" min="0">
        <small class="text-muted">Leave blank for unlimited</small>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Expires At</label>
        <input type="datetime-local" name="expires_at" class="form-control" value="{{ old('expires_at', isset($coupon) && $coupon->expires_at ? $coupon->expires_at->format('Y-m-d\TH:i') : '') }}">
    </div>
</div>
<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $coupon->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Active</label>
</div>
