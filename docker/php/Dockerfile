# ============================================
# Stage 1: Composer Dependencies
# ============================================
FROM composer:2 AS composer-deps

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --ignore-platform-reqs

# ============================================
# Stage 2: PHP-FPM Production Image
# ============================================
FROM php:8.4-fpm-alpine AS production

# Sistem bağımlılıkları
RUN apk add --no-cache \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libzip-dev \
    icu-dev \
    imagemagick-dev \
    oniguruma-dev \
    pcre-dev \
    linux-headers \
    fcgi \
    $PHPIZE_DEPS \
    && pecl install redis imagick \
    && docker-php-ext-enable redis imagick \
    && docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl \
    && apk del $PHPIZE_DEPS linux-headers pcre-dev

# PHP log dizini
RUN mkdir -p /var/log/php && chown www-data:www-data /var/log/php

# PHP yapılandırması
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

# Çalışma dizini
WORKDIR /var/www/html

# Composer bağımlılıkları
COPY --from=composer-deps /app/vendor ./vendor
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Uygulama dosyaları
COPY . .

# Autoloader optimizasyonu
RUN composer dump-autoload --optimize --no-dev

# Dizin izinleri
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Entrypoint script
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Health check
HEALTHCHECK --interval=30s --timeout=5s --retries=3 --start-period=10s \
    CMD php -r "echo 'OK';" || exit 1

EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
