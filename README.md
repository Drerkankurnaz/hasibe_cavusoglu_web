# Psikolog Web Sitesi

Klinik psikolog için tanıtım, blog ve online randevu web sitesi. Frontend olarak **Optima** HTML şablonu kullanılır; içerik **Filament v3** tabanlı yönetim paneli üzerinden yönetilir.

## Özellikler

- Tanıtım sayfaları (anasayfa, hakkımda, hizmetler)
- Blog (kategori, etiket, arama, sidebar, okunma sayacı)
- Online randevu talebi (KVKK onaylı, e-posta bildirimli)
- İletişim formu (harita, çalışma saatleri, WhatsApp)
- SSS (accordion)
- Danışan yorumları (onay mekanizmalı slider)
- Filament admin paneli ile tüm içeriğin yönetimi
- SEO (meta, sitemap, Open Graph, Schema.org `MedicalBusiness`)
- KVKK uyumlu form akışları ve aydınlatma metni
- Rol bazlı yetkilendirme (admin / editor)

## Teknoloji

| Katman | Teknoloji |
|--------|-----------|
| Backend | Laravel 11 (PHP 8.3) |
| Admin paneli | Filament v3 |
| Veritabanı | MySQL 8 |
| Frontend | Optima HTML şablonu — Bootstrap 3.3.7 + jQuery 2.2.4 + Owl Carousel + SuperFish + Waypoint |
| Mail | Laravel Mailable + Queue |

> Not: Frontend, şablonun kendi stack'ini korur. Tailwind kullanılmaz; mevcut `style.css` ve jQuery plugin'leri olduğu gibi taşınır, statik HTML Blade'e parçalanır.

## Gereksinimler

- PHP >= 8.3
- Composer 2.x
- MySQL >= 8.0
- Node.js (opsiyonel — yalnızca asset derlemesi gerekirse)

## Proje Yapısı

```
.
├─ app/
│  ├─ Models/            # Service, Post, Category, Tag, Testimonial, Faq,
│  │                     # Appointment, ContactMessage, Page, TeamMember
│  ├─ Filament/
│  │  ├─ Resources/      # Her model için Filament Resource
│  │  └─ Pages/          # SiteSettings vb. custom sayfalar
│  ├─ Http/
│  │  ├─ Controllers/    # Public site controller'ları
│  │  └─ Requests/       # Form validation (iletişim, randevu)
│  ├─ Mail/              # AppointmentReceived, AppointmentConfirmed, ContactMessageMail
│  └─ Settings/          # SiteSettings (spatie/laravel-settings)
├─ database/
│  ├─ migrations/
│  └─ seeders/
├─ resources/views/
│  ├─ layouts/
│  │  ├─ app.blade.php   # Ana layout (head + JS, Optima'dan)
│  │  └─ partials/       # header.blade.php, footer.blade.php
│  ├─ components/        # hero, service-card, testimonial, meta vb.
│  └─ pages/             # home, about, services, blog, faq, contact, appointment
├─ public/
│  ├─ css/  js/  img/  fonts/   # @raw_template'ten taşınan assetler
├─ raw_template/         # Optima HTML şablonu (kaynak — repo dışı tutulabilir)
└─ routes/web.php
```

## Kurulum

```bash
# 1. Bağımlılıklar
composer install

# 2. Ortam dosyası
cp .env.example .env
php artisan key:generate

# 3. .env içinde veritabanı bilgilerini düzenle (DB_*) ve MAIL_* ayarlarını gir

# 4. Migration + seed
php artisan migrate --seed

# 5. Storage link (medya görselleri için)
php artisan storage:link

# 6. Filament yönetici kullanıcısı oluştur
php artisan make:filament-user

# 7. (İlk kurulumda) şablon assetlerini taşı
#    raw_template/{css,js,img,fonts} → public/ altına kopyalanır

# 8. Sunucuyu başlat
php artisan serve
```

Admin paneli: `http://localhost:8000/admin`
Public site: `http://localhost:8000`

