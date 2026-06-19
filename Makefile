# ============================================
# Hasibe Çavuşoğlu - Docker Makefile
# ============================================

.PHONY: help up down build restart logs logs-app logs-nginx shell artisan migrate fresh seed composer test cache-clear optimize permissions prod-up prod-down ssl-init ssl-renew install

# Varsayılan hedef
help: ## Yardım menüsünü göster
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | \
		awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

# === Konteyner Yönetimi ===

up: ## Tüm konteynerleri başlat
	docker compose up -d

down: ## Tüm konteynerleri durdur
	docker compose down

build: ## Docker imajlarını yeniden oluştur
	docker compose build --no-cache

restart: ## Konteynerleri yeniden başlat
	docker compose restart

logs: ## Konteyner loglarını göster
	docker compose logs -f

logs-app: ## PHP konteyner loglarını göster
	docker compose logs -f app

logs-nginx: ## Nginx loglarını göster
	docker compose logs -f nginx

# === Uygulama Komutları ===

shell: ## PHP konteynerine shell erişimi
	docker compose exec app sh

artisan: ## Artisan komutu çalıştır (kullanım: make artisan cmd="migrate")
	docker compose exec app php artisan $(cmd)

migrate: ## Migration'ları çalıştır
	docker compose exec app php artisan migrate

fresh: ## Veritabanını sıfırla ve yeniden oluştur
	docker compose exec app php artisan migrate:fresh --seed

seed: ## Seeder'ları çalıştır
	docker compose exec app php artisan db:seed

composer: ## Composer komutu çalıştır (kullanım: make composer cmd="install")
	docker compose exec app composer $(cmd)

# === Bakım ===

cache-clear: ## Tüm önbellekleri temizle
	docker compose exec app php artisan optimize:clear

optimize: ## Uygulama önbelleklerini oluştur
	docker compose exec app php artisan optimize

permissions: ## Dosya izinlerini düzelt
	docker compose exec app chown -R www-data:www-data storage bootstrap/cache
	docker compose exec app chmod -R 775 storage bootstrap/cache

# === Üretim ===

prod-up: ## Üretim ortamını başlat
	docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d

prod-down: ## Üretim ortamını durdur
	docker compose -f docker-compose.yml -f docker-compose.prod.yml down

ssl-init: ## İlk SSL sertifikasını al
	docker compose run --rm certbot certonly \
		--webroot --webroot-path=/var/www/certbot \
		--email admin@hasibecavusoglu.com \
		--agree-tos --no-eff-email \
		-d hasibecavusoglu.com -d www.hasibecavusoglu.com

ssl-renew: ## SSL sertifikasını yenile
	docker compose run --rm certbot renew

# === Test ===

test: ## PHPUnit testlerini çalıştır
	docker compose exec app php artisan test

# === İlk Kurulum ===

install: ## İlk kurulum (tüm adımlar)
	@make build
	@make up
	@sleep 10
	docker compose exec app composer install
	docker compose exec app cp .env.docker .env
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan migrate --seed
	docker compose exec app php artisan storage:link
	docker compose exec app php artisan filament:assets
	@make permissions
	@echo "✅ Kurulum tamamlandı! http://localhost:3000 adresini ziyaret edin."
