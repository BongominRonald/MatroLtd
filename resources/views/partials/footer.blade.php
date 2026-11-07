<!-- Main Storefront Footer -->
<footer class="matro-footer text-white pt-5 pb-4" style="background: #090d16; border-top: 1px solid rgba(255,255,255,0.08);">
    <div class="container">
        <!-- Top Row: Newsletter / Subscription -->
        <div class="row align-items-center justify-content-between p-4 rounded-4 mb-5 g-4" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(15, 23, 42, 0.8)); border: 1px solid rgba(16, 185, 129, 0.25);">
            <div class="col-lg-6">
                <span class="badge bg-success text-dark fw-bold rounded-pill mb-2 px-3 py-1">COMMODITY MARKET INTELLIGENCE</span>
                <h4 class="fw-bold text-white mb-1">Stay Ahead of Brazilian Harvest Prices</h4>
                <p class="text-white-50 small mb-0">Receive weekly FOB Santos and Paranaguá price indexes, harvest updates, and export volume reports.</p>
            </div>
            <div class="col-lg-5">
                <form onsubmit="event.preventDefault(); alert('Thank you! You are subscribed to weekly Matro export market bulletins.'); this.reset();" class="d-flex gap-2">
                    <input type="email" class="form-control bg-dark text-white border-secondary rounded-pill px-3 py-2" placeholder="Enter corporate email..." required style="font-size: 0.9rem;">
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold text-dark text-nowrap shadow-sm">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <!-- Middle Columns: Links & Info -->
        <div class="row g-4 mb-5">
            <!-- Col 1: About & Identity -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="d-inline-flex align-items-center justify-content-center bg-gradient rounded-3 text-white shadow-sm" style="width: 36px; height: 36px; background: linear-gradient(135deg, #10b981, #059669);">
                        <i class="bi bi-flower1 fs-5"></i>
                    </span>
                    <span class="fs-4 fw-bold text-white lh-1">MATRO</span>
                </div>
                <p class="text-white-50 small lh-base mb-3">
                    Matro is Brazil's premier digital export marketplace for verified agricultural commodities. We bridge certified producers across Mato Grosso, São Paulo, Goiás, and Paraná directly with international importers and wholesale buyers.
                </p>
                <div class="d-flex align-items-center gap-2 text-white-50 small">
                    <i class="bi bi-geo-alt-fill text-success"></i>
                    <span>Av. Paulista, 1106 — Bela Vista, São Paulo, Brazil</span>
                </div>
                <div class="d-flex align-items-center gap-2 text-white-50 small mt-1">
                    <i class="bi bi-envelope-fill text-success"></i>
                    <span>trade@matro.com.br</span>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white fw-bold mb-3 text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Store Navigation</h6>
                <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                    <li><a href="{{ route('home') }}" class="text-white-50 text-decoration-none hover-white">Home Page</a></li>
                    <li><a href="{{ route('shop.index') }}" class="text-white-50 text-decoration-none hover-white">Product Catalog</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-white-50 text-decoration-none hover-white">Shopping Cart</a></li>
                    <li><a href="{{ route('checkout.index') }}" class="text-white-50 text-decoration-none hover-white">Secure Checkout</a></li>
                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#inquiryModal" class="text-white-50 text-decoration-none hover-white">Request Bulk Quote (RFQ)</a></li>
                    <li><a href="{{ route('login') }}" class="text-white-50 text-decoration-none hover-white">Buyer Login</a></li>
                </ul>
            </div>

            <!-- Col 3: Export Categories -->
            <div class="col-lg-3 col-md-6">
                <h6 class="text-white fw-bold mb-3 text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Export Categories</h6>
                <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                    <li><a href="{{ route('shop.index', ['category' => 'grains-rice']) }}" class="text-white-50 text-decoration-none hover-white">Non-GMO Soybeans &amp; Maize</a></li>
                    <li><a href="{{ route('shop.index', ['category' => 'oil-sugar']) }}" class="text-white-50 text-decoration-none hover-white">ICUMSA 45 Cane Sugar</a></li>
                    <li><a href="{{ route('shop.index', ['category' => 'lentils-pulses']) }}" class="text-white-50 text-decoration-none hover-white">Brazilian Black &amp; Carioca Beans</a></li>
                    <li><a href="{{ route('shop.index', ['category' => 'spices-specialty']) }}" class="text-white-50 text-decoration-none hover-white">Specialty Arabica Green Coffee</a></li>
                    <li><a href="{{ route('shop.index', ['category' => 'nuts-seeds']) }}" class="text-white-50 text-decoration-none hover-white">Export Brazil Nuts &amp; Sesame</a></li>
                    <li><a href="{{ route('shop.index', ['category' => 'juices-drinks']) }}" class="text-white-50 text-decoration-none hover-white">Frozen Orange Juice (FCOJ)</a></li>
                </ul>
            </div>

            <!-- Col 4: Trust & Verification Badges -->
            <div class="col-lg-3 col-md-6">
                <h6 class="text-white fw-bold mb-3 text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Export Compliance</h6>
                <p class="text-white-50 small mb-3">All shipments undergo rigorous third-party inspection and mandatory Brazilian Ministry of Agriculture (MAPA) clearance.</p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-dark border border-secondary text-white-75 p-2 small"><i class="bi bi-shield-check text-success me-1"></i>SGS Tested</span>
                    <span class="badge bg-dark border border-secondary text-white-75 p-2 small"><i class="bi bi-patch-check text-warning me-1"></i>Phytosanitary Cert</span>
                    <span class="badge bg-dark border border-secondary text-white-75 p-2 small"><i class="bi bi-lock text-info me-1"></i>Escrow Protected</span>
                    <span class="badge bg-dark border border-secondary text-white-75 p-2 small"><i class="bi bi-check2-circle text-primary me-1"></i>MAPA / Brazil Gov</span>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright -->
        <div class="pt-4 border-top border-secondary border-opacity-25 d-flex flex-wrap justify-content-between align-items-center gap-2 small text-white-50">
            <div>
                &copy; {{ date('Y') }} <strong>Matro Ltd.</strong> All rights reserved. Brazilian Agro-Commodity Export Network.
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}#trust-features" class="text-white-50 text-decoration-none hover-white">Security &amp; Escrow</a>
                <span>•</span>
                <a href="{{ route('home') }}#catalog" class="text-white-50 text-decoration-none hover-white">Product Standards</a>
                <span>•</span>
                <a href="https://wa.me/5511952987545" target="_blank" class="text-white-50 text-decoration-none hover-white">Trade Desk</a>
            </div>
        </div>
    </div>
</footer>
