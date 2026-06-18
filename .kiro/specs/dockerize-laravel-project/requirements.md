# Gereksinimler Dokümanı

## Giriş

Bu doküman, mevcut Laravel 13 + Filament v5 projesinin (Hasibe Çavuşoğlu Psikoloji web sitesi) Docker konteynerlerine taşınması için gerekli gereksinimleri tanımlar. Proje PHP 8.3+, MySQL 8, Redis ve Nginx kullanmaktadır. Docker yapısı hem geliştirme hem de üretim ortamını desteklemelidir.

## Sözlük

- **Docker_Compose**: Çoklu konteyner Docker uygulamalarını tanımlamak ve çalıştırmak için kullanılan orkestrasyon aracı
- **PHP_FPM_Konteyneri**: PHP-FPM (FastCGI Process Manager) çalıştıran Docker konteyneri
- **Nginx_Konteyneri**: Nginx web sunucusu çalıştıran Docker konteyneri
- **MySQL_Konteyneri**: MySQL 8 veritabanı sunucusu çalıştıran Docker konteyneri
- **Redis_Konteyneri**: Redis önbellek ve oturum yönetimi sunucusu çalıştıran Docker konteyneri
- **Volume**: Docker konteynerlerinde kalıcı veri depolamak için kullanılan mekanizma
- **Dockerfile**: Docker imajı oluşturmak için kullanılan yapılandırma dosyası
- **Health_Check**: Bir konteynerin sağlık durumunu doğrulamak için kullanılan kontrol mekanizması
- **Artisan**: Laravel framework komut satırı aracı

## Gereksinimler

### Gereksinim 1: PHP-FPM Konteyner Yapılandırması

**Kullanıcı Hikayesi:** Bir geliştirici olarak, PHP 8.3+ ile yapılandırılmış bir PHP-FPM konteyneri istiyorum, böylece Laravel uygulaması tüm bağımlılıklarıyla birlikte çalışabilsin.

#### Kabul Kriterleri

1. THE PHP_FPM_Konteyneri SHALL PHP 8.3 veya üstü sürümü çalıştıracaktır
2. THE PHP_FPM_Konteyneri SHALL şu PHP uzantılarını içerecektir: pdo_mysql, mbstring, exif, pcntl, bcmath, gd, imagick, redis, zip, intl
3. THE PHP_FPM_Konteyneri SHALL Composer paket yöneticisini içerecektir
4. THE PHP_FPM_Konteyneri SHALL Laravel Artisan komutlarının çalıştırılmasını destekleyecektir
5. WHEN konteyner başlatıldığında, THE PHP_FPM_Konteyneri SHALL uygulama dizinini /var/www/html olarak ayarlayacaktır
6. THE PHP_FPM_Konteyneri SHALL spatie/laravel-medialibrary için gerekli olan GD ve Imagick kütüphanelerini içerecektir
7. THE PHP_FPM_Konteyneri SHALL upload_max_filesize değerini en az 64MB olarak yapılandıracaktır
8. THE PHP_FPM_Konteyneri SHALL post_max_size değerini en az 64MB olarak yapılandıracaktır
9. THE PHP_FPM_Konteyneri SHALL memory_limit değerini en az 256MB olarak yapılandıracaktır

### Gereksinim 2: Nginx Web Sunucusu Yapılandırması

**Kullanıcı Hikayesi:** Bir geliştirici olarak, Nginx web sunucusu konteyneri istiyorum, böylece HTTP istekleri doğru şekilde PHP-FPM'e yönlendirilsin ve statik dosyalar verimli şekilde sunulsun.

#### Kabul Kriterleri

1. THE Nginx_Konteyneri SHALL gelen HTTP isteklerini PHP_FPM_Konteyneri'ne yönlendirecektir
2. THE Nginx_Konteyneri SHALL public/ dizinindeki statik dosyaları (css, js, img, fonts) doğrudan sunacaktır
3. THE Nginx_Konteyneri SHALL Laravel'in URL yeniden yazma kurallarını destekleyecektir (index.php üzerinden routing)
4. THE Nginx_Konteyneri SHALL 80 portunu dinleyecektir
5. THE Nginx_Konteyneri SHALL client_max_body_size değerini en az 64MB olarak yapılandıracaktır
6. WHEN statik dosyalara istek geldiğinde, THE Nginx_Konteyneri SHALL uygun önbellekleme başlıklarını ekleyecektir
7. THE Nginx_Konteyneri SHALL gzip sıkıştırma desteğini etkinleştirecektir

### Gereksinim 3: MySQL Veritabanı Konteyneri

**Kullanıcı Hikayesi:** Bir geliştirici olarak, MySQL 8 veritabanı konteyneri istiyorum, böylece uygulama verileri kalıcı olarak saklanabilsin.

