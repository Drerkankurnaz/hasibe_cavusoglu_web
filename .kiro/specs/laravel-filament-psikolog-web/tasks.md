# Implementation Plan: Laravel Filament Psikolog Web

## Overview

Bu plan, Optima psikoloji HTML şablonunun Laravel 11 + Filament v3 uygulamasına dönüştürülmesinin adım adım implementasyon görevlerini tanımlar. Her görev, önceki görevlerin üzerine inşa eder ve sonunda tüm bileşenler birbirine bağlanır.

## Tasks

- [x] 1. Proje Altyapısı ve Yapılandırma
  - [x] 1.1 Laravel 11 projesini oluştur ve temel composer paketlerini kur
    - `composer create-project laravel/laravel` ile Laravel 11 projesi oluştur
    - Gerekli paketleri kur: `spatie/laravel-sluggable`, `spatie/laravel-medialibrary`, `spatie/laravel-settings`, `filament/filament`, `filament/spatie-laravel-media-library-plugin`, `bezhansalleh/filament-shield`, `spatie/laravel-sitemap`
    - `.env` dosyasında MySQL 8 bağlantı ayarlarını yapılandır
    - `config/app.php` timezone ve locale ayarlarını tr olarak güncelle
    - _Requirements: 1.1, 1.2, 1.3, 1.4_

  - [x] 1.2 Filament v3 admin panelini ve Shield'ı yapılandır
    - `php artisan filament:install --panels` ile Filament panelini kur
    - Admin panel path'ini `/admin` olarak ayarla
    - `php artisan shield:install` ile Shield'ı kur
    - Admin ve editor rollerini tanımla
    - _Requirements: 1.3, 8.1, 8.2, 8.3_

  - [x] 1.3 Statik asset'leri public/ dizinine taşı
    - `raw_template/HTML/css/`, `js/`, `img/`, `fonts/` dizinlerini `public/css/`, `public/js/`, `public/img/`, `public/fonts/` dizinlerine kopyala
    - Asset dosyalarının doğru yüklendiğini doğrula
    - _Requirements: 1.5, 1.6, 2.1_

- [x] 2. Veritabanı Şeması ve Migration'lar
  - [x] 2.1 Services, Categories, Tags migration'larını oluştur
    - `services` tablosu: id, title, slug(unique), short_description(varchar 280), description(longtext), icon(nullable), image(nullable), price(decimal 8,2 nullable), duration(nullable), order(default 0), is_active(default true), seo_title(nullable), seo_description(nullable), timestamps
    - `categories` tablosu: id, name, slug(unique), timestamps
    - `tags` tablosu: id, name, slug(unique), timestamps
    - _Requirements: 3.1, 3.3, 3.4_

  - [x] 2.2 Posts ve post_tag pivot migration'larını oluştur
    - `posts` tablosu: id, category_id(FK nullable), title, slug(unique), excerpt(varchar 300), body(longtext), cover_image(nullable), status(enum draft/published default draft), published_at(nullable), reading_time(int nullable), views(default 0), seo_title(nullable), seo_description(nullable), timestamps
    - `post_tag` pivot tablosu: post_id(FK), tag_id(FK)
    - _Requirements: 3.2, 3.4_

  - [x] 2.3 Testimonials, FAQs, TeamMembers migration'larını oluştur
    - `testimonials` tablosu: id, author_name, content(text), rating(tinyint nullable), is_approved(default false), order(default 0), timestamps
    - `faqs` tablosu: id, question, answer(text), category(nullable), order(default 0), is_active(default true), timestamps
    - `team_members` tablosu: id, name, title, bio(text), photo(nullable), order(default 0), socials(json nullable), is_active(default true), timestamps
    - _Requirements: 3.5, 3.6, 3.10_

  - [x] 2.4 Appointments, ContactMessages, Pages migration'larını oluştur
    - `appointments` tablosu: id, name, email, phone, service_id(FK nullable), preferred_at(datetime), status(enum pending/confirmed/cancelled/completed default pending), notes(text nullable), kvkk_accepted(boolean), timestamps
    - `contact_messages` tablosu: id, name, email, phone(nullable), subject(nullable), message(text), is_read(default false), timestamps
    - `pages` tablosu: id, title, slug(unique), body(longtext), seo_title(nullable), seo_description(nullable), timestamps
    - _Requirements: 3.7, 3.8, 3.9_

  - [x] 2.5 SiteSettings Spatie settings migration'ını oluştur
    - `database/settings/` altında SiteSettings migration dosyası oluştur
    - Tüm site ayarları alanlarını tanımla: logo, favicon, phone, whatsapp, email, address, map_embed, working_hours, social_links, hero_title, hero_subtitle, hero_cta_text, footer_text, ga_id, default_meta_description
    - _Requirements: 5.1_

