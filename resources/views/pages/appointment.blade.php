@extends('layouts.app')

@section('title', 'Randevu Al')

@section('content')
    <!-- Page Title -->
    <div class="page-title-wrapp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-title-01">Randevu Al</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li class="active">
                            <a href="{{ route('home') }}">Anasayfa</a>
                        </li>
                        <li>Randevu Al</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointment Form Content -->
    <div class="content-box-01 pad-top-38 pad-bt-100">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                    <div class="appointment-form-wrapp">
                        <h6 class="subtitle-04">Online Randevu</h6>
                        <h3 class="title-02">Randevu
                            <span>Talebi</span>
                        </h3>
                        <p style="margin-bottom: 30px; color: #666;">
                            Aşağıdaki formu doldurarak randevu talebinde bulunabilirsiniz. Talebiniz en kısa sürede değerlendirilecektir.
                        </p>

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

                        <form action="{{ route('appointment.store') }}" method="POST" class="reply-form__form" novalidate>
                            @csrf

                            {{-- Ad Soyad --}}
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Ad Soyad <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       id="name"
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
                                <label for="email">E-posta <span class="text-danger">*</span></label>
                                <input type="email"
                                       class="form-control"
                                       id="email"
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
                                <label for="phone">Telefon <span class="text-danger">*</span></label>
                                <input type="tel"
                                       class="form-control"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="05XX XXX XX XX"
                                       required>
                                @if($errors->has('phone'))
                                    <span class="help-block text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            {{-- Hizmet Seçimi --}}
                            <div class="form-group {{ $errors->has('service_id') ? 'has-error' : '' }}">
                                <label for="service_id">Hizmet <span class="text-danger">*</span></label>
                                <select class="form-control"
                                        id="service_id"
                                        name="service_id"
                                        required>
                                    <option value="">-- Hizmet Seçiniz --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('service_id'))
                                    <span class="help-block text-danger">{{ $errors->first('service_id') }}</span>
                                @endif
                            </div>

                            {{-- Tercih Edilen Tarih/Saat --}}
                            <div class="form-group {{ $errors->has('preferred_at') ? 'has-error' : '' }}">
                                <label for="preferred_at">Tercih Edilen Tarih ve Saat <span class="text-danger">*</span></label>
                                <input type="datetime-local"
                                       class="form-control"
                                       id="preferred_at"
                                       name="preferred_at"
                                       value="{{ old('preferred_at') }}"
                                       min="{{ now()->format('Y-m-d\TH:i') }}"
                                       required>
                                @if($errors->has('preferred_at'))
                                    <span class="help-block text-danger">{{ $errors->first('preferred_at') }}</span>
                                @endif
                            </div>

                            {{-- Notlar --}}
                            <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                                <label for="notes">Notlar</label>
                                <textarea class="form-control"
                                          id="notes"
                                          name="notes"
                                          rows="4"
                                          placeholder="Eklemek istediğiniz notlar (opsiyonel)">{{ old('notes') }}</textarea>
                                @if($errors->has('notes'))
                                    <span class="help-block text-danger">{{ $errors->first('notes') }}</span>
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
                                    <i class="fa fa-calendar-check-o"></i> Randevu Talebi Gönder
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .appointment-form-wrapp {
        background: #fff;
        padding: 40px;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    .appointment-form-wrapp .form-group {
        margin-bottom: 20px;
    }
    .appointment-form-wrapp label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    .appointment-form-wrapp .form-control {
        height: 45px;
        border-radius: 3px;
        border: 1px solid #ddd;
        font-size: 14px;
        padding: 6px 15px;
    }
    .appointment-form-wrapp textarea.form-control {
        height: auto;
        padding: 12px 15px;
    }
    .appointment-form-wrapp select.form-control {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23333' viewBox='0 0 12 12'%3E%3Cpath d='M2 4l4 4 4-4'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 30px;
    }
    .appointment-form-wrapp .has-error .form-control {
        border-color: #e74c3c;
    }
    .appointment-form-wrapp .help-block {
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }
    .appointment-form-wrapp .checkbox label {
        font-weight: normal;
        font-size: 13px;
    }
    .appointment-form-wrapp .btn-01 {
        width: 100%;
        text-align: center;
        padding: 14px 20px;
        font-size: 15px;
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
        .appointment-form-wrapp {
            padding: 20px 15px;
            margin: 0 -5px;
        }
        .col-md-8.col-md-offset-2 {
            width: 100%;
            margin-left: 0;
        }
    }
</style>
@endpush
