@extends('layouts.app')

@section('title', 'Hizmetlerimiz - Psikolog Hasibe Çavuşoğlu')

@section('content')
<main class="content-row">
    {{-- Page Title & Breadcrumbs --}}
    <div class="page-title-wrapp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-title-01">Hizmetlerimiz</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li class="active">
                            <a href="{{ route('home') }}">Anasayfa</a>
                        </li>
                        <li>Hizmetlerimiz</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Services Intro Section --}}
    <div class="content-box-01 pad-top-38 pad-bt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="subtitle-01 text-center">Sizin için buradayız</p>
                    <h3 class="title-03 text-center mar-bt-50">Terapi &amp; <span>Hizmetler</span></h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Services Grid --}}
    <div class="content-box-02 pad-top-40 pad-bt-60">
        <div class="container">
            <div class="row">
                @forelse($services as $service)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <x-service-card :service="$service" />
                    </div>
                @empty
                    <div class="col-lg-12">
                        <div class="alert alert-info text-center">
                            <p>Henüz aktif hizmet bulunmamaktadır.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Call to Action --}}
    <div class="action-box-01">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="action-box-01__wrapp">
                        <h3 class="action-box-01__title">Hemen Danışmanlık Alın!
                            @php $settings = app(\App\Settings\SiteSettings::class); @endphp
                            <span>Arayın: {{ $settings->phone ?? '' }}</span>
                        </h3>
                        <p class="action-box-01__subtitle">Profesyonel ve deneyimli psikolog kadromuzla yanınızdayız</p>
                    </div>
                    <div class="action-box-01__btn-wrapp">
                        <a class="action-box-01__btn" href="{{ route('appointment.create') }}">Randevu Al</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
