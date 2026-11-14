<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#14141a">
    <title>BRX AGRO GLOBAL - Importação e Exportação Ltda | Brazilian Commodity Origination &amp; Export</title>
    <meta name="description" content="BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA coordinates direct institutional origination of Brazilian agro-commodities for international buyers: Non-GMO &amp; GMO Soybeans, ICUMSA 45 Sugar, Yellow Corn, Arabica Green Coffee, Edible Oils, and Halal Frozen Poultry &amp; Beef. Verified by SGS &amp; MAPA via Santos &amp; Paranaguá Ports (CIF/FOB).">
    <meta name="keywords" content="BRX Agro Global, Importação e Exportação Ltda, Brazilian agro commodities, bulk soybeans exporter Brazil, ICUMSA 45 sugar supplier, Brazilian yellow corn Grade 2, Arabica green coffee beans, Halal frozen chicken Brazil, SIF beef exporter, SGS inspection, MAPA phytosanitary, Incoterms CIF FOB delivery, Port of Santos, Port of Paranaguá, CNPJ 38.471.480/0001-41">
    <meta name="author" content="BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    @if(!empty(config('services.google.site_verification')))
        <meta name="google-site-verification" content="{{ config('services.google.site_verification') }}">
    @endif
    <meta name="geo.region" content="BR-SP">
    <meta name="geo.placename" content="São Paulo, Brazil">
    <link rel="canonical" href="{{ url('/') }}">
    <link rel="alternate" hreflang="en" href="{{ url('/') }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('/') }}">

    <!-- Open Graph / WhatsApp / LinkedIn / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA">
    <meta property="og:title" content="BRX AGRO GLOBAL — Brazilian Agro-Commodity Origination &amp; Global Export">
    <meta property="og:description" content="Direct institutional supply of Brazilian Soybeans, ICUMSA 45 Cane Sugar, Yellow Corn, Arabica Coffee, Edible Oils, and SIF/Halal Frozen Proteins. SGS &amp; MAPA certified with CIF/FOB port execution.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('img/carousel-1.jpg') }}">
    <meta property="og:image:alt" content="BRX AGRO GLOBAL Brazilian Commodity Export Operations">
    <meta property="og:locale" content="en_US">
    <meta property="og:locale:alternate" content="pt_BR">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="BRX AGRO GLOBAL — Brazilian Agro-Commodity Origination &amp; Export">
    <meta name="twitter:description" content="Direct institutional origination of Brazilian Soybeans, ICUMSA 45 Sugar, Yellow Corn, Green Coffee, Edible Oils &amp; Frozen Proteins. SGS &amp; MAPA verified.">
    <meta name="twitter:image" content="{{ asset('img/carousel-1.jpg') }}">
    <meta name="twitter:image:alt" content="BRX AGRO GLOBAL Brazilian Commodity Export Operations">

    <!-- Badge Favicons & Web Manifest -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('img/favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Structured Data (Schema.org JSON-LD: Corporation, WebSite, Commodity Catalog & FAQ) -->
    @php
        $schemaProductItems = [];
        if (isset($products) && $products->isNotEmpty()) {
            foreach ($products->take(28)->values() as $idx => $prod) {
                $schemaProductItems[] = [
                    '@type' => 'ListItem',
                    'position' => $idx + 1,
                    'item' => [
                        '@type' => 'Product',
                        'name' => $prod->name,
                        'description' => $prod->description ?: ($prod->name . ' — Brazilian export grade agro-commodity supplied by BRX AGRO GLOBAL.'),
                        'image' => asset($prod->image ?: 'img/carousel-1.jpg'),
                        'sku' => 'BRX-COM-' . str_pad((string) $prod->id, 4, '0', STR_PAD_LEFT),
                        'category' => optional($prod->category)->name ?: 'Brazilian Agro-Commodities',
                        'brand' => [
                            '@type' => 'Brand',
                            'name' => 'BRX AGRO GLOBAL',
                        ],
                        'offers' => [
                            '@type' => 'Offer',
                            'url' => url('/') . '#products',
                            'priceCurrency' => 'USD',
                            'price' => number_format((float) ($prod->price ?: 0), 2, '.', ''),
                            'availability' => ($prod->stock ?? 0) > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                            'itemCondition' => 'https://schema.org/NewCondition',
                            'seller' => [
                                '@type' => 'Organization',
                                'name' => 'BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA',
                            ],
                        ],
                    ],
                ];
            }
        }

        $jsonLdGraph = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Corporation',
                    '@id' => url('/') . '#organization',
                    'name' => 'BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA',
                    'alternateName' => 'BRX Agro Global',
                    'url' => url('/'),
                    'logo' => asset('img/BRX Agro Global Product Emblem.png'),
                    'image' => asset('img/carousel-1.jpg'),
                    'description' => 'Brazilian institutional agro-commodity origination and export trading house supplying Non-GMO & GMO Soybeans, ICUMSA 45 Cane Sugar, Yellow Corn, Arabica Green Coffee, Edible Oils, and SIF/Halal Frozen Proteins worldwide.',
                    'taxID' => '38.471.480/0001-41',
                    'email' => 'brxagroglobal@gmail.com',
                    'telephone' => '+55-11-95835-3433',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => 'São Paulo',
                        'addressRegion' => 'SP',
                        'addressCountry' => 'BR',
                    ],
                    'contactPoint' => [
                        [
                            '@type' => 'ContactPoint',
                            'telephone' => '+55-11-95835-3433',
                            'email' => 'brxagroglobal@gmail.com',
                            'contactType' => 'sales',
                            'areaServed' => 'Worldwide',
                            'availableLanguage' => ['English', 'Portuguese', 'Spanish'],
                        ],
                    ],
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => url('/') . '#website',
                    'url' => url('/'),
                    'name' => 'BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA',
                    'publisher' => [
                        '@id' => url('/') . '#organization',
                    ],
                    'inLanguage' => 'en',
                ],
                [
                    '@type' => 'ItemList',
                    '@id' => url('/') . '#commodity-catalog',
                    'name' => 'BRX Agro Global Export Commodity Catalog',
                    'itemListOrder' => 'https://schema.org/ItemListOrderAscending',
                    'numberOfItems' => count($schemaProductItems),
                    'itemListElement' => $schemaProductItems,
                ],
                [
                    '@type' => 'FAQPage',
                    '@id' => url('/') . '#faq',
                    'mainEntity' => [
                        [
                            '@type' => 'Question',
                            'name' => 'Which Brazilian export ports and Incoterms does BRX Agro Global support?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'BRX AGRO GLOBAL executes bulk vessel and containerized FCL shipments via the Port of Santos (BRSSZ) and Port of Paranaguá (BRPNG) under Incoterms 2020 FOB, CFR, and CIF delivery terms.',
                            ],
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Are BRX Agro Global shipments inspected by SGS and certified by MAPA?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Yes. Every export allocation includes pre-loading independent quality, weight, and laboratory assay inspection by SGS (or equivalent surveyor) alongside official Brazilian MAPA phytosanitary and SIF/Halal health certificates.',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($jsonLdGraph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    <!-- Self-Hosted Typography (Agrovia Brand Fonts: Comic Relief for Headings & Buttons, Open Sans for Body) -->
    <link rel="stylesheet" href="{{ asset('fonts/comic-relief.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/open-sans.css') }}">

    <!-- Self-Hosted Icons -->
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-icons/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/font-awesome/all.min.css') }}">

    <!-- Stylesheets -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Theme State Initializer (Fast, prevent flash) -->
    <script>
        try {
            document.documentElement.setAttribute('data-theme', localStorage.getItem('sh-theme') || 'dark');
        } catch (e) {}
    </script>

    <style>
        /* ===== Theme Tokens (Using Arovia / Matro Color Palette) ===== */
        :root {
            --sh-primary: #78a22f;          /* Agrovia Primary Olive Green */
            --sh-primary-dark: #5e8024;     /* Darker Olive Green */
            --sh-emerald: #10b981;          /* Emerald Green Accent */
            --sh-gold: #f59e0b;             /* Gold / Yellow Accent */
            --sh-black: #14141a;            /* Fume-style Deep Charcoal/Black */
            --sh-surface: #1b1b24;          /* Surface Card Background */
            --sh-surface-alt: #161620;      /* Slightly darker section background */
            --sh-border: rgba(255, 255, 255, 0.12);
            --sh-input-bg: #161620;

            --bs-body-bg: #14141a;
            --bs-body-color: #ececf1;
            --bs-secondary-color: rgba(236, 236, 241, 0.68);
            --bs-border-color: rgba(255, 255, 255, 0.12);
            --bs-emphasis-color: #ffffff;
            --bs-link-color: #93c441;
            --bs-link-hover-color: var(--sh-primary);
        }

        html[data-theme="light"] {
            --sh-surface: #ffffff;
            --sh-surface-alt: #f1f2f6;
            --sh-border: rgba(20, 20, 26, 0.12);
            --sh-input-bg: #ffffff;

            --bs-body-bg: #f7f7f9;
            --bs-body-color: #17171c;
            --bs-secondary-color: rgba(35, 35, 44, 0.72);
            --bs-border-color: rgba(20, 20, 26, 0.14);
            --bs-emphasis-color: #14141a;
            --bs-link-color: #5e8024;
        }

        /* Universal Theme Visibility Helpers */
        .sh-text-title { color: var(--bs-emphasis-color) !important; }
        .sh-text-body { color: var(--bs-body-color) !important; }
        .sh-text-muted { color: var(--bs-secondary-color) !important; }
        .sh-card-bg { background-color: var(--sh-surface) !important; border-color: var(--bs-border-color) !important; }
        .sh-box-bg { background-color: var(--sh-surface-alt) !important; border-color: var(--bs-border-color) !important; }

        /* Universal Dropdowns & Filter Buttons */
        .dropdown-menu {
            background-color: var(--sh-surface) !important;
            border: 1px solid var(--bs-border-color) !important;
        }
        .dropdown-item {
            color: var(--bs-body-color) !important;
        }
        .dropdown-item:hover, .dropdown-item:focus {
            background-color: rgba(120, 162, 47, 0.15) !important;
            color: var(--sh-primary) !important;
        }
        .agro-filter-btn {
            border-color: var(--bs-border-color) !important;
            color: var(--bs-body-color) !important;
            background: transparent;
            transition: all .15s ease;
        }
        .agro-filter-btn:hover,
        .agro-filter-btn.active {
            background-color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            color: #ffffff !important;
        }
        .sh-input {
            background-color: var(--sh-input-bg) !important;
            color: var(--bs-body-color) !important;
            border: 1px solid var(--bs-border-color) !important;
        }
        .sh-input:focus {
            background-color: var(--sh-input-bg) !important;
            color: var(--bs-body-color) !important;
            border-color: var(--sh-primary) !important;
            box-shadow: 0 0 0 0.25rem rgba(120, 162, 47, 0.25) !important;
        }
        .sh-input::placeholder {
            color: var(--bs-secondary-color) !important;
            opacity: 0.75;
        }
        .sh-input option {
            background-color: var(--sh-surface);
            color: var(--bs-body-color);
        }
        .form-label {
            color: var(--bs-emphasis-color) !important;
        }

        /* ===== Typography & Global Layout (Agrovia Global) ===== */
        html, body {
            overflow-x: hidden !important;
            max-width: 100%;
            width: 100%;
        }
        body {
            font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 1rem;
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            transition: background-color .25s ease, color .25s ease;
        }

        h1, h2, h3, h4, h5, h6,
        .sh-title, .navbar-brand, .sh-brand-title {
            font-family: 'Comic Relief', system-ui, sans-serif;
            font-weight: 700;
            color: var(--bs-emphasis-color);
        }

        /* ===== BRX AGRO GLOBAL Brand Emblem & Artistic Typography Lockup ===== */
        .brx-navbar-brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            padding: 0;
            margin-right: 1rem;
            flex-shrink: 0;
            transition: opacity .2s ease;
        }
        .brx-navbar-brand:hover {
            opacity: 0.94;
        }
        .brx-navbar-emblem {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.22);
            border: 2px solid var(--sh-primary);
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .brx-navbar-brand:hover .brx-navbar-emblem {
            transform: scale(1.06);
            box-shadow: 0 4px 14px rgba(120, 162, 47, 0.4);
        }
        .brx-brand-wrap {
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.1;
            min-width: 0;
        }
        .brx-brand-row {
            display: flex;
            align-items: baseline;
            gap: 5px;
            white-space: nowrap;
        }
        .brx-name-lead {
            font-family: 'Comic Relief', system-ui, sans-serif;
            font-weight: 900;
            font-size: 1.16rem;
            letter-spacing: 0.8px;
            line-height: 1;
        }
        .brx-name-tag {
            font-family: 'Comic Relief', system-ui, sans-serif;
            font-weight: 800;
            font-size: 0.94rem;
            letter-spacing: 0.8px;
            line-height: 1;
        }
        .brx-legal-sub {
            font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 0.52rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            display: block;
            margin-top: 3px;
            line-height: 1.1;
            white-space: nowrap;
        }

        /* Mobile Responsive Brand Scaling */
        @media (max-width: 576px) {
            .brx-navbar-brand {
                gap: 8px;
                margin-right: 0.35rem;
                max-width: calc(100% - 56px);
            }
            .brx-navbar-emblem {
                width: 36px;
                height: 36px;
            }
            .brx-name-lead {
                font-size: 1rem;
            }
            .brx-name-tag {
                font-size: 0.82rem;
            }
            .brx-legal-sub {
                font-size: 0.44rem;
                letter-spacing: 0.6px;
                white-space: normal;
                line-height: 1.1;
            }
        }
        @media (max-width: 380px) {
            .brx-navbar-brand {
                gap: 6px;
                max-width: calc(100% - 50px);
            }
            .brx-navbar-emblem {
                width: 32px;
                height: 32px;
            }
            .brx-name-lead {
                font-size: 0.92rem;
            }
            .brx-name-tag {
                font-size: 0.76rem;
            }
            .brx-legal-sub {
                display: none;
            }
        }

        /* Light Theme Brand Colors */
        html[data-theme="light"] .brx-name-lead {
            color: #14532d !important;
        }
        html[data-theme="light"] .brx-name-tag {
            color: #5e8024 !important;
        }
        html[data-theme="light"] .brx-legal-sub {
            color: #334155 !important;
        }

        /* Dark Theme Brand Colors */
        html[data-theme="dark"] .brx-name-lead {
            color: #22c55e !important;
        }
        html[data-theme="dark"] .brx-name-tag {
            color: #93c441 !important;
        }
        html[data-theme="dark"] .brx-legal-sub {
            color: rgba(255, 255, 255, 0.72) !important;
        }

        /* ===== Navbar (Full Width, Generous Breadth & Translucent Frosted Glass) ===== */
        .sh-navbar {
            z-index: 1030;
            padding-top: 0.85rem !important;
            padding-bottom: 0.85rem !important;
            width: 100% !important;
            max-width: 100% !important;
            transition: background-color .25s ease, border-color .25s ease, box-shadow .25s ease, backdrop-filter .25s ease;
        }
        .sh-navbar .container-fluid {
            width: 100% !important;
            max-width: 100% !important;
            padding-left: clamp(0.75rem, 1.8vw, 2rem) !important;
            padding-right: clamp(0.75rem, 1.8vw, 2rem) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            min-width: 0 !important;
        }
        @media (min-width: 992px) {
            .sh-nav-straightline {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                align-items: center !important;
                white-space: nowrap !important;
                gap: clamp(0.25rem, 0.6vw, 0.65rem) !important;
                margin-bottom: 0;
                min-width: 0 !important;
            }
            .sh-nav-straightline .nav-item {
                flex-shrink: 0;
            }
            .sh-navbar .nav-link {
                font-weight: 600;
                font-size: clamp(0.82rem, 0.82vw, 0.92rem);
                padding: 0.38rem clamp(0.42rem, 0.65vw, 0.75rem) !important;
                border-radius: 8px;
                white-space: nowrap;
                transition: color .2s ease, background-color .2s ease;
            }
            .brx-navbar-brand {
                margin-right: clamp(0.5rem, 1.2vw, 1.5rem) !important;
                gap: clamp(8px, 0.9vw, 14px);
                flex-shrink: 0 !important;
            }
            .brx-navbar-emblem {
                width: clamp(38px, 2.5vw, 46px);
                height: clamp(38px, 2.5vw, 46px);
                flex-shrink: 0 !important;
            }
            .brx-name-lead {
                font-size: clamp(1.05rem, 1.1vw, 1.28rem);
            }
            .brx-name-tag {
                font-size: clamp(0.82rem, 0.88vw, 1rem);
            }
            .brx-legal-sub {
                font-size: clamp(0.42rem, 0.45vw, 0.52rem);
            }
            .sh-nav-actions {
                gap: clamp(0.35rem, 0.5vw, 0.65rem) !important;
                flex-shrink: 0 !important;
                white-space: nowrap !important;
            }
            .sh-icon-btn,
            .sh-theme-toggle,
            .sh-cart-icon {
                width: clamp(34px, 2.2vw, 38px);
                height: clamp(34px, 2.2vw, 38px);
                font-size: 0.95rem;
                flex-shrink: 0 !important;
            }
            .btn-sh-login,
            .btn-sh-primary {
                padding: 0.35rem clamp(0.65rem, 0.8vw, 1rem) !important;
                font-size: clamp(0.8rem, 0.82vw, 0.88rem) !important;
                white-space: nowrap !important;
                flex-shrink: 0 !important;
            }
        }

        /* Hero Carousel Arrows - Hide on small screens */
        @media (max-width: 767.98px) {
            .carousel-control-prev,
            .carousel-control-next {
                display: none !important;
            }
        }
        .sh-navbar .nav-link:hover,
        .sh-navbar .nav-link.active {
            color: var(--sh-primary) !important;
        }
        .sh-nav-dropdown .dropdown-menu {
            border-radius: 10px;
            padding: 0.5rem 0;
            min-width: 220px;
            box-shadow: 0 14px 35px rgba(0, 0, 0, 0.25);
        }
        .sh-nav-dropdown .dropdown-header {
            color: var(--sh-primary);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 0.4rem 1rem;
        }
        .sh-nav-dropdown .dropdown-item {
            font-size: 0.86rem;
            padding: 0.45rem 1rem;
            transition: all .15s ease;
        }
        .sh-nav-dropdown .dropdown-item:hover {
            background: rgba(120, 162, 47, 0.15);
            color: var(--sh-primary);
        }
        @media (min-width: 992px) {
            .sh-nav-dropdown:hover > .dropdown-menu {
                display: block;
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            .sh-nav-dropdown > .dropdown-menu {
                display: block;
                opacity: 0;
                visibility: hidden;
                transform: translateY(6px);
                transition: opacity .2s ease, transform .2s ease;
            }
            /* Horizontal Mega Menu for Products */
            .sh-mega-dropdown {
                position: relative !important;
            }
            .sh-products-mega-menu {
                width: 620px !important;
                min-width: 600px !important;
                max-width: calc(100vw - 32px) !important;
                border-radius: 12px !important;
                overflow: hidden !important;
                left: 0 !important;
                right: auto !important;
                padding: 0 !important;
                margin-top: 0.5rem !important;
                box-shadow: 0 20px 45px rgba(0, 0, 0, 0.28) !important;
            }
            .sh-mega-grid {
                display: grid !important;
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 5px 10px !important;
            }
            .sh-mega-item {
                display: flex !important;
                align-items: center !important;
                padding: 0.45rem 0.65rem !important;
                border-radius: 8px !important;
                font-size: 0.84rem !important;
                font-weight: 600 !important;
                white-space: nowrap !important;
                transition: all 0.18s ease !important;
            }
            .sh-mega-footer {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                gap: 8px !important;
            }
        }
        @media (max-width: 991.98px) {
            .sh-products-mega-menu {
                width: 100% !important;
                min-width: 100% !important;
                box-shadow: none !important;
                border-radius: 10px !important;
                overflow: hidden !important;
                padding: 0 !important;
                margin: 0.35rem 0 0.5rem 0 !important;
            }
            .sh-mega-grid {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 4px 8px !important;
            }
            .sh-mega-item {
                display: flex !important;
                align-items: center !important;
                padding: 0.4rem 0.5rem !important;
                font-size: 0.8rem !important;
                border-radius: 6px !important;
            }
            .sh-mega-footer {
                display: flex !important;
                flex-direction: column !important;
                gap: 4px !important;
            }
            .sh-mega-footer .dropdown-item {
                width: 100% !important;
                justify-content: flex-start !important;
            }
        }
        @media (max-width: 520px) {
            .sh-mega-grid {
                grid-template-columns: 1fr !important;
            }
        }

        /* Products Mega Menu Theme Styling (WCAG AAA High Contrast) */
        .sh-mega-badge {
            background: #14532d !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            font-size: 0.74rem !important;
            border: 1.5px solid #4ade80 !important;
            border-radius: 999px !important;
            padding: 0.28rem 0.75rem !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 5px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25) !important;
            white-space: nowrap !important;
        }
        html[data-theme="light"] .sh-products-mega-menu {
            background: #ffffff !important;
            border: 1px solid rgba(15, 23, 42, 0.15) !important;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.14) !important;
        }
        html[data-theme="light"] .sh-mega-header {
            background: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
            color: #0f172a !important;
        }
        html[data-theme="light"] .sh-mega-badge {
            background: #166534 !important;
            color: #ffffff !important;
            border: 1.5px solid #22c55e !important;
            box-shadow: 0 2px 6px rgba(22, 101, 52, 0.3) !important;
        }
        html[data-theme="light"] .sh-mega-badge i {
            color: #86efac !important;
        }
        html[data-theme="light"] .sh-mega-item {
            color: #1e293b !important;
            background: transparent !important;
        }
        html[data-theme="light"] .sh-mega-item:hover {
            background: rgba(22, 101, 52, 0.08) !important;
            color: #15803d !important;
            font-weight: 700 !important;
            transform: translateX(3px);
        }
        html[data-theme="light"] .sh-mega-footer {
            background: #f8fafc !important;
            border-top: 1px solid #e2e8f0 !important;
        }
        html[data-theme="light"] .sh-mega-footer a {
            color: #334155 !important;
        }
        html[data-theme="light"] .sh-mega-footer a.text-success {
            color: #166534 !important;
        }
        html[data-theme="light"] .sh-mega-footer a.text-primary {
            color: #1d4ed8 !important;
        }
        html[data-theme="light"] .sh-mega-footer a:hover {
            background: rgba(22, 101, 52, 0.1) !important;
        }

        html[data-theme="dark"] .sh-products-mega-menu {
            background: #0f172a !important;
            border: 1px solid rgba(255, 255, 255, 0.14) !important;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.65) !important;
        }
        html[data-theme="dark"] .sh-mega-header {
            background: #1e293b !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #f8fafc !important;
        }
        html[data-theme="dark"] .sh-mega-badge {
            background: #14532d !important;
            color: #ffffff !important;
            border: 1.5px solid #4ade80 !important;
            box-shadow: 0 0 12px rgba(74, 222, 128, 0.35) !important;
        }
        html[data-theme="dark"] .sh-mega-badge i {
            color: #4ade80 !important;
        }
        html[data-theme="dark"] .sh-mega-item {
            color: #e2e8f0 !important;
            background: transparent !important;
        }
        html[data-theme="dark"] .sh-mega-item:hover {
            background: rgba(74, 222, 128, 0.15) !important;
            color: #4ade80 !important;
            font-weight: 700 !important;
            transform: translateX(3px);
        }
        html[data-theme="dark"] .sh-mega-footer {
            background: #1e293b !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        html[data-theme="dark"] .sh-mega-footer a {
            color: #cbd5e1 !important;
        }
        html[data-theme="dark"] .sh-mega-footer a.text-success {
            color: #4ade80 !important;
        }
        html[data-theme="dark"] .sh-mega-footer a.text-primary {
            color: #60a5fa !important;
        }
        html[data-theme="dark"] .sh-mega-footer a:hover {
            background: rgba(74, 222, 128, 0.18) !important;
        }
        @media (max-width: 991.98px) {
            .sh-navbar .navbar-collapse {
                max-height: calc(85vh - 65px) !important;
                overflow-y: auto !important;
                -webkit-overflow-scrolling: touch;
                border-radius: 14px !important;
                padding: 1rem 1.25rem 1.5rem !important;
                margin-top: 0.75rem !important;
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
            }
            .sh-navbar .navbar-nav {
                display: flex !important;
                flex-direction: column !important;
                gap: 0.25rem !important;
                padding: 0.5rem 0 !important;
                text-align: center !important;
                width: 100% !important;
            }
            .sh-navbar .navbar-nav .nav-item {
                width: 100% !important;
            }
            .sh-navbar .navbar-nav .nav-link {
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                font-size: 0.98rem !important;
                font-weight: 600 !important;
                padding: 0.65rem 1rem !important;
                border-radius: 8px !important;
                letter-spacing: 0.3px;
                transition: all 0.2s ease !important;
            }
            .sh-navbar .sh-nav-dropdown .dropdown-menu {
                position: static !important;
                float: none !important;
                width: 100% !important;
                margin-top: 0.35rem !important;
                margin-bottom: 0.5rem !important;
                box-shadow: none !important;
                border-radius: 10px !important;
                padding: 0.5rem !important;
            }
            .sh-navbar .sh-nav-actions {
                justify-content: center;
                width: 100%;
                padding-top: 1rem;
                margin-top: 0.75rem;
                border-top: 1px solid var(--bs-border-color);
            }
            .brx-name-lead { font-size: 1.05rem; }
            .brx-name-tag { font-size: 0.85rem; }
            .brx-legal-sub { font-size: 0.46rem; }
            .brx-navbar-emblem { width: 38px; height: 38px; }
        }

        /* ===== Navbar Actions (Theme, Search, Cart, Login, Signup) ===== */
        .sh-icon-btn,
        .sh-theme-toggle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.22) !important;
            background: rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all .2s ease;
            text-decoration: none;
            padding: 0;
            flex-shrink: 0;
        }
        .sh-icon-btn:hover,
        .sh-theme-toggle:hover {
            color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            background: rgba(120, 162, 47, 0.25) !important;
            transform: scale(1.05);
        }
        html[data-theme="light"] .sh-icon-btn,
        html[data-theme="light"] .sh-theme-toggle {
            background: rgba(20, 20, 26, 0.06) !important;
            border-color: rgba(20, 20, 26, 0.18) !important;
            color: #14141a !important;
        }
        html[data-theme="light"] .sh-icon-btn:hover,
        html[data-theme="light"] .sh-theme-toggle:hover {
            color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            background: rgba(120, 162, 47, 0.15) !important;
        }

        .sh-cart-icon {
            position: relative;
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.22) !important;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            text-decoration: none;
            cursor: pointer;
            transition: all .2s ease;
            flex-shrink: 0;
        }
        .sh-cart-icon:hover {
            background: rgba(120, 162, 47, 0.25) !important;
            border-color: var(--sh-primary) !important;
            color: var(--sh-primary) !important;
            transform: scale(1.05);
        }
        html[data-theme="light"] .sh-cart-icon {
            color: #14141a !important;
            background: rgba(20, 20, 26, 0.06) !important;
            border-color: rgba(20, 20, 26, 0.18) !important;
        }
        html[data-theme="light"] .sh-cart-icon:hover {
            color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            background: rgba(120, 162, 47, 0.15) !important;
        }
        .sh-cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: var(--sh-primary) !important;
            color: #ffffff !important;
            font-size: .65rem;
            font-weight: 700;
            border-radius: 999px;
            min-width: 19px;
            height: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            border: 2px solid var(--sh-surface);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.35);
        }

        .btn-sh-login {
            background: #198754 !important;
            color: #ffffff !important;
            border: 2px solid #198754 !important;
            font-family: 'Comic Relief', system-ui, sans-serif;
            font-weight: 700;
            font-size: 0.86rem;
            padding: .38rem 1.1rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all .2s ease;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(25, 135, 84, 0.35);
        }
        .btn-sh-login:hover {
            background: #157347 !important;
            border-color: #157347 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(25, 135, 84, 0.5);
            transform: translateY(-1px);
        }

        .sh-toggler {
            width: 40px;
            height: 36px;
            padding: 0;
            border-radius: 8px;
            background: transparent;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        .sh-toggler .bar {
            display: block;
            width: 20px;
            height: 1.5px;
            transition: transform .25s ease, opacity .2s ease;
        }
        .sh-toggler[aria-expanded="true"] .bar:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
        .sh-toggler[aria-expanded="true"] .bar:nth-child(2) { opacity: 0; }
        .sh-toggler[aria-expanded="true"] .bar:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

        /* ===== LIGHT THEME: Frosted Glass Translucency with High Contrast ===== */
        html[data-theme="light"] .sh-navbar {
            background-color: rgba(255, 255, 255, 0.88) !important;
            backdrop-filter: blur(18px) saturate(180%);
            -webkit-backdrop-filter: blur(18px) saturate(180%);
            border-bottom: 1px solid rgba(15, 23, 42, 0.08) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04) !important;
        }
        .sh-navbar .navbar-collapse,
        .sh-navbar .navbar-nav,
        .sh-nav-straightline {
            border: none !important;
        }
        @media (min-width: 992px) {
            .sh-navbar .navbar-collapse,
            html[data-theme="light"] .sh-navbar .navbar-collapse,
            html[data-theme="dark"] .sh-navbar .navbar-collapse {
                background: transparent !important;
                background-color: transparent !important;
                border: none !important;
                box-shadow: none !important;
            }
        }
        @media (max-width: 991.98px) {
            html[data-theme="light"] .sh-navbar .navbar-collapse {
                background-color: #ffffff !important;
                border: none !important;
                box-shadow: 0 16px 40px rgba(0, 0, 0, 0.12) !important;
            }
        }
        html[data-theme="light"] .sh-navbar .nav-link {
            color: #0f172a !important;
        }
        html[data-theme="light"] .sh-navbar .nav-link:hover,
        html[data-theme="light"] .sh-navbar .nav-link:focus {
            color: #15803d !important;
            background-color: rgba(22, 101, 52, 0.08) !important;
        }
        html[data-theme="light"] .sh-navbar .nav-link.active {
            color: #15803d !important;
            background-color: rgba(22, 101, 52, 0.12) !important;
            font-weight: 700 !important;
        }
        html[data-theme="light"] .sh-navbar .dropdown-menu {
            background-color: #ffffff !important;
            border: 1px solid rgba(15, 23, 42, 0.14) !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }
        html[data-theme="light"] .sh-navbar .dropdown-header {
            color: #15803d !important;
            font-weight: 700 !important;
        }
        html[data-theme="light"] .sh-navbar .dropdown-item {
            color: #0f172a !important;
        }
        html[data-theme="light"] .sh-navbar .dropdown-item:hover,
        html[data-theme="light"] .sh-navbar .dropdown-item:focus {
            color: #15803d !important;
            background-color: rgba(22, 101, 52, 0.08) !important;
        }
        html[data-theme="light"] .sh-navbar .sh-icon-btn,
        html[data-theme="light"] .sh-navbar .sh-theme-toggle {
            color: #0f172a !important;
            border: 1.5px solid rgba(15, 23, 42, 0.22) !important;
            background-color: #f1f5f9 !important;
        }
        html[data-theme="light"] .sh-navbar .sh-icon-btn i,
        html[data-theme="light"] .sh-navbar .sh-theme-toggle i {
            color: #0f172a !important;
            font-weight: 700 !important;
        }
        html[data-theme="light"] .sh-navbar .sh-icon-btn:hover,
        html[data-theme="light"] .sh-navbar .sh-theme-toggle:hover {
            color: #ffffff !important;
            background-color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
        }
        html[data-theme="light"] .sh-navbar .sh-icon-btn:hover i,
        html[data-theme="light"] .sh-navbar .sh-theme-toggle:hover i {
            color: #ffffff !important;
        }
        html[data-theme="light"] .sh-navbar .sh-cart-icon,
        html[data-theme="light"] .sh-navbar .sh-cart-icon i {
            color: #0f172a !important;
            background-color: #f1f5f9 !important;
            border: 1.5px solid rgba(15, 23, 42, 0.22) !important;
            font-weight: 700 !important;
        }
        html[data-theme="light"] .sh-navbar .sh-cart-icon:hover,
        html[data-theme="light"] .sh-navbar .sh-cart-icon:hover i {
            color: #ffffff !important;
            background-color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
        }
        html[data-theme="light"] .sh-navbar .btn-sh-login {
            color: #0f172a !important;
            border: 1.5px solid rgba(15, 23, 42, 0.25) !important;
            background-color: #f1f5f9 !important;
        }
        html[data-theme="light"] .sh-navbar .btn-sh-login:hover {
            color: #ffffff !important;
            background-color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
        }
        html[data-theme="light"] .sh-navbar .sh-toggler {
            border: 1.5px solid rgba(15, 23, 42, 0.25) !important;
            background-color: #f1f5f9 !important;
        }
        html[data-theme="light"] .sh-navbar .sh-toggler .bar {
            background-color: #0f172a !important;
        }

        /* ===== DARK THEME: Frosted Glass Translucency with High Contrast ===== */
        html[data-theme="dark"] .sh-navbar {
            background-color: rgba(15, 23, 42, 0.84) !important;
            backdrop-filter: blur(18px) saturate(180%);
            -webkit-backdrop-filter: blur(18px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.45) !important;
        }
        @media (max-width: 991.98px) {
            html[data-theme="dark"] .sh-navbar .navbar-collapse {
                background-color: #181824 !important;
                border: none !important;
                box-shadow: 0 18px 45px rgba(0, 0, 0, 0.7) !important;
            }
        }
        html[data-theme="dark"] .sh-navbar .nav-link {
            color: #ffffff !important;
        }
        html[data-theme="dark"] .sh-navbar .nav-link:hover,
        html[data-theme="dark"] .sh-navbar .nav-link:focus {
            color: #4ade80 !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
        html[data-theme="dark"] .sh-navbar .nav-link.active {
            color: #4ade80 !important;
            background-color: rgba(74, 222, 128, 0.18) !important;
            font-weight: 700 !important;
        }
        html[data-theme="dark"] .sh-navbar .dropdown-menu {
            background-color: #13131c !important;
            border: 1px solid rgba(255, 255, 255, 0.14) !important;
            box-shadow: 0 14px 35px rgba(0, 0, 0, 0.5) !important;
        }
        html[data-theme="dark"] .sh-navbar .dropdown-header {
            color: #a3e635 !important;
            font-weight: 700 !important;
        }
        html[data-theme="dark"] .sh-navbar .dropdown-item {
            color: #f1f5f9 !important;
        }
        html[data-theme="dark"] .sh-navbar .dropdown-item:hover,
        html[data-theme="dark"] .sh-navbar .dropdown-item:focus {
            color: #a3e635 !important;
            background-color: rgba(163, 230, 53, 0.16) !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-icon-btn,
        html[data-theme="dark"] .sh-navbar .sh-theme-toggle {
            color: #ffffff !important;
            border: 1.5px solid rgba(255, 255, 255, 0.2) !important;
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-icon-btn i,
        html[data-theme="dark"] .sh-navbar .sh-theme-toggle i {
            color: #ffffff !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-icon-btn:hover,
        html[data-theme="dark"] .sh-navbar .sh-theme-toggle:hover {
            color: #ffffff !important;
            background-color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-icon-btn:hover i,
        html[data-theme="dark"] .sh-navbar .sh-theme-toggle:hover i {
            color: #ffffff !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-cart-icon,
        html[data-theme="dark"] .sh-navbar .sh-cart-icon i {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.08) !important;
            border: 1.5px solid rgba(255, 255, 255, 0.2) !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-cart-icon:hover,
        html[data-theme="dark"] .sh-navbar .sh-cart-icon:hover i {
            color: var(--sh-primary) !important;
        }
        html[data-theme="dark"] .sh-navbar .btn-sh-login {
            color: #ffffff !important;
            border: 1.5px solid rgba(255, 255, 255, 0.3) !important;
            background-color: rgba(255, 255, 255, 0.06) !important;
        }
        html[data-theme="dark"] .sh-navbar .btn-sh-login:hover {
            color: #ffffff !important;
            background-color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-toggler {
            border: 1.5px solid rgba(255, 255, 255, 0.25) !important;
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-toggler .bar {
            background-color: #ffffff !important;
        }

        /* ===== General Buttons ===== */
        .btn-sh-primary {
            background: var(--sh-primary);
            border-color: var(--sh-primary);
            color: #fff;
            font-family: 'Comic Relief', system-ui, sans-serif;
            font-weight: 600;
            padding: .5rem 1.3rem;
            border-radius: 8px;
            transition: all .2s ease;
        }
        .btn-sh-primary:hover {
            background: var(--sh-primary-dark);
            border-color: var(--sh-primary-dark);
            color: #fff;
        }
        .btn-sh-outline-white {
            color: #fff;
            border: 2px solid rgba(255, 255, 255, 0.35);
            font-family: 'Comic Relief', system-ui, sans-serif;
            font-weight: 600;
            padding: .55rem 1.4rem;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(4px);
            transition: all .2s ease;
        }
        .btn-sh-outline-white:hover {
            background: var(--sh-primary);
            border-color: var(--sh-primary);
            color: #fff;
        }
        .btn-sh-login {
            background: #198754 !important;
            color: #ffffff !important;
            border: 2px solid #198754 !important;
            font-family: 'Comic Relief', system-ui, sans-serif;
            font-weight: 700;
            padding: .35rem 1rem;
            border-radius: 8px;
            transition: all .2s ease;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(25, 135, 84, 0.35);
        }
        .btn-sh-login:hover {
            background: #157347 !important;
            border-color: #157347 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(25, 135, 84, 0.5);
            transform: translateY(-1px);
        }
        html[data-theme="light"] .btn-sh-login {
            background: #198754 !important;
            border-color: #198754 !important;
            color: #ffffff !important;
        }
        html[data-theme="light"] .btn-sh-login:hover {
            background: #157347 !important;
            border-color: #157347 !important;
            color: #ffffff !important;
        }
        .btn-sh-outline {
            border: 2px solid var(--bs-body-color);
            color: var(--bs-body-color);
            font-weight: 600;
            padding: .5rem 1.25rem;
            border-radius: 8px;
            background: transparent;
            text-decoration: none;
            transition: all .2s ease;
        }
        .btn-sh-outline:hover {
            background: var(--bs-emphasis-color);
            color: var(--bs-body-bg);
            border-color: var(--bs-emphasis-color);
        }

        html[data-theme="light"] .btn-sh-outline-white {
            color: var(--bs-emphasis-color);
            border-color: var(--bs-border-color);
            background: transparent;
        }
        html[data-theme="light"] .btn-sh-outline-white:hover {
            background: var(--sh-primary);
            border-color: var(--sh-primary);
            color: #fff;
        }

        /* Hero buttons must always be white on the dark image background */
        .sh-hero .btn-sh-outline-white,
        html[data-theme="light"] .sh-hero .btn-sh-outline-white {
            color: #ffffff !important;
            border: 2px solid rgba(255, 255, 255, 0.45) !important;
            background: rgba(255, 255, 255, 0.08) !important;
        }
        .sh-hero .btn-sh-outline-white:hover,
        html[data-theme="light"] .sh-hero .btn-sh-outline-white:hover {
            background: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            color: #ffffff !important;
        }

        .btn-close {
            transition: filter .2s ease;
        }
        html[data-theme="dark"] .btn-close,
        [data-theme="dark"] .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        html[data-theme="light"] .btn-close,
        [data-theme="light"] .btn-close {
            filter: none;
        }

        /* ===== Accordion Theme Rules ===== */
        .sh-accordion .accordion-item {
            background-color: var(--sh-surface) !important;
            border: 1px solid var(--bs-border-color) !important;
        }
        .sh-accordion .accordion-button {
            background-color: var(--sh-surface) !important;
            color: var(--bs-emphasis-color) !important;
        }
        .sh-accordion .accordion-button:not(.collapsed) {
            background-color: rgba(120, 162, 47, 0.12) !important;
            color: var(--sh-primary) !important;
        }
        .sh-accordion .accordion-body {
            background-color: var(--sh-surface) !important;
            color: var(--bs-secondary-color) !important;
        }
        html[data-theme="dark"] .sh-accordion .accordion-button::after {
            filter: invert(1) grayscale(100%);
        }
        html[data-theme="light"] .sh-accordion .accordion-button::after {
            filter: none;
        }

        /* ===== Hero Carousel ===== */
        .sh-hero {
            background: var(--sh-black);
            position: relative;
        }
        .sh-hero-slide {
            position: relative;
            overflow: hidden;
            min-height: min(84vh, 720px);
            display: flex;
            align-items: center;
        }
        .sh-hero-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.05);
            animation: sh-hero-zoom 10s ease-out forwards;
        }
        @keyframes sh-hero-zoom {
            from { transform: scale(1.08); }
            to { transform: scale(1); }
        }
        .sh-hero-scrim {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(20, 20, 26, 0.94) 0%, rgba(20, 20, 26, 0.72) 48%, rgba(20, 20, 26, 0.25) 100%),
                linear-gradient(0deg, rgba(20, 20, 26, 0.8) 0%, rgba(20, 20, 26, 0) 40%);
        }
        .sh-hero-content {
            position: relative;
            z-index: 2;
            padding-top: 4.5rem;
            padding-bottom: 4.5rem;
            max-width: 720px;
        }
        .sh-hero .eyebrow {
            color: var(--sh-primary);
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-size: .8rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sh-hero .eyebrow::before {
            content: "";
            width: 36px;
            height: 2px;
            background: var(--sh-primary);
            display: inline-block;
        }
        .sh-hero h1 {
            color: #fff;
            font-size: clamp(2.2rem, 4.5vw + .5rem, 3.8rem);
            line-height: 1.15;
            text-shadow: 0 2px 24px rgba(0, 0, 0, 0.6);
        }
        .sh-hero h1 span {
            color: var(--sh-primary);
        }
        .sh-hero p.lead {
            color: rgba(255, 255, 255, 0.88);
            font-size: clamp(1rem, .5vw + .85rem, 1.25rem);
        }
        .sh-hero-stats > div {
            border-left: 2px solid var(--sh-primary);
            padding-left: 12px;
        }

        /* ===== Feature Strip ===== */
        .sh-strip {
            background: var(--sh-primary);
            color: #fff;
            overflow: hidden;
        }
        .sh-strip.has-scroll-anim .item {
            opacity: 0;
            transform: translateY(28px) scale(0.94);
        }
        .sh-strip.has-scroll-anim .item.is-visible {
            animation: shStripBounceIn 0.72s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
        .sh-strip.has-scroll-anim .item:nth-child(2).is-visible { animation-delay: 0.1s; }
        .sh-strip.has-scroll-anim .item:nth-child(3).is-visible { animation-delay: 0.2s; }
        .sh-strip.has-scroll-anim .item:nth-child(4).is-visible { animation-delay: 0.3s; }

        @keyframes shStripBounceIn {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.92);
            }
            55% {
                opacity: 1;
                transform: translateY(-8px) scale(1.04);
            }
            78% {
                opacity: 1;
                transform: translateY(3px) scale(0.99);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .sh-strip.has-scroll-anim .item {
                opacity: 1;
                transform: none;
            }
            .sh-strip.has-scroll-anim .item.is-visible {
                animation: none;
            }
        }
        .sh-strip .item i {
            font-size: 1.7rem;
            margin-bottom: .25rem;
        }
        .sh-strip .item strong {
            font-size: 1rem;
        }
        .sh-strip .item small {
            opacity: 0.9;
            font-size: .82rem;
            line-height: 1.2;
        }

        /* ===== Product Card (Exact fume-main architecture) ===== */
        .sh-product-card {
            background: var(--sh-surface);
            border-radius: 12px;
            overflow: hidden;
            transition: box-shadow .2s ease, transform .2s ease;
            position: relative;
            border: 1px solid var(--bs-border-color);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .sh-product-card:hover {
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.25);
            transform: translateY(-4px);
            border-color: var(--sh-primary);
        }
        .sh-product-img {
            aspect-ratio: 1 / 1;
            position: relative;
            overflow: hidden;
            display: block;
            background: #000;
        }
        .sh-product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }
        .sh-product-card:hover .sh-product-img img {
            transform: scale(1.06);
        }
        .sh-badge-sale, .sh-badge-new {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 2;
            color: #fff;
            font-size: .62rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 999px;
            letter-spacing: .5px;
        }
        .sh-badge-sale { background: var(--sh-primary); }
        .sh-badge-new { background: #10b981; }
        .sh-badge-original {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 2;
            background: rgba(20, 20, 26, 0.65);
            color: rgba(255, 255, 255, 0.85);
            font-size: .6rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 999px;
            text-decoration: line-through;
            backdrop-filter: blur(4px);
        }
        .sh-card-body {
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }
        .sh-card-brand {
            color: var(--bs-secondary-color);
            font-size: .68rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .sh-card-name {
            color: var(--bs-emphasis-color);
            font-size: .95rem;
            font-weight: 700;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .sh-card-price {
            display: flex;
            align-items: baseline;
            gap: 6px;
            flex-wrap: wrap;
            margin-top: 4px;
        }
        .price-now {
            color: var(--sh-primary);
            font-weight: 800;
            font-size: 1.05rem;
        }
        .price-old {
            text-decoration: line-through;
            color: var(--bs-secondary-color);
            font-size: .75rem;
        }
        .sh-discount-tag {
            display: inline-block;
            background: rgba(120, 162, 47, 0.16);
            color: var(--sh-primary);
            font-size: .62rem;
            font-weight: 700;
            padding: 0 6px;
            border-radius: 999px;
        }
        .sh-card-rating {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: .65rem;
        }
        .sh-card-rating .stars {
            color: var(--sh-gold);
        }
        .sh-card-cart-btn {
            width: 100%;
            padding: 8px 0;
            background: var(--sh-primary);
            color: #fff;
            border: none;
            border-radius: 999px;
            font-weight: 600;
            font-size: .85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: auto;
            transition: all .2s;
            cursor: pointer;
            text-decoration: none;
        }
        .sh-card-cart-btn:hover {
            background: var(--sh-primary-dark);
            color: #fff;
        }
        .sh-card-cart-btn.has-scroll-anim {
            opacity: 0;
            transform: translateY(20px) scale(0.94);
        }
        .sh-card-cart-btn.has-scroll-anim.is-visible {
            animation: shStripBounceIn 0.72s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
        @media (prefers-reduced-motion: reduce) {
            .sh-card-cart-btn.has-scroll-anim {
                opacity: 1;
                transform: none;
            }
            .sh-card-cart-btn.has-scroll-anim.is-visible {
                animation: none;
            }
        }

        /* ===== Section Titles ===== */
        .sh-eyebrow {
            color: var(--sh-primary);
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 0.8rem;
            margin-bottom: .25rem;
        }
        .sh-title {
            font-weight: 800;
            color: var(--bs-emphasis-color);
        }

        /* ===== Category Cards (Harvest Categories / Agro Basins) ===== */
        .sh-cat-card {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            height: 220px;
            display: flex;
            align-items: flex-end;
            text-decoration: none;
            border: 1px solid var(--bs-border-color);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease, border-color 0.3s ease;
        }
        .sh-cat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
            border-color: rgba(163, 230, 53, 0.55);
        }
        .sh-cat-card picture {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            display: block;
        }
        .sh-cat-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s cubic-bezier(0.16, 1, 0.3, 1);
            display: block;
        }
        .sh-cat-card:hover img {
            transform: scale(1.08);
        }
        .sh-cat-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(8, 10, 14, 0.15) 0%, rgba(8, 10, 14, 0.55) 45%, rgba(8, 10, 14, 0.92) 100%);
            z-index: 2;
            pointer-events: none;
            transition: background 0.3s ease;
        }
        .sh-cat-card:hover::before {
            background: linear-gradient(180deg, rgba(8, 10, 14, 0.25) 0%, rgba(8, 10, 14, 0.68) 45%, rgba(8, 10, 14, 0.96) 100%);
        }
        .sh-cat-card .label {
            position: relative;
            z-index: 3;
            width: calc(100% - 1.2rem);
            margin: 0.6rem;
            padding: 0.85rem 1rem;
            background: rgba(12, 14, 18, 0.88);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 11px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.65);
            transition: background 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
        }
        .sh-cat-card:hover .label {
            background: rgba(18, 22, 28, 0.95);
            border-color: rgba(163, 230, 53, 0.5);
            transform: translateY(-2px);
        }
        .sh-cat-card .label h5 {
            font-weight: 800;
            font-size: 1.02rem;
            margin-bottom: .25rem;
            color: #ffffff !important;
            letter-spacing: -0.01em;
            line-height: 1.25;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.95);
        }
        .sh-cat-card .label span {
            color: #bef264 !important;
            font-weight: 700;
            font-size: .82rem;
            letter-spacing: 0.02em;
            display: block;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.95);
        }
        @media (max-width: 575.98px) {
            .sh-cat-card {
                height: 195px;
            }
            .sh-cat-card .label {
                width: calc(100% - 0.8rem);
                margin: 0.4rem;
                padding: 0.65rem 0.75rem;
            }
            .sh-cat-card .label h5 {
                font-size: 0.92rem;
            }
            .sh-cat-card .label span {
                font-size: 0.75rem;
            }
        }

        /* ===== Promo Banner ===== */
        .sh-promo {
            background: var(--sh-primary);
            border-radius: 18px;
            overflow: hidden;
            position: relative;
            color: #fff;
        }
        .sh-promo h3 {
            color: #fff;
            font-weight: 800;
        }
        .sh-promo p {
            color: rgba(255, 255, 255, 0.92);
        }

        /* ===== Testimonials ===== */
        .sh-testimonial {
            background: var(--sh-surface);
            border-radius: 14px;
            padding: 1.5rem;
            height: 100%;
            border: 1px solid var(--bs-border-color);
        }
        .sh-stars {
            color: var(--sh-gold);
            letter-spacing: 2px;
        }

        /* ===== Footer (Horizontal Layout Across All Elements) ===== */
        .sh-footer {
            background: #111116 !important;
            color: rgba(255, 255, 255, 0.72) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        .sh-footer h6,
        .sh-footer .sh-footer-col h6,
        .sh-footer .sh-footer-col-brand h6,
        .sh-footer .sh-footer-col-contact h6 {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
        }
        .sh-footer a {
            color: rgba(255, 255, 255, 0.7) !important;
            text-decoration: none;
            transition: color .2s ease;
        }
        .sh-footer a:hover {
            color: var(--sh-primary) !important;
        }
        .sh-footer .social-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.25) !important;
            background: rgba(255, 255, 255, 0.05);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff !important;
            margin-right: .5rem;
            transition: all .2s ease;
        }
        .sh-footer .social-icon:hover {
            background: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            color: #ffffff !important;
        }
        .sh-footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .sh-footer-horizontal-wrap {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
            align-items: flex-start;
            gap: 2.25rem;
            width: 100%;
        }
        .sh-footer-col-brand {
            flex: 2.2 1 240px;
            min-width: 210px;
            max-width: 290px;
        }
        .sh-footer-col {
            flex: 1.1 1 125px;
            min-width: 115px;
        }
        .sh-footer-col-contact {
            flex: 1.8 1 220px;
            min-width: 200px;
        }

        @media (max-width: 1199.98px) {
            .sh-footer-horizontal-wrap {
                flex-wrap: wrap;
                gap: 2rem 1.5rem;
            }
            .sh-footer-col-brand {
                flex: 1 1 100%;
                max-width: 100%;
                border-bottom: 1px solid var(--sh-border);
                padding-bottom: 1.25rem;
                margin-bottom: 0.25rem;
            }
            .sh-footer-col {
                flex: 1 1 calc(25% - 1.5rem);
                min-width: 130px;
            }
            .sh-footer-col-contact {
                flex: 1 1 calc(50% - 1.5rem);
                min-width: 220px;
            }
        }
        @media (max-width: 767.98px) {
            .sh-footer-horizontal-wrap {
                flex-wrap: wrap;
                gap: 1.5rem 1rem;
            }
            .sh-footer-col {
                flex: 1 1 calc(50% - 1rem);
            }
            .sh-footer-col-contact {
                flex: 1 1 100%;
            }
        }

        /* ===== Mobile Bottom Navigation (sh-tabbar) ===== */
        .sh-tabbar {
            display: none;
        }
        @media (max-width: 991.98px) {
            .sh-tabbar {
                display: flex;
                position: fixed;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 1045;
                background: rgba(20, 20, 26, 0.98);
                backdrop-filter: blur(12px);
                border-top: 1px solid rgba(255, 255, 255, 0.12);
                padding: 6px 4px calc(6px + env(safe-area-inset-bottom));
                justify-content: space-around;
                align-items: center;
            }
            body { padding-bottom: 64px; }
        }
        .sh-tabbar > a {
            flex: 1 1 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            font-size: .68rem;
            font-weight: 600;
            position: relative;
            transition: color .18s ease;
        }
        .sh-tabbar > a.active, .sh-tabbar > a:hover { color: var(--sh-primary); }
        html[data-theme="light"] .sh-tabbar {
            background: rgba(255, 255, 255, 0.98);
            border-top: 1px solid rgba(20, 20, 26, 0.12);
        }
        html[data-theme="light"] .sh-tabbar > a {
            color: rgba(20, 20, 26, 0.68);
        }
        html[data-theme="light"] .sh-tabbar > a.active,
        html[data-theme="light"] .sh-tabbar > a:hover {
            color: var(--sh-primary);
        }
        .sh-tabbar-badge {
            position: absolute;
            top: -2px;
            left: calc(50% + 6px);
            min-width: 16px;
            height: 16px;
            padding: 0 4px;
            background: var(--sh-primary);
            color: #fff;
            font-size: .58rem;
            font-weight: 700;
            line-height: 16px;
            text-align: center;
            border-radius: 999px;
        }

        /* ===== Agrovia Commodity Cart Drawer ===== */
        .sh-cart-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 12, 16, 0.72);
            backdrop-filter: blur(4px);
            z-index: 1055;
            opacity: 0;
            visibility: hidden;
            transition: opacity .25s ease, visibility .25s ease;
            overflow: hidden !important;
        }
        .sh-cart-backdrop.show {
            opacity: 1;
            visibility: visible;
        }
        .sh-cart-offcanvas {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            width: 440px !important;
            max-width: 100% !important;
            background: var(--sh-surface) !important;
            color: var(--bs-body-color) !important;
            border-left: 1px solid var(--sh-border) !important;
            box-shadow: -10px 0 40px rgba(0, 0, 0, 0.5);
            z-index: 1060;
            transform: translateX(100%);
            transition: transform .32s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            overflow-x: hidden !important;
            overflow-y: hidden !important;
            box-sizing: border-box;
        }
        .sh-cart-offcanvas.show {
            transform: translateX(0);
        }
        .sh-cart-offcanvas .offcanvas-header {
            border-bottom: 1px solid var(--sh-border);
            padding: 1.1rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            width: 100%;
            box-sizing: border-box;
        }
        .sh-cart-offcanvas .offcanvas-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            flex: 1 1 auto;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box;
        }
        .sh-cart-items-container {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1rem;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box;
            overflow: hidden;
        }
        .sh-cart-item {
            background: var(--sh-surface-alt, rgba(255, 255, 255, 0.04));
            border: 1px solid var(--sh-border);
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box;
            overflow: hidden;
            transition: border-color .2s ease, transform .2s ease;
        }
        .sh-cart-item:hover {
            border-color: rgba(120, 162, 47, 0.45);
            transform: translateY(-1px);
        }
        .sh-cart-thumb {
            width: 58px;
            height: 58px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--sh-border);
            flex-shrink: 0;
        }
        .sh-cart-item-details {
            flex: 1 1 0;
            min-width: 0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .sh-cart-item-title-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 8px;
            width: 100%;
            min-width: 0;
        }
        .sh-cart-item-title {
            margin: 0;
            font-weight: 700;
            font-size: 0.88rem;
            line-height: 1.35;
            color: var(--bs-emphasis-color);
            word-break: break-word;
            overflow-wrap: break-word;
            flex: 1 1 auto;
            min-width: 0;
        }
        .sh-cart-del-btn {
            background: transparent;
            border: none;
            color: #dc3545;
            font-size: 0.95rem;
            line-height: 1;
            padding: 2px 4px;
            cursor: pointer;
            flex-shrink: 0;
            user-select: none !important;
            -webkit-user-select: none !important;
            transition: color .15s ease, transform .15s ease;
        }
        .sh-cart-del-btn:hover {
            color: #b02a37;
            transform: scale(1.1);
        }
        .sh-cart-qty-ctrl {
            display: inline-flex;
            align-items: center;
            background: var(--sh-surface);
            border: 1px solid var(--sh-border);
            border-radius: 30px;
            padding: 2px 4px;
            user-select: none !important;
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            flex-shrink: 0;
        }
        .sh-cart-qty-btn {
            background: transparent;
            border: none;
            color: var(--bs-body-color);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            cursor: pointer;
            transition: background .15s ease, color .15s ease;
            user-select: none !important;
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            outline: none !important;
            box-shadow: none !important;
        }
        .sh-cart-qty-btn:hover {
            background: var(--sh-primary);
            color: #fff;
        }
        .sh-cart-qty-btn:focus {
            outline: none !important;
            box-shadow: none !important;
        }
        .sh-cart-qty-val {
            font-size: .85rem;
            font-weight: 700;
            padding: 0 8px;
            min-width: 24px;
            text-align: center;
            color: var(--bs-emphasis-color);
            user-select: none !important;
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
        }
        .sh-cart-assurance-card {
            background: rgba(120, 162, 47, 0.08);
            border: 1px solid rgba(120, 162, 47, 0.25);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: .8rem;
            width: 100% !important;
            box-sizing: border-box;
            overflow: hidden;
            word-break: break-word;
        }
        .sh-cart-summary-box {
            background: var(--sh-surface-alt, rgba(255, 255, 255, 0.04));
            border: 1px solid var(--sh-border);
            border-radius: 12px;
            padding: 14px;
            width: 100% !important;
            box-sizing: border-box;
            overflow: hidden;
        }
        html[data-theme="light"] .sh-cart-qty-ctrl {
            background: #f1f2f6;
            border-color: rgba(20, 20, 26, 0.15);
        }
        html[data-theme="light"] .sh-cart-qty-btn {
            color: #14141a;
        }
        html[data-theme="light"] .sh-cart-qty-btn:hover {
            background: var(--sh-primary);
            color: #ffffff;
        }
        html[data-theme="light"] .sh-cart-qty-val {
            color: #14141a;
        }
        html[data-theme="light"] .sh-cart-item {
            background: #f8f9fa !important;
            border-color: rgba(20, 20, 26, 0.1) !important;
        }
        html[data-theme="light"] .sh-cart-item:hover {
            border-color: var(--sh-primary) !important;
        }
        html[data-theme="light"] .sh-cart-assurance-card {
            background: rgba(120, 162, 47, 0.1) !important;
            border-color: rgba(120, 162, 47, 0.3) !important;
        }
        html[data-theme="light"] .sh-cart-summary-box {
            background: #f8f9fa !important;
            border-color: rgba(20, 20, 26, 0.1) !important;
        }

        .sh-btn-google-modal {
            background-color: var(--sh-surface) !important;
            border: 1px solid var(--bs-border-color) !important;
            color: var(--bs-emphasis-color) !important;
            border-radius: 8px !important;
            transition: all 0.2s ease;
        }
        .sh-btn-google-modal:hover {
            background-color: var(--sh-surface-alt) !important;
            border-color: #4285F4 !important;
            color: var(--bs-emphasis-color) !important;
            box-shadow: 0 4px 12px rgba(66, 133, 244, 0.2);
            transform: translateY(-1px);
        }

        /* ===== Cart Toast ===== */
        .sh-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #1b1b24;
            color: #fff;
            padding: 14px 20px;
            border-radius: 12px;
            border: 1px solid var(--sh-primary);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.5);
            min-width: 280px;
            max-width: 380px;
            transform: translateX(130%);
            opacity: 0;
            transition: transform .4s cubic-bezier(.16, 1, .3, 1), opacity .4s ease;
        }
        .sh-toast.sh-toast-show { transform: translateX(0); opacity: 1; }
        .sh-toast.sh-toast-hide { transform: translateX(130%); opacity: 0; }
        .sh-toast-icon { color: var(--sh-primary); font-size: 1.4rem; flex-shrink: 0; }

        /* ===== Scroll Top ===== */
        .sh-scroll-top {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--sh-primary);
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all .25s ease;
            z-index: 999;
        }
        .sh-scroll-top.visible { opacity: 1; visibility: visible; }
        .sh-scroll-top:hover { background: var(--sh-primary-dark); }
        @media (max-width: 991.98px) {
            .sh-scroll-top { bottom: 74px; right: 16px; }
        }
    </style>
