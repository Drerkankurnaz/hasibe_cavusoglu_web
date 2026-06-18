@extends('layouts.app')

@section('title', 'Sıkça Sorulan Sorular')

@section('content')
    <!-- Page Title -->
    <div class="page-title-wrapp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-title-01">Sıkça Sorulan Sorular</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li class="active">
                            <a href="{{ route('home') }}">Anasayfa</a>
                        </li>
                        <li>Sıkça Sorulan Sorular</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Content -->
    <div class="content-box-02 pad-top-75 pad-bt-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="subtitle-02">SSS</p>
                    <h3 class="title-02 title-02--mr-01">Sıkça Sorulan
                        <span>Sorular</span>
                    </h3>
                </div>
            </div>

            @forelse($faqs as $category => $categoryFaqs)
                @if($category)
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="faq-category-title" style="margin-top: 30px; margin-bottom: 20px; font-weight: 600; color: #333;">
                                {{ $category }}
                            </h4>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <div class="accordion-01 acc-theme-03">
                            @foreach($categoryFaqs as $index => $faq)
                                <h4 data-count="{{ $index + 1 }}" class="accordion-01__title {{ $loop->first && $loop->parent->first ? 'expanded_yes' : 'expanded_no' }}">
                                    {{ $faq->question }}
                                </h4>
                                <div class="accordion-01__body">
                                    <div class="accordion-01__text">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-center" style="padding: 40px 0;">Henüz soru eklenmemiştir.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
