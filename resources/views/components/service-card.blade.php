@props(['service'])

<div class="treatments-box">
    @if($service->image)
        <figure class="treatments-box__img">
            <a href="{{ route('services.show', $service->slug) }}">
                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
            </a>
        </figure>
    @elseif($service->icon)
        <figure class="treatments-box__img">
            <a href="{{ route('services.show', $service->slug) }}">
                <img src="{{ asset('img/services/treatments/' . $service->icon) }}" alt="{{ $service->title }}">
            </a>
        </figure>
    @else
        <figure class="treatments-box__img">
            <a href="{{ route('services.show', $service->slug) }}">
                <img src="{{ asset('img/services/treatments/treatments_01.jpg') }}" alt="{{ $service->title }}">
            </a>
        </figure>
    @endif
    <h3 class="treatments-box__title">
        <a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a>
    </h3>
    <div class="treatments-box__text">
        <p>{{ Str::limit($service->short_description, 120) }}</p>
    </div>
    @if($service->price)
        <p class="treatments-box__price" style="color: #1aad57; font-weight: bold; margin-bottom: 10px;">
            {{ number_format($service->price, 0, ',', '.') }} TL
            @if($service->duration)
                <small style="color: #999; font-weight: normal;">/ {{ $service->duration }}</small>
            @endif
        </p>
    @endif
    <a href="{{ route('services.show', $service->slug) }}" class="treatments-box__btn">Detaylı Bilgi</a>
</div>
