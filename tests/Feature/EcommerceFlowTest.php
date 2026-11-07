<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EcommerceFlowTest extends TestCase
{
    use RefreshDatabase;

    private function createCategoryAndProduct(): array
    {
        $category = Category::create([
            'name' => 'Grains & Oilseeds',
            'slug' => 'grains-oilseeds',
            'description' => 'Brazilian export grains',
            'icon' => 'bi-flower1',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Brazilian Non-GMO Soybeans',
            'slug' => 'brazilian-non-gmo-soybeans',
            'brand' => 'Mato Grosso Harvest',
            'price' => 485.00,
            'original_price' => 520.00,
            'unit' => 'Metric Ton',
            'stock' => 500,
            'origin' => 'Mato Grosso, Brazil',
            'image' => 'img/service-1.jpg',
            'is_featured' => true,
            'is_new' => true,
            'description' => 'Export-grade soybeans with 36% protein.',
        ]);

        return [$category, $product];
    }

    public function test_homepage_renders_dynamic_products_and_categories(): void
    {
        [$category, $product] = $this->createCategoryAndProduct();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Grains & Oilseeds');
        $response->assertSee('Brazilian Non-GMO Soybeans');
        $response->assertSee('$485.00');
    }

    public function test_shop_catalog_and_single_product_pages_render(): void
    {
        [$category, $product] = $this->createCategoryAndProduct();

        $catalog = $this->get('/shop');
        $catalog->assertStatus(200);
        $catalog->assertSee('Brazilian Non-GMO Soybeans');

        $single = $this->get('/shop/' . $product->slug);
        $single->assertStatus(200);
        $single->assertSee('Brazilian Non-GMO Soybeans');
        $single->assertSee('Export Specification Table');
    }

    public function test_cart_operations_and_drawer(): void
    {
        [$category, $product] = $this->createCategoryAndProduct();

        // 1. AJAX Add to Cart
        $addResponse = $this->postJson(route('cart.add', $product), ['quantity' => 2]);
        $addResponse->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('cart_count', 2);

        // 2. View full Cart
        $cartPage = $this->get(route('cart.index'));
        $cartPage->assertStatus(200);
        $cartPage->assertSee('Brazilian Non-GMO Soybeans');
        $cartPage->assertSee('$970.00');

        // 3. Cart Drawer JSON
        $drawer = $this->getJson(route('cart.drawer'));
        $drawer->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('cart_count', 2);
    }

    public function test_checkout_places_order_and_redirects_to_confirmation(): void
    {
        [$category, $product] = $this->createCategoryAndProduct();

        // Add to cart
        $this->postJson(route('cart.add', $product), ['quantity' => 3]);

        // Submit checkout
        $checkoutResponse = $this->post(route('checkout.store'), [
            'customer_name' => 'Hans Schmidt',
            'customer_email' => 'h.schmidt@eurotrade.de',
            'customer_phone' => '+49 40 123456',
            'country' => 'Germany',
            'shipping_address' => 'Port of Hamburg Terminal 3',
            'company' => 'EuroTrade Hamburg GmbH',
            'payment_method' => 'escrow',
            'notes' => 'SGS certificate requested prior to vessel dispatch.',
        ]);

        $checkoutResponse->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Hans Schmidt',
            'customer_email' => 'h.schmidt@eurotrade.de',
            'total_amount' => 1455.00,
            'status' => 'pending',
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_name' => 'Brazilian Non-GMO Soybeans',
            'quantity' => 3,
            'price' => 485.00,
            'subtotal' => 1455.00,
        ]);

        // Verify stock decremented: 500 - 3 = 497
        $this->assertEquals(497, $product->fresh()->stock);
    }
}