#### Kabul Kriterleri

1. THE MySQL_Konteyneri SHALL MySQL 8 sürümünü çalıştıracaktır
2. THE MySQL_Konteyneri SHALL veritabanı verilerini kalıcı bir Docker volume'da saklayacaktır
3. THE MySQL_Konteyneri SHALL karakter setini utf8mb4 olarak yapılandıracaktır
4. THE MySQL_Konteyneri SHALL collation değerini utf8mb4_unicode_ci olarak yapılandıracaktır
5. WHEN konteyner ilk kez başlatıldığında, THE MySQL_Konteyneri SHALL ortam değişkenlerinden veritabanı adı, kullanıcı adı ve şifre bilgilerini alarak veritabanını oluşturacaktır
6. THE MySQL_Konteyneri SHALL 3306 portunu yalnızca Docker ağı içinde erişilebilir yapacaktır
7. THE MySQL_Konteyneri SHALL bir health check mekanizması içerecektir

### Gereksinim 4: Redis Konteyneri

**Kullanıcı Hikayesi:** Bir geliştirici olarak, Redis konteyneri istiyorum, böylece uygulama önbellek ve oturum yönetimini Redis üzerinden yapabilsin.

#### Kabul Kriterleri

1. THE Redis_Konteyneri SHALL Redis'in en güncel kararlı sürümünü çalıştıracaktır
2. THE Redis_Konteyneri SHALL verileri kalıcı bir Docker volume'da saklayacaktır
3. THE Redis_Konteyneri SHALL 6379 portunu yalnızca Docker ağı içinde erişilebilir yapacaktır
4. THE Redis_Konteyneri SHALL bir health check mekanizması içerecektir
5. WHEN PHP_FPM_Konteyneri başlatıldığında, THE PHP_FPM_Konteyneri SHALL Redis bağlantı bilgilerini ortam değişkenlerinden alacaktır

### Gereksinim 5: Docker Compose Orkestrasyonu

**Kullanıcı Hikayesi:** Bir geliştirici olarak, tüm konteynerleri tek bir komutla yönetmek istiyorum, böylece geliştirme ortamını kolayca başlatıp durdurabilirim.

#### Kabul Kriterleri

1. THE Docker_Compose SHALL tüm konteynerleri (PHP-FPM, Nginx, MySQL, Redis) tek bir docker-compose.yml dosyasında tanımlayacaktır
2. THE Docker_Compose SHALL konteynerler arasında bir Docker ağı oluşturacaktır
3. THE Docker_Compose SHALL servisler arası bağımlılıkları depends_on ile tanımlayacaktır
4. WHEN `docker compose up` komutu çalıştırıldığında, THE Docker_Compose SHALL tüm servisleri doğru sırayla başlatacaktır
5. WHEN `docker compose down` komutu çalıştırıldığında, THE Docker_Compose SHALL tüm servisleri düzgün şekilde durduracaktır
6. THE Docker_Compose SHALL volume tanımlamalarını içerecektir (MySQL verileri, Redis verileri, uygulama dosyaları)
7. THE Docker_Compose SHALL ortam değişkenlerini .env dosyasından okuyacaktır

### Gereksinim 6: Geliştirme Ortamı Volume Yapılandırması

**Kullanıcı Hikayesi:** Bir geliştirici olarak, kaynak kodumu yerel makinemde düzenleyip değişikliklerin anında konteynere yansımasını istiyorum, böylece geliştirme süreci kesintisiz devam etsin.

#### Kabul Kriterleri

1. THE Docker_Compose SHALL uygulama kaynak kodunu host makineden konteynere bind-mount olarak bağlayacaktır
2. THE Docker_Compose SHALL vendor/ dizinini ayrı bir named volume olarak tanımlayacaktır
3. THE Docker_Compose SHALL storage/ dizini için yazma izinlerini doğru şekilde ayarlayacaktır
4. THE Docker_Compose SHALL bootstrap/cache/ dizini için yazma izinlerini doğru şekilde ayarlayacaktır
5. WHEN kaynak kodda değişiklik yapıldığında, THE PHP_FPM_Konteyneri SHALL değişiklikleri yeniden başlatmaya gerek kalmadan yansıtacaktır

### Gereksinim 7: Ortam Değişkeni Yönetimi

**Kullanıcı Hikayesi:** Bir geliştirici olarak, Docker'a özel ortam değişkenlerini yönetmek istiyorum, böylece geliştirme ve üretim ortamları arasında kolay geçiş yapabileyim.

#### Kabul Kriterleri

