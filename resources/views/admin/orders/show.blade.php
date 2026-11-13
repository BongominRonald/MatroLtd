@extends('admin.layouts.admin')

@section('title', 'Order #' . $order->order_number . ' — BRX Agro Global Administration')
@section('page-title', 'Order Details')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.orders.index') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i>Back to All Orders
    </a>
</div>

<div class="row g-4">
    <!-- Left Column: Items & Fulfillment -->
    <div class="col-lg-8">
        <div class="card admin-card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-0">Order #{{ $order->order_number }}</h5>
                    <small class="text-muted">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</small>
                </div>
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
                <span class="badge bg-{{ $badgeColor }} text-capitalize px-3 py-2 fs-6">
                    {{ $order->status }}
                </span>
            </div>

            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Commodity Lot</th>
                            <th>Unit Price</th>
                            <th>Contract Quantity</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ asset($item->product->image ?? 'img/service-1.jpg') }}" alt="{{ $item->product_name }}" class="admin-thumb" onerror="this.src='{{ asset('img/service-1.jpg') }}'">
                                        <div>
                                            <div class="fw-bold text-dark">{{ $item->product_name }}</div>
                                            <small class="text-muted">{{ $item->product->origin ?? 'Brazil' }} · {{ $item->product->unit ?? 'Unit' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>
                                    <span class="fw-semibold">{{ $item->quantity }}</span> {{ $item->product->unit ?? 'units' }}
                                </td>
                                <td class="text-end fw-bold text-dark">${{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-semibold">Grand Total:</td>
                            <td class="text-end fw-bold text-success fs-5">${{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @if($order->notes)
            <div class="card admin-card p-4">
                <h6 class="fw-bold mb-2"><i class="bi bi-sticky me-2 text-warning"></i>Buyer &amp; Contract Notes</h6>
                <p class="text-muted mb-0 small" style="word-break: break-word; overflow-wrap: anywhere;">{{ $order->notes }}</p>
            </div>
        @endif
    </div>

    <!-- Right Column: Buyer Info & Status Update -->
    <div class="col-lg-4">
        <!-- Update Status Card -->
        <div class="card admin-card p-4 mb-4">
            <h6 class="fw-bold mb-3">Update Order Status</h6>
            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold">Order Lifecycle Status</label>
                    <select name="status" class="form-select mb-3">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending Verification</option>
                        <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed / Escrow Backed</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped / En Route (Vessel/Truck)</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered &amp; Released</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-matro w-100 py-2">
                    <i class="bi bi-check2-circle me-1"></i>Save Status
                </button>
            </form>
        </div>

        <!-- Buyer Information -->
        <div class="card admin-card p-4 mb-4">
            <h6 class="fw-bold mb-3">Buyer Information</h6>
            <div class="mb-3">
                <small class="text-muted d-block">Contact Name</small>
                <div class="fw-bold">{{ $order->customer_name }}</div>
            </div>
            <div class="mb-3">
                <small class="text-muted d-block">Email Address</small>
                <div><a href="mailto:{{ $order->customer_email }}" class="text-decoration-none text-primary">{{ $order->customer_email }}</a></div>
            </div>
            @if($order->customer_phone)
                <div class="mb-3">
                    <small class="text-muted d-block">Telephone / WhatsApp</small>
                    <div class="fw-semibold">{{ $order->customer_phone }}</div>
                </div>
            @endif
            <div class="mb-3">
                <small class="text-muted d-block">Payment Method</small>
                <span class="badge bg-light text-dark border">{{ $order->payment_method ?? 'Escrow' }}</span>
            </div>
            <div>
                <small class="text-muted d-block">Delivery / Destination Port</small>
                <div class="p-2 bg-light rounded border small text-break" style="word-break: break-word; overflow-wrap: anywhere;">{{ $order->shipping_address ?? 'Not specified' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
