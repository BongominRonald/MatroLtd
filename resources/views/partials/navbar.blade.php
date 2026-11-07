<!-- Top Announcement Bar -->
<div class="matro-topbar py-1.5 px-3 text-white small border-bottom border-dark" style="background: #0f172a; font-size: 0.82rem;">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-success-subtle text-success border border-success-subtle py-0.5 px-2 fw-semibold">
                <i class="bi bi-shield-check me-1"></i>Verified Export
            </span>
            <span class="text-white-50 d-none d-md-inline">Direct from Brazilian Harvest Basins • SGS &amp; Phytosanitary Certified</span>
        </div>
        <div class="d-flex align-items-center gap-3 ms-auto">
            <a href="https://wa.me/5511952987545?text=Hello%20Matro%20Trade%20Desk" target="_blank" class="text-white-50 text-decoration-none hover-white d-inline-flex align-items-center gap-1">
                <i class="bi bi-whatsapp text-success"></i>
                <span class="d-none d-sm-inline">+55 11 95298-7545</span>
            </a>
            <span class="text-white-50">|</span>
            <span class="text-warning fw-semibold"><i class="bi bi-currency-dollar me-0.5"></i>USD Settlement</span>
        </div>
    </div>
</div>

<!-- Main Sticky Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top matro-main-navbar py-2.5 shadow-sm" style="background: rgba(15, 23, 42, 0.96); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container">
        <!-- Brand Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2.5 py-1" href="{{ route('home') }}">
            <span class="d-inline-flex align-items-center justify-content-center bg-gradient rounded-3 text-white shadow-sm" style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981, #059669);">
                <i class="bi bi-flower1 fs-5"></i>
            </span>
            <div class="d-flex flex-column">
                <span class="fs-4 fw-black text-white lh-1 tracking-tight" style="font-weight: 800; letter-spacing: -0.5px;">MATRO</span>
                <span class="text-success font-monospace" style="font-size: 9px; letter-spacing: 2px; font-weight: 700;">AGRO E-COMMERCE</span>
            </div>
        </a>

        <!-- Mobile Controls (Cart & Toggler) -->
        <div class="d-flex align-items-center gap-2 d-lg-none ms-auto me-2">
            <button type="button" class="btn btn-outline-light btn-sm rounded-circle position-relative cart-drawer-trigger p-0 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;" aria-label="View Cart">
                <i class="bi bi-bag fs-6"></i>
                <span class="cart-badge-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                    {{ collect(session('cart', []))->sum('quantity') }}
                </span>
            </button>
            <button class="navbar-toggler border-0 p-1.5 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#storefrontNav" aria-controls="storefrontNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Collapsible Navigation -->
        <div class="collapse navbar-collapse" id="storefrontNav">
            <!-- Navigation Links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('home') ? 'active text-success fw-bold' : 'text-white-75' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('shop.*') ? 'active text-success fw-bold' : 'text-white-75' }}" href="{{ route('shop.index') }}">Catalog &amp; Store</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 text-white-75" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark border-secondary shadow-lg py-2">
                        <li><a class="dropdown-item py-2" href="{{ route('shop.index', ['category' => 'grains-rice']) }}"><i class="bi bi-flower1 me-2 text-success"></i>Grains &amp; Rice</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('shop.index', ['category' => 'oil-sugar']) }}"><i class="bi bi-droplet-half me-2 text-warning"></i>Oil &amp; Cane Sugar</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('shop.index', ['category' => 'nuts-seeds']) }}"><i class="bi bi-circle me-2 text-info"></i>Nuts &amp; Seeds</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('shop.index', ['category' => 'lentils-pulses']) }}"><i class="bi bi-pie-chart me-2 text-primary"></i>Lentils &amp; Pulses</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('shop.index', ['category' => 'spices-specialty']) }}"><i class="bi bi-brightness-high me-2 text-danger"></i>Coffee &amp; Spices</a></li>
                        <li><hr class="dropdown-divider border-secondary my-1"></li>
                        <li><a class="dropdown-item py-2 fw-semibold text-success" href="{{ route('shop.index') }}"><i class="bi bi-grid-fill me-2"></i>Browse All Commodities</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 text-white-75" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#inquiryModal">Trade Desk (RFQ)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 text-white-75" href="{{ route('home') }}#trust-features">Why Matro</a>
                </li>
            </ul>

            <!-- Header Search Bar -->
            <form action="{{ route('shop.index') }}" method="GET" class="d-flex align-items-center me-lg-3 my-2 my-lg-0" style="max-width: 240px; width: 100%;">
                <div class="input-group input-group-sm">
                    <input type="search" name="search" class="form-control bg-dark text-white border-secondary rounded-start-pill px-3" placeholder="Search commodities..." value="{{ request('search') }}" style="font-size: 0.82rem;">
                    <button class="btn btn-outline-secondary rounded-end-pill px-2.5 border-start-0" type="submit">
                        <i class="bi bi-search text-white-50"></i>
                    </button>
                </div>
            </form>

            <!-- Right Actions (Cart & Authentication) -->
            <div class="d-flex align-items-center gap-2 pt-2 pt-lg-0">
                <!-- Desktop Cart Drawer Button -->
                <button type="button" class="btn btn-outline-light rounded-pill px-3 py-1.5 d-none d-lg-inline-flex align-items-center gap-2 cart-drawer-trigger" title="Open Shopping Cart">
                    <i class="bi bi-bag text-success fs-6"></i>
                    <span class="small fw-semibold">Cart</span>
                    <span class="cart-badge-count badge rounded-pill bg-success text-dark fw-bold">
                        {{ collect(session('cart', []))->sum('quantity') }}
                    </span>
                </button>

                <!-- Auth State -->
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm rounded-pill px-3 py-1 fw-bold text-dark d-inline-flex align-items-center gap-1 shadow-sm">
                            <i class="bi bi-shield-lock-fill"></i>
                            <span>Admin Panel</span>
                        </a>
                    @endif

                    <div class="dropdown">
                        <button class="btn btn-outline-light btn-sm rounded-pill px-3 py-1.5 dropdown-toggle d-inline-flex align-items-center gap-1.5" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle text-success"></i>
                            <span class="small fw-semibold">{{ Str::limit(Auth::user()->name, 12) }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark border-secondary shadow-lg mt-2">
                            <li class="dropdown-header text-muted small border-bottom border-secondary pb-2 mb-1">
                                Signed in as <strong class="text-white d-block">{{ Auth::user()->email }}</strong>
                                <span class="badge {{ Auth::user()->isAdmin() ? 'bg-warning text-dark' : 'bg-success-subtle text-success border border-success-subtle' }} mt-1">
                                    {{ Auth::user()->isAdmin() ? 'Administrator' : 'Verified Buyer' }}
                                </span>
                            </li>
                            @if(Auth::user()->isAdmin())
                                <li>
                                    <a class="dropdown-item py-2 text-warning fw-semibold" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('admin.products.index') }}">
                                        <i class="bi bi-box-seam me-2 text-success"></i>Agro Products
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('admin.orders.index') }}">
                                        <i class="bi bi-receipt me-2 text-info"></i>Sales Orders
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider border-secondary my-1"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm rounded-pill px-3 py-1.5 fw-semibold">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-success btn-sm rounded-pill px-3 py-1.5 fw-bold text-dark shadow-sm" style="background: #10b981; border-color: #10b981;">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
