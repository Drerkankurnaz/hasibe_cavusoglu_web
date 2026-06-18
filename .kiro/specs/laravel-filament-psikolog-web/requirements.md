# Requirements Document

## Introduction

Bu doküman, Optima psikoloji HTML şablonunun Laravel 11 + Filament v3 uygulamasına dönüştürülmesi projesinin gereksinimlerini tanımlar. Mevcut statik HTML şablonu (raw_template/HTML/) Blade template'lerine bölünecek, içerikler veritabanından beslenecek ve Filament v3 admin paneli ile yönetilecektir. Şablonun orijinal tasarımı (Bootstrap 3.3.7, jQuery 2.2.4, Owl Carousel, SuperFish) korunacaktır.

## Glossary

- **Application**: Laravel 11 tabanlı psikoloji web uygulaması
- **Admin_Panel**: Filament v3 ile oluşturulan /admin yolundaki yönetim paneli
- **Public_Frontend**: Ziyaretçilerin eriştiği halka açık web sayfaları
- **Template_Engine**: Laravel Blade template motoru
- **Asset_Pipeline**: Statik dosyaların (CSS, JS, img, fonts) public/ dizininde sunulması
- **Service**: Psikolojik hizmet/terapi kaydı
- **Post**: Blog yazısı kaydı
- **Category**: Blog kategorisi
- **Tag**: Blog etiketi
- **Testimonial**: Müşteri referans/yorum kaydı
- **FAQ**: Sıkça sorulan soru kaydı
- **Appointment**: Randevu talebi kaydı
- **Contact_Message**: İletişim formu mesajı kaydı
- **Page**: Statik sayfa kaydı (KVKK, Gizlilik Politikası vb.)
- **Team_Member**: Ekip üyesi kaydı
- **Site_Settings**: Spatie Settings ile yönetilen genel site ayarları
- **KVKK**: Kişisel Verilerin Korunması Kanunu onay mekanizması
- **Slug**: URL dostu benzersiz tanımlayıcı (spatie/laravel-sluggable)
- **Media_Library**: Spatie Media Library ile dosya/resim yönetimi
- **Shield**: Filament Shield (bezhansalleh/filament-shield) rol tabanlı erişim kontrolü
- **Mailable**: Laravel e-posta gönderim sınıfı

## Requirements

### Requirement 1: Proje Altyapısı ve Yapılandırma

**User Story:** Bir geliştirici olarak, projenin Laravel 11 + Filament v3 altyapısıyla doğru şekilde yapılandırılmasını istiyorum, böylece tüm bağımlılıklar ve konfigürasyonlar tutarlı çalışsın.

#### Acceptance Criteria

1. THE Application SHALL use Laravel 11 framework with PHP 8.3 compatibility
2. THE Application SHALL use MySQL 8 as the database engine
3. THE Admin_Panel SHALL be accessible at the /admin route path using Filament v3
4. THE Application SHALL include spatie/laravel-sluggable, spatie/laravel-medialibrary, spatie/laravel-settings, filament/spatie-laravel-media-library-plugin, and bezhansalleh/filament-shield as composer dependencies
5. THE Application SHALL NOT use Tailwind CSS on the Public_Frontend
6. THE Asset_Pipeline SHALL serve the template's original CSS, JS, image, and font files from the public/ directory

### Requirement 2: Statik Asset Taşıma ve Blade Layout

**User Story:** Bir geliştirici olarak, HTML şablonunun statik dosyalarının Laravel yapısına taşınmasını ve ortak HTML yapısının Blade layout/partial'larına bölünmesini istiyorum, böylece şablonun görsel tasarımı korunsun.

#### Acceptance Criteria

