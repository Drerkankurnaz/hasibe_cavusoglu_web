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
                        <p class="subtitle-01">{{ $settings->about_page_subtitle }}</p>
                        <h3 class="title-03">Merhaba! Ben
                            <span>Hasibe Çavuşoğlu</span>
                        </h3>
                        <div class="about-me-text-01">
                            <p>{{ $settings->about_page_bio }}</p>
                        </div>
                        <p class="about-me-meta">Hemen Arayın ve
                            <a href="{{ route('appointment.create') }}">Randevu Alın</a>
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
                    @foreach($settings->certificates as $cert)
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
                @php $aboutValues = $settings->values ?? []; @endphp
                @foreach($aboutValues as $i => $value)
                    @if($i % 3 === 0 && $i > 0)
                        </div><div class="row">
                    @endif
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="about-me-serv">
                            <figure class="about-me-serv__icon">
                                <img src="{{ asset('img/about_me/icons/icon_0' . (($i % 6) + 1) . '.png') }}" alt="{{ $value['title'] ?? '' }}">
                            </figure>
                            <h3 class="about-me-serv__title">{{ $value['title'] ?? '' }}</h3>
                            <p class="about-me-serv__text">{{ $value['text'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="action-box-01">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="action-box-01__wrapp">
                        <h3 class="action-box-01__title">{{ $settings->about_page_cta_title }}
                            <span>Arayın: {{ $settings->phone ?? '' }}</span>
                        </h3>
                        <p class="action-box-01__subtitle">{{ $settings->about_page_cta_subtitle }}</p>
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
