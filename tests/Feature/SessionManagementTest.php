<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SessionManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_check_session_status(): void
    {
        $response = $this->getJson(route('session.status'));

        $response->assertOk()
            ->assertJsonPath('authenticated', false)
            ->assertJsonStructure(['authenticated', 'csrf_token', 'lifetime_minutes', 'expires_in_seconds']);
    }

    public function test_authenticated_user_can_check_session_status_and_ping(): void
    {
        $user = User::factory()->create([
            'name' => 'session_user',
            'email' => 'session@example.com',
        ]);

        $statusResponse = $this->actingAs($user)->getJson(route('session.status'));

        $statusResponse->assertOk()
            ->assertJsonPath('authenticated', true)
            ->assertJsonPath('user.name', 'session_user')
            ->assertJsonPath('user.email', 'session@example.com');

        $pingResponse = $this->actingAs($user)->postJson(route('session.keep-alive'));

        $pingResponse->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonStructure(['status', 'message', 'csrf_token', 'timestamp']);
    }

    public function test_guest_cannot_access_session_devices(): void
    {
        $response = $this->getJson(route('session.devices'));

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_view_active_devices_and_logout_others(): void
    {
        $password = 'Secret#Password2026';
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        // Insert a simulated secondary device session in DB
        DB::table('sessions')->insert([
            'id' => 'secondary_simulated_session_id',
            'user_id' => $user->id,
            'ip_address' => '192.168.1.100',
            'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 Mobile/15E148 Safari/604.1',
            'payload' => 'simulated_payload',
            'last_activity' => now()->subMinutes(15)->timestamp,
        ]);

        $devicesResponse = $this->actingAs($user)->getJson(route('session.devices'));

        $devicesResponse->assertOk()
            ->assertJsonPath('status', 'success');

        // Attempt logout other devices with invalid password
        $failResponse = $this->actingAs($user)->postJson(route('session.logout-other-devices'), [
            'password' => 'WrongPassword',
        ]);

        $failResponse->assertStatus(422);

        // Attempt logout other devices with correct password
        $successResponse = $this->actingAs($user)->postJson(route('session.logout-other-devices'), [
            'password' => $password,
        ]);

        $successResponse->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('message', 'All other browser sessions have been logged out securely.');

        // Verify secondary session was removed from database
        $this->assertDatabaseMissing('sessions', [
            'id' => 'secondary_simulated_session_id',
        ]);
    }
}
