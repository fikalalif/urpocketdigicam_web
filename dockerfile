# Base image
FROM richarvey/nginx-php-fpm:latest

WORKDIR /var/www/html

# Copy semua file dulu
COPY . .

# Pastikan storage & bootstrap/cache ada SEBELUM composer install
RUN mkdir -p storage/framework/{cache,sessions,views} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

# Allow composer run as root (wajib di Render)
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install dependencies dan build assets
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build \
    && php artisan key:generate \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Jalankan migrasi & server waktu runtime
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8000

EXPOSE 8000
