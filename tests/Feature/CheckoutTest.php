<?php

namespace Tests\Feature;

use App\Mail\AdminOrderAlertMail;
use App\Mail\OrderConfirmationMail;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_place_commodity_order_without_prices_via_checkout_endpoint(): void
    {
        Mail::fake();

        $user = User::factory()->create([
            'name' => 'John Exporting Ltd',
            'email' => 'procurement@johnexport.com',
        ]);

        $payload = [
            'customer_name' => 'John Exporting Ltd',
            'customer_email' => 'procurement@johnexport.com',
            'customer_phone' => '+1 (555) 998-1122',
            'shipping_address' => 'Port of Rotterdam (NLRTM) - CIF',
            'payment_method' => 'CIF — Cost, Insurance & Freight',
            'channel' => 'both',
            'notes' => 'Request SGS pre-shipment assay certificate and MAPA phytosanitary clearance.',
            'items' => [
                [
                    'name' => 'Brazilian Non-GMO Soybeans',
                    'unit' => 'MT',
                    'qty' => 2,
                ],
                [
                    'name' => 'Refined Cane Sugar (ICUMSA 45)',
                    'unit' => 'MT',
                    'qty' => 1,
                ],
            ],
        ];

        $response = $this->actingAs($user)->postJson(route('checkout.store'), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'channel' => 'both',
        ]);
        $this->assertStringContainsString('5511958353433', $response->json('whatsapp_url'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'customer_name' => 'John Exporting Ltd',
            'customer_email' => 'procurement@johnexport.com',
            'total_amount' => 0.00,
            'status' => 'pending',
        ]);

        $order = Order::where('customer_email', 'procurement@johnexport.com')->first();
        $this->assertNotNull($order);
        $this->assertStringStartsWith('BRX-ORD-', $order->order_number);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'quantity' => 2,
            'price' => 0.00,
            'subtotal' => 0.00,
        ]);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'quantity' => 1,
            'price' => 0.00,
            'subtotal' => 0.00,
        ]);

        Mail::assertSent(OrderConfirmationMail::class, function ($mail) {
            return $mail->hasTo('procurement@johnexport.com');
        });

        Mail::assertSent(AdminOrderAlertMail::class);
    }

    public function test_unauthenticated_guest_cannot_place_order_via_checkout_endpoint(): void
    {
        $payload = [
            'customer_name' => 'Anonymous Trader',
            'customer_email' => 'guest@example.com',
            'items' => [
                [
                    'name' => 'Brazilian Non-GMO Soybeans',
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

    public function test_authenticated_user_can_choose_whatsapp_channel_only(): void
    {
        Mail::fake();

        $user = User::factory()->create([
            'name' => 'Agri Trader Asia',
            'email' => 'trader@agri-asia.com',
        ]);

        $payload = [
            'customer_name' => 'Agri Trader Asia',
            'customer_email' => 'trader@agri-asia.com',
            'channel' => 'whatsapp',
            'items' => [
                [
                    'name' => 'Yellow Corn (Maize Grade 2)',
                    'qty' => 3,
                ],
            ],
        ];

        $response = $this->actingAs($user)->postJson(route('checkout.store'), $payload);

        $response->assertStatus(200);
        $response->assertJsonPath('channel', 'whatsapp');
        $this->assertStringContainsString('5511958353433', $response->json('whatsapp_url'));

        // Customer chose WhatsApp only, so company email is not dispatched, but WhatsApp alert is logged
        Mail::assertNotSent(AdminOrderAlertMail::class);

        // In-app inquiry is always recorded for admin accountability
        $this->assertDatabaseHas('inquiries', [
            'email' => 'trader@agri-asia.com',
            'role' => 'buyer',
            'status' => 'new',
        ]);
    }

    public function test_authenticated_user_can_choose_email_channel_only(): void
    {
        Mail::fake();

        $user = User::factory()->create([
            'name' => 'European Grains BV',
            'email' => 'procurement@eurograins.nl',
        ]);

        $payload = [
            'customer_name' => 'European Grains BV',
            'customer_email' => 'procurement@eurograins.nl',
            'channel' => 'email',
            'items' => [
                [
                    'name' => 'Arabica Green Coffee Beans',
                    'qty' => 2,
                ],
            ],
        ];

        $response = $this->actingAs($user)->postJson(route('checkout.store'), $payload);

        $response->assertStatus(200);
        $response->assertJsonPath('channel', 'email');

        Mail::assertSent(AdminOrderAlertMail::class);
        Mail::assertSent(OrderConfirmationMail::class, function ($mail) {
            return $mail->hasTo('procurement@eurograins.nl');
        });
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

    public function test_company_is_notified_via_email_inquiry_sync_and_webhook_when_customer_orders(): void
    {
        Mail::fake();
        Http::fake();

        // Create an admin user who should receive notifications
        $admin = User::factory()->create([
            'name' => 'Trade Desk Chief Officer',
            'email' => 'admin-officer@brxagroglobal.com',
            'role' => 'admin',
        ]);

        // Configure custom company notification email and webhook URL
        config([
            'services.company.notification_emails' => 'tradedesk@brxagroglobal.com,operations@brxagroglobal.com',
            'services.company.notification_webhook' => 'https://hooks.slack.com/services/test/alert/sample',
        ]);

        $customer = User::factory()->create([
            'name' => 'Shanghai Agri Import Corp',
            'email' => 'procurement@shanghai-agri.cn',
        ]);

        $payload = [
            'customer_name' => 'Shanghai Agri Import Corp',
            'customer_email' => 'procurement@shanghai-agri.cn',
            'customer_phone' => '+86 21 8899 7700',
            'shipping_address' => 'Shanghai Port (CNSHA) - CIF Incoterms 2020',
            'payment_method' => 'CIF — Cost, Insurance & Freight',
            'channel' => 'both',
            'notes' => 'Requires CIQ clearance and non-GMO certification.',
            'items' => [
                [
                    'name' => 'Brazilian Yellow Corn Grade 2',
                    'unit' => 'MT',
                    'qty' => 5,
                ],
            ],
        ];

        $response = $this->actingAs($customer)->postJson(route('checkout.store'), $payload);

        $response->assertStatus(200);
        $response->assertJsonPath('notifications.company_alerted', true);
        $response->assertJsonPath('notifications.desk_inbox_synced', true);

        // Assert company trade desk alert mail sent to company recipients and admin
        Mail::assertSent(AdminOrderAlertMail::class, function ($mail) {
            return $mail->hasTo('tradedesk@brxagroglobal.com')
                && $mail->hasTo('operations@brxagroglobal.com')
                && $mail->hasTo('admin-officer@brxagroglobal.com');
        });

        // Assert in-app inquiry was created to alert trade desk officers
        $this->assertDatabaseHas('inquiries', [
            'email' => 'procurement@shanghai-agri.cn',
            'role' => 'buyer',
            'status' => 'new',
            'is_read' => false,
        ]);

        // Assert outbound webhook was dispatched
        Http::assertSent(function ($request) {
            return $request->url() === 'https://hooks.slack.com/services/test/alert/sample'
                && str_contains($request->body(), 'Shanghai Agri Import Corp');
        });
    }
}
