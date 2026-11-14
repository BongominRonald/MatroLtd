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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User (without overwriting existing password on re-seed)
        $admin = User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@matro.com')],
            [
                'name' => env('ADMIN_NAME', 'Matro Admin'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
            ]
        );
        if ($admin->role !== 'admin') {
            $admin->role = 'admin';
            $admin->save();
        }

        // 2. Create Sample Customer (without overwriting existing password on re-seed)
        $customer = User::firstOrCreate(
            ['email' => 'buyer@globalagro.com'],
            [
                'name' => 'Carlos Silva',
                'password' => Hash::make('password'),
            ]
        );

        // 3. Seed Agro Categories
        $categoriesData = [
            ['name' => 'Grains & Rice', 'slug' => 'grains-rice', 'icon' => 'bi-flower1', 'description' => 'Non-GMO and standard grade grains from Brazilian harvest basins.'],
            ['name' => 'Oil & Sugar', 'slug' => 'oil-sugar', 'icon' => 'bi-droplet-half', 'description' => 'Raw and refined ICUMSA cane sugar, refined soybean and crude corn oils.'],
            ['name' => 'Nuts & Seeds', 'slug' => 'nuts-seeds', 'icon' => 'bi-circle', 'description' => 'Export-grade Brazil nuts, cashew kernels, chia and sesame seeds.'],
            ['name' => 'Lentils & Pulses', 'slug' => 'lentils-pulses', 'icon' => 'bi-pie-chart', 'description' => 'Dried pulses, Brazilian black beans, carioca beans and split peas.'],
            ['name' => 'Spices & Specialty', 'slug' => 'spices-specialty', 'icon' => 'bi-brightness-high', 'description' => 'Specialty Arabica green coffees, black pepper, cloves, and turmeric.'],
            ['name' => 'Poultry & Meat', 'slug' => 'poultry-eggs', 'icon' => 'bi-egg', 'description' => 'Whole frozen chicken, chicken cuts, prime beef cuts, and lamb carcasses.'],
            ['name' => 'Meat & Seafood', 'slug' => 'meat-fishes', 'icon' => 'bi-water', 'description' => 'Frozen boneless beef cuts, mutton, and sea-frozen Atlantic seafood.'],
            ['name' => 'Dairy Products', 'slug' => 'dairy', 'icon' => 'bi-cup-hot', 'description' => 'Instant full cream milk powder 26/28%, unsalted butter, and dairy derivatives.'],
            ['name' => 'Fruits & Vegetables', 'slug' => 'fruits-vegetables', 'icon' => 'bi-basket', 'description' => 'Fresh Brazilian export mangoes, citrus, and certified fresh produce.'],
            ['name' => 'Juices & Drinks', 'slug' => 'juices-drinks', 'icon' => 'bi-cup-straw', 'description' => 'Frozen concentrated orange juice (FCOJ) and pure açaí pulp.'],
        ];

        $categories = [];
        foreach ($categoriesData as $c) {
            $categories[$c['slug']] = Category::updateOrCreate(['slug' => $c['slug']], $c);
        }

        // 4. Seed BRX Products (Preserving all existing products and adding missing products from matogrossoexportltda.com.br)
        $productsData = [
            // --- EXISTING PRODUCTS (Preserved) ---
            [
                'category_id' => $categories['grains-rice']->id,
                'name' => 'Brazilian Non-GMO Soybeans',
                'slug' => 'brazilian-non-gmo-soybeans',
                'brand' => 'BRX Mato Grosso Harvest',
                'price' => 485.00,
                'original_price' => 520.00,
                'unit' => 'Metric Ton',
                'stock' => 2500,
                'origin' => 'Mato Grosso, Brazil',
                'image' => 'img/service-1.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Export-grade yellow soybeans with min. 36% protein and max. 14% moisture. Full phytosanitary certification included.',
            ],
            [
                'category_id' => $categories['oil-sugar']->id,
                'name' => 'Refined Cane Sugar (ICUMSA 45)',
                'slug' => 'refined-cane-sugar-icumsa-45',
                'brand' => 'BRX São Paulo Mills',
                'price' => 540.00,
                'original_price' => 580.00,
                'unit' => 'Metric Ton',
                'stock' => 1800,
                'origin' => 'São Paulo, Brazil',
                'image' => 'img/sugar.webp',
                'is_featured' => true,
                'is_new' => false,
                'description' => 'High purity Brazilian sparkling white cane sugar, ICUMSA 45 attenuation index, max. 0.04% moisture.',
            ],
            [
                'category_id' => $categories['grains-rice']->id,
                'name' => 'Yellow Corn (Maize Grade 2)',
                'slug' => 'yellow-corn-maize-grade-2',
                'brand' => 'BRX Goiás Grains',
                'price' => 245.00,
                'original_price' => 260.00,
                'unit' => 'Metric Ton',
                'stock' => 3500,
                'origin' => 'Goiás, Brazil',
                'image' => 'img/yellow-corn.webp',
                'is_featured' => false,
                'is_new' => false,
                'description' => 'High energy animal feed and milling grade yellow corn. Bulk vessel and containerized shipment available.',
            ],
            [
                'category_id' => $categories['nuts-seeds']->id,
                'name' => 'Whole Brazil Nuts (Bertholletia excelsa)',
                'slug' => 'whole-brazil-nuts',
                'brand' => 'BRX Amazonia Gold',
                'price' => 6200.00,
                'original_price' => 6800.00,
                'unit' => 'Metric Ton',
                'stock' => 120,
                'origin' => 'Pará, Brazil',
                'image' => 'img/service-4.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Wild-harvested Amazonian Brazil nuts, vacuum packed, lab-screened for aflatoxins, certified fair trade.',
            ],
            [
                'category_id' => $categories['lentils-pulses']->id,
                'name' => 'Brazilian Premium Black Beans (Feijão Preto)',
                'slug' => 'brazilian-premium-black-beans',
                'brand' => 'BRX Sul Safra',
                'price' => 890.00,
                'original_price' => 950.00,
                'unit' => 'Metric Ton',
                'stock' => 350,
                'origin' => 'Paraná, Brazil',
                'image' => 'img/service-5.webp',
                'is_featured' => false,
                'is_new' => false,
                'description' => 'Uniform calibre premium feijão preto, 99% purity rate, triple machine-cleaned, packaged in 25kg or 50kg bags.',
            ],
            [
                'category_id' => $categories['spices-specialty']->id,
                'name' => 'Green Coffee Beans (Arabica NY 2/3 Fine Cup)',
                'slug' => 'green-coffee-beans-arabica',
                'brand' => 'BRX Minas Reserve',
                'price' => 4300.00,
                'original_price' => 4600.00,
                'unit' => 'Metric Ton',
                'stock' => 450,
                'origin' => 'Minas Gerais, Brazil',
                'image' => 'img/coffee-beans.webp',
                'is_featured' => true,
                'is_new' => false,
                'description' => 'Strictly soft, fine cup Brazilian Arabica unroasted beans. Screen size 17/18, ideal for commercial roasters.',
            ],
            [
                'category_id' => $categories['oil-sugar']->id,
                'name' => 'Crude Degummed Soybean Oil',
                'slug' => 'crude-degummed-soybean-oil',
                'brand' => 'BRX Cerrado Agro',
                'price' => 980.00,
                'original_price' => 1050.00,
                'unit' => 'Metric Ton',
                'stock' => 800,
                'origin' => 'Mato Grosso, Brazil',
                'image' => 'img/service-7.webp',
                'is_featured' => false,
                'is_new' => true,
                'description' => 'Standard export crude soybean oil for industrial refining and biofuel feedstock. Flexitank delivery.',
            ],
            [
                'category_id' => $categories['juices-drinks']->id,
                'name' => 'Frozen Concentrated Orange Juice (FCOJ 65° Brix)',
                'slug' => 'frozen-concentrated-orange-juice-fcoj',
                'brand' => 'BRX Citrus Paulista',
                'price' => 2850.00,
                'original_price' => 3100.00,
                'unit' => 'Metric Ton',
                'stock' => 150,
                'origin' => 'São Paulo, Brazil',
                'image' => 'img/service-8.webp',
                'is_featured' => false,
                'is_new' => false,
                'description' => 'Pure 65° Brix Brazilian orange juice concentrate, frozen drums at -18°C. Cold-chain guaranteed.',
            ],

            // --- MISSING PRODUCTS ADDED FROM matogrossoexportltda.com.br ---
            [
                'category_id' => $categories['poultry-eggs']->id,
                'name' => 'Whole Frozen Brazilian Chicken (Grade A)',
                'slug' => 'whole-frozen-brazilian-chicken',
                'brand' => 'BRX Poultry Desk',
                'price' => 1850.00,
                'original_price' => 1980.00,
                'unit' => 'Metric Ton',
                'stock' => 2200,
                'origin' => 'Paraná, Brazil',
                'image' => 'img/chicken-meat.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Grade A Brazilian whole frozen chicken, Halal certified, eviscerated, no giblets. Calibres 800g to 1300g. 10 pcs/carton. 27 MT per 40ft reefer container at -18°C.',
            ],
            [
                'category_id' => $categories['meat-fishes']->id,
                'name' => 'Frozen Boneless Beef Cuts (Export Primal)',
                'slug' => 'frozen-boneless-beef-cuts',
                'brand' => 'BRX Mato Grosso Meat Desk',
                'price' => 4600.00,
                'original_price' => 4950.00,
                'unit' => 'Metric Ton',
                'stock' => 950,
                'origin' => 'Mato Grosso, Brazil',
                'image' => 'img/beef-meat.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Export grade Brazilian frozen boneless beef cuts. SIF and Halal inspected. Individually wrapped, packed in 20kg master cartons. Shipped at -18°C.',
            ],
            [
                'category_id' => $categories['meat-fishes']->id,
                'name' => 'Frozen Lamb & Mutton Carcasses',
                'slug' => 'frozen-lamb-mutton-carcasses',
                'brand' => 'BRX Agro Global Meat Desk',
                'price' => 5100.00,
                'original_price' => 5400.00,
                'unit' => 'Metric Ton',
                'stock' => 420,
                'origin' => 'Rio Grande do Sul, Brazil',
                'image' => 'img/lamb-meat.webp',
                'is_featured' => false,
                'is_new' => true,
                'description' => 'Frozen whole lamb and 6-way cut mutton carcasses. Halal certified, full veterinary export clearance. Reefer container dispatch.',
            ],
            [
                'category_id' => $categories['meat-fishes']->id,
                'name' => 'Atlantic Frozen Seafood & Sea Fish',
                'slug' => 'atlantic-frozen-seafood-fish',
                'brand' => 'BRX Marine Desk',
                'price' => 3200.00,
                'original_price' => 3500.00,
                'unit' => 'Metric Ton',
                'stock' => 600,
                'origin' => 'Santa Catarina, Brazil',
                'image' => 'img/fishes-seafood.webp',
                'is_featured' => false,
                'is_new' => false,
                'description' => 'Wild-caught Atlantic sea-frozen fish and seafood. IQF blast frozen on board, graded, glazed, and master carton packed.',
            ],
            [
                'category_id' => $categories['nuts-seeds']->id,
                'name' => 'Premium Brazilian Cashew Kernels (W-240 / W-320)',
                'slug' => 'premium-brazilian-cashew-kernels',
                'brand' => 'BRX Ceará Harvest',
                'price' => 7400.00,
                'original_price' => 7900.00,
                'unit' => 'Metric Ton',
                'stock' => 340,
                'origin' => 'Ceará, Brazil',
                'image' => 'img/cashew-nuts.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'White whole export cashew kernels (W-180, W-210, W-240, W-320). Vacuum packed in 22.68kg cartons or 2x11.34kg tins. 15.88 MT per 20ft container.',
            ],
            [
                'category_id' => $categories['lentils-pulses']->id,
                'name' => 'Red Split Lentils (Machine Cleaned / Sortex)',
                'slug' => 'red-split-lentils-sortex',
                'brand' => 'BRX Pulses Desk',
                'price' => 780.00,
                'original_price' => 840.00,
                'unit' => 'Metric Ton',
                'stock' => 1200,
                'origin' => 'Brazil / Mercosur',
                'image' => 'img/red-split-lentils.webp',
                'is_featured' => false,
                'is_new' => true,
                'description' => 'Premium Sortex red split lentils (Red Chief variety). Moisture max. 10%, purity min. 99.5%. Available in 25kg / 50kg PP bags.',
            ],
            [
                'category_id' => $categories['spices-specialty']->id,
                'name' => 'Brazilian Whole Black Pepper (ASTA 550g/l)',
                'slug' => 'brazilian-whole-black-pepper-asta',
                'brand' => 'BRX Pará Spices',
                'price' => 4800.00,
                'original_price' => 5200.00,
                'unit' => 'Metric Ton',
                'stock' => 380,
                'origin' => 'Pará, Brazil',
                'image' => 'img/black-pepper.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Machine-cleaned ASTA grade whole black pepper. Bulk density min. 550g/l, piperine min. 4.0%, moisture max. 12%. 25kg/50kg export bags.',
            ],
            [
                'category_id' => $categories['spices-specialty']->id,
                'name' => 'Sun-Dried Whole Red Chillies (Stemless)',
                'slug' => 'sun-dried-whole-red-chillies',
                'brand' => 'BRX Spice Desk',
                'price' => 3100.00,
                'original_price' => 3350.00,
                'unit' => 'Metric Ton',
                'stock' => 290,
                'origin' => 'Bahia, Brazil',
                'image' => 'img/dry-red-chilli.webp',
                'is_featured' => false,
                'is_new' => false,
                'description' => 'Stemless sun-dried whole red chillies with deep red colouration. Moisture max. 11%, foreign matter max. 1%. 25kg export bags.',
            ],
            [
                'category_id' => $categories['spices-specialty']->id,
                'name' => 'Double Polished Dried Turmeric Fingers',
                'slug' => 'whole-dried-turmeric-finger',
                'brand' => 'BRX Spice Desk',
                'price' => 2200.00,
                'original_price' => 2450.00,
                'unit' => 'Metric Ton',
                'stock' => 450,
                'origin' => 'Mato Grosso, Brazil',
                'image' => 'img/turmeric-finger.webp',
                'is_featured' => false,
                'is_new' => true,
                'description' => 'Double-polished dried turmeric finger. Curcumin content min. 3.0%, deep orange-yellow hue, moisture max. 10%.',
            ],
            [
                'category_id' => $categories['spices-specialty']->id,
                'name' => 'Premium Cumin Seeds (Cuminum cyminum)',
                'slug' => 'premium-cumin-seeds-whole',
                'brand' => 'BRX Spice Desk',
                'price' => 3600.00,
                'original_price' => 3900.00,
                'unit' => 'Metric Ton',
                'stock' => 310,
                'origin' => 'Brazil Origin',
                'image' => 'img/cumin-seeds.webp',
                'is_featured' => false,
                'is_new' => false,
                'description' => 'High purity whole cumin seeds, machine cleaned 99% purity. Characteristic rich aroma, volatile oil min. 2.5%. 25kg bags.',
            ],
            [
                'category_id' => $categories['dairy']->id,
                'name' => 'Instant Full Cream Milk Powder (26% - 28% Fat)',
                'slug' => 'instant-full-cream-milk-powder',
                'brand' => 'BRX Dairy Desk',
                'price' => 3950.00,
                'original_price' => 4200.00,
                'unit' => 'Metric Ton',
                'stock' => 720,
                'origin' => 'Minas Gerais, Brazil',
                'image' => 'img/milk-powder.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Spray-dried instant full cream milk powder with 26-28% milk fat and min. 24% protein. Enriched with vitamins A & D. 25kg kraft paper bags with PE liner.',
            ],
            [
                'category_id' => $categories['fruits-vegetables']->id,
                'name' => 'Fresh Brazilian Export Mangoes (Palmer / Keitt)',
                'slug' => 'fresh-brazilian-export-mangoes',
                'brand' => 'BRX Vale do São Francisco',
                'price' => 1650.00,
                'original_price' => 1800.00,
                'unit' => 'Metric Ton',
                'stock' => 500,
                'origin' => 'Pernambuco, Brazil',
                'image' => 'img/fruits-vegetables.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'GlobalGAP certified fresh Brazilian export mangoes (Palmer & Keitt). Hydrothermic treated for fruit flies, packed in 4kg cartons in refrigerated CA containers.',
            ],

            // --- COOKING OILS & ADDITIONAL COMMODITIES REQUESTED ---
            [
                'category_id' => $categories['oil-sugar']->id,
                'name' => 'Refined Sunflower Oil (Grade A)',
                'slug' => 'refined-sunflower-oil',
                'brand' => 'BRX Agro Global Cooking Oils',
                'price' => 1150.00,
                'original_price' => 1250.00,
                'unit' => 'Metric Ton',
                'stock' => 1500,
                'origin' => 'Mato Grosso / Goiás, Brazil',
                'image' => 'img/sunflower-oil.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => '100% pure refined sunflower oil, Grade A winterized and deodorized. Clear golden-yellow appearance, max acidity 0.1%, smoke point 230°C. Packed in 1L, 2L, 5L PET bottles or flexitanks of 21.5 MT.',
            ],
            [
                'category_id' => $categories['oil-sugar']->id,
                'name' => 'Refined Corn Oil (Pure Maize Oil)',
                'slug' => 'refined-corn-oil',
                'brand' => 'BRX Agro Global Cooking Oils',
                'price' => 1080.00,
                'original_price' => 1180.00,
                'unit' => 'Metric Ton',
                'stock' => 1200,
                'origin' => 'Goiás, Brazil',
                'image' => 'img/corn-oil.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Pure refined corn oil extracted from Brazilian maize germs. High smoke point 232°C, rich in polyunsaturated fats and phytosterols. Packed in consumer bottles or bulk flexitanks.',
            ],
            [
                'category_id' => $categories['oil-sugar']->id,
                'name' => 'Refined Palm Olein Oil (RBD CP8 / CP10)',
                'slug' => 'refined-palm-olein-oil',
                'brand' => 'BRX Agro Global Cooking Oils',
                'price' => 920.00,
                'original_price' => 990.00,
                'unit' => 'Metric Ton',
                'stock' => 1800,
                'origin' => 'Pará, Brazil',
                'image' => 'img/palm-oil.webp',
                'is_featured' => false,
                'is_new' => true,
                'description' => 'Refined, bleached and deodorized (RBD) palm olein CP8/CP10. Superior oxidative stability for commercial frying and industrial food formulation. Delivered in 20L jerrycans, steel drums, or flexitanks.',
            ],
            [
                'category_id' => $categories['oil-sugar']->id,
                'name' => 'Pure Refined Soybean Oil (Food Grade)',
                'slug' => 'pure-refined-soybean-oil',
                'brand' => 'BRX Mato Grosso Oils',
                'price' => 960.00,
                'original_price' => 1040.00,
                'unit' => 'Metric Ton',
                'stock' => 2200,
                'origin' => 'Mato Grosso, Brazil',
                'image' => 'img/soybean-oil.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Triple-refined, 100% pure food-grade soybean oil. Light yellow color, neutral aroma, max moisture 0.05%, iodine value 125-140. Packaged in 900ml/1L/5L bottles, 20L jerrycans, and bulk ISO tanks.',
            ],
            [
                'category_id' => $categories['spices-specialty']->id,
                'name' => 'Premium Green Cardamom Pods (Jumbo Grade)',
                'slug' => 'premium-green-cardamom-pods',
                'brand' => 'BRX Spice Desk',
                'price' => 14500.00,
                'original_price' => 16000.00,
                'unit' => 'Metric Ton',
                'stock' => 85,
                'origin' => 'Bahia, Brazil',
                'image' => 'img/cardamom.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Export-quality whole green cardamom pods, jumbo calibre 7mm-8mm. Vibrant green shade, intense aroma, volatile oil min. 6.5%. Packed in 10kg/25kg airtight master cartons with moisture barrier.',
            ],
            [
                'category_id' => $categories['lentils-pulses']->id,
                'name' => 'Brazilian Whole Green Mung Beans (Sortex Grade)',
                'slug' => 'brazilian-whole-green-mung-beans',
                'brand' => 'BRX Pulses Desk',
                'price' => 890.00,
                'original_price' => 960.00,
                'unit' => 'Metric Ton',
                'stock' => 800,
                'origin' => 'Mato Grosso, Brazil',
                'image' => 'img/green-mung-beans.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Machine cleaned and Sortex color-sorted whole green mung beans (Vigna radiata). High germination rate (min 95%), moisture max 11%, purity min 99%. Available in 25kg / 50kg PP bags.',
            ],
            [
                'category_id' => $categories['nuts-seeds']->id,
                'name' => 'Premium Raw Shelled Almonds (Nonpareil)',
                'slug' => 'premium-raw-almonds-nuts',
                'brand' => 'BRX Agro Global Nuts',
                'price' => 6800.00,
                'original_price' => 7400.00,
                'unit' => 'Metric Ton',
                'stock' => 300,
                'origin' => 'Brazil / Mercosur Origin',
                'image' => 'img/almonds-nuts.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'High-grade whole raw shelled almonds, size 23/25 and 27/30. Screened for uniform shape, rich natural oil content, aflatoxin certified. Vacuum packed in 25lb / 50lb export cartons.',
            ],
            [
                'category_id' => $categories['grains-rice']->id,
                'name' => 'Brazilian Long Grain White Rice (Type 1)',
                'slug' => 'brazilian-long-grain-white-rice',
                'brand' => 'BRX Sul Grains',
                'price' => 620.00,
                'original_price' => 680.00,
                'unit' => 'Metric Ton',
                'stock' => 3200,
                'origin' => 'Rio Grande do Sul, Brazil',
                'image' => 'img/white-rice.webp',
                'is_featured' => true,
                'is_new' => true,
                'description' => 'Premium Brazilian polished long grain white rice, Type 1, max 5% broken. Double-polished, Sortex color sorted, moisture max 14%. Packaged in 5kg, 25kg, 50kg bags or 1 MT big bags.',
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

        $this->call(HeroSlideSeeder::class);
    }
}