1. THE Asset_Pipeline SHALL copy raw_template/HTML/css/, js/, img/, fonts/ directories to public/css/, public/js/, public/img/, public/fonts/ respectively
2. THE Template_Engine SHALL convert all href and src paths in Blade files to use the asset() helper function
3. THE Template_Engine SHALL provide a layouts/app.blade.php master layout containing the head section with Bootstrap 3.3.7, Font Awesome, and style.css links, and the bottom JS blocks with jQuery 2.2.4, SuperFish, Owl Carousel, Waypoint, and main.js
4. THE Template_Engine SHALL provide a layouts/partials/header.blade.php partial containing the top contact bar, logo, phone info, navigation menu with SuperFish, and search box
5. THE Template_Engine SHALL provide a layouts/partials/footer.blade.php partial containing the footer widgets, social links, copyright text, and back-to-top button
6. THE Template_Engine SHALL dynamize menu links using the route() helper and apply the active CSS class to the current page's menu item
7. THE Template_Engine SHALL remove the shopping cart component from the header navigation as it is not used in this project

### Requirement 3: Veritabanı Şeması

**User Story:** Bir geliştirici olarak, tüm dinamik içeriğin veritabanında saklanması için gerekli migration'ların oluşturulmasını istiyorum, böylece içerik yönetilebilir olsun.

#### Acceptance Criteria

1. THE Application SHALL create a services migration with columns: id, title, slug(unique), short_description(varchar 280), description(longtext), icon(nullable), image(nullable), price(decimal 8,2 nullable), duration(nullable), order(default 0), is_active(default true), seo_title(nullable), seo_description(nullable), timestamps
2. THE Application SHALL create a posts migration with columns: id, category_id(FK nullable), title, slug(unique), excerpt(varchar 300), body(longtext), cover_image(nullable), status(enum draft/published default draft), published_at(nullable), reading_time(int nullable), views(default 0), seo_title(nullable), seo_description(nullable), timestamps
3. THE Application SHALL create a categories migration with columns: id, name, slug(unique), timestamps
4. THE Application SHALL create a tags migration with columns: id, name, slug(unique), timestamps and a post_tag pivot table with post_id and tag_id foreign keys
5. THE Application SHALL create a testimonials migration with columns: id, author_name, content(text), rating(tinyint nullable), is_approved(default false), order(default 0), timestamps
6. THE Application SHALL create a faqs migration with columns: id, question, answer(text), category(nullable), order(default 0), is_active(default true), timestamps
7. THE Application SHALL create an appointments migration with columns: id, name, email, phone, service_id(FK nullable), preferred_at(datetime), status(enum pending/confirmed/cancelled/completed default pending), notes(text nullable), kvkk_accepted(boolean), timestamps
8. THE Application SHALL create a contact_messages migration with columns: id, name, email, phone(nullable), subject(nullable), message(text), is_read(default false), timestamps
9. THE Application SHALL create a pages migration with columns: id, title, slug(unique), body(longtext), seo_title(nullable), seo_description(nullable), timestamps
10. THE Application SHALL create a team_members migration with columns: id, name, title, bio(text), photo(nullable), order(default 0), socials(json nullable), is_active(default true), timestamps

### Requirement 4: Eloquent Model'ler

**User Story:** Bir geliştirici olarak, her veritabanı tablosu için doğru ilişkilere, cast'lere ve sluggable özelliğine sahip Eloquent model'lerinin oluşturulmasını istiyorum, böylece veri katmanı tutarlı çalışsın.

#### Acceptance Criteria

1. THE Application SHALL define a Service model with sluggable trait, fillable attributes, boolean cast for is_active, and a scope for active ordered records
2. THE Application SHALL define a Post model with sluggable trait, fillable attributes, enum cast for status, datetime cast for published_at, belongsTo relationship with Category, belongsToMany relationship with Tag, and a scope for published records
3. THE Application SHALL define Category and Tag models with sluggable trait and appropriate inverse relationships to Post
4. THE Application SHALL define a Testimonial model with fillable attributes, boolean cast for is_approved, and a scope for approved ordered records
5. THE Application SHALL define a FAQ model with fillable attributes, boolean cast for is_active, and a scope for active ordered records
6. THE Application SHALL define an Appointment model with fillable attributes, enum cast for status, datetime cast for preferred_at, belongsTo relationship with Service, and boolean cast for kvkk_accepted
7. THE Application SHALL define a Contact_Message model with fillable attributes, boolean cast for is_read, and timestamps
8. THE Application SHALL define a Page model with sluggable trait and fillable attributes
9. THE Application SHALL define a Team_Member model with fillable attributes, json cast for socials, boolean cast for is_active, and a scope for active ordered records

