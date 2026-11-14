<?php

return [
    [
        'label' => 'Overview',
        'items' => [
            [
                'label' => 'Dashboard',
                'icon' => 'bi-grid-1x2-fill',
                'route' => 'admin.dashboard',
                'pattern' => 'admin.dashboard',
            ],
        ],
    ],
    [
        'label' => 'Sales & Orders',
        'items' => [
            [
                'label' => 'Orders',
                'icon' => 'bi-bag-check',
                'route' => 'admin.orders.index',
                'pattern' => 'admin.orders.*',
            ],
            [
                'label' => 'Customers',
                'icon' => 'bi-people',
                'route' => 'admin.users.index',
                'pattern' => 'admin.users.*',
            ],
        ],
    ],
    [
        'label' => 'Agro Catalog',
        'items' => [
            [
                'label' => 'Products',
                'icon' => 'bi-box-seam',
                'route' => 'admin.products.index',
                'pattern' => 'admin.products.*',
            ],
            [
                'label' => 'Categories',
                'icon' => 'bi-tags',
                'route' => 'admin.categories.index',
                'pattern' => 'admin.categories.*',
            ],
        ],
    ],
    [
        'label' => 'Storefront',
        'items' => [
            [
                'label' => 'Hero Slides',
                'icon' => 'bi-images',
                'route' => 'admin.hero-slides.index',
                'pattern' => 'admin.hero-slides.*',
            ],
        ],
    ],
    [
        'label' => 'Trade Desk',
        'items' => [
            [
                'label' => 'Inquiries & Leads',
                'icon' => 'bi-chat-left-text',
                'route' => 'admin.inquiries.index',
                'pattern' => 'admin.inquiries.*',
            ],
        ],
    ],
];