- [x] 3. Eloquent Model'ler ve Enum'lar
  - [x] 3.1 Enum sınıflarını oluştur (PostStatus, AppointmentStatus)
    - `app/Enums/PostStatus.php`: draft, published
    - `app/Enums/AppointmentStatus.php`: pending, confirmed, cancelled, completed
    - _Requirements: 4.2, 4.6_

  - [x] 3.2 Service, Category, Tag model'lerini oluştur
    - Service: HasSlug trait, fillable, is_active boolean cast, scopeActive(), hasMany Appointment
    - Category: HasSlug trait, fillable, hasMany Post
    - Tag: HasSlug trait, fillable, belongsToMany Post
    - _Requirements: 4.1, 4.3_

  - [x] 3.3 Post, Testimonial, FAQ model'lerini oluştur
    - Post: HasSlug trait, fillable, PostStatus enum cast, datetime cast published_at, belongsTo Category, belongsToMany Tag, scopePublished()
    - Testimonial: fillable, is_approved boolean cast, scopeApproved()
    - FAQ: fillable, is_active boolean cast, scopeActive()
    - _Requirements: 4.2, 4.4, 4.5_

  - [x] 3.4 Appointment, ContactMessage, Page, TeamMember model'lerini oluştur
    - Appointment: fillable, AppointmentStatus enum cast, datetime cast preferred_at, belongsTo Service, boolean cast kvkk_accepted
    - ContactMessage: fillable, is_read boolean cast
    - Page: HasSlug trait, fillable
    - TeamMember: fillable, json cast socials, boolean cast is_active, scopeActive()
    - _Requirements: 4.6, 4.7, 4.8, 4.9_

  - [x] 3.5 SiteSettings sınıfını oluştur
    - `app/Settings/SiteSettings.php` dosyasını oluştur
    - Tüm property'leri tanımla: logo, favicon, phone, whatsapp, email, address, map_embed, working_hours(array), social_links(array), hero_title, hero_subtitle, hero_cta_text, footer_text, ga_id, default_meta_description
    - `group()` metodunu 'site' olarak ayarla
    - _Requirements: 5.1_

  - [ ]* 3.6 Model scope'ları için property test yaz
    - **Property 1: Active/Approved Scope Filtresi Doğruluğu**
    - **Property 2: Published Scope Filtresi Doğruluğu**
    - **Validates: Requirements 4.1, 4.2, 4.4, 4.5, 4.9**

- [x] 4. Checkpoint - Migration ve Model Doğrulaması
  - Migration'ları çalıştır, tüm tabloların doğru oluştuğunu doğrula
  - Model ilişkilerinin ve scope'ların çalıştığını doğrula
  - Ensure all tests pass, ask the user if questions arise.

- [x] 5. Blade Layout ve Partial'lar
  - [x] 5.1 Master layout (layouts/app.blade.php) oluştur
    - HTML yapısı: head bölümünde Bootstrap 3.3.7, Font Awesome, style.css linkleri (asset() helper ile)
    - Body sonunda jQuery 2.2.4, SuperFish, Owl Carousel, Waypoint, main.js script'leri (asset() helper ile)
    - @yield('content') ve @yield('title') bölümleri
    - Viewport meta tag: width=device-width, initial-scale=1
    - @include('layouts.partials.header') ve @include('layouts.partials.footer')
    - _Requirements: 2.2, 2.3, 14.3_

  - [x] 5.2 Header partial (layouts/partials/header.blade.php) oluştur
    - Üst iletişim barı: SiteSettings'den phone, email, social_links
    - Logo ve telefon bilgisi: SiteSettings'den
    - Navigation menü: SuperFish uyumlu, route() helper ile linkler
    - Aktif sayfa için active CSS class ekleme
    - Hamburger menü (mobil uyumluluk)
    - Alışveriş sepeti bileşenini kaldır
    - _Requirements: 2.4, 2.6, 2.7, 5.4, 14.1_

  - [x] 5.3 Footer partial (layouts/partials/footer.blade.php) oluştur
    - Footer widget'ları: SiteSettings'den iletişim bilgileri
    - Sosyal medya linkleri: SiteSettings.social_links
    - Telif hakkı metni: SiteSettings.footer_text
    - Back-to-top butonu
    - _Requirements: 2.5, 5.4_

  - [x] 5.4 Meta tags ve SEO component'lerini oluştur
    - `resources/views/components/meta-tags.blade.php`: Dinamik title, description, OG tags, Twitter Card
    - `resources/views/components/schema-org.blade.php`: MedicalBusiness ve Person Schema.org JSON-LD
    - Fallback mekanizması: seo_title/seo_description boşsa SiteSettings.default_meta_description kullan
    - _Requirements: 12.1, 12.2, 12.3, 12.5_

