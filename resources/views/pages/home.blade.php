@extends('layouts.app')

@section('title', $settings->hero_title ?: 'Psikolog Hasibe Çavuşoğlu')

@section('schema-org')
    <x-schema-org type="both" />
@endsection

@section('content')
<main class="content-row">

    {{-- Hero (index_02: img-box-01, ortalı) --}}
    <div class="img-box-01">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="subtitle-07">{{ $settings->hero_subtitle }}</p>
                    <h1 class="title-06">
                        {!! nl2br(e($settings->hero_title)) !!}
                    </h1>
                    <a class="btn-02" href="{{ route('about') }}">Hakkımda</a>
                    <a class="btn-03" href="{{ route('appointment.create') }}">{{ $settings->hero_cta_text ?: 'Randevu Al' }}</a>
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
                            <div class="icon-boxes-04">
                                <p class="icon-boxes-04__icon">01</p>
                                <h4 class="icon-boxes-04__title">Uzman Klinik Psikolog</h4>
                                <div class="icon-boxes-04__text">
                                    <p>Bireylere, çiftlere ve ailelere yönelik profesyonel psikolojik danışmanlık ve terapi hizmeti sunuyorum.</p>
                                </div>
                            </div>
                            <div class="icon-boxes-04">
                                <p class="icon-boxes-04__icon">02</p>
                                <h4 class="icon-boxes-04__title">Kanıta Dayalı Yöntemler</h4>
                                <div class="icon-boxes-04__text">
                                    <p>Bilişsel davranışçı terapi, şema terapi ve EMDR gibi etkinliği bilimsel olarak desteklenen yaklaşımlarla çalışıyorum.</p>
                                </div>
                            </div>
                            <div class="icon-boxes-04">
                                <p class="icon-boxes-04__icon">03</p>
                                <h4 class="icon-boxes-04__title">Güvenli ve Gizli Alan</h4>
                                <div class="icon-boxes-04__text">
                                    <p>Görüşmeler tamamen gizli, yargısız ve güvenli bir ortamda yürütülür. Kendinizi rahatça ifade edebilirsiniz.</p>
                                </div>
                            </div>
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
                        <h3 class="title-03">Merhaba! Ben
                            <span>Uzman Psikolog Hasibe Çavuşoğlu</span>
                        </h3>
                        <div class="about-me-text-01">
                            <p>Uzman klinik psikolog olarak yıllardır bireylere, çiftlere ve ailelere profesyonel psikolojik destek sunmaktayım. Amacım; güvenli, gizli ve yargısız bir ortamda, kanıta dayalı yöntemlerle yanınızda olmak ve içsel potansiyelinizi keşfetmenize yardımcı olmaktır. Geçmişi değiştiremesek de, yaşamınızdaki zorlukları birlikte anlayıp çözebiliriz.</p>
                        </div>
                        <p class="about-me-meta">Hemen arayın ve
                            <a href="{{ route('appointment.create') }}">randevu oluşturun</a>
                        </p>
                        <p class="about-me-phone">
                            <span class="about-me-p-01">{{ $settings->phone }}</span>
                            @if($settings->whatsapp)
                                veya
                                <span class="about-me-p-02">{{ $settings->whatsapp }}</span>
                            @endif
                        </p>
                        <div class="about-me-author">
                            <div class="about-me-author__img">
                                <img src="{{ asset('img/about_me/about_me_img.jpg') }}" alt="Hasibe Çavuşoğlu">
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
                <div class="col-lg-6 text-md-center">
                    <figure class="about-us-img-01 mar-top-20">
                        <img src="{{ asset('img/about_me/about_me_img.jpg') }}" alt="Uzman Psikolog Hasibe Çavuşoğlu">
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
                        @if($service->image)
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
                                        @if($service->image)
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
                    <div class="icon-boxes-in-wrapp">
                        <div class="icon-boxes-in-wrapp-row">
                            <div class="icon-boxes-in">
                                <div class="icon-boxes-02 icon--02">
                                    <figure class="icon-boxes-02__icon">
                                        <img src="{{ asset('img/icons/box_icon_01.png') }}" alt="Gizlilik">
                                    </figure>
                                    <h5 class="icon-boxes-02__title">Gizlilik</h5>
                                    <p class="icon-boxes-02__text">Tüm görüşmeler gizlidir ve paylaştığınız bilgiler korunur. Mahremiyetiniz önceliğimizdir.</p>
                                </div>
                                <div class="icon-boxes-02 icon--02">
                                    <figure class="icon-boxes-02__icon">
                                        <img src="{{ asset('img/icons/box_icon_04.png') }}" alt="Profesyonellik">
                                    </figure>
                                    <h5 class="icon-boxes-02__title">Profesyonellik</h5>
                                    <p class="icon-boxes-02__text">Etik ilkelere bağlı, kanıta dayalı ve profesyonel bir yaklaşımla hizmet veriyorum.</p>
                                </div>
                                <div class="icon-boxes-02 icon--02">
                                    <figure class="icon-boxes-02__icon">
                                        <img src="{{ asset('img/icons/box_icon_02.png') }}" alt="Destek">
                                    </figure>
                                    <h5 class="icon-boxes-02__title">İçten Destek</h5>
                                    <p class="icon-boxes-02__text">Zorlandığınız her konuda, yargılamadan ve içtenlikle yanınızda olmaya özen gösteriyorum.</p>
                                </div>
                            </div>
                            <div class="icon-boxes-in">
                                <div class="img-wrapp-01 home-values-img">
                                    <img src="{{ asset('img/about_me/about_me_img.jpg') }}" alt="Uzman Psikolog Hasibe Çavuşoğlu">
                                </div>
                            </div>
                            <div class="icon-boxes-in">
                                <div class="icon-boxes-02 icon-boxes-02--right icon--02">
                                    <figure class="icon-boxes-02__icon">
                                        <img src="{{ asset('img/icons/box_icon_05.png') }}" alt="Deneyim">
                                    </figure>
                                    <h5 class="icon-boxes-02__title">Deneyim</h5>
                                    <p class="icon-boxes-02__text">Yıllara dayanan klinik deneyimle farklı yaş ve ihtiyaçlardaki danışanlarla çalışıyorum.</p>
                                </div>
                                <div class="icon-boxes-02 icon-boxes-02--right icon--02">
                                    <figure class="icon-boxes-02__icon">
                                        <img src="{{ asset('img/icons/box_icon_03.png') }}" alt="Gelişim">
                                    </figure>
                                    <h5 class="icon-boxes-02__title">Sürekli Gelişim</h5>
                                    <p class="icon-boxes-02__text">Düzenli eğitim ve süpervizyonlarla mesleki bilgimi güncel tutuyorum.</p>
                                </div>
                                <div class="icon-boxes-02 icon-boxes-02--right icon--02">
                                    <figure class="icon-boxes-02__icon">
                                        <img src="{{ asset('img/icons/box_icon_06.png') }}" alt="Güvenilirlik">
                                    </figure>
                                    <h5 class="icon-boxes-02__title">Güvenilirlik</h5>
                                    <p class="icon-boxes-02__text">Süreç boyunca yanınızdayım. Bir adım atmaya hazır olduğunuzda bana ulaşabilirsiniz.</p>
                                </div>
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
                        <h3 class="title-02 mar-bt-21">Neden
                            <span>Beni Seçmelisiniz</span>
                        </h3>
                        <div class="serv-content-02">
                            <p>Terapiye sıcak, samimi ve gerçekçi bir yaklaşım sunuyorum; konuşabileceğiniz güvenli, gizli ve yargısız bir alan oluşturuyorum.</p>
                        </div>
                        <div class="tabs tabs-horizontal-01">
                            <ul class="tabs__caption">
                                <li class="active">Avantajlar</li>
                                <li>Süreç</li>
                                <li>Sonuçlar</li>
                            </ul>
                            <div class="tabs__content active">
                                <p>Kanıta dayalı psikoterapilerde eğitim ve deneyimimle, her danışanın ihtiyacına göre esnek ve iş birlikçi bir terapi süreci yürütüyorum.</p>
                                <ul class="list-01 list-01--style-01">
                                    <li>Ücretsiz ön görüşme ve değerlendirme</li>
                                    <li>Online ve yüz yüze görüşme imkânı</li>
                                    <li>Tamamen gizli ve kişiye özel süreç</li>
                                    <li>İhtiyaca göre uyarlanmış terapi planı</li>
                                </ul>
                            </div>
                            <div class="tabs__content">
                                <p>İlk görüşmede sizi tanır, ihtiyaçlarınızı birlikte değerlendiririz. Ardından size en uygun yöntemi belirleyip adım adım ilerleyen, şeffaf bir terapi süreci planlarız.</p>
                            </div>
                            <div class="tabs__content">
                                <p>Hedefimiz; duygusal dayanıklılığınızı artırmak, ilişkilerinizi güçlendirmek ve günlük yaşamınızda kendinizi daha iyi hissetmenizi sağlamaktır. İlerleme süreç içinde birlikte değerlendirilir.</p>
                            </div>
                        </div>
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
