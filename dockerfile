# Base image
FROM richarvey/nginx-php-fpm:latest

WORKDIR /var/www/html

# Izinkan composer jalan sebagai root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy semua file ke container
COPY . .

# Buat ulang folder Laravel penting & set permission
RUN mkdir -p bootstrap/cache \
    && mkdir -p storage/framework/{cache,sessions,views} \
    && mkdir -p storage/logs \
    && chmod -R 777 storage bootstrap/cache

# Tambahkan APP_STORAGE supaya Laravel tahu path-nya
ENV APP_STORAGE=/var/www/html/storage

# Disable auto script composer (biar gak jalan package:discover dulu)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Jalankan artisan commands manual setelah folder siap
RUN php artisan package:discover --ansi || true \
    && php artisan key:generate || true \
    && php artisan config:clear || true \
    && php artisan cache:clear || true \
    && php artisan route:clear || true \
    && php artisan view:clear || true

# Build asset frontend
RUN npm install && npm run build

# Jalankan migrasi & server saat runtime
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8000

EXPOSE 8000