- [x] 6. E-posta Şablonları (Mailable Sınıfları)
  - [x] 6.1 ContactFormMailable oluştur
    - Admin'e gönderilecek: name, email, phone, subject, message bilgileri
    - Blade e-posta template'i: `resources/views/emails/contact-form.blade.php`
    - _Requirements: 15.1_

  - [x] 6.2 Appointment Mailable'larını oluştur
    - `AppointmentReceivedMailable`: Müşteriye randevu alındı bildirimi (service name, preferred_at, status)
    - `AppointmentConfirmedMailable`: Randevu onay bildirimi
    - `AppointmentCancelledMailable`: Randevu iptal bildirimi
    - Blade e-posta template'leri: `resources/views/emails/appointment-*.blade.php`
    - _Requirements: 15.2, 15.3, 15.4_

  - [x] 6.3 E-posta hata yönetimi mekanizmasını implement et
    - try-catch ile mail gönderimini sar
    - Hata durumunda Log::error ile loglama
    - Kullanıcı akışını kesintiye uğratmama
    - _Requirements: 15.5_

  - [ ]* 6.4 Mailable içerik bütünlüğü için property test yaz
    - **Property 9: Mailable İçerik Bütünlüğü**
    - **Validates: Requirements 15.1, 15.2**

- [x] 7. Form Request'ler ve Public Controller'lar
  - [x] 7.1 Form Request sınıflarını oluştur
    - `ContactRequest`: name(required), email(required|email), phone(nullable), subject(nullable), message(required|min:10), kvkk(required|accepted)
    - `AppointmentRequest`: name(required), email(required|email), phone(required), service_id(required|exists:services,id), preferred_at(required|date|after:now), notes(nullable), kvkk(required|accepted)
    - Türkçe validation mesajları
    - _Requirements: 10.1, 10.5, 11.1, 11.6, 11.7_

  - [x] 7.2 HomeController ve AboutController oluştur
    - HomeController@index: SiteSettings hero bilgileri, aktif servisler, son 3 yayın, onaylı testimonial'lar
    - AboutController@index: Page modelden hakkımda içeriği veya SiteSettings
    - _Requirements: 9.1, 9.2_

  - [x] 7.3 ServiceController ve BlogController oluştur
    - ServiceController@index: Aktif servisler sıralı liste
    - ServiceController@show: Slug ile servis detay
    - BlogController@index: Yayınlanan yazılar paginated, sidebar (categories, recent posts)
    - BlogController@show: Slug ile yazı detay, views++ increment
    - _Requirements: 9.3, 9.4, 9.5, 9.6_

  - [x] 7.4 ContactController ve AppointmentController oluştur
    - ContactController@create: İletişim formu görüntüleme
    - ContactController@store: ContactRequest validation, ContactMessage kayıt, admin'e mail, success mesaj
    - AppointmentController@create: Randevu formu görüntüleme (aktif servisler listesi)
    - AppointmentController@store: AppointmentRequest validation, Appointment kayıt (status=pending), admin + müşteriye mail
    - Rate limiting: throttle:5,1
    - _Requirements: 9.8, 9.9, 10.2, 10.3, 10.4, 11.2, 11.3_

  - [x] 7.5 FaqController, PageController ve SitemapController oluştur
    - FaqController@index: Aktif FAQ'lar kategoriye göre gruplu
    - PageController@show: Slug ile dinamik sayfa (KVKK, Gizlilik vb.)
    - SitemapController@index: spatie/laravel-sitemap ile tüm public URL'leri içeren sitemap.xml
    - _Requirements: 9.7, 12.4_

  - [x] 7.6 Route tanımlarını oluştur (routes/web.php)
    - Tüm public route'ları tanımla: /, /hakkimda, /hizmetler, /hizmetler/{slug}, /blog, /blog/{slug}, /sss, /randevu, /iletisim, /sayfa/{slug}, /sitemap.xml
    - POST route'lar: /randevu, /iletisim (throttle:5,1 middleware)
    - Route naming convention
    - _Requirements: 9.1-9.10_

  - [ ]* 7.7 İletişim formu property testlerini yaz
    - **Property 4: İletişim Formu Geçerli Veri → Kayıt Oluşturma**
    - **Property 5: Form Validasyon Reddi ve Değer Korunması**
    - **Validates: Requirements 10.2, 10.5_

  - [ ]* 7.8 Randevu formu property testlerini yaz
    - **Property 6: Randevu Oluşturma ile Pending Status**
    - **Property 7: Geçmiş Tarih Reddi**
    - **Validates: Requirements 11.2, 11.6**

