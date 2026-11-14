<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        if (HeroSlide::count() > 0) {
            return;
        }

        $slides = [
            [
                'eyebrow' => 'Direct Harvest Basin Sourcing',
                'title' => 'From Brazilian Farms to',
                'title_highlight' => 'Global Tables',
                'description' => 'Direct bulk origination of Brazilian Non-GMO Soybeans, Refined Cane Sugar (ICUMSA 45), Yellow Corn, Poultry, Meats, and Pulses. Backed by MAPA phytosanitary clearance, independent SGS assays, and certified origin discharge documentation.',
                'primary_cta_text' => 'Explore Agricultural Products',
                'primary_cta_url' => '#products',
                'secondary_cta_text' => 'Request Bulk RFQ',
                'secondary_cta_url' => '#rfq-desk',
                'image' => 'img/banner-shipping.jpg',
                'image_webp' => 'img/banner-shipping.webp',
                'sort_order' => 1,
                'is_active' => true,
                'stats' => [
                    ['value' => '{total_stock}+ MT', 'label' => 'Active Supply'],
                    ['value' => '100% SGS', 'label' => 'Pre-Shipment Tested'],
                    ['value' => 'Zero Risk', 'label' => 'Global Port Discharge'],
                    ['value' => 'Santos & Paranaguá', 'label' => 'Deepwater Exit Ports'],
                ],
            ],
            [
                'eyebrow' => 'Bulk Contracts & Spot Lots',
                'title' => 'Source Certified Grains,',
                'title_highlight' => 'Sugar & Specialty',
                'description' => 'Eliminate trading middlemen with accredited farm cooperatives across Mato Grosso, Paraná, and Goiás. Complete origin traceability and guaranteed international loading schedules.',
                'primary_cta_text' => 'Explore Agricultural Products',
                'primary_cta_url' => '#products',
                'secondary_cta_text' => 'Request Bulk RFQ',
                'secondary_cta_url' => '#rfq-desk',
                'image' => 'img/banner-harvest.jpg',
                'image_webp' => 'img/banner-harvest.webp',
                'sort_order' => 2,
                'is_active' => true,
                'stats' => [
                    ['value' => '10 Sectors', 'label' => 'Commodity Categories'],
                    ['value' => 'FOB & CIF', 'label' => 'Global IncoTerms'],
                    ['value' => '< 4 Hours', 'label' => 'Quote Turnaround'],
                    ['value' => 'USD / EUR / BRL', 'label' => 'Settlement Currency'],
                ],
            ],
            [
                'eyebrow' => 'Export Packaging & Cold-Chain Fleet',
                'title' => 'Supplying Worldwide Across',
                'title_highlight' => '5 Continents',
                'description' => 'From 25kg / 50kg multi-wall bags and bulk container liners to -18°C refrigerated containers. Certified supply chains across Poultry, Meats, Dairy, Pulses, Grains, Sugar, Spices, and Fresh Fruits with 24/7 Trade Desk support.',
                'primary_cta_text' => 'Explore All 20 Products',
                'primary_cta_url' => '#products',
                'secondary_cta_text' => 'Request Trade Desk RFQ',
                'secondary_cta_url' => '#rfq-desk',
                'image' => 'img/banner-warehouse.jpg',
                'image_webp' => 'img/banner-warehouse.webp',
                'sort_order' => 3,
                'is_active' => true,
                'stats' => [
                    ['value' => '5 Continents', 'label' => 'Global Distribution'],
                    ['value' => '25kg - Bulk', 'label' => 'Customized Packaging'],
                    ['value' => '-18°C Reefer', 'label' => 'Cold Chain Integrity'],
                    ['value' => 'MAPA / SIF', 'label' => 'Sanitary Clearance'],
                ],
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::create($slide);
        }
    }
}
