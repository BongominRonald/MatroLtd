@extends('admin.layouts.admin')

@section('title', 'Hero Section & Slides — BRX Agro Global Administration')
@section('page-title', 'Hero Section Content & Slides')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-muted small mb-0">Directly edit all homepage hero section text (eyebrow badges, headlines, green highlighted phrases, descriptions, CTA buttons, and bottom stats) as well as background banners.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary rounded-pill shadow-sm">
            <i class="bi bi-box-arrow-up-right me-1"></i>Preview Storefront Hero
        </a>
        <a href="{{ route('admin.hero-slides.create') }}" class="btn btn-matro rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i>Add New Hero Slide
        </a>
    </div>
</div>

<!-- Direct Inline Hero Section Text & Content Editors -->
<div class="row g-4">
    @forelse($slides as $slide)
        <div class="col-12">
            <div class="card admin-card overflow-hidden">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-dark rounded-pill px-3 py-2">Slide #{{ $slide->sort_order }}</span>
                        <div>
                            <h5 class="mb-0 fw-bold">
                                {{ $slide->title }}
                                @if($slide->title_highlight)
                                    <span class="text-success">{{ $slide->title_highlight }}</span>
                                @endif
                            </h5>
                            <small class="text-muted">Edit headline text, description paragraph, buttons, stats, and banner image below</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <form action="{{ route('admin.hero-slides.toggle-active', $slide) }}" method="POST" class="d-inline m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm rounded-pill {{ $slide->is_active ? 'btn-success' : 'btn-outline-secondary' }}">
                                <i class="bi {{ $slide->is_active ? 'bi-eye-fill' : 'bi-eye-slash' }} me-1"></i>
                                {{ $slide->is_active ? 'Active on Homepage' : 'Hidden' }}
                            </button>
                        </form>
                        <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                            <i class="bi bi-arrows-fullscreen me-1"></i>Full Screen Editor
                        </a>
                        <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="d-inline m-0" onsubmit="event.preventDefault(); confirmAdminAction(this, 'Delete Carousel Slide', 'Are you sure you want to remove this hero section carousel slide from the storefront?', 'Delete Slide', true);">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete Slide">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.hero-slides.update', $slide) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="is_active" value="{{ $slide->is_active ? '1' : '0' }}">

                        <div class="row g-4">
                            <!-- Left Column: Hero Text, Headline, Paragraph & Buttons -->
                            <div class="col-lg-8">
                                <div class="row g-3 mb-3">
                                    <div class="col-md-5">
                                        <label class="form-label small fw-bold text-uppercase text-muted">Eyebrow Label (Top Small Text)</label>
                                        <input type="text" name="eyebrow" class="form-control" value="{{ $slide->eyebrow }}" placeholder="e.g. Direct Harvest Basin Sourcing">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold text-uppercase text-muted">Main Headline Text *</label>
                                        <input type="text" name="title" class="form-control fw-bold" value="{{ $slide->title }}" required placeholder="e.g. From Brazilian Farms to">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold text-uppercase text-success">Green Highlighted Text</label>
                                        <input type="text" name="title_highlight" class="form-control fw-bold text-success" value="{{ $slide->title_highlight }}" placeholder="e.g. Global Tables">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-uppercase text-muted">Hero Description / Lead Paragraph Text</label>
                                    <textarea name="description" rows="3" class="form-control" placeholder="Enter the main paragraph text displayed below the headline...">{{ $slide->description }}</textarea>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold text-uppercase text-muted">Primary Button Text</label>
                                        <input type="text" name="primary_cta_text" class="form-control form-control-sm" value="{{ $slide->primary_cta_text }}" placeholder="Explore Agricultural Products">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold text-uppercase text-muted">Primary Button Link</label>
                                        <input type="text" name="primary_cta_url" class="form-control form-control-sm" value="{{ $slide->primary_cta_url }}" placeholder="#products">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold text-uppercase text-muted">Secondary Button Text</label>
                                        <input type="text" name="secondary_cta_text" class="form-control form-control-sm" value="{{ $slide->secondary_cta_text }}" placeholder="Request Bulk RFQ">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold text-uppercase text-muted">Secondary Button Link</label>
                                        <input type="text" name="secondary_cta_url" class="form-control form-control-sm" value="{{ $slide->secondary_cta_url }}" placeholder="#rfq-desk">
                                    </div>
                                </div>

                                <!-- 4 Bottom Highlight Stats Text -->
                                <div>
                                    <label class="form-label small fw-bold text-uppercase text-muted mb-2">
                                        Hero Bottom Stats Text (Up to 4 — use <code>{total_stock}</code> for dynamic MT inventory)
                                    </label>
                                    @php
                                        $slideStats = $slide->stats ?? [];
                                    @endphp
                                    <div class="row g-2">
                                        @for($i = 0; $i < 4; $i++)
                                            <div class="col-sm-6 col-md-3">
                                                <div class="p-2 border rounded bg-light">
                                                    <div class="text-muted fw-bold mb-1" style="font-size: 11px;">STAT #{{ $i + 1 }}</div>
                                                    <input type="text" name="stat_values[]" class="form-control form-control-sm mb-1 fw-bold" value="{{ $slideStats[$i]['value'] ?? '' }}" placeholder="Bold Value (e.g. 100% SGS)">
                                                    <input type="text" name="stat_labels[]" class="form-control form-control-sm" value="{{ $slideStats[$i]['label'] ?? '' }}" placeholder="Sub-label (e.g. Tested)">
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Banner Preview, Image Path & Save Button -->
                            <div class="col-lg-4 d-flex flex-column justify-content-between">
                                <div>
                                    <label class="form-label small fw-bold text-uppercase text-muted">Slide Banner Preview &amp; Image</label>
                                    <div class="position-relative rounded-3 overflow-hidden mb-3 border" style="height: 140px; background: #121820;">
                                        <img src="{{ $slide->resolvedImageUrl() }}" alt="{{ $slide->title }}" class="w-100 h-100" style="object-fit: cover; opacity: 0.55;" onerror="this.src='{{ asset('img/banner-shipping.jpg') }}'">
                                        <div class="position-absolute inset-0 p-3 d-flex flex-column justify-content-end" style="inset: 0; background: linear-gradient(90deg, rgba(14,18,24,0.88), rgba(14,18,24,0.35));">
                                            <div class="text-uppercase fw-bold" style="font-size: 10px; color: #78a22f; letter-spacing: 1px;">{{ $slide->eyebrow }}</div>
                                            <div class="fw-bold text-white" style="font-size: 0.95rem; line-height: 1.2;">
                                                {{ $slide->title }}
                                                @if($slide->title_highlight)
                                                    <span style="color: #78a22f;">{{ $slide->title_highlight }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label small fw-bold mb-1">Background Image URL or Path</label>
                                        <input type="text" name="image" class="form-control form-control-sm" value="{{ $slide->image }}" required>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col-8">
                                            <label class="form-label small fw-bold mb-1">WebP Image (Optional)</label>
                                            <input type="text" name="image_webp" class="form-control form-control-sm" value="{{ $slide->image_webp }}" placeholder="img/banner-shipping.webp">
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label small fw-bold mb-1">Order</label>
                                            <input type="number" name="sort_order" class="form-control form-control-sm" value="{{ $slide->sort_order }}" min="0" max="999">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-matro w-100 rounded-pill py-2 fw-bold shadow-sm">
                                    <i class="bi bi-check2-circle me-1"></i>Save Slide #{{ $slide->sort_order }} Text &amp; Content
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card admin-card p-5 text-center text-muted">
                <i class="bi bi-images fs-2 d-block mb-2"></i>
                No hero slides configured yet. Click <strong>Add New Hero Slide</strong> above to create one.
            </div>
        </div>
    @endforelse
</div>
@endsection
