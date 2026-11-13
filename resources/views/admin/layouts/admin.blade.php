<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') — BRX AGRO GLOBAL</title>

    <!-- Badge Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">

    <!-- Local Bootstrap 5 CSS & Icons -->
    <link href="{{ asset('lib/bootstrap/bootstrap-5.3.3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">

    <!-- Local Fonts -->
    <link href="{{ asset('fonts/comic-relief.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/open-sans.css') }}" rel="stylesheet">

    <style>
        :root {
            --matro-green: #78a22f;
            --matro-green-dark: #5c7f21;
            --matro-sidebar: 260px;
            --matro-sidebar-mini: 76px;
            --matro-dark: #121820;
            --matro-darker: #0d1217;
        }

        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f4f6f9;
            color: #212529;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .brand-text, .btn {
            font-family: "Comic Relief", system-ui, sans-serif;
        }

        .admin-shell {
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar Styling (Borrowed from shoe-haven concept) */
        .matro-sidebar {
            width: var(--matro-sidebar);
            flex: 0 0 var(--matro-sidebar);
            background: var(--matro-dark);
            height: 100vh;
            position: sticky;
            top: 0;
            z-index: 1040;
            overflow: hidden;
            transition: width .25s ease, transform .25s ease;
            border-right: 1px solid rgba(255, 255, 255, 0.07);
        }

        .matro-sidebar-inner {
            height: 100%;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .matro-brand {
            min-height: 74px;
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            gap: .85rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            text-decoration: none;
        }

        .matro-brand-mark {
            width: 42px;
            height: 42px;
            flex: 0 0 auto;
            border-radius: 10px;
            background: var(--matro-green);
            color: #fff;
            display: grid;
            place-items: center;
            font-weight: 800;
            font-size: 1.15rem;
            box-shadow: 0 4px 12px rgba(120, 162, 47, 0.35);
        }

        .matro-brand-title {
            font-size: 1.2rem;
            font-weight: 800;
            line-height: 1.2;
            color: #fff;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .matro-brand-sub {
            font-size: .78rem;
            color: rgba(255, 255, 255, .5);
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .matro-nav {
            flex: 1 1 auto;
            min-height: 0;
            overflow-y: auto;
            overflow-x: hidden;
            padding: .65rem .85rem 1.2rem;
            display: flex;
            flex-direction: column;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, .2) transparent;
        }

        .matro-nav::-webkit-scrollbar { width: 4px; }
        .matro-nav::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, .2); border-radius: 99px; }

        .matro-nav-group {
            margin-top: 1.2rem;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .matro-nav-group:first-child { margin-top: .25rem; }

        .matro-nav-label {
            color: rgba(255, 255, 255, .38);
            font-size: .675rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            font-weight: 700;
            padding: 0 .6rem .45rem;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .matro-nav-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, .08);
        }

        .matro-sidebar .nav-link {
            height: 44px;
            min-height: 44px;
            padding: .5rem .85rem;
            margin: .12rem 0;
            border-radius: 8px;
            color: rgba(255, 255, 255, .72);
            font-weight: 600;
            font-size: .9rem;
            display: flex;
            align-items: center;
            gap: .85rem;
            white-space: nowrap;
            text-decoration: none;
            transition: all .18s ease;
        }

        .matro-sidebar .nav-link i {
            width: 22px;
            min-width: 22px;
            text-align: center;
            font-size: 1.05rem;
            color: rgba(255, 255, 255, .6);
            transition: color .18s ease;
        }

        .matro-sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .07);
        }

        .matro-sidebar .nav-link:hover i {
            color: var(--matro-green);
        }

        .matro-sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(90deg, rgba(120, 162, 47, 0.28), rgba(120, 162, 47, 0.1));
            box-shadow: inset 3px 0 0 var(--matro-green);
        }

        .matro-sidebar .nav-link.active i {
            color: var(--matro-green);
        }

        .matro-sidebar-footer {
            flex: 0 0 auto;
            margin-top: auto;
            padding: .65rem .85rem;
            border-top: 1px solid rgba(255, 255, 255, .08);
            background: var(--matro-darker);
        }

        /* Topbar & Content */
        .admin-main {
            min-width: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .admin-topbar {
            height: 74px;
            position: sticky;
            top: 0;
            z-index: 1030;
            background: #fff;
            border-bottom: 1px solid #e5e8ec;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        }

        .admin-content {
            padding: 1.5rem;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            flex: 1;
        }

        .admin-page-heading h1 {
            font-size: 1.3rem;
            font-weight: 750;
            margin: 0;
            color: #1a202c;
        }

        .sh-breadcrumbs ol {
            display: flex;
            align-items: center;
            gap: .35rem;
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: .75rem;
            color: #8a909c;
        }

        .sh-breadcrumbs a {
            color: #6b7280;
            text-decoration: none;
        }

        .sh-breadcrumbs a:hover {
            color: var(--matro-green);
        }

        .sh-breadcrumbs-sep {
            color: #c4c8d0;
        }

        .admin-user {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            padding: .35rem .75rem;
            cursor: pointer;
            transition: all .2s;
        }

        .admin-user:hover {
            background: #f1f5f9;
        }

        .admin-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: var(--matro-green);
            color: #fff;
            font-weight: 700;
            font-size: .9rem;
        }

        .sh-collapse-btn {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border: 1px solid #e2e8f0;
            background: #fff;
            border-radius: 8px;
            color: #4b5563;
            cursor: pointer;
            transition: all .15s;
        }

        .sh-collapse-btn:hover {
            background: #f8fafc;
            color: #111827;
        }

        /* Stat Cards */
        .sh-stat-card {
            border: 0;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .sh-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08) !important;
        }

        .sh-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 1.25rem;
        }

        .admin-card {
            border: 0;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }

        .admin-card .card-header {
            background: #fff;
            border-bottom: 1px solid #edf2f7;
            padding: 1rem 1.25rem;
        }

        .admin-table th {
            color: #64748b;
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            font-weight: 700;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: .75rem 1rem;
        }

        .admin-table td {
            padding: .85rem 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .admin-thumb {
            width: 46px;
            height: 46px;
            object-fit: cover;
            border-radius: 8px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
        }

        .btn-matro {
            background: var(--matro-green);
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: .45rem 1rem;
            border: none;
            transition: all .2s;
        }

        .btn-matro:hover {
            background: var(--matro-green-dark);
            color: #fff;
        }

        /* Sidebar collapsed state (desktop) */
        @media (min-width: 992px) {
            body.sidebar-collapsed .matro-sidebar {
                width: var(--matro-sidebar-mini);
                flex-basis: var(--matro-sidebar-mini);
            }
            body.sidebar-collapsed .matro-brand {
                justify-content: center;
                padding-left: .5rem;
                padding-right: .5rem;
            }
            body.sidebar-collapsed .matro-brand-title,
            body.sidebar-collapsed .matro-brand-sub,
            body.sidebar-collapsed .matro-nav-label,
            body.sidebar-collapsed .matro-nav .nav-link span,
            body.sidebar-collapsed .matro-sidebar-footer .nav-link span {
                display: none;
            }
            body.sidebar-collapsed .matro-nav {
                padding: .5rem .45rem;
            }
            body.sidebar-collapsed .matro-nav-group {
                margin-top: .5rem;
            }
            body.sidebar-collapsed .matro-nav .nav-link {
                justify-content: center;
                padding-left: .35rem;
                padding-right: .35rem;
            }
            body.sidebar-collapsed .matro-sidebar-footer .nav-link {
                justify-content: center;
            }
        }

        /* Mobile drawer */
        @media (max-width: 991.98px) {
            .matro-sidebar {
                position: fixed;
                left: 0;
                top: 0;
                transform: translateX(-100%);
                box-shadow: 10px 0 30px rgba(0,0,0,.3);
            }
            .matro-sidebar.open {
                transform: translateX(0);
            }
            .sh-sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 1039;
                background: rgba(0,0,0,.45);
            }
            .admin-content {
                padding: 1rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-shell">
    <!-- Sidebar -->
    <div class="matro-sidebar" id="adminSidebar">
        <div class="matro-sidebar-inner">
            <a href="{{ route('admin.dashboard') }}" class="matro-brand" aria-label="BRX AGRO GLOBAL Administration">
                <img src="{{ asset('img/BRX Agro Global Product Emblem.png') }}" alt="BRX AGRO GLOBAL" class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover; border: 2px solid var(--matro-green); flex-shrink: 0;">
                <div>
                    <div class="matro-brand-title" style="font-size: 0.95rem; line-height: 1.1;">BRX <span style="color: var(--matro-green);">AGRO</span></div>
                    <div class="matro-brand-sub" style="font-size: 0.52rem; letter-spacing: 0.8px;">GLOBAL LTDA</div>
                </div>
            </a>

            <nav class="matro-nav nav flex-column" aria-label="Admin navigation">
                @foreach (config('admin-nav', []) as $group)
                    <div class="matro-nav-group">
                        <div class="matro-nav-label">{{ $group['label'] }}</div>
                        @foreach ($group['items'] as $item)
                            @php
                                $isActive = request()->routeIs($item['pattern']);
                            @endphp
                            <a class="nav-link {{ $isActive ? 'active' : '' }}"
                               href="{{ route($item['route']) }}"
                               title="{{ $item['label'] }}">
                                <i class="bi {{ $item['icon'] }}"></i>
                                <span>{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </nav>

            <div class="matro-sidebar-footer">
                <a class="nav-link" href="/" title="View Front Store">
                    <i class="bi bi-shop"></i>
                    <span>View Store</span>
                </a>
                <form action="/logout" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="nav-link w-100 border-0 bg-transparent text-start" title="Sign Out">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div class="sh-sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content Area -->
    <main class="admin-main">
        <!-- Topbar -->
        <header class="admin-topbar d-flex align-items-center justify-content-between px-3 px-lg-4">
            <div class="d-flex align-items-center gap-3 min-w-0">
                <button class="sh-collapse-btn" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
                    <i class="bi bi-layout-sidebar-inset"></i>
                </button>
                @php
                    $adminRoute = request()->route()?->getName() ?? '';
                    $breadcrumbMap = [
                        'admin.dashboard' => [],
                        'admin.products.index' => [['label' => 'Catalog'], ['label' => 'Products']],
                        'admin.products.create' => [['label' => 'Catalog'], ['label' => 'Products', 'url' => route('admin.products.index')], ['label' => 'Add Product']],
                        'admin.products.edit' => [['label' => 'Catalog'], ['label' => 'Products', 'url' => route('admin.products.index')], ['label' => 'Edit Product']],
                        'admin.categories.index' => [['label' => 'Catalog'], ['label' => 'Categories']],
                        'admin.orders.index' => [['label' => 'Sales'], ['label' => 'Orders']],
                        'admin.orders.show' => [['label' => 'Sales'], ['label' => 'Orders', 'url' => route('admin.orders.index')], ['label' => 'Order Details']],
                        'admin.users.index' => [['label' => 'Customers'], ['label' => 'Directory']],
                        'admin.users.show' => [['label' => 'Customers'], ['label' => 'Directory', 'url' => route('admin.users.index')], ['label' => 'Customer Details']],
                        'admin.inquiries.index' => [['label' => 'Trade Desk'], ['label' => 'Inquiries']],
                        'admin.inquiries.show' => [['label' => 'Trade Desk'], ['label' => 'Inquiries', 'url' => route('admin.inquiries.index')], ['label' => 'Inquiry Details']],
                    ];
                    $breadcrumbs = $breadcrumbMap[$adminRoute] ?? [];
                @endphp
                <div class="admin-page-heading min-w-0">
                    <div class="sh-breadcrumbs">
                        <ol>
                            <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                            @foreach ($breadcrumbs as $crumb)
                                <li class="sh-breadcrumbs-sep">/</li>
                                <li>
                                    @if(isset($crumb['url']))
                                        <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                                    @else
                                        <span>{{ $crumb['label'] }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <h1 class="text-truncate">@yield('page-title', 'Dashboard')</h1>
                </div>
            </div>

            <!-- Topbar Notification Badges & User Menu -->
            <div class="d-flex align-items-center gap-2 gap-md-3">
                @php
                    $pendingOrdersCount = \App\Models\Order::where('status', 'pending')->count();
                    $unreadInquiriesCount = \App\Models\Inquiry::where('is_read', false)->count();
                @endphp
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="btn btn-sm btn-light border position-relative d-flex align-items-center gap-1 px-2 py-1" title="Pending Commodity Orders">
                        <i class="bi bi-bell-fill text-warning"></i>
                        <span class="d-none d-sm-inline small fw-semibold">Orders</span>
                        @if($pendingOrdersCount > 0)
                            <span class="badge bg-danger rounded-pill">{{ $pendingOrdersCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-sm btn-light border position-relative d-flex align-items-center gap-1 px-2 py-1" title="Unread Inquiries & Trade Desk Messages">
                        <i class="bi bi-chat-dots-fill text-primary"></i>
                        <span class="d-none d-sm-inline small fw-semibold">Desk</span>
                        @if($unreadInquiriesCount > 0)
                            <span class="badge bg-primary rounded-pill">{{ $unreadInquiriesCount }}</span>
                        @endif
                    </a>
                </div>

                <!-- User Menu -->
                <div class="dropdown">
                <button class="admin-user d-flex align-items-center gap-2" data-bs-toggle="dropdown" type="button">
                    <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                    <span class="d-none d-md-block text-start">
                        <strong class="d-block small text-dark">{{ auth()->user()->name ?? 'Admin' }}</strong>
                        <small class="text-muted" style="font-size: 11px;">Administrator</small>
                    </span>
                    <i class="bi bi-chevron-down small text-muted"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 py-2">
                    <li><span class="dropdown-item-text small text-muted">{{ auth()->user()->email ?? '' }}</span></li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li><a class="dropdown-item py-2" href="/"><i class="bi bi-shop me-2 text-primary"></i>View Front Store</a></li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <form action="/logout" method="POST" class="m-0 px-2">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger w-100 rounded-pill"><i class="bi bi-box-arrow-right me-1"></i>Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <!-- Main Workspace -->
        <div class="admin-content">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div>{{ session('status') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <strong>Please check the form errors below:</strong>
                    <ul class="mb-0 mt-1 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>

<!-- Local Bootstrap 5 JS -->
<script src="{{ asset('lib/bootstrap/bootstrap-5.3.3.bundle.min.js') }}"></script>

<!-- Sidebar Toggle Script (Shoe-Haven Pattern) -->
<script>
(function() {
    var sidebar = document.getElementById('adminSidebar');
    var toggleBtn = document.getElementById('sidebarToggle');
    var overlay = document.getElementById('sidebarOverlay');

    function isMobile() {
        return window.innerWidth < 992;
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            if (isMobile()) {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show');
            } else {
                document.body.classList.toggle('sidebar-collapsed');
                try {
                    localStorage.setItem('matro_sidebar_collapsed', document.body.classList.contains('sidebar-collapsed'));
                } catch(e) {}
            }
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });
    }

    // Restore desktop preference
    try {
        if (!isMobile() && localStorage.getItem('matro_sidebar_collapsed') === 'true') {
            document.body.classList.add('sidebar-collapsed');
        }
    } catch(e) {}
})();
</script>

@stack('scripts')
</body>
</html>
