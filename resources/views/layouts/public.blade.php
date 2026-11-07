<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Matro — Brazilian Agro-Commodity Export & Online Store')</title>
    <meta name="description" content="@yield('meta-description', 'Direct sourcing of export-grade Brazilian soybeans, sugar, lentils, and specialty agro-commodities with escrow-backed settlement.')">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Core Matro Storefront Styles -->
    <style>
        :root {
            --matro-primary: #10b981;
            --matro-primary-dark: #059669;
            --matro-accent: #f59e0b;
            --matro-dark: #0f172a;
            --matro-darker: #090d16;
            --matro-surface: #1e293b;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            color: #1e293b;
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, .brand-font {
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -0.02em;
        }

        /* Hover helpers */
        .hover-white:hover { color: #fff !important; }
        .hover-success:hover { color: var(--matro-primary) !important; }
        .hover-opacity:hover { opacity: 0.85; }
        .transition-transform { transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .transition-colors { transition: color 0.2s ease, background-color 0.2s ease; }

        /* Product Card */
        .matro-product-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
        }
        .matro-product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px -6px rgba(15, 23, 42, 0.12), 0 4px 10px -2px rgba(15, 23, 42, 0.05) !important;
            border-color: rgba(16, 185, 129, 0.3) !important;
        }
        .matro-product-card:hover .matro-product-img-wrap img {
            transform: scale(1.06);
        }

        /* Animated Cart Badge */
        .cart-badge-pop {
            animation: cartPop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes cartPop {
            0% { transform: scale(1); }
            50% { transform: scale(1.4); }
            100% { transform: scale(1); }
        }

        /* Toast notifications */
        .matro-toast-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1080;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Header Navigation -->
    @include('partials.navbar')

    <!-- Main Storefront Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Slide-Out Cart Drawer -->
    @include('partials.cart-drawer')

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white border-0 py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-success text-dark fw-bold rounded-pill" id="qvCategory">Category</span>
                        <h5 class="modal-title text-white fw-bold mb-0" id="quickViewLabel">Product Quick View</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 overflow-hidden text-center p-3 border">
                                <img id="qvImage" src="" alt="Product" class="img-fluid rounded-3" style="max-height: 280px; object-fit: contain;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1" id="qvStock">In Stock</span>
                                <small class="text-muted"><i class="bi bi-geo-alt-fill text-warning me-1"></i><span id="qvOrigin">Brazil</span></small>
                            </div>
                            <h4 class="fw-bold text-dark mb-2" id="qvTitle">Product Name</h4>
                            <div class="mb-3">
                                <span class="fs-3 fw-black text-dark fw-bold" id="qvPrice">$0.00</span>
                                <span class="text-muted small" id="qvUnit">per Metric Ton</span>
                            </div>
                            <p class="text-muted small lh-base mb-4" id="qvDesc">Description text goes here.</p>

                            <form id="qvAddToCartForm" class="d-flex align-items-center gap-2 mb-3">
                                <div class="input-group" style="width: 130px;">
                                    <button class="btn btn-outline-secondary" type="button" id="qvQtyMinus">-</button>
                                    <input type="number" class="form-control text-center" id="qvQtyInput" value="1" min="1" max="500">
                                    <button class="btn btn-outline-secondary" type="button" id="qvQtyPlus">+</button>
                                </div>
                                <button type="submit" class="btn btn-success fw-bold text-dark rounded-pill px-4 flex-grow-1 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-bag-plus-fill"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </form>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <a href="#" id="qvFullDetailsBtn" class="text-success text-decoration-none small fw-bold">
                                    View Full Specifications <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                                    <i class="bi bi-chat-left-dots me-1"></i>Inquire Bulk
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trade Desk / RFQ Inquiry Modal -->
    <div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white border-bottom border-secondary py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center justify-content-center bg-success text-dark rounded-circle" style="width: 28px; height: 28px;">
                            <i class="bi bi-file-earmark-text-fill"></i>
                        </span>
                        <div>
                            <h5 class="modal-title text-white fw-bold mb-0" id="inquiryModalLabel">Trade Desk — Request For Quote (RFQ)</h5>
                            <small class="text-white-50">Direct corporate trade inquiries, wholesale contracts, and grower supply agreements</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div id="inquiryModalAlert" class="d-none"></div>

                    <form id="globalInquiryForm" action="{{ route('inquiries.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Full Contact Name *</label>
                                <input type="text" name="name" class="form-control rounded-3" placeholder="e.g. David Weber" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Corporate Email *</label>
                                <input type="email" name="email" class="form-control rounded-3" placeholder="e.g. d.weber@graincorp.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Phone / WhatsApp</label>
                                <input type="tel" name="phone" class="form-control rounded-3" placeholder="+1 (555) 019-2834">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Company / Organization</label>
                                <input type="text" name="company" class="form-control rounded-3" placeholder="e.g. Global Foods Trading AG">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Destination Country / Discharge Port</label>
                                <input type="text" name="country" class="form-control rounded-3" placeholder="e.g. Rotterdam, Netherlands / Hamburg">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Your Trade Role</label>
                                <select name="role" class="form-select rounded-3">
                                    <option value="buyer" selected>Importer / Wholesale Buyer</option>
                                    <option value="partner">Logistics / Freight / Finance Partner</option>
                                    <option value="grower">Agricultural Grower / Farm Supplier</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-dark">Commodity Requirement &amp; Volume Target</label>
                                <input type="text" name="buyer_detail" class="form-control rounded-3" placeholder="e.g. 5,000 MT ICUMSA 45 Cane Sugar, CIF Rotterdam, Q1 Shipment">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-dark">Additional Specifications or Questions</label>
                                <textarea name="message" class="form-control rounded-3" rows="3" placeholder="Provide desired packaging, target delivery schedule, and payment preference (Escrow, LC, Wire)..."></textarea>
                            </div>
                            <div class="col-12 text-end pt-2">
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold text-dark shadow-sm" id="inquirySubmitBtn">
                                    <span>Transmit RFQ to Trade Desk</span>
                                    <i class="bi bi-send-fill ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Live Toast Container -->
    <div class="matro-toast-container">
        <div id="liveMatroToast" class="toast align-items-center text-bg-dark border-secondary shadow-lg rounded-4" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex align-items-center p-3">
                <div class="fs-4 text-success me-3" id="toastIcon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="toast-body p-0 flex-grow-1">
                    <strong class="d-block text-white" id="toastTitle">Notification</strong>
                    <small class="text-white-50" id="toastMessage">Action completed successfully.</small>
                </div>
                <button type="button" class="btn-close btn-close-white ms-3 me-1" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Global Cart & Storefront Client Scripts -->
    <script>
        (function () {
            "use strict";

            var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // Global Toast Helper
            window.showMatroToast = function (title, message, isSuccess = true) {
                var toastEl = document.getElementById('liveMatroToast');
                if (!toastEl) return;
                document.getElementById('toastTitle').textContent = title;
                document.getElementById('toastMessage').textContent = message;
                var iconEl = document.getElementById('toastIcon');
                iconEl.className = isSuccess ? 'fs-4 text-success me-3' : 'fs-4 text-danger me-3';
                iconEl.innerHTML = isSuccess ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-exclamation-triangle-fill"></i>';

                var toast = new bootstrap.Toast(toastEl, { delay: 4000 });
                toast.show();
            };

            // Update badge counts across all cart badges
            function updateCartBadges(count) {
                document.querySelectorAll('.cart-badge-count').forEach(function (el) {
                    el.textContent = count;
                    el.classList.add('cart-badge-pop');
                    setTimeout(function () { el.classList.remove('cart-badge-pop'); }, 400);
                });
            }

            // Render Drawer Line Items
            function renderDrawerItems(items, subtotalFormatted) {
                var container = document.getElementById('cartDrawerItemsList');
                var emptyContainer = document.getElementById('cartDrawerEmpty');
                var footer = document.getElementById('cartDrawerFooter');
                var subtotalEl = document.getElementById('cartDrawerSubtotal');

                if (subtotalEl) subtotalEl.textContent = subtotalFormatted || '$0.00';

                if (!items || items.length === 0) {
                    if (container) container.innerHTML = '';
                    if (emptyContainer) emptyContainer.classList.remove('d-none');
                    if (footer) footer.classList.add('d-none');
                    return;
                }

                if (emptyContainer) emptyContainer.classList.add('d-none');
                if (footer) footer.classList.remove('d-none');

                var html = '';
                items.forEach(function (item) {
                    html += `
                        <div class="d-flex align-items-center gap-3 p-2.5 mb-2.5 rounded-3 bg-dark border border-secondary border-opacity-50">
                            <img src="${item.image ? (item.image.startsWith('http') ? item.image : '/' + item.image) : '/img/service-1.jpg'}" alt="${item.name}" class="rounded-2 object-fit-cover" style="width: 54px; height: 54px;">
                            <div class="flex-grow-1 min-w-0">
                                <h6 class="text-white text-truncate mb-0 fw-bold" style="font-size: 0.88rem;" title="${item.name}">${item.name}</h6>
                                <small class="text-white-50 d-block" style="font-size: 0.78rem;">${item.price_formatted} / ${item.unit}</small>
                                <div class="d-flex align-items-center gap-2 mt-1">
                                    <div class="btn-group btn-group-sm border border-secondary rounded-pill overflow-hidden" role="group">
                                        <button type="button" class="btn btn-dark text-white px-2 py-0 drawer-qty-btn" data-product-id="${item.id}" data-change="-1">-</button>
                                        <span class="btn btn-dark text-white px-2 py-0 fw-bold disabled" style="font-size: 0.8rem;">${item.quantity}</span>
                                        <button type="button" class="btn btn-dark text-white px-2 py-0 drawer-qty-btn" data-product-id="${item.id}" data-change="1">+</button>
                                    </div>
                                    <small class="text-success fw-bold ms-auto" style="font-size: 0.85rem;">${item.line_total_formatted}</small>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-danger btn-sm rounded-circle p-0 drawer-remove-btn d-flex align-items-center justify-content-center" data-product-id="${item.id}" style="width: 28px; height: 28px;" title="Remove">
                                <i class="bi bi-trash3" style="font-size: 0.75rem;"></i>
                            </button>
                        </div>
                    `;
                });

                if (container) container.innerHTML = html;
            }

            // Fetch Drawer Contents
            window.refreshCartDrawer = function (openAfter = false) {
                var loading = document.getElementById('cartDrawerLoading');
                if (loading) loading.classList.remove('d-none');

                fetch('/cart/drawer', {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    if (loading) loading.classList.add('d-none');
                    updateCartBadges(data.cart_count);
                    renderDrawerItems(data.items, data.cart_subtotal_formatted);

                    if (openAfter) {
                        var drawerEl = document.getElementById('cartDrawer');
                        if (drawerEl) {
                            var offcanvas = bootstrap.Offcanvas.getOrCreateInstance(drawerEl);
                            offcanvas.show();
                        }
                    }
                })
                .catch(function (err) {
                    if (loading) loading.classList.add('d-none');
                    console.error('Failed to load cart drawer:', err);
                });
            };

            // Open Cart Drawer Triggers
            document.querySelectorAll('.cart-drawer-trigger').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    window.refreshCartDrawer(true);
                });
            });

            // AJAX Add-to-Cart Buttons on Product Cards
            document.addEventListener('click', function (e) {
                var btn = e.target.closest('.ajax-add-to-cart');
                if (!btn) return;
                e.preventDefault();

                var url = btn.getAttribute('data-add-url');
                var originalHtml = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Adding...';

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ quantity: 1 })
                })
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;

                    if (data.status === 'success') {
                        updateCartBadges(data.cart_count);
                        window.showMatroToast('Item Added', data.message, true);
                        renderDrawerItems(data.items, data.cart_subtotal_formatted);
                        // Open drawer
                        var drawerEl = document.getElementById('cartDrawer');
                        if (drawerEl) {
                            bootstrap.Offcanvas.getOrCreateInstance(drawerEl).show();
                        }
                    } else {
                        window.showMatroToast('Stock Notice', data.message || 'Could not add to cart', false);
                    }
                })
                .catch(function (err) {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                    window.showMatroToast('Error', 'Failed to communicate with cart.', false);
                });
            });

            // Drawer Quantity +/- and Delete Handlers
            document.addEventListener('click', function (e) {
                var qtyBtn = e.target.closest('.drawer-qty-btn');
                if (qtyBtn) {
                    var productId = qtyBtn.getAttribute('data-product-id');
                    var change = parseInt(qtyBtn.getAttribute('data-change'), 10);
                    // Determine current qty from sibling span
                    var currentQty = parseInt(qtyBtn.parentElement.querySelector('span').textContent, 10);
                    var newQty = currentQty + change;

                    fetch('/cart/' + productId, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ quantity: newQty })
                    })
                    .then(function (res) { return res.json(); })
                    .then(function (data) {
                        updateCartBadges(data.cart_count);
                        renderDrawerItems(data.items, data.cart_subtotal_formatted);
                    });
                    return;
                }

                var removeBtn = e.target.closest('.drawer-remove-btn');
                if (removeBtn) {
                    var prodId = removeBtn.getAttribute('data-product-id');
                    fetch('/cart/' + prodId, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(function (res) { return res.json(); })
                    .then(function (data) {
                        updateCartBadges(data.cart_count);
                        renderDrawerItems(data.items, data.cart_subtotal_formatted);
                        window.showMatroToast('Cart Updated', data.message, true);
                    });
                }
            });

            // Quick View Modal Data Binding
            var qvAddUrl = '';
            document.addEventListener('click', function (e) {
                var btn = e.target.closest('.quick-view-btn');
                if (!btn) return;

                document.getElementById('qvTitle').textContent = btn.getAttribute('data-name');
                document.getElementById('qvCategory').textContent = btn.getAttribute('data-category');
                document.getElementById('qvPrice').textContent = btn.getAttribute('data-price');
                document.getElementById('qvUnit').textContent = 'per ' + btn.getAttribute('data-unit');
                document.getElementById('qvOrigin').textContent = btn.getAttribute('data-origin');
                document.getElementById('qvDesc').textContent = btn.getAttribute('data-desc') || 'Export-grade standard compliant.';
                document.getElementById('qvImage').src = btn.getAttribute('data-image');
                document.getElementById('qvFullDetailsBtn').href = btn.getAttribute('data-url');
                document.getElementById('qvQtyInput').value = 1;
                qvAddUrl = btn.getAttribute('data-add-url');
            });

            // Quick View Quantity +/-
            var qvMinus = document.getElementById('qvQtyMinus');
            var qvPlus = document.getElementById('qvQtyPlus');
            var qvInput = document.getElementById('qvQtyInput');
            if (qvMinus && qvPlus && qvInput) {
                qvMinus.addEventListener('click', function () {
                    var val = parseInt(qvInput.value, 10) || 1;
                    if (val > 1) qvInput.value = val - 1;
                });
                qvPlus.addEventListener('click', function () {
                    var val = parseInt(qvInput.value, 10) || 1;
                    qvInput.value = val + 1;
                });
            }

            // Quick View Add to Cart Form
            var qvForm = document.getElementById('qvAddToCartForm');
            if (qvForm) {
                qvForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    if (!qvAddUrl) return;

                    var qty = parseInt(qvInput.value, 10) || 1;
                    var submitBtn = qvForm.querySelector('button[type="submit"]');
                    var origHtml = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Adding...';

                    fetch(qvAddUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ quantity: qty })
                    })
                    .then(function (res) { return res.json(); })
                    .then(function (data) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = origHtml;
                        // Close Quick View modal
                        var qvModalEl = document.getElementById('quickViewModal');
                        if (qvModalEl) bootstrap.Modal.getInstance(qvModalEl)?.hide();

                        if (data.status === 'success') {
                            updateCartBadges(data.cart_count);
                            window.showMatroToast('Item Added', data.message, true);
                            renderDrawerItems(data.items, data.cart_subtotal_formatted);
                            // Open cart drawer
                            var drawerEl = document.getElementById('cartDrawer');
                            if (drawerEl) bootstrap.Offcanvas.getOrCreateInstance(drawerEl).show();
                        } else {
                            window.showMatroToast('Stock Notice', data.message, false);
                        }
                    })
                    .catch(function () {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = origHtml;
                    });
                });
            }

            // Global Inquiry Form (Modal)
            var inquiryForm = document.getElementById('globalInquiryForm');
            if (inquiryForm) {
                inquiryForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    var alertBox = document.getElementById('inquiryModalAlert');
                    var submitBtn = document.getElementById('inquirySubmitBtn');
                    var origText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Transmitting...';

                    var formData = new FormData(inquiryForm);

                    fetch(inquiryForm.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    })
                    .then(function (res) { return res.json(); })
                    .then(function (data) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = origText;

                        if (data.success) {
                            alertBox.className = 'alert alert-success border-success rounded-3 mb-3';
                            alertBox.innerHTML = `<strong>RFQ Logged!</strong> Reference: <code>${data.reference}</code>. Our Brazilian Trade Desk will contact you with indicative pricing shortly.`;
                            alertBox.classList.remove('d-none');
                            inquiryForm.reset();
                            window.showMatroToast('RFQ Received', 'Reference: ' + data.reference, true);
                        } else {
                            alertBox.className = 'alert alert-danger rounded-3 mb-3';
                            alertBox.textContent = data.message || 'Please check your inputs and try again.';
                            alertBox.classList.remove('d-none');
                        }
                    })
                    .catch(function () {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = origText;
                        alertBox.className = 'alert alert-danger rounded-3 mb-3';
                        alertBox.textContent = 'Network communication failure. Please try again.';
                        alertBox.classList.remove('d-none');
                    });
                });
            }

            // Initial drawer populate on load
            window.refreshCartDrawer(false);
        })();
    </script>

    @stack('scripts')
</body>
</html>
