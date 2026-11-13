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
     */
    public function notifyAll(Order $order): array
    {
        $order->loadMissing('items');

        $results = [
            'customer_email' => false,
            'company_emails' => [],
            'inquiry_synced' => false,
            'webhook_dispatched' => false,
        ];

        // 1. Notify Customer (Order Confirmation)
        if (! empty($order->customer_email)) {
            try {
                Mail::to($order->customer_email)->send(new OrderConfirmationMail($order));
                $results['customer_email'] = true;
            } catch (\Throwable $e) {
                Log::warning('Customer order confirmation email failed: ' . $e->getMessage(), ['order' => $order->order_number]);
            }
        }

        // 2. Notify Company & Trade Desk
        $recipients = $this->getCompanyRecipients();
        if (! empty($recipients)) {
            try {
                Mail::to($recipients)->send(new AdminOrderAlertMail($order));
                $results['company_emails'] = $recipients;
            } catch (\Throwable $e) {
                Log::warning('Company order alert email failed: ' . $e->getMessage(), ['order' => $order->order_number]);
            }
        }

        // 3. Sync to In-App Trade Desk Inquiries & Messages
        try {
            $this->createInAppTradeDeskAlert($order);
            $results['inquiry_synced'] = true;
        } catch (\Throwable $e) {
            Log::warning('Trade Desk in-app order inquiry sync failed: ' . $e->getMessage(), ['order' => $order->order_number]);
        }

        // 4. Dispatch Webhook (Slack / Discord / Telegram / CRM if configured)
        $webhookUrl = config('services.company.notification_webhook');
        if (! empty($webhookUrl)) {
            try {
                $this->dispatchWebhookNotification($order, $webhookUrl);
                $results['webhook_dispatched'] = true;
            } catch (\Throwable $e) {
                Log::warning('Order notification webhook failed: ' . $e->getMessage(), ['order' => $order->order_number]);
            }
        }

        Log::info('Company notified of new commodity order #' . $order->order_number, [
            'order_id' => $order->id,
            'customer' => $order->customer_name,
            'total' => $order->total_amount,
            'company_recipients' => $recipients,
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

        // Primary Trade Desk Email Fallback
        $tradeDeskEmail = config('services.company.trade_desk_email', 'tradedesk@brxagroglobal.com');
        if (filter_var($tradeDeskEmail, FILTER_VALIDATE_EMAIL)) {
            $recipients[] = $tradeDeskEmail;
        }

        // Mail from address fallback if valid and not hello@example.com
        $fromAddress = config('mail.from.address');
        if (! empty($fromAddress) && $fromAddress !== 'hello@example.com' && filter_var($fromAddress, FILTER_VALIDATE_EMAIL)) {
            $recipients[] = $fromAddress;
        }

        return array_values(array_unique(array_filter($recipients)));
    }

    /**
     * Create an in-app inquiry record so the order appears immediately
     * in the Trade Desk Inbox and in the Admin Portal (/admin/inquiries).
     */
    protected function createInAppTradeDeskAlert(Order $order): Inquiry
    {
        $itemsSummary = $order->items->map(function ($item) {
            return "- {$item->product_name} (Qty: {$item->quantity}, Subtotal: $" . number_format($item->subtotal, 2) . ")";
        })->implode("\n");

        $message = "🚨 NEW COMMODITY ORDER PLACED\n\n"
            . "Order Reference: #{$order->order_number}\n"
            . "Total Amount: $" . number_format($order->total_amount, 2) . "\n"
            . "Customer: {$order->customer_name}\n"
            . "Contact: {$order->customer_email}" . ($order->customer_phone ? " | {$order->customer_phone}" : "") . "\n"
            . "Port / Shipping Address: {$order->shipping_address}\n"
            . "Payment Terms: {$order->payment_method}\n"
            . ($order->notes ? "Notes: {$order->notes}\n" : "")
            . "\nOrdered Commodities:\n{$itemsSummary}\n\n"
            . "Action Required: Contact buyer to finalize contract specification, verify bank escrow / LC, and assign SGS inspection batch.";

        return Inquiry::create([
            'name' => $order->customer_name,
            'email' => $order->customer_email,
            'phone' => $order->customer_phone,
            'role' => 'buyer',
            'subject' => "[NEW ORDER #{$order->order_number}] {$order->customer_name} ($" . number_format($order->total_amount, 2) . ")",
            'message' => $message,
            'status' => 'new',
            'is_read' => false,
        ]);
    }

    /**
     * Dispatch an outbound webhook notification (Slack, Discord, Telegram, or custom ERP).
     */
    protected function dispatchWebhookNotification(Order $order, string $url): void
    {
        $payload = [
            'event' => 'commodity_order.created',
            'order_number' => $order->order_number,
            'timestamp' => now()->toIso8601String(),
            'total_usd' => (float) $order->total_amount,
            'customer' => [
                'name' => $order->customer_name,
                'email' => $order->customer_email,
                'phone' => $order->customer_phone,
            ],
            'shipping' => [
                'destination_port' => $order->shipping_address,
                'payment_method' => $order->payment_method,
            ],
            'items' => $order->items->map(fn ($item) => [
                'product' => $item->product_name,
                'qty' => $item->quantity,
                'price' => (float) $item->price,
                'subtotal' => (float) $item->subtotal,
            ])->toArray(),
            'notes' => $order->notes,
            'admin_url' => url('/admin/orders/' . $order->id),
        ];

        // Format for Slack if webhook URL looks like slack.com/services
        if (str_contains($url, 'slack.com')) {
            $slackText = "🚨 *New Commodity Order #{$order->order_number}* placed by *{$order->customer_name}* for *$" . number_format($order->total_amount, 2) . "*\n"
                . "• Destination: `{$order->shipping_address}`\n"
                . "• Email: <mailto:{$order->customer_email}|{$order->customer_email}>\n"
                . "• Portal: <" . url('/admin/orders/' . $order->id) . "|View in Admin Portal>";
            Http::timeout(5)->post($url, ['text' => $slackText]);
            return;
        }

        Http::timeout(5)->post($url, $payload);
    }
}
