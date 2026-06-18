@extends('layouts.app')

@section('title', 'Sıkça Sorulan Sorular')

@php
    $seoTitle = 'Sıkça Sorulan Sorular';
    $seoDescription = 'Psikolojik danışmanlık hakkında sıkça sorulan sorular ve cevapları.';
@endphp

@section('content')
    <!-- Page Title -->
    <div class="page-title-wrapp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-title-01">Sıkça Sorulan Sorular</h1>
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
                                <x-faq-item
                                    :question="$faq->question"
                                    :answer="$faq->answer"
                                    :index="$index"
                                    :expanded="$loop->first && $loop->parent->first"
                                />
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
