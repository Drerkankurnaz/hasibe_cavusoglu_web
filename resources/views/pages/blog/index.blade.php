@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <!-- Page Title -->
    <div class="page-title-wrapp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-title-01">Blog</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li class="active">
                            <a href="{{ route('home') }}">Anasayfa</a>
                        </li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Content -->
    <div class="content-box-01 pad-bt-57 pad-top-38">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Blog Posts (Sol kolon) -->
                    <div class="blog-listing right">
                        @forelse($posts as $post)
                            <x-post-card :post="$post" />
                        @empty
                            <div class="text-center" style="padding: 40px 0;">
                                <p>Henüz blog yazısı yayınlanmamıştır.</p>
                            </div>
                        @endforelse

                        <!-- Pagination -->
                        @if($posts->hasPages())
                            <div class="blog-pagination-wrapp">
                                {{ $posts->links() }}
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar (Sağ kolon) -->
                    <div class="blog-listing-sidebar right">
                        <!-- Kategoriler -->
                        <div class="widget widget-categories">
                            <h3 class="widget-title">Kategoriler</h3>
                            <ul class="widget-categories__list">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}">
                                            {{ $category->name }}
                                            @if($category->posts_count > 0)
                                                <span>({{ $category->posts_count }})</span>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Son Yazılar -->
                        <div class="widget widget-latest-news">
                            <h3 class="widget-title">Son Yazılar</h3>
                            <ul class="widget-latest-news__list">
                                @foreach($recentPosts as $recentPost)
                                    <li>
                                        @if($recentPost->cover_image)
                                            <figure class="widget-latest-news__list-img">
                                                <a href="{{ route('blog.show', $recentPost->slug) }}">
                                                    <img src="{{ asset('storage/' . $recentPost->cover_image) }}" alt="{{ $recentPost->title }}">
                                                </a>
                                            </figure>
                                        @endif
                                        <h3 class="widget-latest-news__title">
                                            <a href="{{ route('blog.show', $recentPost->slug) }}">{{ $recentPost->title }}</a>
                                        </h3>
                                        <ul class="widget-latest-news__meta">
                                            <li>{{ $recentPost->published_at->translatedFormat('d F Y') }}</li>
                                            @if($recentPost->category)
                                                <li>
                                                    <a href="{{ route('blog.index', ['category' => $recentPost->category->slug]) }}">{{ $recentPost->category->name }}</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Randevu Banner -->
                        <div class="widget widget-banner">
                            <div class="widget-banner__box">
                                <h4 class="widget-banner__box-title">Hemen Randevu Alın!</h4>
                                <p class="widget-banner__box-subtitle">Bizi Arayın:</p>
                                @php
                                    $settings = app(\App\Settings\SiteSettings::class);
                                @endphp
                                <p class="widget-banner__box-phone">{{ $settings->phone ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
