@extends('admin.layouts.admin')

@section('title', ($product ? 'Edit ' . $product->name : 'Add New Product') . ' — BRX Agro Global Administration')
@section('page-title', $product ? 'Edit Commodity' : 'Add New Commodity')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.products.index') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i>Back to Product Catalog
    </a>
</div>

<form action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($product)
        @method('PUT')
    @endif

    <div class="row g-4">
        <!-- Main Form Left -->
        <div class="col-lg-8">
            <div class="card admin-card p-4 mb-4">
                <h5 class="fw-bold mb-3">Commodity Information</h5>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Product Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product?->name) }}" placeholder="e.g. Brazilian Non-GMO Soybeans" required>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Brand / Cooperative</label>
                        <input type="text" name="brand" class="form-control" value="{{ old('brand', $product?->brand) }}" placeholder="e.g. Mato Grosso Producers">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Origin / Basin</label>
                        <input type="text" name="origin" class="form-control" value="{{ old('origin', $product?->origin ?? 'Brazil') }}" placeholder="e.g. Mato Grosso, Brazil">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Description &amp; Technical Specs</label>
                    <textarea name="description" rows="5" class="form-control" placeholder="Describe quality grade, protein percentage, moisture level, phytosanitary compliance, and packaging...">{{ old('description', $product?->description) }}</textarea>
                </div>
            </div>

            <div class="card admin-card p-4">
                <h5 class="fw-bold mb-3">Pricing &amp; Inventory</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Price (USD) *</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product?->price) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Original / Market Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" name="original_price" class="form-control" value="{{ old('original_price', $product?->original_price) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Trading Unit *</label>
                        <input type="text" name="unit" class="form-control" value="{{ old('unit', $product?->unit ?? 'Metric Ton') }}" placeholder="Metric Ton, Bag, etc." required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Stock Available *</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product?->stock ?? 100) }}" min="0" required>
                        <small class="text-muted">Enter quantity in trading units (e.g. 500 MT).</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Right -->
        <div class="col-lg-4">
            <!-- Organization -->
            <div class="card admin-card p-4 mb-4">
                <h5 class="fw-bold mb-3">Classification</h5>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Category *</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product?->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured', $product?->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label small fw-bold" for="is_featured">Featured on Homepage</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_new" value="1" id="is_new" {{ old('is_new', $product?->is_new) ? 'checked' : '' }}>
                        <label class="form-check-label small fw-bold" for="is_new">Badge as "New Harvest Lot"</label>
                    </div>
                </div>
            </div>

            <!-- Media / Image -->
            <div class="card admin-card p-4 mb-4">
                <h5 class="fw-bold mb-3">Product Media</h5>

                @if($product && $product->image)
                    <div class="mb-3 text-center">
                        <img src="{{ asset($product->image) }}" class="img-fluid rounded border" style="max-height: 160px;" alt="{{ $product->name }}">
                        <div class="text-muted small mt-1">Current Image</div>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label small fw-bold">Image Path or URL</label>
                    <input type="text" name="image" class="form-control" value="{{ old('image', $product?->image) }}" placeholder="e.g. img/service-1.jpg or https://...">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Or Upload New Image</label>
                    <input type="file" name="image_file" class="form-control" accept="image/*">
                </div>
            </div>

            <!-- Actions -->
            <div class="card admin-card p-4">
                <button type="submit" class="btn btn-matro w-100 py-2 mb-2 shadow-sm">
                    <i class="bi bi-check-lg me-1"></i>{{ $product ? 'Update Commodity' : 'Publish Product' }}
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary w-100 py-2">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</form>
@endsection