- [x] 8. Checkpoint - Controller ve Form İşleme Doğrulaması
  - Tüm route'ların çalıştığını doğrula
  - Form submission ve validation'ın doğru çalıştığını doğrula
  - E-posta gönderiminin çalıştığını doğrula
  - Ensure all tests pass, ask the user if questions arise.

- [ ] 9. Public Frontend Blade View'ları
  - [-] 9.1 Anasayfa view'ını oluştur (pages/home.blade.php)
    - Hero section: SiteSettings hero_title, hero_subtitle, hero_cta_text
    - Aktif servisler carousel (Owl Carousel)
    - Son 3 yayınlanan blog yazısı kartları
    - Onaylı testimonial'lar slider
    - Hakkımda/About section
    - Harita ve iletişim bölümü (SiteSettings.map_embed)
    - _Requirements: 9.1_

  - [-] 9.2 Hizmetler sayfaları view'larını oluştur
    - `pages/services/index.blade.php`: Aktif servisler listesi (sıralı)
    - `pages/services/show.blade.php`: Servis detay sayfası (tam içerik, resim, fiyat, süre)
    - Blade component: `components/service-card.blade.php`
    - _Requirements: 9.3, 9.4_

  - [-] 9.3 Blog sayfaları view'larını oluştur
    - `pages/blog/index.blade.php`: Blog listesi paginated, sağ sidebar (kategoriler, son yazılar)
    - `pages/blog/show.blade.php`: Yazı detay (kategori, etiketler, yayın tarihi, okuma süresi)
    - Blade component: `components/post-card.blade.php`
    - _Requirements: 9.5, 9.6_

  - [-] 9.4 Form sayfalarının view'larını oluştur
    - `pages/appointment.blade.php`: Randevu formu (name, email, phone, service select, datetime-local, notes, KVKK checkbox)
    - `pages/contact.blade.php`: İletişim formu (name, email, phone, subject, message, KVKK checkbox) + harita embed
    - Validation hata mesajları gösterimi, old() ile değer korunması
    - Mobil uyumlu input type'ları (tel, email, datetime-local)
    - _Requirements: 10.1, 11.1, 14.4_

  - [-] 9.5 SSS, Hakkımda ve diğer sayfa view'larını oluştur
    - `pages/faq.blade.php`: Aktif FAQ'lar kategoriye göre gruplu accordion
    - `pages/about.blade.php`: Uzman biyografisi içeriği
    - `pages/page.blade.php`: Dinamik sayfa (KVKK, Gizlilik vb.)
    - Blade component: `components/faq-item.blade.php`
    - _Requirements: 9.2, 9.7_

  - [-] 9.6 404 hata sayfasını oluştur
    - `resources/views/errors/404.blade.php`: Template tasarımıyla uyumlu özel 404 sayfası
    - Master layout kullanarak tutarlı header/footer
    - _Requirements: 9.10_

  - [ ]* 9.7 Blog views counter property testini yaz
    - **Property 3: Blog Yazısı Görüntülenme Sayacı**
    - **Validates: Requirements 9.6**

  - [ ]* 9.8 Meta tag fallback property testini yaz
    - **Property 8: Meta Tag Fallback Mekanizması**
    - **Validates: Requirements 12.1**

