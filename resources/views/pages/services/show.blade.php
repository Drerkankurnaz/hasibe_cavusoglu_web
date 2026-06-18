@extends('layouts.app')

@section('title', ($service->seo_title ?? $service->title) . ' - Psikolog Hasibe Çavuşoğlu')

@section('content')
<main class="content-row">
    {{-- Page Title & Breadcrumbs --}}
    <div class="page-title-wrapp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-title-01">{{ $service->title }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li class="active">
                            <a href="{{ route('home') }}">Anasayfa</a>
                        </li>
                        <li class="active">
                            <a href="{{ route('services.index') }}">Hizmetlerimiz</a>
                        </li>
                        <li>{{ $service->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Service Detail Content --}}
    <div class="content-box-01 pad-top-40 pad-bt-60">
        <div class="container">
            <div class="row">
                {{-- Main Content --}}
                <div class="col-md-8 col-lg-8">
                    <div class="single-service right">
                        {{-- Service Image --}}
                        @if($service->image)
                            <figure class="single-service__img">
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                            </figure>
                        @endif

                        {{-- Service Title --}}
                        <h3><strong>{{ $service->title }}</strong></h3>

                        {{-- Price & Duration Info --}}
                        @if($service->price || $service->duration)
                            <div class="service-meta" style="background: #f9f9f9; padding: 15px 20px; border-left: 4px solid #1aad57; margin-bottom: 25px; border-radius: 3px;">
                                @if($service->price)
                                    <span style="font-size: 18px; font-weight: bold; color: #1aad57;">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                        {{ number_format($service->price, 0, ',', '.') }} TL
                                    </span>
                                @endif
                                @if($service->duration)
                                    <span style="font-size: 16px; color: #666; margin-left: 20px;">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        Süre: {{ $service->duration }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        {{-- Service Description (RichEditor content) --}}
                        <div class="service-description">
                            {!! $service->description !!}
                        </div>

                        {{-- Appointment CTA --}}
                        <div class="service-cta" style="margin-top: 40px; padding: 25px; background: #f5f5f5; text-align: center; border-radius: 4px;">
                            <h4 style="margin-bottom: 15px;">Bu hizmet hakkında bilgi almak ister misiniz?</h4>
                            <a href="{{ route('appointment.create') }}" class="btn-app" style="display: inline-block;">Randevu Al</a>
                        </div>

                        {{-- Service Navigation (Prev/Next) --}}
                        @php
                            $prevService = \App\Models\Service::where('is_active', true)
                                ->where('order', '<', $service->order)
                                ->orderBy('order', 'desc')
                                ->first();
                            $nextService = \App\Models\Service::where('is_active', true)
                                ->where('order', '>', $service->order)
                                ->orderBy('order', 'asc')
                                ->first();
                        @endphp
                        @if($prevService || $nextService)
                            <div class="single-service__nav" style="margin-top: 30px;">
                                @if($prevService)
                                    <a class="single-service__prev" href="{{ route('services.show', $prevService->slug) }}">{{ $prevService->title }}</a>
                                @endif
                                @if($nextService)
                                    <a class="single-service__next" href="{{ route('services.show', $nextService->slug) }}">{{ $nextService->title }}</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-md-4 col-lg-4">
                    <div class="single-service-sidebar right">
                        {{-- All Services List --}}
                        <div class="widget widget-categories">
                            <h3 class="widget-title">Tüm Hizmetler</h3>
                            <ul class="widget-categories__list">
                                @php
                                    $allServices = \App\Models\Service::active()->get();
                                @endphp
                                @foreach($allServices as $s)
                                    <li class="{{ $s->id === $service->id ? 'active' : '' }}">
                                        <a href="{{ route('services.show', $s->slug) }}">{{ $s->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Contact Widget --}}
                        <div class="widget widget-banner">
                            <div class="widget-banner__box">
                                <h4 class="widget-banner__box-title">Hemen Danışmanlık Alın!</h4>
                                <p class="widget-banner__box-subtitle">Bizi Arayın:</p>
                                @php $settings = app(\App\Settings\SiteSettings::class); @endphp
                                <p class="widget-banner__box-phone">{{ $settings->phone ?? '' }}</p>
                            </div>
                        </div>

                        {{-- Appointment Widget --}}
                        <div class="widget" style="margin-top: 30px;">
                            <a href="{{ route('appointment.create') }}" class="btn-app" style="display: block; text-align: center; padding: 15px;">
                                <i class="fa fa-calendar" aria-hidden="true"></i> Online Randevu Al
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
