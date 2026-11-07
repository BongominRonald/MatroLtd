@php
    $imgUrl = Str::startsWith($product->image, 'http') ? $product->image : asset($product->image ?: 'img/service-1.jpg');
    $discount = null;
    if ($product->original_price && $product->original_price > $product->price) {
        $discount = round((1 - ($product->price / $product->original_price)) * 100);
    }
@endphp

<div class="card matro-product-card h-100 border-0 rounded-4 overflow-hidden shadow-sm bg-white position-relative d-flex flex-column" data-product-id="{{ $product->id }}" data-category="{{ $product->category?->slug ?? 'all' }}">
    <!-- Image Box with floating badges -->
    <div class="matro-product-img-wrap position-relative overflow-hidden bg-light" style="height: 210px;">
        <a href="{{ route('shop.show', $product) }}" class="d-block w-100 h-100">
            <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover transition-transform" loading="lazy">
        </a>

        <!-- Floating Badges -->
        <div class="position-absolute top-0 start-0 m-2.5 d-flex flex-column gap-1" style="z-index: 2;">
            @if($discount)
                <span class="badge bg-danger text-white rounded-pill px-2.5 py-1 fw-bold shadow-sm" style="font-size: 0.72rem;">
                    <i class="bi bi-tag-fill me-1"></i>-{{ $discount }}% OFF
                </span>
            @elseif($product->is_new)
                <span class="badge bg-success text-dark rounded-pill px-2.5 py-1 fw-bold shadow-sm" style="font-size: 0.72rem;">
                    <i class="bi bi-stars me-1"></i>NEW HARVEST
                </span>
            @endif

            @if($product->is_featured)
                <span class="badge bg-warning text-dark rounded-pill px-2.5 py-1 fw-bold shadow-sm" style="font-size: 0.7rem;">
                    FEATURED
                </span>
            @endif
        </div>

        <!-- Quick View Overlay Button -->
        <button type="button" class="btn btn-dark btn-sm rounded-circle position-absolute top-0 end-0 m-2.5 shadow-sm quick-view-btn d-flex align-items-center justify-content-center"
                style="width: 34px; height: 34px; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.2);"
                data-bs-toggle="modal"
                data-bs-target="#quickViewModal"
                data-product-id="{{ $product->id }}"
                data-name="{{ $product->name }}"
                data-category="{{ $product->category?->name ?? 'Agro Commodity' }}"
                data-price="${{ number_format($product->price, 2) }}"
                data-unit="{{ $product->unit }}"
                data-origin="{{ $product->origin }}"
                data-stock="{{ $product->stock }}"
                data-desc="{{ $product->description }}"
                data-image="{{ $imgUrl }}"
                data-url="{{ route('shop.show', $product) }}"
                data-add-url="{{ route('cart.add', $product) }}"
                title="Quick View">
            <i class="bi bi-eye text-white"></i>
        </button>

        <!-- Origin tag overlay at bottom of image -->
        <div class="position-absolute bottom-0 start-0 end-0 px-3 py-1.5" style="background: linear-gradient(transparent, rgba(15,23,42,0.7));">
            <small class="text-white fw-semibold" style="font-size: 0.75rem;">
                <i class="bi bi-geo-alt-fill text-warning me-1"></i>{{ $product->origin }}
            </small>
        </div>
    </div>

    <!-- Product Card Body -->
    <div class="card-body p-3.5 d-flex flex-column justify-content-between flex-grow-1">
        <div>
            <!-- Category & Brand -->
            <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                    {{ $product->category?->name ?? 'Commodity' }}
                </span>
                @if($product->stock > 50)
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill py-0.5 px-2" style="font-size: 0.68rem;">
                        <i class="bi bi-check-circle me-1"></i>In Stock
                    </span>
                @elseif($product->stock > 0)
                    <span class="badge bg-warning-subtle text-dark border border-warning-subtle rounded-pill py-0.5 px-2" style="font-size: 0.68rem;">
                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $product->stock }} left
                    </span>
                @else
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill py-0.5 px-2" style="font-size: 0.68rem;">
                        Out of Stock
                    </span>
                @endif
            </div>

            <!-- Product Title -->
            <h6 class="card-title fw-bold text-dark mb-1 lh-snug">
                <a href="{{ route('shop.show', $product) }}" class="text-dark text-decoration-none hover-success transition-colors">
                    {{ $product->name }}
                </a>
            </h6>

            <!-- Rating summary -->
            <div class="d-flex align-items-center gap-1 mb-2">
                <div class="text-warning" style="font-size: 0.75rem;">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
                <small class="text-muted" style="font-size: 0.72rem;">(5.0 • SGS Passed)</small>
            </div>
        </div>

        <!-- Pricing & Action Bar -->
        <div class="pt-2 border-top border-light-subtle mt-2">
            <div class="d-flex justify-content-between align-items-baseline mb-2.5">
                <div>
                    <div class="fs-5 fw-bold text-dark lh-1">
                        ${{ number_format($product->price, 2) }}
                    </div>
                    <small class="text-muted" style="font-size: 0.72rem;">per {{ $product->unit }}</small>
                </div>
                @if($product->original_price && $product->original_price > $product->price)
                    <div class="text-end">
                        <small class="text-muted text-decoration-line-through d-block" style="font-size: 0.75rem;">
                            ${{ number_format($product->original_price, 2) }}
                        </small>
                    </div>
                @endif
            </div>

            <!-- Action Buttons: Add to Cart (AJAX) & Quote -->
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-success btn-sm rounded-pill flex-grow-1 py-1.5 fw-bold text-dark d-flex align-items-center justify-content-center gap-1.5 ajax-add-to-cart shadow-sm"
                        data-product-id="{{ $product->id }}"
                        data-add-url="{{ route('cart.add', $product) }}"
                        {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    <i class="bi bi-bag-plus-fill"></i>
                    <span>{{ $product->stock > 0 ? 'Add to Cart' : 'Sold Out' }}</span>
                </button>
                <a href="{{ route('shop.show', $product) }}" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 34px; height: 34px;" title="View Details &amp; Specifications">
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
