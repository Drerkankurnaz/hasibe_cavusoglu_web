<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.maintenance_mode', false);
        $this->migrator->add('site.maintenance_title', 'Site Bakımda');
        $this->migrator->add('site.maintenance_message', 'Sitemizi sizin için daha iyi hale getirmek adına kısa bir bakım çalışması yapıyoruz. Kısa süre içinde tekrar hizmetinizde olacağız.');
    }
};
