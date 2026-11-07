@extends('layouts.public')

@section('title', 'Matro — Brazilian Agro-Commodity Export & Online Store')
@section('meta-description', 'Direct sourcing of export-grade Brazilian soybeans, sugar, lentils, and specialty agro-commodities with escrow-backed settlement.')

@section('content')

{{-- ==================== 1. HERO SECTION ==================== --}}
<section class="matro-hero position-relative py-5 overflow-hidden text-white" style="background: linear-gradient(135deg, #090d16 0%, #0f172a 50%, #064e3b 100%); min-height: 85vh; display: flex; align-items: center;">
    <!-- Background Texture Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25" style="background-image: radial-gradient(rgba(16, 185, 129, 0.25) 1px, transparent 1px); background-size: 28px 28px; pointer-events: none;"></div>

    <div class="container position-relative py-lg-4" style="z-index: 2;">
        <div class="row align-items-center g-5">
            <!-- Left Hero Text -->
            <div class="col-lg-7">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-dark border border-success border-opacity-50 mb-3 shadow-sm">
                    <span class="p-1 bg-success rounded-circle animate-pulse"></span>
                    <span class="text-success fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1.5px;">Direct From Brazilian Basins</span>
                </div>

                <h1 class="display-4 fw-black text-white mb-3 lh-tight" style="font-weight: 800; font-size: clamp(2.3rem, 5vw, 3.8rem);">
                    Verified Brazilian Agro-Commodities. <span style="background: linear-gradient(135deg, #10b981, #34d399, #f59e0b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Global Delivery.</span>
                </h1>

                <p class="lead text-white-50 mb-4 fs-5" style="max-width: 600px; line-height: 1.6;">
                    Source certified Non-GMO Soybeans, ICUMSA 45 Cane Sugar, Yellow Maize, and specialty pulses directly from Brazilian growers with escrow-backed contract security.
                </p>

                <!-- Action CTAs -->
                <div class="d-flex flex-wrap gap-3 mb-5">
                    <a href="{{ route('shop.index') }}" class="btn btn-success btn-lg rounded-pill px-4 py-3 fw-bold text-dark shadow-lg d-inline-flex align-items-center gap-2 hover-opacity" style="background: #10b981; border: none;">
                        <i class="bi bi-grid-fill"></i>
                        <span>Explore Commodities Store</span>
                    </a>
                    <button type="button" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-semibold d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Request Bulk Quote (RFQ)</span>
                    </button>
                </div>

                <!-- Live Metrics Row -->
                <div class="row g-4 pt-3 border-top border-white border-opacity-10">
                    <div class="col-4">
                        <div class="fs-3 fw-black text-white lh-1 mb-1">{{ number_format($totalStock) }}+ <small class="fs-6 text-success">MT</small></div>
                        <small class="text-white-50 text-uppercase fw-semibold" style="font-size: 0.72rem; letter-spacing: 0.5px;">Active Supply</small>
                    </div>
                    <div class="col-4 border-start border-white border-opacity-10 ps-4">
                        <div class="fs-3 fw-black text-white lh-1 mb-1">100%</div>
                        <small class="text-white-50 text-uppercase fw-semibold" style="font-size: 0.72rem; letter-spacing: 0.5px;">SGS Inspected</small>
                    </div>
                    <div class="col-4 border-start border-white border-opacity-10 ps-4">
                        <div class="fs-3 fw-black text-warning lh-1 mb-1">4.9 <i class="bi bi-star-fill fs-6"></i></div>
                        <small class="text-white-50 text-uppercase fw-semibold" style="font-size: 0.72rem; letter-spacing: 0.5px;">Trust Rating</small>
                    </div>
                </div>
            </div>

            <!-- Right Hero Card / Interactive Showcase -->
            <div class="col-lg-5">
                <div class="card border-0 rounded-4 overflow-hidden shadow-2xl position-relative" style="background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.12) !important;">
                    <!-- Image preview -->
                    <div class="position-relative" style="height: 260px;">
                        <img src="{{ asset('img/carousel-1.jpg') }}" alt="Brazilian Harvest" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-warning text-dark fw-bold px-3 py-1.5 rounded-pill shadow">
                                <i class="bi bi-patch-check-fill me-1"></i>SGS CERTIFIED
                            </span>
                        </div>
                        <div class="position-absolute bottom-0 start-0 end-0 p-3" style="background: linear-gradient(transparent, rgba(15,23,42,0.9));">
                            <h5 class="text-white fw-bold mb-0">Harvest Basin: Mato Grosso &amp; São Paulo</h5>
                            <small class="text-white-50">Exporting FOB Santos &amp; Paranaguá ports</small>
                        </div>
                    </div>

                    <!-- Quick Spec Box -->
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom border-white border-opacity-10">
                            <div>
                                <span class="text-white-50 small d-block">Featured Export Commodity</span>
                                <h6 class="text-white fw-bold mb-0">Brazilian Non-GMO Soybeans (Grade #2)</h6>
                            </div>
                            <div class="text-end">
                                <span class="fs-5 fw-bold text-success d-block">$485.00</span>
                                <small class="text-white-50">per Metric Ton</small>
                            </div>
                        </div>

                        <div class="row g-2 mb-3 text-white-50 small">
                            <div class="col-6"><i class="bi bi-check2 text-success me-1"></i>Min. 36% Protein</div>
                            <div class="col-6"><i class="bi bi-check2 text-success me-1"></i>Max. 14% Moisture</div>
                            <div class="col-6"><i class="bi bi-check2 text-success me-1"></i>Escrow Protected</div>
                            <div class="col-6"><i class="bi bi-check2 text-success me-1"></i>Phytosanitary Cert</div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('shop.index') }}" class="btn btn-outline-success rounded-pill fw-bold py-2 text-white border-success">
                                View Full Inventory ({{ $productsCount }} Commodities)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==================== 2. TRUST FEATURES STRIP ==================== --}}