## Veritabanı Modelleri

| Model | Açıklama |
|-------|----------|
| `Service` | Hizmet / uzmanlık alanı (ücret, süre, sıralama) |
| `Post` | Blog yazısı (taslak/yayın, okunma, SEO) |
| `Category` / `Tag` | Blog sınıflandırması |
| `Testimonial` | Danışan yorumu (onay mekanizmalı) |
| `Faq` | Sık sorulan soru |
| `Appointment` | Randevu talebi (durum + KVKK onayı) |
| `ContactMessage` | İletişim formu mesajı |
| `Page` | Statik sayfa (KVKK, gizlilik) |
| `TeamMember` | Uzman (çoklu uzman senaryosu — opsiyonel) |
| `SiteSettings` | Genel ayarlar (logo, iletişim, hero, sosyal medya) |

## Sayfa / Route Eşlemesi

| Route | Şablon kaynağı | İçerik |
|-------|----------------|--------|
| `/` | `index.html` | Hero, hizmetler, hakkımda, son bloglar, yorumlar, CTA |
| `/hakkimda` | `about_me.html` | Biyografi, eğitim, yaklaşım |
| `/hizmetler` | `services.html` | Hizmet listesi |
| `/hizmetler/{slug}` | `single_service.html` | Hizmet detay |
| `/blog` | `blog_with_right_sidebar.html` | Blog liste + filtre |
| `/blog/{slug}` | `blog_post_right_sidebar.html` | Blog detay |
| `/sss` | `faq.html` | SSS |
| `/randevu` | `appointment.html` | Randevu formu |
| `/iletisim` | `contacts.html` | İletişim formu + harita |
| `/kvkk`, `/gizlilik` | — | Statik (Page modeli) |

## Form Akışları

**İletişim:** Form → doğrulama → `ContactMessage` kaydı → yöneticiye e-posta → teşekkür mesajı.

**Randevu:** Form → doğrulama (KVKK onayı zorunlu) → `Appointment` kaydı (durum: `pending`) → yöneticiye bildirim + danışana "talep alındı" e-postası → yönetici panelden onaylayınca danışana "randevu onaylandı" e-postası.

## Yönetim Paneli (Filament)

`/admin` altında tüm içerik yönetilir: hizmetler, blog, kategoriler, etiketler, yorumlar, SSS, randevular, mesajlar, statik sayfalar ve site ayarları. Dashboard'da bekleyen randevu, okunmamış mesaj ve son blog widget'ları yer alır.

Roller: **admin** (tam yetki), **editor** (blog / SSS / yorum yönetimi).

## KVKK ve Hukuki Notlar

- Randevu ve iletişim formlarında açık rıza onay kutusu zorunludur; onay `kvkk_accepted` olarak saklanır.
- Aydınlatma metni ve gizlilik politikası `Page` modeli üzerinden yönetilir, form altında bağlantı verilir.
- Danışan verileri hassas veri kapsamındadır; panel erişimi yalnızca yetkili kullanıcılara açıktır.
- Sağlık meslek mensubu tanıtım/reklam mevzuatı gereği abartılı vaat içeren ifadelerden kaçınılmalıdır.

## Kullanılan Paketler

```
filament/filament:^3
filament/spatie-laravel-media-library-plugin
bezhansalleh/filament-shield
spatie/laravel-sluggable
spatie/laravel-sitemap
spatie/laravel-settings
awcodes/filament-tiptap-editor   # opsiyonel (zengin blog editörü)
```

## Geliştirme Aşamaları

1. Kurulum + veritabanı şeması
2. Filament panel + resource'lar
3. Optima → Blade dönüşümü (layout + partial'lar)
4. İçeriğin veritabanından beslenmesi
5. Form akışları + e-posta bildirimleri
6. SEO + KVKK + sitemap
7. Test + dağıtım

## Lisans

Optima şablonu Envato Elements lisansı kapsamındadır; lisans koşulları `raw_template/Licensing/` altında yer alır. Uygulama kodu proje sahibine aittir.
