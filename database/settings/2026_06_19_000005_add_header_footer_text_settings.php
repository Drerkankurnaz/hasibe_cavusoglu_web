<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.logo_name', 'Hasibe Çavuşoğlu');
        $this->migrator->add('site.logo_title', 'Klinik Psikolog');
        $this->migrator->add('site.footer_description', 'Profesyonel psikolojik danışmanlık hizmetleri ile yanınızdayız.');
    }
};
