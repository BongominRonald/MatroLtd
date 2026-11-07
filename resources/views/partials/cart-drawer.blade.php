<!-- Slide-Out Offcanvas Cart Drawer -->
<div class="offcanvas offcanvas-end text-bg-dark border-start border-secondary" tabindex="-1" id="cartDrawer" aria-labelledby="cartDrawerLabel" style="width: 420px; max-width: 92vw;">
    <div class="offcanvas-header border-bottom border-secondary py-3 px-4">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-bag-check-fill text-success fs-5"></i>
            <h5 class="offcanvas-title text-white fw-bold mb-0" id="cartDrawerLabel">Shopping Cart</h5>
            <span class="badge bg-success text-dark fw-bold rounded-pill cart-badge-count ms-1">
                {{ collect(session('cart', []))->sum('quantity') }}
            </span>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Drawer Body -->
    <div class="offcanvas-body p-0 d-flex flex-column justify-content-between" style="overflow-y: auto;">
        <!-- Loading Indicator -->
        <div id="cartDrawerLoading" class="text-center py-5 d-none">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-muted small mt-2">Updating cart...</p>
        </div>

        <!-- Items Container -->
        <div id="cartDrawerItemsList" class="p-3">
            <!-- Will be populated dynamically via AJAX or server rendered on initial load -->
        </div>

        <!-- Empty Cart Notice -->
        <div id="cartDrawerEmpty" class="text-center py-5 px-4 my-auto d-none">
            <div class="rounded-circle bg-dark-subtle d-inline-flex align-items-center justify-content-center p-4 mb-3 border border-secondary">
                <i class="bi bi-cart-x fs-1 text-secondary"></i>
            </div>
            <h6 class="fw-bold text-white mb-2">Your Cart is Empty</h6>
            <p class="text-muted small mb-4">You haven't added any Brazilian agro commodities to your cart yet.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-success btn-sm rounded-pill px-4 fw-bold text-dark" data-bs-dismiss="offcanvas">
                Browse Agricultural Catalog
            </a>
        </div>
    </div>

    <!-- Drawer Footer -->
    <div class="offcanvas-footer border-top border-secondary p-4 bg-dark" id="cartDrawerFooter">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="text-white-50 small">Subtotal</span>
            <span class="fs-5 fw-bold text-white" id="cartDrawerSubtotal">$0.00</span>
        </div>
        <div class="d-flex align-items-center gap-1.5 text-success small mb-3">
            <i class="bi bi-shield-lock-fill"></i>
            <span style="font-size: 0.78rem;">Settlement protected by international escrow</span>
        </div>
        <div class="d-grid gap-2">
            <a href="{{ route('checkout.index') }}" class="btn btn-success rounded-pill py-2.5 fw-bold text-dark shadow-sm d-flex align-items-center justify-content-center gap-2" id="cartDrawerCheckoutBtn">
                <span>Proceed to Checkout</span>
                <i class="bi bi-arrow-right"></i>
            </a>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-light rounded-pill py-2 small fw-semibold text-center">
                View Full Cart
            </a>
        </div>
    </div>
</div>
