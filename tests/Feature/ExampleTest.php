<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee(route('login'), false);
        $response->assertSee(route('register'), false);
    }

    public function test_homepage_displays_authenticated_user_and_sign_out(): void
    {
        $user = User::factory()->create([
            'name' => 'edrine_buyer',
            'email' => 'buyer@matroltd.com',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee('edrine_buyer');
        $response->assertSee('buyer@matroltd.com');
        $response->assertSee(route('logout'), false);
    }

    public function test_login_and_register_pages_render_design_one_portal(): void
    {
        $loginPage = $this->get('/login');
        $loginPage->assertStatus(200);
        $loginPage->assertSee('Login');
        $loginPage->assertSee('Register');
        $loginPage->assertSee('Back to Homepage');
        $loginPage->assertSee(route('home'), false);
        $loginPage->assertDontSee('Login | Signup Animation');

        $registerPage = $this->get('/register');
        $registerPage->assertStatus(200);
        $registerPage->assertSee('container active', false);
        $registerPage->assertSee('Back to Homepage');
    }

    public function test_users_can_register_and_sign_in(): void
    {
        $registerResponse = $this->postJson('/register', [
            'username' => 'edrine_user',
            'email' => 'edrine@example.com',
            'password' => 'StrongPass#2026',
        ]);

        $registerResponse->assertStatus(201)
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('username', 'edrine_user');

        $this->assertDatabaseHas('users', [
            'name' => 'edrine_user',
            'email' => 'edrine@example.com',
        ]);

        $loginResponse = $this->postJson('/login', [
            'username' => 'edrine_user',
            'password' => 'StrongPass#2026',
        ]);

        $loginResponse->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('username', 'edrine_user');

        $this->assertAuthenticated();
    }

    public function test_authenticated_users_can_sign_out(): void
    {
        $user = User::factory()->create([
            'name' => 'ronald_user',
        ]);

        $response = $this->actingAs($user)->postJson('/logout');

        $response->assertOk()
            ->assertJsonPath('status', 'success');

        $this->assertGuest();
    }

    public function test_authenticated_user_account_portal_renders_without_errors(): void
    {
        $user = User::factory()->create([
            'name' => 'client_buyer',
            'email' => 'client@buyer.com',
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)->get('/');
        $response->assertOk();
        $response->assertSee('id="agroviaAccountModal"', false);
        $response->assertSee('client_buyer');
        $response->assertSee('Verified Commodity Buyer');
        $response->assertSee('data-bs-target="#agroviaAccountModal"', false);

        // Regular user accessing /account redirects to /#account without error
        $accountRedirect = $this->actingAs($user)->get('/account');
        $accountRedirect->assertRedirect(route('home').'#account');
    }

    public function test_admin_user_account_redirects_to_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'name' => 'admin_user',
            'email' => 'admin@matro.com',
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/account');
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_seo_metadata_structured_data_and_sitemap_xml_render_correctly(): void
    {
        config(['services.google.site_verification' => 'gsc-test-token-12345']);

        $home = $this->get('/');
        $home->assertStatus(200);
        $home->assertSee('<link rel="canonical"', false);
        $home->assertSee('property="og:title"', false);
        $home->assertSee('name="twitter:card"', false);
        $home->assertSee('name="google-site-verification" content="gsc-test-token-12345"', false);
        $home->assertSee('application/ld+json', false);
        $home->assertSee('38.471.480/0001-41', false);

        $robots = $this->get('/robots.txt');
        $robots->assertStatus(200);
        $robots->assertSee('Sitemap: ' . url('/sitemap.xml'), false);
        $robots->assertSee('Disallow: /admin', false);

        $sitemap = $this->get('/sitemap.xml');
        $sitemap->assertStatus(200);
        $sitemap->assertHeader('Content-Type', 'application/xml; charset=utf-8');
        $sitemap->assertSee('<urlset', false);
        $sitemap->assertSee(route('login'), false);
        $sitemap->assertSee(route('register'), false);
    }
}
