#!/bin/sh
set -e

echo "==> Uygulama başlatılıyor..."

# .env dosyası yoksa oluştur
if [ ! -f /var/www/html/.env ]; then
    echo "==> .env dosyası bulunamadı, .env.docker kopyalanıyor..."
    cp /var/www/html/.env.docker /var/www/html/.env
fi

# APP_KEY yoksa oluştur
if [ -z "$(grep '^APP_KEY=base64:' /var/www/html/.env)" ]; then
    echo "==> APP_KEY oluşturuluyor..."
    php artisan key:generate --force
fi

# Storage link kontrolü
if [ ! -L /var/www/html/public/storage ]; then
    echo "==> Storage link oluşturuluyor..."
    php artisan storage:link --force
fi

# Migration
echo "==> Migration'lar çalıştırılıyor..."
php artisan migrate --force --no-interaction 2>/dev/null || true

# Filament asset'lerini yayınla
echo "==> Filament asset'leri yayınlanıyor..."
php artisan filament:assets --force 2>/dev/null || true

# Cache optimizasyonu
echo "==> Önbellek temizleniyor..."
php artisan optimize:clear 2>/dev/null || true

# İzinleri düzelt
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true

echo "==> Uygulama hazır!"

# PHP-FPM'i başlat
exec php-fpm
