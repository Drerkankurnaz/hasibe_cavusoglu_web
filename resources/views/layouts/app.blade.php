<!DOCTYPE html>
<html lang="tr">

<head>
    <title>@yield('title', 'Psikolog Hasibe Çavuşoğlu')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Meta Tags Component --}}
    <x-meta-tags
        :title="$__env->yieldContent('title')"
        :description="$seoDescription ?? ''"
        :seo-title="$seoTitle ?? ''"
        :seo-description="$seoDescription ?? ''"
        :og-image="$ogImage ?? ''"
    />

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('img/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    {{-- Cache-busting yardımcısı: CSS değişince tarayıcı önbelleğini otomatik tazeler --}}
    @php
        $cssVersion = fn (string $path) => asset($path) . '?v=' . (@filemtime(public_path($path)) ?: '1');
    @endphp

    {{-- Fontlar (self-host, Türkçe latin-ext desteği dahil — Figtree & Montserrat) --}}
    <link rel="stylesheet" href="{{ $cssVersion('css/fonts.css') }}">

    {{-- Bootstrap v3.3.7 --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- Font Awesome 4.7.0 --}}
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    {{-- Main style --}}
    <link rel="stylesheet" href="{{ $cssVersion('css/style.css') }}">

    {{-- Responsive Custom --}}
    <link rel="stylesheet" href="{{ $cssVersion('css/responsive-custom.css') }}">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')
</head>

<body>

    <div class="wrapp-content">

        {{-- Header --}}
        @include('layouts.partials.header')

        {{-- Main Content --}}
        @yield('content')

        {{-- Footer --}}
        @include('layouts.partials.footer')

    </div>

    {{-- JQuery v2.2.4 --}}
    <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>

    {{-- Main navigation sticky --}}
    <script src="{{ asset('js/plugins/jquery.sticky.min.js') }}"></script>

    {{-- SuperFish v1.7.9 --}}
    <script src="{{ asset('js/plugins/jquery.superfish.min.js') }}"></script>

    {{-- Owl Carousel v2.2.1 --}}
    <script src="{{ asset('js/plugins/jquery.owl.carousel.min.js') }}"></script>

    {{-- Waypoint v2.0.2 --}}
    <script src="{{ asset('js/plugins/jquery.waypoint.min.js') }}"></script>

    {{-- Main script --}}
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('scripts')

    {{-- Schema.org Yapılandırılmış Veri --}}
    @hasSection('schema-org')
        @yield('schema-org')
    @endif

</body>

</html>
