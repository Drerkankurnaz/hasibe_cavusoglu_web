<?php

namespace Database\Seeders;

use App\Settings\SiteSettings;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Varsayılan site ayarlarını Türkçe placeholder içerikle oluşturur.
     */
    public function run(): void
    {
        $settings = app(SiteSettings::class);

        $settings->logo = null;
        $settings->favicon = null;
        $settings->phone = '+90 555 123 45 67';
        $settings->whatsapp = '+905551234567';
        $settings->email = 'info@hasibecavusoglu.com';
        $settings->address = 'Öğretmenevleri Mah. 922. Sokak No:3 Duran Plaza Kat:3 D:18, Konyaaltı / Antalya';
        // API anahtarı gerektirmeyen, adres tabanlı Google Maps embed (q= formatı).
        // Google'ın "pb=" formatı yalnızca Google tarafından üretilen imzalı kodla
        // çalışır; elle düzenlenince "Invalid pb parameter" hatası verir.
        $mapQuery = rawurlencode($settings->address);
        $settings->map_embed = '<iframe src="https://maps.google.com/maps?q=' . $mapQuery . '&hl=tr&z=15&output=embed" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
        // Anahtarlar 'label'/'value' olmalı — admin paneli (ManageSiteSettings)
        // ve footer/header blade şablonları bu anahtarları okur.
        $settings->working_hours = [
            ['label' => 'Pazartesi', 'value' => '09:00 - 18:00'],
            ['label' => 'Salı', 'value' => '09:00 - 18:00'],
            ['label' => 'Çarşamba', 'value' => '09:00 - 18:00'],
            ['label' => 'Perşembe', 'value' => '09:00 - 18:00'],
            ['label' => 'Cuma', 'value' => '09:00 - 18:00'],
            ['label' => 'Cumartesi', 'value' => '10:00 - 14:00'],
            ['label' => 'Pazar', 'value' => 'Kapalı'],
        ];
        $settings->social_links = [
            ['platform' => 'facebook', 'url' => 'https://facebook.com/hasibecavusoglu'],
            ['platform' => 'instagram', 'url' => 'https://instagram.com/hasibecavusoglu'],
            ['platform' => 'linkedin', 'url' => 'https://linkedin.com/in/hasibecavusoglu'],
            ['platform' => 'twitter', 'url' => 'https://twitter.com/hasibecavusoglu'],
        ];
        $settings->hero_title = 'Uzman Psikolog Hasibe Çavuşoğlu';
        $settings->hero_subtitle = 'Bireysel terapi, çift terapisi ve aile danışmanlığı alanlarında profesyonel psikolojik destek sunuyorum. Siz de ilk adımı atın.';
        $settings->hero_cta_text = 'Randevu Alın';
        $settings->footer_text = '© ' . date('Y') . ' Psikolog Hasibe Çavuşoğlu. Tüm hakları saklıdır.';
        $settings->ga_id = null;
        $settings->default_meta_description = 'Uzman Psikolog Hasibe Çavuşoğlu - İstanbul\'da bireysel terapi, çift terapisi, aile danışmanlığı ve psikolojik danışmanlık hizmetleri.';

        $settings->save();
    }
}
