@extends('layouts.app')

@section('title', $page->seo_title ?: $page->title)

@php
    $seoTitle = $page->seo_title ?: $page->title;
    $seoDescription = $page->seo_description ?: (app(\App\Settings\SiteSettings::class)->default_meta_description ?? '');
@endphp

@section('content')
    <!-- Page Title -->
    <div class="page-title-wrapp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-title-01">{{ $page->title }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li class="active">
                            <a href="{{ route('home') }}">Anasayfa</a>
                        </li>
                        <li>{{ $page->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="content-box-01 pad-top-75 pad-bt-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="page-content">
                        {!! $page->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
