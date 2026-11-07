@extends('layouts.public')

@section('title', 'Agricultural Commodities Catalog — Matro Store')
@section('meta-description', 'Browse Brazilian export-grade soybeans, cane sugar, yellow maize, pulses, coffee, and specialty commodities.')

@section('content')
<!-- Page Header Breadcrumbs Banner -->
<div class="py-4 bg-dark text-white border-bottom border-secondary border-opacity-50">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small mb-1">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-success" aria-current="page">Catalog &amp; Store</li>
                @if($currentCategory)
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $currentCategory->name }}</li>
                @endif
            </ol>
        </nav>
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h2 class="fw-bold text-white mb-0">
                    {{ $currentCategory ? $currentCategory->name : 'Agricultural Commodities Catalog' }}
                </h2>
                <small class="text-white-50">Showing {{ $products->total() }} export lots available for immediate dispatch</small>
            </div>
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#inquiryModal" class="btn btn-outline-success btn-sm rounded-pill px-3 py-1.5 fw-semibold text-white">
                <i class="bi bi-file-earmark-text me-1"></i>Custom Vessel Contract (RFQ)
            </a>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="card border-0 rounded-4 shadow-sm bg-white p-4 sticky-top" style="top: 90px;">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <h6 class="fw-bold text-dark mb-0"><i class="bi bi-funnel me-1.5 text-success"></i>Filters</h6>
                    @if(request()->anyFilled(['search', 'category', 'min_price', 'max_price', 'sort']))
                        <a href="{{ route('shop.index') }}" class="small text-danger text-decoration-none fw-semibold">Reset All</a>
                    @endif
                </div>

                <form action="{{ route('shop.index') }}" method="GET">
                    <!-- Search Input -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="font-size: 0.72rem;">Search Keywords</label>
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control rounded-start-pill" placeholder="Soybeans, sugar, corn..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary rounded-end-pill px-2.5" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Categories Filter -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="font-size: 0.72rem;">Agro Categories</label>
                        <div class="d-flex flex-column gap-1.5">
                            <a href="{{ route('shop.index', array_merge(request()->except('category', 'page'))) }}"
                               class="d-flex justify-content-between align-items-center py-1.5 px-2 rounded-3 text-decoration-none small {{ !request('category') ? 'bg-success text-dark fw-bold' : 'text-dark hover-bg-light' }}">
                                <span>All Categories</span>
                                <span class="badge {{ !request('category') ? 'bg-dark text-white' : 'bg-light text-muted border' }} rounded-pill">{{ $categories->sum('products_count') }}</span>
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('shop.index', array_merge(request()->except('page'), ['category' => $cat->slug])) }}"
                                   class="d-flex justify-content-between align-items-center py-1.5 px-2 rounded-3 text-decoration-none small {{ request('category') == $cat->slug ? 'bg-success text-dark fw-bold' : 'text-dark hover-bg-light' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span class="badge {{ request('category') == $cat->slug ? 'bg-dark text-white' : 'bg-light text-muted border' }} rounded-pill">{{ $cat->products_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sort Order Dropdown -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="font-size: 0.72rem;">Sort Results By</label>
                        <select name="sort" class="form-select form-select-sm rounded-pill" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Harvest</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Commodity Name (A-Z)</option>
                            <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured First</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-dark btn-sm rounded-pill w-100 fw-bold py-2">Apply Filters</button>
                </form>
            </div>
        </div>

        <!-- Products Grid Area -->
        <div class="col-lg-9">
            <!-- Active Filter Badges -->
            @if(request('search') || request('category') || request('sort'))
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2.5 bg-white rounded-3 border">
                    <small class="text-muted fw-bold">Active Filters:</small>
                    @if(request('search'))
                        <span class="badge bg-light text-dark border rounded-pill">Keyword: "{{ request('search') }}"</span>
                    @endif
                    @if($currentCategory)
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Category: {{ $currentCategory->name }}</span>
                    @endif
                    @if(request('sort'))
                        <span class="badge bg-light text-dark border rounded-pill">Sort: {{ request('sort') }}</span>
                    @endif
                    <a href="{{ route('shop.index') }}" class="small text-danger text-decoration-none ms-auto fw-semibold">Clear Filters</a>
                </div>
            @endif

            <!-- Products Grid -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @forelse($products as $product)
                    <div class="col">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-4 mb-3 border">
                            <i class="bi bi-search fs-1 text-muted"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">No Commodities Match Your Search</h5>
                        <p class="text-muted small mb-4">Try adjusting your filters or search keywords.</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-dark rounded-pill px-4">View All Products</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
