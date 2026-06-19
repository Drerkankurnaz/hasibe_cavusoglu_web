<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.certificates', [
            ['date' => '2026', 'title' => 'Moxo360 Süpervizyon Eğitimi', 'desc' => 'Uzm. Dr. Ferda Korkmaz Özkanoğlu, Uzm. Kln. Psk. Yücel Şavklı — Moxo Türkiye'],
            ['date' => '2026', 'title' => 'EMDR Children & Adolescents Level 1', 'desc' => 'Prof. Dr. Ümran Korkmazlar — Fide Danışmanlık Merkezi'],
            ['date' => '2025 – 2026', 'title' => 'Çocuk ve Ergenlerde BDT Süpervizyon Programı', 'desc' => 'Prof. Dr. Vahdet Görmez — Bilişsel Davranışçı Psikoterapiler Derneği'],
            ['date' => '2025', 'title' => 'EMDR 1. Düzey Eğitimi', 'desc' => 'Davranış Bilimleri Enstitüsü, Antalya'],
            ['date' => '2025', 'title' => 'Wechsler Çocuklar İçin Zekâ Ölçeği (WÇZÖ-IV)', 'desc' => 'Dr. Psk. Nagehan Demiral — Giunti Psychometrics, İzmir'],
        ]);
    }
};
