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
}
