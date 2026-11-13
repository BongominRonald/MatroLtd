<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;
use Mockery;
use Tests\TestCase;

class GoogleAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_google_redirect_informs_user_when_credentials_unconfigured(): void
    {
        config(['services.google.client_id' => '']);
        config(['services.google.client_secret' => '']);

        $response = $this->get(route('auth.google'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('toast_error');
    }

    public function test_google_callback_creates_and_authenticates_user(): void
    {
        config(['services.google.client_id' => 'mock-client-id']);
        config(['services.google.client_secret' => 'mock-client-secret']);

        $abstractUser = Mockery::mock(\Laravel\Socialite\Two\User::class);
        $abstractUser->shouldReceive('getId')->andReturn('google-unique-id-9988');
        $abstractUser->shouldReceive('getName')->andReturn('Elena Rostova');
        $abstractUser->shouldReceive('getEmail')->andReturn('elena.rostova@globalagro.com');
        $abstractUser->shouldReceive('getAvatar')->andReturn('https://lh3.googleusercontent.com/avatar-mock');

        $provider = Mockery::mock(\Laravel\Socialite\Two\GoogleProvider::class);
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $response = $this->get(route('auth.google.callback'));

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();

        $user = User::where('email', 'elena.rostova@globalagro.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('google-unique-id-9988', $user->google_id);
    }
}
