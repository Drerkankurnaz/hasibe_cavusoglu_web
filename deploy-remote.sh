#!/bin/bash
# Hasibe Çavuşoğlu Web — Local'den tek komutla canlıya deploy
# Kullanım: ./deploy-remote.sh
# Mac'ten çalıştırılır — önce git push, sonra sunucuda deploy
#
# İlk kullanımda sunucuya repo klonlanır, sonraki çalıştırmalarda pull + rebuild yapılır.

set -e

SERVER="root@45.133.36.71"
REMOTE_DIR="/opt/hasibe_cavusoglu_web"
REPO_URL="https://github.com/Drerkankurnaz/hasibe_cavusoglu_web.git"
BRANCH="main"

# Deploy zaman damgası (başlangıç)
DEPLOY_START_EPOCH=$(date +%s)
DEPLOY_START=$(date '+%d.%m.%Y %H:%M:%S')

echo "🚀 Hasibe Çavuşoğlu Web — Remote Deploy"
echo "========================================="
echo "🕒 Başlangıç: $DEPLOY_START"
echo ""

# 1. Local'de commit + push
echo "📤 [1/5] Git push..."
cd "$(dirname "$0")"
git add -A
git diff --cached --quiet 2>/dev/null || git commit -m "deploy: $(date '+%Y-%m-%d %H:%M')"
git push origin $BRANCH
echo "   ✅ Push tamamlandı"
echo ""

# 2. Sunucuda repo kontrolü — yoksa klonla, varsa pull
echo "🖥️  [2/5] Sunucu hazırlanıyor..."
ssh $SERVER "
  if [ ! -d $REMOTE_DIR ]; then
    echo '   📥 İlk kurulum: repo klonlanıyor...'
    git clone -b $BRANCH $REPO_URL $REMOTE_DIR
  else
    echo '   📥 Güncel kod çekiliyor...'
    cd $REMOTE_DIR && git stash 2>/dev/null; git pull origin $BRANCH
  fi
"
echo "   ✅ Kod güncel"
echo ""

# 3. Docker Compose build + up (production override ile — Cloudflare SSL, sadece port 80)
echo "🐳 [3/5] Docker konteynerler ayağa kaldırılıyor..."
ssh $SERVER "cd $REMOTE_DIR && \
  docker compose -f docker-compose.yml -f docker-compose.prod.yml down 2>/dev/null; \
  docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build"
echo "   ✅ Konteynerler çalışıyor"
echo ""

# 4. Migrasyon + Seeder (MySQL hazır olana kadar retry)
echo "🗄️  [4/5] Migrasyon ve seeder çalıştırılıyor..."
ssh $SERVER "cd $REMOTE_DIR && \
  for i in \$(seq 1 15); do \
    docker compose exec -T app php artisan migrate --force 2>/dev/null && break || { echo '   ⏳ DB bekleniyor... ('\$i'/15)'; sleep 5; }; \
  done && \
  docker compose exec -T app php artisan db:seed --force 2>/dev/null || true && \
  docker compose exec -T app php artisan config:cache && \
  docker compose exec -T app php artisan route:cache && \
  docker compose exec -T app php artisan view:cache && \
  docker compose exec -T app php artisan event:cache"
echo "   ✅ Migrasyon + cache tamamlandı"
echo ""

# 5. Docker çöp temizliği
echo "🧹 [5/5] Docker çöpü temizleniyor..."
ssh $SERVER "docker image prune -f >/dev/null 2>&1; docker builder prune -f --keep-storage 3GB >/dev/null 2>&1; echo '   temizlik tamam'"
echo ""

# Deploy zaman damgası (bitiş) + süre
DEPLOY_END=$(date '+%d.%m.%Y %H:%M:%S')
DEPLOY_DURATION=$(( $(date +%s) - DEPLOY_START_EPOCH ))

# Yerel deploy günlüğü — her başarılı deploy bir satır
echo "$DEPLOY_START → $DEPLOY_END (${DEPLOY_DURATION} sn)" >> "$(dirname "$0")/deploy.log"

echo "========================================="
echo "✅ Deploy tamamlandı!"
echo "🕒 Başlangıç: $DEPLOY_START"
echo "🕒 Bitiş:     $DEPLOY_END  (${DEPLOY_DURATION} sn)"
echo "🌐 https://www.hasibecavusoglu.com"
