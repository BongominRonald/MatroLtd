<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Matro - Brazilian Agro-Commodity Trading &amp; Online Store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="agro commodities, Brazilian soybeans, sugar, lentils, bulk export, B2B, B2C, Matro" name="keywords">
    <meta content="Matro sources verified Brazilian agro-commodities for global buyers and retail customers with secure, traceable trade." name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Relief:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

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
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex flex-column align-items-center justify-content-center">
        <span class="spinner-border text-primary mb-2" role="status" style="width: 3rem; height: 3rem;"></span>
        Loading Agrovia...
    </div>
    <!-- Spinner End -->

    <!-- Header Start -->
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
                        <span class="text-primary text-uppercase font-monospace" style="font-size: 10px; letter-spacing: 1.5px; font-weight: 600;">E-COMMERCE</span>
                    </div>
                </a>

                <!-- Mobile Quick Actions (Search, Cart & Hamburger) -->
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
                        <a href="#catalog" class="nav-item nav-link px-2 px-xl-3">Products &amp; Store</a>
                        <a href="#catalog" class="nav-item nav-link px-2 px-xl-3">Services</a>
                        <a href="#ecosystem" class="nav-item nav-link px-2 px-xl-3">Process</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle px-2 px-xl-3" data-bs-toggle="dropdown">More</a>
                            <div class="dropdown-menu dropdown-menu-dark border-0 shadow mt-2">
                                <a href="#knowledge" class="dropdown-item py-2"><i class="fa fa-lightbulb text-primary me-2"></i>Insights</a>
                                <a href="#knowledge" class="dropdown-item py-2"><i class="fa fa-newspaper text-primary me-2"></i>Blog</a>
                                <a href="#knowledge" class="dropdown-item py-2"><i class="fa fa-question-circle text-primary me-2"></i>FAQ</a>
                                <a href="#proof" class="dropdown-item py-2"><i class="fa fa-certificate text-primary me-2"></i>Reviews &amp; Proof</a>
                                <hr class="dropdown-divider border-secondary my-1">
                                <a href="#ecosystem" class="dropdown-item py-2"><i class="fa fa-users text-primary me-2"></i>About Us</a>
                            </div>
                        </div>
                        <a href="#contact" class="nav-item nav-link px-2 px-xl-3">Contact</a>
                    </div>

                    <!-- Right-side Actions -->
                    <div class="agrovia-nav-actions d-flex flex-wrap align-items-center gap-2 pt-2 pt-lg-0 border-top border-lg-0 border-secondary">
                        <button type="button" class="btn btn-outline-light rounded-circle d-none d-lg-flex align-items-center justify-content-center" style="width: 38px; height: 38px;" data-bs-toggle="modal" data-bs-target="#searchModal" title="Search Products (Ctrl+K)">
                            <i class="fa fa-search"></i>
                        </button>

                        <a href="https://wa.me/5511952987545?text=Hello%20Matro%20Trade%20Desk" target="_blank" rel="noopener" class="btn btn-outline-success rounded-pill px-3 py-1 d-inline-flex align-items-center justify-content-center text-nowrap" title="Chat on WhatsApp">
                            <i class="fab fa-whatsapp fs-6 me-1 text-success"></i>
                            <span class="small fw-bold">WhatsApp</span>
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
                                            <span class="badge bg-info text-dark mt-1">Verified Customer</span>
                                        @endif
                                    </div>
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item py-2 text-warning fw-semibold">
                                            <i class="fa fa-tachometer-alt me-2 text-warning"></i>Admin Dashboard
                                        </a>
                                        <a href="{{ route('admin.products.index') }}" class="dropdown-item py-2">
                                            <i class="fa fa-boxes-stacked me-2 text-success"></i>Agro Catalog
                                        </a>
                                        <a href="{{ route('admin.orders.index') }}" class="dropdown-item py-2">
                                            <i class="fa fa-receipt me-2 text-info"></i>Sales &amp; Orders
                                        </a>
                                        <a href="{{ route('admin.inquiries.index') }}" class="dropdown-item py-2">
                                            <i class="fa fa-envelope-open-text me-2 text-primary"></i>Trade Inquiries
                                        </a>
                                        <a href="{{ route('admin.users.index') }}" class="dropdown-item py-2">
                                            <i class="fa fa-users me-2 text-light"></i>Customers
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

                        <button type="button" class="btn btn-outline-light rounded-circle d-none d-lg-flex align-items-center justify-content-center position-relative ms-1 desktop-cart-btn" style="width: 38px; height: 38px;" id="cartBtn" aria-label="Cart" title="View Cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span id="cartCount" class="cartCountBadge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">0</span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('img/carousel-1.jpg') }}" alt="Verified Brazilian farm sourcing">
                    <div class="carousel-caption">
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-10 col-md-8">
                                <h5 class="text-white mb-3 animated slideInDown"><i class="fa fa-leaf text-primary me-2"></i>Welcome to Agrovia: Verified Brazilian Agro-Commodities</h5>
                                <h1 class="display-1 text-white mb-5 animated slideInDown">From Brazilian Farms to Global Tables, Without the Risk</h1>
                                <a href="#catalog" class="btn btn-primary btn-custom rounded-pill animated slideInDown me-2">Explore Agricultural Products</a>
                                <a href="#contact" class="btn btn-outline-light rounded-pill animated slideInDown px-4 py-3">Join as a Partner</a>
                                <p class="text-light small mt-3 animated slideInDown">Escrow-backed payments · Phytosanitary-certified · Door-to-port logistics</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('img/carousel-2.jpg') }}" alt="Bulk contracts and direct online store" loading="lazy">
                    <div class="carousel-caption">
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-10 col-md-8">
                                <h5 class="text-white mb-3 animated slideInDown"><i class="fa fa-leaf text-primary me-2"></i>Bulk Contracts &amp; Direct Online Store</h5>
                                <h1 class="display-1 text-white mb-5 animated slideInDown">Source Soybeans, Sugar, Lentils &amp; More, Securely</h1>
                                <a href="#catalog" class="btn btn-primary btn-custom rounded-pill animated slideInDown me-2">Explore Agricultural Products</a>
                                <a href="#contact" class="btn btn-outline-light rounded-pill animated slideInDown px-4 py-3">Join as a Partner</a>
                                <p class="text-light small mt-3 animated slideInDown">Escrow-backed payments · Phytosanitary-certified · Door-to-port logistics</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev" aria-label="Previous Slide">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next" aria-label="Next Slide">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Header End -->

    <main>


    <!-- Catalog Start -->
    <section id="catalog" class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="section-title wow fadeIn" data-wow-delay="0.1s">
                <h5 class="mb-3"><i class="fa fa-leaf text-primary me-2"></i>Agro Products</h5>
                <h1 class="display-5 mb-4">Agro Products Straight from Brazil</h1>
            </div>
            <div class="d-flex flex-wrap gap-2 mb-3">
                <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn active" data-filter="all">All</button>
                <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Nuts & Seeds">Nuts & Seeds</button>
                <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Lentils & Pulses">Lentils & Pulses</button>
                <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Grains & Rice">Grains & Rice</button>
                <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Spices">Spices</button>
                <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Oil & Sugar">Oil & Sugar</button>
                <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Dairy">Dairy</button>
                <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Poultry">Poultry</button>
                <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Meat/Fishes">Meat/Fishes</button>
                <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Juices/Drinks">Juices/Drinks</button>
                <button type="button" class="btn btn-outline-dark rounded-pill agro-filter-btn" data-filter="Fruits/Vegetables">Fruits/Vegetables</button>
                <button type="button" class="btn btn-outline-primary rounded-pill ms-auto" id="refreshProductsBtn">Refresh All Products</button>
            </div>

            <div class="row g-4" id="catalogGrid">
                <!-- Brazilian Soybeans -->
                <div class="col-lg-3 col-md-6 product-item" data-category="Grains & Rice">
                    <div class="service-item position-relative overflow-hidden bg-white rounded p-4 h-100">
                        <div class="position-relative overflow-hidden rounded mb-3">
                            <img class="img-fluid w-100" src="{{ asset('img/service-3.jpg') }}" alt="Brazilian Soybeans" loading="lazy">
                            <span class="badge bg-primary position-absolute top-0 end-0 m-2">Bulk / B2B</span>
                        </div>
                        <h4 class="mb-2">Brazilian Soybeans</h4>
                        <p class="text-secondary small mb-2">Moisture &lt; 14% · Protein ≥ 34% · Origin: Mato Grosso, Brazil</p>
                        <div class="mb-3">
                            <span class="agro-pill"><i class="fa fa-check text-success me-1"></i>USDA Organic</span>
                            <span class="agro-pill"><i class="fa fa-check text-success me-1"></i>Non-GMO</span>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-primary btn-custom rounded-pill" data-action="specs" data-product="Brazilian Soybeans" data-specs='{"grade":"USDA #1","packaging":"Bulk vessel / 50 kg bags","moq":"25 MT","incoterms":"FOB / CIF","certificates":"Phytosanitary, Non-GMO, USDA Organic"}'>View Specifications</button>
                            <a href="https://wa.me/5511952987545?text=Quote%20request:%20Brazilian%20Soybeans" target="_blank" rel="noopener" class="btn btn-outline-success rounded-pill">WhatsApp Quote</a>
                        </div>
                    </div>
                </div>

                <!-- Yellow Maize -->
                <div class="col-lg-3 col-md-6 product-item" data-category="Grains & Rice">
                    <div class="service-item position-relative overflow-hidden bg-white rounded p-4 h-100">
                        <div class="position-relative overflow-hidden rounded mb-3">
                            <img class="img-fluid w-100" src="{{ asset('img/service-6.jpg') }}" alt="Yellow Maize" loading="lazy">
                            <span class="badge bg-primary position-absolute top-0 end-0 m-2">Bulk / B2B</span>
                        </div>
                        <h4 class="mb-2">Yellow Maize</h4>
                        <p class="text-secondary small mb-2">Moisture &lt; 14% · Broken &lt; 3% · Origin: Brazil</p>
                        <div class="mb-3">
                            <span class="agro-pill"><i class="fa fa-check text-success me-1"></i>Non-GMO</span>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-primary btn-custom rounded-pill" data-action="specs" data-product="Yellow Maize" data-specs='{"grade":"Feed grade","packaging":"Bulk / 50 kg bags","moq":"25 MT","incoterms":"FOB / CIF","certificates":"Phytosanitary"}'>View Specifications</button>
                            <a href="https://wa.me/5511952987545?text=Quote%20request:%20Yellow%20Maize" target="_blank" rel="noopener" class="btn btn-outline-success rounded-pill">WhatsApp Quote</a>
                        </div>
                    </div>
                </div>

                <!-- ICUMSA 45 Refined Sugar -->
                <div class="col-lg-3 col-md-6 product-item" data-category="Oil & Sugar">
                    <div class="service-item position-relative overflow-hidden bg-white rounded p-4 h-100">
                        <div class="position-relative overflow-hidden rounded mb-3">
                            <!-- REPLACE: dedicated product photo -->
                            <img class="img-fluid w-100" src="{{ asset('img/service-2.jpg') }}" alt="ICUMSA 45 Refined Sugar" loading="lazy">
                            <span class="badge bg-primary position-absolute top-0 end-0 m-2">Bulk / B2B</span>
                        </div>
                        <h4 class="mb-2">ICUMSA 45 Refined Sugar</h4>
                        <p class="text-secondary small mb-2">ICUMSA ≤ 45 · Moisture ≤ 0.04% · 50 kg bags</p>
                        <div class="mb-3">
                            <span class="agro-pill"><i class="fa fa-check text-success me-1"></i>Phytosanitary Certified</span>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-primary btn-custom rounded-pill" data-action="specs" data-product="ICUMSA 45 Refined Sugar" data-specs='{"grade":"ICUMSA 45","packaging":"50 kg PP bags","moq":"25 MT","incoterms":"FOB / CIF","certificates":"Phytosanitary, Quality lab report"}'>View Specifications</button>
                            <a href="https://wa.me/5511952987545?text=Quote%20request:%20ICUMSA%2045%20Refined%20Sugar" target="_blank" rel="noopener" class="btn btn-outline-success rounded-pill">WhatsApp Quote</a>
                        </div>
                    </div>
                </div>

                <!-- Green Lentils -->
                <div class="col-lg-3 col-md-6 product-item" data-category="Lentils & Pulses">
                    <div class="service-item position-relative overflow-hidden bg-white rounded p-4 h-100">
                        <div class="position-relative overflow-hidden rounded mb-3">
                            <!-- REPLACE: dedicated product photo -->
                            <img class="img-fluid w-100" src="{{ asset('img/service-3.jpg') }}" alt="Green Lentils" loading="lazy">
                            <span class="badge bg-primary position-absolute top-0 end-0 m-2">Bulk / B2B</span>
                        </div>
                        <h4 class="mb-2">Green Lentils</h4>
                        <p class="text-secondary small mb-2">Purity 99% · MOQ 25 MT</p>
                        <div class="mb-3">
                            <span class="agro-pill"><i class="fa fa-check text-success me-1"></i>Non-GMO</span>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-primary btn-custom rounded-pill" data-action="specs" data-product="Green Lentils" data-specs='{"grade":"Premium green","packaging":"25 / 50 kg bags","moq":"25 MT","incoterms":"FOB / CIF","certificates":"Phytosanitary"}'>View Specifications</button>
                            <a href="https://wa.me/5511952987545?text=Quote%20request:%20Green%20Lentils" target="_blank" rel="noopener" class="btn btn-outline-success rounded-pill">WhatsApp Quote</a>
                        </div>
                    </div>
                </div>

                <!-- Sesame / Sunflower Seeds Sample Pack -->
                <div class="col-lg-3 col-md-6 product-item" data-category="Nuts & Seeds">
                    <div class="service-item position-relative overflow-hidden bg-white rounded p-4 h-100">
                        <div class="position-relative overflow-hidden rounded mb-3">
                            <img class="img-fluid w-100" src="{{ asset('img/service-7.jpg') }}" alt="Sesame and Sunflower Seeds Sample Pack" loading="lazy">
                            <span class="badge bg-success position-absolute top-0 end-0 m-2">Retail / Sample</span>
                        </div>
                        <h4 class="mb-2">Sesame / Sunflower Seeds Sample Pack</h4>
                        <p class="text-secondary small mb-2">$45.00 / Sample Pack</p>
                        <div class="mb-3">
                            <span class="agro-pill"><i class="fa fa-check text-success me-1"></i>In Season</span>
                        </div>
                        <button type="button" class="btn btn-primary btn-custom rounded-pill" data-action="quickview" data-product="Sesame / Sunflower Seeds Sample Pack" data-price="$45.00" data-image="{{ asset('img/service-7.jpg') }}">View &amp; Buy</button>
                    </div>
                </div>

                <!-- Premium Rice Sample Pack -->
                <div class="col-lg-3 col-md-6 product-item" data-category="Grains & Rice">
                    <div class="service-item position-relative overflow-hidden bg-white rounded p-4 h-100">
                        <div class="position-relative overflow-hidden rounded mb-3">
                            <img class="img-fluid w-100" src="{{ asset('img/service-2.jpg') }}" alt="Premium Rice Sample Pack 5 kg" loading="lazy">
                            <span class="badge bg-success position-absolute top-0 end-0 m-2">Retail / Sample</span>
                        </div>
                        <h4 class="mb-2">Premium Rice Sample Pack (5 kg)</h4>
                        <p class="text-secondary small mb-2">$28.00 / 5 kg Pack</p>
                        <div class="mb-3">
                            <span class="agro-pill"><i class="fa fa-check text-success me-1"></i>In Season</span>
                        </div>
                        <button type="button" class="btn btn-primary btn-custom rounded-pill" data-action="quickview" data-product="Premium Rice Sample Pack (5 kg)" data-price="$28.00" data-image="{{ asset('img/service-2.jpg') }}">View &amp; Buy</button>
                    </div>
                </div>

                <!-- Fresh Produce Box -->
                <div class="col-lg-3 col-md-6 product-item" data-category="Fruits/Vegetables">
                    <div class="service-item position-relative overflow-hidden bg-white rounded p-4 h-100">
                        <div class="position-relative overflow-hidden rounded mb-3">
                            <img class="img-fluid w-100" src="{{ asset('img/service-8.jpg') }}" alt="Fresh Produce Box" loading="lazy">
                            <span class="badge bg-success position-absolute top-0 end-0 m-2">Retail / Sample</span>
                        </div>
                        <h4 class="mb-2">Fresh Produce Box</h4>
                        <p class="text-secondary small mb-2">$39.00 / Seasonal Box</p>
                        <div class="mb-3">
                            <span class="agro-pill"><i class="fa fa-check text-success me-1"></i>In Season</span>
                        </div>
                        <button type="button" class="btn btn-primary btn-custom rounded-pill" data-action="quickview" data-product="Fresh Produce Box" data-price="$39.00" data-image="{{ asset('img/service-8.jpg') }}">View &amp; Buy</button>
                    </div>
                </div>

                <!-- Carrots, Bulk Fresh -->
                <div class="col-lg-3 col-md-6 product-item" data-category="Fruits/Vegetables">
                    <div class="service-item position-relative overflow-hidden bg-white rounded p-4 h-100">
                        <div class="position-relative overflow-hidden rounded mb-3">
                            <img class="img-fluid w-100" src="{{ asset('img/service-4.jpg') }}" alt="Carrots Bulk Fresh" loading="lazy">
                            <span class="badge bg-primary position-absolute top-0 end-0 m-2">Bulk / B2B</span>
                        </div>
                        <h4 class="mb-2">Carrots, Bulk Fresh</h4>
                        <p class="text-secondary small mb-2">Grade A · Cold-chain 2 to 4 °C</p>
                        <div class="mb-3">
                            <span class="agro-pill"><i class="fa fa-check text-success me-1"></i>Phytosanitary Certified</span>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-primary btn-custom rounded-pill" data-action="specs" data-product="Carrots, Bulk Fresh" data-specs='{"grade":"Grade A","packaging":"20 kg crates","moq":"5 MT","incoterms":"FOB / CIF","certificates":"Phytosanitary"}'>View Specifications</button>
                            <a href="https://wa.me/5511952987545?text=Quote%20request:%20Carrots%20Bulk%20Fresh" target="_blank" rel="noopener" class="btn btn-outline-success rounded-pill">WhatsApp Quote</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="#" class="btn btn-primary btn-custom rounded-pill px-5 py-3">Visit Full Online Store</a>
            </div>
        </div>
    </section>
    <!-- Catalog End -->

    <!-- Ecosystem Start -->
    <section id="ecosystem" class="container-fluid py-5 position-relative" style="background: url('{{ asset('img/hero-bg.jpg') }}') center/cover no-repeat;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(24,24,24,.75);"></div>
        <div class="container py-5 position-relative">
            <div class="section-title wow fadeIn" data-wow-delay="0.1s">
                <h5 class="mb-3 text-white"><i class="fa fa-leaf text-primary me-2"></i>Agro-Ecosystem</h5>
                <h1 class="display-5 text-white mb-5">Operation Model</h1>
            </div>

            <div class="row g-4 align-items-center mb-4" id="ecoSteps">
                <div class="col-lg-4">
                    <div class="bg-white rounded p-4 h-100 eco-step" tabindex="0" role="button" data-step="1" aria-expanded="false">
                        <div class="d-flex align-items-center mb-2">
                            <span class="btn-lg-square rounded-circle bg-primary text-dark me-2">1</span>
                            <h4 class="mb-0">Source: Farms and Co-ops</h4>
                        </div>
                        <p class="text-secondary small mb-0">Verified farms, traceable lots, harvest scheduling.</p>
                    </div>
                </div>
                <div class="col-lg-1 text-center d-none d-lg-block">
                    <i class="fa fa-arrow-right fa-2x text-primary"></i>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white rounded p-4 h-100 eco-step" tabindex="0" role="button" data-step="2" aria-expanded="false">
                        <div class="d-flex align-items-center mb-2">
                            <span class="btn-lg-square rounded-circle bg-primary text-dark me-2">2</span>
                            <h4 class="mb-0">Platform: QC, Logistics, Finance</h4>
                        </div>
                        <p class="text-secondary small mb-0">Lab grading, phytosanitary documentation, freight and cold-chain, trade finance and escrow.</p>
                    </div>
                </div>
                <div class="col-lg-1 text-center d-none d-lg-block">
                    <i class="fa fa-arrow-right fa-2x text-primary"></i>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white rounded p-4 h-100 eco-step" tabindex="0" role="button" data-step="3" aria-expanded="false">
                        <div class="d-flex align-items-center mb-2">
                            <span class="btn-lg-square rounded-circle bg-primary text-dark me-2">3</span>
                            <h4 class="mb-0">Downstream: Retailers &amp; Wholesalers</h4>
                        </div>
                        <p class="text-secondary small mb-0">Port-to-door delivery, repeat contracts, B2C store fulfillment.</p>
                    </div>
                </div>
            </div>

            <div class="progress mb-4" style="height: 8px;">
                <div id="ecoProgress" class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <div id="ecoDetail" class="bg-white rounded p-4">
                <h5 class="mb-2" id="ecoDetailTitle">Source: Farms and Co-ops</h5>
                <p class="text-secondary mb-0" id="ecoDetailText">Verified farms, traceable lots and harvest scheduling across Brazil's producing regions.</p>
            </div>
        </div>
    </section>
    <!-- Ecosystem End -->

    <!-- Knowledge Start -->
    <section id="knowledge" class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center mb-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <h5 class="mb-3"><i class="fa fa-leaf text-primary me-2"></i>Industry Insights</h5>
                    <h1 class="display-5 mb-4">Knowledge &amp; Trust</h1>
                    <p class="text-secondary mb-4">Standard operating procedures, phytosanitary guides and crop manuals, free for registered partners.</p>
                    <a href="#" class="btn btn-outline-dark rounded-pill px-4">Explore Insights</a>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <img class="img-fluid rounded" src="{{ asset('img/feature-2.jpg') }}" alt="Quality control and insights" loading="lazy">
                </div>
            </div>

            <div class="section-title wow fadeIn" data-wow-delay="0.1s">
                <h5 class="mb-3"><i class="fa fa-leaf text-primary me-2"></i>Trade Desk Blog</h5>
                <h1 class="display-5 mb-5">Latest From the Trade Desk</h1>
            </div>
            <div class="row g-4 mb-4">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="blog-item position-relative overflow-hidden bg-white rounded h-100 p-4 shadow-sm">
                        <div class="d-flex align-items-center justify-content-center mb-2 text-muted small">
                            <span>14 Oct 2026</span>
                            <hr class="mx-3">
                            <span class="text-primary fw-bold">Compliance</span>
                        </div>
                        <a href="#" class="h5 lh-base d-block text-center mb-4 text-dark text-decoration-none">Navigating Brazilian Soybean Export Regulations</a>
                        <div class="position-relative overflow-hidden rounded">
                            <img class="img-fluid rounded w-100" src="{{ asset('img/blog-1.jpg') }}" alt="Soybean export regulations" loading="lazy">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="blog-item position-relative overflow-hidden bg-white rounded h-100 p-4 shadow-sm">
                        <div class="d-flex align-items-center justify-content-center mb-2 text-muted small">
                            <span>28 Sep 2026</span>
                            <hr class="mx-3">
                            <span class="text-primary fw-bold">Quality</span>
                        </div>
                        <a href="#" class="h5 lh-base d-block text-center mb-4 text-dark text-decoration-none">ICUMSA 45 Sugar Quality Checks</a>
                        <div class="position-relative overflow-hidden rounded">
                            <img class="img-fluid rounded w-100" src="{{ asset('img/blog-2.jpg') }}" alt="Sugar quality checks" loading="lazy">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="blog-item position-relative overflow-hidden bg-white rounded h-100 p-4 shadow-sm">
                        <div class="d-flex align-items-center justify-content-center mb-2 text-muted small">
                            <span>15 Sep 2026</span>
                            <hr class="mx-3">
                            <span class="text-primary fw-bold">Logistics</span>
                        </div>
                        <a href="#" class="h5 lh-base d-block text-center mb-4 text-dark text-decoration-none">Cold-Chain Basics for Exporting Dairy</a>
                        <div class="position-relative overflow-hidden rounded">
                            <img class="img-fluid rounded w-100" src="{{ asset('img/blog-3.jpg') }}" alt="Cold chain dairy" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mb-5">
                <a href="#" class="btn btn-outline-primary rounded-pill px-4">Read the Blog</a>
            </div>

            <div class="section-title wow fadeIn" data-wow-delay="0.1s">
                <h5 class="mb-3"><i class="fa fa-leaf text-primary me-2"></i>FAQ</h5>
                <h1 class="display-5 mb-4">Frequently Asked Questions</h1>
            </div>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">What phytosanitary certificate requirements apply to export?</button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">All bulk lots ship with phytosanitary certificates and lab grading reports aligned to destination country requirements.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">What are the Minimum Order Quantities for Lentils?</button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">Standard MOQ for lentils and pulses is 25 MT; smaller sample packs are available via the online store.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">How is cold-chain logistics handled for Dairy?</button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">Dairy moves under monitored cold-chain with temperature logs and validated packaging.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">How does Guaranteed Payment work?</button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">Escrow-backed settlement releases funds against verified documentation and delivery milestones.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">Can I buy a sample before a bulk order?</button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">Yes, retail and sample packs are available with live add-to-cart checkout.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Knowledge End -->

    <!-- Social Proof Start -->
    <section id="proof" class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4 text-center mb-5">
                <div class="col-6 col-lg-3">
                    <div class="bg-white rounded p-4 shadow-sm h-100">
                        <h2 class="display-5 text-primary mb-1 counter" data-target="45" data-suffix="+">0</h2>
                        <p class="text-secondary mb-0">Countries Served</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="bg-white rounded p-4 shadow-sm h-100">
                        <h2 class="display-5 text-primary mb-1 counter" data-target="1200" data-suffix="+">0</h2>
                        <p class="text-secondary mb-0">Verified Farms</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="bg-white rounded p-4 shadow-sm h-100">
                        <h2 class="display-5 text-primary mb-1 counter" data-target="2500000" data-suffix="+">0</h2>
                        <p class="text-secondary mb-0">Tons Exported Annually</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="bg-white rounded p-4 shadow-sm h-100">
                        <h2 class="display-5 text-primary mb-1 counter" data-target="98" data-suffix="%">0</h2>
                        <p class="text-secondary mb-0">On-Time Delivery</p>
                    </div>
                </div>
            </div>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="bg-white rounded p-4 shadow-sm text-center">
                                    <div class="text-warning mb-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                    <p class="text-secondary">"Guaranteed payment changed how we plan the season."</p>
                                    <div class="d-flex align-items-center justify-content-center mt-3">
                                        <img class="rounded-circle me-3" width="100" height="100" src="{{ asset('img/testimonial-1.jpg') }}" alt="Grower testimonial" loading="lazy">
                                        <div class="text-start">
                                            <h6 class="mb-0 fw-bold">Verified Grower</h6>
                                            <small class="text-muted">Mato Grosso, Brazil</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="bg-white rounded p-4 shadow-sm text-center">
                                    <div class="text-warning mb-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                    <p class="text-secondary">"Consistent grading and clean documentation on every container."</p>
                                    <div class="d-flex align-items-center justify-content-center mt-3">
                                        <img class="rounded-circle me-3" width="100" height="100" src="{{ asset('img/testimonial-2.jpg') }}" alt="Global retailer testimonial" loading="lazy">
                                        <div class="text-start">
                                            <h6 class="mb-0 fw-bold">Global Retailer</h6>
                                            <small class="text-muted">Import Buyer</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="bg-white rounded p-4 shadow-sm text-center">
                                    <div class="text-warning mb-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                    <p class="text-secondary">"Zero cost onboarding and steady volume from day one."</p>
                                    <div class="d-flex align-items-center justify-content-center mt-3">
                                        <img class="rounded-circle me-3" width="100" height="100" src="{{ asset('img/testimonial-3.jpg') }}" alt="Logistics partner testimonial" loading="lazy">
                                        <div class="text-start">
                                            <h6 class="mb-0 fw-bold">Logistics Partner</h6>
                                            <small class="text-muted">Freight &amp; Cold-Chain</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" aria-label="Previous Testimonial">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" aria-label="Next Testimonial">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>

            <div class="text-center mt-4">
                <button type="button" class="btn btn-outline-success rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#reviewModal">
                    <i class="fa fa-star text-warning me-1"></i>Leave a Review
                </button>
            </div>
        </div>
    </section>
    <!-- Social Proof End -->

    </main>

    <!-- Newsletter Start -->
    <div class="container-fluid newsletter bg-dark py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="display-5 text-white mb-4">Subscribe to the Trade Desk Digest</h1>
                    <p class="text-light mb-4">Weekly price indications, phytosanitary updates and new lots.</p>
                    <form class="newsletter-form position-relative w-100 mb-2">
                        <input class="form-control rounded-pill border-0 w-100 ps-4 pe-5" type="email" placeholder="Enter your email" style="height: 60px;" required>
                        <button type="submit" class="btn btn-lg-square shadow-none position-absolute top-0 end-0 mt-1 me-2" aria-label="Subscribe">
                            <i class="fa fa-paper-plane text-primary fs-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->

    <!-- Footer Start -->
    <footer id="contact" class="bg-[#212529] text-gray-300 border-t border-[#d4af37]/30">
        <div class="container mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="space-y-6">
                    <div>
                        <span class="text-2xl font-bold text-white block">Agrovia</span>
                        <span class="text-xs text-[#d4af37] tracking-widest uppercase flex items-center gap-2 mt-1">Brazilian Agro-Commodities</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed text-sm">Connecting verified Brazilian farms with global buyers through secure, traceable and fully documented agro-commodity trade.</p>
                    <div class="flex space-x-4">
                        <a href="https://facebook.com" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center hover:bg-[#d4af37] hover:text-[#1e3a8a] transition-all" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center hover:bg-[#d4af37] hover:text-[#1e3a8a] transition-all" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
                        <a href="https://linkedin.com" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center hover:bg-[#d4af37] hover:text-[#1e3a8a] transition-all" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-6 relative inline-block">Quick Links<span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-[#d4af37]"></span></h4>
                    <nav class="space-y-3">
                        <a href="#ecosystem" class="block hover:text-[#d4af37] transition-colors duration-300">About Us</a>
                        <a href="#catalog" class="block hover:text-[#d4af37] transition-colors duration-300">Services</a>
                        <a href="#catalog" class="block hover:text-[#d4af37] transition-colors duration-300">Products</a>
                        <a href="#knowledge" class="block hover:text-[#d4af37] transition-colors duration-300">Blog</a>
                        <a href="#knowledge" class="block hover:text-[#d4af37] transition-colors duration-300">FAQ</a>
                        <a href="#contact" class="block hover:text-[#d4af37] transition-colors duration-300">Contact</a>
                    </nav>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-6 relative inline-block">Ecosystem<span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-[#d4af37]"></span></h4>
                    <ul class="space-y-3">
                        <li class="text-gray-400 hover:text-white transition-colors">Capital Providers</li>
                        <li class="text-gray-400 hover:text-white transition-colors">Resource Suppliers</li>
                        <li class="text-gray-400 hover:text-white transition-colors">Channel Distributors</li>
                        <li class="text-gray-400 hover:text-white transition-colors">Logistics Partners</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-6 relative inline-block">Contact<span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-[#d4af37]"></span></h4>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <i class="fa fa-map-marker-alt text-[#d4af37] mt-1 flex-shrink-0"></i>
                            <div class="text-sm text-gray-400">
                                <p>HQ: Cuiabá, Mato Grosso, Brazil</p>
                                <p>Ops Center: São Paulo, Brazil</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fa fa-envelope text-[#d4af37] flex-shrink-0"></i>
                            <a href="mailto:contact@agrovia.com" class="text-sm text-gray-400 hover:text-white transition-colors">contact@agrovia.com</a>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fa fa-phone text-[#d4af37] flex-shrink-0"></i>
                            <a href="tel:+5511952987545" class="text-sm text-gray-400 hover:text-white transition-colors">+55 (11) 95298-7545</a>
                        </div>
                        <div class="flex items-center space-x-3 mt-2">
                            <a href="https://wa.me/5511952987545" target="_blank" rel="noopener" class="flex items-center gap-2 bg-[#25D366] text-white px-3 py-1.5 rounded-full text-xs font-bold hover:bg-green-600 transition-colors">
                                <i class="fab fa-whatsapp"></i> WhatsApp Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-400">&copy; {{ date('Y') }} Agrovia. All rights reserved.</p>
                <div class="flex space-x-6 text-sm text-gray-400">
                    <span class="flex items-center gap-1"><i class="fa fa-check-circle"></i> Phytosanitary Certified</span>
                    <span class="flex items-center gap-1"><i class="fa fa-check-circle"></i> USDA Organic</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" aria-label="Back to Top"><i class="bi bi-arrow-up"></i></a>

    <!-- Floating Chat Widget -->
    <div id="chatWidget" style="position: fixed; bottom: 110px; right: 45px; z-index: 999;">
        <button type="button" id="chatToggle" class="btn btn-primary btn-lg-square rounded-circle shadow" aria-label="Chat with trade desk">
            <i class="fa fa-comments"></i>
        </button>
        <div id="chatPanel" class="bg-white rounded shadow p-3 mt-2" style="width: 300px; display: none;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <strong class="text-dark">Trade Desk online</strong>
                <button type="button" class="btn-close" id="chatClose" aria-label="Close"></button>
            </div>
            <input type="text" id="chatName" class="form-control rounded-pill mb-2" placeholder="Name">
            <input type="email" id="chatEmail" class="form-control rounded-pill mb-2" placeholder="Email">
            <select id="chatTopic" class="form-select rounded-pill mb-2">
                <option>Grower</option>
                <option>Buyer</option>
                <option>Partner</option>
                <option>Order status</option>
            </select>
            <textarea id="chatMessage" class="form-control mb-2" rows="3" placeholder="Message"></textarea>
            <button type="button" id="chatSend" class="btn btn-primary btn-custom rounded-pill w-100">Send</button>
        </div>
    </div>

    <!-- Modals -->
    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="searchModalLabel"><i class="fa fa-search text-primary me-2"></i>Search Agrovia Platform</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="position-relative mb-4">
                        <input type="text" id="agroviaSearchInput" class="form-control search-input" placeholder="Type product, category, FAQ or insight keyword...">
                    </div>
                    <div id="searchResultsContainer" style="max-height: 380px; overflow-y: auto;">
                        <div class="text-center text-muted py-4">
                            <i class="fa fa-seedling fa-2x mb-2 text-success opacity-75"></i>
                            <p class="mb-0">Start typing to explore agro products and resources.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 text-muted small d-flex justify-content-between">
                    <span><kbd>Esc</kbd> to exit | <kbd>/</kbd> or <kbd>Ctrl+K</kbd> to launch search</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quote Modal -->
    <div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold text-white" id="quoteModalLabel"><i class="fa fa-calculator me-2"></i>Request Bulk Quote</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="quoteModalAlert" class="d-none"></div>
                    <form id="quoteModalForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Full Name *</label>
                                <input type="text" name="name" class="form-control rounded-pill" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Email *</label>
                                <input type="email" name="email" class="form-control rounded-pill" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Phone *</label>
                                <input type="tel" name="phone" class="form-control rounded-pill" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Product Category *</label>
                                <select name="produce_type" class="form-select rounded-pill" required>
                                    <option value="Grains & Rice">Grains & Rice</option>
                                    <option value="Oil & Sugar">Oil & Sugar</option>
                                    <option value="Lentils & Pulses">Lentils & Pulses</option>
                                    <option value="Nuts & Seeds">Nuts & Seeds</option>
                                    <option value="Fruits/Vegetables">Fruits/Vegetables</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Quantity</label>
                                <input type="text" name="quantity" class="form-control rounded-pill">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Delivery Date</label>
                                <input type="date" name="delivery_date" class="form-control rounded-pill">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Notes</label>
                                <textarea name="notes" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-12 text-end pt-2">
                                <button type="button" class="btn btn-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-custom rounded-pill px-5">Submit Quote Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Spec Modal -->
    <div class="modal fade" id="specModal" tabindex="-1" aria-labelledby="specModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white fw-bold" id="specModalLabel">Specifications</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" id="specModalBody">
                </div>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white fw-bold" id="quickViewLabel">Quick View</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <img id="qvImage" class="img-fluid rounded mb-3" src="" alt="">
                    <h4 id="qvTitle"></h4>
                    <p class="text-primary fw-bold" id="qvPrice"></p>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Quantity</label>
                        <input type="number" id="qvQty" class="form-control rounded-pill" value="1" min="1">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" id="qvAddToCart" class="btn btn-primary btn-custom rounded-pill">Add to Cart</button>
                        <button type="button" id="qvCheckout" class="btn btn-outline-dark rounded-pill px-4">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inquiry Modal -->
    <div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white fw-bold" id="inquiryModalLabel">Inquiry</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="inquiryAlert" class="d-none"></div>
                    <form id="inquiryForm">
                        <input type="hidden" name="role" id="inquiryRole">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Full Name *</label>
                                <input type="text" name="name" class="form-control rounded-pill" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Email *</label>
                                <input type="email" name="email" class="form-control rounded-pill" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Phone / WhatsApp</label>
                                <input type="tel" name="phone" class="form-control rounded-pill">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Country</label>
                                <input type="text" name="country" class="form-control rounded-pill">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Company</label>
                                <input type="text" name="company" class="form-control rounded-pill">
                            </div>
                            <div class="col-md-6" id="buyerFields" style="display:none;">
                                <label class="form-label small fw-bold">Product / Quantity / Destination Port</label>
                                <input type="text" name="buyer_detail" class="form-control rounded-pill" placeholder="Soybeans, 25 MT, Santos">
                            </div>
                            <div class="col-md-6" id="partnerFields" style="display:none;">
                                <label class="form-label small fw-bold">Service Type</label>
                                <select name="service_type" class="form-select rounded-pill">
                                    <option value="freight">Freight</option>
                                    <option value="cold-chain">Cold-chain</option>
                                    <option value="trade-finance">Trade finance</option>
                                    <option value="insurance">Insurance</option>
                                </select>
                            </div>
                            <div class="col-md-6" id="growerFields" style="display:none;">
                                <label class="form-label small fw-bold">Farm / Crop Details</label>
                                <input type="text" name="grower_detail" class="form-control rounded-pill" placeholder="Farm location, crop, volume">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Message</label>
                                <textarea name="message" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-12 text-end pt-2">
                                <button type="button" class="btn btn-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-custom rounded-pill px-5">Submit Inquiry</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title text-white fw-bold" id="reviewModalLabel"><i class="fa fa-star text-warning me-2"></i>Rate Agrovia</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="reviewForm">
                        <input type="hidden" id="ratingValue" value="5">
                        <div class="text-center mb-3">
                            <label class="form-label d-block text-secondary small fw-bold">Your Overall Rating</label>
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
                            <input type="text" id="reviewAuthor" class="form-control rounded-pill" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Role / Organization</label>
                            <input type="text" id="reviewRole" class="form-control rounded-pill">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Review Commentary *</label>
                            <textarea id="reviewText" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-custom rounded-pill">Publish Review</button>
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

        // Product filter
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

        // Refresh products (shuffle DOM order)
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
                window.showAgroviaToast('Products Refreshed', 'Featured set re-randomized.', 'fa fa-sync text-primary', 'info');
            }
        });

        // Specification modal
        $('[data-action="specs"]').on('click', function () {
            var title = $(this).attr('data-product');
            var specs = {};
            try { specs = JSON.parse($(this).attr('data-specs')); } catch (e) {}
            var html = '<h5 class="mb-3">' + title + '</h5><ul class="list-group">';
            Object.keys(specs).forEach(function (k) {
                html += '<li class="list-group-item d-flex justify-content-between"><span class="fw-bold text-capitalize">' + k + '</span><span>' + specs[k] + '</span></li>';
            });
            html += '</ul>';
            $('#specModalLabel').text(title + ' - Specifications');
            $('#specModalBody').html(html);
            var modal = new bootstrap.Modal(document.getElementById('specModal'));
            modal.show();
        });

        // Quick view modal
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

        // Cart
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
                if (window.showAgroviaToast) window.showAgroviaToast('Login Required', 'Please log in or register to add items to cart.', 'fa fa-lock text-danger', 'danger');
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
                window.showAgroviaToast('Cart', 'You have ' + cart.reduce(function (a, b) { return a + b.qty; }, 0) + ' item(s) in cart.', 'fa fa-shopping-cart text-primary', 'info');
            }
        });

        // Inquiry modal role handling
        $('#inquiryModal').on('show.bs.modal', function (e) {
            var trigger = $(e.relatedTarget);
            var role = trigger.attr('data-role') || 'buyer';
            $('#inquiryRole').val(role);
            $('#buyerFields, #partnerFields, #growerFields').hide();
            if (role === 'buyer') { $('#buyerFields').show(); $('#inquiryModalLabel').text('Buyer / Importer Inquiry'); }
            if (role === 'partner') { $('#partnerFields').show(); $('#inquiryModalLabel').text('Logistics / Financial Partner Inquiry'); }
            if (role === 'grower') { $('#growerFields').show(); $('#inquiryModalLabel').text('Grower / Supplier Inquiry'); }
        });

        $('#inquiryForm').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            var name = $.trim($form.find('input[name="name"]').val());
            var email = $.trim($form.find('input[name="email"]').val());
            if (!name || !email) {
                $('#inquiryAlert').removeClass('d-none alert-success').addClass('alert alert-danger').text('Name and email are required.');
                return;
            }
            var $btn = $form.find('button[type="submit"]');
            var originalBtnText = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span>Submitting...');

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
                    $('#inquiryAlert').removeClass('d-none alert-danger').addClass('alert alert-success').html('<strong>Inquiry Logged!</strong> Reference: <code>' + ref + '</code>. Our trade desk will contact you promptly.');
                    if (window.showAgroviaToast) {
                        window.showAgroviaToast('Inquiry Transmitted', 'Ref: ' + ref, 'fa fa-check-circle text-success', 'success');
                    }
                    $form[0].reset();
                },
                error: function (xhr) {
                    var errorMsg = 'Failed to submit inquiry. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#inquiryAlert').removeClass('d-none alert-success').addClass('alert alert-danger').text(errorMsg);
                },
                complete: function () {
                    $btn.prop('disabled', false).html(originalBtnText);
                }
            });
        });

        // Ecosystem steps
        var ecoData = {
            1: { title: 'Source: Farms and Co-ops', text: 'Verified farms, traceable lots and harvest scheduling across Brazil\'s producing regions.' },
            2: { title: 'Platform: QC, Logistics, Finance', text: 'Lab grading, phytosanitary documentation, freight and cold-chain booking, trade finance and escrow.' },
            3: { title: 'Downstream: Retailers & Wholesalers', text: 'Port-to-door delivery, repeat contracts and B2C store fulfillment.' }
        };
        function setEco(step) {
            $('.eco-step').removeClass('border border-primary');
            $('.eco-step[data-step="' + step + '"]').addClass('border border-primary');
            $('#ecoDetailTitle').text(ecoData[step].title);
            $('#ecoDetailText').text(ecoData[step].text);
            $('#ecoProgress').css('width', (step * 33.33) + '%').attr('aria-valuenow', step * 33);
        }
        $('.eco-step').on('click keydown', function (e) {
            if (e.type === 'keydown' && e.key !== 'Enter' && e.key !== ' ') return;
            e.preventDefault();
            setEco(parseInt($(this).attr('data-step'), 10));
        });
        setEco(1);

        // Counters
        function animateCounter(el) {
            var target = parseInt(el.getAttribute('data-target'), 10);
            var suffix = el.getAttribute('data-suffix') || '';
            var duration = 1500;
            var start = 0;
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
        }, { threshold: 0.4 });
        document.querySelectorAll('.counter').forEach(function (el) { counterObserver.observe(el); });

        // Chat widget
        $('#chatToggle').on('click', function () { $('#chatPanel').toggle(); });
        $('#chatClose').on('click', function () { $('#chatPanel').hide(); });
        $('#chatSend').on('click', function () {
            var name = $.trim($('#chatName').val());
            var email = $.trim($('#chatEmail').val());
            var topic = $('#chatTopic').val();
            var msg = $.trim($('#chatMessage').val());
            if (!name || !msg) {
                if (window.showAgroviaToast) window.showAgroviaToast('Chat', 'Name and message required.', 'fa fa-exclamation-triangle text-danger', 'danger');
                return;
            }
            if (window.showAgroviaToast) window.showAgroviaToast('Message Sent', 'Trade Desk will reply to ' + email + ' about ' + topic + '.', 'fa fa-comments text-success', 'success');
            $('#chatMessage').val('');
        });

    })(jQuery);
    </script>
</body>

</html>
