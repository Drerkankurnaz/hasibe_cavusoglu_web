@extends('layouts.app')

@section('title', $settings->hero_title ?: 'Psikolog Hasibe Çavuşoğlu')

@section('schema-org')
    <x-schema-org type="both" />
@endsection

@section('content')
<main class="content-row">

    {{-- Hero Section --}}
    <div class="img-box-02">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <p class="subtitle-07">{{ $settings->hero_subtitle }}</p>
                    <h1 class="title-06">
                        {!! nl2br(e($settings->hero_title)) !!}
                    </h1>
                    <a class="btn-04" href="{{ route('about') }}">Hakkımda</a>
                    <a class="btn-05" href="{{ route('appointment.create') }}">{{ $settings->hero_cta_text ?: 'Randevu Al' }}</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Hakkımda / About Section --}}
    <div class="content-box-01 pad-top-95 pad-bt-110">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="home-bg-wrapp">
                        <div class="video_bg">
                            <div class="video_img-02"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="about-us-content-01">
                        <p class="subtitle-01">Hakkımda</p>
                        <h2 class="title-02">Profesyonel
                            <span>Psikolojik Destek</span>
                        </h2>
                        <div class="about-us-text-01 mar-bt-27">
                            <p>Uzman klinik psikolog olarak bireylere, çiftlere ve ailelere profesyonel psikolojik destek sunmaktayım. Bilişsel davranışçı terapi, şema terapi ve EMDR gibi kanıta dayalı yöntemlerle danışanlarıma yardımcı olmaktayım.</p>
                        </div>
                        <a href="{{ route('about') }}" class="btn-04">Daha Fazla</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Hizmetler / Therapies & Treatments Carousel --}}
    @if($services->count() > 0)
    <div class="content-box-02 pad-top-60 pad-bt-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="subtitle-01 text-center">Neler Sunuyoruz</p>
                    <h2 class="title-03 text-center mar-bt-50">Terapi
                        <span>&amp; Hizmetler</span>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel-03">
                        @foreach($services as $service)
                        <div class="owl-carousel-03__item">
                            <div class="owl-treatments">
                                <figure class="owl-treatments__img">
                                    <a href="{{ route('services.show', $service->slug) }}">
                                        @if($service->image)
                                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                                        @else
                                            <img src="{{ asset('img/about_us/owl/owl_img_01.jpg') }}" alt="{{ $service->title }}">
                                        @endif
                                    </a>
                                </figure>
                                <h4 class="owl-treatments__title">
                                    <a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a>
                                </h4>
                                <div class="owl-treatments__text">
                                    <p>{{ Str::limit($service->short_description, 100) }}</p>
                                </div>
                                <a href="{{ route('services.show', $service->slug) }}" class="owl-treatments__btn">Detaylı Bilgi</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Testimonials / Müşteri Yorumları Slider --}}
    @if($testimonials->count() > 0)
    <div class="parallax parallax-02">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="testimonials__subtitle">Referanslar</p>
                    <h2 class="testimonials__title">Danışanlarımız
                        <span>Ne Diyor</span>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel-01 owl-theme-01">
                        @foreach($testimonials as $testimonial)
                        <div class="owl-theme-01__item">
                            <div class="owl-theme-01__item-text">
                                <p>"{{ $testimonial->content }}"</p>
                            </div>
                            <div class="owl-theme-01__item-user">
                                <figure class="owl-theme-01__item-user-img">
                                    <img src="{{ asset('img/shortcodes/users/user_01.jpg') }}" alt="{{ $testimonial->author_name }}">
                                </figure>
                                <h3 class="owl-theme-01__item-user-name">{{ $testimonial->author_name }}</h3>
                                @if($testimonial->rating)
                                <p class="owl-theme-01__item-user-subtitle">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}" aria-hidden="true"></i>
                                    @endfor
                                </p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Son Blog Yazıları --}}
    @if($posts->count() > 0)
    <div class="content-box-01 pad-top-78 pad-bt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="subtitle-01 text-center">Blog</h6>
                    <h2 class="title-03 title-03--mr-01 text-center">Son
                        <span>Yazılar</span>
                    </h2>
                </div>
            </div>
            <div class="row">
                @foreach($posts as $post)
                <div class="text-xs-center col-sm-4 col-md-4 col-lg-4">
                    <div class="featured-post-01">
                        <figure class="featured-post-01__img">
                            <a href="{{ route('blog.show', $post->slug) }}">
                                @if($post->cover_image)
                                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}">
                                @else
                                    <img src="{{ asset('img/shortcodes/featured_post/featured_post_01.jpg') }}" alt="{{ $post->title }}">
                                @endif
                            </a>
                        </figure>
                        <div class="featured-post-01__content">
                            <h3 class="featured-post-01__content-title">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <ul class="featured-post-01__content-list">
                                <li>{{ $post->published_at ? $post->published_at->translatedFormat('d F Y') : '' }}</li>
                                @if($post->category)
                                <li>
                                    <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}">{{ $post->category->name }}</a>
                                </li>
                                @endif
                            </ul>
                            <div class="featured-post-01__content-text">
                                <p>{{ Str::limit($post->excerpt, 120) }}</p>
                            </div>
                            <a href="{{ route('blog.show', $post->slug) }}" class="featured-post-01__content-btn">Devamını Oku</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Harita ve İletişim Bölümü --}}
    <div class="content-box-03">
        <div class="faq-content-02">
            <div class="faq-content-02__wrapp">
                <h6 class="subtitle-03">İletişim</h6>
                <h2 class="title-04">Bizi
                    <span>Haritada Bulun</span>
                </h2>
                <div class="faq-content-02__text">
                    <p>Profesyonel psikolojik danışmanlık hizmetlerimiz hakkında bilgi almak veya randevu oluşturmak için bizimle iletişime geçebilirsiniz.</p>
                </div>
                <p class="faq-content-02__location">{{ $settings->address }}</p>
                <a class="faq-content-02__email" href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                <p class="faq-content-02__phone">Ara:
                    <span><a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->phone) }}">{{ $settings->phone }}</a></span>
                </p>
            </div>
        </div>
        <div class="faq-content-03">
            @if($settings->map_embed)
                <div class="contacts_map">
                    {!! $settings->map_embed !!}
                </div>
            @else
                <div class="contacts_map">
                    <div id="map-canvas"></div>
                </div>
            @endif
        </div>
    </div>

</main>
@endsection