1. THE Docker_Compose SHALL bir .env.docker örnek dosyası sağlayacaktır
2. THE .env.docker dosyası SHALL Docker servis adlarına uygun veritabanı host bilgilerini içerecektir (ör: DB_HOST=mysql)
3. THE .env.docker dosyası SHALL Docker servis adlarına uygun Redis host bilgilerini içerecektir (ör: REDIS_HOST=redis)
4. THE .env.docker dosyası SHALL CACHE_STORE=redis ve SESSION_DRIVER=redis yapılandırmasını içerecektir
5. IF .env dosyası mevcut değilse, THEN THE Docker_Compose SHALL konteyner başlatma sürecinde hata verecektir

### Gereksinim 8: Artisan Komut Çalıştırma Desteği

**Kullanıcı Hikayesi:** Bir geliştirici olarak, Docker konteynerleri içinde Artisan komutlarını kolayca çalıştırmak istiyorum, böylece migration, seeding ve diğer bakım görevlerini gerçekleştirebilirim.

#### Kabul Kriterleri

1. WHEN bir Artisan komutu çalıştırılmak istendiğinde, THE Docker_Compose SHALL `docker compose exec app php artisan <komut>` şeklinde çalıştırılabilecektir
2. THE Docker yapılandırması SHALL migration komutlarının çalıştırılmasını destekleyecektir
3. THE Docker yapılandırması SHALL seeder komutlarının çalıştırılmasını destekleyecektir
4. THE Docker yapılandırması SHALL queue worker komutlarının çalıştırılmasını destekleyecektir
5. THE Docker yapılandırması SHALL schedule:run komutunun çalıştırılmasını destekleyecektir

### Gereksinim 9: SSL/HTTPS Üretim Desteği

**Kullanıcı Hikayesi:** Bir geliştirici olarak, üretim ortamında SSL/HTTPS desteği istiyorum, böylece web sitesi güvenli bağlantı üzerinden sunulabilsin.

#### Kabul Kriterleri

1. THE Nginx_Konteyneri SHALL SSL sertifika dosyalarını volume olarak bağlama desteği sağlayacaktır
2. THE Nginx_Konteyneri SHALL 443 portunu dinleme yapılandırmasını içerecektir
3. WHEN üretim ortamında çalışırken, THE Nginx_Konteyneri SHALL HTTP isteklerini HTTPS'e yönlendirecektir
4. THE Docker yapılandırması SHALL Let's Encrypt sertifika yenileme mekanizması için uygun volume yapılandırması sağlayacaktır
5. WHILE geliştirme ortamında çalışırken, THE Nginx_Konteyneri SHALL yalnızca HTTP (80 portu) üzerinden hizmet verecektir

### Gereksinim 10: Konteyner Sağlık Kontrolü ve Yeniden Başlatma

**Kullanıcı Hikayesi:** Bir geliştirici olarak, konteynerlerin sağlık durumunun otomatik olarak kontrol edilmesini ve gerektiğinde yeniden başlatılmasını istiyorum, böylece servis kesintileri minimize edilsin.

#### Kabul Kriterleri

1. THE PHP_FPM_Konteyneri SHALL bir health check mekanizması içerecektir
2. THE Nginx_Konteyneri SHALL bir health check mekanizması içerecektir
3. THE Docker_Compose SHALL tüm servisler için restart: unless-stopped politikasını uygulayacaktır
4. WHEN bir konteyner health check'te başarısız olursa, THE Docker_Compose SHALL konteyneri otomatik olarak yeniden başlatacaktır
5. THE Docker_Compose SHALL konteyner loglarına erişim sağlayacaktır

### Gereksinim 11: Makefile ile Komut Kısayolları

**Kullanıcı Hikayesi:** Bir geliştirici olarak, sık kullanılan Docker komutlarını kısa ve kolay hatırlanır komutlarla çalıştırmak istiyorum, böylece geliştirme verimliliği artsın.

#### Kabul Kriterleri

1. THE Makefile SHALL `make up` komutu ile tüm konteynerleri başlatacaktır
2. THE Makefile SHALL `make down` komutu ile tüm konteynerleri durduracaktır
3. THE Makefile SHALL `make build` komutu ile Docker imajlarını yeniden oluşturacaktır
4. THE Makefile SHALL `make artisan` komutu ile Artisan komutlarını çalıştıracaktır
5. THE Makefile SHALL `make migrate` komutu ile veritabanı migration'larını çalıştıracaktır
6. THE Makefile SHALL `make fresh` komutu ile veritabanını sıfırlayıp yeniden oluşturacaktır
7. THE Makefile SHALL `make logs` komutu ile konteyner loglarını gösterecektir
8. THE Makefile SHALL `make shell` komutu ile PHP konteynerine shell erişimi sağlayacaktır
