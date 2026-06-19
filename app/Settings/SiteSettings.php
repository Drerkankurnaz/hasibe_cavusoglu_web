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
    public ?string $hero_image;
    public string $footer_text;
    public ?string $ga_id;
    public ?string $default_meta_description;

    // Anasayfa içerikleri
    public array $intro_boxes;
    public string $about_title;
    public string $about_text;
    public ?string $about_image;
    public array $values;
    public string $why_choose_title;
    public string $why_choose_text;
    public array $why_choose_tabs;

    public static function group(): string
    {
        return 'site';
    }
}
