<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_place_commodity_order_via_checkout_endpoint(): void
    {
        $user = User::factory()->create([
            'name' => 'John Exporting Ltd',
            'email' => 'procurement@johnexport.com',
        ]);

        $payload = [
            'customer_name' => 'John Exporting Ltd',
            'customer_email' => 'procurement@johnexport.com',
            'customer_phone' => '+1 (555) 998-1122',
            'shipping_address' => 'Port of Rotterdam (NLRTM) - CIF',
            'payment_method' => 'Tier-1 Bank Escrow (Irrevocable LC / MT700)',
            'notes' => 'Request SGS pre-shipment assay certificate and MAPA phytosanitary clearance.',
            'items' => [
                [
                    'name' => 'Brazilian Non-GMO Soybeans',
                    'price' => 485.00,
                    'qty' => 2,
                ],
                [
                    'name' => 'Refined Cane Sugar (ICUMSA 45)',
                    'price' => 540.00,
                    'qty' => 1,
                ],
            ],
        ];

        $response = $this->actingAs($user)->postJson(route('checkout.store'), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'total' => '1,510.00',
        ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'customer_name' => 'John Exporting Ltd',
            'customer_email' => 'procurement@johnexport.com',
            'total_amount' => 1510.00,
            'status' => 'pending',
        ]);

        $order = Order::where('customer_email', 'procurement@johnexport.com')->first();
        $this->assertNotNull($order);
        $this->assertStringStartsWith('BRX-ORD-', $order->order_number);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_name' => 'Brazilian Non-GMO Soybeans',
            'quantity' => 2,
            'subtotal' => 970.00,
        ]);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_name' => 'Refined Cane Sugar (ICUMSA 45)',
            'quantity' => 1,
            'subtotal' => 540.00,
        ]);
    }

    public function test_unauthenticated_guest_cannot_place_order_via_checkout_endpoint(): void
    {
        $payload = [
            'customer_name' => 'Anonymous Trader',
            'customer_email' => 'guest@example.com',
            'items' => [
                [
                    'name' => 'Brazilian Non-GMO Soybeans',
                    'price' => 485.00,
                    'qty' => 1,
                ],
            ],
        ];

        $response = $this->postJson(route('checkout.store'), $payload);

        $response->assertStatus(401);
        $response->assertJson([
            'success' => false,
            'message' => 'Authentication required. Please log in to place a commodity order.',
        ]);

        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('order_items', 0);
    }

    public function test_authenticated_user_id_is_recorded_with_order(): void
    {
        $user = User::factory()->create([
            'name' => 'Corporate Buyer',
            'email' => 'buyer@institutional.com',
        ]);

        $payload = [
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'items' => [
                [
                    'name' => 'Yellow Corn (Maize Grade 2)',
                    'price' => 245.00,
                    'qty' => 3,
                ],
            ],
        ];

        $response = $this->actingAs($user)->postJson(route('checkout.store'), $payload);

        $response->assertStatus(200);
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'customer_email' => 'buyer@institutional.com',
            'total_amount' => 735.00,
        ]);
    }

    public function test_checkout_requires_valid_items_and_contact_info(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('checkout.store'), [
            'customer_name' => '',
            'customer_email' => 'not-an-email',
            'items' => [],
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['customer_name', 'customer_email', 'items']);
    }
}
