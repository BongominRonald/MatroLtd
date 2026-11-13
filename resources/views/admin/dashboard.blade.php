@extends('admin.layouts.admin')

@section('title', 'Dashboard — BRX Agro Global Administration')
@section('page-title', 'Overview & Dashboard')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-muted small mb-0">High-level telemetry, trade pipeline, and operations monitor for BRX Agro Global.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.products.create') }}" class="btn btn-matro btn-sm"><i class="bi bi-plus-lg me-1"></i>Add Product</a>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-dark btn-sm"><i class="bi bi-bag me-1"></i>View Orders</a>
        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-chat-left-text me-1"></i>Inquiries</a>
    </div>
</div>

<!-- Key Performance Indicators (KPI Cards) -->
<div class="row g-3 mb-4">
    @php
        $kpis = [
            ['label'=>'Total Revenue', 'value'=>'$'.number_format($total_revenue, 2), 'icon'=>'bi-cash-stack', 'bg'=>'#eaf7ef', 'fg'=>'#16803c', 'url'=>null],
            ['label'=>'Total Orders', 'value'=>$total_orders, 'icon'=>'bi-bag-check', 'bg'=>'#eef4ff', 'fg'=>'#2563eb', 'url'=>route('admin.orders.index')],
            ['label'=>'Pending Orders', 'value'=>$pending_orders, 'icon'=>'bi-clock-history', 'bg'=>'#fff5e8', 'fg'=>'#d97706', 'url'=>route('admin.orders.index', ['status'=>'pending'])],
            ['label'=>'Agro Products', 'value'=>$total_products, 'icon'=>'bi-box-seam', 'bg'=>'#f2efff', 'fg'=>'#6d4aff', 'url'=>route('admin.products.index')],
            ['label'=>'Customers', 'value'=>$total_users, 'icon'=>'bi-people', 'bg'=>'#fff0f3', 'fg'=>'#db2777', 'url'=>route('admin.users.index')],
            ['label'=>'Low Stock (<5)', 'value'=>$low_stock, 'icon'=>'bi-exclamation-triangle', 'bg'=>'#fff1f0', 'fg'=>'#dc2626', 'url'=>route('admin.products.index')],
        ];
    @endphp
    @foreach($kpis as $kpi)
        <div class="col-6 col-md-4 col-xl-2">
            @if($kpi['url'])<a href="{{ $kpi['url'] }}" class="text-decoration-none">@endif
            <div class="card sh-stat-card h-100 p-3">
                <div class="sh-stat-icon mb-3" style="background:{{ $kpi['bg'] }};color:{{ $kpi['fg'] }}">
                    <i class="bi {{ $kpi['icon'] }}"></i>
                </div>
                <div class="fw-bold fs-5 text-dark text-truncate">{{ $kpi['value'] }}</div>
                <small class="text-muted">{{ $kpi['label'] }}</small>
            </div>
            @if($kpi['url'])</a>@endif
        </div>
    @endforeach
</div>

@if($low_stock > 0)
<div class="alert alert-warning border-0 shadow-sm d-flex align-items-center justify-content-between gap-3 mb-4 rounded-3">
    <div>
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <strong>{{ $low_stock }} commodity lot(s) are critically low on stock!</strong> Please review inventory before committing bulk export deliveries.
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-dark text-nowrap rounded-pill">Manage Products</a>
</div>
@endif

<!-- Quick Notification Banner -->
<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-4">
        <a href="{{ route('admin.inquiries.index', ['unread' => 1]) }}" class="card admin-card h-100 p-3 text-decoration-none text-dark">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px;">Unread Inquiries / RFQs</small>
                    <div class="fs-4 fw-bold mt-1 text-warning">{{ $unread_inquiries }}</div>
                </div>
                <div class="p-3 bg-warning-subtle text-warning rounded-circle">
                    <i class="bi bi-chat-left-dots fs-3"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-xl-8">
        <div class="card admin-card h-100 p-3">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted text-uppercase fw-semibold small">Order Fulfillment Pipeline</span>
                <a href="{{ route('admin.orders.index') }}" class="small text-decoration-none text-success fw-bold">View all orders &rarr;</a>
            </div>
            <div class="row g-2 row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-xl-6">
                @foreach($orders_by_status as $status => $count)
                    <div class="col">
                        <a href="{{ route('admin.orders.index', ['status' => $status]) }}" class="text-decoration-none">
                            <div class="p-2 rounded-3 text-center bg-light border h-100">
                                <div class="fw-bold fs-6 text-dark">{{ $count }}</div>
                                <small class="text-muted text-capitalize d-block text-truncate" style="font-size: 11px;">{{ $status }}</small>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Tables Grid: Recent Orders & Catalog Preview -->
<div class="row g-4 mb-4">
    <!-- Recent Orders -->
    <div class="col-xl-7">
        <div class="card admin-card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">Recent Trade Orders</h5>
                    <small class="text-muted">Latest commercial orders &amp; shipments</small>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-dark rounded-pill">All Orders</a>
            </div>
            <div class="table-responsive">
                <table class="table admin-table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_orders as $order)
                            <tr>
                                <td>
                                    <span class="fw-bold text-dark">#{{ $order->order_number }}</span>
                                    <div class="text-muted small" style="font-size: 11px;">{{ $order->created_at->format('M d, Y') }}</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-truncate" style="max-width: 160px;">{{ $order->customer_name }}</div>
                                    <small class="text-muted text-truncate d-block" style="max-width: 160px;">{{ $order->customer_email }}</small>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">${{ number_format($order->total_amount, 2) }}</span>
                                </td>
                                <td>
                                    @php
                                        $badgeColor = match($order->status) {
                                            'delivered' => 'success',
                                            'shipped' => 'info text-white',
                                            'confirmed' => 'primary',
                                            'pending' => 'warning text-dark',
                                            'cancelled' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badgeColor }} text-capitalize px-2 py-1">{{ $order->status }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary rounded-circle" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No orders placed yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Products -->
    <div class="col-xl-5">
        <div class="card admin-card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">Agro Catalog</h5>
                    <small class="text-muted">Featured commodities</small>
                </div>
                <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-matro rounded-pill"><i class="bi bi-plus-lg me-1"></i>Add</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recent_products as $product)
                        <div class="list-group-item d-flex align-items-center justify-content-between p-3">
                            <div class="d-flex align-items-center gap-3 min-w-0">
                                <img src="{{ asset($product->image ?? 'img/service-1.jpg') }}" alt="{{ $product->name }}" class="admin-thumb" onerror="this.src='{{ asset('img/service-1.jpg') }}'">
                                <div class="min-w-0">
                                    <div class="fw-semibold text-truncate" style="max-width: 200px;">{{ $product->name }}</div>
                                    <small class="text-muted d-block">{{ $product->category->name ?? 'Agro' }} · <span class="badge bg-light text-dark border">{{ $product->stock }} {{ $product->unit }}</span></small>
                                </div>
                            </div>
                            <div class="text-end flex-shrink-0 ms-2">
                                <div class="fw-bold text-dark">${{ number_format($product->price, 2) }}</div>
                                <a href="{{ route('admin.products.edit', $product) }}" class="small text-primary text-decoration-none">Edit</a>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-muted">No products found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
