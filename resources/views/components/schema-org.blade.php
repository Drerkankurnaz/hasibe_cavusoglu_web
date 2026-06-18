{{-- Schema.org Yapılandırılmış Veri: MedicalBusiness, Person ve Article JSON-LD --}}
@props([
    'type' => 'both', // 'business', 'person', 'both', 'article'
    'post' => null, // Blog yazısı için Article schema
])

@php
    $settings = app(\App\Settings\SiteSettings::class);
@endphp

@if($type === 'business' || $type === 'both')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "MedicalBusiness",
    "name": "{{ config('app.name', 'Psikolog Hasibe Çavuşoğlu') }}",
    "description": "{{ $settings->default_meta_description ?? '' }}",
    "url": "{{ url('/') }}",
    "logo": "{{ $settings->logo ? asset('storage/' . $settings->logo) : asset('img/logo.png') }}",
    "image": "{{ $settings->logo ? asset('storage/' . $settings->logo) : asset('img/logo.png') }}",
    "telephone": "{{ $settings->phone ?? '' }}",
    "email": "{{ $settings->email ?? '' }}",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $settings->address ?? '' }}",
        "addressLocality": "Istanbul",
        "addressRegion": "Istanbul",
        "addressCountry": "TR"
    },
    @if(!empty($settings->social_links))
    "sameAs": [
        @foreach($settings->social_links as $index => $link)
            "{{ $link['url'] ?? '' }}"@if($index < count($settings->social_links) - 1),@endif

        @endforeach
    ],
    @endif
    @if(!empty($settings->working_hours))
    "openingHoursSpecification": [
        @foreach($settings->working_hours as $index => $hours)
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": "{{ $hours['day'] ?? '' }}",
            "opens": "{{ $hours['open'] ?? '' }}",
            "closes": "{{ $hours['close'] ?? '' }}"
        }@if($index < count($settings->working_hours) - 1),@endif

        @endforeach
    ],
    @endif
    "medicalSpecialty": "Psychiatric",
    "priceRange": "$$",
    "areaServed": {
        "@type": "City",
        "name": "Istanbul"
    },
    @if($settings->map_embed)
    "hasMap": "{{ url('/iletisim') }}",
    @endif
    "inLanguage": "tr"
}
</script>
@endif

@if($type === 'person' || $type === 'both')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Person",
    "name": "Hasibe Çavuşoğlu",
    "jobTitle": "Klinik Psikolog",
    "url": "{{ url('/hakkimda') }}",
    "image": "{{ asset('img/about_me/about_me.jpg') }}",
    "telephone": "{{ $settings->phone ?? '' }}",
    "email": "{{ $settings->email ?? '' }}",
    "worksFor": {
        "@type": "MedicalBusiness",
        "name": "{{ config('app.name', 'Psikolog Hasibe Çavuşoğlu') }}",
        "url": "{{ url('/') }}"
    },
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $settings->address ?? '' }}",
        "addressLocality": "Istanbul",
        "addressRegion": "Istanbul",
        "addressCountry": "TR"
    },
    @if(!empty($settings->social_links))
    "sameAs": [
        @foreach($settings->social_links as $index => $link)
            "{{ $link['url'] ?? '' }}"@if($index < count($settings->social_links) - 1),@endif

        @endforeach
    ],
    @endif
    "knowsAbout": [
        "Klinik Psikoloji",
        "Bireysel Terapi",
        "Çift Terapisi",
        "Aile Terapisi",
        "Bilişsel Davranışçı Terapi",
        "EMDR",
        "Şema Terapi"
    ],
    "inLanguage": "tr"
}
</script>
@endif

@if($type === 'article' && $post)
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "{{ $post->title }}",
    "description": "{{ $post->excerpt ?? '' }}",
    "url": "{{ url('/blog/' . $post->slug) }}",
    @if($post->cover_image)
    "image": "{{ asset('storage/' . $post->cover_image) }}",
    @endif
    "datePublished": "{{ $post->published_at ? $post->published_at->toIso8601String() : '' }}",
    "dateModified": "{{ $post->updated_at->toIso8601String() }}",
    "author": {
        "@type": "Person",
        "name": "Hasibe Çavuşoğlu",
        "url": "{{ url('/hakkimda') }}"
    },
    "publisher": {
        "@type": "Organization",
        "name": "{{ config('app.name', 'Psikolog Hasibe Çavuşoğlu') }}",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ $settings->logo ? asset('storage/' . $settings->logo) : asset('img/logo.png') }}"
        }
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ url('/blog/' . $post->slug) }}"
    },
    "inLanguage": "tr"
}
</script>
@endif
