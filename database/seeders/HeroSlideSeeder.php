<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {

        $slides = [
            [
                'eyebrow' => 'Maritime Logistics & Deepwater Berths',
                'title' => 'Global Container Cargo &',
                'title_highlight' => 'Ocean Freight Direct',
                'description' => 'Direct containerized and bulk ocean logistics operating through Santos and Paranaguá terminals. Full-scale intermodal vessel loading, MAPA/SIF phytosanitary clearance, and certified shipping schedules.',
                'primary_cta_text' => 'Explore Agricultural Products',
                'primary_cta_url' => '#products',
                'secondary_cta_text' => 'Request Bulk RFQ',
                'secondary_cta_url' => '#rfq-desk',
                'image' => 'img/banner-container-cargo.jpg',
                'image_webp' => 'img/banner-container-cargo.webp',
                'sort_order' => 1,
                'is_active' => true,
                'stats' => [
                    ['value' => '40ft & 20ft', 'label' => 'Container Capacity'],
                    ['value' => '100% SGS', 'label' => 'Pre-Shipment Tested'],
                    ['value' => 'Zero Risk', 'label' => 'Global Port Discharge'],
                    ['value' => 'Santos & Paranaguá', 'label' => 'Deepwater Exit Ports'],
                ],
            ],
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
                'sort_order' => 2,
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
                'sort_order' => 3,
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
                'sort_order' => 4,
                'is_active' => true,
                'stats' => [
                    ['value' => '5 Continents', 'label' => 'Global Distribution'],
                    ['value' => '25kg - Bulk', 'label' => 'Customized Packaging'],
                    ['value' => '-18°C Reefer', 'label' => 'Cold Chain Integrity'],
                    ['value' => 'MAPA / SIF', 'label' => 'Sanitary Clearance'],
                ],
            ],
            [
                'eyebrow' => '🔥 Top-Selling Fast-Track Commodities',
                'title' => 'Top-Selling Sugar, Edible Oils &',
                'title_highlight' => 'Brazilian Long Grain Rice',
                'description' => 'Direct container vessel and breakbulk origination for high-demand export lines: Refined Sugar ICUMSA 45 ($465/MT), Refined Sunflower Oil ($915/MT), Pure Soybean Oil ($950/MT), Corn Oil ($1,100/MT), Palm Olein Oil ($920/MT), and Type 1 White Rice ($295/MT). Full SGS & MAPA assay guarantees.',
                'primary_cta_text' => 'Order Top-Selling Commodities',
                'primary_cta_url' => '#products',
                'secondary_cta_text' => 'Instant Trade Desk RFQ',
                'secondary_cta_url' => '#rfq-desk',
                'image' => 'img/sunflower-bg.jpg',
                'image_webp' => 'img/sunflower-bg.webp',
                'sort_order' => 5,
                'is_active' => true,
                'stats' => [
                    ['value' => '6 Top Lines', 'label' => 'High Demand Exports'],
                    ['value' => '$295 - $1,100', 'label' => 'Transparent Per MT'],
                    ['value' => '100% SGS', 'label' => 'Certified Quality'],
                    ['value' => 'CIF & FOB', 'label' => 'Global Port Delivery'],
                ],
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::updateOrCreate(['image' => $slide['image']], $slide);
        }
    }
}
