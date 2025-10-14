# Base image
FROM richarvey/nginx-php-fpm:latest

WORKDIR /var/www/html

# Allow composer as root (Render runs as root)
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy seluruh file project
COPY . .

# Pastikan folder Laravel penting ada & permission benar
RUN mkdir -p bootstrap/cache \
    && mkdir -p storage/framework/{cache,sessions,views} \
    && mkdir -p storage/logs \
    && chmod -R 777 storage bootstrap/cache

# Install PHP dependencies tanpa artisan jalan dulu
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Jalankan artisan command dasar (tanpa error stop)
RUN php artisan package:discover --ansi || true \
    && php artisan key:generate || true \
    && php artisan config:clear || true \
    && php artisan cache:clear || true \
    && php artisan route:clear || true \
    && php artisan view:clear || true

# 🔧 Tambahkan Node.js & npm di bawah ini
RUN apt-get update && apt-get install -y nodejs npm

# Build frontend assets
RUN npm install && npm run build

# Jalankan migrasi dan start server
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8000

EXPOSE 8000