<section class="py-4 border-bottom bg-white shadow-sm" id="trust-features">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-lg-3">
                <div class="d-flex flex-column align-items-center p-2">
                    <div class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Escrow Protected</h6>
                    <small class="text-muted">Funds released only after discharge inspection &amp; BL</small>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="d-flex flex-column align-items-center p-2">
                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                        <i class="bi bi-truck fs-4"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Port-to-Door Freight</h6>
                    <small class="text-muted">FOB Santos / CIF destination port shipping lines</small>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="d-flex flex-column align-items-center p-2">
                    <div class="rounded-circle bg-warning-subtle text-dark d-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                        <i class="bi bi-patch-check fs-4 text-warning"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Phytosanitary Tested</h6>
                    <small class="text-muted">Full MAPA export certification &amp; SGS lab assay</small>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="d-flex flex-column align-items-center p-2">
                    <div class="rounded-circle bg-info-subtle text-info d-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                        <i class="bi bi-headset fs-4"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">24/7 Trade Desk</h6>
                    <small class="text-muted">Dedicated WhatsApp broker &amp; multi-lingual trade support</small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==================== 3. CATEGORIES CAROUSEL / PILLS ==================== --}}
<section class="py-5 bg-light border-bottom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <div>
                <span class="text-success text-uppercase fw-bold small" style="letter-spacing: 1.5px;">Harvest Taxonomy</span>
                <h2 class="fw-bold text-dark mb-0">Browse by Agro Category</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-semibold">
                View All Categories <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
            @foreach($categories as $cat)
                <div class="col">
                    <a href="{{ route('shop.index', ['category' => $cat->slug]) }}" class="card h-100 border-0 rounded-4 shadow-sm text-decoration-none text-center p-3 transition-transform hover-card bg-white">
                        <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center mx-auto mb-2" style="width: 52px; height: 52px;">
                            <i class="bi {{ $cat->icon ?: 'bi-flower1' }} fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">{{ $cat->name }}</h6>
                        <small class="text-muted">{{ $cat->products_count }} {{ Str::plural('lot', $cat->products_count) }}</small>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ==================== 4. FEATURED PRODUCTS (DYNAMIC FROM DB) ==================== --}}
