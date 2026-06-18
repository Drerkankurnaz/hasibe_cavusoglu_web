<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.logo', null);
        $this->migrator->add('site.favicon', null);
        $this->migrator->add('site.phone', '');
        $this->migrator->add('site.whatsapp', null);
        $this->migrator->add('site.email', '');
        $this->migrator->add('site.address', '');
        $this->migrator->add('site.map_embed', null);
        $this->migrator->add('site.working_hours', []);
        $this->migrator->add('site.social_links', []);
        $this->migrator->add('site.hero_title', '');
        $this->migrator->add('site.hero_subtitle', '');
        $this->migrator->add('site.hero_cta_text', 'Randevu Al');
        $this->migrator->add('site.footer_text', '');
        $this->migrator->add('site.ga_id', null);
        $this->migrator->add('site.default_meta_description', '');
    }
};
