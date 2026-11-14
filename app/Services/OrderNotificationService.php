<?php

namespace App\Services;

use App\Mail\AdminOrderAlertMail;
use App\Mail\OrderConfirmationMail;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderNotificationService
{
    /**
     * Dispatch all notifications for a newly created commodity order.
     * Supports channels: 'whatsapp', 'email', 'both'.
     */
    public function notifyAll(Order $order, string $channel = 'both'): array
    {
        $order->loadMissing('items');

        $channel = in_array(strtolower($channel), ['whatsapp', 'email', 'both']) ? strtolower($channel) : 'both';

        $results = [
            'channel' => $channel,
            'customer_email' => false,
            'company_emails' => [],
            'whatsapp' => null,
            'inquiry_synced' => false,
            'webhook_dispatched' => false,
        ];

        // 1. Dispatch Email Notifications (Customer Confirmation + Company Trade Desk Alert)
        if ($channel === 'email' || $channel === 'both') {
            // Customer Confirmation Mail
            if (! empty($order->customer_email)) {
                try {
                    Mail::to($order->customer_email)->send(new OrderConfirmationMail($order));
                    $results['customer_email'] = true;
                } catch (\Throwable $e) {
                    Log::warning('Customer order confirmation email failed: ' . $e->getMessage(), ['order' => $order->order_number]);
                }
            }

            // Company & Trade Desk Alert Mail
            $recipients = $this->getCompanyRecipients();
            if (! empty($recipients)) {
                try {
                    Mail::to($recipients)->send(new AdminOrderAlertMail($order));
                    $results['company_emails'] = $recipients;
                } catch (\Throwable $e) {
                    Log::warning('Company order alert email failed: ' . $e->getMessage(), ['order' => $order->order_number]);
                }
            }
        }

        // 2. Dispatch WhatsApp Notification to Business Device (+55 11 95835-3433)
        if ($channel === 'whatsapp' || $channel === 'both') {
            try {
                $results['whatsapp'] = $this->dispatchWhatsAppAlert($order, $channel);
            } catch (\Throwable $e) {
                Log::warning('Trade Desk WhatsApp alert failed: ' . $e->getMessage(), ['order' => $order->order_number]);
            }
        }

        // 3. Sync to In-App Trade Desk Inquiries & Messages (for Admin Accountability)
        try {
            $this->createInAppTradeDeskAlert($order, $channel);
            $results['inquiry_synced'] = true;
        } catch (\Throwable $e) {
            Log::warning('Trade Desk in-app order inquiry sync failed: ' . $e->getMessage(), ['order' => $order->order_number]);
        }

        // 4. Dispatch Outbound Webhook (Slack / Discord / Telegram / CRM if configured)
        $webhookUrl = config('services.company.notification_webhook');
        if (! empty($webhookUrl)) {
            try {
                $this->dispatchWebhookNotification($order, $webhookUrl, $channel);
                $results['webhook_dispatched'] = true;
            } catch (\Throwable $e) {
                Log::warning('Order notification webhook failed: ' . $e->getMessage(), ['order' => $order->order_number]);
            }
        }

        Log::info("Company notified of new commodity order #{$order->order_number} via [{$channel}]", [
            'order_id' => $order->id,
            'customer' => $order->customer_name,
            'channel' => $channel,
            'results' => $results,
        ]);

        return $results;
    }

    /**
     * Get unique, sanitized email addresses for company trade desk & administrators.
     */
    public function getCompanyRecipients(): array
    {
        $recipients = [];

        // Primary Trade Desk Email
        $tradeDeskEmail = config('services.company.trade_desk_email', 'brxagroglobal@gmail.com');
        if (filter_var($tradeDeskEmail, FILTER_VALIDATE_EMAIL)) {
            $recipients[] = $tradeDeskEmail;
        }

        // Configured company notification emails (comma-separated support)
        $configured = config('services.company.notification_emails') ?: env('COMPANY_NOTIFICATION_EMAIL');
        if (! empty($configured)) {
            $parts = explode(',', $configured);
            foreach ($parts as $email) {
                $clean = trim($email);
                if (filter_var($clean, FILTER_VALIDATE_EMAIL)) {
                    $recipients[] = $clean;
                }
            }
        }

        // Add registered admin users from database
        try {
            $adminEmails = User::where('role', 'admin')
                ->whereNotNull('email')
                ->pluck('email')
                ->all();
            foreach ($adminEmails as $email) {
                $clean = trim($email);
                if (filter_var($clean, FILTER_VALIDATE_EMAIL)) {
                    $recipients[] = $clean;
                }
            }
        } catch (\Throwable $e) {
            // DB not ready or during unit tests
        }

        // Mail from address fallback if valid and not hello@example.com
        $fromAddress = config('mail.from.address');
        if (! empty($fromAddress) && $fromAddress !== 'hello@example.com' && filter_var($fromAddress, FILTER_VALIDATE_EMAIL)) {
            $recipients[] = $fromAddress;
        }

        return array_values(array_unique(array_filter($recipients)));
    }

    /**
     * Format a clean, professional WhatsApp text notification for the trade desk device.
     */
    public function formatWhatsAppOrderMessage(Order $order, string $channel = 'both'): string
    {
        $itemsText = $order->items->map(function ($item, $idx) {
            $num = $idx + 1;
            return "  {$num}. *{$item->product_name}*\n     Quantity: {$item->quantity} Lot(s) / MT\n     Assay: SGS Inspected & MAPA Cleared";
        })->implode("\n\n");

        $notesText = $order->notes ? "\n\n📝 *Buyer Notes / Assays:*\n" . $order->notes : "";
        $phoneText = $order->customer_phone ?: "Not specified";
        $channelLabel = match ($channel) {
            'whatsapp' => 'WhatsApp Trade Desk Alert',
            'email' => 'Corporate Email Alert',
            default => 'Simultaneous (WhatsApp + Email)',
        };

        return "🚨 *NEW COMMODITY ORDER — BRX AGRO GLOBAL*\n"
            . "━━━━━━━━━━━━━━━━━━━━━━\n"
            . "📋 *Order Reference:* #{$order->order_number}\n"
            . "📅 *Date:* " . ($order->created_at ? $order->created_at->format('Y-m-d H:i') : now()->format('Y-m-d H:i')) . " UTC\n"
            . "📡 *Dispatch Channel:* {$channelLabel}\n\n"
            . "👤 *BUYER ENTITY:*\n"
            . "• Representative: {$order->customer_name}\n"
            . "• Corporate Email: {$order->customer_email}\n"
            . "• Phone / WhatsApp: {$phoneText}\n\n"
            . "🚢 *LOGISTICS & INCOTERMS:*\n"
            . "• Discharge Port: {$order->shipping_address}\n"
            . "• Incoterms: {$order->payment_method}\n"
            . "• Loading Berth: Santos / Paranaguá (Brazil)\n\n"
            . "🌾 *ORDERED COMMODITIES:*\n"
            . "{$itemsText}"
            . "{$notesText}\n\n"
            . "━━━━━━━━━━━━━━━━━━━━━━\n"
            . "⚡ *Action Required:* Trade Desk Officer to contact buyer to confirm vessel schedule and issue draft contract.\n"
            . "🌐 *Admin Portal:* " . url('/admin/orders/' . $order->id);
    }

    /**
     * Dispatch WhatsApp notification to the official company WhatsApp device (+55 11 95835-3433).
     */
    public function dispatchWhatsAppAlert(Order $order, string $channel = 'both'): array
    {
        $targetNumber = config('services.company.whatsapp_raw', '5511958353433');
        $message = $this->formatWhatsAppOrderMessage($order, $channel);
        $encodedText = urlencode($message);
        $directUrl = "https://api.whatsapp.com/send?phone={$targetNumber}&text={$encodedText}";

        $dispatched = false;

        // Automated backend HTTP POST dispatch if WhatsApp Gateway API is configured
        $apiUrl = config('services.company.whatsapp_api_url') ?: env('WHATSAPP_API_URL');
        $apiToken = config('services.company.whatsapp_api_token') ?: env('WHATSAPP_API_TOKEN');

        if (! empty($apiUrl)) {
            try {
                $response = Http::timeout(8)
                    ->withHeaders($apiToken ? ['Authorization' => 'Bearer ' . $apiToken] : [])
                    ->post($apiUrl, [
                        'phone' => $targetNumber,
                        'to' => $targetNumber,
                        'message' => $message,
                        'text' => $message,
                        'order_number' => $order->order_number,
                    ]);
                $dispatched = $response->successful();
            } catch (\Throwable $e) {
                Log::warning('Automated WhatsApp API gateway dispatch failed: ' . $e->getMessage(), ['order' => $order->order_number]);
            }
        }

        Log::info('WhatsApp order notification prepared for company device: +' . $targetNumber, [
            'order' => $order->order_number,
            'target_phone' => '+' . $targetNumber,
            'automated_api_dispatched' => $dispatched,
        ]);

        return [
            'dispatched' => $dispatched,
            'target_phone' => '+' . $targetNumber,
            'whatsapp_url' => $directUrl,
            'message' => $message,
        ];
    }

    /**
     * Create an in-app inquiry record so the order appears immediately
     * in the Trade Desk Inbox and in the Admin Portal (/admin/inquiries).
     */
    protected function createInAppTradeDeskAlert(Order $order, string $channel = 'both'): Inquiry
    {
        $itemsSummary = $order->items->map(function ($item) {
            return "- {$item->product_name} (Qty: {$item->quantity} Lots / MT — Wholesale Specification)";
        })->implode("\n");

        $channelLabel = match ($channel) {
            'whatsapp' => 'Business WhatsApp (+55 11 95835-3433)',
            'email' => 'Business Email (brxagroglobal@gmail.com)',
            default => 'Simultaneous (WhatsApp + Email)',
        };

        $message = "🚨 NEW COMMODITY ORDER PLACED (DISPATCHED VIA {$channelLabel})\n\n"
            . "Order Reference: #{$order->order_number}\n"
            . "Pricing: Quoted upon Destination Port (CIF/FOB)\n"
            . "Customer: {$order->customer_name}\n"
            . "Contact: {$order->customer_email}" . ($order->customer_phone ? " | {$order->customer_phone}" : "") . "\n"
            . "Port / Shipping Address: {$order->shipping_address}\n"
            . "Delivery Terms: {$order->payment_method}\n"
            . ($order->notes ? "Notes: {$order->notes}\n" : "")
            . "\nOrdered Commodities:\n{$itemsSummary}\n\n"
            . "Action Required: Contact buyer to finalize contract specification, verify bank escrow / LC, and assign SGS inspection batch.";

        $lotsCount = $order->items->sum('quantity') ?: $order->items->count();

        return Inquiry::create([
            'name' => $order->customer_name,
            'email' => $order->customer_email,
            'phone' => $order->customer_phone,
            'role' => 'buyer',
            'subject' => "[NEW ORDER #{$order->order_number}] {$order->customer_name} ({$lotsCount} Lots)",
            'message' => $message,
            'status' => 'new',
            'is_read' => false,
        ]);
    }

    /**
     * Dispatch an outbound webhook notification (Slack, Discord, Telegram, or custom ERP).
     */
    protected function dispatchWebhookNotification(Order $order, string $url, string $channel = 'both'): void
    {
        $lotsCount = $order->items->sum('quantity') ?: $order->items->count();

        $payload = [
            'event' => 'commodity_order.created',
            'order_number' => $order->order_number,
            'timestamp' => now()->toIso8601String(),
            'channel' => $channel,
            'pricing_basis' => 'Direct Wholesale Quotation (FOB / CIF)',
            'total_lots' => $lotsCount,
            'customer' => [
                'name' => $order->customer_name,
                'email' => $order->customer_email,
                'phone' => $order->customer_phone,
            ],
            'shipping' => [
                'destination_port' => $order->shipping_address,
                'delivery_terms' => $order->payment_method,
            ],
            'items' => $order->items->map(fn ($item) => [
                'product' => $item->product_name,
                'qty' => $item->quantity,
            ])->toArray(),
            'notes' => $order->notes,
            'admin_url' => url('/admin/orders/' . $order->id),
        ];

        // Format for Slack if webhook URL looks like slack.com/services
        if (str_contains($url, 'slack.com')) {
            $slackText = "🚨 *New Commodity Order #{$order->order_number}* placed by *{$order->customer_name}* ({$lotsCount} Lots)\n"
                . "• Channel: `{$channel}`\n"
                . "• Destination: `{$order->shipping_address}`\n"
                . "• IncoTerms: `{$order->payment_method}`\n"
                . "• Email: <mailto:{$order->customer_email}|{$order->customer_email}>\n"
                . "• Portal: <" . url('/admin/orders/' . $order->id) . "|View in Admin Portal>";
            Http::timeout(5)->post($url, ['text' => $slackText]);
            return;
        }

        Http::timeout(5)->post($url, $payload);
    }
}
