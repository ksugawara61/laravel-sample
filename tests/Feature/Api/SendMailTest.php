<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendMailTest extends TestCase
{
    /**
     * @test
     */
    public function sampleMail()
    {
        Mail::fake();
        $response = $this->postJson('/api/send-email', [
            'to' => 'a@exampl.com'
        ]);

        $response->assertStatus(200);

        // MailFakeを利用したアサーション
        Mail::assertSent(\App\Mail\Sample::class, 1);
        Mail::assertSent(function (Mailable $mailable) {
            return $mailable->hasTo('a@exampl.com');
        });
    }
}
