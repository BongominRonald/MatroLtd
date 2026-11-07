@extends('layouts.public')

@section('title', 'Order Confirmation #' . $order->order_number . ' — Matro')

@section('content')
<div class="py-5 bg-dark text-white border-bottom border-secondary border-opacity-50 text-center">
    <div class="container">
        <div class="rounded-circle bg-success text-dark d-inline-flex align-items-center justify-content-center p-3 mb-3 shadow-lg" style="width: 72px; height: 72px;">
            <i class="bi bi-check-lg fs-1 fw-bold"></i>
        </div>
        <h1 class="display-6 fw-bold text-white mb-2">Export Order Confirmed!</h1>
        <p class="text-white-50 fs-6 mb-0">
            Thank you, <strong>{{ $order->customer_name }}</strong>. Your purchase order has been logged in the Matro export registry.
        </p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4">
                <!-- Receipt Header -->
                <div class="card-header bg-white p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Order Tracking Code</span>
                        <h4 class="fw-bold text-dark mb-0 font-monospace">#{{ $order->order_number }}</h4>
                    </div>
                    <div class="text-md-end">
                        <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill fw-bold text-capitalize">
                            {{ $order->status }}
                        </span>
                        <div class="text-muted small mt-1">{{ $order->created_at->format('M d, Y • H:i') }} UTC</div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Buyer & Delivery Details -->
                    <div class="row g-3 mb-4 pb-4 border-bottom">
                        <div class="col-sm-6">
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1" style="font-size: 0.72rem;">Buyer Credentials</span>
                            <div class="fw-bold text-dark">{{ $order->customer_name }}</div>
                            <div class="text-muted small">{{ $order->customer_email }}</div>
                            <div class="text-muted small">{{ $order->customer_phone }}</div>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1" style="font-size: 0.72rem;">Discharge Port &amp; Delivery</span>
                            <div class="fw-bold text-dark">{{ $order->shipping_address }}</div>
                            <div class="text-muted small mt-1">Payment: <strong>{{ $order->payment_method }}</strong></div>
                        </div>
                    </div>

                    <!-- Itemized Commodities Table -->
                    <h6 class="fw-bold text-dark mb-3">Itemized Commodity Allocations</h6>
                    <div class="table-responsive mb-4">
                        <table class="table table-sm align-middle mb-0">
                            <thead class="table-light small text-uppercase text-muted">
                                <tr>
                                    <th>Commodity</th>
                                    <th>Unit Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $item->product_name }}</div>
                                            @if($item->product)
                                                <small class="text-muted">{{ $item->product->origin }}</small>
                                            @endif
                                        </td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td class="text-center fw-bold">{{ $item->quantity }}</td>
                                        <td class="text-end fw-bold text-dark">${{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="border-top">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold pt-3 fs-6">Order Total (USD):</td>
                                    <td class="text-end fw-black pt-3 fs-5 text-success font-monospace fw-bold">
                                        ${{ number_format($order->total_amount, 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Next Steps Timeline Box -->
                    <div class="p-3.5 bg-light rounded-4 border">
                        <h6 class="fw-bold text-dark mb-2"><i class="bi bi-clock-history me-1.5 text-success"></i>What Happens Next?</h6>
                        <ol class="small text-muted mb-0 ps-3 d-flex flex-column gap-1.5">
                            <li>Our corporate trade desk will email the formal Proforma Invoice and legal escrow deposit instructions to <strong>{{ $order->customer_email }}</strong> within 2 hours.</li>
                            <li>Upon verified escrow funding, sampling agronomists generate the pre-shipment SGS laboratory analysis.</li>
                            <li>Cargo is containerized or loaded on vessel at Santos / Paranaguá, and ocean Bill of Lading (BL) is issued.</li>
                        </ol>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="card-footer bg-white p-4 border-top d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" onclick="window.print();">
                        <i class="bi bi-printer me-1"></i>Print Proforma Receipt
                    </button>
                    <div class="d-flex gap-2">
                        <a href="https://wa.me/5511952987545?text=Hello%20Matro%20regarding%20my%20Order%20{{ $order->order_number }}" target="_blank" class="btn btn-outline-success rounded-pill px-4 fw-semibold">
                            <i class="bi bi-whatsapp me-1 text-success"></i>Contact Trade Desk
                        </a>
                        <a href="{{ route('shop.index') }}" class="btn btn-success rounded-pill px-4 fw-bold text-dark shadow-sm">
                            Continue Browsing
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
