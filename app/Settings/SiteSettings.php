<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{
    public ?string $logo;
    public ?string $favicon;
    public string $phone;
    public ?string $whatsapp;
    public string $email;
    public string $address;
    public ?string $map_embed;
    public array $working_hours;
    public array $social_links;
    public string $hero_title;
    public string $hero_subtitle;
    public string $hero_cta_text;
    public string $footer_text;
    public ?string $ga_id;
    public ?string $default_meta_description;

    public static function group(): string
    {
        return 'site';
    }
}
