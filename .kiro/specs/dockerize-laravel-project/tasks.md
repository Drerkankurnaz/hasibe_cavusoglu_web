# Uygulama Planı: Laravel Projesini Dockerize Etme

## Genel Bakış

Bu plan, Hasibe Çavuşoğlu Psikoloji web sitesinin (Laravel 13 + Filament v5) Docker konteynerlerine taşınması için gerekli tüm yapılandırma dosyalarının oluşturulmasını kapsar. PHP-FPM, Nginx, MySQL 8 ve Redis konteynerlerinden oluşan çoklu konteyner mimarisi kurulacaktır.

## Görevler

- [x] 1. Docker dizin yapısını oluştur ve temel yapılandırma dosyalarını hazırla
  - [x] 1.1 Docker dizin yapısını oluştur
    - `docker/php/`, `docker/nginx/conf.d/`, `docker/mysql/` dizinlerini oluştur
    - _Gereksinimler: 1.5, 2.1, 3.1_

  - [x] 1.2 .dockerignore dosyasını oluştur
    - Git, node_modules, vendor, storage/logs, .env gibi gereksiz dosyaları hariç tut
    - Docker build context boyutunu minimize et
    - _Gereksinimler: 1.1, 1.2_

- [ ] 2. PHP-FPM konteyner yapılandırmasını oluştur
  - [-] 2.1 PHP-FPM Dockerfile dosyasını oluştur (`docker/php/Dockerfile`)
    - Multi-stage build stratejisi uygula (composer-deps + production)
    - PHP 8.3-fpm-alpine temel imajını kullan
    - Gerekli PHP uzantılarını yükle: pdo_mysql, mbstring, exif, pcntl, bcmath, gd, imagick, redis, zip, intl
    - Composer bağımlılıklarını kopyala ve autoloader optimizasyonu yap
    - Dizin izinlerini ayarla (storage, bootstrap/cache)
    - Health check mekanizması ekle
    - _Gereksinimler: 1.1, 1.2, 1.3, 1.4, 1.5, 1.6, 10.1_

  - [-] 2.2 PHP yapılandırma dosyasını oluştur (`docker/php/php.ini`)
    - upload_max_filesize = 64M
    - post_max_size = 64M
    - memory_limit = 256M
    - OPcache yapılandırması
    - Timezone: Europe/Istanbul
    - _Gereksinimler: 1.7, 1.8, 1.9_

  - [-] 2.3 PHP-FPM pool yapılandırmasını oluştur (`docker/php/www.conf`)
    - Dynamic process manager ayarları
    - Health check için ping.path ve status_path yapılandırması
    - _Gereksinimler: 1.1, 10.1_

- [ ] 3. Nginx web sunucusu yapılandırmasını oluştur
  - [~] 3.1 Nginx ana yapılandırma dosyasını oluştur (`docker/nginx/nginx.conf`)
    - Worker processes ve events ayarları
    - Gzip sıkıştırma desteği
    - client_max_body_size = 64M
    - Performans optimizasyonları (sendfile, tcp_nopush, keepalive)
    - _Gereksinimler: 2.5, 2.7_

  - [~] 3.2 Varsayılan site yapılandırmasını oluştur (`docker/nginx/conf.d/default.conf`)
    - Laravel URL yeniden yazma kuralları (try_files)
    - PHP-FPM FastCGI proxy ayarları
    - Statik dosyalar için önbellekleme başlıkları (30 gün)
    - Güvenlik başlıkları (X-Frame-Options, X-Content-Type-Options)
    - Health check endpoint (/health)
    - Gizli dosyaları engelleme
    - _Gereksinimler: 2.1, 2.2, 2.3, 2.4, 2.5, 2.6, 10.2_

  - [~] 3.3 SSL yapılandırma dosyasını oluştur (`docker/nginx/conf.d/ssl.conf`)
    - Let's Encrypt ACME challenge desteği
    - HTTP → HTTPS yönlendirmesi
    - TLS 1.2/1.3 protokol ayarları
    - HSTS başlığı
    - _Gereksinimler: 9.1, 9.2, 9.3, 9.4_

- [ ] 4. MySQL ve Redis yapılandırmasını oluştur
  - [-] 4.1 MySQL yapılandırma dosyasını oluştur (`docker/mysql/my.cnf`)
    - character-set-server = utf8mb4
    - collation-server = utf8mb4_unicode_ci
    - InnoDB buffer pool ve bağlantı limitleri
    - _Gereksinimler: 3.3, 3.4_

