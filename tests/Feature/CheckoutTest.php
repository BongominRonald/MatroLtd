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

    public function test_guest_client_can_place_commodity_order_without_account(): void
    {
        Mail::fake();

        $payload = [
            'customer_name' => 'Anonymous Trader',
            'customer_email' => 'guest@example.com',
            'channel' => 'both',
            'items' => [
                [
                    'name' => 'Brazilian Non-GMO Soybeans',
                    'qty' => 1,
                ],
            ],
        ];

        $response = $this->postJson(route('checkout.store'), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => null,
            'customer_name' => 'Anonymous Trader',
            'customer_email' => 'guest@example.com',
        ]);
        $this->assertDatabaseCount('order_items', 1);

        Mail::assertSent(AdminOrderAlertMail::class);
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

    public function test_legitimate_inquiry_without_honeypot_is_saved_and_emailed(): void
    {
        Mail::fake();

        $response = $this->postJson(route('inquiries.store'), [
            'name' => 'Marco Silva',
            'email' => 'marco@rotterdamtrade.nl',
            'company' => 'Rotterdam Agri BV',
            'country' => 'Netherlands',
            'buyer_detail' => 'Brazilian Non-GMO Soybeans',
            'message' => 'Requesting CIF Rotterdam quote for 2,500 MT.',
            'company_website_url' => '',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('success', true);

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Marco Silva',
            'email' => 'marco@rotterdamtrade.nl',
            'status' => 'new',
        ]);
    }

    public function test_honeypot_blocks_spam_bot_inquiry_from_saving_or_emailing(): void
    {
        Mail::fake();

        $response = $this->postJson(route('inquiries.store'), [
            'name' => 'Spam Bot',
            'email' => 'bot@spammer.example.com',
            'company' => 'Spam Corp',
            'buyer_detail' => 'Brazilian Non-GMO Soybeans',
            'message' => 'Buy cheap backlinks at http://spammer.example.com',
            'company_website_url' => 'http://spammer.example.com',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('success', true);

        $this->assertDatabaseMissing('inquiries', [
            'email' => 'bot@spammer.example.com',
        ]);

        Mail::assertNothingSent();
    }

    public function test_callmebot_whatsapp_dispatches_realtime_to_company_device(): void
    {
        Mail::fake();
        Http::fake([
            'api.callmebot.com/*' => Http::response('OK', 200),
        ]);

        config([
            'services.company.callmebot_api_key' => 'test_callmebot_key_123',
            'services.company.whatsapp_raw' => '5511958353433',
        ]);

        $response = $this->postJson(route('checkout.store'), [
            'customer_name' => 'CallMeBot Buyer',
            'customer_email' => 'buyer@callmebot-test.com',
            'channel' => 'whatsapp',
            'items' => [
                [
                    'name' => 'Brazilian Non-GMO Soybeans',
                    'qty' => 10,
                ],
            ],
        ]);

        $response->assertStatus(200);

        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'api.callmebot.com/whatsapp.php')
                && str_contains($request->url(), '5511958353433')
                && str_contains($request->url(), 'apikey=test_callmebot_key_123');
        });
    }

    public function test_meta_cloud_api_whatsapp_dispatches_realtime_to_company_device(): void
    {
        Mail::fake();
        Http::fake([
            'graph.facebook.com/*' => Http::response(['messaging_product' => 'whatsapp'], 200),
        ]);

        config([
            'services.company.callmebot_api_key' => null,
            'services.company.whatsapp_cloud_token' => 'meta_test_cloud_token',
            'services.company.whatsapp_phone_number_id' => '10987654321',
            'services.company.whatsapp_raw' => '5511958353433',
        ]);

        $response = $this->postJson(route('checkout.store'), [
            'customer_name' => 'Meta Cloud Buyer',
            'customer_email' => 'buyer@metacloud-test.com',
            'channel' => 'whatsapp',
            'items' => [
                [
                    'name' => 'Refined Cane Sugar (ICUMSA 45)',
                    'qty' => 5,
                ],
            ],
        ]);

        $response->assertStatus(200);

        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'graph.facebook.com/v19.0/10987654321/messages')
                && $request->hasHeader('Authorization', 'Bearer meta_test_cloud_token')
                && $request['to'] === '5511958353433';
        });
    }

    public function test_resend_api_fallback_delivers_realtime_email_when_configured(): void
    {
        Mail::fake();
        Http::fake([
            'api.resend.com/emails' => Http::response(['id' => 're_email_12345'], 200),
        ]);

        config([
            'services.resend.key' => 're_test_resend_key_999',
            'mail.default' => 'log',
            'services.company.trade_desk_email' => 'brxagroglobal@gmail.com',
        ]);

        $response = $this->postJson(route('checkout.store'), [
            'customer_name' => 'Resend Test Buyer',
            'customer_email' => 'buyer@resend-test.com',
            'channel' => 'email',
            'items' => [
                [
                    'name' => 'Brazilian Yellow Corn Grade 2',
                    'qty' => 3,
                ],
            ],
        ]);

        $response->assertStatus(200);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://api.resend.com/emails'
                && $request->hasHeader('Authorization', 'Bearer re_test_resend_key_999')
                && in_array('brxagroglobal@gmail.com', $request['to']);
        });
    }
}
