<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'service_id' => ['required', 'exists:services,id'],
            'preferred_at' => ['required', 'date', 'after:now'],
            'notes' => ['nullable', 'string'],
            'kvkk' => ['required', 'accepted'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'İsim alanı zorunludur.',
            'email.required' => 'E-posta alanı zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'phone.required' => 'Telefon alanı zorunludur.',
            'service_id.required' => 'Hizmet seçimi zorunludur.',
            'service_id.exists' => 'Seçilen hizmet bulunamadı.',
            'preferred_at.required' => 'Randevu tarihi zorunludur.',
            'preferred_at.date' => 'Geçerli bir tarih giriniz.',
            'preferred_at.after' => 'Randevu tarihi gelecekte olmalıdır.',
            'kvkk.required' => 'KVKK onayı zorunludur.',
            'kvkk.accepted' => 'KVKK onayı zorunludur.',
        ];
    }
}
