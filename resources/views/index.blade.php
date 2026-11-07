<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Matro - Brazilian Bulk Agro-Commodity Trading &amp; Store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Brazilian agro commodities, bulk soybeans, ICUMSA 45 sugar, yellow corn, green coffee, SGS inspection, escrow settlement, Port of Santos, Matro" name="keywords">
    <meta content="Matro coordinates direct institutional origination of Brazilian agro-commodities for international buyers. Sourced from certified cooperatives, verified by SGS &amp; MAPA, and secured with Tier-1 bank escrow." name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Relief:wght@400;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: {
                preflight: false,
            }
        }
    </script>
    <style>
        .hero-banner {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.94) 0%, rgba(19, 35, 27, 0.92) 100%), url('{{ asset('img/hero-bg.jpg') }}') center/cover no-repeat;
        }
        .telemetry-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            transition: all 0.3s ease;
        }
        .telemetry-card:hover {
            background: rgba(255, 255, 255, 0.09);
            border-color: var(--bs-primary);
            transform: translateY(-2px);
        }
        .pillar-card {
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        .pillar-card:hover {
            transform: translateY(-4px);
            border-color: var(--bs-primary);
            box-shadow: 0 16px 32px rgba(120, 162, 47, 0.12);
        }
        .step-circle {
            width: 48px;
            height: 48px;
            font-size: 1.15rem;
            font-weight: 700;
        }
        .product-card-img-wrap {
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        .product-card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .product-card:hover .product-card-img-wrap img {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="open-sans-regular bg-white text-dark">

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex flex-column align-items-center justify-content-center">
        <span class="spinner-border text-primary mb-2" role="status" style="width: 3rem; height: 3rem;"></span>
        <span class="text-muted small fw-semibold">Loading Matro Institutional Trade Desk...</span>
    </div>
    <!-- Spinner End -->

    <!-- Top Announcement & Credential Bar -->
    <div class="bg-dark text-light border-bottom border-secondary border-opacity-25 py-2 px-3 px-lg-4 small d-none d-md-block">
        <div class="container-fluid d-flex flex-wrap align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <span class="d-inline-flex align-items-center text-primary fw-bold">
                    <i class="fa fa-circle text-success me-1" style="font-size: 8px;"></i> LIVE TRADE DESK
                </span>
                <span class="text-white-50">|</span>
                <span><i class="fa fa-anchor text-primary me-1"></i> Origin Ports: <strong>Santos &amp; Paranaguá (BR)</strong></span>
                <span class="text-white-50">|</span>
                <span><i class="fa fa-shield-alt text-primary me-1"></i> 100% Pre-Shipment SGS &amp; MAPA Assays</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span><i class="fa fa-file-invoice-dollar text-primary me-1"></i> Settlements: <strong>USD, EUR, BRL (Escrow / LC)</strong></span>
                <span class="text-white-50">|</span>
                <a href="https://wa.me/5511952987545?text=Hello%20Matro%20Trade%20Desk" target="_blank" rel="noopener" class="text-light text-decoration-none hover:text-primary">
                    <i class="fab fa-whatsapp text-success me-1"></i> +55 (11) 95298-7545
                </a>
            </div>
        </div>
    </div>

    <!-- Navigation Header -->
    <div id="home" class="container-fluid p-0 position-relative">
        <nav class="navbar matro-navbar navbar-expand-lg navbar-dark fixed-top px-3 px-lg-4">
            <div class="container-fluid px-0">
                <!-- Brand / Logo -->
                <a href="/" class="navbar-brand d-flex align-items-center me-2 me-lg-4 py-1">
                    <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle me-2 shadow-sm" style="width: 40px; height: 40px;">
                        <i class="fa fa-shopping-basket"></i>
                    </span>
                    <div class="d-flex flex-column">
                        <span class="fs-4 fw-bold text-white lh-1">MATRO</span>
                        <span class="text-primary text-uppercase font-monospace" style="font-size: 10px; letter-spacing: 1.5px; font-weight: 600;">BRAZILIAN AGRO TRADE</span>
                    </div>
                </a>

                <!-- Mobile Quick Actions -->
                <div class="d-flex align-items-center d-lg-none ms-auto me-2 gap-2">
                    <button type="button" class="btn btn-sm btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" data-bs-toggle="modal" data-bs-target="#searchModal" title="Search">
                        <i class="fa fa-search"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-light rounded-circle d-flex align-items-center justify-content-center position-relative mobile-cart-btn" style="width: 36px; height: 36px;" aria-label="Cart">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="cartCountBadge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">0</span>
                    </button>
                    <button type="button" class="navbar-toggler border-0 p-2 shadow-none" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <!-- Collapsible Navbar Content -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-3 py-lg-0 align-items-lg-center">
                        <a href="#home" class="nav-item nav-link active px-2 px-xl-3">Home</a>
                        <a href="#commodities" class="nav-item nav-link px-2 px-xl-3">Commodities</a>
                        <a href="#pillars" class="nav-item nav-link px-2 px-xl-3">4 Pillars</a>
                        <a href="#fulfillment" class="nav-item nav-link px-2 px-xl-3">Fulfillment Flow</a>
                        <a href="#standards" class="nav-item nav-link px-2 px-xl-3">Quality &amp; Assays</a>
                        <a href="#testimonials" class="nav-item nav-link px-2 px-xl-3">Reviews</a>
                        <a href="#rfq-desk" class="nav-item nav-link px-2 px-xl-3 text-warning fw-semibold">
                            <i class="fa fa-file-invoice me-1"></i>Request RFQ
                        </a>
                    </div>

                    <!-- Right-side Actions -->
                    <div class="agrovia-nav-actions d-flex flex-wrap align-items-center gap-2 pt-2 pt-lg-0 border-top border-lg-0 border-secondary">
                        <button type="button" class="btn btn-outline-light rounded-circle d-none d-lg-flex align-items-center justify-content-center" style="width: 38px; height: 38px;" data-bs-toggle="modal" data-bs-target="#searchModal" title="Search Commodities (Ctrl+K)">
                            <i class="fa fa-search"></i>
                        </button>

                        <a href="https://wa.me/5511952987545?text=Hello%20Matro%20Trade%20Desk" target="_blank" rel="noopener" class="btn btn-outline-success rounded-pill px-3 py-1 d-inline-flex align-items-center justify-content-center text-nowrap" title="Direct WhatsApp Desk">
                            <i class="fab fa-whatsapp fs-6 me-1 text-success"></i>
                            <span class="small fw-bold">WhatsApp Desk</span>
                        </a>

                        @auth
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning rounded-pill px-3 py-1 small fw-bold text-dark d-inline-flex align-items-center gap-1 shadow-sm">
                                    <i class="fa fa-tachometer-alt"></i>
                                    <span>Admin Panel</span>
                                </a>
                            @endif

                            <div class="nav-item dropdown d-inline-block">
                                <button type="button" class="btn btn-outline-light rounded-pill px-3 py-1 small fw-bold dropdown-toggle d-inline-flex align-items-center gap-1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user-circle"></i>
                                    <span>{{ Str::limit(Auth::user()->name, 14) }}</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark border-0 shadow mt-2">
                                    <div class="dropdown-header text-muted small border-bottom border-secondary pb-2 mb-1">
                                        Signed in as <strong class="text-white d-block">{{ Auth::user()->email }}</strong>
                                        @if(Auth::user()->isAdmin())
                                            <span class="badge bg-warning text-dark mt-1">Administrator</span>
                                        @else
                                            <span class="badge bg-info text-dark mt-1">Verified Importer / Buyer</span>
                                        @endif
                                    </div>
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item py-2 text-warning fw-semibold">
                                            <i class="fa fa-tachometer-alt me-2 text-warning"></i>Admin Dashboard
                                        </a>
                                        <a href="{{ route('admin.products.index') }}" class="dropdown-item py-2">
                                            <i class="fa fa-boxes-stacked me-2 text-success"></i>Commodity Inventory
                                        </a>
                                        <a href="{{ route('admin.orders.index') }}" class="dropdown-item py-2">
                                            <i class="fa fa-receipt me-2 text-info"></i>Contracts &amp; Orders
                                        </a>
                                        <a href="{{ route('admin.inquiries.index') }}" class="dropdown-item py-2">
                                            <i class="fa fa-envelope-open-text me-2 text-primary"></i>RFQ Trade Inquiries
                                        </a>
                                        <a href="{{ route('admin.users.index') }}" class="dropdown-item py-2">
                                            <i class="fa fa-users me-2 text-light"></i>Client Directory
                                        </a>
                                        <hr class="dropdown-divider border-secondary my-1">
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger">
                                            <i class="fa fa-sign-out-alt me-2"></i>Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="/login" class="btn btn-outline-light rounded-pill px-3 py-1 small fw-bold">Login</a>
                            <a href="/register" class="btn btn-primary btn-custom rounded-pill px-3 py-1 small fw-bold text-white shadow-sm">Register</a>
                        @endauth

                        <button type="button" class="btn btn-outline-light rounded-circle d-none d-lg-flex align-items-center justify-content-center position-relative ms-1 desktop-cart-btn" style="width: 38px; height: 38px;" id="cartBtn" aria-label="Cart" title="View Sample Cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span id="cartCount" class="cartCountBadge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">0</span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Spacious Split Hero Section (Organized following Kindle Trading's layout) -->
        <section class="hero-banner text-white position-relative" style="padding-top: 130px; padding-bottom: 70px;">
            <div class="container py-4 py-lg-5">
                <div class="row align-items-center g-5">
                    <!-- Left Hero: Institutional Value Proposition & Telemetry -->
                    <div class="col-lg-7">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-primary bg-opacity-25 border border-primary text-white small fw-bold mb-3">
                            <i class="fa fa-shield-alt text-primary"></i>
                            <span>DIRECT BRAZILIAN AGRO-COMMODITY TRADING</span>
                        </div>
                        <h1 class="display-4 fw-bold text-white mb-3 lh-sm">
                            Direct Brazilian Agro-Commodities. <span class="text-primary">Global Port Delivery.</span>
                        </h1>
                        <p class="lead text-light opacity-90 mb-4" style="max-width: 620px;">
                            Origination of Brazilian Non-GMO Soybeans, Refined Cane Sugar (ICUMSA 45), Yellow Corn, Specialty Green Coffee, and Pulses. Backed by independent SGS lab assays, MAPA phytosanitary certification, and risk-free Tier-1 bank escrow settlement.
                        </p>
                        <div class="d-flex flex-wrap gap-3 mb-5">
                            <a href="#commodities" class="btn btn-primary btn-custom rounded-pill px-4 py-3 text-white fw-bold shadow-lg d-inline-flex align-items-center gap-2">
                                <i class="fa fa-boxes"></i> Explore Commodity Lots
                            </a>
                            <a href="#rfq-desk" class="btn btn-outline-light rounded-pill px-4 py-3 fw-bold d-inline-flex align-items-center gap-2">
                                <i class="fa fa-file-invoice-dollar text-warning"></i> Request Bulk RFQ
                            </a>
                        </div>

                        <!-- Telemetry Grid (Kindle Trading 4-Metric Bar) -->
                        <div class="row g-3 pt-2">
                            <div class="col-6 col-sm-3">
                                <div class="telemetry-card rounded-3 p-3 h-100 text-center text-sm-start">
                                    <div class="fs-4 fw-bold text-white mb-0 counter" data-target="{{ $totalStock }}" data-suffix="+ MT">{{ number_format($totalStock) }}+ MT</div>
                                    <div class="text-white-50 small mt-1">Active Supply</div>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="telemetry-card rounded-3 p-3 h-100 text-center text-sm-start">
                                    <div class="fs-4 fw-bold text-primary mb-0">100% SGS</div>
                                    <div class="text-white-50 small mt-1">Pre-Shipment Assay</div>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="telemetry-card rounded-3 p-3 h-100 text-center text-sm-start">
                                    <div class="fs-4 fw-bold text-warning mb-0">Zero Risk</div>
                                    <div class="text-white-50 small mt-1">Escrow Settlement</div>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="telemetry-card rounded-3 p-3 h-100 text-center text-sm-start">
                                    <div class="fs-4 fw-bold text-white mb-0">Santos (BR)</div>
                                    <div class="text-white-50 small mt-1">Primary Exit Port</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Hero: Featured Spotlight Commodity Card -->
                    <div class="col-lg-5">
                        <div class="bg-dark bg-opacity-75 border border-secondary border-opacity-50 rounded-4 p-4 shadow-2xl backdrop-blur-md">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="badge bg-primary px-3 py-1.5 rounded-pill small fw-bold">SPOTLIGHT CONTRACT LOT</span>
                                <span class="text-warning small fw-bold"><i class="fa fa-certificate me-1"></i>SGS Verified</span>
                            </div>
                            <div class="position-relative rounded-3 overflow-hidden mb-3" style="height: 220px;">
                                <img src="{{ asset('img/carousel-1.jpg') }}" alt="Brazilian Non-GMO Soybeans" class="w-100 h-100 object-fit-cover">
                                <div class="position-absolute bottom-0 start-0 m-2">
                                    <span class="badge bg-dark bg-opacity-75 text-white small"><i class="fa fa-map-marker-alt text-warning me-1"></i>Mato Grosso Basin, Brazil</span>
                                </div>
                            </div>
                            <h4 class="fw-bold text-white mb-1">Brazilian Non-GMO Yellow Soybeans</h4>
                            <p class="text-light opacity-75 small mb-3">Export grade #2, standard harvest allocation ready for immediate vessel chartering or container stuffing.</p>
                            
                            <div class="bg-black bg-opacity-40 rounded-3 p-3 mb-3 small">
                                <div class="d-flex justify-content-between border-bottom border-secondary border-opacity-25 pb-1 mb-1">
                                    <span class="text-white-50">Protein Content:</span>
                                    <span class="text-white fw-bold">Min 36.0% (Dry Basis)</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom border-secondary border-opacity-25 pb-1 mb-1">
                                    <span class="text-white-50">Moisture Index:</span>
                                    <span class="text-white fw-bold">Max 12.5%</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom border-secondary border-opacity-25 pb-1 mb-1">
                                    <span class="text-white-50">Standard MOQ:</span>
                                    <span class="text-white fw-bold">500 MT (Vessel / Bags)</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-white-50">Delivery Terms:</span>
                                    <span class="text-primary fw-bold">CIF Destination / FOB Santos</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between pt-1">
                                <div>
                                    <span class="text-white-50 small d-block">Indicative FOB / CIF:</span>
                                    <span class="fs-4 fw-bold text-primary">$485.00</span>
                                    <span class="text-white-50 small">/ Metric Ton</span>
                                </div>
                                <a href="#rfq-desk" class="btn btn-primary btn-custom rounded-pill text-white fw-bold px-4 select-rfq-product" data-product-name="Brazilian Non-GMO Soybeans">
                                    Lock Spot Lot RFQ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <main>

        <!-- Section 1: The 4 Pillars of Bulk Agro Trade (Borrowed from Kindle Trading's 4-Pillar Layout) -->
        <section id="pillars" class="py-5 py-lg-6 bg-light border-bottom">
            <div class="container py-4">
                <div class="text-center max-w-3xl mx-auto mb-5">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-white border border-primary border-opacity-25 text-primary small fw-bold mb-3 shadow-sm">
                        <i class="fa fa-cubes text-primary"></i> INSTITUTIONAL ASSURANCE
                    </div>
                    <h2 class="display-6 fw-bold text-dark mb-3">The 4 Pillars of Bulk Agro Trade</h2>
                    <p class="text-secondary fs-6">
                        How Matro eliminates counterparty risk, enforces physical chemical assay standards, and coordinates seamless deepwater multimodal logistics across global destination ports.
                    </p>
                </div>

                <div class="row g-4">
                    <!-- Pillar 1 -->
                    <div class="col-md-6 col-lg-3">
                        <div class="pillar-card bg-white rounded-4 p-4 h-100 d-flex flex-column shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-3" style="width: 52px; height: 52px;">
                                    <i class="fa fa-tractor fs-4"></i>
                                </span>
                                <span class="badge bg-light text-secondary border font-monospace">PILLAR 01</span>
                            </div>
                            <h4 class="fw-bold text-dark mb-2">Direct Farm Co-op Origination</h4>
                            <p class="text-secondary small mb-4 flex-grow-1">
                                Direct origination contracts across accredited agricultural cooperatives in Mato Grosso, Paraná, and Goiás. Zero trading middlemen, full harvest traceability, and guaranteed seasonal supply volumes.
                            </p>
                            <div class="pt-3 border-top">
                                <span class="badge bg-success bg-opacity-10 text-success fw-semibold"><i class="fa fa-check me-1"></i>Farm-Gate Direct</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pillar 2 -->
                    <div class="col-md-6 col-lg-3">
                        <div class="pillar-card bg-white rounded-4 p-4 h-100 d-flex flex-column shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-3" style="width: 52px; height: 52px;">
                                    <i class="fa fa-microscope fs-4"></i>
                                </span>
                                <span class="badge bg-light text-secondary border font-monospace">PILLAR 02</span>
                            </div>
                            <h4 class="fw-bold text-dark mb-2">Independent SGS &amp; MAPA Assay</h4>
                            <p class="text-secondary small mb-4 flex-grow-1">
                                Every metric ton is sampled prior to vessel holds or container loading. Verified by independent lab testing (SGS / Bureau Veritas) and official Brazilian Ministry of Agriculture (MAPA) phytosanitary clearance.
                            </p>
                            <div class="pt-3 border-top">
                                <span class="badge bg-success bg-opacity-10 text-success fw-semibold"><i class="fa fa-check me-1"></i>100% Pre-Shipment Tested</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pillar 3 -->
                    <div class="col-md-6 col-lg-3">
                        <div class="pillar-card bg-white rounded-4 p-4 h-100 d-flex flex-column shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-3" style="width: 52px; height: 52px;">
                                    <i class="fa fa-shield-alt fs-4"></i>
                                </span>
                                <span class="badge bg-light text-secondary border font-monospace">PILLAR 03</span>
                            </div>
                            <h4 class="fw-bold text-dark mb-2">Risk-Free Escrow Settlement</h4>
                            <p class="text-secondary small mb-4 flex-grow-1">
                                International commercial settlements execute through Tier-1 bank escrow or Irrevocable Letters of Credit (LC / SBLC). Buyer capital remains protected under fiduciary custody until Clean Bill of Lading validation.
                            </p>
                            <div class="pt-3 border-top">
                                <span class="badge bg-success bg-opacity-10 text-success fw-semibold"><i class="fa fa-check me-1"></i>Zero Counterparty Risk</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pillar 4 -->
                    <div class="col-md-6 col-lg-3">
                        <div class="pillar-card bg-white rounded-4 p-4 h-100 d-flex flex-column shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-3" style="width: 52px; height: 52px;">
                                    <i class="fa fa-ship fs-4"></i>
                                </span>
                                <span class="badge bg-light text-secondary border font-monospace">PILLAR 04</span>
                            </div>
                            <h4 class="fw-bold text-dark mb-2">Multimodal Port Freight</h4>
                            <p class="text-secondary small mb-4 flex-grow-1">
                                Dedicated deepwater berth logistics through Port of Santos and Port of Paranaguá. Vessel chartering (Panamax, Supramax), containerized bagging, and 24/7 live AIS satellite voyage telemetry.
                            </p>
                            <div class="pt-3 border-top">
                                <span class="badge bg-success bg-opacity-10 text-success fw-semibold"><i class="fa fa-check me-1"></i>Santos &amp; Paranaguá CIF/FOB</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Commodity Catalog & Spot Contract Lots -->
        <section id="commodities" class="py-5 py-lg-6 bg-white">
            <div class="container py-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                    <div>
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-light border border-primary border-opacity-25 text-primary small fw-bold mb-2">
                            <i class="fa fa-seedling text-primary"></i> CERTIFIED EXPORT INVENTORY
                        </div>
                        <h2 class="display-6 fw-bold text-dark mb-1">Available Commodity Lots &amp; Spot Contracts</h2>
                        <p class="text-secondary mb-0">Direct Brazilian agricultural lots ready for immediate contract allocation, container stuffing, or full bulk chartering.</p>
                    </div>
                    <div class="mt-3 mt-md-0">
                        <span class="badge bg-light text-dark border px-3 py-2 fs-6">
                            <i class="fa fa-cubes text-primary me-1"></i> <strong>{{ $productsCount ?? 8 }}</strong> Active Lots
                        </span>
                    </div>
                </div>

                <!-- Category Filters -->
                <div class="d-flex flex-wrap gap-2 mb-4 pb-2 border-bottom">
                    <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn active" data-filter="all">
                        <i class="fa fa-list me-1"></i> All Commodities
                    </button>
                    @if(isset($categories) && $categories->isNotEmpty())
                        @foreach($categories as $cat)
                            <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="{{ $cat->name }}">
                                {{ $cat->name }}
                            </button>
                        @endforeach
                    @else
                        <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Grains & Rice">Grains &amp; Rice</button>
                        <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Oil & Sugar">Oil &amp; Sugar</button>
                        <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Nuts & Seeds">Nuts &amp; Seeds</button>
                        <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Lentils & Pulses">Lentils &amp; Pulses</button>
                        <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Spices & Specialty">Spices &amp; Specialty</button>
                    @endif
                    <button type="button" class="btn btn-outline-primary rounded-pill ms-auto" id="refreshProductsBtn">
                        <i class="fa fa-sync-alt me-1"></i> Shuffle Lots
                    </button>
                </div>

                <!-- Product Grid -->
                <div class="row g-4" id="catalogGrid">
                    @forelse($products as $product)
                        <div class="col-lg-3 col-md-6 product-item" data-category="{{ $product->category->name ?? 'Grains & Rice' }}">
                            <div class="product-card bg-white rounded-4 border p-3 h-100 d-flex flex-column shadow-sm">
                                <div class="product-card-img-wrap rounded-3 mb-3">
                                    <img src="{{ asset($product->image ?: 'img/service-1.jpg') }}" alt="{{ $product->name }}" loading="lazy">
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-2 shadow-sm">
                                        {{ $product->unit == 'Metric Ton' ? 'Bulk / B2B' : 'Retail / Sample' }}
                                    </span>
                                    <span class="badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 start-0 m-2 small">
                                        <i class="fa fa-map-marker-alt text-warning me-1"></i>{{ $product->origin ?? 'Brazil' }}
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-muted small mb-1 fw-semibold text-uppercase font-monospace" style="font-size: 11px;">
                                        {{ $product->category->name ?? 'Agro Commodity' }}
                                    </div>
                                    <h5 class="fw-bold mb-2 text-dark">{{ $product->name }}</h5>
                                    <p class="text-secondary small mb-3">
                                        {{ Str::limit($product->description, 80) }}
                                    </p>
                                </div>
                                <div class="pt-3 border-top mt-auto">
                                    <div class="d-flex align-items-baseline justify-content-between mb-3">
                                        <div>
                                            <span class="fs-5 fw-bold text-primary">${{ number_format($product->price, 2) }}</span>
                                            <span class="text-muted small">/ {{ $product->unit ?? 'MT' }}</span>
                                        </div>
                                        <span class="badge bg-light text-secondary border small">
                                            <i class="fa fa-box text-success me-1"></i>{{ number_format($product->stock) }} {{ $product->unit == 'Metric Ton' ? 'MT' : 'units' }}
                                        </span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill flex-fill" data-action="quickview" data-product="{{ $product->name }}" data-price="${{ number_format($product->price, 2) }} / {{ $product->unit ?? 'MT' }}" data-image="{{ asset($product->image ?: 'img/service-1.jpg') }}">
                                            <i class="fa fa-eye me-1"></i>View / Buy
                                        </button>
                                        <a href="#rfq-desk" class="btn btn-sm btn-primary btn-custom rounded-pill text-white flex-fill select-rfq-product" data-product-name="{{ $product->name }}">
                                            <i class="fa fa-file-invoice me-1"></i>RFQ
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Fallback 4 Commodities if DB has no records -->
                        <div class="col-lg-3 col-md-6 product-item" data-category="Grains & Rice">
                            <div class="product-card bg-white rounded-4 border p-3 h-100 d-flex flex-column shadow-sm">
                                <div class="product-card-img-wrap rounded-3 mb-3">
                                    <img src="{{ asset('img/service-1.jpg') }}" alt="Brazilian Non-GMO Soybeans" loading="lazy">
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-2 shadow-sm">Bulk / B2B</span>
                                    <span class="badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 start-0 m-2 small"><i class="fa fa-map-marker-alt text-warning me-1"></i>Mato Grosso, BR</span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-muted small mb-1 fw-semibold text-uppercase font-monospace" style="font-size: 11px;">Grains &amp; Rice</div>
                                    <h5 class="fw-bold mb-2 text-dark">Brazilian Non-GMO Soybeans</h5>
                                    <p class="text-secondary small mb-3">Export grade yellow soybeans, protein min 36%, moisture max 12.5%.</p>
                                </div>
                                <div class="pt-3 border-top mt-auto">
                                    <div class="d-flex align-items-baseline justify-content-between mb-3">
                                        <div><span class="fs-5 fw-bold text-primary">$485.00</span><span class="text-muted small">/ Metric Ton</span></div>
                                        <span class="badge bg-light text-secondary border small"><i class="fa fa-box text-success me-1"></i>2,500 MT</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill flex-fill" data-action="quickview" data-product="Brazilian Non-GMO Soybeans" data-price="$485.00 / Metric Ton" data-image="{{ asset('img/service-1.jpg') }}"><i class="fa fa-eye me-1"></i>View / Buy</button>
                                        <a href="#rfq-desk" class="btn btn-sm btn-primary btn-custom rounded-pill text-white flex-fill select-rfq-product" data-product-name="Brazilian Non-GMO Soybeans"><i class="fa fa-file-invoice me-1"></i>RFQ</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 product-item" data-category="Oil & Sugar">
                            <div class="product-card bg-white rounded-4 border p-3 h-100 d-flex flex-column shadow-sm">
                                <div class="product-card-img-wrap rounded-3 mb-3">
                                    <img src="{{ asset('img/service-2.jpg') }}" alt="Refined Cane Sugar (ICUMSA 45)" loading="lazy">
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-2 shadow-sm">Bulk / B2B</span>
                                    <span class="badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 start-0 m-2 small"><i class="fa fa-map-marker-alt text-warning me-1"></i>São Paulo, BR</span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-muted small mb-1 fw-semibold text-uppercase font-monospace" style="font-size: 11px;">Oil &amp; Sugar</div>
                                    <h5 class="fw-bold mb-2 text-dark">Refined Cane Sugar (ICUMSA 45)</h5>
                                    <p class="text-secondary small mb-3">Sparkling white cane sugar, ICUMSA ≤ 45, max 0.04% moisture, 50kg PP bags.</p>
                                </div>
                                <div class="pt-3 border-top mt-auto">
                                    <div class="d-flex align-items-baseline justify-content-between mb-3">
                                        <div><span class="fs-5 fw-bold text-primary">$540.00</span><span class="text-muted small">/ Metric Ton</span></div>
                                        <span class="badge bg-light text-secondary border small"><i class="fa fa-box text-success me-1"></i>1,800 MT</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill flex-fill" data-action="quickview" data-product="Refined Cane Sugar (ICUMSA 45)" data-price="$540.00 / Metric Ton" data-image="{{ asset('img/service-2.jpg') }}"><i class="fa fa-eye me-1"></i>View / Buy</button>
                                        <a href="#rfq-desk" class="btn btn-sm btn-primary btn-custom rounded-pill text-white flex-fill select-rfq-product" data-product-name="Refined Cane Sugar (ICUMSA 45)"><i class="fa fa-file-invoice me-1"></i>RFQ</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 product-item" data-category="Grains & Rice">
                            <div class="product-card bg-white rounded-4 border p-3 h-100 d-flex flex-column shadow-sm">
                                <div class="product-card-img-wrap rounded-3 mb-3">
                                    <img src="{{ asset('img/service-3.jpg') }}" alt="Yellow Corn (Maize Grade 2)" loading="lazy">
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-2 shadow-sm">Bulk / B2B</span>
                                    <span class="badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 start-0 m-2 small"><i class="fa fa-map-marker-alt text-warning me-1"></i>Goiás, BR</span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-muted small mb-1 fw-semibold text-uppercase font-monospace" style="font-size: 11px;">Grains &amp; Rice</div>
                                    <h5 class="fw-bold mb-2 text-dark">Yellow Corn (Maize Grade 2)</h5>
                                    <p class="text-secondary small mb-3">Brazilian yellow maize, feed grade, moisture max 14%, broken kernels max 3%.</p>
                                </div>
                                <div class="pt-3 border-top mt-auto">
                                    <div class="d-flex align-items-baseline justify-content-between mb-3">
                                        <div><span class="fs-5 fw-bold text-primary">$245.00</span><span class="text-muted small">/ Metric Ton</span></div>
                                        <span class="badge bg-light text-secondary border small"><i class="fa fa-box text-success me-1"></i>3,200 MT</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill flex-fill" data-action="quickview" data-product="Yellow Corn (Maize Grade 2)" data-price="$245.00 / Metric Ton" data-image="{{ asset('img/service-3.jpg') }}"><i class="fa fa-eye me-1"></i>View / Buy</button>
                                        <a href="#rfq-desk" class="btn btn-sm btn-primary btn-custom rounded-pill text-white flex-fill select-rfq-product" data-product-name="Yellow Corn (Maize Grade 2)"><i class="fa fa-file-invoice me-1"></i>RFQ</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 product-item" data-category="Spices & Specialty">
                            <div class="product-card bg-white rounded-4 border p-3 h-100 d-flex flex-column shadow-sm">
                                <div class="product-card-img-wrap rounded-3 mb-3">
                                    <img src="{{ asset('img/service-5.jpg') }}" alt="Specialty Arabica Green Coffee Beans" loading="lazy">
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-2 shadow-sm">Bulk / B2B</span>
                                    <span class="badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 start-0 m-2 small"><i class="fa fa-map-marker-alt text-warning me-1"></i>Minas Gerais, BR</span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-muted small mb-1 fw-semibold text-uppercase font-monospace" style="font-size: 11px;">Spices &amp; Specialty</div>
                                    <h5 class="fw-bold mb-2 text-dark">Specialty Arabica Green Coffee</h5>
                                    <p class="text-secondary small mb-3">Strictly Soft Fine Cup, Screen 17/18, single-origin Sul de Minas, 60kg jute bags.</p>
                                </div>
                                <div class="pt-3 border-top mt-auto">
                                    <div class="d-flex align-items-baseline justify-content-between mb-3">
                                        <div><span class="fs-5 fw-bold text-primary">$3,850.00</span><span class="text-muted small">/ Metric Ton</span></div>
                                        <span class="badge bg-light text-secondary border small"><i class="fa fa-box text-success me-1">450 MT</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill flex-fill" data-action="quickview" data-product="Specialty Arabica Green Coffee" data-price="$3,850.00 / Metric Ton" data-image="{{ asset('img/service-5.jpg') }}"><i class="fa fa-eye me-1"></i>View / Buy</button>
                                        <a href="#rfq-desk" class="btn btn-sm btn-primary btn-custom rounded-pill text-white flex-fill select-rfq-product" data-product-name="Specialty Arabica Green Coffee"><i class="fa fa-file-invoice me-1"></i>RFQ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Section 3: 5-Step End-to-End Bulk Fulfillment Architecture (Kindle Trading's 5-Step Flow) -->
        <section id="fulfillment" class="py-5 py-lg-6 bg-light border-top border-bottom">
            <div class="container py-4">
                <div class="text-center max-w-3xl mx-auto mb-5">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-white border border-primary border-opacity-25 text-primary small fw-bold mb-3 shadow-sm">
                        <i class="fa fa-route text-primary"></i> STRUCTURED EXECUTION
                    </div>
                    <h2 class="display-6 fw-bold text-dark mb-3">5-Step End-to-End Fulfillment Architecture</h2>
                    <p class="text-secondary fs-6">
                        From initial commercial specification to final discharge port handover, every milestone is strictly gated by fiduciary escrow and certified lab assay validation.
                    </p>
                </div>

                <div class="row g-4">
                    <!-- Step 01 -->
                    <div class="col-lg col-md-6">
                        <div class="bg-white rounded-4 p-4 h-100 border shadow-sm position-relative d-flex flex-column">
                            <span class="step-circle rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3 shadow-sm">
                                01
                            </span>
                            <h5 class="fw-bold text-dark mb-2">Requirement &amp; Spec Matching</h5>
                            <p class="text-secondary small mb-0">
                                Importer specifies volume, target chemical specs (moisture, protein, ICUMSA), discharge destination port, and delivery Incoterms (CIF or FOB Santos/Paranaguá).
                            </p>
                        </div>
                    </div>

                    <!-- Step 02 -->
                    <div class="col-lg col-md-6">
                        <div class="bg-white rounded-4 p-4 h-100 border shadow-sm position-relative d-flex flex-column">
                            <span class="step-circle rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3 shadow-sm">
                                02
                            </span>
                            <h5 class="fw-bold text-dark mb-2">Co-op Allocation &amp; SGS Assay</h5>
                            <p class="text-secondary small mb-0">
                                Grain lots allocated from accredited cooperatives in Mato Grosso or Paraná. Independent surveyors (SGS / Bureau Veritas) draw composite samples for chemical assay and MAPA clearance.
                            </p>
                        </div>
                    </div>

                    <!-- Step 03 -->
                    <div class="col-lg col-md-6">
                        <div class="bg-white rounded-4 p-4 h-100 border shadow-sm position-relative d-flex flex-column">
                            <span class="step-circle rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3 shadow-sm">
                                03
                            </span>
                            <h5 class="fw-bold text-dark mb-2">Escrow Custody &amp; Contract Lock</h5>
                            <p class="text-secondary small mb-0">
                                Formal Sales &amp; Purchase Agreement (SPA) executed. Buyer lodges funds into Tier-1 Bank Escrow or opens Irrevocable Documentary Letter of Credit (DLC); funds remain frozen.
                            </p>
                        </div>
                    </div>

                    <!-- Step 04 -->
                    <div class="col-lg col-md-6">
                        <div class="bg-white rounded-4 p-4 h-100 border shadow-sm position-relative d-flex flex-column">
                            <span class="step-circle rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3 shadow-sm">
                                04
                            </span>
                            <h5 class="fw-bold text-dark mb-2">Port Loading &amp; Ocean Transit</h5>
                            <p class="text-secondary small mb-0">
                                Cargo moves via bonded freight corridors to Port of Santos. Vessel holds inspected, cargo stowed, and Clean On-Board Bill of Lading (B/L) issued with live AIS tracking.
                            </p>
                        </div>
                    </div>

                    <!-- Step 05 -->
                    <div class="col-lg col-md-6">
                        <div class="bg-white rounded-4 p-4 h-100 border shadow-sm position-relative d-flex flex-column">
                            <span class="step-circle rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3 shadow-sm">
                                05
                            </span>
                            <h5 class="fw-bold text-dark mb-2">Discharge Release &amp; Handover</h5>
                            <p class="text-secondary small mb-0">
                                Vessel arrives at destination port. Final outturn validation conducted, escrow funds release to seller, and title documents transfer directly to buyer customs broker.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4: Institutional Quality Standards & Compliance Badges -->
        <section id="standards" class="py-5 py-lg-6 bg-white">
            <div class="container py-4">
                <div class="text-center max-w-3xl mx-auto mb-5">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-light border border-primary border-opacity-25 text-primary small fw-bold mb-3">
                        <i class="fa fa-certificate text-primary"></i> VERIFIED ACCREDITATIONS
                    </div>
                    <h2 class="display-6 fw-bold text-dark mb-3">Institutional Quality &amp; Compliance Standards</h2>
                    <p class="text-secondary fs-6">
                        Every agricultural lot traded through Matro complies with rigorous international sanitary, phytosanitary, and legal trade finance requirements.
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="bg-light rounded-4 p-3 text-center h-100 border shadow-sm">
                            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mb-2 text-primary" style="width: 50px; height: 50px;">
                                <i class="fa fa-check-circle fs-4"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">SGS Testing</h6>
                            <p class="text-muted small mb-0" style="font-size: 11px;">Independent pre-shipment quality &amp; weight assay</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="bg-light rounded-4 p-3 text-center h-100 border shadow-sm">
                            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mb-2 text-success" style="width: 50px; height: 50px;">
                                <i class="fa fa-leaf fs-4"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">MAPA Certified</h6>
                            <p class="text-muted small mb-0" style="font-size: 11px;">Official Brazilian Ministry of Agriculture clearance</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="bg-light rounded-4 p-3 text-center h-100 border shadow-sm">
                            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mb-2 text-info" style="width: 50px; height: 50px;">
                                <i class="fa fa-globe fs-4"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">IPPC / FAO</h6>
                            <p class="text-muted small mb-0" style="font-size: 11px;">International Plant Protection phytosanitary protocol</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="bg-light rounded-4 p-3 text-center h-100 border shadow-sm">
                            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mb-2 text-warning" style="width: 50px; height: 50px;">
                                <i class="fa fa-award fs-4"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">ISO 22000</h6>
                            <p class="text-muted small mb-0" style="font-size: 11px;">Food safety management &amp; cold-chain custody</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="bg-light rounded-4 p-3 text-center h-100 border shadow-sm">
                            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mb-2 text-danger" style="width: 50px; height: 50px;">
                                <i class="fa fa-balance-scale fs-4"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">GAFTA / FOSFA</h6>
                            <p class="text-muted small mb-0" style="font-size: 11px;">Standard international grain contract terms</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="bg-light rounded-4 p-3 text-center h-100 border shadow-sm">
                            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mb-2 text-primary" style="width: 50px; height: 50px;">
                                <i class="fa fa-shield-alt fs-4"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Bank Escrow</h6>
                            <p class="text-muted small mb-0" style="font-size: 11px;">Tier-1 fiduciary financial lock until B/L release</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 5: Institutional Importer Testimonials & Reviews -->
        <section id="testimonials" class="py-5 py-lg-6 bg-light border-top border-bottom">
            <div class="container py-4">
                <div class="text-center max-w-3xl mx-auto mb-5">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-white border border-primary border-opacity-25 text-primary small fw-bold mb-3 shadow-sm">
                        <i class="fa fa-star text-warning"></i> GLOBAL IMPORTER TESTIMONIALS
                    </div>
                    <h2 class="display-6 fw-bold text-dark mb-3">Institutional Importer Track Record</h2>
                    <p class="text-secondary fs-6">
                        Read how multinational commodity buyers, port distributors, and food processing groups rely on Matro for dependable Brazilian agro execution.
                    </p>
                </div>

                <div class="row g-4">
                    <!-- Testimonial 1 -->
                    <div class="col-lg-4">
                        <div class="bg-white rounded-4 p-4 h-100 border shadow-sm d-flex flex-column">
                            <div class="text-warning mb-3">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                            <p class="text-secondary fs-6 fst-italic mb-4 flex-grow-1">
                                "Securing 12,500 MT of Non-GMO Soybeans out of Santos was executed seamlessly. The SGS composite assay matched our feed specifications precisely, and the bank escrow gave our treasury full peace of mind."
                            </p>
                            <div class="d-flex align-items-center pt-3 border-top">
                                <img src="{{ asset('img/testimonial-1.jpg') }}" alt="Pieter van der Berg" class="rounded-circle me-3 object-fit-cover" width="50" height="50">
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">Pieter van der Berg</h6>
                                    <small class="text-muted">Procurement Director · Rotterdam, Netherlands</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="col-lg-4">
                        <div class="bg-white rounded-4 p-4 h-100 border shadow-sm d-flex flex-column">
                            <div class="text-warning mb-3">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                            <p class="text-secondary fs-6 fst-italic mb-4 flex-grow-1">
                                "The ICUMSA 45 refined sugar arrived in Jebel Ali on time with complete phytosanitary certificates and zero broken bags. Matro's direct trade desk communicated vessel loading telemetry every 24 hours."
                            </p>
                            <div class="d-flex align-items-center pt-3 border-top">
                                <img src="{{ asset('img/testimonial-2.jpg') }}" alt="Tariq Al-Mansoor" class="rounded-circle me-3 object-fit-cover" width="50" height="50">
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">Tariq Al-Mansoor</h6>
                                    <small class="text-muted">VP Supply Chain · Jebel Ali, Dubai UAE</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="col-lg-4">
                        <div class="bg-white rounded-4 p-4 h-100 border shadow-sm d-flex flex-column">
                            <div class="text-warning mb-3">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                            <p class="text-secondary fs-6 fst-italic mb-4 flex-grow-1">
                                "Direct co-op pricing eliminated the 6% broker markup we normally pay on Brazilian yellow corn. Clean title handover at the discharge port made customs processing effortless."
                            </p>
                            <div class="d-flex align-items-center pt-3 border-top">
                                <img src="{{ asset('img/testimonial-3.jpg') }}" alt="Wei Chen" class="rounded-circle me-3 object-fit-cover" width="50" height="50">
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">Wei Chen</h6>
                                    <small class="text-muted">Agro Trading Desk Head · Qingdao, China</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="button" class="btn btn-outline-success rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#reviewModal">
                        <i class="fa fa-pen me-1"></i> Submit Importer Review
                    </button>
                </div>
            </div>
        </section>

        <!-- Section 6: Direct Trade Desk RFQ / Inquiries (Spacious Dual-Column Layout) -->
        <section id="rfq-desk" class="py-5 py-lg-6 bg-white">
            <div class="container py-4">
                <div class="row g-5 align-items-start">
                    <!-- Left Column: Trade Desk Information & Physical Presence -->
                    <div class="col-lg-5">
                        <div class="pe-lg-4">
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-light border border-primary border-opacity-25 text-primary small fw-bold mb-3">
                                <i class="fa fa-headset text-primary"></i> DIRECT DESK ACCESS
                            </div>
                            <h2 class="display-6 fw-bold text-dark mb-3">Institutional Trade Desk &amp; RFQ Inquiries</h2>
                            <p class="text-secondary mb-4">
                                Connect directly with our commodity trading desk in São Paulo. Submit your target specifications or request live indicative CIF/FOB pricing.
                            </p>

                            <div class="bg-light rounded-4 p-4 border mb-4 shadow-sm">
                                <div class="d-flex align-items-start gap-3 mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle text-primary shadow-sm" style="width: 42px; height: 42px; flex-shrink: 0;">
                                        <i class="fa fa-map-marker-alt"></i>
                                    </span>
                                    <div>
                                        <strong class="d-block text-dark">Trading Headquarters</strong>
                                        <span class="text-secondary small">Avenida Paulista 1374, Bela Vista, São Paulo - SP, Brazil</span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start gap-3 mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle text-success shadow-sm" style="width: 42px; height: 42px; flex-shrink: 0;">
                                        <i class="fab fa-whatsapp"></i>
                                    </span>
                                    <div>
                                        <strong class="d-block text-dark">Encrypted Trade WhatsApp</strong>
                                        <a href="https://wa.me/5511952987545" target="_blank" rel="noopener" class="text-success text-decoration-none small fw-bold">
                                            +55 (11) 95298-7545
                                        </a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start gap-3 mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle text-primary shadow-sm" style="width: 42px; height: 42px; flex-shrink: 0;">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <div>
                                        <strong class="d-block text-dark">Desk Inquiries</strong>
                                        <span class="text-secondary small">tradedesk@matro.com / inquiries@matro.com</span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start gap-3">
                                    <span class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle text-warning shadow-sm" style="width: 42px; height: 42px; flex-shrink: 0;">
                                        <i class="fa fa-clock"></i>
                                    </span>
                                    <div>
                                        <strong class="d-block text-dark">Trading Hours &amp; Response SLA</strong>
                                        <span class="text-secondary small">Mon - Fri: 08:00 - 18:00 BRT · Initial Quote &lt; 4 Hours</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <span class="badge bg-light text-secondary border px-3 py-2 small"><i class="fa fa-dollar-sign text-success me-1"></i>USD Settlement</span>
                                <span class="badge bg-light text-secondary border px-3 py-2 small"><i class="fa fa-euro-sign text-primary me-1"></i>EUR Settlement</span>
                                <span class="badge bg-light text-secondary border px-3 py-2 small"><i class="fa fa-money-bill-wave text-warning me-1"></i>BRL Direct</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Interactive RFQ Inquiry Form -->
                    <div class="col-lg-7">
                        <div class="bg-light rounded-4 p-4 p-lg-5 border shadow-sm">
                            <h4 class="fw-bold text-dark mb-1">Submit Institutional Request for Quote (RFQ)</h4>
                            <p class="text-secondary small mb-4">Complete the form below to receive formal indicative pricing, SGS specification sheets, and allocation schedule.</p>

                            <div id="rfqAlert" class="alert d-none mb-4" role="alert"></div>

                            <form id="rfqDeskForm">
                                <input type="hidden" name="role" value="buyer">
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Target Commodity *</label>
                                        <select name="buyer_detail" id="rfqCommoditySelect" class="form-select rounded-pill" required>
                                            <option value="Brazilian Non-GMO Soybeans">Brazilian Non-GMO Soybeans</option>
                                            <option value="Refined Cane Sugar (ICUMSA 45)">Refined Cane Sugar (ICUMSA 45)</option>
                                            <option value="Yellow Corn (Maize Grade 2)">Yellow Corn (Maize Grade 2)</option>
                                            <option value="Specialty Arabica Green Coffee">Specialty Arabica Green Coffee</option>
                                            <option value="Brazilian Green Lentils & Pulses">Brazilian Green Lentils &amp; Pulses</option>
                                            <option value="Other Agricultural Bulk Lot">Other Agricultural Bulk Lot</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Estimated Volume (Metric Tons) *</label>
                                        <input type="text" name="volume" class="form-control rounded-pill" placeholder="e.g. 500 MT / 2,500 MT / Vessel" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Full Contact Name *</label>
                                        <input type="text" name="name" class="form-control rounded-pill" placeholder="First &amp; Last Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Corporate Email *</label>
                                        <input type="email" name="email" class="form-control rounded-pill" placeholder="importer@company.com" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Company / Organization *</label>
                                        <input type="text" name="company" class="form-control rounded-pill" placeholder="Trading firm or import agency" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Destination Country / Discharge Port *</label>
                                        <input type="text" name="country" class="form-control rounded-pill" placeholder="e.g. Port of Rotterdam, Netherlands" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Phone / WhatsApp Number</label>
                                        <input type="tel" name="phone" class="form-control rounded-pill" placeholder="+Country Code Phone Number">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Preferred Incoterms</label>
                                        <select name="service_type" class="form-select rounded-pill">
                                            <option value="CIF Destination Port">CIF - Cost, Insurance &amp; Freight (Discharge Port)</option>
                                            <option value="FOB Port of Santos">FOB - Free on Board (Port of Santos, Brazil)</option>
                                            <option value="FOB Port of Paranaguá">FOB - Free on Board (Port of Paranaguá, Brazil)</option>
                                            <option value="CFR Port of Discharge">CFR - Cost and Freight</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label small fw-bold text-dark">Technical Specifications &amp; Instructions</label>
                                        <textarea name="message" class="form-control rounded-3" rows="3" placeholder="Provide any moisture, protein, packaging (bulk vs 50kg bags), or target timeline requirements..."></textarea>
                                    </div>

                                    <div class="col-12 pt-2">
                                        <button type="submit" id="rfqSubmitBtn" class="btn btn-primary btn-custom rounded-pill w-100 py-3 text-white fw-bold shadow">
                                            <i class="fa fa-paper-plane me-2"></i> Submit RFQ to Trade Desk
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 7: Frequently Asked Questions (FAQ) -->
        <section id="faq" class="py-5 bg-light border-top border-bottom">
            <div class="container py-4">
                <div class="text-center max-w-3xl mx-auto mb-5">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-white border border-primary border-opacity-25 text-primary small fw-bold mb-3 shadow-sm">
                        <i class="fa fa-question-circle text-primary"></i> TRADE TRANSPARENCY
                    </div>
                    <h2 class="display-6 fw-bold text-dark mb-3">Frequently Asked Questions</h2>
                    <p class="text-secondary fs-6">Key answers regarding export logistics, phytosanitary clearance, minimum orders, and escrow financing.</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item rounded-3 mb-3 border shadow-sm overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3 text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        What phytosanitary and export certificates accompany each shipment?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-secondary small py-3">
                                        Every metric ton is certified with an official Phytosanitary Certificate issued by the Brazilian Ministry of Agriculture (MAPA), an independent Certificate of Quality and Weight (SGS / Bureau Veritas), a Certificate of Origin, Non-GMO verification (for designated lots), and Clean On-Board Ocean Bills of Lading.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item rounded-3 mb-3 border shadow-sm overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3 text-dark bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        What are the standard Minimum Order Quantities (MOQ)?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-secondary small py-3">
                                        For bulk grains (Soybeans, Yellow Corn), standard spot lots start at 500 Metric Tons for containerized cargo and 12,500 to 50,000 MT for break-bulk charter vessels. For refined sugar (ICUMSA 45), minimum contract allocation is 500 MT. Smaller trial samples and composite boxes can be ordered directly through our online store.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item rounded-3 mb-3 border shadow-sm overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3 text-dark bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        How does the Risk-Free Bank Escrow settlement function?
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-secondary small py-3">
                                        All commercial settlements execute through Tier-1 bank escrow or Irrevocable Letters of Credit (DLC). Funds remain frozen under fiduciary custody during grain movement and ocean loading. Capital is released to the seller strictly when Clean Bills of Lading and SGS inspection certificates are independently verified.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item rounded-3 mb-3 border shadow-sm overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3 text-dark bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                        Which deepwater ports handle Matro's maritime departures?
                                    </button>
                                </h2>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-secondary small py-3">
                                        Our primary departure points are Port of Santos (São Paulo state) — Latin America’s largest agro-bulk terminal — and Port of Paranaguá (Paraná state). Both ports accommodate Handysize, Supramax, and Panamax bulk grain vessels with dedicated conveyor berths and certified container bagging facilities.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item rounded-3 border shadow-sm overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3 text-dark bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                        Can we order physical samples prior to signing full vessel charter agreements?
                                    </button>
                                </h2>
                                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-secondary small py-3">
                                        Yes. Prospective buyers can order composite sample packs (5 kg to 50 kg) directly via our Quick View / Add to Cart checkout. Samples are drawn from current harvest silos, sealed under chain-of-custody protocols, and dispatched by air courier with preliminary lab assay documentation.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 8: Newsletter / Trade Desk Digest -->
        <section class="py-5 bg-dark text-white">
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-7 text-center">
                        <h3 class="display-6 fw-bold text-white mb-2">Subscribe to the Trade Desk Digest</h3>
                        <p class="text-light opacity-75 mb-4">Weekly Brazilian harvest yield reports, Port of Santos vessel line-ups, and indicative FOB/CIF market quotes.</p>
                        <form class="position-relative max-w-lg mx-auto" onsubmit="event.preventDefault(); if (window.showAgroviaToast) window.showAgroviaToast('Subscription Logged', 'You will receive our weekly Brazilian trade digest.', 'fa fa-envelope text-success', 'success'); this.reset();">
                            <input class="form-control rounded-pill border-0 ps-4 pe-5 py-3 shadow-lg" type="email" placeholder="Enter your corporate email address..." required style="height: 56px;">
                            <button type="submit" class="btn btn-primary btn-custom rounded-pill position-absolute top-0 end-0 mt-1 me-1 px-4 text-white fw-bold" style="height: 48px;">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Corporate Footer -->
    <footer class="bg-[#111827] text-gray-300 border-t border-gray-800 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
                <!-- Col 1 -->
                <div>
                    <div class="d-flex align-items-center mb-3">
                        <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle me-2" style="width: 36px; height: 36px;">
                            <i class="fa fa-shopping-basket"></i>
                        </span>
                        <span class="text-2xl font-bold text-white">MATRO</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">
                        Direct institutional trade facilitation between certified Brazilian agricultural cooperatives and global commodity buyers. Fully documented, assayed by SGS, and backed by Tier-1 bank escrow.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="https://wa.me/5511952987545" target="_blank" rel="noopener" class="btn btn-sm btn-outline-light rounded-circle" style="width: 34px; height: 34px;"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle" style="width: 34px; height: 34px;"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle" style="width: 34px; height: 34px;"><i class="fa fa-envelope"></i></a>
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div>
                    <h5 class="text-white font-bold text-base mb-4 border-b border-gray-700 pb-2">Trading Architecture</h5>
                    <ul class="list-unstyled space-y-2 text-sm text-gray-400">
                        <li><a href="#commodities" class="text-gray-400 hover:text-white text-decoration-none">Available Commodity Lots</a></li>
                        <li><a href="#pillars" class="text-gray-400 hover:text-white text-decoration-none">The 4 Pillars of Bulk Trade</a></li>
                        <li><a href="#fulfillment" class="text-gray-400 hover:text-white text-decoration-none">5-Step Fulfillment Lifecycle</a></li>
                        <li><a href="#standards" class="text-gray-400 hover:text-white text-decoration-none">SGS &amp; MAPA Compliance</a></li>
                        <li><a href="#rfq-desk" class="text-gray-400 hover:text-white text-decoration-none">Trade Desk Quotations (RFQ)</a></li>
                        <li><a href="/login" class="text-gray-400 hover:text-white text-decoration-none">Client Portal &amp; Orders</a></li>
                    </ul>
                </div>

                <!-- Col 3: Key Agro-Commodities -->
                <div>
                    <h5 class="text-white font-bold text-base mb-4 border-b border-gray-700 pb-2">Key Commodities</h5>
                    <ul class="list-unstyled space-y-2 text-sm text-gray-400">
                        <li><span class="text-gray-300">Brazilian Non-GMO Soybeans (Bulk)</span></li>
                        <li><span class="text-gray-300">Refined Cane Sugar (ICUMSA 45)</span></li>
                        <li><span class="text-gray-300">Yellow Corn (Maize Feed Grade 2)</span></li>
                        <li><span class="text-gray-300">Arabica &amp; Robusta Green Coffee</span></li>
                        <li><span class="text-gray-300">Brazilian Black &amp; Carioca Beans</span></li>
                        <li><span class="text-gray-300">Export Brazil Nuts &amp; Sesame Seeds</span></li>
                    </ul>
                </div>

                <!-- Col 4: Operations & Contact -->
                <div>
                    <h5 class="text-white font-bold text-base mb-4 border-b border-gray-700 pb-2">Brazilian Trade Desk</h5>
                    <div class="space-y-3 text-sm text-gray-400">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fa fa-map-marker-alt text-primary mt-1"></i>
                            <span>Av. Paulista 1374, Bela Vista, São Paulo - SP, Brazil</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fab fa-whatsapp text-success"></i>
                            <a href="https://wa.me/5511952987545" class="text-gray-300 hover:text-white text-decoration-none">+55 (11) 95298-7545</a>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa fa-envelope text-primary"></i>
                            <span class="text-gray-300">tradedesk@matro.com</span>
                        </div>
                        <div class="pt-2">
                            <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50 px-2 py-1 small">
                                <i class="fa fa-check-circle me-1"></i> MAPA Registered Operator
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-6 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 text-xs text-gray-500">
                <p class="mb-0">&copy; {{ date('Y') }} Matro Brazilian Agro-Commodity Trading Platform. All rights reserved.</p>
                <div class="d-flex gap-4">
                    <span><i class="fa fa-lock text-primary me-1"></i> Tier-1 Bank Escrow Protected</span>
                    <span><i class="fa fa-certificate text-success me-1"></i> SGS Pre-Shipment Tested</span>
                    <span><i class="fa fa-ship text-info me-1"></i> Santos &amp; Paranaguá CIF/FOB</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top shadow" aria-label="Back to Top">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- Floating Chat Widget -->
    <div id="chatWidget" style="position: fixed; bottom: 100px; right: 28px; z-index: 999;">
        <button type="button" id="chatToggle" class="btn btn-primary btn-lg-square rounded-circle shadow-lg" aria-label="Chat with Trade Desk">
            <i class="fa fa-comments text-white"></i>
        </button>
        <div id="chatPanel" class="bg-white rounded-4 shadow-xl p-3 border mt-2" style="width: 320px; display: none;">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                <div>
                    <strong class="text-dark d-block">Brazilian Trade Desk</strong>
                    <span class="text-success small"><i class="fa fa-circle me-1" style="font-size: 8px;"></i>Live Assistance</span>
                </div>
                <button type="button" class="btn-close" id="chatClose" aria-label="Close"></button>
            </div>
            <input type="text" id="chatName" class="form-control form-control-sm rounded-pill mb-2" placeholder="Your Name">
            <input type="email" id="chatEmail" class="form-control form-control-sm rounded-pill mb-2" placeholder="Your Corporate Email">
            <select id="chatTopic" class="form-select form-select-sm rounded-pill mb-2">
                <option value="Soybean Contract">Soybean Contract</option>
                <option value="Sugar ICUMSA 45">Sugar ICUMSA 45</option>
                <option value="Corn / Grains">Corn / Grains</option>
                <option value="Coffee / Pulses">Coffee / Pulses</option>
                <option value="Escrow / Settlement">Escrow / Settlement</option>
            </select>
            <textarea id="chatMessage" class="form-control form-control-sm rounded-3 mb-2" rows="3" placeholder="Tell us about volume or destination port..."></textarea>
            <button type="button" id="chatSend" class="btn btn-primary btn-custom btn-sm rounded-pill w-100 text-white fw-bold">
                Send to Trade Desk
            </button>
        </div>
    </div>

    <!-- Modals -->

    <!-- Global Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="searchModalLabel">
                        <i class="fa fa-search text-primary me-2"></i>Search Matro Platform &amp; Commodities
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="position-relative mb-4">
                        <input type="text" id="agroviaSearchInput" class="form-control search-input" placeholder="Type commodity, category, spec, or trade term (e.g. Soybeans, Escrow, Sugar)...">
                    </div>
                    <div id="searchResultsContainer" style="max-height: 380px; overflow-y: auto;">
                        <div class="text-center text-muted py-4">
                            <i class="fa fa-seedling fa-2x mb-2 text-success opacity-75"></i>
                            <p class="mb-0">Type to search agricultural lots, export specifications, and trade protocols.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 text-muted small d-flex justify-content-between">
                    <span><kbd>Esc</kbd> to exit | <kbd>/</kbd> or <kbd>Ctrl+K</kbd> to launch search</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick View / Add to Cart Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-xl rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title text-white fw-bold" id="quickViewLabel">Commodity Quick View</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="rounded-3 overflow-hidden mb-3" style="height: 220px;">
                        <img id="qvImage" class="img-fluid w-100 h-100 object-fit-cover" src="" alt="">
                    </div>
                    <h4 id="qvTitle" class="fw-bold text-dark mb-1"></h4>
                    <p class="text-primary fs-5 fw-bold mb-3" id="qvPrice"></p>
                    
                    <div class="bg-light rounded-3 p-3 mb-3 small">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Pre-Shipment Inspection:</span>
                            <span class="fw-bold text-dark">SGS Certified Assay</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Origin Verification:</span>
                            <span class="fw-bold text-dark">MAPA Phytosanitary Clearance</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Settlement:</span>
                            <span class="fw-bold text-success">Bank Escrow Protected</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Sample / Allocation Quantity</label>
                        <input type="number" id="qvQty" class="form-control rounded-pill" value="1" min="1">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" id="qvAddToCart" class="btn btn-primary btn-custom rounded-pill text-white fw-bold flex-fill">
                            <i class="fa fa-shopping-cart me-1"></i> Add to Sample Cart
                        </button>
                        <button type="button" id="qvCheckout" class="btn btn-outline-dark rounded-pill px-4">
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Importer Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-xl rounded-4">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title text-white fw-bold" id="reviewModalLabel">
                        <i class="fa fa-star text-warning me-2"></i>Submit Importer Review
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="reviewForm">
                        <input type="hidden" id="ratingValue" value="5">
                        <div class="text-center mb-3">
                            <label class="form-label d-block text-secondary small fw-bold">Overall Execution Rating</label>
                            <div class="rating-stars fs-3">
                                <i class="fa fa-star active text-warning" data-rating="1"></i>
                                <i class="fa fa-star active text-warning" data-rating="2"></i>
                                <i class="fa fa-star active text-warning" data-rating="3"></i>
                                <i class="fa fa-star active text-warning" data-rating="4"></i>
                                <i class="fa fa-star active text-warning" data-rating="5"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Your Name *</label>
                            <input type="text" id="reviewAuthor" class="form-control rounded-pill" required placeholder="e.g. Jean Dupont">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Role &amp; Company / Port</label>
                            <input type="text" id="reviewRole" class="form-control rounded-pill" placeholder="e.g. Head of Grain Procurement, Port of Marseille">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Review Commentary *</label>
                            <textarea id="reviewText" class="form-control rounded-3" rows="3" required placeholder="Share your experience with lot quality, SGS assay accuracy, or escrow settlement..."></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-custom rounded-pill text-white fw-bold">
                                Publish Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
    (function ($) {
        "use strict";

        // Category Filter
        $('.agro-filter-btn').on('click', function () {
            $('.agro-filter-btn').removeClass('active');
            $(this).addClass('active');
            var filter = $(this).attr('data-filter');
            $('.product-item').each(function () {
                var cat = $(this).attr('data-category');
                if (filter === 'all' || cat === filter) {
                    $(this).stop(true, true).fadeIn(300);
                } else {
                    $(this).stop(true, true).fadeOut(200);
                }
            });
        });

        // Shuffle / Refresh Products
        $('#refreshProductsBtn').on('click', function () {
            $('.agro-filter-btn').removeClass('active');
            $('.agro-filter-btn[data-filter="all"]').addClass('active');
            $('.product-item').stop(true, true).fadeIn(200);
            var grid = $('#catalogGrid');
            var items = grid.children('.product-item').get();
            for (var i = items.length - 1; i > 0; i--) {
                var j = Math.floor(Math.random() * (i + 1));
                var tmp = items[i];
                items[i] = items[j];
                items[j] = tmp;
            }
            $.each(items, function (idx, item) {
                grid.append(item);
            });
            if (window.showAgroviaToast) {
                window.showAgroviaToast('Catalog Re-randomized', 'Commodity display order updated.', 'fa fa-sync text-primary', 'info');
            }
        });

        // Pre-fill RFQ Commodity when clicking "RFQ" button on any card
        $(document).on('click', '.select-rfq-product', function (e) {
            var prodName = $(this).attr('data-product-name');
            if (prodName) {
                var select = $('#rfqCommoditySelect');
                var optionExists = select.find('option').filter(function () {
                    return $(this).text().toLowerCase().indexOf(prodName.toLowerCase()) !== -1;
                }).length > 0;

                if (!optionExists) {
                    select.prepend('<option value="' + prodName + '" selected>' + prodName + '</option>');
                } else {
                    select.find('option').filter(function () {
                        return $(this).text().toLowerCase().indexOf(prodName.toLowerCase()) !== -1;
                    }).prop('selected', true);
                }

                select.addClass('border-primary shadow-sm');
                setTimeout(function () {
                    select.removeClass('border-primary shadow-sm');
                }, 2500);
            }
        });

        // Quick View Modal
        var qvProduct = '';
        $('[data-action="quickview"]').on('click', function () {
            qvProduct = $(this).attr('data-product');
            $('#quickViewLabel').text(qvProduct);
            $('#qvImage').attr('src', $(this).attr('data-image'));
            $('#qvTitle').text(qvProduct);
            $('#qvPrice').text($(this).attr('data-price'));
            $('#qvQty').val(1);
            var modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
            modal.show();
        });

        // Cart State & Interactions
        var cart = [];
        try { cart = JSON.parse(localStorage.getItem('agroviaCart') || '[]'); } catch (e) { cart = []; }
        function updateCartBadge() {
            var total = cart.reduce(function (a, b) { return a + b.qty; }, 0);
            $('#cartCount, .cartCountBadge').text(total);
        }
        updateCartBadge();

        var isAuthenticated = @json(auth()->check());

        $('#qvAddToCart').on('click', function () {
            if (!isAuthenticated) {
                if (window.showAgroviaToast) window.showAgroviaToast('Login Required', 'Please log in to add sample items to cart.', 'fa fa-lock text-danger', 'danger');
                setTimeout(function () { window.location.href = '/login'; }, 1200);
                return;
            }
            var qty = parseInt($('#qvQty').val(), 10) || 1;
            var existing = cart.find(function (i) { return i.name === qvProduct; });
            if (existing) { existing.qty += qty; } else { cart.push({ name: qvProduct, qty: qty }); }
            try { localStorage.setItem('agroviaCart', JSON.stringify(cart)); } catch (e) {}
            updateCartBadge();
            if (window.showAgroviaToast) {
                window.showAgroviaToast('Added to Cart', qvProduct + ' x' + qty, 'fa fa-shopping-cart text-success', 'success');
            }
        });

        $('#qvCheckout').on('click', function () {
            if (!isAuthenticated) {
                if (window.showAgroviaToast) window.showAgroviaToast('Login Required', 'Please log in or register to checkout.', 'fa fa-lock text-danger', 'danger');
                setTimeout(function () { window.location.href = '/login'; }, 1200);
                return;
            }
            if (window.showAgroviaToast) {
                window.showAgroviaToast('Checkout', 'Proceeding to checkout with ' + cart.reduce(function (a, b) { return a + b.qty; }, 0) + ' item(s).', 'fa fa-credit-card text-primary', 'info');
            }
        });

        $('#cartBtn, .mobile-cart-btn').on('click', function () {
            if (window.showAgroviaToast) {
                window.showAgroviaToast('Sample Cart', 'You have ' + cart.reduce(function (a, b) { return a + b.qty; }, 0) + ' sample allocation(s) in cart.', 'fa fa-shopping-cart text-primary', 'info');
            }
        });

        // RFQ In-Page Form Submission via AJAX to /inquiries
        $('#rfqDeskForm').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            var name = $.trim($form.find('input[name="name"]').val());
            var email = $.trim($form.find('input[name="email"]').val());
            if (!name || !email) {
                $('#rfqAlert').removeClass('d-none alert-success').addClass('alert alert-danger').text('Contact name and corporate email are required.');
                return;
            }

            var $btn = $('#rfqSubmitBtn');
            var origText = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Transmitting to Brazilian Trade Desk...');

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = $form.serialize();

            $.ajax({
                url: '/inquiries',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                success: function (res) {
                    var ref = res.reference || ('AGRO-INQ-' + Math.random().toString(36).substring(2, 8).toUpperCase());
                    $('#rfqAlert').removeClass('d-none alert-danger').addClass('alert alert-success').html(
                        '<strong>RFQ Logged!</strong> Reference: <code>' + ref + '</code>. Our São Paulo trade desk will contact your company within 4 business hours with indicative CIF/FOB pricing.'
                    );
                    if (window.showAgroviaToast) {
                        window.showAgroviaToast('RFQ Transmitted', 'Reference: ' + ref, 'fa fa-check-circle text-success', 'success');
                    }
                    $form[0].reset();
                },
                error: function (xhr) {
                    var errorMsg = 'Failed to submit RFQ. Please check your inputs or contact us directly on WhatsApp.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#rfqAlert').removeClass('d-none alert-success').addClass('alert alert-danger').text(errorMsg);
                },
                complete: function () {
                    $btn.prop('disabled', false).html(origText);
                }
            });
        });

        // Review Form Submission
        $('#reviewForm').on('submit', function (e) {
            e.preventDefault();
            var author = $.trim($('#reviewAuthor').val());
            var text = $.trim($('#reviewText').val());
            if (!author || !text) return;

            var modalEl = document.getElementById('reviewModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            if (window.showAgroviaToast) {
                window.showAgroviaToast('Review Received', 'Thank you for your feedback, ' + author + '.', 'fa fa-star text-warning', 'success');
            }
            this.reset();
        });

        // Animated Numerical Counters
        function animateCounter(el) {
            var target = parseInt(el.getAttribute('data-target'), 10);
            var suffix = el.getAttribute('data-suffix') || '';
            var duration = 1600;
            var startTime = null;
            function step(ts) {
                if (!startTime) startTime = ts;
                var progress = Math.min((ts - startTime) / duration, 1);
                var value = Math.floor(progress * target);
                if (target >= 1000000) {
                    el.textContent = (value / 1000000).toFixed(1) + 'M' + suffix;
                } else {
                    el.textContent = value.toLocaleString() + suffix;
                }
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }
        var counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        document.querySelectorAll('.counter').forEach(function (el) { counterObserver.observe(el); });

        // Floating Chat Widget
        $('#chatToggle').on('click', function () { $('#chatPanel').toggle(); });
        $('#chatClose').on('click', function () { $('#chatPanel').hide(); });
        $('#chatSend').on('click', function () {
            var name = $.trim($('#chatName').val());
            var msg = $.trim($('#chatMessage').val());
            var email = $.trim($('#chatEmail').val());
            var topic = $('#chatTopic').val();
            if (!name || !msg) {
                if (window.showAgroviaToast) window.showAgroviaToast('Trade Desk Chat', 'Name and message are required.', 'fa fa-exclamation-triangle text-danger', 'danger');
                return;
            }
            if (window.showAgroviaToast) {
                window.showAgroviaToast('Message Sent', 'Trade desk representative will reply to ' + email + ' regarding ' + topic + '.', 'fa fa-comments text-success', 'success');
            }
            $('#chatMessage').val('');
            $('#chatPanel').hide();
        });

    })(jQuery);
    </script>
</body>

</html>
