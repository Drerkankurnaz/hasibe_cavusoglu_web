@extends('layouts.app')

@section('title', $settings->hero_title ?: 'Psikolog Hasibe Çavuşoğlu')

@section('schema-org')
    <x-schema-org type="both" />
@endsection

@section('content')
<main class="content-row">

    {{-- Hero (index_02: img-box-01, ortalı) --}}
    <div class="img-box-01" @if($settings->hero_image) style="background-image: url('{{ asset('storage/' . $settings->hero_image) }}');" @endif>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="subtitle-07">{{ $settings->hero_subtitle }}</p>
                    <h1 class="title-06">
                        {!! nl2br(e($settings->hero_title)) !!}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    {{-- Numaralı tanıtım kutuları (index_02: icon-boxes-04) --}}
    <div class="content-box-02 pad-top-70 pad-bt-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="icon-boxes-04-wrapp">
                        <div class="icon-boxes-04-row">
                            @foreach(($settings->intro_boxes ?? []) as $i => $box)
                            <div class="icon-boxes-04">
                                <p class="icon-boxes-04__icon">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</p>
                                <h4 class="icon-boxes-04__title">{{ $box['title'] ?? '' }}</h4>
                                <div class="icon-boxes-04__text">
                                    <p>{{ $box['text'] ?? '' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Hakkımda (index_02: content-box-01, metin + yan görsel) --}}
    <div class="content-box-01 pad-top-75 pad-bt-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-me-cont">
                        <p class="subtitle-01">Hakkımda</p>
                        <h3 class="title-03">
                            <span>{{ $settings->about_title }}</span>
                        </h3>
                        <div class="about-me-text-01">
                            @foreach(preg_split('/\R\s*\R/', trim($settings->about_text)) as $para)
                                @if(trim($para) !== '')<p>{{ $para }}</p>@endif
                            @endforeach
                        </div>
                        <p class="about-me-meta">Hemen arayın ve
                            <a href="{{ route('appointment.create') }}">randevu oluşturun</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 text-md-center">
                    <figure class="about-us-img-01 mar-top-20">
                        <img src="{{ $settings->about_image ? asset('storage/' . $settings->about_image) : asset('img/about_me/about_me_img.jpg') }}" alt="{{ $settings->about_title }}">
                    </figure>
                </div>
            </div>
        </div>
    </div>

    {{-- Banner kutuları (index_02: banners-wrapp) — ilk 3 hizmete dinamik --}}
    @php $bannerServices = $services->take(3); @endphp
    @if($bannerServices->count() > 0)
    <div class="banners-wrapp pad-bt-10">
        <div class="banners-wrapp-cont">
            @foreach($bannerServices as $index => $service)
            <div class="banners-box-01">
                <figure class="banners-box-01__img">
                    <a href="{{ route('services.show', $service->slug) }}">
                        @if($service->image && Storage::disk('public')->exists($service->image))
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                        @elseif($service->icon)
                            <img src="{{ asset('img/services/treatments/' . $service->icon) }}" alt="{{ $service->title }}">
                        @else
                            <img src="{{ asset('img/home_page/banners_box/banner_img_0' . ($index + 1) . '.jpg') }}" alt="{{ $service->title }}">
                        @endif
                    </a>
                </figure>
                <div class="banners-box-01__content">
                    <div class="banners-box-01-table">
                        <div class="banners-box-01-table__row">
                            <div class="banners-box-01-table__cell">
                                <h3 class="banners-box-01-title">
                                    <a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a>
                                </h3>
                                <div class="banners-box-01-text">
                                    <p>{{ Str::limit($service->short_description, 90) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Hizmetler / Terapi & Hizmetler Carousel (index_02: owl-carousel-03) --}}
    @if($services->count() > 0)
    <div class="content-box-01 pad-top-72 pad-bt-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="subtitle-01 text-center">Neler Sunuyoruz</p>
                    <h3 class="title-03 text-center mar-bt-50">Terapi
                        <span>&amp; Hizmetler</span>
                    </h3>
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
                                        @if($service->image && Storage::disk('public')->exists($service->image))
                                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                                        @elseif($service->icon)
                                            <img src="{{ asset('img/services/treatments/' . $service->icon) }}" alt="{{ $service->title }}">
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

    {{-- Değerler / İlkeler (index_02: content-box-02 overflow-01, icon-boxes-in) --}}
    <div class="content-box-02 overflow-01 pad-top-90 pad-bt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @php
                        $valueIcons = ['box_icon_01.png', 'box_icon_04.png', 'box_icon_02.png', 'box_icon_05.png', 'box_icon_03.png', 'box_icon_06.png'];
                        $allValues = $settings->values ?? [];
                        $valuesCol1 = array_slice($allValues, 0, 3);
                        $valuesCol2 = array_slice($allValues, 3, 3);
                    @endphp
                    <div class="icon-boxes-in-wrapp">
                        <div class="icon-boxes-in-wrapp-row">
                            <div class="icon-boxes-in">
                                @foreach($valuesCol1 as $i => $v)
                                <div class="icon-boxes-02 icon--02">
                                    <figure class="icon-boxes-02__icon">
                                        <img src="{{ asset('img/icons/' . ($valueIcons[$i] ?? 'box_icon_01.png')) }}" alt="{{ $v['title'] ?? '' }}">
                                    </figure>
                                    <h5 class="icon-boxes-02__title">{{ $v['title'] ?? '' }}</h5>
                                    <p class="icon-boxes-02__text">{{ $v['text'] ?? '' }}</p>
                                </div>
                                @endforeach
                            </div>
                            <div class="icon-boxes-in">
                                @foreach($valuesCol2 as $i => $v)
                                <div class="icon-boxes-02 icon-boxes-02--right icon--02">
                                    <figure class="icon-boxes-02__icon">
                                        <img src="{{ asset('img/icons/' . ($valueIcons[$i + 3] ?? 'box_icon_06.png')) }}" alt="{{ $v['title'] ?? '' }}">
                                    </figure>
                                    <h5 class="icon-boxes-02__title">{{ $v['title'] ?? '' }}</h5>
                                    <p class="icon-boxes-02__text">{{ $v['text'] ?? '' }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Neden Beni Seçmelisiniz + SSS (index_02: content-box-02, tabs + accordion) --}}
    <div class="content-box-02 pad-top-87">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="why-choose-me-box">
                        <p class="subtitle-01">Yaklaşımım</p>
                        <h3 class="title-02 mar-bt-21">
                            <span>{{ $settings->why_choose_title }}</span>
                        </h3>
                        <div class="serv-content-02">
                            <p>{{ $settings->why_choose_text }}</p>
                        </div>
                        @php $whyTabs = $settings->why_choose_tabs ?? []; @endphp
                        @if(count($whyTabs) > 0)
                        <div class="tabs tabs-horizontal-01">
                            <ul class="tabs__caption">
                                @foreach($whyTabs as $i => $tab)
                                <li class="{{ $i === 0 ? 'active' : '' }}">{{ $tab['title'] ?? '' }}</li>
                                @endforeach
                            </ul>
                            @foreach($whyTabs as $i => $tab)
                            @php $lines = array_values(array_filter(array_map('trim', preg_split('/\R/', $tab['content'] ?? '')), fn ($l) => $l !== '')); @endphp
                            <div class="tabs__content {{ $i === 0 ? 'active' : '' }}">
                                @if(count($lines) > 1)
                                    <p>{{ $lines[0] }}</p>
                                    <ul class="list-01 list-01--style-01">
                                        @foreach(array_slice($lines, 1) as $line)
                                            <li>{{ $line }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>{{ $lines[0] ?? '' }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <p class="subtitle-01">SSS</p>
                    <h3 class="title-02 mar-bt-21">Sık Sorulan
                        <span>Sorular</span>
                    </h3>
                    <div class="serv-content-03">
                        <p>Terapi süreci ve randevular hakkında en çok merak edilen soruları yanıtladık.</p>
                    </div>
                    @if($faqs->count() > 0)
                    <div class="accordion-01 acc-theme-03">
                        @foreach($faqs as $faq)
                        <h4 data-count="{{ $loop->iteration }}" class="accordion-01__title {{ $loop->first ? 'expanded_yes' : 'expanded_no' }}">{{ $faq->question }}</h4>
                        <div class="accordion-01__body">
                            <div class="accordion-01__text">
                                <p>
                                    <span>{{ $faq->answer }}</span>
                                </p>
                            </div>
                        </div>
                        @endforeach
                        <a class="accordion-01__btn" href="{{ route('faq') }}">Tüm soruları gör</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Referanslar / Danışan Yorumları (parallax-02) --}}
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
                                @php
                                    $nameWords = preg_split('/\s+/', trim($testimonial->author_name), -1, PREG_SPLIT_NO_EMPTY);
                                    $initials = mb_strtoupper(mb_substr($nameWords[0] ?? '', 0, 1));
                                    if (count($nameWords) > 1) {
                                        $initials .= mb_strtoupper(mb_substr(end($nameWords), 0, 1));
                                    }
                                @endphp
                                <figure class="owl-theme-01__item-user-img">
                                    <span class="testimonial-avatar" role="img" aria-label="{{ $testimonial->author_name }}">{{ $initials }}</span>
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

    {{-- Son Blog Yazıları (index_02: featured-post-01) --}}
    @if($posts->count() > 0)
    <div class="content-box-01 pad-top-85 pad-bt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="subtitle-01 text-center">Blog</h6>
                    <h3 class="title-03 title-03--mr-01 text-center">Son
                        <span>Yazılar</span>
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach($posts as $post)
                <div class="text-xs-center col-sm-4 col-md-4 col-lg-4">
                    <div class="featured-post-01">
                        <figure class="featured-post-01__img">
                            <a href="{{ route('blog.show', $post->slug) }}">
                                @if($post->cover_image)
                                    <img src="{{ asset('img/blog/' . $post->cover_image) }}" alt="{{ $post->title }}">
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

    {{-- Harita ve İletişim Bölümü (index_02: content-box-03) --}}
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
