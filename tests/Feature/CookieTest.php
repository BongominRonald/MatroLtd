<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CookieTest extends TestCase
{
    use RefreshDatabase;
    public function test_homepage_includes_cookie_consent_banner_and_governance_modals(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('brxCookieBanner');
        $response->assertSee('cookiePreferencesModal');
        $response->assertSee('cookiePolicyModal');
        $response->assertSee('btnFloatingCookieConsent');
        $response->assertSee('BRXCookieManager');
        $response->assertSee('We value your privacy', false);
        $response->assertSee('LGPD', false);
        $response->assertSee('GDPR', false);
        $response->assertSee('Strictly Necessary &amp; Security Cookies', false);
    }

    public function test_post_cookie_consent_records_preferences_and_returns_cookie(): void
    {
        $payload = [
            'essential' => true,
            'functional' => true,
            'analytics' => false,
            'marketing' => false,
        ];

        $response = $this->postJson(route('cookies.consent'), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'consent' => [
                'essential' => true,
                'functional' => true,
                'analytics' => false,
                'marketing' => false,
                'version' => '1.0',
            ],
        ]);

        $response->assertCookie('brx_cookie_consent');
    }

    public function test_get_cookie_consent_status_returns_state(): void
    {
        // Unconsented initial state
        $response = $this->getJson(route('cookies.status'));
        $response->assertStatus(200);
        $response->assertJson([
            'has_consented' => false,
            'consent' => null,
        ]);

        // Consented state: post consent, then verify status
        $postRes = $this->postJson(route('cookies.consent'), [
            'functional' => true,
            'analytics' => true,
            'marketing' => false,
        ]);
        $postRes->assertStatus(200);

        $consentData = [
            'essential' => true,
            'functional' => true,
            'analytics' => true,
            'marketing' => false,
            'version' => '1.0',
        ];

        $responseWithCookie = $this->call('GET', route('cookies.status'), [], ['brx_cookie_consent' => json_encode($consentData)]);

        $responseWithCookie->assertStatus(200);
        $responseWithCookie->assertJson([
            'has_consented' => true,
            'consent' => [
                'essential' => true,
                'functional' => true,
                'analytics' => true,
                'marketing' => false,
            ],
        ]);
    }
}
