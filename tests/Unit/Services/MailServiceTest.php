<?php

namespace Tests\Unit\Services;

use App\Services\MailService;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailServiceTest extends TestCase
{
    private MailService $mailService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mailService = new MailService();
    }

    public function test_safe_send_returns_true_on_success(): void
    {
        Mail::fake();

        $mailable = new class extends Mailable {
            public function content(): \Illuminate\Mail\Mailables\Content
            {
                return new \Illuminate\Mail\Mailables\Content(
                    htmlString: '<p>Test</p>',
                );
            }
        };

        $result = $this->mailService->safeSend('test@example.com', $mailable);

        $this->assertTrue($result);
        Mail::assertSent(get_class($mailable));
    }

    public function test_safe_send_returns_false_on_failure_and_logs_error(): void
    {
        Log::shouldReceive('error')
            ->once()
            ->withArgs(function ($message, $context) {
                return $message === 'Mail gönderimi başarısız'
                    && $context['to'] === 'test@example.com'
                    && isset($context['mailable'])
                    && isset($context['error']);
            });

        // Mail facade'ı hata fırlatacak şekilde ayarla
        Mail::shouldReceive('to')
            ->once()
            ->andThrow(new \Exception('SMTP bağlantı hatası'));

        $mailable = new class extends Mailable {
            public function content(): \Illuminate\Mail\Mailables\Content
            {
                return new \Illuminate\Mail\Mailables\Content(
                    htmlString: '<p>Test</p>',
                );
            }
        };

        $result = $this->mailService->safeSend('test@example.com', $mailable);

        $this->assertFalse($result);
    }

    public function test_safe_send_does_not_throw_exception(): void
    {
        Mail::shouldReceive('to')
            ->once()
            ->andThrow(new \Exception('SMTP bağlantı hatası'));

        Log::shouldReceive('error')->once();

        $mailable = new class extends Mailable {
            public function content(): \Illuminate\Mail\Mailables\Content
            {
                return new \Illuminate\Mail\Mailables\Content(
                    htmlString: '<p>Test</p>',
                );
            }
        };

        // Bu satır exception fırlatmamalı
        $result = $this->mailService->safeSend('test@example.com', $mailable);

        $this->assertFalse($result);
    }

    public function test_safe_send_to_many_returns_results_for_each_recipient(): void
    {
        Mail::fake();

        $mailable = new class extends Mailable {
            public function content(): \Illuminate\Mail\Mailables\Content
            {
                return new \Illuminate\Mail\Mailables\Content(
                    htmlString: '<p>Test</p>',
                );
            }
        };

        $recipients = ['user1@example.com', 'user2@example.com'];
        $results = $this->mailService->safeSendToMany($recipients, $mailable);

        $this->assertCount(2, $results);
        $this->assertTrue($results['user1@example.com']);
        $this->assertTrue($results['user2@example.com']);
    }
}
