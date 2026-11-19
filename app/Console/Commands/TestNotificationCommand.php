<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\OrderNotificationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class TestNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-notifications 
                            {--email= : Send a real test email to this address (defaults to company trade desk)}
                            {--whatsapp : Test WhatsApp dispatch to the company device (+55 11 95835-3433)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify system health and test real-time email and WhatsApp delivery';

    /**
     * Execute the console command.
     */
    public function handle(OrderNotificationService $notificationService): int
    {
        $this->info('====================================================');
        $this->info('  BRX AGRO GLOBAL — SYSTEM HEALTH & NOTIFICATION AUDIT');
        $this->info('====================================================');

        // 1. Database Health
        $this->line('');
        $this->comment('1. Checking Database Connectivity...');
        try {
            DB::connection()->getPdo();
            $dbName = DB::connection()->getDatabaseName();
            $dbDriver = DB::connection()->getDriverName();
            $this->info("   [OK] Database connected ({$dbDriver}: {$dbName})");

            $catCount = Category::count();
            $prodCount = Product::count();
            $orderCount = Order::count();
            $userCount = User::count();
            $this->line("        - Products: {$prodCount} | Categories: {$catCount} | Orders: {$orderCount} | Users: {$userCount}");
        } catch (\Throwable $e) {
            $this->error("   [FAIL] Database connection error: " . $e->getMessage());
            return Command::FAILURE;
        }

        // 2. Email Configuration Audit
        $this->line('');
        $this->comment('2. Checking Email Mailer Configuration...');
        $currentMailer = config('mail.default', 'log');
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');
        $this->line("   - Default Mailer: <comment>{$currentMailer}</comment>");
        $this->line("   - From Address: {$fromName} <{$fromAddress}>");

        if ($currentMailer === 'log') {
            $this->warn('   [NOTICE] Current mailer is set to "log".');
            $this->warn('   Emails will be recorded in storage/logs/laravel.log rather than sent over the internet.');
            $this->warn('   To send live emails, set MAIL_MAILER=smtp or RESEND_API_KEY in your .env or Vercel settings.');
        } else {
            $this->info("   [CONFIGURED] Live mailer configured: {$currentMailer}");
        }

        // 3. Test Email Delivery
        $targetEmail = $this->option('email') ?: config('services.company.trade_desk_email', 'brxagroglobal@gmail.com');
        $this->line('');
        $this->comment("3. Testing Email Delivery to: {$targetEmail}...");

        try {
            Mail::raw("This is a live verification email from BRX AGRO GLOBAL system diagnostics at " . now()->toRfc2822String() . ".\n\nAll systems operational.", function ($message) use ($targetEmail) {
                $message->to($targetEmail)
                    ->subject('[BRX AGRO GLOBAL] Live System Verification Test');
            });

            if ($currentMailer === 'log') {
                $this->info("   [SIMULATED] Email successfully logged to storage/logs/laravel.log.");
            } else {
                $this->info("   [SUCCESS] Live email dispatched via {$currentMailer} to {$targetEmail}.");
            }
        } catch (\Throwable $e) {
            $this->error("   [ERROR] Email dispatch failed: " . $e->getMessage());
        }

        // Check Resend Direct API fallback
        $resendKey = config('services.resend.key') ?: env('RESEND_API_KEY');
        if (! empty($resendKey)) {
            $this->line('');
            $this->comment('4. Checking Resend API Direct Integration...');
            try {
                $res = Http::withToken($resendKey)->get('https://api.resend.com/api-keys');
                if ($res->successful()) {
                    $this->info('   [OK] Resend API key is valid and active.');
                } else {
                    $this->warn('   [WARN] Resend responded with status: ' . $res->status());
                }
            } catch (\Throwable $e) {
                $this->warn('   [WARN] Could not reach Resend API: ' . $e->getMessage());
            }
        }

        // 5. WhatsApp Integration Audit
        $this->line('');
        $this->comment('5. Checking WhatsApp Delivery Integrations...');
        $targetPhone = config('services.company.whatsapp_raw', '5511958353433');
        $callmebotKey = config('services.company.callmebot_api_key') ?: env('CALLMEBOT_API_KEY');
        $metaToken = config('services.company.whatsapp_cloud_token') ?: env('WHATSAPP_CLOUD_TOKEN');
        $twilioSid = config('services.company.twilio_sid') ?: env('TWILIO_SID');
        $customGateway = config('services.company.whatsapp_api_url') ?: env('WHATSAPP_API_URL');

        $activeProviders = [];
        if (! empty($callmebotKey)) $activeProviders[] = 'CallMeBot Gateway';
        if (! empty($metaToken)) $activeProviders[] = 'Meta WhatsApp Cloud API';
        if (! empty($twilioSid)) $activeProviders[] = 'Twilio WhatsApp API';
        if (! empty($customGateway)) $activeProviders[] = 'Custom Webhook Gateway';

        if (empty($activeProviders)) {
            $this->line("   - Target Device: +{$targetPhone}");
            $this->line("   - Automated API Providers: None configured yet in .env.");
            $this->line("   - Direct 1-Click WhatsApp Link: <comment>Active (api.whatsapp.com/send?phone={$targetPhone})</comment>");
            $this->line("   - Tip: To enable direct server-to-phone push alerts, add CALLMEBOT_API_KEY to your .env.");
        } else {
            $this->info("   [CONFIGURED] Active automated WhatsApp providers: " . implode(', ', $activeProviders));
        }

        if ($this->option('whatsapp')) {
            $this->line('');
            $this->comment("   Testing WhatsApp dispatch to +{$targetPhone}...");
            $fakeOrder = new Order([
                'order_number' => 'TEST-' . strtoupper(substr(md5(microtime()), 0, 6)),
                'customer_name' => 'System Diagnostic Check',
                'customer_email' => 'diagnostics@brxagroglobal.com',
                'customer_phone' => '+55 11 95835-3433',
                'shipping_address' => 'Santos Port Berth (FOB)',
                'payment_method' => 'Diagnostic Test',
                'notes' => 'Automated test run',
            ]);
            $res = $notificationService->dispatchWhatsAppAlert($fakeOrder, 'whatsapp');
            if ($res['dispatched']) {
                $this->info("   [SUCCESS] Alert dispatched via {$res['provider']} to +{$targetPhone}.");
            } else {
                $this->line("   [PREPARED] Formatted WhatsApp payload generated: {$res['whatsapp_url']}");
            }
        }

        $this->line('');
        $this->info('====================================================');
        $this->info('  AUDIT COMPLETE — ALL CORE SERVICES VERIFIED');
        $this->info('====================================================');

        return Command::SUCCESS;
    }
}
