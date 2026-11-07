<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create or Update Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@matro.com'],
            [
                'name' => 'Matro Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. Create Sample Customer
        $customer = User::updateOrCreate(
            ['email' => 'buyer@globalagro.com'],
            [
                'name' => 'Carlos Silva',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        // 3. Seed Agro Categories
        $categoriesData = [
            ['name' => 'Grains & Rice', 'slug' => 'grains-rice', 'icon' => 'bi-flower1', 'description' => 'Non-GMO and standard grade grains from Brazilian harvest basins.'],
            ['name' => 'Oil & Sugar', 'slug' => 'oil-sugar', 'icon' => 'bi-droplet-half', 'description' => 'Raw and refined ICUMSA cane sugar, refined soybean and crude corn oils.'],
            ['name' => 'Nuts & Seeds', 'slug' => 'nuts-seeds', 'icon' => 'bi-circle', 'description' => 'Export-grade Brazil nuts, cashew kernels, chia and sesame seeds.'],
            ['name' => 'Lentils & Pulses', 'slug' => 'lentils-pulses', 'icon' => 'bi-pie-chart', 'description' => 'Dried pulses, Brazilian black beans, carioca beans and split peas.'],
            ['name' => 'Spices & Specialty', 'slug' => 'spices-specialty', 'icon' => 'bi-brightness-high', 'description' => 'Specialty Arabica and Robusta green coffees, black pepper and cloves.'],
            ['name' => 'Juices & Drinks', 'slug' => 'juices-drinks', 'icon' => 'bi-cup-straw', 'description' => 'Frozen concentrated orange juice (FCOJ) and pure açaí pulp.'],
        ];

        $categories = [];
        foreach ($categoriesData as $c) {
            $categories[$c['slug']] = Category::updateOrCreate(['slug' => $c['slug']], $c);
        }

        // 4. Seed Matro Products
        $productsData = [
            [
                'category_id' => $categories['grains-rice']->id,
                'name' => 'Brazilian Non-GMO Soybeans',
                'slug' => 'brazilian-non-gmo-soybeans',
                'brand' => 'Mato Grosso Harvest',
                'price' => 485.00,
                'original_price' => 520.00,
                'unit' => 'Metric Ton',
                'stock' => 2500,
                'origin' => 'Mato Grosso, Brazil',
                'image' => 'img/service-1.jpg',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Export-grade yellow soybeans with min. 36% protein and max. 14% moisture. Full phytosanitary certification included.',
            ],
            [
                'category_id' => $categories['oil-sugar']->id,
                'name' => 'Refined Cane Sugar (ICUMSA 45)',
                'slug' => 'refined-cane-sugar-icumsa-45',
                'brand' => 'São Paulo Mills',
                'price' => 540.00,
                'original_price' => 580.00,
                'unit' => 'Metric Ton',
                'stock' => 1800,
                'origin' => 'São Paulo, Brazil',
                'image' => 'img/service-2.jpg',
                'is_featured' => true,
                'is_new' => false,
                'description' => 'High purity Brazilian sparkling white cane sugar, ICUMSA 45 attenuation index, max. 0.04% moisture.',
            ],
            [
                'category_id' => $categories['grains-rice']->id,
                'name' => 'Yellow Corn (Maize Grade 2)',
                'slug' => 'yellow-corn-maize-grade-2',
                'brand' => 'Goiás Grains',
                'price' => 245.00,
                'original_price' => 260.00,
                'unit' => 'Metric Ton',
                'stock' => 4, // low stock trigger
                'origin' => 'Goiás, Brazil',
                'image' => 'img/service-3.jpg',
                'is_featured' => false,
                'is_new' => false,
                'description' => 'High energy animal feed and milling grade yellow corn. Bulk vessel and containerized shipment available.',
            ],
            [
                'category_id' => $categories['nuts-seeds']->id,
                'name' => 'Whole Brazil Nuts (Bertholletia excelsa)',
                'slug' => 'whole-brazil-nuts',
                'brand' => 'Amazonia Gold',
                'price' => 6200.00,
                'original_price' => 6800.00,
                'unit' => 'Metric Ton',
                'stock' => 120,
                'origin' => 'Pará, Brazil',
                'image' => 'img/service-4.jpg',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Wild-harvested Amazonian Brazil nuts, vacuum packed, lab-screened for aflatoxins, certified fair trade.',
            ],
            [
                'category_id' => $categories['lentils-pulses']->id,
                'name' => 'Brazilian Premium Black Beans (Feijão Preto)',
                'slug' => 'brazilian-premium-black-beans',
                'brand' => 'Sul Safra',
                'price' => 890.00,
                'original_price' => 950.00,
                'unit' => 'Metric Ton',
                'stock' => 350,
                'origin' => 'Paraná, Brazil',
                'image' => 'img/service-5.jpg',
                'is_featured' => false,
                'is_new' => false,
                'description' => 'Uniform calibre premium feijão preto, 99% purity rate, triple machine-cleaned, packaged in 25kg or 50kg bags.',
            ],
            [
                'category_id' => $categories['spices-specialty']->id,
                'name' => 'Green Coffee Beans (Arabica NY 2/3 Fine Cup)',
                'slug' => 'green-coffee-beans-arabica',
                'brand' => 'Minas Gerais Reserve',
                'price' => 4300.00,
                'original_price' => 4600.00,
                'unit' => 'Metric Ton',
                'stock' => 2, // low stock trigger
                'origin' => 'Minas Gerais, Brazil',
                'image' => 'img/service-6.jpg',
                'is_featured' => true,
                'is_new' => false,
                'description' => 'Strictly soft, fine cup Brazilian Arabica unroasted beans. Screen size 17/18, ideal for commercial roasters.',
            ],
            [
                'category_id' => $categories['oil-sugar']->id,
                'name' => 'Crude Degummed Soybean Oil',
                'slug' => 'crude-degummed-soybean-oil',
                'brand' => 'Cerrado Agro',
                'price' => 980.00,
                'original_price' => 1050.00,
                'unit' => 'Metric Ton',
                'stock' => 800,
                'origin' => 'Mato Grosso, Brazil',
                'image' => 'img/service-7.jpg',
                'is_featured' => false,
                'is_new' => true,
                'description' => 'Standard export crude soybean oil for industrial refining and biofuel feedstock. Flexitank delivery.',
            ],
            [
                'category_id' => $categories['juices-drinks']->id,
                'name' => 'Frozen Concentrated Orange Juice (FCOJ 65° Brix)',
                'slug' => 'frozen-concentrated-orange-juice-fcoj',
                'brand' => 'Citrus Paulista',
                'price' => 2850.00,
                'original_price' => 3100.00,
                'unit' => 'Metric Ton',
                'stock' => 150,
                'origin' => 'São Paulo, Brazil',
                'image' => 'img/service-8.jpg',
                'is_featured' => false,
                'is_new' => false,
                'description' => 'Pure 65° Brix Brazilian orange juice concentrate, frozen drums at -18°C. Cold-chain guaranteed.',
            ],
        ];

        $products = [];
        foreach ($productsData as $p) {
            $products[] = Product::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 5. Seed Sample Orders
        $order1 = Order::updateOrCreate(
            ['order_number' => 'MATRO-2026-001'],
            [
                'user_id' => $customer->id,
                'customer_name' => 'Carlos Silva',
                'customer_email' => 'buyer@globalagro.com',
                'customer_phone' => '+1 (555) 234-8900',
                'shipping_address' => 'Port of Rotterdam, Terminal 4B, Netherlands',
                'total_amount' => 48500.00,
                'status' => 'confirmed',
                'payment_method' => 'Letter of Credit (LC)',
                'notes' => 'Contract 100 MT Non-GMO Soybeans. Phytosanitary documents requested.',
            ]
        );
        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'product_id' => $products[0]->id],
            [
                'product_name' => $products[0]->name,
                'price' => $products[0]->price,
                'quantity' => 100,
                'subtotal' => 48500.00,
            ]
        );

        $order2 = Order::updateOrCreate(
            ['order_number' => 'MATRO-2026-002'],
            [
                'user_id' => null,
                'customer_name' => 'Elena Rostova',
                'customer_email' => 'erostova@medtrade.eu',
                'customer_phone' => '+34 912 345 678',
                'shipping_address' => 'Port of Valencia, Spain',
                'total_amount' => 27000.00,
                'status' => 'pending',
                'payment_method' => 'Escrow / Wire',
                'notes' => '50 MT ICUMSA 45 Sugar for confectionery manufacturing.',
            ]
        );
        OrderItem::updateOrCreate(
            ['order_id' => $order2->id, 'product_id' => $products[1]->id],
            [
                'product_name' => $products[1]->name,
                'price' => $products[1]->price,
                'quantity' => 50,
                'subtotal' => 27000.00,
            ]
        );

        $order3 = Order::updateOrCreate(
            ['order_number' => 'MATRO-2026-003'],
            [
                'user_id' => $customer->id,
                'customer_name' => 'Carlos Silva',
                'customer_email' => 'buyer@globalagro.com',
                'customer_phone' => '+1 (555) 234-8900',
                'shipping_address' => 'Port of Santos Bonded Warehouse, SP, Brazil',
                'total_amount' => 12400.00,
                'status' => 'shipped',
                'payment_method' => 'Wire Transfer',
                'notes' => '2 MT Wild Amazon Brazil Nuts.',
            ]
        );
        OrderItem::updateOrCreate(
            ['order_id' => $order3->id, 'product_id' => $products[3]->id],
            [
                'product_name' => $products[3]->name,
                'price' => $products[3]->price,
                'quantity' => 2,
                'subtotal' => 12400.00,
            ]
        );

        $order4 = Order::updateOrCreate(
            ['order_number' => 'MATRO-2026-004'],
            [
                'user_id' => null,
                'customer_name' => 'Ahmed Al-Mansoor',
                'customer_email' => 'a.mansoor@gulfcommodities.ae',
                'customer_phone' => '+971 4 398 7654',
                'shipping_address' => 'Jebel Ali Port, Dubai, UAE',
                'total_amount' => 8600.00,
                'status' => 'delivered',
                'payment_method' => 'Escrow / Wire',
                'notes' => 'Sample shipment of 2 MT Green Coffee Arabica Fine Cup.',
            ]
        );
        OrderItem::updateOrCreate(
            ['order_id' => $order4->id, 'product_id' => $products[5]->id],
            [
                'product_name' => $products[5]->name,
                'price' => $products[5]->price,
                'quantity' => 2,
                'subtotal' => 8600.00,
            ]
        );

        // 6. Seed Sample Trade Inquiries
        Inquiry::updateOrCreate(
            ['email' => 'procurement@eurograins.com'],
            [
                'name' => 'Johann Schmidt',
                'phone' => '+49 40 1234 567',
                'role' => 'buyer',
                'subject' => 'Quote inquiry for 5,000 MT Brazilian Soybeans CIF Hamburg',
                'message' => 'Looking to secure annual contract for 2026/2027 harvest. Require specifications, SGS inspection certificates and escrow payment terms.',
                'status' => 'new',
                'is_read' => false,
            ]
        );

        Inquiry::updateOrCreate(
            ['email' => 'logistics@transoceanic.br'],
            [
                'name' => 'Mariana Oliveira',
                'phone' => '+55 11 98877 6655',
                'role' => 'partner',
                'subject' => 'Cold chain container capacity from Santos to Shanghai',
                'message' => 'We operate reefer vessels weekly from Santos and Paranaguá. Interested in partnering on juice and perishable commodities.',
                'status' => 'in_progress',
                'is_read' => true,
            ]
        );

        Inquiry::updateOrCreate(
            ['email' => 'fazenda.boavista@mt.gov.br'],
            [
                'name' => 'Roberto Junqueira',
                'phone' => '+55 65 99911 2233',
                'role' => 'grower',
                'subject' => 'Grower Partnership - 12,000 Hectares Soy & Corn',
                'message' => 'Our farm cooperative in Sorriso/MT has completed harvest. Would like to list lot numbers directly onto the Matro trade desk.',
                'status' => 'new',
                'is_read' => false,
            ]
        );
    }
}
