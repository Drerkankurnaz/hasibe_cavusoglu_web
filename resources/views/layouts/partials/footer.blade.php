@inject('settings', 'App\Settings\SiteSettings')

@php
    $latestPosts = \App\Models\Post::published()->latest('published_at')->take(2)->get();
@endphp

<!-- Footer -->
<footer class="wrapp-footer">
    <div class="footer-box-01">
        <div class="container">
            <div class="row">
                {{-- Logo ve Hakkında + Sosyal Medya --}}
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <a href="{{ route('home') }}" class="footer-logo">
                        @if($settings->logo)
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Psikolog Hasibe Çavuşoğlu">
                        @else
                            <img src="{{ asset('img/logo.png') }}" alt="Psikolog Hasibe Çavuşoğlu">
                        @endif
                    </a>
                    <div class="widget widget-text">
                        <p>Profesyonel psikolojik danışmanlık hizmetleri ile yanınızdayız.</p>
                        @if(!empty($settings->social_links))
                            <ul class="social-list-01">
                                @foreach($settings->social_links as $social)
                                    <li>
                                        <a href="{{ $social['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" title="{{ $social['platform'] ?? '' }}">
                                            <i class="fa fa-{{ $social['icon'] ?? $social['platform'] ?? '' }}" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                {{-- İletişim Bilgileri --}}
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <div class="widget widget-contacts">
                        <h3 class="widget-title">İletişim</h3>
                        <ul class="widget-contacts__list">
                            <li>{{ $settings->address }}</li>
                            <li>
                                <a class="contacts-email" href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                            </li>
                            <li>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->phone) }}">{{ $settings->phone }}</a>
                            </li>
                            @if(!empty($settings->working_hours))
                                <li>
                                    <p class="work-time">
                                        @foreach($settings->working_hours as $hour)
                                            {{ $hour['label'] ?? '' }}:
                                            <span>{{ $hour['value'] ?? '' }}</span>
                                            @if(!$loop->last)<br>@endif
                                        @endforeach
                                    </p>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                {{-- Son Blog Yazıları --}}
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <div class="widget widget-latest-news">
                        <h3 class="widget-title">Son Yazılar</h3>
                        @if($latestPosts->isNotEmpty())
                            <ul class="widget-latest-news__list">
                                @foreach($latestPosts as $post)
                                    <li>
                                        <h4 class="latest-news-title">
                                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                        </h4>
                                        <p class="latest-news-date">{{ $post->published_at->translatedFormat('d F Y') }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                {{-- Hızlı Linkler --}}
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <div class="widget widget-quick-links">
                        <h3 class="widget-title">Hızlı Linkler</h3>
                        <ul class="widget-quick-links__list">
                            <li>
                                <a href="{{ route('home') }}">Ana Sayfa</a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}">Hakkımda</a>
                            </li>
                            <li>
                                <a href="{{ route('services.index') }}">Hizmetler</a>
                            </li>
                            <li>
                                <a href="{{ route('blog.index') }}">Blog</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}">SSS</a>
                            </li>
                            <li>
                                <a href="{{ route('contact.create') }}">İletişim</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Telif Hakkı Bölümü --}}
    <div class="copy-footer-01">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="copy-footer-01__text">&copy; {{ date('Y') }} Design By <a href="https://www.otimeta.com" target="_blank" rel="noopener noreferrer">Otimeta</a> Tüm hakları saklıdır.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Back to Top Butonu --}}
    <a href="#" class="back2top" title="Yukarı Çık">Yukarı Çık</a>
</footer>
