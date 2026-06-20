@extends('layouts.app')

@section('title', 'Sayfa Bulunamadı')

@php
    $seoTitle = 'Sayfa Bulunamadı';
    $seoDescription = '404 - Aradığınız sayfa bulunamadı.';
@endphp

@section('content')
    <!-- 404 Content -->
    <main class="error-404">
        <div class="error-404__overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <div class="error-404__wrapp">
                        <div class="error-404__code" aria-hidden="true">
                            <span>4</span>
                            <span class="error-404__zero">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <span>4</span>
                        </div>

                        <h1 class="error-404__title">Aradığınız sayfayı bulamadık</h1>

                        <p class="error-404__text">
                            Bu sayfa taşınmış, adı değişmiş ya da hiç var olmamış olabilir.
                            Endişelenmeyin &mdash; doğru yere ulaşmanız için size yardımcı olalım.
                        </p>

                        <div class="error-404__actions">
                            <a href="{{ route('home') }}" class="error-404__btn error-404__btn--primary">
                                <i class="fa fa-home" aria-hidden="true"></i> Anasayfaya Dön
                            </a>
                            <a href="{{ route('appointment.create') }}" class="error-404__btn error-404__btn--ghost">
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Randevu Al
                            </a>
                        </div>

                        <div class="error-404__links">
                            <p class="error-404__links-label">Şu sayfalara göz atabilirsiniz:</p>
                            <ul class="error-404__links-list">
                                <li><a href="{{ route('about') }}">Hakkımda</a></li>
                                <li><a href="{{ route('services.index') }}">Hizmetler</a></li>
                                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                                <li><a href="{{ route('faq') }}">SSS</a></li>
                                <li><a href="{{ route('contact.create') }}">İletişim</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
