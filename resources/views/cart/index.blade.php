@extends('layouts.public')

@section('title', 'Shopping Cart — Matro Store')

@section('content')
<div class="py-4 bg-dark text-white border-bottom border-secondary border-opacity-50">
    <div class="container">
        <h2 class="fw-bold text-white mb-0">Your Shopping Cart</h2>
        <small class="text-white-50">Review commodities and volumes before proceeding to escrow checkout</small>
    </div>
</div>

<div class="container py-5">
    @if(session('status'))
        <div class="alert alert-success border-success rounded-4 mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
            <div>{{ session('status') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger rounded-4 mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    @if($items->isNotEmpty())
        <div class="row g-4">
            <!-- Items Table Column -->
            <div class="col-lg-8">
                <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4">
                    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
                        <h6 class="fw-bold text-dark mb-0"><i class="bi bi-bag-check me-2 text-success"></i>Cart Items ({{ $count }})</h6>
                        <form action="{{ route('cart.clear') }}" method="POST" class="m-0" onsubmit="return confirm('Clear all items from your cart?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                <i class="bi bi-trash3 me-1"></i>Clear Cart
                            </button>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small text-uppercase text-muted">
                                <tr>
                                    <th class="ps-4" style="width: 45%;">Commodity</th>
                                    <th>Price / Unit</th>
                                    <th style="width: 18%;">Quantity</th>
                                    <th>Subtotal</th>
                                    <th class="text-end pe-4">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    @php
                                        $img = $item->image ? (Str::startsWith($item->image, 'http') ? $item->image : asset($item->image)) : asset('img/service-1.jpg');
                                    @endphp
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ $img }}" alt="{{ $item->name }}" class="rounded-3 object-fit-cover border" style="width: 60px; height: 60px;">
                                                <div>
                                                    <h6 class="fw-bold text-dark mb-0 lh-snug">
                                                        <a href="{{ route('shop.show', $item->product) }}" class="text-dark text-decoration-none hover-success">
                                                            {{ $item->name }}
                                                        </a>
                                                    </h6>
                                                    <small class="text-muted">{{ $item->category_name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $item->price_formatted }}</div>
                                            <small class="text-muted">per {{ $item->unit }}</small>
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.update', $item->product) }}" method="POST" class="d-flex align-items-center gap-1">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity" class="form-control form-control-sm text-center fw-bold rounded-pill" value="{{ $item->quantity }}" min="1" max="{{ $item->stock }}" style="width: 70px;">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 28px; height: 28px;" title="Update Quantity">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success fs-6">{{ $item->line_total_formatted }}</span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <form action="{{ route('cart.remove', $item->product) }}" method="POST" class="d-inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle d-inline-flex align-items-center justify-content-center p-0" style="width: 32px; height: 32px;" title="Remove Item">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-semibold">
                        <i class="bi bi-arrow-left me-1"></i>Continue Shopping
                    </a>
                    <button type="button" class="btn btn-outline-success rounded-pill px-4 fw-semibold" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                        <i class="bi bi-chat-left-text me-1"></i>Trade Desk Assistance
                    </button>
                </div>
            </div>

            <!-- Order Summary Column -->
            <div class="col-lg-4">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-4 sticky-top" style="top: 90px;">
                    <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom">Order Summary</h5>

                    <ul class="list-group list-group-flush small mb-3">
                        <li class="list-group-item d-flex justify-content-between px-0 py-2 border-0">
                            <span class="text-muted">Total Commodities (Units)</span>
                            <span class="fw-bold text-dark">{{ $count }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 py-2 border-0">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-bold text-dark">${{ number_format($subtotal, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 py-2 border-0">
                            <span class="text-muted">Escrow Custody Fee</span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">FREE (PROMO)</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 py-2 border-0">
                            <span class="text-muted">Port Discharge Freight</span>
                            <span class="text-muted fst-italic">Calculated at checkout</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 py-3 border-top mt-2">
                            <span class="fs-6 fw-bold text-dark">Estimated Total</span>
                            <span class="fs-4 fw-bold text-success">${{ number_format($subtotal, 2) }}</span>
                        </li>
                    </ul>

                    <div class="d-grid gap-2 mb-3">
                        <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg rounded-pill fw-bold text-dark shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <span>Proceed to Escrow Checkout</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    <div class="p-3 bg-light rounded-3 border text-muted small">
                        <div class="d-flex align-items-center gap-1.5 text-success fw-bold mb-1">
                            <i class="bi bi-shield-lock-fill"></i>
                            <span>Zero Risk Settlement</span>
                        </div>
                        <p class="mb-0" style="font-size: 0.76rem;">
                            Your purchase order is placed under legal contract. Funds are safeguarded in escrow until SGS pre-shipment inspection is cleared and Bill of Lading is confirmed.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart State -->
        <div class="card border-0 rounded-4 shadow-sm bg-white p-5 text-center my-4">
            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-4 mb-3 border mx-auto">
                <i class="bi bi-cart-x fs-1 text-secondary"></i>
            </div>
            <h4 class="fw-bold text-dark mb-2">Your Shopping Cart is Empty</h4>
            <p class="text-muted small mb-4" style="max-width: 480px; margin: 0 auto;">
                You haven't added any Brazilian commodities yet. Explore our verified lots of Non-GMO Soybeans, ICUMSA 45 Sugar, Maize, Coffee, and Pulses.
            </p>
            <div>
                <a href="{{ route('shop.index') }}" class="btn btn-success btn-lg rounded-pill px-5 fw-bold text-dark shadow-sm">
                    Browse Agricultural Catalog
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