- [~] 5. Checkpoint - Tüm yapılandırma dosyalarını kontrol et
  - Tüm dosyaların doğru dizinlerde oluşturulduğunu doğrula, kullanıcıya sor.

- [ ] 6. Docker Compose dosyalarını oluştur
  - [~] 6.1 docker-compose.yml dosyasını oluştur (geliştirme ortamı)
    - PHP-FPM (app), Nginx, MySQL, Redis servislerini tanımla
    - app-network bridge ağı oluştur
    - Servisler arası bağımlılıkları depends_on + service_healthy ile tanımla
    - Named volumes tanımla (mysql_data, redis_data, vendor_data, storage_data, certbot_conf, certbot_www)
    - Geliştirme ortamı için bind-mount yapılandırması
    - Health check tanımları
    - restart: unless-stopped politikası
    - .env dosyasından ortam değişkenlerini oku
    - _Gereksinimler: 5.1, 5.2, 5.3, 5.4, 5.5, 5.6, 5.7, 6.1, 6.2, 6.3, 6.4, 6.5, 10.3, 10.4, 10.5_

  - [~] 6.2 docker-compose.prod.yml dosyasını oluştur (üretim override)
    - Üretim ortamı için volume yapılandırması (bind-mount kaldır)
    - APP_ENV=production, APP_DEBUG=false ayarları
    - Certbot konteyneri (SSL sertifika yenileme)
    - _Gereksinimler: 9.1, 9.4_

- [ ] 7. Ortam ve yardımcı dosyaları oluştur
  - [~] 7.1 .env.docker örnek dosyasını oluştur
    - Docker servis adlarına uygun host bilgileri (DB_HOST=mysql, REDIS_HOST=redis)
    - CACHE_STORE=redis, SESSION_DRIVER=redis yapılandırması
    - Queue, mail, filesystem ayarları
    - _Gereksinimler: 7.1, 7.2, 7.3, 7.4_

  - [~] 7.2 Makefile dosyasını oluştur
    - `make up` - konteynerleri başlat
    - `make down` - konteynerleri durdur
    - `make build` - imajları yeniden oluştur
    - `make artisan cmd="..."` - Artisan komutu çalıştır
    - `make migrate` - migration çalıştır
    - `make fresh` - veritabanını sıfırla
    - `make logs` - logları göster
    - `make shell` - PHP konteynerine erişim
    - `make install` - ilk kurulum
    - Üretim ve SSL komutları
    - _Gereksinimler: 8.1, 8.2, 8.3, 8.4, 8.5, 11.1, 11.2, 11.3, 11.4, 11.5, 11.6, 11.7, 11.8_

- [~] 8. Checkpoint - Docker yapısını doğrula
  - Tüm dosyaların oluşturulduğunu ve birbiriyle uyumlu olduğunu doğrula, kullanıcıya sor.

- [ ] 9. Test ve doğrulama
  - [~] 9.1 Smoke test komutlarını doğrula
    - `docker compose config` ile YAML geçerliliğini kontrol et
    - Dockerfile syntax kontrolü
    - _Gereksinimler: 5.1, 5.4_

  - [~] 9.2 Entegrasyon test doğrulaması
    - docker compose up ile tüm konteynerlerin başlatılması
    - PHP → MySQL bağlantı testi
    - PHP → Redis bağlantı testi
    - Nginx → PHP-FPM proxy testi
    - _Gereksinimler: 3.7, 4.4, 5.4, 10.1, 10.2_

- [~] 10. Son checkpoint - Tüm dosyaları ve yapılandırmaları doğrula
  - Tüm testlerin başarılı olduğundan emin ol, kullanıcıya sor.

## Notlar

- `*` ile işaretlenen görevler opsiyoneldir ve hızlı MVP için atlanabilir
- Her görev belirli gereksinimlere referans verir (izlenebilirlik)
- Checkpoint'ler artımlı doğrulama sağlar
- Bu özellik IaC/Docker yapılandırması olduğundan Property-Based Testing uygulanmaz
- Unit testler yerine smoke testleri ve entegrasyon testleri kullanılır
- Geliştirme ortamında SSL devre dışıdır, yalnızca üretimde aktiftir

## Task Dependency Graph

```json
{
  "waves": [
    { "id": 0, "tasks": ["1.1", "1.2"] },
    { "id": 1, "tasks": ["2.1", "2.2", "2.3", "4.1"] },
    { "id": 2, "tasks": ["3.1", "3.2", "3.3"] },
    { "id": 3, "tasks": ["6.1", "6.2"] },
    { "id": 4, "tasks": ["7.1", "7.2"] },
    { "id": 5, "tasks": ["9.1", "9.2"] }
  ]
}
```