<section class="py-5 bg-white" id="catalog">
    <div class="container py-3">
        <!-- Section Title & Filter Tabs -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div>
                <span class="text-success text-uppercase fw-bold small" style="letter-spacing: 1.5px;">Live Storefront Catalog</span>
                <h2 class="fw-bold text-dark mb-0">Featured Export Commodities</h2>
            </div>

            <!-- Category Filter Pills -->
            <div class="d-flex flex-wrap gap-1.5" id="productFilterTabs">
                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 active filter-tab-btn" data-filter="all">All</button>
                @foreach($categories as $cat)
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 filter-tab-btn" data-filter="{{ $cat->slug }}">{{ $cat->name }}</button>
                @endforeach
            </div>
        </div>

        <!-- Products Grid (Real DB Products) -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4" id="productsGrid">
            @forelse($featuredProducts as $product)
                <div class="col product-grid-item" data-category="{{ $product->category?->slug ?? 'all' }}">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No products found in the catalog.</p>
                </div>
            @endforelse
        </div>

        <!-- Bottom Action CTA -->
        <div class="text-center mt-5">
            <a href="{{ route('shop.index') }}" class="btn btn-dark btn-lg rounded-pill px-5 fw-bold shadow-sm">
                <span>View Full Store Catalog ({{ $productsCount }} Commodities)</span>
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

{{-- ==================== 5. COMMODITY SPOTLIGHT BANNER ==================== --}}
<section class="py-5" style="background: #0f172a;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-warning-subtle text-dark fw-bold small mb-3">
                    <i class="bi bi-lightning-charge-fill text-warning"></i>
                    <span>SPOTLIGHT EXPORT CONTRACT</span>
                </div>
                <h2 class="display-6 fw-bold text-white mb-3">
                    Refined Cane Sugar ICUMSA 45 — São Paulo Mills
                </h2>
                <p class="text-white-50 mb-4 lh-base">
                    Sparkling white crystalline cane sugar ready for immediate breakbulk or 50kg containerized shipment. Clean attenuation index, phytosanitary clearance, and laboratory assay guaranteed.
                </p>

                <div class="row g-3 mb-4 text-white small">
                    <div class="col-sm-6 d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-success fs-5"></i>
                        <span>Polarization: 99.80% min.</span>
                    </div>
                    <div class="col-sm-6 d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-success fs-5"></i>
                        <span>Moisture: 0.04% max.</span>
                    </div>
                    <div class="col-sm-6 d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-success fs-5"></i>
                        <span>Origin: São Paulo, Brazil</span>
                    </div>
                    <div class="col-sm-6 d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-success fs-5"></i>
                        <span>Port: FOB Santos</span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div>
                        <span class="fs-3 fw-bold text-success">$540.00</span>
                        <small class="text-white-50">/ Metric Ton</small>
                    </div>
                    <button type="button" class="btn btn-success rounded-pill px-4 py-2.5 fw-bold text-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                        Lock In Quote (RFQ)
                    </button>
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-light rounded-pill px-4 py-2.5 fw-semibold">
                        View Specs
                    </a>
                </div>
            </div>

            <div class="col-lg-6 text-center">
                <div class="position-relative d-inline-block">
                    <img src="{{ asset('img/service-2.jpg') }}" alt="Cane Sugar Export" class="img-fluid rounded-4 shadow-2xl border border-secondary" style="max-height: 380px; object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 m-3 bg-dark bg-opacity-90 p-3 rounded-3 text-start border border-secondary shadow-lg">
                        <div class="fw-bold text-white small"><i class="bi bi-shield-lock-fill text-success me-1"></i>Escrow Backed Contract</div>
                        <small class="text-white-50">1,800 MT remaining in lot</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==================== 6. VERIFICATION WORKFLOW ==================== --}}
<section class="py-5 bg-white border-bottom">
    <div class="container py-4">
        <div class="text-center max-w-xl mx-auto mb-5">
            <span class="text-success text-uppercase fw-bold small" style="letter-spacing: 1.5px;">Institutional Process</span>
            <h2 class="fw-bold text-dark mb-2">How Matro Guarantees Risk-Free Sourcing</h2>
            <p class="text-muted small">From farm harvest verification to discharge port inspection, every trade is insured and verified.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 bg-light p-4 text-center">
                    <div class="rounded-circle bg-success text-dark fw-bold d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 48px; height: 48px; font-size: 1.2rem;">
                        1
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Verified Sourcing &amp; Grading</h5>
                    <p class="text-muted small mb-0">Traceable lots sampled and analyzed by certified Brazilian agronomists for moisture, protein, and purity before rail dispatch.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 bg-light p-4 text-center">
                    <div class="rounded-circle bg-success text-dark fw-bold d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 48px; height: 48px; font-size: 1.2rem;">
                        2
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Escrow-Secured Settlement</h5>
                    <p class="text-muted small mb-0">Buyer funds reside safely in top-tier international escrow accounts, eliminating counterparty default risk entirely.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 bg-light p-4 text-center">
                    <div class="rounded-circle bg-success text-dark fw-bold d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 48px; height: 48px; font-size: 1.2rem;">
                        3
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Port Clearance &amp; BL Release</h5>
                    <p class="text-muted small mb-0">SGS inspects vessel loading at Santos or Paranaguá. Phytosanitary certificates and clean Bill of Lading (BL) are transmitted digitally.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==================== 7. VERIFIED BUYER TESTIMONIALS ==================== --}}
