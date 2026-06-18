@extends('layouts.app')

@section('title', $post->seo_title ?: $post->title)

@section('content')
    <!-- Page Title -->
    <div class="page-title-wrapp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-title-01">Blog Yazısı</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li class="active">
                            <a href="{{ route('home') }}">Anasayfa</a>
                        </li>
                        <li class="active">
                            <a href="{{ route('blog.index') }}">Blog</a>
                        </li>
                        <li>{{ $post->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Post Content -->
    <div class="content-box-01 pad-bt-57 pad-top-38">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-listing single-post right">
                        <article class="blog-post">
                            @if($post->cover_image)
                                <figure class="blog-post__img">
                                    <img src="{{ asset('img/blog/' . $post->cover_image) }}" alt="{{ $post->title }}">
                                </figure>
                            @endif

                            <h3 class="blog-post__title">
                                {{ $post->title }}
                            </h3>

                            <ul class="blog-post__meta-info">
                                <li>{{ $post->published_at->translatedFormat('d F Y') }}</li>
                                @if($post->category)
                                    <li>
                                        <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}">{{ $post->category->name }}</a>
                                    </li>
                                @endif
                                @if($post->reading_time)
                                    <li>{{ $post->reading_time }} dk okuma</li>
                                @endif
                                <li>{{ $post->views }} görüntülenme</li>
                            </ul>

                            <div class="blog-post__content">
                                {!! $post->body !!}
                            </div>

                            <!-- Etiketler -->
                            @if($post->tags->isNotEmpty())
                                <div class="blog-post__tags-wrapp">
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </article>

                        <!-- Sosyal Paylaşım -->
                        <ul class="single-post__soc-list">
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>

                        <!-- İlgili Yazılar -->
                        @if($relatedPosts->isNotEmpty())
                            <h4 class="single-post__featured-title">İlgili
                                <span>Yazılar</span>
                            </h4>
                            <div class="single-post__featured-box row">
                                @foreach($relatedPosts as $relatedPost)
                                    <div class="col-sm-6 col-md-4 col-lg-4">
                                        <div class="featured-post-01">
                                            @if($relatedPost->cover_image)
                                                <figure class="featured-post-01__img">
                                                    <a href="{{ route('blog.show', $relatedPost->slug) }}">
                                                        <img src="{{ asset('img/blog/' . $relatedPost->cover_image) }}" alt="{{ $relatedPost->title }}">
                                                    </a>
                                                </figure>
                                            @endif
                                            <div class="featured-post-01__content">
                                                <h3 class="featured-post-01__content-title">
                                                    <a href="{{ route('blog.show', $relatedPost->slug) }}">{{ $relatedPost->title }}</a>
                                                </h3>
                                                <ul class="featured-post-01__content-list">
                                                    <li>{{ $relatedPost->published_at->translatedFormat('d F Y') }}</li>
                                                    @if($relatedPost->category)
                                                        <li>
                                                            <a href="{{ route('blog.index', ['category' => $relatedPost->category->slug]) }}">{{ $relatedPost->category->name }}</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <div class="featured-post-01__content-text">
                                                    <p>{{ Str::limit($relatedPost->excerpt, 100) }}</p>
                                                </div>
                                                <a href="{{ route('blog.show', $relatedPost->slug) }}" class="featured-post-01__content-btn">Devamını Oku</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
