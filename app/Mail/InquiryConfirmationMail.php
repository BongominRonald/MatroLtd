<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryConfirmationMail extends Mailable
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
            subject: 'BRX AGRO GLOBAL — Trade Inquiry Received [' . $this->reference . ']'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.inquiry-confirmation',
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
