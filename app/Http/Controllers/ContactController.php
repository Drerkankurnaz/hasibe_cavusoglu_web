<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMailable;
use App\Models\ContactMessage;
use App\Services\MailService;
use App\Settings\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        private readonly MailService $mailService,
        private readonly SiteSettings $settings,
    ) {}

    /**
     * İletişim formu görüntüleme.
     */
    public function create(): View
    {
        return view('pages.contact', [
            'settings' => $this->settings,
        ]);
    }

    /**
     * İletişim formu gönderimi.
     * ContactRequest ile validation, ContactMessage kayıt, admin'e mail, success mesaj.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        $contactMessage = ContactMessage::create($request->safe()->except(['kvkk']));

        $this->mailService->safeSend(
            $this->settings->email,
            new ContactFormMailable($contactMessage)
        );

        return back()->with('success', 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.');
    }
}
