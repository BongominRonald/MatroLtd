<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\HeroSlide;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'name' => 'Super Administrator',
            'email' => 'admin@matro.com',
            'role' => 'admin',
        ]);
    }

    public function test_guest_is_redirected_away_from_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_regular_user_is_forbidden_from_admin_dashboard(): void
    {
        $regularUser = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($regularUser)->get('/admin');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_dashboard_and_views(): void
    {
        $category = Category::create(['name' => 'Grains', 'slug' => 'grains']);
        Product::create([
            'name' => 'Soybeans Test',
            'slug' => 'soybeans-test',
            'category_id' => $category->id,
            'price' => 0,
            'stock' => 1000,
            'is_active' => true,
        ]);

        $order = Order::create([
            'order_number' => 'BRX-ORD-TEST1234',
            'customer_name' => 'Test Buyer Admin',
            'customer_email' => 'buyer@test-admin.com',
            'total_amount' => 0,
            'status' => 'pending',
            'shipping_address' => 'Santos Port',
            'payment_method' => 'FOB',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_name' => 'Soybeans Test',
            'price' => 0,
            'quantity' => 10,
            'subtotal' => 0,
        ]);

        $inquiry = Inquiry::create([
            'name' => 'Test Inquirer',
            'email' => 'inq@test.com',
            'subject' => 'Quote Request',
            'message' => 'Need 500 MT',
            'status' => 'new',
            'is_read' => false,
        ]);

        // Dashboard
        $this->actingAs($this->admin)->get('/admin')->assertStatus(200);

        // Orders List & Show
        $this->actingAs($this->admin)->get('/admin/orders')->assertStatus(200)->assertSee('BRX-ORD-TEST1234');
        $this->actingAs($this->admin)->get("/admin/orders/{$order->id}")->assertStatus(200)->assertSee('Test Buyer Admin');

        // Inquiries List & Show
        $this->actingAs($this->admin)->get('/admin/inquiries')->assertStatus(200)->assertSee('Test Inquirer');
        $this->actingAs($this->admin)->get("/admin/inquiries/{$inquiry->id}")->assertStatus(200);

        // Products List
        $this->actingAs($this->admin)->get('/admin/products')->assertStatus(200)->assertSee('Soybeans Test');

        // Categories List
        $this->actingAs($this->admin)->get('/admin/categories')->assertStatus(200)->assertSee('Grains');

        // Users List
        $this->actingAs($this->admin)->get('/admin/users')->assertStatus(200)->assertSee('admin@matro.com');

        // Profile
        $this->actingAs($this->admin)->get('/admin/profile')->assertStatus(200);
    }

    public function test_admin_can_update_order_status(): void
    {
        $order = Order::create([
            'order_number' => 'BRX-ORD-STATUS99',
            'customer_name' => 'Status Buyer',
            'customer_email' => 'status@test.com',
            'total_amount' => 0,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)->post("/admin/orders/{$order->id}/status", [
            'status' => 'confirmed',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'confirmed',
        ]);
    }

    public function test_admin_can_update_inquiry_status_and_read_state(): void
    {
        $inquiry = Inquiry::create([
            'name' => 'Read Inquirer',
            'email' => 'read@test.com',
            'subject' => 'Read State Test',
            'message' => 'Testing read toggle',
            'status' => 'new',
            'is_read' => false,
        ]);

        // Toggle Read
        $response = $this->actingAs($this->admin)->post("/admin/inquiries/{$inquiry->id}/toggle-read");
        $response->assertRedirect();
        $this->assertDatabaseHas('inquiries', [
            'id' => $inquiry->id,
            'is_read' => true,
        ]);

        // Update Status
        $response = $this->actingAs($this->admin)->post("/admin/inquiries/{$inquiry->id}/status", [
            'status' => 'resolved',
        ]);
        $response->assertRedirect();
        $this->assertDatabaseHas('inquiries', [
            'id' => $inquiry->id,
            'status' => 'resolved',
        ]);
    }

    public function test_admin_can_send_test_notification(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/notifications/test', [
            'email' => 'admin-verify@matro.com',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');
    }
}