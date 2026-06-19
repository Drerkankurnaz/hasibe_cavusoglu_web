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
                        <p class="subtitle-01">Uzman Klinik Psikolog</p>
                        <h3 class="title-03">Merhaba! Ben
                            <span>Hasibe Çavuşoğlu</span>
                        </h3>
                        <div class="about-me-text-01">
                            <p>Çocuk, ergen ve yetişkinlerle psikoterapi çalışmaları yürüten bir Uzman Klinik Psikoloğum. Bilişsel Davranışçı Terapi ve EMDR ekolleriyle, kanıta dayalı yöntemlerle danışanlarımın yaşam kalitesini artırmayı hedefliyorum.</p>
                        </div>
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
                                    <span>Uzman Klinik Psikolog</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <figure class="about-me-img">
                        <img src="{{ asset('img/about_me/about_me_img.jpg') }}" alt="Psikolog Hasibe Çavuşoğlu" class="img-responsive">
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <!-- Resume / Özgeçmiş -->
    @if($page && trim(strip_tags($page->body)) !== '')
        <div class="content-box-01 pad-bt-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="subtitle-02">Hakkımda</p>
                        <h3 class="title-02 title-02--mr-01">Eğitim ve
                            <span>Deneyim</span>
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10 col-md-12">
                        <div class="about-me-text-01 about-me-resume">
                            {!! $page->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Eğitim ve Sertifikalar (Timeline) -->
    <div class="content-box-02 pad-top-75 pad-bt-57">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="subtitle-02">Profesyonel Gelişim</p>
                    <h3 class="title-02 title-02--mr-01">Eğitim ve
                        <span>Sertifikalar</span>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @php
                        $certificates = [
                            ['date' => '2026', 'title' => 'Moxo360 Süpervizyon Eğitimi', 'desc' => 'Uzm. Dr. Ferda Korkmaz Özkanoğlu, Uzm. Kln. Psk. Yücel Şavklı — Moxo Türkiye'],
                            ['date' => '2026', 'title' => 'EMDR Children & Adolescents Level 1', 'desc' => 'Prof. Dr. Ümran Korkmazlar — Fide Danışmanlık Merkezi'],
                            ['date' => '2025 – 2026', 'title' => 'Çocuk ve Ergenlerde BDT Süpervizyon Programı', 'desc' => 'Prof. Dr. Vahdet Görmez — Bilişsel Davranışçı Psikoterapiler Derneği'],
                            ['date' => '2025', 'title' => 'EMDR 1. Düzey Eğitimi', 'desc' => 'Davranış Bilimleri Enstitüsü, Antalya'],
                            ['date' => '2025', 'title' => 'Wechsler Çocuklar İçin Zekâ Ölçeği (WÇZÖ-IV)', 'desc' => 'Dr. Psk. Nagehan Demiral — Giunti Psychometrics, İzmir'],
                        ];
                    @endphp
                    @foreach($certificates as $cert)
                        <div class="education-block-02">
                            <div class="education-block__box-03">
                                <p class="education-block-date">{{ $cert['date'] }}</p>
                            </div>
                            <div class="education-block__box-04">
                                <h4 class="education-block-title">{{ $cert['title'] }}</h4>
                                <p>{{ $cert['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Services Highlights -->
    <div class="content-box-01 pad-top-75 pad-bt-26">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="subtitle-02">Neden Ben?</p>
                    <h3 class="title-02 title-02--mr-01">Çalışma
                        <span>İlkelerim</span>
                    </h3>
                </div>
            </div>
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
