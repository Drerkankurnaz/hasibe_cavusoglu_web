@inject('settings', 'App\Settings\SiteSettings')

<!-- Header -->
<header class="wrapp-header">
    {{-- Üst iletişim barı --}}
    <div class="info-block-01">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="visit-time">
                        @if(!empty($settings->working_hours))
                            @foreach($settings->working_hours as $hour)
                                {{ $hour['label'] ?? '' }}: {{ $hour['value'] ?? '' }}@if(!$loop->last) | @endif
                            @endforeach
                        @endif
                    </p>
                    <div class="info-block-01__box-01">
                        <p class="address-info">{{ $settings->address }}</p>
                        <a class="email-info" href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                        @if(!empty($settings->social_links))
                            <span class="social-links-top">
                                @foreach($settings->social_links as $social)
                                    <a href="{{ $social['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" title="{{ $social['platform'] ?? '' }}">
                                        <i class="fa fa-{{ $social['icon'] ?? $social['platform'] ?? '' }}"></i>
                                    </a>
                                @endforeach
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Logo ve telefon bilgisi --}}
    <div class="header-box-01">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4 text-xs-center">
                    <a href="{{ route('home') }}" class="logo">
                        @if($settings->logo)
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Psikolog Hasibe Çavuşoğlu">
                        @else
                            <img src="{{ asset('img/logo.png') }}" alt="Psikolog Hasibe Çavuşoğlu">
                        @endif
                    </a>
                </div>
                <div class="col-sm-8 col-md-8 col-lg-8 text-xs-center text-right">
                    <p class="phone-info">
                        <span>Ara:</span>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->phone) }}">{{ $settings->phone }}</a>
                    </p>
                    <a class="btn-app" href="{{ route('appointment.create') }}">RANDEVU AL</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation menü --}}
    <div class="header-box-02">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-nav">
                        {{-- Hamburger menü (mobil) --}}
                        <div class="main-nav__btn">
                            <div class="icon-left"></div>
                            <div class="icon-right"></div>
                        </div>

                        {{-- Arama kutusu --}}
                        <div class="header-box-03">
                            <div class="search-box">
                                <a class="search-btn" href="#">Ara</a>
                                <div class="search-box__dropdown">
                                    <form action="{{ route('blog.index') }}" method="GET" class="search-box__form">
                                        <input class="search-box__input" type="text" name="q" placeholder="Ara...">
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- SuperFish uyumlu ana menü --}}
                        <ul class="main-nav__list">
                            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                <a href="{{ route('home') }}">Ana Sayfa</a>
                            </li>
                            <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                                <a href="{{ route('about') }}">Hakkımda</a>
                            </li>
                            <li class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
                                <a href="{{ route('services.index') }}">Hizmetler</a>
                            </li>
                            <li class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                                <a href="{{ route('blog.index') }}">Blog</a>
                            </li>
                            <li class="{{ request()->routeIs('faq') ? 'active' : '' }}">
                                <a href="{{ route('faq') }}">SSS</a>
                            </li>
                            <li class="{{ request()->routeIs('appointment.*') ? 'active' : '' }}">
                                <a href="{{ route('appointment.create') }}">Randevu</a>
                            </li>
                            <li class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">
                                <a href="{{ route('contact.create') }}">İletişim</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