### Requirement 5: Site Ayarları Yönetimi

**User Story:** Bir site yöneticisi olarak, logo, iletişim bilgileri, hero metinleri ve sosyal medya bağlantıları gibi genel site ayarlarını admin panelinden yönetmek istiyorum, böylece kod değişikliğine gerek kalmadan siteyi güncelleyebileyim.

#### Acceptance Criteria

1. THE Application SHALL use spatie/laravel-settings to define a SiteSettings class with properties: logo, favicon, phone, whatsapp, email, address, map_embed, working_hours(array), social_links(array), hero_title, hero_subtitle, hero_cta_text, footer_text, ga_id, default_meta_description
2. THE Admin_Panel SHALL provide a dedicated Settings page where all SiteSettings properties can be edited using appropriate Filament form fields
3. WHEN a SiteSettings property is updated, THE Public_Frontend SHALL reflect the new value on the next page load
4. THE Template_Engine SHALL inject SiteSettings values into header contact bar, footer, and homepage hero section

### Requirement 6: Filament Admin Resources

**User Story:** Bir site yöneticisi olarak, tüm içerikleri (hizmetler, blog yazıları, referanslar, SSS, randevular, mesajlar, sayfalar, ekip üyeleri) admin panelinden CRUD işlemleriyle yönetmek istiyorum, böylece site içeriğini kolayca güncelleyebileyim.

#### Acceptance Criteria

1. THE Admin_Panel SHALL provide a ServiceResource with form fields (title, slug, short_description, description as RichEditor, icon, image as FileUpload, price, duration, order, is_active, SEO fields) and a reorderable table with columns (title, price, is_active toggle, order)
2. THE Admin_Panel SHALL provide a PostResource with form fields (title, slug, category select, tags multi-select, excerpt, body as RichEditor, cover_image as FileUpload, status select, published_at datetime picker, SEO fields) and a table with columns (title, category, status badge, published_at, views) including a publish toggle action
3. THE Admin_Panel SHALL provide CategoryResource and TagResource with form fields (name, slug) and tables showing name with posts_count
4. THE Admin_Panel SHALL provide a TestimonialResource with form fields (author_name, content, rating, is_approved, order) and a table with approve toggle action, reorderable
5. THE Admin_Panel SHALL provide a FaqResource with form fields (question, answer as RichEditor, category, order, is_active) and a reorderable table with is_active toggle
6. THE Admin_Panel SHALL provide an AppointmentResource with form fields (name, email, phone, service select, preferred_at, status select, notes) and a table with status badge, approve and cancel actions that trigger email notifications
7. THE Admin_Panel SHALL provide a ContactMessageResource as read-only with a table showing (name, subject, is_read badge, created_at) and a mark-as-read action
8. THE Admin_Panel SHALL provide a PageResource with form fields (title, slug, body as RichEditor, SEO fields) and a table with (title, slug)
9. THE Admin_Panel SHALL provide a TeamMemberResource with form fields (name, title, bio, photo as FileUpload, socials as repeater, order, is_active) and a reorderable table

### Requirement 7: Dashboard Widget'ları

**User Story:** Bir site yöneticisi olarak, admin paneli ana sayfasında bekleyen randevuları, okunmamış mesajları ve son blog yazılarını görmek istiyorum, böylece hızlıca durumu değerlendirebiliyem.

#### Acceptance Criteria

