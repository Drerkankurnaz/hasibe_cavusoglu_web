<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Uygulama Mesajları
    |--------------------------------------------------------------------------
    |
    | Uygulama genelinde kullanılan Türkçe mesajlar.
    |
    */

    // Başarı mesajları
    'success' => [
        'general' => 'İşlem başarıyla tamamlandı.',
        'contact_sent' => 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.',
        'appointment_created' => 'Randevu talebiniz başarıyla alındı. Onay bilgisi e-posta adresinize gönderilecektir.',
        'appointment_confirmed' => 'Randevunuz onaylandı.',
        'appointment_cancelled' => 'Randevunuz iptal edildi.',
        'settings_saved' => 'Ayarlar başarıyla kaydedildi.',
        'message_read' => 'Mesaj okundu olarak işaretlendi.',
    ],

    // Hata mesajları
    'error' => [
        'general' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.',
        'form' => 'Formda hatalar var. Lütfen kontrol ediniz.',
        'not_found' => 'Aradığınız sayfa bulunamadı.',
        'unauthorized' => 'Bu işlem için yetkiniz bulunmamaktadır.',
        'mail_failed' => 'E-posta gönderilemedi. Lütfen daha sonra tekrar deneyiniz.',
        'rate_limit' => 'Çok fazla istek gönderdiniz. Lütfen bir süre bekleyiniz.',
        'server' => 'Sunucu hatası oluştu. Lütfen daha sonra tekrar deneyiniz.',
    ],

    // Etiketler (Form labels)
    'labels' => [
        'name' => 'Ad Soyad',
        'email' => 'E-posta',
        'phone' => 'Telefon',
        'subject' => 'Konu',
        'message' => 'Mesaj',
        'service' => 'Hizmet',
        'preferred_at' => 'Tercih Edilen Tarih ve Saat',
        'notes' => 'Notlar',
        'kvkk' => 'KVKK Onayı',
        'send' => 'Gönder',
        'submit' => 'Gönder',
        'cancel' => 'İptal',
        'save' => 'Kaydet',
        'delete' => 'Sil',
        'edit' => 'Düzenle',
        'create' => 'Oluştur',
        'back' => 'Geri',
        'search' => 'Ara',
        'select_service' => 'Hizmet Seçiniz',
        'read_more' => 'Devamını Oku',
        'view_all' => 'Tümünü Gör',
        'loading' => 'Yükleniyor...',
    ],

    // KVKK mesajları
    'kvkk' => [
        'consent_text' => 'KVKK Aydınlatma Metni\'ni okudum ve kabul ediyorum.',
        'required' => 'KVKK metnini okuduğunuzu ve kabul ettiğinizi onaylamanız gerekmektedir.',
        'title' => 'Kişisel Verilerin Korunması',
        'info' => 'Kişisel verileriniz 6698 sayılı Kanun kapsamında işlenmektedir.',
    ],

    // Randevu durumları
    'appointment_status' => [
        'pending' => 'Beklemede',
        'confirmed' => 'Onaylandı',
        'cancelled' => 'İptal Edildi',
        'completed' => 'Tamamlandı',
    ],

    // Blog
    'blog' => [
        'no_posts' => 'Henüz yazı bulunmamaktadır.',
        'reading_time' => ':min dk okuma',
        'published_at' => 'Yayın Tarihi',
        'category' => 'Kategori',
        'tags' => 'Etiketler',
        'share' => 'Paylaş',
        'recent_posts' => 'Son Yazılar',
        'categories' => 'Kategoriler',
        'views' => 'görüntülenme',
    ],

    // Genel sayfa metinleri
    'pages' => [
        'home' => 'Anasayfa',
        'about' => 'Hakkımda',
        'services' => 'Hizmetler',
        'blog' => 'Blog',
        'faq' => 'Sıkça Sorulan Sorular',
        'contact' => 'İletişim',
        'appointment' => 'Randevu Al',
        'privacy' => 'Gizlilik Politikası',
        'kvkk' => 'KVKK Aydınlatma Metni',
    ],

    // E-posta metinleri
    'mail' => [
        'contact_subject' => 'Yeni İletişim Formu Mesajı',
        'appointment_received_subject' => 'Randevu Talebiniz Alındı',
        'appointment_confirmed_subject' => 'Randevunuz Onaylandı',
        'appointment_cancelled_subject' => 'Randevunuz İptal Edildi',
        'greeting' => 'Merhaba',
        'regards' => 'Saygılarımızla',
    ],

    // 404 sayfası
    '404' => [
        'title' => 'Sayfa Bulunamadı',
        'message' => 'Aradığınız sayfa bulunamadı veya kaldırılmış olabilir.',
        'go_home' => 'Anasayfaya Dön',
    ],

    // Testimonials
    'testimonials' => [
        'title' => 'Danışan Yorumları',
        'subtitle' => 'Danışanlarımızın görüşleri',
    ],

    // Footer
    'footer' => [
        'quick_links' => 'Hızlı Bağlantılar',
        'contact_info' => 'İletişim Bilgileri',
        'working_hours' => 'Çalışma Saatleri',
        'follow_us' => 'Bizi Takip Edin',
    ],

];
