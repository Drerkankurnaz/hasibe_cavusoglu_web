@props(['post'])

<article class="blog-post">
    @if($post->cover_image && Storage::disk('public')->exists($post->cover_image))
        <figure class="blog-post__img">
            <a href="{{ route('blog.show', $post->slug) }}">
                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}">
            </a>
        </figure>
    @endif
    <h3 class="blog-post__title">
        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
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
    </ul>
    <div class="blog-post__content">
        <p>{{ $post->excerpt }}</p>
    </div>
    <div class="blog-post__btn-wrapp">
        <a href="{{ route('blog.show', $post->slug) }}" class="blog-post__btn">Devamını Oku</a>
    </div>
</article>
