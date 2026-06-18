<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Mail\AppointmentReceivedMailable;
use App\Models\Appointment;
use App\Models\Service;
use App\Services\MailService;
use App\Settings\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function __construct(
        private readonly MailService $mailService,
        private readonly SiteSettings $settings,
    ) {}

    /**
     * Randevu formu görüntüleme (aktif servisler listesi).
     */
    public function create(): View
    {
        $services = Service::active()->get();

        return view('pages.appointment', [
            'services' => $services,
            'settings' => $this->settings,
        ]);
    }

    /**
     * Randevu formu gönderimi.
     * AppointmentRequest validation, Appointment kayıt (status=pending),
     * admin + müşteriye mail gönderimi.
     */
    public function store(AppointmentRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['kvkk']);
        $data['kvkk_accepted'] = true; // Validation zaten accepted kontrolü yapıyor

        $appointment = Appointment::create($data);

        // Admin'e bildirim maili
        $this->mailService->safeSend(
            $this->settings->email,
            new AppointmentReceivedMailable($appointment)
        );

        // Müşteriye onay maili
        $this->mailService->safeSend(
            $appointment->email,
            new AppointmentReceivedMailable($appointment)
        );

        return back()->with('success', 'Randevu talebiniz başarıyla alınmıştır. Size en kısa sürede dönüş yapacağız.');
    }
}