- [ ] 10. Filament Admin Resources
  - [~] 10.1 ServiceResource ve PostResource oluştur
    - ServiceResource: title, slug, short_description, description(RichEditor), icon, image(FileUpload), price, duration, order, is_active, SEO fields; reorderable table
    - PostResource: title, slug, category select, tags multi-select, excerpt, body(RichEditor), cover_image(FileUpload), status select, published_at datetime picker, SEO fields; status badge table, publish toggle
    - _Requirements: 6.1, 6.2_

  - [~] 10.2 CategoryResource, TagResource ve TestimonialResource oluştur
    - CategoryResource: name, slug; table posts_count
    - TagResource: name, slug; table posts_count
    - TestimonialResource: author_name, content, rating, is_approved, order; approve toggle, reorderable table
    - _Requirements: 6.3, 6.4_

  - [~] 10.3 FaqResource, PageResource ve TeamMemberResource oluştur
    - FaqResource: question, answer(RichEditor), category, order, is_active; reorderable table, is_active toggle
    - PageResource: title, slug, body(RichEditor), SEO fields; table title/slug
    - TeamMemberResource: name, title, bio, photo(FileUpload), socials(repeater), order, is_active; reorderable table
    - _Requirements: 6.5, 6.8, 6.9_

  - [~] 10.4 AppointmentResource ve ContactMessageResource oluştur
    - AppointmentResource: name, email, phone, service select, preferred_at, status select, notes; table status badge, approve/cancel actions tetikleme email gönderimi
    - ContactMessageResource: Read-only, table (name, subject, is_read badge, created_at), mark-as-read action
    - Status değişikliğinde (confirmed/cancelled) ilgili Mailable gönderimi
    - _Requirements: 6.6, 6.7, 11.4, 11.5_

  - [~] 10.5 SiteSettings yönetim sayfasını oluştur
    - `app/Filament/Pages/ManageSiteSettings.php` Filament page
    - Tüm SiteSettings property'leri için uygun form field'ları: TextInput, FileUpload (logo/favicon), Textarea, Repeater (working_hours, social_links), RichEditor
    - Kaydetme işlemi sonrası site ayarları güncellenmeli
    - _Requirements: 5.2, 5.3_

  - [~] 10.6 Dashboard widget'larını oluştur
    - `PendingAppointmentsWidget`: Bekleyen randevu sayacı
    - `UnreadMessagesWidget`: Okunmamış mesaj sayacı
    - `RecentPostsWidget`: Son 5 yayınlanan blog yazısı listesi
    - Dashboard'a widget'ları kaydet
    - _Requirements: 7.1, 7.2, 7.3_

  - [~] 10.7 Shield policy'lerini yapılandır
    - Admin rolü: Tüm resource'lara tam erişim
    - Editor rolü: Post, Category, Tag, FAQ, Testimonial erişimi; Settings, Appointment status değişikliği ve user management kısıtlı
    - Policy dosyalarını oluştur ve resource'lara bağla
    - _Requirements: 8.1, 8.2, 8.3_

- [~] 11. Checkpoint - Admin Panel Doğrulaması
  - Tüm Filament resource'larının CRUD işlemlerini doğrula
  - SiteSettings kaydetme ve okuma işlemini doğrula
  - Dashboard widget'larının doğru veri gösterdiğini doğrula
  - Rol bazlı erişim kontrolünü doğrula
  - Ensure all tests pass, ask the user if questions arise.

- [ ] 12. Seeder'lar ve Örnek Veriler
  - [~] 12.1 İçerik seeder'larını oluştur
    - ServiceSeeder: En az 6 psikoloji hizmeti (Bireysel Terapi, Çift Terapisi, Aile Terapisi vb.)
    - PostSeeder: En az 3 blog yazısı ilişkili kategori ve tag'larla
    - FaqSeeder: En az 5 SSS kaydı
    - TestimonialSeeder: En az 3 testimonial kaydı
    - _Requirements: 13.1, 13.2, 13.3_

  - [~] 12.2 SiteSettings ve Admin user seeder'larını oluştur
    - SiteSettingsSeeder: Türkçe placeholder içerikle varsayılan ayarlar
    - AdminSeeder: admin rolüne sahip bir admin kullanıcı (varsayılan şifre ile)
    - DatabaseSeeder'da tüm seeder'ları sırala
    - _Requirements: 13.4, 13.5_