1. THE Admin_Panel SHALL display a widget showing the count of pending appointments on the dashboard
2. THE Admin_Panel SHALL display a widget showing the count of unread contact messages on the dashboard
3. THE Admin_Panel SHALL display a widget listing the 5 most recent published blog posts on the dashboard

### Requirement 8: Rol Tabanlı Erişim Kontrolü

**User Story:** Bir site yöneticisi olarak, admin ve editor rollerinin tanımlanmasını ve her rolün erişim yetkilerinin belirlenmesini istiyorum, böylece farklı kullanıcılara uygun izinler verilebilsin.

#### Acceptance Criteria

1. THE Admin_Panel SHALL use filament-shield to define admin and editor roles
2. WHILE a user has the admin role, THE Admin_Panel SHALL grant full access to all resources and settings
3. WHILE a user has the editor role, THE Admin_Panel SHALL grant access to Post, Category, Tag, FAQ, and Testimonial resources but restrict access to Settings, Appointment status changes, and user management

### Requirement 9: Halka Açık Sayfa Rotaları ve Controller'lar

**User Story:** Bir ziyaretçi olarak, psikoloji sitesinin tüm sayfalarına (anasayfa, hakkımda, hizmetler, blog, SSS, randevu, iletişim) erişmek istiyorum, böylece bilgi edinebilir ve hizmet talep edebiliyim.

#### Acceptance Criteria

1. THE Public_Frontend SHALL serve the homepage at / route displaying hero section from SiteSettings, active services carousel, latest 3 published posts, approved testimonials slider, about section, and map/contact section
2. THE Public_Frontend SHALL serve the about page at /hakkimda route displaying expert biography content from a Page record or SiteSettings
3. THE Public_Frontend SHALL serve the services list at /hizmetler route displaying all active services ordered by the order field
4. THE Public_Frontend SHALL serve individual service detail at /hizmetler/{slug} route displaying the matched Service record's full content
5. THE Public_Frontend SHALL serve the blog listing at /blog route with pagination, right sidebar containing categories and recent posts widgets
6. THE Public_Frontend SHALL serve individual blog posts at /blog/{slug} route, incrementing the views counter, and displaying category, tags, published date, and reading time
7. THE Public_Frontend SHALL serve the FAQ page at /sss route displaying active FAQs grouped by category in an accordion component
8. THE Public_Frontend SHALL serve the appointment form at /randevu route
9. THE Public_Frontend SHALL serve the contact form at /iletisim route with a map embed from SiteSettings
10. THE Public_Frontend SHALL serve a custom 404 error page matching the template's design

### Requirement 10: İletişim Formu İşleme

**User Story:** Bir ziyaretçi olarak, iletişim formunu doldurarak site yöneticisine mesaj göndermek istiyorum, böylece sorularımı iletebiliyim.

#### Acceptance Criteria

1. THE Public_Frontend SHALL display a contact form with fields: name (required), email (required, valid email), phone (optional), subject (optional), message (required, min 10 characters), and a mandatory KVKK consent checkbox
2. WHEN the contact form is submitted with valid data and KVKK consent accepted, THE Application SHALL create a Contact_Message record in the database
3. WHEN a Contact_Message is created, THE Application SHALL send a Mailable notification to the admin email address defined in SiteSettings
4. WHEN the contact form is submitted successfully, THE Public_Frontend SHALL display a success message to the user
5. IF the contact form is submitted with invalid data, THEN THE Public_Frontend SHALL display field-specific validation error messages while preserving the entered values

### Requirement 11: Randevu Formu İşleme

**User Story:** Bir ziyaretçi olarak, online randevu formu doldurarak hizmet talebi oluşturmak istiyorum, böylece uygun zamanda danışmanlık alabiliyim.

#### Acceptance Criteria

