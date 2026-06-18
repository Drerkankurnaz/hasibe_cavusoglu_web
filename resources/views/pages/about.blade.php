@extends('layouts.app')

@section('title', $page ? ($page->seo_title ?: $page->title) : 'Hakkımda')

@php
    $seoTitle = $page ? ($page->seo_title ?: $page->title) : 'Hakkımda';
    $seoDescription = $page ? ($page->seo_description ?: '') : ($settings->default_meta_description ?? '');
@endphp

@section('content')
    <!-- Page Title -->
    <div class="page-title-wrapp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-title-01">Hakkımda</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li class="active">
                            <a href="{{ route('home') }}">Anasayfa</a>
                        </li>
                        <li>Hakkımda</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- About Me Content -->
    <div class="content-box-01">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="about-me-cont-02">
                        <p class="subtitle-01">Klinik Psikolog</p>
                        <h3 class="title-03">Merhaba! Ben
                            <span>Hasibe Çavuşoğlu</span>
                        </h3>
                        @if($page)
                            <div class="about-me-text-01">
                                {!! $page->body !!}
                            </div>
                        @else
                            <div class="about-me-text-01">
                                <p>Klinik psikolog olarak bireysel terapi, çift terapisi ve aile terapisi alanlarında hizmet vermekteyim. Bilişsel davranışçı terapi yaklaşımıyla danışanlarımın yaşam kalitesini artırmayı hedefliyorum.</p>
                            </div>
                        @endif
                        <p class="about-me-meta">Hemen Arayın ve
                            <a href="{{ route('appointment.create') }}">Randevu Alın</a>
                        </p>
                        <p class="about-me-phone">
                            <span class="about-me-p-01">{{ $settings->phone ?? '' }}</span>
                            @if($settings->whatsapp)
                                veya
                                <span class="about-me-p-02">{{ $settings->whatsapp }}</span>
                            @endif
                        </p>
                        <div class="about-me-author">
                            <div class="about-me-author__img">
                                <img src="{{ asset('img/about_me/about_me_img_02.png') }}" alt="Hasibe Çavuşoğlu">
                            </div>
                            <div class="about-me-author__text">
                                <p>
                                    <strong>Hasibe Çavuşoğlu</strong>,
                                    <span>Klinik Psikolog</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <figure class="about-me-img">
                        <img src="{{ asset('img/about_me/about_me_img.png') }}" alt="Psikolog Hasibe Çavuşoğlu" class="img-responsive">
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Highlights -->
    <div class="content-box-02 pad-top-95 pad-bt-26">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="about-me-serv">
                        <figure class="about-me-serv__icon">
                            <img src="{{ asset('img/about_me/icons/icon_01.png') }}" alt="Gizlilik">
                        </figure>
                        <h3 class="about-me-serv__title">Gizlilik</h3>
                        <p class="about-me-serv__text">Tüm görüşmelerimiz gizlidir ve bilgileriniz korunmaktadır. Güvenliğiniz konusunda endişelenmeyin.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="about-me-serv">
                        <figure class="about-me-serv__icon">
                            <img src="{{ asset('img/about_me/icons/icon_02.png') }}" alt="Destek">
                        </figure>
                        <h3 class="about-me-serv__title">7/24 Destek</h3>
                        <p class="about-me-serv__text">Günün her saatinde beni arayabilirsiniz. Zor anlarınızda size destek olmaya her zaman hazırım.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="about-me-serv">
                        <figure class="about-me-serv__icon">
                            <img src="{{ asset('img/about_me/icons/icon_03.png') }}" alt="Gelişim">
                        </figure>
                        <h3 class="about-me-serv__title">Sürekli Gelişim</h3>
                        <p class="about-me-serv__text">Kendimi geliştirmeye ve yeni ufuklara ulaşmaya çalışıyorum. Çeşitli eğitim ve seminerlere katılıyorum.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="about-me-serv">
                        <figure class="about-me-serv__icon">
                            <img src="{{ asset('img/about_me/icons/icon_04.png') }}" alt="Profesyonellik">
                        </figure>
                        <h3 class="about-me-serv__title">Profesyonellik</h3>
                        <p class="about-me-serv__text">Sizin için yalnızca %100 profesyonel ve kaliteli hizmet sunuyorum. En iyi terapötik yaklaşımları uyguluyorum.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="about-me-serv">
                        <figure class="about-me-serv__icon">
                            <img src="{{ asset('img/about_me/icons/icon_05.png') }}" alt="Deneyim">
                        </figure>
                        <h3 class="about-me-serv__title">Deneyim</h3>
                        <p class="about-me-serv__text">Psikolojik sorunlarla mücadele eden bireylerle özel pratikte uzun yıllara dayanan deneyimim bulunmaktadır.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="about-me-serv">
                        <figure class="about-me-serv__icon">
                            <img src="{{ asset('img/about_me/icons/icon_06.png') }}" alt="Güvenilirlik">
                        </figure>
                        <h3 class="about-me-serv__title">Güvenilirlik</h3>
                        <p class="about-me-serv__text">Zor anlarınızda sizi asla yalnız bırakmam. Hemen arayın ve randevu alın.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="action-box-01">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="action-box-01__wrapp">
                        <h3 class="action-box-01__title">Hemen Danışmanlık Alın!
                            <span>Arayın: {{ $settings->phone ?? '' }}</span>
                        </h3>
                        <p class="action-box-01__subtitle">Profesyonel ve deneyimli psikolog olarak size yardımcı olmak için buradayım</p>
                    </div>
                    <div class="action-box-01__btn-wrapp">
                        <a href="{{ route('appointment.create') }}" class="action-box-01__btn">Randevu Al</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Schema.org Yapılandırılmış Veri --}}
@endsection

@section('schema-org')
    <x-schema-org type="both" />
@endsection
