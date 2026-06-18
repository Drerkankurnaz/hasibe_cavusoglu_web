@extends('layouts.app')

@section('title', 'Sayfa Bulunamadı')

@php
    $seoTitle = 'Sayfa Bulunamadı';
    $seoDescription = '404 - Aradığınız sayfa bulunamadı.';
@endphp

@section('content')
    <!-- Content -->
    <main class="content-row page-404">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="page-404-wrapp">
                        <h2 class="page-404-title">404</h2>
                        <p class="page-404-subtitle">Sayfa Bulunamadı!</p>
                        <p class="page-404-text">Aradığınız sayfa taşınmış, silinmiş veya hiç var olmamış olabilir.</p>
                        <a href="{{ route('home') }}" class="page-404-btn">Anasayfaya Dön</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