- [ ] 13. Responsive Tasarım ve Son Dokunuşlar
  - [~] 13.1 Responsive uyumluluk düzenlemelerini yap
    - Template'in mevcut responsive CSS breakpoint'lerini koru
    - Mobil navigasyon (hamburger menü) çalışmasını doğrula
    - Veri tablolarını mobil görünümde card layout formatına dönüştür
    - Formların mobil cihazlarda tam kullanılabilir olmasını sağla
    - _Requirements: 14.1, 14.2, 14.3, 14.4_

  - [~] 13.2 Sitemap ve SEO son ayarlarını tamamla
    - sitemap.xml oluşturma: tüm public route'lar ve yayınlanan içerik URL'leri
    - Schema.org yapılandırılmış veri: anasayfa ve hakkımda sayfasında MedicalBusiness/Person
    - Semantic HTML heading hiyerarşisi kontrolü (h1-h6)
    - _Requirements: 12.3, 12.4, 12.5_

  - [~] 13.3 Türkçe dil dosyalarını oluştur
    - `resources/lang/tr/validation.php`: Türkçe validation mesajları
    - `resources/lang/tr/messages.php`: Uygulama genelinde Türkçe mesajlar (success, error vb.)
    - Custom validation mesajları (KVKK, randevu tarihi vb.)
    - _Requirements: İlgili tüm form ve validation gereksinimleri_

- [~] 14. Final Checkpoint - Tüm Sistem Entegrasyonu
  - Tüm public sayfa route'larının çalıştığını doğrula
  - Form submission ve e-posta gönderimini doğrula
  - Admin panel CRUD işlemlerini doğrula
  - SiteSettings değişikliklerinin frontend'e yansıdığını doğrula
  - Responsive tasarımın mobil cihazlarda doğru çalıştığını doğrula
  - Ensure all tests pass, ask the user if questions arise.

## Notes

- `*` ile işaretli görevler opsiyoneldir ve daha hızlı MVP için atlanabilir
- Her görev, izlenebilirlik için spesifik gereksinimlere referans verir
- Checkpoint'ler artımlı doğrulama sağlar
- Property testler tasarım dokümanındaki evrensel doğruluk özelliklerini doğrular
- Unit testler belirli örnekleri ve sınır durumlarını doğrular
- Frontend'de Tailwind CSS KULLANILMAZ, orijinal Bootstrap 3.3.7 korunur
- Tüm içerik ve arayüz Türkçe olmalıdır
- Statik asset'ler bundler olmadan doğrudan public/ dizininden sunulur

## Task Dependency Graph

```json
{
  "waves": [
    { "id": 0, "tasks": ["1.1"] },
    { "id": 1, "tasks": ["1.2", "1.3"] },
    { "id": 2, "tasks": ["2.1", "2.2", "2.3", "2.4", "2.5"] },
    { "id": 3, "tasks": ["3.1", "3.5"] },
    { "id": 4, "tasks": ["3.2", "3.3", "3.4"] },
    { "id": 5, "tasks": ["3.6"] },
    { "id": 6, "tasks": ["5.1", "6.1", "6.2", "7.1"] },
    { "id": 7, "tasks": ["5.2", "5.3", "5.4", "6.3", "6.4"] },
    { "id": 8, "tasks": ["7.2", "7.3", "7.4", "7.5", "7.6"] },
    { "id": 9, "tasks": ["7.7", "7.8"] },
    { "id": 10, "tasks": ["9.1", "9.2", "9.3", "9.4", "9.5", "9.6"] },
    { "id": 11, "tasks": ["9.7", "9.8"] },
    { "id": 12, "tasks": ["10.1", "10.2", "10.3", "10.4", "10.5"] },
    { "id": 13, "tasks": ["10.6", "10.7"] },
    { "id": 14, "tasks": ["12.1", "12.2"] },
    { "id": 15, "tasks": ["13.1", "13.2", "13.3"] }
  ]
}
```
