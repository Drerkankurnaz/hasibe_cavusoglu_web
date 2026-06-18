{{-- Meta Tags Component: Dinamik title, description, OG tags, Twitter Card --}}
@props([
    'title' => '',
    'description' => '',
    'seoTitle' => '',
    'seoDescription' => '',
    'ogImage' => '',
    'ogType' => 'website',
])

@php
    $settings = app(\App\Settings\SiteSettings::class);

    // Fallback mekanizması: seo_title boşsa → sayfa title veya app name
    $metaTitle = $seoTitle ?: ($title ?: config('app.name', 'Psikolog Hasibe Çavuşoğlu'));

    // Fallback mekanizması: seo_description boşsa → SiteSettings.default_meta_description
    $metaDescription = $seoDescription ?: ($description ?: ($settings->default_meta_description ?? ''));

    // OG image fallback
    $ogImageUrl = $ogImage ?: asset('img/logo.png');

    // Canonical URL
    $canonicalUrl = url()->current();
@endphp

{{-- SEO Meta Tags --}}
<meta name="description" content="{{ $metaDescription }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- Open Graph Tags --}}
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:locale" content="tr_TR">
<meta property="og:site_name" content="{{ config('app.name', 'Psikolog Hasibe Çavuşoğlu') }}">
<meta property="og:image" content="{{ $ogImageUrl }}">

{{-- Twitter Card Tags --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $ogImageUrl }}">
