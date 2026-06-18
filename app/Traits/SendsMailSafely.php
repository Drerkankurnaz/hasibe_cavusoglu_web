<?php

namespace App\Traits;

use App\Services\MailService;
use Illuminate\Mail\Mailable;

trait SendsMailSafely
{
    /**
     * E-posta gönderimini güvenli şekilde gerçekleştirir.
     * Hata oluşursa loglar ve kullanıcı akışını kesmez.
     *
     * @param string|array $recipient Alıcı e-posta adresi
     * @param Mailable $mailable Gönderilecek Mailable instance
     * @return bool Gönderim başarılı ise true, başarısız ise false
     */
    protected function sendMailSafely(string|array $recipient, Mailable $mailable): bool
    {
        return app(MailService::class)->safeSend($recipient, $mailable);
    }
}