<section class="py-5 bg-light">
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <div>
                <span class="text-success text-uppercase fw-bold small" style="letter-spacing: 1.5px;">Institutional Proof</span>
                <h2 class="fw-bold text-dark mb-0">Trusted by Global Importers</h2>
            </div>
            <div class="text-warning fs-5">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <span class="text-dark small fw-bold ms-1">4.9/5 Average Review</span>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 shadow-sm bg-white p-4">
                    <div class="text-warning mb-2" style="font-size: 0.85rem;">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-muted small lh-base mb-3">
                        "Securing 10,000 MT of Brazilian soybeans used to require weeks of broker back-and-forth and high letter of credit fees. Matro's escrow system delivered certified cargo to Hamburg with total transparency."
                    </p>
                    <div class="d-flex align-items-center gap-2 mt-auto">
                        <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                            E
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">EuroGrain Commodities</h6>
                            <small class="text-muted">Hamburg, Germany</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 shadow-sm bg-white p-4">
                    <div class="text-warning mb-2" style="font-size: 0.85rem;">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-muted small lh-base mb-3">
                        "The ICUMSA 45 sugar arrived with immaculate laboratory documentation. SGS grade tests matched the pre-shipment certificates down to the decimal point."
                    </p>
                    <div class="d-flex align-items-center gap-2 mt-auto">
                        <div class="rounded-circle bg-warning-subtle text-warning fw-bold d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                            A
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Al-Khaleej Wholesale Foodstuffs</h6>
                            <small class="text-muted">Jebel Ali, UAE</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 shadow-sm bg-white p-4">
                    <div class="text-warning mb-2" style="font-size: 0.85rem;">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-muted small lh-base mb-3">
                        "The online portal makes ordering sample containers or full vessel allocations as straightforward as modern e-commerce. Matro is redefining agro trading."
                    </p>
                    <div class="d-flex align-items-center gap-2 mt-auto">
                        <div class="rounded-circle bg-success-subtle text-success fw-bold d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                            M
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Mediterranean Agri Foods</h6>
                            <small class="text-muted">Valencia, Spain</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==================== 8. DIRECT RFQ CTA BANNER ==================== --}}
<section class="py-5 text-white" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
    <div class="container py-3 text-center">
        <h2 class="display-6 fw-bold text-white mb-2">Need a Custom Shipping Contract or Bulk Allocation?</h2>
        <p class="text-white-75 mb-4" style="max-width: 600px; margin: 0 auto;">
            Our São Paulo Trade Desk provides indicative FOB Santos and CIF pricing within 4 business hours.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <button type="button" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold text-dark shadow-lg" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                <i class="bi bi-pencil-square me-2"></i>Submit Trade Desk RFQ
            </button>
            <a href="https://wa.me/5511952987545?text=Hello%20Matro%20Trade%20Desk%20I%20am%20interested%20in%20a%20bulk%20quote" target="_blank" class="btn btn-outline-light btn-lg rounded-pill px-4 fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-whatsapp text-success"></i>
                <span>Direct WhatsApp Chat</span>
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Category Filter Tab Switching
        var filterTabs = document.querySelectorAll('.filter-tab-btn');
        var gridItems = document.querySelectorAll('.product-grid-item');

        filterTabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                filterTabs.forEach(function (t) {
                    t.classList.remove('btn-success', 'active');
                    t.classList.add('btn-outline-secondary');
                });
                this.classList.remove('btn-outline-secondary');
                this.classList.add('btn-success', 'active');

                var filter = this.getAttribute('data-filter');

                gridItems.forEach(function (item) {
                    var cat = item.getAttribute('data-category');
                    if (filter === 'all' || cat === filter) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush
