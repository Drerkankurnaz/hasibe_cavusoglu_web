@extends('layouts.app')

@section('title', 'İletişim')

@section('content')
    <!-- Page Title -->
    <div class="page-title-wrapp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-title-01">İletişim</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li class="active">
                            <a href="{{ route('home') }}">Anasayfa</a>
                        </li>
                        <li>İletişim</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Content -->
    <div class="content-box-01 pad-bt-90">
        <div class="container">
            <div class="row">
                {{-- Harita ve İletişim Bilgileri --}}
                <div class="col-md-6 col-lg-6">
                    <div class="contacts-map-wrapp">
                        @if($settings->map_embed)
                            <div class="contacts_map">
                                {!! $settings->map_embed !!}
                            </div>
                        @else
                            <div class="contacts_map" style="background: #f5f5f5; display: flex; align-items: center; justify-content: center; min-height: 300px;">
                                <p style="color: #999;"><i class="fa fa-map-marker fa-2x"></i><br>Harita bulunamadı</p>
                            </div>
                        @endif
                    </div>

                    {{-- İletişim Bilgileri --}}
                    <div class="contacts-info-block" style="margin-top: 30px;">
                        @if($settings->address)
                            <p class="contact-location">
                                <i class="fa fa-map-marker"></i> {{ $settings->address }}
                            </p>
                        @endif
                        @if($settings->email)
                            <a class="contact-mail" href="mailto:{{ $settings->email }}">
                                <i class="fa fa-envelope-o"></i> {{ $settings->email }}
                            </a>
                        @endif
                        @if($settings->phone)
                            <p class="contact-phone">
                                <i class="fa fa-phone"></i> Ara:
                                <span><a href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a></span>
                            </p>
                        @endif
                        @if($settings->whatsapp)
                            <p class="contact-phone">
                                <i class="fa fa-whatsapp"></i> WhatsApp:
                                <span><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp) }}" target="_blank">{{ $settings->whatsapp }}</a></span>
                            </p>
                        @endif
                    </div>
                </div>

                {{-- İletişim Formu --}}
                <div class="col-md-6 col-lg-6">
                    <div class="contacts-block-wrapp">
                        <h6 class="subtitle-04">Bize Ulaşın</h6>
                        <h3 class="title-02">İletişim
                            <span>Formu</span>
                        </h3>
                        <div class="contacts-block-01">
                            <p>Sorularınız, önerileriniz veya randevu talepleriniz için aşağıdaki formu kullanarak bize ulaşabilirsiniz.</p>
                        </div>

                        {{-- Başarı Mesajı --}}
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                <i class="fa fa-check-circle"></i> {{ session('success') }}
                            </div>
                        @endif

                        {{-- Genel Hata Mesajı --}}
                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-exclamation-circle"></i> Lütfen formdaki hataları düzeltin.
                            </div>
                        @endif

                        <div class="reply-form">
                            <form action="{{ route('contact.store') }}" method="POST" class="reply-form__form" novalidate>
                                @csrf

                                {{-- Ad Soyad --}}
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="contact-name">Ad Soyad <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control"
                                           id="contact-name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Ad Soyad"
                                           required>
                                    @if($errors->has('name'))
                                        <span class="help-block text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                {{-- E-posta --}}
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="contact-email">E-posta <span class="text-danger">*</span></label>
                                    <input type="email"
                                           class="form-control"
                                           id="contact-email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="E-posta adresiniz"
                                           required>
                                    @if($errors->has('email'))
                                        <span class="help-block text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                {{-- Telefon --}}
                                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                    <label for="contact-phone">Telefon</label>
                                    <input type="tel"
                                           class="form-control"
                                           id="contact-phone"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="05XX XXX XX XX">
                                    @if($errors->has('phone'))
                                        <span class="help-block text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                {{-- Konu --}}
                                <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                                    <label for="contact-subject">Konu</label>
                                    <input type="text"
                                           class="form-control"
                                           id="contact-subject"
                                           name="subject"
                                           value="{{ old('subject') }}"
                                           placeholder="Mesajınızın konusu">
                                    @if($errors->has('subject'))
                                        <span class="help-block text-danger">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>

                                {{-- Mesaj --}}
                                <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                                    <label for="contact-message">Mesaj <span class="text-danger">*</span></label>
                                    <textarea class="form-control"
                                              id="contact-message"
                                              name="message"
                                              rows="5"
                                              placeholder="Mesajınız (en az 10 karakter)"
                                              required>{{ old('message') }}</textarea>
                                    @if($errors->has('message'))
                                        <span class="help-block text-danger">{{ $errors->first('message') }}</span>
                                    @endif
                                </div>

                                {{-- KVKK Onayı --}}
                                <div class="form-group {{ $errors->has('kvkk') ? 'has-error' : '' }}">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   name="kvkk"
                                                   value="1"
                                                   {{ old('kvkk') ? 'checked' : '' }}>
                                            <a href="{{ route('page.show', 'kvkk') }}" target="_blank" style="text-decoration: underline;">
                                                KVKK Aydınlatma Metni</a>'ni okudum ve kabul ediyorum. <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    @if($errors->has('kvkk'))
                                        <span class="help-block text-danger">{{ $errors->first('kvkk') }}</span>
                                    @endif
                                </div>

                                {{-- Gönder Butonu --}}
                                <div class="form-group">
                                    <button type="submit" class="btn-01">
                                        <i class="fa fa-paper-plane"></i> Mesaj Gönder
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .contacts-map-wrapp {
        margin-top: 20px;
    }
    .contacts_map iframe {
        width: 100%;
        height: 300px;
        border: none;
        border-radius: 4px;
    }
    .contacts-info-block {
        padding: 20px 0;
    }
    .contacts-info-block .contact-location,
    .contacts-info-block .contact-mail,
    .contacts-info-block .contact-phone {
        display: block;
        margin-bottom: 10px;
        font-size: 14px;
    }
    .contacts-info-block .contact-mail {
        color: #333;
        text-decoration: none;
    }
    .contacts-info-block .contact-mail:hover {
        color: #f7941e;
    }
    .contacts-info-block .fa {
        width: 20px;
        text-align: center;
        margin-right: 8px;
        color: #f7941e;
    }
    .contacts-block-wrapp .form-group {
        margin-bottom: 20px;
    }
    .contacts-block-wrapp label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    .contacts-block-wrapp .form-control {
        height: 45px;
        border-radius: 3px;
        border: 1px solid #ddd;
        font-size: 14px;
        padding: 6px 15px;
    }
    .contacts-block-wrapp textarea.form-control {
        height: auto;
        padding: 12px 15px;
    }
    .contacts-block-wrapp .has-error .form-control {
        border-color: #e74c3c;
    }
    .contacts-block-wrapp .help-block {
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }
    .contacts-block-wrapp .checkbox label {
        font-weight: normal;
        font-size: 13px;
    }
    .alert {
        padding: 15px 20px;
        margin-bottom: 25px;
        border-radius: 4px;
    }
    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }
    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }
    .text-danger {
        color: #e74c3c;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .contacts-block-wrapp {
            margin-top: 40px;
        }
        .contacts_map iframe {
            height: 250px;
        }
    }
</style>
@endpush
