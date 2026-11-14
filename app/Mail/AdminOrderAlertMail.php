<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminOrderAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        $lotsCount = $this->order->items->sum('quantity') ?: $this->order->items->count();
        $suffix = $lotsCount > 0 ? " ({$lotsCount} Lots)" : "";
        return new Envelope(
            subject: '[TRADE DESK ALERT] New Commodity Order #' . $this->order->order_number . ' — ' . $this->order->customer_name . $suffix
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-order-alert',
            with: [
                'order' => $this->order,
                'items' => $this->order->items,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
