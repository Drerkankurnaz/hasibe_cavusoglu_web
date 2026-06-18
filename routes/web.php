<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| Psikolog web sitesi için tüm public route tanımları.
|
*/

// Anasayfa
Route::get('/', [HomeController::class, 'index'])->name('home');

// Hakkımda
Route::get('/hakkimda', [AboutController::class, 'index'])->name('about');

// Hizmetler
Route::get('/hizmetler', [ServiceController::class, 'index'])->name('services.index');
Route::get('/hizmetler/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Sık Sorulan Sorular
Route::get('/sss', [FaqController::class, 'index'])->name('faq');

// Randevu
Route::get('/randevu', [AppointmentController::class, 'create'])->name('appointment.create');

// İletişim
Route::get('/iletisim', [ContactController::class, 'create'])->name('contact.create');

// Dinamik Sayfalar (KVKK, Gizlilik Politikası vb.)
Route::get('/sayfa/{slug}', [PageController::class, 'show'])->name('page.show');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Throttled POST Routes
|--------------------------------------------------------------------------
|
| Form gönderimlerini rate-limit ile koruyan route'lar.
| Dakikada maksimum 5 istek sınırı uygulanır.
|
*/

Route::middleware('throttle:5,1')->group(function () {
    Route::post('/randevu', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::post('/iletisim', [ContactController::class, 'store'])->name('contact.store');
});
