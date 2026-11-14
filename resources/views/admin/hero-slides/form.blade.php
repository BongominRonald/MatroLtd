@extends('admin.layouts.admin')

@section('title', ($slide ? 'Edit Hero Slide' : 'Add Hero Slide') . ' — BRX Agro Global Administration')
@section('page-title', $slide ? 'Edit Hero Slide' : 'Add Hero Slide')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.hero-slides.index') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i>Back to Hero Slides
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $slide ? route('admin.hero-slides.update', $slide) : route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($slide)
        @method('PUT')
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card admin-card p-4 mb-4">
                <h5 class="fw-bold mb-3">Hero Copy &amp; Headline</h5>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Eyebrow Label</label>
                    <input type="text" name="eyebrow" class="form-control" value="{{ old('eyebrow', $slide?->eyebrow) }}" placeholder="e.g. Direct Harvest Basin Sourcing">
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-7">
                        <label class="form-label small fw-bold">Main Headline *</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $slide?->title) }}" placeholder="e.g. From Brazilian Farms to" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label small fw-bold">Green Highlighted Suffix</label>
                        <input type="text" name="title_highlight" class="form-control" value="{{ old('title_highlight', $slide?->title_highlight) }}" placeholder="e.g. Global Tables">
                    </div>
                </div>

                <div class="mb-0">
                    <label class="form-label small fw-bold">Lead Description</label>
                    <textarea name="description" rows="4" class="form-control" placeholder="Describe origin sourcing, certifications, and logistics...">{{ old('description', $slide?->description) }}</textarea>
                </div>
            </div>

            <div class="card admin-card p-4 mb-4">
                <h5 class="fw-bold mb-3">Call-to-Action Buttons</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Primary Button Text</label>
                        <input type="text" name="primary_cta_text" class="form-control" value="{{ old('primary_cta_text', $slide?->primary_cta_text ?? 'Explore Agricultural Products') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Primary Button Link</label>
                        <input type="text" name="primary_cta_url" class="form-control" value="{{ old('primary_cta_url', $slide?->primary_cta_url ?? '#products') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Secondary Button Text</label>
                        <input type="text" name="secondary_cta_text" class="form-control" value="{{ old('secondary_cta_text', $slide?->secondary_cta_text ?? 'Request Bulk RFQ') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Secondary Button Link</label>
                        <input type="text" name="secondary_cta_url" class="form-control" value="{{ old('secondary_cta_url', $slide?->secondary_cta_url ?? '#rfq-desk') }}">
                    </div>
                </div>
            </div>

            <div class="card admin-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Bottom Highlight Stats (up to 4)</h5>
                    <small class="text-muted">Tip: use <code>{total_stock}</code> for live inventory sum</small>
                </div>
                @php
                    $existingStats = old('stat_values') !== null
                        ? collect(old('stat_values'))->map(fn ($v, $i) => ['value' => $v, 'label' => old("stat_labels.$i", '')])->all()
                        : ($slide?->stats ?? []);
                @endphp
                <div class="row g-3">
                    @for($i = 0; $i < 4; $i++)
                        <div class="col-md-6">
                            <div class="p-3 border rounded">
                                <div class="small fw-bold text-muted mb-2">Stat #{{ $i + 1 }}</div>
                                <input type="text" name="stat_values[]" class="form-control form-control-sm mb-2" value="{{ $existingStats[$i]['value'] ?? '' }}" placeholder="Value (e.g. 100% SGS)">
                                <input type="text" name="stat_labels[]" class="form-control form-control-sm" value="{{ $existingStats[$i]['label'] ?? '' }}" placeholder="Label (e.g. Pre-Shipment Tested)">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card admin-card p-4 mb-4">
                <h5 class="fw-bold mb-3">Background Image</h5>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Image Path or URL *</label>
                    <input type="text" name="image" id="heroImageInput" class="form-control" value="{{ old('image', $slide?->image ?? 'img/banner-shipping.jpg') }}" required>
                    <small class="text-muted">Use a relative asset path (e.g. <code>img/banner-shipping.jpg</code>) or full HTTPS URL.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">WebP Path or URL (Optional)</label>
                    <input type="text" name="image_webp" class="form-control" value="{{ old('image_webp', $slide?->image_webp) }}" placeholder="e.g. img/banner-shipping.webp">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Quick Preset Banners</label>
                    <div class="d-flex flex-wrap gap-1">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('heroImageInput').value='img/banner-shipping.jpg'">Shipping</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('heroImageInput').value='img/banner-harvest.jpg'">Harvest</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('heroImageInput').value='img/banner-warehouse.jpg'">Warehouse</button>
                    </div>
                </div>

                <div class="mb-0">
                    <label class="form-label small fw-bold">Upload Image (Local / Persistent Disk)</label>
                    <input type="file" name="image_file" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted d-block mt-1">Note: On Vercel serverless, use an external HTTPS URL or preset asset path instead of file upload.</small>
                </div>
            </div>

            <div class="card admin-card p-4">
                <h5 class="fw-bold mb-3">Display Settings</h5>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $slide?->sort_order ?? 1) }}" min="0" max="999">
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" role="switch" id="isActiveSwitch" name="is_active" value="1" {{ old('is_active', $slide?->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="isActiveSwitch">Active on Homepage</label>
                </div>

                <button type="submit" class="btn btn-matro w-100 rounded-pill py-2">
                    <i class="bi bi-check2-circle me-1"></i>{{ $slide ? 'Update Slide' : 'Create Slide' }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
