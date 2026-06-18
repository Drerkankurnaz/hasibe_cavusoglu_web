<?php

namespace App\Services;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailService
{
    /**
     * E-posta gönderimini güvenli şekilde gerçekleştirir.
     * Hata oluşursa loglar ve kullanıcı akışını kesmez.
     *
     * @param string|array $recipient Alıcı e-posta adresi
     * @param Mailable $mailable Gönderilecek Mailable instance
     * @return bool Gönderim başarılı ise true, başarısız ise false
     */
    public function safeSend(string|array $recipient, Mailable $mailable): bool
    {
        try {
            Mail::to($recipient)->send($mailable);

            return true;
        } catch (\Exception $e) {
            Log::error('Mail gönderimi başarısız', [
                'to' => $recipient,
                'mailable' => get_class($mailable),
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Birden fazla alıcıya aynı maili güvenli şekilde gönderir.
     *
     * @param array $recipients Alıcı e-posta adresleri
     * @param Mailable $mailable Gönderilecek Mailable instance
     * @return array<string, bool> Her alıcı için gönderim sonucu
     */
    public function safeSendToMany(array $recipients, Mailable $mailable): array
    {
        $results = [];

        foreach ($recipients as $recipient) {
            $results[$recipient] = $this->safeSend($recipient, $mailable);
        }

        return $results;
    }
}
