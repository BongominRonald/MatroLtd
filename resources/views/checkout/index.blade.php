@extends('layouts.public')

@section('title', 'Secure Checkout — Matro Store')

@section('content')
<div class="py-4 bg-dark text-white border-bottom border-secondary border-opacity-50">
    <div class="container">
        <h2 class="fw-bold text-white mb-0">Secure Escrow Checkout</h2>
        <small class="text-white-50">Provide buyer credentials and destination discharge instructions</small>
    </div>
</div>

<div class="container py-5">
    @if($errors->any())
        <div class="alert alert-danger rounded-4 mb-4">
            <h6 class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Please resolve the following errors:</h6>
            <ul class="mb-0 small ps-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row g-5">
            <!-- Left Column: Checkout Inputs -->
            <div class="col-lg-7">
                <!-- Section 1: Buyer Information -->
                <div class="card border-0 rounded-4 shadow-sm bg-white p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom">
                        <i class="bi bi-person-badge me-2 text-success"></i>1. Buyer Credentials
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Authorized Contact Name *</label>
                            <input type="text" name="customer_name" class="form-control rounded-3" value="{{ old('customer_name', $user?->name) }}" required placeholder="e.g. Carlos Silva">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Corporate Email *</label>
                            <input type="email" name="customer_email" class="form-control rounded-3" value="{{ old('customer_email', $user?->email) }}" required placeholder="e.g. buyer@globalagro.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Direct Phone / WhatsApp *</label>
                            <input type="tel" name="customer_phone" class="form-control rounded-3" value="{{ old('customer_phone') }}" required placeholder="e.g. +1 (555) 234-5678">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Company / Organization</label>
                            <input type="text" name="company" class="form-control rounded-3" value="{{ old('company') }}" placeholder="e.g. Global Agro Imports LLC">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Destination Port & Shipping -->
                <div class="card border-0 rounded-4 shadow-sm bg-white p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom">
                        <i class="bi bi-geo-alt me-2 text-success"></i>2. Delivery &amp; Discharge Location
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Destination Country *</label>
                            <input type="text" name="country" class="form-control rounded-3" value="{{ old('country') }}" required placeholder="e.g. Netherlands / Germany / UAE / Egypt">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Destination Discharge Port / Terminal *</label>
                            <input type="text" name="shipping_address" class="form-control rounded-3" value="{{ old('shipping_address') }}" required placeholder="e.g. Port of Rotterdam / Hamburg / Jebel Ali">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark">Order Notes / Contract Instructions (Optional)</label>
                            <textarea name="notes" class="form-control rounded-3" rows="2" placeholder="Specify packaging preference (bulk vessel, 50kg bags), desired shipping month, or inspection notes...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Payment Method -->
                <div class="card border-0 rounded-4 shadow-sm bg-white p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom">
                        <i class="bi bi-credit-card me-2 text-success"></i>3. Settlement Method
                    </h5>

                    <div class="d-flex flex-column gap-2.5">
                        <label class="card border rounded-3 p-3 cursor-pointer d-flex align-items-center gap-3 hover-bg-light">
                            <input class="form-check-input mt-0" type="radio" name="payment_method" value="escrow" {{ old('payment_method', 'escrow') === 'escrow' ? 'checked' : '' }} required>
                            <div>
                                <div class="fw-bold text-dark d-flex align-items-center gap-2">
                                    <span>Escrow Verified Settlement</span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill py-0.5 px-2 small">Recommended</span>
                                </div>
                                <small class="text-muted d-block">Zero risk. Funds held in neutral custodian escrow until Bill of Lading (BL) &amp; SGS inspection are verified.</small>
                            </div>
                        </label>

                        <label class="card border rounded-3 p-3 cursor-pointer d-flex align-items-center gap-3 hover-bg-light">
                            <input class="form-check-input mt-0" type="radio" name="payment_method" value="wire" {{ old('payment_method') === 'wire' ? 'checked' : '' }}>
                            <div>
                                <div class="fw-bold text-dark">International Bank Wire (SWIFT Transfer)</div>
                                <small class="text-muted d-block">Direct USD / EUR wire to certified Banco do Brasil / Itaú BBA corporate exporter account.</small>
                            </div>
                        </label>

                        <label class="card border rounded-3 p-3 cursor-pointer d-flex align-items-center gap-3 hover-bg-light">
                            <input class="form-check-input mt-0" type="radio" name="payment_method" value="letter_of_credit" {{ old('payment_method') === 'letter_of_credit' ? 'checked' : '' }}>
                            <div>
                                <div class="fw-bold text-dark">Irrevocable Letter of Credit (LC at Sight)</div>
                                <small class="text-muted d-block">Issued by top 50 international prime banks against standard shipping document presentation.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="col-lg-5">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-4 sticky-top" style="top: 90px;">
                    <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom">Order Summary</h5>

                    <!-- Items list -->
                    <div class="mb-3 d-flex flex-column gap-2" style="max-height: 280px; overflow-y: auto;">
                        @foreach($items as $item)
                            @php
                                $img = $item->image ? (Str::startsWith($item->image, 'http') ? $item->image : asset($item->image)) : asset('img/service-1.jpg');
                            @endphp
                            <div class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light border">
                                <div class="d-flex align-items-center gap-2 min-w-0">
                                    <img src="{{ $img }}" alt="{{ $item->name }}" class="rounded-2 object-fit-cover" style="width: 44px; height: 44px;">
                                    <div class="min-w-0">
                                        <h6 class="text-dark fw-bold mb-0 text-truncate" style="font-size: 0.85rem;" title="{{ $item->name }}">{{ $item->name }}</h6>
                                        <small class="text-muted">{{ $item->quantity }} {{ $item->unit }}(s) × ${{ number_format($item->price, 2) }}</small>
                                    </div>
                                </div>
                                <span class="fw-bold text-dark ms-2" style="font-size: 0.9rem;">${{ number_format($item->line_total, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <ul class="list-group list-group-flush small mb-3">
                        <li class="list-group-item d-flex justify-content-between px-0 py-2 border-0">
                            <span class="text-muted">Subtotal ({{ $items->sum('quantity') }} units)</span>
                            <span class="fw-bold text-dark">${{ number_format($subtotal, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 py-2 border-0">
                            <span class="text-muted">Escrow Custody Fee</span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">FREE (PROMO)</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 py-3 border-top mt-2">
                            <span class="fs-6 fw-bold text-dark">Order Total (USD)</span>
                            <span class="fs-3 fw-black text-success fw-bold">${{ number_format($subtotal, 2) }}</span>
                        </li>
                    </ul>

                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill fw-bold text-dark shadow-sm py-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-shield-check fs-5"></i>
                            <span>Place Binding Export Order</span>
                        </button>
                    </div>

                    <div class="p-3 bg-light rounded-3 border small text-muted">
                        <div class="d-flex align-items-center gap-1.5 text-success fw-bold mb-1">
                            <i class="bi bi-lock-fill"></i>
                            <span>Institutional Export Security</span>
                        </div>
                        <p class="mb-0" style="font-size: 0.76rem;">
                            By clicking place order, an institutional purchase agreement is generated. A formal Proforma Invoice and escrow escrow deposit instructions will be transmitted immediately.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
