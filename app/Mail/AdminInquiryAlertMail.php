<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminInquiryAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public Inquiry $inquiry;
    public string $reference;

    public function __construct(Inquiry $inquiry, string $reference)
    {
        $this->inquiry = $inquiry;
        $this->reference = $reference;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[TRADE DESK ALERT] New Inquiry ' . $this->reference . ' from ' . $this->inquiry->name
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-inquiry-alert',
            with: [
                'inquiry' => $this->inquiry,
                'reference' => $this->reference,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
