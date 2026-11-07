@extends('layouts.public')

@section('title', $product->name . ' — Matro Brazilian Export')
@section('meta-description', Str::limit($product->description, 150))

@section('content')
@php
    $imgUrl = Str::startsWith($product->image, 'http') ? $product->image : asset($product->image ?: 'img/service-1.jpg');
    $discount = null;
    if ($product->original_price && $product->original_price > $product->price) {
        $discount = round((1 - ($product->price / $product->original_price)) * 100);
    }
@endphp

<!-- Breadcrumbs Header -->
<div class="py-3 bg-dark text-white border-bottom border-secondary border-opacity-50">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-white-50 text-decoration-none">Catalog</a></li>
                @if($product->category)
                    <li class="breadcrumb-item"><a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="text-white-50 text-decoration-none">{{ $product->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active text-success" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5 mb-5">
        <!-- Product Image Gallery Column -->
        <div class="col-lg-6">
            <div class="card border-0 rounded-4 overflow-hidden shadow-sm bg-white p-3 sticky-top" style="top: 90px;">
                <div class="position-relative rounded-3 overflow-hidden bg-light text-center p-4" style="min-height: 380px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="img-fluid rounded-3" style="max-height: 380px; object-fit: contain;">

                    <!-- Badges -->
                    <div class="position-absolute top-0 start-0 m-3 d-flex flex-column gap-1">
                        @if($discount)
                            <span class="badge bg-danger rounded-pill px-3 py-1.5 fw-bold shadow-sm">-{{ $discount }}% OFF</span>
                        @elseif($product->is_new)
                            <span class="badge bg-success text-dark rounded-pill px-3 py-1.5 fw-bold shadow-sm">NEW HARVEST</span>
                        @endif
                        @if($product->is_featured)
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-1.5 fw-bold shadow-sm">FEATURED LOT</span>
                        @endif
                    </div>
                </div>

                <!-- Trust Callout -->
                <div class="d-flex justify-content-around text-center py-3 mt-3 border-top border-light-subtle small text-muted">
                    <div><i class="bi bi-shield-check text-success fs-5 d-block"></i>Escrow Protected</div>
                    <div><i class="bi bi-patch-check text-warning fs-5 d-block"></i>SGS Inspected</div>
                    <div><i class="bi bi-geo-alt text-primary fs-5 d-block"></i>{{ $product->origin }}</div>
                </div>
            </div>
        </div>

        <!-- Product Purchase Information Column -->
        <div class="col-lg-6">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 text-uppercase fw-bold" style="font-size: 0.75rem;">
                    {{ $product->category?->name ?? 'Agro Commodity' }}
                </span>
                <span class="text-muted small">• Brand: <strong>{{ $product->brand ?? 'Brazilian Harvest' }}</strong></span>
            </div>

            <h1 class="display-6 fw-bold text-dark mb-2">{{ $product->name }}</h1>

            <!-- Ratings & Certifications -->
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="text-warning small">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
                <span class="fw-bold small text-dark">5.0</span>
                <span class="text-muted small">(SGS Grade Lab Tested • MAPA Export Cleared)</span>
            </div>

            <!-- Price Card -->
            <div class="p-3.5 rounded-4 bg-light border mb-4">
                <div class="d-flex align-items-baseline gap-2 mb-1">
                    <span class="display-5 fw-bold text-dark lh-1">${{ number_format($product->price, 2) }}</span>
                    <span class="text-muted fs-6">per {{ $product->unit }}</span>
                    @if($product->original_price && $product->original_price > $product->price)
                        <span class="text-muted text-decoration-line-through ms-2 fs-6">
                            ${{ number_format($product->original_price, 2) }}
                        </span>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-2 text-success small">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Settlement via international trade escrow or Letter of Credit (LC).</span>
                </div>
            </div>

            <!-- Stock Availability -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center small mb-1">
                    <span class="fw-bold text-dark">Harvest Stock Availability:</span>
                    @if($product->stock > 0)
                        <span class="text-success fw-bold"><i class="bi bi-box-seam me-1"></i>{{ number_format($product->stock) }} {{ $product->unit }}(s) Available</span>
                    @else
                        <span class="text-danger fw-bold">Currently Sold Out</span>
                    @endif
                </div>
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ min(100, max(10, ($product->stock / 2500) * 100)) }}%"></div>
                </div>
            </div>

            <!-- Add to Cart Form -->
            <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-4">
                @csrf
                <div class="row g-2 align-items-center mb-3">
                    <div class="col-4">
                        <label class="form-label small fw-bold text-muted text-uppercase mb-1" style="font-size: 0.72rem;">Order Quantity</label>
                        <div class="input-group">
                            <input type="number" name="quantity" class="form-control text-center fw-bold rounded-pill" value="1" min="1" max="{{ max(1, $product->stock) }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="col-8">
                        <label class="form-label small text-transparent mb-1 d-block" style="font-size: 0.72rem;">Action</label>
                        <button type="submit" class="btn btn-success btn-lg rounded-pill w-100 fw-bold text-dark shadow-sm d-flex align-items-center justify-content-center gap-2" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            <i class="bi bi-bag-plus-fill"></i>
                            <span>{{ $product->stock > 0 ? 'Add to Cart / Order' : 'Sold Out' }}</span>
                        </button>
                    </div>
                </div>
            </form>

            <!-- RFQ / Custom Quote Button -->
            <div class="d-flex gap-2 mb-4">
                <button type="button" class="btn btn-outline-dark rounded-pill flex-grow-1 py-2.5 fw-semibold d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Inquire for Custom Bulk Contract (RFQ)</span>
                </button>
                <a href="https://wa.me/5511952987545?text=Hello%20Matro%20I%20am%20inquiring%20about%20{{ urlencode($product->name) }}" target="_blank" class="btn btn-outline-success rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 44px; height: 44px;" title="WhatsApp Trade Desk">
                    <i class="bi bi-whatsapp fs-5"></i>
                </a>
            </div>

            <!-- Product Description -->
            <div class="mb-4">
                <h6 class="fw-bold text-dark mb-2">Description &amp; Origin Details</h6>
                <p class="text-muted small lh-base mb-0">
                    {{ $product->description ?: 'This lot is sourced directly from verified agricultural cooperatives in Brazil with standardized quality parameters and phytosanitary export documentation.' }}
                </p>
            </div>

            <!-- Institutional Specifications Table -->
            <div class="card border rounded-3 p-3 bg-light">
                <h6 class="fw-bold text-dark mb-2" style="font-size: 0.88rem;">Export Specification Table</h6>
                <table class="table table-sm table-borderless small mb-0">
                    <tbody>
                        <tr>
                            <td class="text-muted py-1" style="width: 40%;">Harvest Basin</td>
                            <td class="fw-semibold text-dark py-1">{{ $product->origin }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted py-1">Commodity Grade</td>
                            <td class="fw-semibold text-dark py-1">Export Standard (Grade 1 / 2)</td>
                        </tr>
                        <tr>
                            <td class="text-muted py-1">Packaging Format</td>
                            <td class="fw-semibold text-dark py-1">Bulk Vessel / 50kg PP Bags / Big Bags</td>
                        </tr>
                        <tr>
                            <td class="text-muted py-1">Primary Exit Ports</td>
                            <td class="fw-semibold text-dark py-1">Santos (BRSSZ) or Paranaguá (BRPNG)</td>
                        </tr>
                        <tr>
                            <td class="text-muted py-1">Inspection Agency</td>
                            <td class="fw-semibold text-dark py-1">SGS / Bureau Veritas Pre-Shipment</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->isNotEmpty())
        <div class="pt-5 border-top">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <span class="text-success text-uppercase fw-bold small" style="letter-spacing: 1.5px;">Related Sourcing</span>
                    <h3 class="fw-bold text-dark mb-0">Similar Commodities in This Category</h3>
                </div>
                <a href="{{ route('shop.index', ['category' => $product->category?->slug]) }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    View More
                </a>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                @foreach($relatedProducts as $rel)
                    <div class="col">
                        @include('partials.product-card', ['product' => $rel])
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
