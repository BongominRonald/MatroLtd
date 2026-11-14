@extends('admin.layouts.admin')

@section('title', 'Hero Slides — BRX Agro Global Administration')
@section('page-title', 'Hero Carousel Slides')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-muted small mb-0">Manage homepage hero banners, headlines, call-to-action buttons, and export highlight stats.</p>
    </div>
    <a href="{{ route('admin.hero-slides.create') }}" class="btn btn-matro rounded-pill shadow-sm">
        <i class="bi bi-plus-lg me-1"></i>Add Hero Slide
    </a>
</div>

<div class="card admin-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="fw-semibold text-dark">Homepage Slides ({{ $slides->count() }})</span>
        <span class="text-muted small">Ordered by Sort Order ascending</span>
    </div>

    <div class="table-responsive">
        <table class="table admin-table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 70px;">Order</th>
                    <th>Slide</th>
                    <th>CTAs &amp; Stats</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($slides as $slide)
                    <tr>
                        <td>
                            <span class="badge bg-light text-dark border fw-bold">#{{ $slide->sort_order }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <img class="admin-thumb" src="{{ $slide->resolvedImageUrl() }}" alt="{{ $slide->title }}" onerror="this.src='{{ asset('img/banner-shipping.jpg') }}'">
                                <div class="min-w-0">
                                    @if($slide->eyebrow)
                                        <div class="text-uppercase text-success fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">{{ $slide->eyebrow }}</div>
                                    @endif
                                    <div class="fw-semibold text-dark">
                                        {{ $slide->title }}
                                        @if($slide->title_highlight)
                                            <span class="text-success">{{ $slide->title_highlight }}</span>
                                        @endif
                                    </div>
                                    @if($slide->description)
                                        <small class="text-muted d-block text-truncate" style="max-width: 380px;">{{ $slide->description }}</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small">
                                @if($slide->primary_cta_text)
                                    <span class="badge bg-success-subtle text-success border me-1">{{ $slide->primary_cta_text }}</span>
                                @endif
                                @if($slide->secondary_cta_text)
                                    <span class="badge bg-light text-dark border">{{ $slide->secondary_cta_text }}</span>
                                @endif
                            </div>
                            <small class="text-muted">{{ count($slide->stats ?? []) }} highlight stat(s)</small>
                        </td>
                        <td>
                            <form action="{{ route('admin.hero-slides.toggle-active', $slide) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm rounded-pill {{ $slide->is_active ? 'btn-success' : 'btn-outline-secondary' }}">
                                    <i class="bi {{ $slide->is_active ? 'bi-eye-fill' : 'bi-eye-slash' }} me-1"></i>
                                    {{ $slide->is_active ? 'Active' : 'Hidden' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="btn btn-sm btn-outline-primary rounded-pill" title="Edit Slide">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" onsubmit="return confirm('Delete this hero slide?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete Slide">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-images fs-2 d-block mb-2"></i>
                            No hero slides configured yet. The homepage will display default fallback slides until you add one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
