<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">Basic Information</h6></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name ?? '') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">SKU</label>
                        <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">Images</h6></div>
            <div class="card-body">
                @if(isset($product) && $product->images)
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @foreach($product->images as $img)
                            <div class="position-relative">
                                <img src="{{ Storage::url($img) }}" class="rounded" style="width:80px;height:80px;object-fit:cover;">
                                <label class="position-absolute top-0 end-0 bg-danger rounded-circle d-flex align-items-center justify-content-center" style="width:20px;height:20px;cursor:pointer;" title="Remove">
                                    <input type="checkbox" name="remove_images[]" value="{{ $img }}" class="d-none">
                                    <i class="bi bi-x text-white" style="font-size:0.7rem;"></i>
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif
                <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                <small class="text-muted">Upload multiple images. Max 3MB each.</small>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold">Variants</h6>
                <button type="button" class="btn btn-sm btn-outline-dark" onclick="addVariantRow()"><i class="bi bi-plus"></i> Add</button>
            </div>
            <div class="card-body">
                <div id="variants-container">
                    @if(isset($product) && $product->variants->count())
                        @foreach($product->variants as $v)
                        <div class="row g-2 mb-2 variant-row align-items-end">
                            <div class="col"><input type="text" name="variant_skus[]" class="form-control form-control-sm" placeholder="SKU" value="{{ $v->sku }}"></div>
                            <div class="col"><input type="text" name="variant_sizes[]" class="form-control form-control-sm" placeholder="Size" value="{{ $v->size }}"></div>
                            <div class="col"><input type="text" name="variant_colors[]" class="form-control form-control-sm" placeholder="Color" value="{{ $v->color }}"></div>
                            <div class="col"><input type="number" name="variant_prices[]" class="form-control form-control-sm" placeholder="Price +/-" value="{{ $v->price_modifier }}" step="0.01"></div>
                            <div class="col"><input type="number" name="variant_stocks[]" class="form-control form-control-sm" placeholder="Stock" value="{{ $v->stock }}"></div>
                            <div class="col-auto"><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.variant-row').remove()"><i class="bi bi-trash"></i></button></div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <small class="text-muted">Add size/color variants with separate SKU, price modifier, and stock.</small>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">Pricing & Stock</h6></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Price (&#8377;) <span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price ?? '') }}" step="0.01" required>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Compare Price (&#8377;)</label>
                    <input type="number" name="compare_price" class="form-control" value="{{ old('compare_price', $product->compare_price ?? '') }}" step="0.01">
                    <small class="text-muted">Original price before discount</small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Stock <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? 0) }}" min="0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Weight (kg)</label>
                    <input type="number" name="weight" class="form-control" value="{{ old('weight', $product->weight ?? '') }}" step="0.01">
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white"><h6 class="mb-0 fw-semibold">Status</h6></div>
            <div class="card-body">
                <div class="mb-3">
                    <select name="status" class="form-select">
                        @foreach(['draft'=>'Draft','active'=>'Active','inactive'=>'Inactive'] as $k=>$v)
                            <option value="{{ $k }}" {{ old('status', $product->status ?? 'draft') == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $product->featured ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">Featured Product</label>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function addVariantRow() {
    const html = `<div class="row g-2 mb-2 variant-row align-items-end">
        <div class="col"><input type="text" name="variant_skus[]" class="form-control form-control-sm" placeholder="SKU"></div>
        <div class="col"><input type="text" name="variant_sizes[]" class="form-control form-control-sm" placeholder="Size"></div>
        <div class="col"><input type="text" name="variant_colors[]" class="form-control form-control-sm" placeholder="Color"></div>
        <div class="col"><input type="number" name="variant_prices[]" class="form-control form-control-sm" placeholder="Price +/-" step="0.01" value="0"></div>
        <div class="col"><input type="number" name="variant_stocks[]" class="form-control form-control-sm" placeholder="Stock" value="0"></div>
        <div class="col-auto"><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.variant-row').remove()"><i class="bi bi-trash"></i></button></div>
    </div>`;
    document.getElementById('variants-container').insertAdjacentHTML('beforeend', html);
}
</script>
@endpush
