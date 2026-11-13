<?php

namespace Tests\Feature;

use App\Mail\AdminInquiryAlertMail;
use App\Mail\InquiryConfirmationMail;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class InquiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_inquiry_submission_stores_record_and_dispatches_emails(): void
    {
        Mail::fake();

        $payload = [
            'name' => 'Amir Trading DMCC',
            'email' => 'procurement@amirtrading.ae',
            'phone' => '+971 4 123 4567',
            'role' => 'buyer',
            'company' => 'Amir Trading DMCC',
            'country' => 'United Arab Emirates',
            'buyer_detail' => '25,000 MT ICUMSA 45 Cane Sugar CIF Jebel Ali',
            'message' => 'Please provide quotation with SGS inspection and LC payment terms.',
        ];

        $response = $this->postJson(route('inquiries.store'), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        $this->assertDatabaseHas('inquiries', [
            'email' => 'procurement@amirtrading.ae',
            'name' => 'Amir Trading DMCC',
            'role' => 'buyer',
        ]);

        Mail::assertSent(InquiryConfirmationMail::class, function ($mail) {
            return $mail->hasTo('procurement@amirtrading.ae');
        });

        Mail::assertSent(AdminInquiryAlertMail::class);
    }
}
