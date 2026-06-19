{{-- Schema.org Yapılandırılmış Veri: MedicalBusiness, Person ve Article JSON-LD --}}
@props([
    'type' => 'both',
    'post' => null,
])

@php
    $settings = app(\App\Settings\SiteSettings::class);
    
    $schemas = [];
    
    if ($type === 'business' || $type === 'both') {
        $businessSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'MedicalBusiness',
            'name' => config('app.name', 'Psikolog Hasibe Çavuşoğlu'),
            'description' => $settings->default_meta_description ?? '',
            'url' => url('/'),
            'logo' => $settings->logo ? asset('storage/' . $settings->logo) : asset('img/logo.png'),
            'image' => $settings->logo ? asset('storage/' . $settings->logo) : asset('img/logo.png'),
            'telephone' => $settings->phone ?? '',
            'email' => $settings->email ?? '',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $settings->address ?? '',
                'addressLocality' => 'Istanbul',
                'addressRegion' => 'Istanbul',
                'addressCountry' => 'TR',
            ],
            'medicalSpecialty' => 'Psychiatric',
            'priceRange' => '$$',
            'areaServed' => ['@type' => 'City', 'name' => 'Istanbul'],
            'inLanguage' => 'tr',
        ];
        
        if (!empty($settings->social_links)) {
            $businessSchema['sameAs'] = collect($settings->social_links)->pluck('url')->filter()->values()->toArray();
        }
        
        if (!empty($settings->working_hours)) {
            $businessSchema['openingHoursSpecification'] = collect($settings->working_hours)->map(fn($h) => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => $h['label'] ?? '',
                'opens' => $h['value'] ?? '',
            ])->toArray();
        }
        
        $schemas[] = $businessSchema;
    }
    
    if ($type === 'person' || $type === 'both') {
        $personSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => 'Hasibe Çavuşoğlu',
            'jobTitle' => 'Klinik Psikolog',
            'url' => url('/hakkimda'),
            'image' => asset('img/about_me/about_me.jpg'),
            'telephone' => $settings->phone ?? '',
            'email' => $settings->email ?? '',
            'worksFor' => [
                '@type' => 'MedicalBusiness',
                'name' => config('app.name', 'Psikolog Hasibe Çavuşoğlu'),
                'url' => url('/'),
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $settings->address ?? '',
                'addressLocality' => 'Istanbul',
                'addressRegion' => 'Istanbul',
                'addressCountry' => 'TR',
            ],
            'knowsAbout' => [
                'Klinik Psikoloji', 'Bireysel Terapi', 'Çift Terapisi',
                'Aile Terapisi', 'Bilişsel Davranışçı Terapi', 'EMDR', 'Şema Terapi',
            ],
            'inLanguage' => 'tr',
        ];
        
        if (!empty($settings->social_links)) {
            $personSchema['sameAs'] = collect($settings->social_links)->pluck('url')->filter()->values()->toArray();
        }
        
        $schemas[] = $personSchema;
    }
    
    if ($type === 'article' && $post) {
        $articleSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $post->title,
            'description' => $post->excerpt ?? '',
            'url' => url('/blog/' . $post->slug),
            'datePublished' => $post->published_at ? $post->published_at->toIso8601String() : '',
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => ['@type' => 'Person', 'name' => 'Hasibe Çavuşoğlu', 'url' => url('/hakkimda')],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name', 'Psikolog Hasibe Çavuşoğlu'),
                'logo' => ['@type' => 'ImageObject', 'url' => $settings->logo ? asset('storage/' . $settings->logo) : asset('img/logo.png')],
            ],
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => url('/blog/' . $post->slug)],
            'inLanguage' => 'tr',
        ];
        
        if ($post->cover_image) {
            $articleSchema['image'] = asset('storage/' . $post->cover_image);
        }
        
        $schemas[] = $articleSchema;
    }
@endphp

@foreach($schemas as $schema)
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endforeach