1. THE Public_Frontend SHALL display an appointment form with fields: name (required), email (required, valid email), phone (required), service select (required, populated from active services), preferred date/time (required, future date), notes (optional), and a mandatory KVKK consent checkbox
2. WHEN the appointment form is submitted with valid data and KVKK consent accepted, THE Application SHALL create an Appointment record with status pending
3. WHEN an Appointment is created, THE Application SHALL send a notification Mailable to the admin email and a confirmation Mailable to the client email with appointment details
4. WHEN an admin changes an Appointment status to confirmed, THE Application SHALL send a confirmation Mailable to the client email
5. WHEN an admin changes an Appointment status to cancelled, THE Application SHALL send a cancellation Mailable to the client email
6. IF the appointment form is submitted with a preferred_at date in the past, THEN THE Application SHALL reject the submission with a validation error
7. IF the appointment form is submitted without KVKK consent, THEN THE Application SHALL reject the submission with a validation error stating KVKK consent is required

### Requirement 12: SEO ve Meta Bilgileri

**User Story:** Bir site yöneticisi olarak, her sayfa için SEO meta bilgilerinin ve yapılandırılmış verilerin otomatik olarak oluşturulmasını istiyorum, böylece site arama motorlarında daha iyi sıralansın.

#### Acceptance Criteria

1. THE Template_Engine SHALL include a dynamic meta component that renders seo_title and seo_description from the current content record, falling back to SiteSettings.default_meta_description when empty
2. THE Application SHALL generate Open Graph and Twitter Card meta tags for all public pages
3. THE Application SHALL generate Schema.org structured data (MedicalBusiness and Person types) on the homepage and about page
4. THE Application SHALL generate a sitemap.xml using spatie/laravel-sitemap containing all public routes and published content URLs
5. THE Template_Engine SHALL use semantic HTML heading hierarchy (h1-h6) consistent with the original template structure

### Requirement 13: Seeder'lar ve Örnek Veriler

**User Story:** Bir geliştirici olarak, veritabanının örnek verilerle doldurulmasını istiyorum, böylece geliştirme sırasında sayfalar gerçekçi içerikle test edilebilsin.

#### Acceptance Criteria

1. THE Application SHALL provide seeders that create sample Service records (at least 6 entries representing psychology services)
2. THE Application SHALL provide seeders that create sample Post records (at least 3 entries) with associated categories and tags
3. THE Application SHALL provide seeders that create sample FAQ records (at least 5 entries) and Testimonial records (at least 3 entries)
4. THE Application SHALL provide a seeder that creates default SiteSettings with Turkish placeholder content
5. THE Application SHALL provide a seeder that creates an admin user with the admin role and a default password

### Requirement 14: Responsive Tasarım Uyumluluğu

**User Story:** Bir mobil kullanıcı olarak, sitenin tüm cihazlarda düzgün görüntülenmesini istiyorum, böylece herhangi bir cihazdan rahatça erişebileyim.

#### Acceptance Criteria

1. THE Public_Frontend SHALL preserve the template's existing responsive CSS breakpoints and mobile navigation (hamburger menu)
2. THE Public_Frontend SHALL display all data tables in card layout format on mobile viewports
3. THE Template_Engine SHALL include the viewport meta tag with width=device-width and initial-scale=1 in all pages
4. THE Public_Frontend SHALL ensure forms are fully usable on mobile devices with appropriate input types (tel for phone, email for email, datetime-local for date/time)

### Requirement 15: E-posta Şablonları

**User Story:** Bir site yöneticisi olarak, otomatik gönderilen e-postaların profesyonel görünmesini istiyorum, böylece müşterilerle iletişim kaliteli olsun.

#### Acceptance Criteria

1. THE Application SHALL define a ContactFormMailable that sends admin notification containing the submitted name, email, phone, subject, and message
2. THE Application SHALL define an AppointmentReceivedMailable sent to the client confirming their appointment request has been received with details (service name, preferred date, status)
3. THE Application SHALL define an AppointmentConfirmedMailable sent to the client when the appointment status changes to confirmed
4. THE Application SHALL define an AppointmentCancelledMailable sent to the client when the appointment status changes to cancelled
5. WHEN an email fails to send, THE Application SHALL log the error and continue operation without interrupting the user flow
