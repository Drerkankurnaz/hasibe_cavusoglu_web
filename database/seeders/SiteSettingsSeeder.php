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
        $settings->address = 'Atatürk Mah. Cumhuriyet Cad. No:42/3, Kadıköy, İstanbul';
        $settings->map_embed = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3011.6504900697386!2d29.0562!3d40.9903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        $settings->working_hours = [
            ['day' => 'Pazartesi', 'hours' => '09:00 - 18:00'],
            ['day' => 'Salı', 'hours' => '09:00 - 18:00'],
            ['day' => 'Çarşamba', 'hours' => '09:00 - 18:00'],
            ['day' => 'Perşembe', 'hours' => '09:00 - 18:00'],
            ['day' => 'Cuma', 'hours' => '09:00 - 18:00'],
            ['day' => 'Cumartesi', 'hours' => '10:00 - 14:00'],
            ['day' => 'Pazar', 'hours' => 'Kapalı'],
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