</head>

<body>

    <!-- 1. STICKY TOP NAVBAR (Horizontal Straightline Layout) -->
    <nav class="navbar navbar-expand-lg sh-navbar sticky-top" id="top">
        <div class="container-fluid px-2 px-sm-3 px-xl-4 w-100">
            <!-- Brand Lockup with Emblem Logo and Balanced Typography -->
            <a class="navbar-brand brx-navbar-brand py-0 me-2 me-xl-3" href="{{ route('home') }}" title="BRX Agro Global Importação e Exportação Ltda">
                <img src="{{ asset('img/brx-emblem-nav.png') }}" alt="BRX Agro Global Logo" class="brx-navbar-emblem" width="44" height="44">
                <div class="brx-brand-wrap">
                    <div class="brx-brand-row">
                        <span class="brx-name-lead">BRX</span>
                        <span class="brx-name-tag">AGRO GLOBAL</span>
                    </div>
                    <span class="brx-legal-sub">IMPORTAÇÃO E EXPORTAÇÃO LTDA</span>
                </div>
            </a>

            <!-- Mobile Quick Actions & Hamburger Toggler (visible on small screens) -->
            <div class="d-flex align-items-center gap-1 d-lg-none ms-auto">
                @auth
                    <button type="button" class="sh-icon-btn text-success" data-bs-toggle="modal" data-bs-target="#agroviaAccountModal" aria-label="My Account" title="My Account">
                        <i class="bi bi-person-circle fs-5"></i>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="sh-icon-btn text-white-50" aria-label="Sign In" title="Sign In">
                        <i class="bi bi-person fs-5"></i>
                    </a>
                @endauth
                <button class="navbar-toggler sh-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>

            <!-- Nav Links on a Straight Line Horizontally -->
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto sh-nav-straightline">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown sh-nav-dropdown sh-mega-dropdown">
                        <a class="nav-link dropdown-toggle" href="#products" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <div class="dropdown-menu sh-products-mega-menu shadow-lg p-0">
                            <!-- Mega Menu Header -->
                            <div class="px-3 py-2 border-bottom d-flex align-items-center justify-content-between sh-mega-header">
                                <span class="fw-bold text-uppercase d-flex align-items-center gap-1.5" style="letter-spacing: 0.8px; font-size: 0.74rem;">
                                    <i class="bi bi-boxes text-success"></i> Commodity Sectors
                                </span>
                                <span class="sh-mega-badge" style="background: #14532d !important; color: #ffffff !important; font-weight: 800 !important; font-size: 0.74rem !important; border: 1.5px solid #4ade80 !important; border-radius: 999px !important; padding: 0.28rem 0.75rem !important; display: inline-flex !important; align-items: center !important; gap: 5px !important; text-transform: uppercase !important; letter-spacing: 0.5px !important; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25) !important; white-space: nowrap !important;">
                                    <i class="bi bi-patch-check-fill" style="color: #4ade80 !important;"></i>
                                    <span>10 Export Categories</span>
                                </span>
                            </div>

                            <!-- Mega Menu Grid (Arranged Horizontally in 3 Columns) -->
                            <div class="p-3">
                                <div class="sh-mega-grid">
                                    <a class="dropdown-item agro-nav-cat-filter sh-mega-item" href="#products" data-filter="Grains & Rice">
                                        <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.55rem;"></i>
                                        <span>Grains &amp; Rice</span>
                                    </a>
                                    <a class="dropdown-item agro-nav-cat-filter sh-mega-item" href="#products" data-filter="Oil & Sugar">
                                        <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.55rem;"></i>
                                        <span>Oil &amp; Sugar</span>
                                    </a>
                                    <a class="dropdown-item agro-nav-cat-filter sh-mega-item" href="#products" data-filter="Nuts & Seeds">
                                        <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.55rem;"></i>
                                        <span>Nuts &amp; Seeds</span>
                                    </a>
                                    <a class="dropdown-item agro-nav-cat-filter sh-mega-item" href="#products" data-filter="Lentils & Pulses">
                                        <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.55rem;"></i>
                                        <span>Lentils &amp; Pulses</span>
                                    </a>
                                    <a class="dropdown-item agro-nav-cat-filter sh-mega-item" href="#products" data-filter="Poultry & Meat">
                                        <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.55rem;"></i>
                                        <span>Poultry &amp; Meat</span>
                                    </a>
                                    <a class="dropdown-item agro-nav-cat-filter sh-mega-item" href="#products" data-filter="Meat & Seafood">
                                        <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.55rem;"></i>
                                        <span>Meat &amp; Seafood</span>
                                    </a>
                                    <a class="dropdown-item agro-nav-cat-filter sh-mega-item" href="#products" data-filter="Spices & Specialty">
                                        <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.55rem;"></i>
                                        <span>Spices &amp; Specialty</span>
                                    </a>
                                    <a class="dropdown-item agro-nav-cat-filter sh-mega-item" href="#products" data-filter="Dairy Products">
                                        <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.55rem;"></i>
                                        <span>Dairy Products</span>
                                    </a>
                                    <a class="dropdown-item agro-nav-cat-filter sh-mega-item" href="#products" data-filter="Fruits & Vegetables">
                                        <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.55rem;"></i>
                                        <span>Fruits &amp; Vegetables</span>
                                    </a>
                                    <a class="dropdown-item agro-nav-cat-filter sh-mega-item" href="#products" data-filter="Juices & Drinks">
                                        <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.55rem;"></i>
                                        <span>Juices &amp; Drinks</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Mega Menu Bottom Action Bar (Arranged Horizontally) -->
                            <div class="px-3 py-2.5 border-top d-flex flex-wrap align-items-center justify-content-between gap-2 sh-mega-footer">
                                <a class="dropdown-item fw-bold text-success d-inline-flex align-items-center gap-1.5 py-1 px-2.5 rounded-2 w-auto" href="#products">
                                    <i class="bi bi-grid-fill"></i> Shop All Products
                                </a>
                                <a class="dropdown-item fw-semibold text-primary d-inline-flex align-items-center gap-1.5 py-1 px-2.5 rounded-2 w-auto" href="#rfq-desk">
                                    <i class="bi bi-file-earmark-text-fill"></i> Direct RFQ Desk
                                </a>
                                <a class="dropdown-item fw-semibold d-inline-flex align-items-center gap-1.5 py-1 px-2.5 rounded-2 w-auto" href="javascript:void(0)" onclick="document.getElementById('cartTriggerBtn').click()">
                                    <i class="bi bi-cart3 text-success"></i> Sample Cart
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#process">Process</a>
                    </li>
                    <li class="nav-item dropdown sh-nav-dropdown">
                        <a class="nav-link dropdown-toggle" href="#about" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Company
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item py-2" href="#about"><i class="bi bi-building text-success me-2"></i>About BRX Agro</a></li>
                            <li><a class="dropdown-item py-2" href="#insights"><i class="bi bi-geo-alt text-success me-2"></i>Agro Basins &amp; Insights</a></li>
                            <li><a class="dropdown-item py-2" href="#blog"><i class="bi bi-newspaper text-success me-2"></i>Market Blog</a></li>
                            <li><a class="dropdown-item py-2" href="#faq"><i class="bi bi-question-circle text-success me-2"></i>Frequently Asked Questions</a></li>
                            <li><hr class="dropdown-divider border-secondary my-1"></li>
                            <li><a class="dropdown-item py-2" href="javascript:void(0)" onclick="openTradeDeskInbox()"><i class="bi bi-chat-dots text-success me-2"></i>Trade Desk Inbox</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>

                <!-- Navbar Actions (Theme / Cart / Search / Auth) -->
                <div class="sh-nav-actions d-flex align-items-center gap-1.5 gap-sm-2 ms-lg-auto mt-3 mt-lg-0 flex-shrink-0">
                    <!-- Theme Toggle -->
                    <button type="button" class="sh-icon-btn sh-theme-toggle flex-shrink-0" id="themeToggleBtn" aria-label="Toggle dark / light theme" title="Toggle Theme">
                        <i class="bi bi-moon-stars"></i>
                    </button>

                    <!-- Search Trigger Modal -->
                    <button type="button" class="sh-icon-btn flex-shrink-0" id="searchTriggerBtn" data-bs-toggle="modal" data-bs-target="#searchModal" title="Search Products">
                        <i class="bi bi-search"></i>
                    </button>

                    <!-- Cart Icon with Badge -->
                    <a href="javascript:void(0)" class="sh-cart-icon flex-shrink-0" id="cartTriggerBtn" aria-label="Cart" title="View Cart">
                        <i class="bi bi-cart3"></i>
                        <span class="sh-cart-badge" id="cartCountBadge">0</span>
                    </a>

                    <!-- Auth Dropdown / Buttons -->
                    @auth
                        <div class="dropdown flex-shrink-0">
                            <button class="btn btn-sh-primary btn-sm dropdown-toggle d-inline-flex align-items-center gap-1 text-nowrap" data-bs-toggle="dropdown">
                                <i class="bi bi-person"></i> {{ Str::limit(auth()->user()->name, 12) }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="background: var(--sh-surface); border: 1px solid var(--bs-border-color);">
                                <li class="px-3 py-2 border-bottom small text-muted">
                                    Signed in as <strong class="d-block sh-text-title">{{ auth()->user()->email }}</strong>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#agroviaAccountModal">
                                        <i class="bi bi-person-badge text-success me-2"></i>My Account Portal
                                    </a>
                                </li>
                                @if (auth()->user()->isAdmin())
                                    <li>
                                        <a class="dropdown-item py-2 text-warning fw-bold" href="{{ route('admin.dashboard') }}">
                                             <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.products.index') }}">
                                            <i class="bi bi-box-seam me-2"></i>Manage Products
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.inquiries.index') }}">
                                            <i class="bi bi-envelope me-2"></i>Trade Inquiries
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider border-secondary my-1"></li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger">
                                             <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sh-login btn-sm text-nowrap flex-shrink-0">Log in</a>
                        <a href="{{ route('register') }}" class="btn btn-sh-primary btn-sm text-nowrap flex-shrink-0">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        <!-- 2. HERO CAROUSEL (Exact fume-main layout) -->
        <section class="sh-hero">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4500">
                @if(isset($heroSlides) && $heroSlides->isNotEmpty())
                    <div class="carousel-indicators">
                        @foreach($heroSlides as $index => $slide)
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach($heroSlides as $index => $slide)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="sh-hero-slide">
                                    <picture>
                                        @if($slide->resolvedWebpUrl())
                                            <source srcset="{{ $slide->resolvedWebpUrl() }}" type="image/webp">
                                        @endif
                                        <img src="{{ $slide->resolvedImageUrl() }}" alt="{{ $slide->title }}" class="sh-hero-bg" @if($index > 0) loading="lazy" decoding="async" @endif>
                                    </picture>
                                    <div class="sh-hero-scrim"></div>
                                    <div class="container sh-hero-content">
                                        @if($slide->eyebrow)
                                            <div class="eyebrow mb-3">{{ $slide->eyebrow }}</div>
                                        @endif
                                        <h1 class="mb-4">
                                            {{ $slide->title }}
                                            @if($slide->title_highlight)
                                                <span style="color: var(--sh-primary);">{{ $slide->title_highlight }}</span>
                                            @endif
                                        </h1>
                                        @if($slide->description)
                                            <p class="lead mb-4">{{ $slide->description }}</p>
                                        @endif
                                        @if($slide->primary_cta_text || $slide->secondary_cta_text)
                                            <div class="d-flex gap-3 flex-wrap">
                                                @if($slide->primary_cta_text)
                                                    <a href="{{ $slide->primary_cta_url ?: '#products' }}" class="btn btn-sh-primary btn-lg">{{ $slide->primary_cta_text }}</a>
                                                @endif
                                                @if($slide->secondary_cta_text)
                                                    <a href="{{ $slide->secondary_cta_url ?: '#rfq-desk' }}" class="btn btn-sh-outline-white btn-lg">{{ $slide->secondary_cta_text }}</a>
                                                @endif
                                            </div>
                                        @endif
                                        @if(!empty($slide->stats))
                                            <div class="d-flex gap-4 mt-5 flex-wrap sh-hero-stats">
                                                @foreach($slide->stats as $stat)
                                                    <div>
                                                        <div class="fs-4 fw-bold text-white">{{ str_replace('{total_stock}', number_format($totalStock ?? 18500), $stat['value'] ?? '') }}</div>
                                                        <small class="text-white-50">{{ $stat['label'] ?? '' }}</small>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                    <!-- Slide 1: Farm Origination & Port Export -->
                    <div class="carousel-item active">
                        <div class="sh-hero-slide">
                            <picture>
                                <source srcset="{{ asset('img/banner-shipping.webp') }}" type="image/webp">
                                <img src="{{ asset('img/banner-shipping.jpg') }}" alt="Brazilian Direct Farm Sourcing & Deepwater Export" class="sh-hero-bg">
                            </picture>
                            <div class="sh-hero-scrim"></div>
                            <div class="container sh-hero-content">
                                <div class="eyebrow mb-3">Direct Harvest Basin Sourcing</div>
                                <h1 class="mb-4">From Brazilian Farms to <span style="color: var(--sh-primary);">Global Tables</span></h1>
                                <p class="lead mb-4">Direct bulk origination of Brazilian Non-GMO Soybeans, Refined Cane Sugar (ICUMSA 45), Yellow Corn, Poultry, Meats, and Pulses. Backed by MAPA phytosanitary clearance, independent SGS assays, and certified origin discharge documentation.</p>
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="#products" class="btn btn-sh-primary btn-lg">Explore Agricultural Products</a>
                                    <a href="#rfq-desk" class="btn btn-sh-outline-white btn-lg">Request Bulk RFQ</a>
                                </div>
                                <div class="d-flex gap-4 mt-5 flex-wrap sh-hero-stats">
                                    <div>
                                        <div class="fs-4 fw-bold text-white">{{ number_format($totalStock ?? 18500) }}+ MT</div>
                                        <small class="text-white-50">Active Supply</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">100% SGS</div>
                                        <small class="text-white-50">Pre-Shipment Tested</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">Zero Risk</div>
                                        <small class="text-white-50">Global Port Discharge</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">Santos &amp; Paranaguá</div>
                                        <small class="text-white-50">Deepwater Exit Ports</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2: Certified Harvests & Direct Co-ops -->
                    <div class="carousel-item">
                        <div class="sh-hero-slide">
                            <picture>
                                <source srcset="{{ asset('img/banner-harvest.webp') }}" type="image/webp">
                                <img src="{{ asset('img/banner-harvest.jpg') }}" alt="Export Grade Brazilian Commodities" class="sh-hero-bg" loading="lazy" decoding="async">
                            </picture>
                            <div class="sh-hero-scrim"></div>
                            <div class="container sh-hero-content">
                                <div class="eyebrow mb-3">Bulk Contracts &amp; Spot Lots</div>
                                <h1 class="mb-4">Source Certified Grains, <span style="color: var(--sh-primary);">Sugar &amp; Specialty</span></h1>
                                <p class="lead mb-4">Eliminate trading middlemen with accredited farm cooperatives across Mato Grosso, Paraná, and Goiás. Complete origin traceability and guaranteed international loading schedules.</p>
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="#products" class="btn btn-sh-primary btn-lg">Explore Agricultural Products</a>
                                    <a href="#rfq-desk" class="btn btn-sh-outline-white btn-lg">Request Bulk RFQ</a>
                                </div>
                                <div class="d-flex gap-4 mt-5 flex-wrap sh-hero-stats">
                                    <div>
                                        <div class="fs-4 fw-bold text-white">10 Sectors</div>
                                        <small class="text-white-50">Commodity Categories</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">FOB &amp; CIF</div>
                                        <small class="text-white-50">Global IncoTerms</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">&lt; 4 Hours</div>
                                        <small class="text-white-50">Quote Turnaround</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">USD / EUR / BRL</div>
                                        <small class="text-white-50">Settlement Currency</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3: Export Packaging, Cold Chain & 5 Continents -->
                    <div class="carousel-item">
                        <div class="sh-hero-slide">
                            <picture>
                                <source srcset="{{ asset('img/banner-warehouse.webp') }}" type="image/webp">
                                <img src="{{ asset('img/banner-warehouse.jpg') }}" alt="Export Packaging, Warehousing & Cold-Chain Fleet" class="sh-hero-bg" loading="lazy" decoding="async">
                            </picture>
                            <div class="sh-hero-scrim"></div>
                            <div class="container sh-hero-content">
                                <div class="eyebrow mb-3">Export Packaging &amp; Cold-Chain Fleet</div>
                                <h1 class="mb-4">Supplying Worldwide Across <span style="color: var(--sh-primary);">5 Continents</span></h1>
                                <p class="lead mb-4">From 25kg / 50kg multi-wall bags and bulk container liners to -18°C refrigerated containers. Certified supply chains across Poultry, Meats, Dairy, Pulses, Grains, Sugar, Spices, and Fresh Fruits with 24/7 Trade Desk support.</p>
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="#products" class="btn btn-sh-primary btn-lg">Explore All 20 Products</a>
                                    <a href="#rfq-desk" class="btn btn-sh-outline-white btn-lg">Request Trade Desk RFQ</a>
                                </div>
                                <div class="d-flex gap-4 mt-5 flex-wrap sh-hero-stats">
                                    <div>
                                        <div class="fs-4 fw-bold text-white">5 Continents</div>
                                        <small class="text-white-50">Global Distribution</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">25kg - Bulk</div>
                                        <small class="text-white-50">Customized Packaging</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">-18°C Reefer</div>
                                        <small class="text-white-50">Cold Chain Integrity</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">MAPA / SIF</div>
                                        <small class="text-white-50">Sanitary Clearance</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <button class="carousel-control-prev d-none d-md-flex" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </section>

        <!-- 3. SEARCH BAR STRIP (Under Hero, exact fume-main layout) -->
        <section class="py-4" style="background: var(--sh-surface-alt); border-bottom: 1px solid var(--bs-border-color);">
            <div class="container">
                <form action="#products" method="GET" class="mx-auto" style="max-width: 620px;" onsubmit="event.preventDefault(); var q = $('#quickSearchInput').val().toLowerCase(); $('.agro-filter-btn[data-filter=\'all\']').click(); $('.product-item').each(function(){ var t = $(this).text().toLowerCase(); $(this).toggle(t.indexOf(q) !== -1); }); $('html, body').animate({scrollTop: $('#products').offset().top - 80}, 600);">
                    <div class="input-group">
                        <input type="text" id="quickSearchInput" class="form-control form-control-lg sh-input" placeholder="Search Brazilian commodities, grades, harvest basins..." style="border-radius: 8px 0 0 8px; font-size: 1rem;">
                        <button type="submit" class="btn btn-sh-primary btn-lg" style="border-radius: 0 8px 8px 0;">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- 4. SERVICES / FEATURE STRIP (Exact fume-main layout) -->
        <section class="sh-strip py-3" id="services">
            <div class="container">
                <div class="row text-center g-3">
                    <div class="col-6 col-md-3 item d-flex flex-column align-items-center">
                        <i class="bi bi-truck"></i>
                        <strong>Bulk &amp; Port Freight</strong>
                        <small>Deepwater container &amp; vessel loading</small>
                    </div>
                    <div class="col-6 col-md-3 item d-flex flex-column align-items-center">
                        <i class="bi bi-shield-check"></i>
                        <strong>Destination Port Sourcing</strong>
                        <small>Zero default counterparty protection</small>
                    </div>
                    <div class="col-6 col-md-3 item d-flex flex-column align-items-center">
                        <i class="bi bi-award"></i>
                        <strong>SGS &amp; MAPA Assays</strong>
                        <small>100% pre-loading lab assay inspection</small>
                    </div>
                    <div class="col-6 col-md-3 item d-flex flex-column align-items-center">
                        <i class="bi bi-headset"></i>
                        <strong>24/7 Trade Desk</strong>
                        <small>Direct WhatsApp &amp; São Paulo HQ</small>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. FEATURED PRODUCTS (Exact fume-main product grid architecture) -->
        <section class="py-5" id="products">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Export Catalog</div>
                        <h2 class="sh-title mb-0">Featured Agro Products</h2>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <button type="button" class="btn btn-sm btn-outline-secondary agro-filter-btn active" data-filter="all">All</button>
                        @if (isset($categories) && $categories->isNotEmpty())
                            @foreach ($categories as $cat)
                                <button type="button" class="btn btn-sm btn-outline-secondary agro-filter-btn" data-filter="{{ $cat->name }}">{{ $cat->name }}</button>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Product Grid: 4 columns like fume-main -->
                <div class="row row-cols-2 row-cols-md-4 g-3 g-md-4" id="catalogGrid">
                    @forelse ($products as $product)
                        <div class="col product-item" data-category="{{ $product->category->name ?? 'Grains & Rice' }}">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <a href="javascript:void(0)" class="quick-view-trigger" data-product="{{ $product->name }}" data-price="Price Calculated by Destination (FOB / CIF)" data-image="{{ asset($product->image ?: 'img/service-1.jpg') }}" data-origin="{{ $product->origin ?? 'Brazil' }}" data-unit="{{ $product->unit ?? 'MT' }}">
                                        <img src="{{ asset($product->image ?: 'img/service-1.jpg') }}" alt="{{ $product->name }}" loading="lazy" decoding="async">
                                    </a>
                                    @if ($product->unit == 'Metric Ton')
                                        <span class="sh-badge-sale">BULK / B2B</span>
                                    @elseif ($product->is_new)
                                        <span class="sh-badge-new">NEW</span>
                                    @endif

                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">{{ $product->origin ?? 'Brazil' }} · {{ $product->category->name ?? 'Agro' }}</div>
                                    <a href="javascript:void(0)" class="text-decoration-none quick-view-trigger" data-product="{{ $product->name }}" data-price="Price Calculated by Destination (FOB / CIF)" data-image="{{ asset($product->image ?: 'img/service-1.jpg') }}" data-origin="{{ $product->origin ?? 'Brazil' }}" data-unit="{{ $product->unit ?? 'MT' }}">
                                        <div class="sh-card-name">{{ $product->name }}</div>
                                    </a>
                                    <div class="sh-card-price">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle d-inline-flex align-items-center gap-1 py-1 px-2" style="font-size: 0.78rem; font-weight: 600;">
                                            <i class="bi bi-patch-check-fill"></i> Direct Export Lot
                                        </span>
                                        <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">SGS Assayed · FOB / CIF Maritime Export</small>
                                    </div>
                                    <div class="sh-card-rating">
                                        <span class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </span>
                                        <span class="count text-muted">({{ number_format($product->stock) }} {{ $product->unit == 'Metric Ton' ? 'MT' : 'units' }})</span>
                                    </div>
                                    <div class="d-flex gap-2 mt-auto pt-2">
                                        <button type="button" class="sh-card-cart-btn btn-add-cart" data-name="{{ $product->name }}" data-price="0" data-unit="{{ $product->unit ?? 'MT' }}" data-image="{{ asset($product->image ?: 'img/service-1.jpg') }}" data-origin="{{ $product->origin ?? 'Brazil' }}">
                                            <i class="bi bi-bag-plus"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Clean Fallbacks if DB has no items -->
                        <div class="col product-item" data-category="Grains & Rice">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <img src="{{ asset('img/service-1.jpg') }}" alt="Brazilian Non-GMO Soybeans" loading="lazy" decoding="async">
                                    <span class="sh-badge-sale">BULK</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">Mato Grosso · Grains &amp; Rice</div>
                                    <div class="sh-card-name">Brazilian Non-GMO Soybeans</div>
                                    <div class="sh-card-price">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle d-inline-flex align-items-center gap-1 py-1 px-2" style="font-size: 0.78rem; font-weight: 600;">
                                            <i class="bi bi-patch-check-fill"></i> Direct Export Lot
                                        </span>
                                        <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">SGS Assayed · FOB / CIF Maritime Export</small>
                                    </div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Brazilian Non-GMO Soybeans" data-price="0" data-unit="MT" data-image="{{ asset('img/service-1.jpg') }}" data-origin="Mato Grosso">
                                        <i class="bi bi-bag-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col product-item" data-category="Oil & Sugar">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <img src="{{ asset('img/service-2.jpg') }}" alt="Refined Cane Sugar ICUMSA 45" loading="lazy" decoding="async">
                                    <span class="sh-badge-sale">BULK</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">São Paulo · Oil &amp; Sugar</div>
                                    <div class="sh-card-name">Refined Cane Sugar (ICUMSA 45)</div>
                                    <div class="sh-card-price">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle d-inline-flex align-items-center gap-1 py-1 px-2" style="font-size: 0.78rem; font-weight: 600;">
                                            <i class="bi bi-patch-check-fill"></i> Direct Export Lot
                                        </span>
                                        <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">SGS Assayed · FOB / CIF Maritime Export</small>
                                    </div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Refined Cane Sugar (ICUMSA 45)" data-price="0" data-unit="MT" data-image="{{ asset('img/service-2.jpg') }}" data-origin="São Paulo">
                                        <i class="bi bi-bag-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col product-item" data-category="Grains & Rice">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <img src="{{ asset('img/service-3.jpg') }}" alt="Yellow Corn Maize Grade 2" loading="lazy" decoding="async">
                                    <span class="sh-badge-new">NEW</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">Goiás · Grains &amp; Rice</div>
                                    <div class="sh-card-name">Yellow Corn (Maize Grade 2)</div>
                                    <div class="sh-card-price">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle d-inline-flex align-items-center gap-1 py-1 px-2" style="font-size: 0.78rem; font-weight: 600;">
                                            <i class="bi bi-patch-check-fill"></i> Direct Export Lot
                                        </span>
                                        <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">SGS Assayed · FOB / CIF Maritime Export</small>
                                    </div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Yellow Corn (Maize Grade 2)" data-price="0" data-unit="MT" data-image="{{ asset('img/service-3.jpg') }}" data-origin="Goiás">
                                        <i class="bi bi-bag-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col product-item" data-category="Spices & Specialty">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <img src="{{ asset('img/service-5.jpg') }}" alt="Arabica Green Coffee Beans" loading="lazy" decoding="async">
                                    <span class="sh-badge-sale">EXPORT</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">Minas Gerais · Specialty</div>
                                    <div class="sh-card-name">Arabica Green Coffee Beans</div>
                                    <div class="sh-card-price">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle d-inline-flex align-items-center gap-1 py-1 px-2" style="font-size: 0.78rem; font-weight: 600;">
                                            <i class="bi bi-patch-check-fill"></i> Direct Export Lot
                                        </span>
                                        <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">SGS Assayed · FOB / CIF Maritime Export</small>
                                    </div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Arabica Green Coffee Beans" data-price="0" data-unit="MT" data-image="{{ asset('img/service-5.jpg') }}" data-origin="Minas Gerais">
                                        <i class="bi bi-bag-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- 6. CATEGORY CARDS & BASIN INSIGHTS -->
        <section class="py-5" id="insights" style="background: var(--sh-surface-alt); border-top: 1px solid var(--bs-border-color); border-bottom: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Agro Basins</div>
                        <h2 class="sh-title mb-0">Harvest Categories</h2>
                    </div>
                </div>
                <div class="row g-3 g-md-4">
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card" onclick="$('.agro-filter-btn[data-filter=\'Grains & Rice\']').click();">
                            <picture>
                                <source srcset="{{ asset('img/white-rice.webp') }}" type="image/webp">
                                <img src="{{ asset('img/white-rice.jpg') }}" alt="Grains & Rice" loading="lazy" decoding="async">
                            </picture>
                            <div class="label">
                                <h5>Grains &amp; Rice</h5>
                                <span>Soybeans, Rice &amp; Yellow Corn</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card" onclick="$('.agro-filter-btn[data-filter=\'Oil & Sugar\']').click();">
                            <picture>
                                <source srcset="{{ asset('img/sunflower-oil.webp') }}" type="image/webp">
                                <img src="{{ asset('img/sunflower-oil.jpg') }}" alt="Cooking Oils & Sugar" loading="lazy" decoding="async">
                            </picture>
                            <div class="label">
                                <h5>Cooking Oils &amp; Sugar</h5>
                                <span>Sunflower, Corn, Palm &amp; ICUMSA 45</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card" onclick="$('.agro-filter-btn[data-filter=\'Poultry & Meat\']').click();">
                            <picture>
                                <source srcset="{{ asset('img/chicken-meat.webp') }}" type="image/webp">
                                <img src="{{ asset('img/chicken-meat.jpg') }}" alt="Poultry & Chicken" loading="lazy" decoding="async">
                            </picture>
                            <div class="label">
                                <h5>Poultry &amp; Halal Meat</h5>
                                <span>Paraná Processing SIF</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card" onclick="$('.agro-filter-btn[data-filter=\'Meat & Seafood\']').click();">
                            <picture>
                                <source srcset="{{ asset('img/beef-meat.webp') }}" type="image/webp">
                                <img src="{{ asset('img/beef-meat.jpg') }}" alt="Beef & Seafood" loading="lazy" decoding="async">
                            </picture>
                            <div class="label">
                                <h5>Beef &amp; Seafood</h5>
                                <span>Mato Grosso &amp; Atlantic</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card" onclick="$('.agro-filter-btn[data-filter=\'Nuts & Seeds\']').click();">
                            <picture>
                                <source srcset="{{ asset('img/almonds-nuts.webp') }}" type="image/webp">
                                <img src="{{ asset('img/almonds-nuts.jpg') }}" alt="Almonds, Cashews & Brazil Nuts" loading="lazy" decoding="async">
                            </picture>
                            <div class="label">
                                <h5>Nuts &amp; Kernels</h5>
                                <span>Almonds, Brazil Nuts &amp; Cashews</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card" onclick="$('.agro-filter-btn[data-filter=\'Lentils & Pulses\']').click();">
                            <picture>
                                <source srcset="{{ asset('img/green-mung-beans.webp') }}" type="image/webp">
                                <img src="{{ asset('img/green-mung-beans.jpg') }}" alt="Green Mung Beans & Pulses" loading="lazy" decoding="async">
                            </picture>
                            <div class="label">
                                <h5>Lentils &amp; Pulses</h5>
                                <span>Green Mung, Black Beans &amp; Pulses</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card" onclick="$('.agro-filter-btn[data-filter=\'Spices & Specialty\']').click();">
                            <picture>
                                <source srcset="{{ asset('img/cardamom.webp') }}" type="image/webp">
                                <img src="{{ asset('img/cardamom.jpg') }}" alt="Cardamom, Coffee & Spices" loading="lazy" decoding="async">
                            </picture>
                            <div class="label">
                                <h5>Spices &amp; Coffee</h5>
                                <span>Cardamom, Arabica Beans &amp; Pepper</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card" onclick="$('.agro-filter-btn[data-filter=\'Dairy Products\']').click();">
                            <picture>
                                <source srcset="{{ asset('img/milk-powder.webp') }}" type="image/webp">
                                <img src="{{ asset('img/milk-powder.jpg') }}" alt="Dairy Products" loading="lazy" decoding="async">
                            </picture>
                            <div class="label">
                                <h5>Dairy &amp; Milk Powder</h5>
                                <span>26-28% Full Cream 25kg</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 7. PROMO BANNER (Exact fume-main layout with Arovia color) -->
        <section class="py-5">
            <div class="container py-3">
                <div class="sh-promo p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h3 class="mb-2">Bulk Commercial Agro Allocations — FOB &amp; CIF Terms</h3>
                            <p class="mb-0">Trade directly with accredited Brazilian farm cooperatives. All shipments are backed by MAPA phytosanitary clearance and certified pre-loading SGS assays.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                            <a href="#rfq-desk" class="btn btn-light btn-lg fw-bold text-dark">Request Trade RFQ</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 8. PROCESS: 4-Step Bulk Fulfillment Architecture -->
        <section class="py-5" id="process" style="background: var(--sh-surface-alt); border-top: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Institutional Workflow</div>
                        <h2 class="sh-title mb-0">End-to-End Trade Fulfillment Process</h2>
                    </div>
                    <span class="badge bg-success px-3 py-2 fs-6">SGS &amp; MAPA Certified</span>
                </div>
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="p-4 rounded-3 h-100 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 fw-bold" style="width: 42px; height: 42px; background: rgba(120, 162, 47, 0.16); color: var(--sh-primary);">01</div>
                            <h5 class="fw-bold sh-text-title mb-2">Basin Sourcing</h5>
                            <p class="small sh-text-muted mb-0">Contract allocations secured directly from certified agricultural cooperatives across Mato Grosso, Paraná, and São Paulo.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-4 rounded-3 h-100 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 fw-bold" style="width: 42px; height: 42px; background: rgba(120, 162, 47, 0.16); color: var(--sh-primary);">02</div>
                            <h5 class="fw-bold sh-text-title mb-2">SGS Lab Assays</h5>
                            <p class="small sh-text-muted mb-0">Independent pre-shipment sampling for moisture, protein, foreign matter, and MAPA phytosanitary compliance.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-4 rounded-3 h-100 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 fw-bold" style="width: 42px; height: 42px; background: rgba(120, 162, 47, 0.16); color: var(--sh-primary);">03</div>
                            <h5 class="fw-bold sh-text-title mb-2">Incoterms Delivery</h5>
                            <p class="small sh-text-muted mb-0">Flexible shipment execution under FOB Santos / Paranaguá or CIF Destination Port based on international standards.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-4 rounded-3 h-100 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 fw-bold" style="width: 42px; height: 42px; background: rgba(120, 162, 47, 0.16); color: var(--sh-primary);">04</div>
                            <h5 class="fw-bold sh-text-title mb-2">Port Vessel Dispatch</h5>
                            <p class="small sh-text-muted mb-0">Terminal berth coordination at Port of Santos and Paranaguá with live vessel telemetry until discharge.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 9. BLOG / TRADE INSIGHTS -->
        <section class="py-5" id="blog" style="background: var(--bs-body-bg); border-top: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Trade Digest</div>
                        <h2 class="sh-title mb-0">Market Reports &amp; Commodity Insights</h2>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="p-4 rounded-3 h-100 d-flex flex-column sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <span class="badge bg-secondary align-self-start mb-2">Crop Outlook</span>
                            <h5 class="fw-bold sh-text-title mb-2">2026/27 Brazilian Soybean Crop Forecast</h5>
                            <p class="small sh-text-muted mb-3 flex-grow-1">Mato Grosso record yields and favorable moisture levels drive high export availability for early vessel bookings.</p>
                            <a href="#rfq-desk" class="text-success small fw-semibold text-decoration-none">Inquire Basin Availability <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 rounded-3 h-100 d-flex flex-column sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <span class="badge bg-secondary align-self-start mb-2">Trade Guide</span>
                            <h5 class="fw-bold sh-text-title mb-2">IncoTerms 2020: CIF vs FOB Port Risk</h5>
                            <p class="small sh-text-muted mb-3 flex-grow-1">Analyzing demurrage responsibility, marine insurance clauses, and title handover protocols for bulk buyers.</p>
                            <a href="#rfq-desk" class="text-success small fw-semibold text-decoration-none">Inquire Terms Guide <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 rounded-3 h-100 d-flex flex-column sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <span class="badge bg-secondary align-self-start mb-2">Logistics</span>
                            <h5 class="fw-bold sh-text-title mb-2">Raw Sugar (ICUMSA 45) Port Allocations</h5>
                            <p class="small sh-text-muted mb-3 flex-grow-1">Santos terminal conveyor upgrade schedule and containerized pallet shipment lead times for Middle East ports.</p>
                            <a href="#rfq-desk" class="text-success small fw-semibold text-decoration-none">Inquire Port Schedules <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 10. ABOUT US SECTION -->
        <section class="py-5" id="about" style="background: var(--sh-surface-alt); border-top: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="sh-eyebrow">Privately Owned Enterprise · Global Trade</div>
                        <h2 class="sh-title mb-3">Supplying Thousands of Metric Tons Across 5 Continents</h2>
                        <p class="sh-text-muted mb-3">
                            <strong>BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA</strong> is a premier privately owned agribusiness enterprise operating globally. We supply thousands of metric tons annually to hundreds of customers worldwide, partnering with leading food manufacturers, retailers, wholesalers, and institutional buyers across 5 continents.
                        </p>
                        <p class="sh-text-muted mb-3">
                            Our comprehensive supply chain management handles every step: from origin due diligence and harvest basin procurement across Mato Grosso, São Paulo, Paraná, Goiás, Ceará, and Rio Grande do Sul, through certified laboratory testing (MAPA, SIF, Halal, and SGS pre-shipment inspection), custom packaging (25kg, 50kg, bulk container liners, vacuum bags, and -18°C refrigerated containers), to deepwater maritime logistics.
                        </p>
                        <p class="sh-text-muted mb-4 small">
                            <i class="bi bi-geo-alt-fill text-success me-1"></i> Headquarters: <strong>Av. Brig. Faria Lima, 3064 – Itaim Bibi, São Paulo – SP, 01451-001 Brazil.</strong>
                        </p>
                        <div class="d-flex gap-4 flex-wrap">
                            <div>
                                <h3 class="fw-bold mb-0" style="color: var(--sh-primary) !important;">5 Continents</h3>
                                <small class="sh-text-muted">Global Distribution</small>
                            </div>
                            <div class="border-start border-secondary ps-4">
                                <h3 class="fw-bold mb-0" style="color: var(--sh-primary) !important;">Thousands MT</h3>
                                <small class="sh-text-muted">Annual Bulk Volume</small>
                            </div>
                            <div class="border-start border-secondary ps-4">
                                <h3 class="fw-bold mb-0" style="color: var(--sh-primary) !important;">100% SGS</h3>
                                <small class="sh-text-muted">Pre-Shipment Tested</small>
                            </div>
                            <div class="border-start border-secondary ps-4">
                                <h3 class="fw-bold mb-0" style="color: var(--sh-primary) !important;">10 Sectors</h3>
                                <small class="sh-text-muted">Export Commodity Lines</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="p-2 rounded-4 sh-card-bg shadow-sm" style="border: 1px solid var(--bs-border-color);">
                                    <picture>
                                        <source srcset="{{ asset('img/about-pic.webp') }}" type="image/webp">
                                        <img src="{{ asset('img/about-pic.jpg') }}" alt="About BRX Agro Global Trade Operations" class="img-fluid rounded-3 w-100 object-fit-cover" style="max-height: 270px;" loading="lazy" decoding="async">
                                    </picture>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-2 rounded-4 sh-card-bg shadow-sm" style="border: 1px solid var(--bs-border-color);">
                                    <picture>
                                        <source srcset="{{ asset('img/company-pic.webp') }}" type="image/webp">
                                        <img src="{{ asset('img/company-pic.jpg') }}" alt="BRX Agro Global Corporate Logistics" class="img-fluid rounded-3 w-100 object-fit-cover" style="max-height: 160px;" loading="lazy" decoding="async">
                                    </picture>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-2 rounded-4 sh-card-bg shadow-sm" style="border: 1px solid var(--bs-border-color);">
                                    <picture>
                                        <source srcset="{{ asset('img/banner-warehouse.webp') }}" type="image/webp">
                                        <img src="{{ asset('img/banner-warehouse.jpg') }}" alt="Export Packaging & Cold-Chain Fleet" class="img-fluid rounded-3 w-100 object-fit-cover" style="max-height: 160px;" loading="lazy" decoding="async">
                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 11. DIRECT TRADE DESK & RFQ INQUIRIES (CONTACT) -->
        <div id="contact"></div>
        <section class="py-5" id="rfq-desk" style="background: var(--bs-body-bg); border-top: 1px solid var(--bs-border-color); border-bottom: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="row g-5 align-items-start">
                    <div class="col-lg-5">
                        <div class="sh-eyebrow">Trade Desk &amp; Sourcing</div>
                        <h2 class="sh-title mb-3">Institutional RFQ Inquiries</h2>
                        <p class="sh-text-muted mb-4">Connect directly with our Brazilian commodity export team. Request indicative FOB/CIF quotes, technical SGS assay sheets, customized packaging, or spot vessel allocations.</p>

                        <div class="p-4 rounded-3 mb-4 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <i class="bi bi-geo-alt fs-4 text-success" style="color: var(--sh-primary) !important; flex-shrink: 0; margin-top: 2px;"></i>
                                <div>
                                    <strong class="d-block sh-text-title">Trading Headquarters</strong>
                                    <small class="sh-text-muted">Av. Brig. Faria Lima, 3064 – Itaim Bibi, São Paulo – SP, 01451-001 Brazil</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="bi bi-whatsapp fs-4 text-success" style="flex-shrink: 0;"></i>
                                <div>
                                    <strong class="d-block sh-text-title">Direct WhatsApp &amp; Phone Desk</strong>
                                    <a href="https://wa.me/5511958353433" target="_blank" rel="noopener" class="text-success text-decoration-none fw-bold small">+55 11 95835-3433</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="bi bi-chat-dots fs-4 text-success" style="color: var(--sh-primary) !important; flex-shrink: 0;"></i>
                                <div>
                                    <strong class="d-block sh-text-title">WeChat Corporate ID</strong>
                                    <span class="small fw-semibold text-secondary">BRX AGRO GLOBAL</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <i class="bi bi-envelope-at-fill fs-4 text-primary" style="flex-shrink: 0; margin-top: 2px;"></i>
                                <div>
                                    <strong class="d-block sh-text-title">Official Corporate Email (Tap to Compose)</strong>
                                    <small class="sh-text-muted d-block mb-1">
                                        <a href="mailto:brxagroglobal@gmail.com?subject=Commodity%20RFQ%20Inquiry%20%E2%80%94%20BRX%20Agro%20Global&body=Hello%20Trade%20Desk%2C%0A%0AI%20would%20like%20to%20request%20an%20indicative%20FOB%2FCIF%20quotation%20and%20SGS%20lab%20analysis%20for%3A%0A-%20Commodity%3A%20%0A-%20Volume%20(MT)%3A%20%0A-%20Discharge%20Port%3A%20%0A%0ACompany%3A%20%0AName%3A%20" class="text-decoration-none fw-semibold text-primary"><i class="bi bi-envelope-open me-1"></i>brxagroglobal@gmail.com</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="p-4 p-md-5 rounded-4 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <h4 class="fw-bold sh-text-title mb-2">Request Trade Quote (RFQ)</h4>
                            <p class="sh-text-muted small mb-4">Complete the form below to receive formal indicative pricing, SGS specifications, packaging options, and vessel allocation schedule.</p>

                            <div id="rfqAlert" class="alert d-none mb-3"></div>

                            <form id="rfqInquiryForm">
                                <input type="hidden" name="role" value="buyer">
                                <div aria-hidden="true" style="position: absolute; left: -9999px; top: -9999px; width: 1px; height: 1px; overflow: hidden; opacity: 0; pointer-events: none;">
                                    <label for="rfq_company_website_url">Company Website URL</label>
                                    <input type="text" id="rfq_company_website_url" name="company_website_url" value="" tabindex="-1" autocomplete="off">
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Target Commodity *</label>
                                        <select name="buyer_detail" class="form-select sh-input" required>
                                            <option value="Brazilian Non-GMO Soybeans">Brazilian Non-GMO Soybeans</option>
                                            <option value="Refined Cane Sugar (ICUMSA 45)">Refined Cane Sugar (ICUMSA 45)</option>
                                            <option value="Yellow Corn (Maize Grade 2)">Yellow Corn (Maize Grade 2)</option>
                                            <option value="Brazilian Long Grain White Rice">Brazilian Long Grain White Rice</option>
                                            <option value="Refined Sunflower Oil (Grade A)">Refined Sunflower Oil (Grade A)</option>
                                            <option value="Refined Corn Oil (Pure Maize)">Refined Corn Oil (Pure Maize)</option>
                                            <option value="Refined Palm Olein Oil (CP8/CP10)">Refined Palm Olein Oil (CP8/CP10)</option>
                                            <option value="Pure Refined Soybean Oil (Food Grade)">Pure Refined Soybean Oil (Food Grade)</option>
                                            <option value="Crude Degummed Soybean Oil">Crude Degummed Soybean Oil</option>
                                            <option value="Premium Green Cardamom Pods">Premium Green Cardamom Pods</option>
                                            <option value="Arabica Green Coffee Beans (NY 2/3)">Arabica Green Coffee Beans (NY 2/3)</option>
                                            <option value="Brazilian Whole Green Mung Beans">Brazilian Whole Green Mung Beans</option>
                                            <option value="Premium Raw Shelled Almonds">Premium Raw Shelled Almonds</option>
                                            <option value="Premium Brazilian Cashew Kernels (W-240 / W-320)">Premium Brazilian Cashew Kernels (W-240 / W-320)</option>
                                            <option value="Whole Brazil Nuts (Bertholletia excelsa)">Whole Brazil Nuts (Bertholletia excelsa)</option>
                                            <option value="Brazilian Premium Black Beans (Feijão Preto)">Brazilian Premium Black Beans (Feijão Preto)</option>
                                            <option value="Red Split Lentils (Sortex Cleaned)">Red Split Lentils (Sortex Cleaned)</option>
                                            <option value="Whole Frozen Brazilian Chicken (Grade A)">Whole Frozen Brazilian Chicken (Grade A)</option>
                                            <option value="Frozen Boneless Beef Cuts (SIF/Halal)">Frozen Boneless Beef Cuts (SIF/Halal)</option>
                                            <option value="Frozen Lamb & Mutton Carcasses">Frozen Lamb &amp; Mutton Carcasses</option>
                                            <option value="Atlantic Frozen Seafood & Sea Fish">Atlantic Frozen Seafood &amp; Sea Fish</option>
                                            <option value="Brazilian Whole Black Pepper (ASTA 550g/l)">Brazilian Whole Black Pepper (ASTA 550g/l)</option>
                                            <option value="Sun-Dried Whole Red Chillies">Sun-Dried Whole Red Chillies</option>
                                            <option value="Whole Dried Turmeric Finger & Spices">Whole Dried Turmeric Finger &amp; Spices</option>
                                            <option value="Instant Full Cream Milk Powder">Instant Full Cream Milk Powder</option>
                                            <option value="Fresh Brazilian Export Mangoes & Fruits">Fresh Brazilian Export Mangoes &amp; Fruits</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Volume Required (Metric Tons) *</label>
                                        <input type="text" name="volume" class="form-control sh-input" placeholder="e.g. 500 MT / 2,500 MT / 1 FCL" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Full Name *</label>
                                        <input type="text" name="name" class="form-control sh-input" placeholder="First and last name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Corporate Email *</label>
                                        <input type="email" name="email" class="form-control sh-input" placeholder="importer@company.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Company Name *</label>
                                        <input type="text" name="company" class="form-control sh-input" placeholder="Trading company name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Discharge Port / Country *</label>
                                        <input type="text" name="country" class="form-control sh-input" placeholder="e.g. Port of Rotterdam / Jebel Ali" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Contract Message, Packaging &amp; Instructions</label>
                                        <textarea name="message" class="form-control sh-input" rows="3" placeholder="Specify packaging (25kg/50kg bags, vacuum tins, bulk container liner, reefer) or quality parameters..."></textarea>
                                    </div>
                                    <div class="col-12 pt-2">
                                        <button type="submit" id="rfqSubmitBtn" class="btn btn-sh-primary w-100 py-3 text-white fw-bold">
                                            <i class="bi bi-send me-2"></i> Submit RFQ to Trade Desk
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 12. TESTIMONIALS SECTION (Exact fume-main layout) -->
        <section class="py-5" style="background: var(--bs-body-bg);">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Client Feedback</div>
                        <h2 class="sh-title mb-0">What Our Importers Say</h2>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="sh-testimonial">
                            <div class="sh-stars mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic sh-text-muted mb-3">"Securing 12,500 MT of Brazilian Non-GMO Soybeans through Santos was handled with absolute professionalism. The pre-shipment SGS assay matched our exact feed parameters."</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/testimonial-1.jpg') }}" alt="Pieter van der Berg" class="rounded-circle me-3 object-fit-cover" width="46" height="46" loading="lazy" decoding="async">
                                <div>
                                    <h6 class="mb-0 sh-text-title fw-bold">Pieter van der Berg</h6>
                                    <small class="sh-text-muted">Procurement · Rotterdam, Netherlands</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sh-testimonial">
                            <div class="sh-stars mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic sh-text-muted mb-3">"The ICUMSA 45 refined sugar arrived on time with complete phytosanitary certificates and zero broken bags. BRX Agro Global's direct desk communicated vessel telemetry daily."</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/testimonial-2.jpg') }}" alt="Tariq Al-Mansoor" class="rounded-circle me-3 object-fit-cover" width="46" height="46" loading="lazy" decoding="async">
                                <div>
                                    <h6 class="mb-0 sh-text-title fw-bold">Tariq Al-Mansoor</h6>
                                    <small class="sh-text-muted">VP Supply Chain · Jebel Ali, Dubai</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sh-testimonial">
                            <div class="sh-stars mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic sh-text-muted mb-3">"Direct co-op pricing eliminated the broker markup we usually pay on yellow maize. Clean title handover at the discharge port made customs processing effortless."</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/testimonial-3.jpg') }}" alt="Wei Chen" class="rounded-circle me-3 object-fit-cover" width="46" height="46" loading="lazy" decoding="async">
                                <div>
                                    <h6 class="mb-0 sh-text-title fw-bold">Wei Chen</h6>
                                    <small class="sh-text-muted">Agro Commodity Trader · Qingdao, China</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 13. FAQ SECTION -->
        <section class="py-5" id="faq" style="background: var(--sh-surface-alt); border-top: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Knowledge Base</div>
                        <h2 class="sh-title mb-0">Frequently Asked Questions</h2>
                    </div>
                </div>
                <div class="accordion sh-accordion" id="agroFaqAccordion">
                    <div class="accordion-item mb-3 rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="faqH1">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC1">
                                How are commodity prices and delivery terms determined?
                            </button>
                        </h2>
                        <div id="faqC1" class="accordion-collapse collapse" data-bs-parent="#agroFaqAccordion">
                            <div class="accordion-body small">
                                Commodity quotations are calculated dynamically based on your destination discharge port, shipment volume (MT), and preferred Incoterm (FOB Brazilian berth or CIF discharge port). Physical assays and SGS quality certificates are verified prior to vessel departure.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3 rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="faqH2">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC2">
                                What quality assurance certificates accompany shipments?
                            </button>
                        </h2>
                        <div id="faqC2" class="accordion-collapse collapse" data-bs-parent="#agroFaqAccordion">
                            <div class="accordion-body small">
                                Every batch is accompanied by an independent SGS Laboratory Assay, MAPA (Brazilian Ministry of Agriculture) Phytosanitary Certificate, Certificate of Origin, and Fumigation Certificate.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3 rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="faqH3">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC3">
                                What is the minimum order quantity (MOQ) for bulk shipments?
                            </button>
                        </h2>
                        <div id="faqC3" class="accordion-collapse collapse" data-bs-parent="#agroFaqAccordion">
                            <div class="accordion-body small">
                                Standard containerized shipments start at 200 to 500 Metric Tons. For Panamax / Supramax breakbulk vessel allocations, spot contracts typically start at 12,500 Metric Tons.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="faqH4">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC4">
                                Which discharge ports are supported under CIF contracts?
                            </button>
                        </h2>
                        <div id="faqC4" class="accordion-collapse collapse" data-bs-parent="#agroFaqAccordion">
                            <div class="accordion-body small">
                                We regularly execute CIF charters to major deepwater ports including Rotterdam, Antwerp, Jebel Ali, Qingdao, Shanghai, Dammam, and Alexandria.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- 10. FOOTER (Horizontal Layout Across All Elements) -->
    <footer class="sh-footer pt-5 pb-4">
        <div class="container-fluid px-3 px-md-5" style="max-width: 1440px;">
            <div class="sh-footer-horizontal-wrap mb-4">
                <!-- Col 1: Brand & Mission -->
                <div class="sh-footer-col-brand">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <img src="{{ asset('img/brx-emblem-nav.png') }}" alt="BRX AGRO GLOBAL" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover; border: 2px solid var(--sh-primary); flex-shrink: 0;" width="44" height="44" loading="lazy">
                        <div>
                            <div class="fw-bold text-white fs-6" style="letter-spacing: 0.5px; line-height: 1.1;">BRX <span style="color: var(--sh-primary);">AGRO GLOBAL</span></div>
                            <small class="text-white-50 d-block" style="font-size: 0.52rem; letter-spacing: 1.2px; text-transform: uppercase;">Importação e Exportação Ltda</small>
                        </div>
                    </div>
                    <div class="small text-success fw-semibold mb-2" style="font-size: 0.72rem; letter-spacing: 0.5px;">CNPJ: 38.471.480/0001-41</div>
                    <p class="small text-white-50 mb-3" style="line-height: 1.6;">
                        Privately owned enterprise supplying thousands of metric tons annually across 5 continents in direct partnership with leading food manufacturers, retailers, and wholesalers.
                    </p>
                    <div class="d-flex align-items-center gap-2 mt-3">
                        <a href="https://wa.me/5511958353433" target="_blank" rel="noopener" class="social-icon" title="WhatsApp Trade Desk (+55 11 95835-3433)"><i class="bi bi-whatsapp"></i></a>
                        <a href="javascript:void(0)" onclick="openTradeDeskInbox()" class="social-icon" title="Open Desk Inbox"><i class="bi bi-chat-left-dots-fill"></i></a>
                        <a href="mailto:brxagroglobal@gmail.com?subject=Commercial%20Trade%20Inquiry%20%E2%80%94%20BRX%20Agro%20Global&body=Hello%20Trade%20Desk%2C%0A%0APlease%20provide%20quotation%20and%20specifications%20for%20Brazilian%20agro%20export%20commodities." class="social-icon" title="Compose Email on Your Device"><i class="bi bi-envelope-fill"></i></a>
                        <a href="#rfq-desk" class="social-icon" title="Trade RFQ"><i class="bi bi-file-earmark-text"></i></a>
                    </div>
                </div>

                <!-- Col 2: Shop -->
                <div class="sh-footer-col">
                    <h6>Shop</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><a href="#products">Soybeans &amp; Yellow Corn</a></li>
                        <li class="mb-2"><a href="#products">Cane Sugar ICUMSA 45</a></li>
                        <li class="mb-2"><a href="#products">Poultry, Beef &amp; Meats</a></li>
                        <li class="mb-2"><a href="#products">Brazilian Cashews &amp; Nuts</a></li>
                        <li class="mb-2"><a href="#products">Pulses &amp; Red Lentils</a></li>
                        <li class="mb-2"><a href="#products">Spices, Seasonings &amp; Dairy</a></li>
                    </ul>
                </div>

                <!-- Col 3: Company -->
                <div class="sh-footer-col">
                    <h6>Company</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><a href="#about">About BRX Agro Global</a></li>
                        <li class="mb-2"><a href="#rfq-desk">Brazilian Trade Desk</a></li>
                        <li class="mb-2"><a href="#insights">Agro Basins</a></li>
                        <li class="mb-2"><a href="#rfq-desk">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Col 4: Account -->
                <div class="sh-footer-col">
                    <h6>Account</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><a href="{{ route('login') }}">Client Login</a></li>
                        <li class="mb-2"><a href="{{ route('register') }}">Register Account</a></li>
                        @auth
                            <li class="mb-2"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#agroviaAccountModal">My Account Portal</a></li>
                            @if(auth()->user()->isAdmin())
                                <li class="mb-2"><a href="{{ route('admin.dashboard') }}" class="text-warning fw-semibold"><i class="bi bi-speedometer2 me-1"></i>Admin Dashboard</a></li>
                                <li class="mb-2"><a href="{{ route('admin.orders.index') }}">Manage Orders</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>

                <!-- Col 5: Legal & Privacy -->
                <div class="sh-footer-col">
                    <h6>Legal &amp; Privacy</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><a href="javascript:void(0)" onclick="BRXCookieManager.openPreferences()"><i class="bi bi-sliders me-1 text-success"></i>Cookie Settings</a></li>
                        <li class="mb-2"><a href="javascript:void(0)" onclick="BRXCookieManager.openPolicy()"><i class="bi bi-shield-check me-1 text-success"></i>Cookie &amp; Data Policy</a></li>
                        <li class="mb-2"><a href="javascript:void(0)">Phytosanitary Terms (MAPA)</a></li>
                        <li class="mb-2"><a href="javascript:void(0)">Incoterms 2020 Guide</a></li>
                        <li class="mb-2"><a href="javascript:void(0)">SGS Lab Assay Standards</a></li>
                    </ul>
                </div>

                <!-- Col 6: Contact -->
                <div class="sh-footer-col sh-footer-col-contact">
                    <h6>Contact</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2 d-flex align-items-start gap-2">
                            <i class="bi bi-geo-alt me-1 text-success" style="color: var(--sh-primary) !important; flex-shrink: 0; margin-top: 3px;"></i>
                            <span>Av. Brig. Faria Lima, 3064 – Itaim Bibi, São Paulo – SP, 01451-001 Brazil</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <i class="bi bi-whatsapp me-1 text-success" style="flex-shrink: 0;"></i>
                            <a href="https://wa.me/5511958353433" target="_blank" rel="noopener" class="text-success text-decoration-none fw-bold">+55 11 95835-3433 (WhatsApp)</a>
                        </li>
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <i class="bi bi-inbox-fill me-1 text-success" style="flex-shrink: 0;"></i>
                            <a href="javascript:void(0)" onclick="openTradeDeskInbox()" class="text-success text-decoration-none fw-bold">Trade Desk Inbox</a>
                        </li>
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <i class="bi bi-chat-dots me-1 text-success" style="color: var(--sh-primary) !important; flex-shrink: 0;"></i>
                            <span class="text-white-50">WeChat: <strong class="text-white">BRX AGRO GLOBAL</strong></span>
                        </li>
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <i class="bi bi-envelope-at me-1 text-success" style="color: var(--sh-primary) !important; flex-shrink: 0;"></i>
                            <a href="mailto:brxagroglobal@gmail.com?subject=Commercial%20Trade%20Inquiry%20%E2%80%94%20BRX%20Agro%20Global&body=Hello%20BRX%20Agro%20Global%20Trade%20Desk%2C%0A%0AI%20would%20like%20to%20request%20quotations%20for%20Brazilian%20agro%20export%20commodities." class="text-decoration-none text-white-50" title="Click to compose immediately on your device">brxagroglobal@gmail.com (Compose)</a>
                        </li>
                        <li class="mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-clock me-1 text-success" style="color: var(--sh-primary) !important; flex-shrink: 0;"></i>
                            <span>Mon - Fri: 08:00 - 18:00 BRT</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="sh-footer-bottom mt-4 pt-4 text-center small text-white-50 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <div>
                    &copy; {{ date('Y') }} BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA. CNPJ: 38.471.480/0001-41. All rights reserved.
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap justify-content-center">
                    <a href="javascript:void(0)" onclick="BRXCookieManager.openPolicy()" class="text-white-50 text-decoration-none"><i class="bi bi-shield-lock me-1"></i>Privacy &amp; Cookies</a>
                    <span class="text-white-50">&bull;</span>
                    <a href="javascript:void(0)" onclick="BRXCookieManager.openPreferences()" class="text-white-50 text-decoration-none"><i class="bi bi-sliders me-1"></i>Cookie Preferences</a>
                    <span class="text-white-50">&bull;</span>
                    <span><i class="bi bi-shield-check text-success me-1"></i> MAPA &amp; SGS Verified</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- 11. MOBILE BOTTOM TAB BAR (Exact fume-main sh-tabbar layout) -->
    <nav class="sh-tabbar" aria-label="Mobile navigation">
        <a href="{{ route('home') }}" class="active">
            <i class="bi bi-house-fill"></i>
            <span>Home</span>
        </a>
        <a href="#products">
            <i class="bi bi-bag"></i>
            <span>Shop</span>
        </a>
        <a href="#rfq-desk">
            <i class="bi bi-file-earmark-text"></i>
            <span>RFQ</span>
        </a>
        <a href="javascript:void(0)" class="mobile-cart-trigger position-relative">
            <i class="bi bi-cart3"></i>
            <span>Cart</span>
            <span class="sh-tabbar-badge mobileCartBadge">0</span>
        </a>
        @auth
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#agroviaAccountModal" aria-label="Account Portal">
                <i class="bi bi-person-fill"></i>
                <span>Account</span>
            </a>
        @else
            <a href="{{ route('login') }}" aria-label="Sign In">
                <i class="bi bi-person"></i>
                <span>Login</span>
            </a>
        @endauth
    </nav>

    <!-- 12. CART TOAST NOTIFICATION (Exact fume-main architecture) -->
    <div id="sh-toast" class="sh-toast">
        <div class="sh-toast-icon"><i class="bi bi-check-circle-fill"></i></div>
        <div class="sh-toast-body">
            <div class="sh-toast-message fw-bold small" id="shToastMsg">Item added to cart!</div>
            <div class="sh-toast-count small text-white-50" id="shToastCount">1 item(s) in cart</div>
        </div>
    </div>

    <!-- 13. SCROLL TO TOP BUTTON (Exact fume-main architecture) -->
    <button id="sh-scroll-top" class="sh-scroll-top" aria-label="Scroll to top">
        <i class="bi bi-chevron-up"></i>
    </button>

    <!-- Modals & Drawers -->

    <!-- Agrovia Cart Drawer Backdrop & Offcanvas -->
    <div id="agroviaCartBackdrop" class="sh-cart-backdrop" onclick="closeCartDrawer()"></div>

    <div id="agroviaCartDrawer" class="sh-cart-offcanvas" role="dialog" aria-modal="true" aria-labelledby="cartDrawerTitle">
        <!-- Drawer Header -->
        <div class="offcanvas-header">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: rgba(120, 162, 47, 0.15); color: var(--sh-primary); font-size: 1.15rem;">
                    <i class="bi bi-cart3"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold sh-text-title d-flex align-items-center gap-2" id="cartDrawerTitle" style="font-size: 1.05rem;">
                        Agro-Commodity Cart
                        <span class="badge rounded-pill" id="cartDrawerCountBadge" style="background: var(--sh-primary); font-size: 0.7rem; font-weight: 700;">0 lots</span>
                    </h5>
                    <small class="text-muted" style="font-size: 0.75rem;">Brazilian Origination &amp; Sample Desk</small>
                </div>
            </div>
            <button type="button" class="btn btn-sm text-secondary p-1" onclick="closeCartDrawer()" aria-label="Close cart" style="font-size: 1.25rem; line-height: 1;">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Drawer Body -->
        <div class="offcanvas-body">
            <!-- Empty State -->
            <div id="cartEmptyState" class="text-center py-5 my-auto d-none">
                <div class="mb-3 text-muted opacity-50" style="font-size: 3.5rem;">
                    <i class="bi bi-basket3"></i>
                </div>
                <h5 class="fw-bold sh-text-title mb-2">Your Commodity Cart is Empty</h5>
                <p class="text-muted small mb-4 px-3">
                    You have not added any commodity lots yet. Browse our harvest catalog to select export lots for direct shipment or physical assay samples.
                </p>
                <a href="#products" class="btn btn-sh-primary btn-sm px-4 py-2" onclick="closeCartDrawer()">
                    <i class="bi bi-grid-3x3-gap me-1"></i> Browse Commodities
                </a>
            </div>

            <!-- Populated Cart Content -->
            <div id="cartPopulatedContent" class="d-flex flex-column flex-grow-1">
                <!-- Cart Items List -->
                <div id="cartItemsList" class="sh-cart-items-container">
                    <!-- Items rendered dynamically by JS -->
                </div>

                <!-- Quality & Settlement Assurance Card -->
                <div class="sh-cart-assurance-card mb-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <i class="bi bi-shield-check" style="color: var(--sh-primary); font-size: 1.1rem;"></i>
                        <strong class="sh-text-title">SGS Assayed &amp; MAPA Phyto Cleared</strong>
                    </div>
                    <div class="text-muted" style="font-size: 0.78rem; line-height: 1.4;">
                        Every lot includes physical assay verification, non-GMO certificates, and export clearance through Brazilian ports under international Incoterms 2020 standards.
                    </div>
                </div>

                <!-- Cart Summary Box -->
                <div class="sh-cart-summary-box mt-auto">
                    <div class="d-flex justify-content-between align-items-center mb-2 small">
                        <span class="text-muted">Total Sample Lots:</span>
                        <strong class="sh-text-title" id="cartSummaryLotCount">0</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2 small">
                        <span class="text-muted">Loading Ports:</span>
                        <span class="fw-semibold sh-text-title">Santos &amp; Paranaguá (BR)</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2 small">
                        <span class="text-muted">Origin &amp; Assays:</span>
                        <span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i>SGS &amp; MAPA Phyto Certified</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3 small">
                        <span class="text-muted">Commercial Terms:</span>
                        <span class="fw-semibold text-secondary">Direct Wholesale IncoTerms</span>
                    </div>
                    <hr class="my-2 border-secondary border-opacity-25">

                    <!-- Action Buttons -->
                    <button type="button" id="btnOpenCheckout" class="btn btn-sh-primary w-100 py-2.5 fw-bold d-flex align-items-center justify-content-center gap-2" style="font-size: 0.95rem;">
                        <i class="bi bi-send-check-fill"></i> Review &amp; Dispatch Order
                    </button>

                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-secondary border-opacity-25">
                        <button type="button" onclick="clearCart()" class="btn btn-link text-danger text-decoration-none p-0 small" style="font-size: 0.8rem;">
                            <i class="bi bi-trash3 me-1"></i> Clear Cart
                        </button>
                        <a href="#rfq-desk" onclick="closeCartDrawer()" class="small text-decoration-none" style="color: var(--sh-primary); font-size: 0.8rem;">
                            <i class="bi bi-file-earmark-text me-1"></i> Need 500+ MT? Direct RFQ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agrovia Trade Checkout Modal -->
    <div class="modal fade" id="agroviaCheckoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color); border: 1px solid var(--sh-border);">
                <div class="modal-header border-bottom border-secondary border-opacity-25 py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(120, 162, 47, 0.15); color: var(--sh-primary);">
                            <i class="bi bi-send-check-fill fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold sh-text-title mb-0" style="font-size: 1.15rem;">Commodity Order Dispatch to Trade Desk</h5>
                            <small class="text-muted" style="font-size: 0.78rem;">Automated backend transmission to BRX Agro Global devices</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <form id="checkoutOrderForm">
                        <!-- Step 1: Order Items Summary Preview -->
                        <div class="mb-4 p-3 rounded-3 sh-box-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold sh-text-title small"><i class="bi bi-list-check text-success me-1"></i> Selected Commodity Lots:</span>
                                <span class="badge bg-success" id="checkoutItemCountBadge">0 items</span>
                            </div>
                            <div id="checkoutItemsList" class="small mb-2" style="max-height: 160px; overflow-y: auto;">
                                <!-- dynamically rendered items -->
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-2 border-top border-secondary border-opacity-25">
                                <span class="fw-semibold text-muted small">Logistics Framework:</span>
                                <span class="fw-bold text-success" style="font-size: 0.9rem;" id="checkoutTotalVal">Direct Wholesale IncoTerms 2020</span>
                            </div>
                        </div>

                        <!-- Step 2: Buyer & Logistics Details -->
                        <h6 class="fw-bold sh-text-title mb-3 small text-uppercase" style="letter-spacing: 0.5px;">
                            <i class="bi bi-person-badge text-success me-1"></i> 1. Buyer &amp; Corporate Entity
                        </h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Representative / Contact Name <span class="text-danger">*</span></label>
                                <input type="text" name="customer_name" class="form-control sh-input rounded-3" value="{{ auth()->check() ? auth()->user()->name : '' }}" placeholder="e.g. John Doe / Procuring Officer" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Corporate Email (for SGS &amp; Contract) <span class="text-danger">*</span></label>
                                <input type="email" name="customer_email" class="form-control sh-input rounded-3" value="{{ auth()->check() ? auth()->user()->email : '' }}" placeholder="buyer@company.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Contact Phone / WhatsApp</label>
                                <input type="text" name="customer_phone" class="form-control sh-input rounded-3" placeholder="+1 (555) 019-2834">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Destination Port / Discharge Facility <span class="text-danger">*</span></label>
                                <select name="shipping_address" class="form-select sh-input rounded-3" required>
                                    <option value="Rotterdam Port (NLRTM), Netherlands - CIF">Port of Rotterdam (NLRTM) - CIF</option>
                                    <option value="Qingdao Port (CNTAO), China - CIF">Port of Qingdao (CNTAO) - CIF</option>
                                    <option value="Jebel Ali Port (AEJEA), Dubai UAE - CIF">Port of Jebel Ali (AEJEA), Dubai - CIF</option>
                                    <option value="Santos Export Terminal (BRSSZ), Brazil - FOB" selected>Port of Santos (BRSSZ) - FOB Brazilian Berth</option>
                                    <option value="Paranaguá Port (BRPNG), Brazil - FOB">Port of Paranaguá (BRPNG) - FOB</option>
                                    <option value="Air Courier Laboratory Sample Express">Air Courier Laboratory Sample Express (DHL/FedEx)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Step 3: Delivery IncoTerms & Port Logistics -->
                        <h6 class="fw-bold sh-text-title mb-3 small text-uppercase" style="letter-spacing: 0.5px;">
                            <i class="bi bi-compass text-success me-1"></i> 2. Delivery IncoTerms &amp; Port Logistics
                        </h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Delivery Incoterm (Maritime Bulk)</label>
                                <select name="payment_method" class="form-select sh-input rounded-3">
                                    <option value="CIF (Cost, Insurance &amp; Freight to Destination Port)" selected>CIF — Cost, Insurance &amp; Freight (Destination Port)</option>
                                    <option value="FOB (Free On Board — Santos / Paranaguá Berth)">FOB — Free On Board (Santos / Paranaguá Berth)</option>
                                    <option value="CFR (Cost &amp; Freight to Discharge Port)">CFR — Cost &amp; Freight (Discharge Port)</option>
                                </select>
                                <small class="text-muted d-block mt-1">Official Incoterms 2020 framework applied for maritime bulk export.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Special Phytosanitary / Assay Instructions</label>
                                <input type="text" name="notes" class="form-control sh-input rounded-3" placeholder="e.g., Request Non-GMO IP certificate, Moisture < 12%">
                            </div>
                        </div>

                        <!-- Step 4: Automated Transmission Channel to Business -->
                        <h6 class="fw-bold sh-text-title mb-3 small text-uppercase" style="letter-spacing: 0.5px;">
                            <i class="bi bi-broadcast-pin text-success me-1"></i> 3. Automated Dispatch Channel to BRX Agro Global
                        </h6>
                        <div class="row g-2 mb-3">
                            <div class="col-md-4">
                                <label class="sh-channel-card p-3 rounded-3 border d-flex flex-column h-100 cursor-pointer position-relative">
                                    <div class="form-check p-0 m-0 d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 small fw-bold">
                                            <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                        </span>
                                        <input class="form-check-input m-0" type="radio" name="order_channel" value="whatsapp" id="channelWhatsapp">
                                    </div>
                                    <div class="small fw-bold sh-text-title mb-1">Business WhatsApp</div>
                                    <div class="text-muted" style="font-size: 0.72rem; line-height: 1.35;">
                                        Dispatches alert directly to company WhatsApp device (+55 11 95835-3433).
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="sh-channel-card p-3 rounded-3 border d-flex flex-column h-100 cursor-pointer position-relative">
                                    <div class="form-check p-0 m-0 d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 small fw-bold">
                                            <i class="bi bi-envelope-check me-1"></i> Email
                                        </span>
                                        <input class="form-check-input m-0" type="radio" name="order_channel" value="email" id="channelEmail">
                                    </div>
                                    <div class="small fw-bold sh-text-title mb-1">Business Email</div>
                                    <div class="text-muted" style="font-size: 0.72rem; line-height: 1.35;">
                                        Dispatches order notification to company inbox (brxagroglobal@gmail.com).
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="sh-channel-card p-3 rounded-3 border border-success d-flex flex-column h-100 cursor-pointer position-relative" style="background: rgba(120, 162, 47, 0.08);">
                                    <div class="form-check p-0 m-0 d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge bg-success px-2 py-1 small fw-bold text-white">
                                            <i class="bi bi-send-check me-1"></i> Both (Recommended)
                                        </span>
                                        <input class="form-check-input m-0" type="radio" name="order_channel" value="both" id="channelBoth" checked>
                                    </div>
                                    <div class="small fw-bold sh-text-title mb-1">Both Channels</div>
                                    <div class="text-muted" style="font-size: 0.72rem; line-height: 1.35;">
                                        Simultaneous automated delivery to company phone &amp; official email.
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-3 mb-4 small d-flex align-items-center gap-2" style="background: rgba(120, 162, 47, 0.08); border: 1px solid rgba(120, 162, 47, 0.2);">
                            <i class="bi bi-robot text-success fs-5 flex-shrink-0"></i>
                            <div class="text-muted" style="font-size: 0.76rem; line-height: 1.4;">
                                <strong>100% Automated Backend Dispatch:</strong> Everything is sent by our server directly to the business devices. You will not have to manually compose or type any messages.
                            </div>
                        </div>

                        <!-- Assurance Strip -->
                        <div class="p-3 rounded-3 mb-4 small d-flex flex-wrap gap-3 align-items-center justify-content-between" style="background: rgba(120, 162, 47, 0.08); border: 1px solid rgba(120, 162, 47, 0.25);">
                            <div><i class="bi bi-patch-check-fill text-success me-1"></i> 100% Pre-Shipment Assay</div>
                            <div><i class="bi bi-shield-fill-check text-success me-1"></i> SGS Inspection Guaranteed</div>
                            <div><i class="bi bi-file-earmark-lock text-success me-1"></i> Official MAPA Export Clearance</div>
                        </div>

                        <!-- Order Alert message container -->
                        <div id="checkoutAlertBox" class="alert d-none mb-3 py-2 px-3 small rounded-3"></div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-2">
                            <button type="submit" id="btnSubmitOrder" class="btn btn-sh-primary flex-grow-1 py-2.5 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <span class="spinner-border spinner-border-sm d-none" id="orderSubmitSpinner" role="status"></span>
                                <i class="bi bi-send-fill fs-5" id="orderSubmitIcon"></i>
                                <span id="orderSubmitText">Transmit Order to BRX Agro Global Trade Desk</span>
                            </button>
                            <button type="button" class="btn btn-sh-outline px-4" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Authentication Required Modal (Commodity Cart Gating) -->
    <div class="modal fade" id="authRequiredModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color); border: 1px solid var(--sh-border);">
                <div class="modal-header border-bottom border-secondary border-opacity-25 py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(120, 162, 47, 0.15); color: var(--sh-primary); font-size: 1.15rem;">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold sh-text-title mb-0" style="font-size: 1.1rem;">Sign-In Required</h5>
                            <small class="text-muted" style="font-size: 0.76rem;">Institutional Commodity Trading</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-3 mx-auto rounded-circle d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; background: rgba(120, 162, 47, 0.12); color: var(--sh-primary); font-size: 1.85rem;">
                        <i class="bi bi-person-lock"></i>
                    </div>
                    <h5 class="fw-bold sh-text-title mb-2">Please Log In to Add to Cart</h5>
                    <p class="text-muted small mb-4 px-2" style="line-height: 1.5;">
                        To request physical commodity samples, reserve export lots, and review SGS assay certificates, you must be signed in with a verified institutional account.
                    </p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('auth.google') }}" class="btn btn-outline-secondary py-2 fw-bold d-flex align-items-center justify-content-center gap-2 sh-btn-google-modal">
                            <svg class="google-svg me-1" viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
                                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                            </svg>
                            <span>Continue with Google</span>
                        </a>
                        <div class="d-flex align-items-center my-1">
                            <hr class="flex-grow-1 border-secondary border-opacity-25 m-0">
                            <span class="px-2 text-muted small text-uppercase" style="font-size: 0.72rem;">or</span>
                            <hr class="flex-grow-1 border-secondary border-opacity-25 m-0">
                        </div>
                        <a href="{{ route('login') }}" class="btn btn-sh-login py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-box-arrow-in-right fs-5"></i> Log In to Your Account
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-sh-primary py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-person-plus fs-5"></i> Create Institutional Account
                        </a>
                        <button type="button" class="btn btn-link text-muted text-decoration-none small mt-1" data-bs-dismiss="modal">
                            Continue Browsing Catalog
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color);">
                <div class="modal-header border-bottom border-secondary border-opacity-25 py-3">
                    <h5 class="modal-title fw-bold sh-text-title" id="qvModalTitle">Commodity Quick View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="rounded-3 overflow-hidden mb-3" style="height: 200px;">
                        <img id="qvModalImg" src="" alt="" class="w-100 h-100 object-fit-cover">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h4 class="fw-bold sh-text-title mb-0" id="qvModalName"></h4>
                        <span class="badge rounded-pill" id="qvModalOrigin" style="background: rgba(120, 162, 47, 0.2); color: var(--sh-primary); border: 1px solid rgba(120, 162, 47, 0.3);">Brazil</span>
                    </div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill mb-3" style="background: rgba(120, 162, 47, 0.12); color: var(--sh-primary); font-weight: 700; font-size: 0.86rem;"><i class="bi bi-patch-check-fill"></i> <span id="qvModalPrice" data-unit="MT">Physical Export Assay Assured · Incoterms 2020</span></div>
                    <div class="p-3 rounded-3 mb-3 small sh-box-bg" style="border: 1px solid var(--bs-border-color);">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="sh-text-muted">SGS Assay:</span>
                            <span class="sh-text-title fw-bold">100% Pre-Shipment Tested</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="sh-text-muted">Incoterms:</span>
                            <span class="text-success fw-bold">FOB Santos / CIF Discharge Port</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="sh-text-muted">Loading Port:</span>
                            <span class="sh-text-title fw-bold">Santos / Paranaguá (BR)</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" id="qvAddToCartBtn" class="btn btn-sh-primary flex-fill">
                            <i class="bi bi-bag-plus me-1"></i> Add to Commodity Cart
                        </button>
                        <button type="button" class="btn btn-sh-outline" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color);">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold sh-text-title"><i class="bi bi-search me-2" style="color: var(--sh-primary);"></i>Search Commodities</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="text" id="modalSearchInput" class="form-control form-control-lg rounded-pill mb-3 sh-input" placeholder="Type commodity name, grade, or basin...">
                    <div class="small sh-text-muted">Press <kbd class="sh-box-bg sh-text-title border border-secondary px-2 py-1">Esc</kbd> to exit.</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= AUTHENTICATED USER ACCOUNT PORTAL MODAL ================= -->
    @auth
    <div class="modal fade" id="agroviaAccountModal" tabindex="-1" aria-labelledby="agroviaAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color); border: 1px solid var(--sh-border);">
                <!-- Modal Header -->
                <div class="modal-header border-bottom border-secondary border-opacity-25 py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(120, 162, 47, 0.15); color: var(--sh-primary); font-size: 1.25rem;">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold sh-text-title mb-0" id="agroviaAccountModalLabel" style="font-family: 'Comic Relief', system-ui, sans-serif; font-size: 1.15rem;">My Account</h5>
                            <small class="text-muted" style="font-size: 0.76rem;">BRX AGRO GLOBAL Institutional Portal</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <!-- User Info Card -->
                    <div class="p-3 rounded-3 mb-3 sh-box-bg" style="border: 1px solid var(--bs-border-color);">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px; background: rgba(120, 162, 47, 0.18); color: var(--sh-primary); font-size: 1.75rem;">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                            <div class="min-w-0 flex-grow-1">
                                <h6 class="fw-bold sh-text-title mb-0 text-truncate" style="font-size: 1.05rem;">{{ auth()->user()->name }}</h6>
                                <div class="text-muted small text-truncate">{{ auth()->user()->email }}</div>
                                <div class="mt-1">
                                    @if(auth()->user()->isAdmin())
                                        <span class="badge bg-warning text-dark px-2 py-1 small fw-bold">
                                            <i class="bi bi-shield-check me-1"></i>Administrator
                                        </span>
                                    @else
                                        <span class="badge bg-success px-2 py-1 small fw-bold">
                                            <i class="bi bi-patch-check-fill me-1"></i>Verified Commodity Buyer
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Direct Access (If Admin) -->
                    @if(auth()->user()->isAdmin())
                        <div class="mb-3">
                            <div class="small fw-bold text-uppercase text-muted mb-2" style="letter-spacing: 0.5px;">Administration Desk</div>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning w-100 py-2.5 mb-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-speedometer2 fs-5"></i> Open Admin Dashboard
                            </a>
                            <div class="row g-2">
                                <div class="col-6">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary w-100 py-2 small d-flex align-items-center justify-content-center gap-1">
                                        <i class="bi bi-box-seam"></i> Products
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-secondary w-100 py-2 small d-flex align-items-center justify-content-center gap-1">
                                        <i class="bi bi-envelope"></i> Inquiries
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr class="border-secondary border-opacity-25 my-3">
                    @endif

                    <!-- Quick Trade Actions -->
                    <div class="mb-3">
                        <div class="small fw-bold text-uppercase text-muted mb-2" style="letter-spacing: 0.5px;">Trade Desk Actions</div>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-primary py-2.5 fw-semibold d-flex align-items-center justify-content-center gap-2" onclick="openTradeDeskInbox('Hello BRX Agro Global, I am a registered buyer requesting commodity quotation.')">
                                <i class="bi bi-inbox-fill fs-5 text-success"></i> Open Trade Desk Inbox &amp; Messages
                            </button>
                            <a href="mailto:brxagroglobal@gmail.com?subject=Commercial%20Inquiry%20%E2%80%94%20{{ urlencode(auth()->user()->name) }}&body=Hello%20BRX%20Agro%20Global%20Trade%20Desk%2C%0A%0AMy%20registered%20buyer%20account%20is%20{{ urlencode(auth()->user()->email) }}.%0A%0APlease%20provide%20official%20FOB%2FCIF%20pricing%20and%20SGS%20specifications%20for%3A%0A-%20Target%20Commodity%3A%20%0A-%20Volume%20(MT)%3A%20%0A-%20Destination%20Port%3A%20%0A%0AThank%20you%2C%0A{{ urlencode(auth()->user()->name) }}" class="btn btn-outline-secondary py-2 fw-semibold d-flex align-items-center justify-content-center gap-2" title="Compose email directly on your device">
                                <i class="bi bi-envelope-arrow-up-fill fs-5 text-primary"></i> Compose Email on Device
                            </a>
                            <a href="#rfq-desk" data-bs-dismiss="modal" class="btn btn-sh-primary py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-file-earmark-text fs-5"></i> Submit Commodity RFQ (500+ MT)
                            </a>
                            <button type="button" class="btn btn-outline-success py-2 fw-semibold d-flex align-items-center justify-content-center gap-2" onclick="closeAccountModalAndOpenCart()">
                                <i class="bi bi-basket3 fs-5"></i> View Commodity Sample Cart
                            </button>
                        </div>
                    </div>

                    <!-- My Registered Inquiries & Messages in Account Box -->
                    @if(isset($userInquiries) && $userInquiries->isNotEmpty())
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small fw-bold text-uppercase text-muted" style="letter-spacing: 0.5px;">My Desk Inquiries ({{ $userInquiries->count() }})</span>
                                <button type="button" class="btn btn-link btn-sm p-0 text-success text-decoration-none fw-semibold" onclick="openTradeDeskInbox()">New Message</button>
                            </div>
                            <div class="list-group list-group-flush rounded-3 border" style="max-height: 190px; overflow-y: auto;">
                                @foreach($userInquiries as $inq)
                                    <div class="list-group-item p-2.5 small" style="background: var(--sh-surface);">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-truncate me-2" style="max-width: 180px;">{{ $inq->subject ?: 'Trade Inquiry' }}</strong>
                                            <span class="badge {{ $inq->status === 'resolved' ? 'bg-success' : ($inq->status === 'in_progress' ? 'bg-primary' : 'bg-secondary') }} rounded-pill" style="font-size: 0.65rem;">
                                                {{ ucfirst($inq->status) }}
                                            </span>
                                        </div>
                                        <div class="text-muted d-flex justify-content-between align-items-center" style="font-size: 0.72rem;">
                                            <span>{{ $inq->created_at->format('M d, H:i') }}</span>
                                            <a href="javascript:void(0)" onclick="openTradeDeskInbox(); $('#inboxMessagesTabBtn').tab('show');" class="text-success text-decoration-none fw-semibold">View in Desk Inbox</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(isset($userOrders) && $userOrders->isNotEmpty())
                        <div class="mb-3">
                            <div class="small fw-bold text-uppercase text-muted mb-2" style="letter-spacing: 0.5px;">My Registered Orders ({{ $userOrders->count() }})</div>
                            <div class="list-group list-group-flush rounded-3 border" style="max-height: 160px; overflow-y: auto;">
                                @foreach($userOrders as $ord)
                                    <div class="list-group-item p-2.5 small" style="background: var(--sh-surface);">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold text-success">{{ $ord->order_number }}</span>
                                            <span class="badge bg-warning text-dark rounded-pill" style="font-size: 0.65rem;">{{ ucfirst($ord->status) }}</span>
                                        </div>
                                        <div class="text-muted d-flex justify-content-between" style="font-size: 0.72rem;">
                                            <span>{{ $ord->created_at->format('M d, Y') }}</span>
                                            <span>{{ $ord->total_amount > 0 ? '$'.number_format($ord->total_amount, 2) : 'Direct Wholesale RFQ' }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Incoterms & Origination Info Strip -->
                    <div class="p-2.5 rounded-3 mb-3 small d-flex align-items-center gap-2" style="background: rgba(120, 162, 47, 0.08); border: 1px solid rgba(120, 162, 47, 0.22); font-size: 0.8rem;">
                        <i class="bi bi-shield-lock-fill text-success fs-5 flex-shrink-0"></i>
                        <span>All quotations &amp; contracts executed under Incoterms 2020 (CIF/FOB Santos) with official MAPA phytosanitary clearance.</span>
                    </div>

                    <!-- Sign Out Form -->
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-box-arrow-right fs-5"></i> Sign Out / Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <!-- =========================================================================
         15. ON-SITE TRADE DESK INBOX & MESSAGING BOX (No external WhatsApp app)
         ========================================================================= -->
    <div class="modal fade" id="tradeDeskInboxModal" tabindex="-1" aria-labelledby="tradeDeskInboxModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color); border: 1px solid var(--sh-border);">
                
                <!-- Modal Header -->
                <div class="modal-header border-bottom border-secondary border-opacity-25 py-3 px-4" style="background: linear-gradient(135deg, #121820 0%, #1a232f 100%);">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(120, 162, 47, 0.2); border: 2px solid #78a22f; color: #78a22f; font-size: 1.35rem;">
                            <i class="bi bi-inbox-fill"></i>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="modal-title fw-bold text-white mb-0" id="tradeDeskInboxModalLabel" style="font-size: 1.15rem;">Trade Desk Online Inbox</h5>
                                <span class="badge bg-success rounded-pill px-2 py-0.5" style="font-size: 0.68rem; letter-spacing: 0.5px;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 0.45rem;"></i>SÃO PAULO DESK LIVE
                                </span>
                            </div>
                            <small class="text-white-50" style="font-size: 0.76rem;">Direct commercial inquiry &amp; order execution desk — on-site message inbox</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs px-4 pt-2 border-bottom border-secondary border-opacity-25" id="inboxTabNav" role="tablist" style="background: rgba(120, 162, 47, 0.04);">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold text-uppercase py-2.5 px-3 border-0" id="inboxComposeTabBtn" data-bs-toggle="tab" data-bs-target="#inboxComposeTab" type="button" role="tab" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                            <i class="bi bi-pencil-square me-1"></i> Send Desk Message / RFQ
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold text-uppercase py-2.5 px-3 border-0" id="inboxMessagesTabBtn" data-bs-toggle="tab" data-bs-target="#inboxMessagesTab" type="button" role="tab" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                            <i class="bi bi-chat-left-text-fill me-1"></i> Desk Inquiries &amp; Messages
                            <span class="badge bg-success rounded-pill ms-1" id="inboxBadgeCount">{{ isset($userInquiries) ? $userInquiries->count() : 0 }}</span>
                        </button>
                    </li>
                </ul>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <div class="tab-content" id="inboxTabContent">
                        
                        <!-- TAB 1: COMPOSE MESSAGE / RFQ -->
                        <div class="tab-pane fade show active" id="inboxComposeTab" role="tabpanel">
                            <div id="deskInboxAlert" class="alert d-none mb-3 py-2 px-3 small rounded-3"></div>

                            <form id="deskInboxForm">
                                <input type="hidden" name="role" value="buyer">
                                <div aria-hidden="true" style="position: absolute; left: -9999px; top: -9999px; width: 1px; height: 1px; overflow: hidden; opacity: 0; pointer-events: none;">
                                    <label for="inbox_company_website_url">Company Website URL</label>
                                    <input type="text" id="inbox_company_website_url" name="company_website_url" value="" tabindex="-1" autocomplete="off">
                                </div>

                                @auth
                                    <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                    <div class="p-2.5 rounded-3 mb-3 d-flex align-items-center justify-content-between" style="background: rgba(120, 162, 47, 0.08); border: 1px solid rgba(120, 162, 47, 0.22); font-size: 0.82rem;">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-person-badge text-success fs-5"></i>
                                            <span>Signed in as <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})</span>
                                        </div>
                                        <span class="badge bg-success px-2 py-1">Verified Buyer</span>
                                    </div>
                                @else
                                    <div class="row g-2 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold mb-1">Your Name *</label>
                                            <input type="text" name="name" class="form-control form-control-sm sh-input" placeholder="First and last name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold mb-1">Corporate Email *</label>
                                            <input type="email" name="email" class="form-control form-control-sm sh-input" placeholder="procurement@company.com" required>
                                        </div>
                                    </div>
                                @endauth

                                <div class="row g-2 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold mb-1">Phone / WhatsApp (Optional)</label>
                                        <input type="text" name="phone" class="form-control form-control-sm sh-input" placeholder="+1 (555) 000-0000">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold mb-1">Commodity / Topic *</label>
                                        <select name="buyer_detail" id="inboxCommoditySelect" class="form-select form-select-sm sh-input" required>
                                            <option value="General Commercial RFQ">General Commercial Inquiry / Quotation</option>
                                            <option value="Brazilian Non-GMO Soybeans">Brazilian Non-GMO Soybeans</option>
                                            <option value="Refined Cane Sugar (ICUMSA 45)">Refined Cane Sugar (ICUMSA 45)</option>
                                            <option value="Yellow Corn (Maize Grade 2)">Yellow Corn (Maize Grade 2)</option>
                                            <option value="Brazilian Long Grain White Rice">Brazilian Long Grain White Rice</option>
                                            <option value="Refined Sunflower Oil (Grade A)">Refined Sunflower Oil (Grade A)</option>
                                            <option value="Refined Corn Oil (Pure Maize)">Refined Corn Oil (Pure Maize)</option>
                                            <option value="Refined Palm Olein Oil (CP8/CP10)">Refined Palm Olein Oil (CP8/CP10)</option>
                                            <option value="Pure Refined Soybean Oil (Food Grade)">Pure Refined Soybean Oil (Food Grade)</option>
                                            <option value="Premium Green Cardamom Pods">Premium Green Cardamom Pods</option>
                                            <option value="Arabica Green Coffee Beans (NY 2/3)">Arabica Green Coffee Beans (NY 2/3)</option>
                                            <option value="Brazilian Whole Green Mung Beans">Brazilian Whole Green Mung Beans</option>
                                            <option value="Premium Raw Shelled Almonds">Premium Raw Shelled Almonds</option>
                                            <option value="Premium Brazilian Cashew Kernels (W-240 / W-320)">Premium Brazilian Cashew Kernels (W-240 / W-320)</option>
                                            <option value="Whole Frozen Brazilian Chicken (Grade A)">Whole Frozen Brazilian Chicken (Grade A)</option>
                                            <option value="Frozen Boneless Beef Cuts (SIF/Halal)">Frozen Boneless Beef Cuts (SIF/Halal)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold mb-1">Message / Requirements / Destination Port *</label>
                                    <textarea name="message" id="inboxMessageText" class="form-control sh-input" rows="4" placeholder="Detail your target metric tons, target discharge port (CIF/FOB), packaging specifications, or trade questions..." required></textarea>
                                </div>

                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                    <small class="text-muted d-flex align-items-center gap-1" style="font-size: 0.76rem;">
                                        <i class="bi bi-shield-check text-success"></i>
                                        Direct delivery to desk inbox &amp; email
                                    </small>
                                    <div class="d-flex gap-2">
                                        <a id="btnComposeDeviceEmail" href="mailto:brxagroglobal@gmail.com?subject=Commodity%20Trade%20Inquiry%20%E2%80%94%20BRX%20Agro%20Global&body=Hello%20BRX%20Agro%20Global%20Trade%20Desk%2C%0A%0AI%20would%20like%20to%20request%20an%20indicative%20quote%20and%20specifications%20for%20Brazilian%20agro%20export%20commodities.%0A%0AThank%20you." class="btn btn-outline-secondary py-2 px-3 fw-semibold d-flex align-items-center gap-2" title="Immediately open your device email composer">
                                            <i class="bi bi-envelope-arrow-up-fill text-primary"></i>
                                            <span>Compose on Device</span>
                                        </a>
                                        <button type="submit" id="btnSendInboxDesk" class="btn btn-sh-primary py-2 px-3 fw-bold d-flex align-items-center gap-2">
                                            <i class="bi bi-send-fill"></i>
                                            <span>Send to Desk Inbox</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 2: INBOX & MESSAGE THREADS -->
                        <div class="tab-pane fade" id="inboxMessagesTab" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="small fw-bold text-uppercase text-muted" style="letter-spacing: 0.5px;">Trade Desk Communication Feed</span>
                                <button type="button" class="btn btn-sm btn-outline-success" onclick="$('#inboxComposeTabBtn').tab('show');">
                                    <i class="bi bi-plus-lg me-1"></i>New Inquiry
                                </button>
                            </div>

                            <div id="inboxThreadContainer" style="max-height: 420px; overflow-y: auto; padding-right: 4px;">
                                @if(isset($userInquiries) && $userInquiries->isNotEmpty())
                                    @foreach($userInquiries as $inq)
                                        <div class="inbox-msg-bubble inbox-msg-outgoing">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <strong class="text-dark">{{ $inq->subject ?: 'Trade Inquiry' }}</strong>
                                                <span class="badge bg-success rounded-pill" style="font-size: 0.65rem;">Logged #{{ $inq->id }}</span>
                                            </div>
                                            <p class="mb-2 text-dark small" style="white-space: pre-line;">{{ $inq->message }}</p>
                                            <div class="text-muted small d-flex justify-content-between align-items-center" style="font-size: 0.72rem;">
                                                <span><i class="bi bi-clock me-1"></i>{{ $inq->created_at->format('M d, Y · H:i') }} UTC</span>
                                                <span class="badge bg-light text-dark border">{{ ucfirst($inq->status) }}</span>
                                            </div>
                                        </div>
                                        <div class="inbox-msg-bubble inbox-msg-reply">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <i class="bi bi-headset text-success"></i>
                                                <strong class="small">BRX Trade Desk (São Paulo HQ)</strong>
                                                <span class="badge bg-light text-success border ms-auto" style="font-size: 0.65rem;">Automated Desk Receipt</span>
                                            </div>
                                            <p class="mb-0 small text-muted">
                                                Inquiry received into our trading pipeline. Our counterparty logistics specialists are checking export allocations and assay sheets.
                                            </p>
                                        </div>
                                    @endforeach
                                @else
                                    <div id="inboxEmptyState" class="text-center py-5">
                                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; background: rgba(120, 162, 47, 0.12); color: var(--sh-primary); font-size: 1.6rem;">
                                            <i class="bi bi-chat-square-dots"></i>
                                        </div>
                                        <h6 class="fw-bold sh-text-title mb-1">No Messages in Your Inbox Yet</h6>
                                        <p class="text-muted small mb-3">Submit your commodity inquiry or contract question above. Your trade history and quotes will be tracked right here.</p>
                                        <button type="button" class="btn btn-sh-primary btn-sm px-3" onclick="$('#inboxComposeTabBtn').tab('show');">
                                            <i class="bi bi-pencil-square me-1"></i>Compose First Message
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-top border-secondary border-opacity-25 py-2.5 px-4 d-flex justify-content-between align-items-center" style="background: var(--sh-surface);">
                    <div class="small text-muted d-flex align-items-center gap-2" style="font-size: 0.76rem;">
                        <i class="bi bi-building text-success"></i>
                        <span>Av. Brig. Faria Lima, 3064, São Paulo - SP, Brasil · +55 11 95835-3433</span>
                    </div>
                    <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Institutional Cookie Consent & LGPD/GDPR Preference Center -->
    @include('partials.cookie-consent')

    <!-- Local Scripts -->
    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <script>
        (function () {
            "use strict";

            // Theme Toggle Functionality (fume-main theme switcher)
            var root = document.documentElement;
            function updateThemeIcons() {
                var isLight = root.getAttribute('data-theme') === 'light';
                document.querySelectorAll('#themeToggleBtn i, .sh-theme-toggle i').forEach(function (icon) {
                    icon.className = isLight ? 'bi bi-sun' : 'bi bi-moon-stars';
                });
            }
            updateThemeIcons();

            document.querySelectorAll('#themeToggleBtn, .sh-theme-toggle').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var current = root.getAttribute('data-theme') || 'dark';
                    var next = current === 'light' ? 'dark' : 'light';
                    root.setAttribute('data-theme', next);
                    try { localStorage.setItem('sh-theme', next); } catch (e) {}
                    updateThemeIcons();
                });
            });

            // Auto-close mobile navbar when in-page anchor links are clicked
            $('.navbar-nav .nav-link:not(.dropdown-toggle)').on('click', function () {
                var $collapse = $('#mainNav');
                if ($collapse.hasClass('show')) {
                    var bsCollapse = bootstrap.Collapse.getInstance($collapse[0]);
                    if (bsCollapse) {
                        bsCollapse.hide();
                    } else {
                        $collapse.removeClass('show');
                    }
                }
            });

            // Cart State & Notification (Authentication Gating Enforced)
            var isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
            var cart = [];

            // If not logged in, purge any local cart storage immediately
            if (!isAuthenticated) {
                cart = [];
                try {
                    localStorage.removeItem('agroviaCart');
                } catch (e) {}
            } else {
                try {
                    cart = JSON.parse(localStorage.getItem('agroviaCart') || '[]');
                    // Ensure items have proper structure
                    cart = cart.map(function (item) {
                        return {
                            name: item.name || 'Commodity Lot',
                            price: 0,
                            unit: item.unit || 'MT',
                            image: item.image || '{{ asset('img/service-1.jpg') }}',
                            origin: item.origin || 'Brazil',
                            qty: parseInt(item.qty, 10) || 1
                        };
                    });
                } catch (e) {
                    cart = [];
                }
            }

            function saveCart() {
                try {
                    localStorage.setItem('agroviaCart', JSON.stringify(cart));
                } catch (e) {}
            }

            function updateCartCount() {
                var total = cart.reduce(function (sum, item) { return sum + (parseInt(item.qty, 10) || 1); }, 0);
                $('#cartCountBadge, .mobileCartBadge').text(total);
                $('#cartDrawerCountBadge').text(total + (total === 1 ? ' lot' : ' lots'));
                return total;
            }
            updateCartCount();

            function triggerToast(message, total) {
                var toast = document.getElementById('sh-toast');
                if (!toast) return;
                document.getElementById('shToastMsg').textContent = message;
                document.getElementById('shToastCount').textContent = (total || 0) + ' lot(s) in cart';
                toast.classList.remove('sh-toast-hide');
                toast.classList.add('sh-toast-show');
                setTimeout(function () {
                    toast.classList.remove('sh-toast-show');
                    toast.classList.add('sh-toast-hide');
                }, 3000);
            }

            // Agrovia Cart Drawer Functions
            function openCartDrawer() {
                renderCartDrawer();
                var backdrop = document.getElementById('agroviaCartBackdrop');
                var drawer = document.getElementById('agroviaCartDrawer');
                if (backdrop) backdrop.classList.add('show');
                if (drawer) {
                    drawer.classList.add('show');
                    drawer.scrollLeft = 0;
                    var body = drawer.querySelector('.offcanvas-body');
                    if (body) {
                        body.scrollLeft = 0;
                    }
                }
                document.body.style.overflow = 'hidden';
            }
            window.openCartDrawer = openCartDrawer;

            function closeCartDrawer() {
                var backdrop = document.getElementById('agroviaCartBackdrop');
                var drawer = document.getElementById('agroviaCartDrawer');
                if (backdrop) backdrop.classList.remove('show');
                if (drawer) drawer.classList.remove('show');
                document.body.style.overflow = '';
            }
            window.closeCartDrawer = closeCartDrawer;

            function renderCartDrawer() {
                updateCartCount();
                var $empty = $('#cartEmptyState');
                var $pop = $('#cartPopulatedContent');
                var $list = $('#cartItemsList');

                if (cart.length === 0) {
                    $empty.removeClass('d-none');
                    $pop.addClass('d-none');
                    $('#cartSummaryTotalVal').text('0 Lots');
                    $('#cartSummaryLotCount').text('0');
                    return;
                }

                $empty.addClass('d-none');
                $pop.removeClass('d-none');
                $list.empty();

                var totalLots = 0;

                cart.forEach(function (item, index) {
                    var qty = parseInt(item.qty, 10) || 1;
                    totalLots += qty;

                    var itemHtml = `
                        <div class="sh-cart-item">
                            <img src="${item.image || '{{ asset('img/service-1.jpg') }}'}" alt="${item.name}" class="sh-cart-thumb">
                            <div class="sh-cart-item-details">
                                <div class="sh-cart-item-title-row">
                                    <h6 class="sh-cart-item-title" title="${item.name}">${item.name}</h6>
                                    <button type="button" class="sh-cart-del-btn" onclick="removeCartItem(${index})" title="Remove item">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                                <div class="d-flex align-items-center gap-1 my-1 flex-wrap">
                                    <span class="badge" style="background: rgba(120, 162, 47, 0.15); color: var(--sh-primary); font-size: 0.68rem; padding: 2px 6px;">
                                        ${item.origin || 'Brazil'}
                                    </span>
                                    <span class="text-muted" style="font-size: 0.72rem;">· SGS Assayed</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap gap-2">
                                    <div class="sh-cart-qty-ctrl">
                                        <button type="button" class="sh-cart-qty-btn" onclick="changeItemQty(${index}, -1)" title="Decrease">-</button>
                                        <span class="sh-cart-qty-val">${qty}</span>
                                        <button type="button" class="sh-cart-qty-btn" onclick="changeItemQty(${index}, 1)" title="Increase">+</button>
                                    </div>
                                    <div class="text-end ms-auto flex-shrink-0" style="min-width: 0;">
                                        <span class="badge" style="background: rgba(120, 162, 47, 0.15); color: var(--sh-primary); font-size: 0.76rem; font-weight: 600;">Direct Export Lot</span>
                                        <small class="text-muted d-block" style="font-size: 0.68rem; white-space: nowrap;">FOB / CIF IncoTerms</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    $list.append(itemHtml);
                });

                $('#cartSummaryLotCount').text(totalLots);
                $('#cartSummaryTotalVal').text(totalLots + (totalLots === 1 ? ' Lot' : ' Lots'));
            }
            window.renderCartDrawer = renderCartDrawer;

            function changeItemQty(index, delta) {
                if (!cart[index]) return;
                cart[index].qty = (parseInt(cart[index].qty, 10) || 1) + delta;
                if (cart[index].qty <= 0) {
                    cart.splice(index, 1);
                }
                saveCart();
                renderCartDrawer();
                triggerToast('Cart updated', updateCartCount());
            }
            window.changeItemQty = changeItemQty;

            function removeCartItem(index) {
                if (!cart[index]) return;
                var removedName = cart[index].name;
                cart.splice(index, 1);
                saveCart();
                renderCartDrawer();
                triggerToast(removedName + ' removed from cart', updateCartCount());
            }
            window.removeCartItem = removeCartItem;

            function clearCart() {
                if (cart.length === 0) return;
                if (confirm('Are you sure you want to clear your commodity sample cart?')) {
                    cart = [];
                    saveCart();
                    renderCartDrawer();
                    triggerToast('Cart cleared', 0);
                }
            }
            window.clearCart = clearCart;

            // Add to Cart Buttons
            var currentQvProduct = '';
            var currentQvUnit = 'MT';
            var currentQvImage = '{{ asset('img/service-1.jpg') }}';
            var currentQvOrigin = 'Brazil';

            $(document).on('click', '.btn-add-cart', function (e) {
                e.preventDefault();
                var prodName = $(this).attr('data-name') || 'Agricultural Commodity';
                var prodUnit = $(this).attr('data-unit') || 'MT';
                var prodImage = $(this).attr('data-image') || '{{ asset('img/service-1.jpg') }}';
                var prodOrigin = $(this).attr('data-origin') || 'Brazil';

                var existing = cart.find(function (i) { return i.name === prodName; });
                if (existing) {
                    existing.qty = (parseInt(existing.qty, 10) || 1) + 1;
                } else {
                    cart.push({
                        name: prodName,
                        price: 0,
                        unit: prodUnit,
                        image: prodImage,
                        origin: prodOrigin,
                        qty: 1
                    });
                }
                saveCart();
                var total = updateCartCount();
                triggerToast(prodName + ' added to cart!', total);
                openCartDrawer();
            });

            // Quick View Trigger
            $(document).on('click', '.quick-view-trigger', function () {
                currentQvProduct = $(this).attr('data-product') || 'Brazilian Agro Commodity';
                currentQvImage = $(this).attr('data-image') || '{{ asset('img/service-1.jpg') }}';
                currentQvOrigin = $(this).attr('data-origin') || 'Brazil';
                currentQvUnit = $(this).attr('data-unit') || 'MT';

                $('#qvModalTitle').text(currentQvProduct);
                $('#qvModalName').text(currentQvProduct);
                $('#qvModalOrigin').text(currentQvOrigin);
                $('#qvModalImg').attr('src', currentQvImage);

                var modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
                modal.show();
            });

            $('#qvAddToCartBtn').on('click', function () {
                if (!currentQvProduct) return;
                var existing = cart.find(function (i) { return i.name === currentQvProduct; });
                if (existing) {
                    existing.qty = (parseInt(existing.qty, 10) || 1) + 1;
                } else {
                    cart.push({
                        name: currentQvProduct,
                        price: 0,
                        unit: currentQvUnit,
                        image: currentQvImage,
                        origin: currentQvOrigin,
                        qty: 1
                    });
                }
                saveCart();
                var total = updateCartCount();
                triggerToast(currentQvProduct + ' added to cart!', total);
                var qvEl = document.getElementById('quickViewModal');
                var qvInstance = bootstrap.Modal.getInstance(qvEl);
                if (qvInstance) { qvInstance.hide(); }
                openCartDrawer();
            });

            $('#cartTriggerBtn, .mobile-cart-trigger').on('click', function (e) {
                e.preventDefault();
                openCartDrawer();
            });

            // Open Checkout Modal from Cart Drawer
            $('#btnOpenCheckout').on('click', function () {
                if (cart.length === 0) {
                    alert('Your sample cart is currently empty. Please select commodity lots first.');
                    return;
                }
                closeCartDrawer();

                var $chkList = $('#checkoutItemsList');
                $chkList.empty();
                var lotCount = 0;

                cart.forEach(function (item) {
                    var qty = parseInt(item.qty, 10) || 1;
                    lotCount += qty;

                    $chkList.append(`
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary border-opacity-10 gap-2">
                            <div style="min-width: 0; flex: 1 1 auto;">
                                <strong class="sh-text-title d-block" style="word-break: break-word;">${item.name}</strong>
                                <span class="text-muted small">${qty} ${item.unit || 'MT / Lot(s)'} · ${item.origin || 'Brazil'} Origin</span>
                            </div>
                            <span class="badge flex-shrink-0" style="background: rgba(120, 162, 47, 0.15); color: var(--sh-primary); font-size: 0.78rem;">SGS Assayed Lot</span>
                        </div>
                    `);
                });

                $('#checkoutItemCountBadge').text(lotCount + (lotCount === 1 ? ' item' : ' items'));
                $('#checkoutAlertBox').addClass('d-none');

                var checkoutModal = new bootstrap.Modal(document.getElementById('agroviaCheckoutModal'));
                checkoutModal.show();
            });

            // Submit Checkout Order via AJAX
            $('#checkoutOrderForm').on('submit', function (e) {
                e.preventDefault();
                if (cart.length === 0) {
                    alert('Your cart is empty.');
                    return;
                }

                var $btn = $('#btnSubmitOrder');
                var $spinner = $('#orderSubmitSpinner');
                var $icon = $('#orderSubmitIcon');
                var $text = $('#orderSubmitText');
                var $alert = $('#checkoutAlertBox');

                var selectedChannel = $('input[name="order_channel"]:checked').val() || 'both';

                $btn.prop('disabled', true);
                $spinner.removeClass('d-none');
                $icon.addClass('d-none');
                $text.text('Transmitting Order to BRX Agro Global Devices...');

                var formData = {
                    customer_name: $('input[name="customer_name"]').val(),
                    customer_email: $('input[name="customer_email"]').val(),
                    customer_phone: $('input[name="customer_phone"]').val(),
                    shipping_address: $('select[name="shipping_address"]').val(),
                    payment_method: $('select[name="payment_method"]').val(),
                    channel: selectedChannel,
                    notes: $('input[name="notes"]').val(),
                    items: cart.map(function (item) {
                        return {
                            name: item.name,
                            unit: item.unit || 'MT',
                            qty: parseInt(item.qty, 10) || 1,
                            price: 0
                        };
                    })
                };

                $.ajax({
                    url: '{{ route('checkout.store') }}',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    success: function (res) {
                        var channelBadge = (selectedChannel === 'whatsapp') ? 'Business WhatsApp (+55 11 95835-3433)'
                            : (selectedChannel === 'email') ? 'Corporate Email (brxagroglobal@gmail.com)'
                            : 'WhatsApp (+55 11 95835-3433) & Corporate Email';

                        // Auto-open WhatsApp chat window directly on user's device if WhatsApp was selected
                        if (res.whatsapp_url && (selectedChannel === 'whatsapp' || selectedChannel === 'both')) {
                            try {
                                window.open(res.whatsapp_url, '_blank');
                            } catch (e) {}
                        }

                        var waButton = '';
                        if (res.whatsapp_url && (selectedChannel === 'whatsapp' || selectedChannel === 'both')) {
                            waButton = `
                                <div class="mt-2.5 pt-2 border-top border-success border-opacity-25">
                                    <a href="${res.whatsapp_url}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success fw-bold d-inline-flex align-items-center gap-1.5 shadow-sm">
                                        <i class="bi bi-whatsapp"></i> Open Direct WhatsApp Conversation (Pre-Composed)
                                    </a>
                                </div>
                            `;
                        }

                        $alert.removeClass('d-none alert-danger').addClass('alert-success').html(`
                            <h6 class="fw-bold mb-1"><i class="bi bi-check-circle-fill me-1"></i> Order Recorded &amp; Transmitted!</h6>
                            <p class="mb-1">Reference: <strong>#${res.order_number}</strong></p>
                            <p class="mb-1 small">${res.message}</p>
                            <div class="mt-2 d-flex flex-wrap gap-1">
                                <span class="badge bg-success text-white px-2 py-1"><i class="bi bi-bell-fill me-1"></i> Dispatched to: ${channelBadge}</span>
                                <span class="badge bg-dark text-white px-2 py-1"><i class="bi bi-shield-check me-1"></i> Saved for Accountability</span>
                            </div>
                            ${waButton}
                        `);

                        // Clear cart
                        cart = [];
                        saveCart();
                        updateCartCount();
                        renderCartDrawer();

                        setTimeout(function () {
                            $btn.prop('disabled', false);
                            $spinner.addClass('d-none');
                            $icon.removeClass('d-none');
                            $text.text('Transmit Order to BRX Agro Global Trade Desk');
                            triggerToast('Order ' + res.order_number + ' Transmitted!', 0);
                        }, 2500);
                    },
                    error: function (xhr) {
                        var errMsg = 'Unable to complete checkout. Please review form fields or contact our trade desk directly.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errMsg = xhr.responseJSON.message;
                        }
                        $alert.removeClass('d-none alert-success').addClass('alert-danger').text(errMsg);
                        $btn.prop('disabled', false);
                        $spinner.addClass('d-none');
                        $icon.removeClass('d-none');
                        $text.text('Transmit Order to BRX Agro Global Trade Desk');
                    }
                });
            });

            // Category Filter Buttons
            $('.agro-filter-btn').on('click', function () {
                $('.agro-filter-btn').removeClass('active btn-primary').addClass('btn-outline-secondary');
                $(this).addClass('active btn-primary').removeClass('btn-outline-secondary');
                var filter = $(this).attr('data-filter');
                $('.product-item').each(function () {
                    var cat = $(this).attr('data-category');
                    if (filter === 'all' || cat === filter) {
                        $(this).stop(true, true).fadeIn(250);
                    } else {
                        $(this).stop(true, true).fadeOut(150);
                    }
                });
            });

            // Dropdown Category Filter in Navbar
            $(document).on('click', '.agro-nav-cat-filter', function (e) {
                var targetCat = $(this).attr('data-filter');
                if (targetCat) {
                    var $matchBtn = $('.agro-filter-btn').filter(function () {
                        return $(this).text().trim().toLowerCase() === targetCat.toLowerCase();
                    });
                    if ($matchBtn.length > 0) {
                        $matchBtn.click();
                    } else {
                        $('.agro-filter-btn').removeClass('active btn-primary').addClass('btn-outline-secondary');
                        $('.product-item').each(function () {
                            var cat = ($(this).attr('data-category') || '').toLowerCase();
                            if (cat.indexOf(targetCat.toLowerCase()) !== -1) {
                                $(this).stop(true, true).fadeIn(250);
                            } else {
                                $(this).stop(true, true).fadeOut(150);
                            }
                        });
                    }
                    var prodSec = document.getElementById('products');
                    if (prodSec) {
                        prodSec.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });

            // Scroll to Top Button
            var scrollBtn = document.getElementById('sh-scroll-top');
            if (scrollBtn) {
                window.addEventListener('scroll', function () {
                    scrollBtn.classList.toggle('visible', window.scrollY > 350);
                });
                scrollBtn.addEventListener('click', function () {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            // RFQ In-Page Form Submission
            $('#rfqInquiryForm').on('submit', function (e) {
                e.preventDefault();
                var $form = $(this);
                var $btn = $('#rfqSubmitBtn');
                var origText = $btn.html();
                $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Transmitting to Brazilian Desk...');

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
                            '<strong>Inquiry Received!</strong> Reference Code: <code>' + ref + '</code>. Our São Paulo trade desk will contact your company within 4 business hours.'
                        );
                        triggerToast('RFQ Transmitted! Ref: ' + ref, updateCartCount());
                        $form[0].reset();
                    },
                    error: function (xhr) {
                        var errorMsg = 'Failed to submit inquiry. Please check required fields or contact WhatsApp directly.';
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

            // Modal Search Filter
            $('#modalSearchInput').on('input', function () {
                var val = $(this).val().toLowerCase();
                $('.product-item').each(function () {
                    var text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(val) !== -1);
                });
            });

            // Account Modal Helpers & Hash Listener
            window.closeAccountModalAndOpenCart = function () {
                var accEl = document.getElementById('agroviaAccountModal');
                if (accEl) {
                    var modal = bootstrap.Modal.getInstance(accEl);
                    if (modal) modal.hide();
                }
                openCartDrawer();
            };

            // Deep-link #account opens the account modal if logged in
            if (window.location.hash === '#account') {
                var accModalEl = document.getElementById('agroviaAccountModal');
                if (accModalEl) {
                    var accModalInstance = new bootstrap.Modal(accModalEl);
                    accModalInstance.show();
                }
            }

            // =========================================================================
            // Trade Desk On-Site Inbox & Messaging Box Logic
            // =========================================================================
            function syncDeviceMailto() {
                var commodity = $('#inboxCommoditySelect').val() || 'General Commercial RFQ';
                var text = $('#inboxMessageText').val() || '';
                var subject = 'Trade Inquiry: ' + commodity + ' — BRX AGRO GLOBAL';
                var body = 'Hello BRX AGRO GLOBAL Trade Desk,\n\n' +
                    (text ? text + '\n\n' : 'I am requesting formal FOB/CIF pricing, SGS laboratory assays, and vessel allocation for ' + commodity + '.\n\n') +
                    'Sent from BRX AGRO GLOBAL Platform';
                var mailtoUrl = 'mailto:brxagroglobal@gmail.com?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
                $('#btnComposeDeviceEmail').attr('href', mailtoUrl);
            }
            $('#inboxCommoditySelect, #inboxMessageText').on('input change keyup', syncDeviceMailto);

            window.openTradeDeskInbox = function (prefillMsg) {
                var accEl = document.getElementById('agroviaAccountModal');
                if (accEl) {
                    var accInstance = bootstrap.Modal.getInstance(accEl);
                    if (accInstance) accInstance.hide();
                }
                var inboxModalEl = document.getElementById('tradeDeskInboxModal');
                if (inboxModalEl) {
                    var inboxInstance = bootstrap.Modal.getInstance(inboxModalEl) || new bootstrap.Modal(inboxModalEl);
                    if (prefillMsg) {
                        $('#inboxMessageText').val(prefillMsg);
                    }
                    syncDeviceMailto();
                    inboxInstance.show();
                }
            };

            // Deep-link #inbox or #chat opens the on-site Desk Inbox
            if (window.location.hash === '#inbox' || window.location.hash === '#chat') {
                setTimeout(function () {
                    window.openTradeDeskInbox();
                }, 300);
            }

            // AJAX submission for Trade Desk Inbox form
            $('#deskInboxForm').on('submit', function (e) {
                e.preventDefault();
                var $form = $(this);
                var $btn = $('#btnSendInboxDesk');
                var origBtn = $btn.html();
                $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Transmitting...');

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var formData = $form.serialize();
                var subjectVal = $('#inboxCommoditySelect').val() || 'Trade Inquiry';
                var msgVal = $('#inboxMessageText').val();

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
                        
                        $('#deskInboxAlert').removeClass('d-none alert-danger').addClass('alert alert-success').html(
                            '<strong>Delivered!</strong> Your inquiry has been registered in the Trade Desk Inbox. Ref: <code>' + ref + '</code>.'
                        );

                        // Remove empty state
                        $('#inboxEmptyState').remove();

                        // Prepend newly logged message to the thread
                        var nowStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        var userBubble = '<div class="inbox-msg-bubble inbox-msg-outgoing">' +
                            '<div class="d-flex justify-content-between align-items-center mb-1">' +
                                '<strong class="text-dark">' + $('<div>').text(subjectVal).html() + '</strong>' +
                                '<span class="badge bg-success rounded-pill" style="font-size: 0.65rem;">' + ref + '</span>' +
                            '</div>' +
                            '<p class="mb-2 text-dark small" style="white-space: pre-line;">' + $('<div>').text(msgVal).html() + '</p>' +
                            '<div class="text-muted small d-flex justify-content-between align-items-center" style="font-size: 0.72rem;">' +
                                '<span><i class="bi bi-clock me-1"></i>Just now (' + nowStr + ')</span>' +
                                '<span class="badge bg-light text-dark border">Received</span>' +
                            '</div>' +
                        '</div>' +
                        '<div class="inbox-msg-bubble inbox-msg-reply">' +
                            '<div class="d-flex align-items-center gap-2 mb-1">' +
                                '<i class="bi bi-headset text-success"></i>' +
                                '<strong class="small">BRX Trade Desk (São Paulo HQ)</strong>' +
                                '<span class="badge bg-light text-success border ms-auto" style="font-size: 0.65rem;">Desk Confirmation</span>' +
                            '</div>' +
                            '<p class="mb-0 small text-muted">' +
                                'Inquiry logged under reference <strong>' + ref + '</strong>. Our export desk has received your specifications and will follow up with SGS certification and FOB/CIF pricing.' +
                            '</p>' +
                        '</div>';

                        $('#inboxThreadContainer').prepend(userBubble);

                        // Increment badge count
                        var curCount = parseInt($('#inboxBadgeCount').text(), 10) || 0;
                        $('#inboxBadgeCount').text(curCount + 1);

                        // Reset form fields
                        $('#inboxMessageText').val('');

                        // Switch to the Messages tab so the user immediately sees it in the inbox!
                        setTimeout(function () {
                            $('#inboxMessagesTabBtn').tab('show');
                        }, 700);

                        triggerToast('Message Sent to Desk Inbox! Ref: ' + ref, updateCartCount());
                    },
                    error: function (xhr) {
                        var errorMsg = 'Failed to transmit message. Please check all required fields.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        $('#deskInboxAlert').removeClass('d-none alert-success').addClass('alert alert-danger').text(errorMsg);
                    },
                    complete: function () {
                        $btn.prop('disabled', false).html(origBtn);
                    }
                });
            });

            // Feature Strip (#services) bounce-on-scroll animation
            var servicesStrip = document.getElementById('services');
            if (servicesStrip) {
                var stripItems = servicesStrip.querySelectorAll('.item');
                servicesStrip.classList.add('has-scroll-anim');

                if ('IntersectionObserver' in window) {
                    var stripObserver = new IntersectionObserver(function (entries) {
                        entries.forEach(function (entry) {
                            stripItems.forEach(function (item) {
                                if (entry.isIntersecting) {
                                    item.classList.add('is-visible');
                                } else {
                                    item.classList.remove('is-visible');
                                }
                            });
                        });
                    }, { threshold: 0.2 });

                    stripObserver.observe(servicesStrip);
                } else {
                    stripItems.forEach(function (item) {
                        item.classList.add('is-visible');
                    });
                }
            }

            // Product Card "Add to Cart" buttons (.sh-card-cart-btn) bounce-on-scroll animation
            var cartButtons = document.querySelectorAll('.sh-card-cart-btn');
            if (cartButtons.length) {
                cartButtons.forEach(function (btn) {
                    btn.classList.add('has-scroll-anim');
                });

                if ('IntersectionObserver' in window) {
                    var cartBtnObserver = new IntersectionObserver(function (entries) {
                        entries.forEach(function (entry) {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('is-visible');
                            } else {
                                entry.target.classList.remove('is-visible');
                            }
                        });
                    }, { threshold: 0.15 });

                    cartButtons.forEach(function (btn) {
                        cartBtnObserver.observe(btn);
                    });
                } else {
                    cartButtons.forEach(function (btn) {
                        btn.classList.add('is-visible');
                    });
                }
            }

        })();
    </script>
</body>

</html>
