<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.about_page_subtitle', 'Uzman Klinik Psikolog');
        $this->migrator->add('site.about_page_bio', 'Çocuk, ergen ve yetişkinlerle psikoterapi çalışmaları yürüten bir Uzman Klinik Psikoloğum. Bilişsel Davranışçı Terapi ve EMDR ekolleriyle, kanıta dayalı yöntemlerle danışanlarımın yaşam kalitesini artırmayı hedefliyorum.');
        $this->migrator->add('site.about_page_cta_title', 'Hemen Danışmanlık Alın!');
        $this->migrator->add('site.about_page_cta_subtitle', 'Profesyonel ve deneyimli psikolog olarak size yardımcı olmak için buradayım');
    }
};
