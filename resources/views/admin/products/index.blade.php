@extends('admin.layouts.admin')

@section('title', 'Agro Products — BRX Agro Global Administration')
@section('page-title', 'Product Catalog')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-muted small mb-0">Manage Brazilian agro-commodities, prices, inventory lots, and bulk specifications.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-matro rounded-pill shadow-sm">
        <i class="bi bi-plus-lg me-1"></i>Add New Product
    </a>
</div>

<div class="card admin-card mb-4">
    <div class="card-header bg-white">
        <form action="{{ route('admin.products.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="search" name="search" class="form-control border-start-0 bg-light" placeholder="Search product name, brand, or origin..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-select bg-light" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 text-md-end">
                <span class="text-muted small fw-semibold">{{ $products->total() }} product(s)</span>
                @if(request('search') || request('category_id'))
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary ms-2 rounded-pill">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table admin-table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price / Unit</th>
                    <th>Inventory Stock</th>
                    <th>Origin &amp; Badges</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <img class="admin-thumb" src="{{ asset($product->image ?? 'img/service-1.jpg') }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('img/service-1.jpg') }}'">
                                <div class="min-w-0">
                                    <div class="fw-semibold text-truncate text-dark" style="max-width: 250px;">{{ $product->name }}</div>
                                    <small class="text-muted">{{ $product->brand ?? 'Brazilian Harvest' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $product->category->name ?? 'Uncategorized' }}</span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">${{ number_format($product->price, 2) }}</div>
                            <small class="text-muted">per {{ $product->unit }}</small>
                            @if($product->original_price)
                                <div class="text-muted small text-decoration-line-through">${{ number_format($product->original_price, 2) }}</div>
                            @endif
                        </td>
                        <td>
                            @php
                                $stockBadge = match(true) {
                                    $product->stock === 0 => 'danger',
                                    $product->stock <= 5 => 'warning text-dark',
                                    default => 'success'
                                };
                            @endphp
                            <span class="badge bg-{{ $stockBadge }} px-2 py-1">
                                {{ number_format($product->stock) }} {{ $product->unit }}
                            </span>
                        </td>
                        <td>
                            <div class="small fw-semibold text-dark">{{ $product->origin ?? 'Brazil' }}</div>
                            <div class="mt-1">
                                @if($product->is_featured)
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle" style="font-size: 10px;">Featured</span>
                                @endif
                                @if($product->is_new)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 10px;">New Lot</span>
                                @endif
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="btn-group">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary" title="Edit Product">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete ' + {{ json_encode($product->name) }} + '? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Product">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam fs-1 d-block mb-2 text-secondary"></i>
                            No products match your filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
            <small class="text-muted">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries</small>
            <div>{{ $products->links() }}</div>
        </div>
    @endif
</div>
@endsection
