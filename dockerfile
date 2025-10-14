# Base image
FROM richarvey/nginx-php-fpm:latest

WORKDIR /var/www/html

# Copy semua file dulu
COPY . .

# Buat storage & cache directory
RUN mkdir -p bootstrap/cache \
    && mkdir -p storage/framework/{cache,sessions,views} \
    && mkdir -p storage/logs \
    && chmod -R 777 storage bootstrap/cache

# Izinkan composer jalan sebagai root
ENV COMPOSER_ALLOW_SUPERUSER=1
# Tambahkan path storage agar Laravel bisa detect
ENV APP_STORAGE=/var/www/html/storage

# Install dependencies (tanpa artisan command dulu)
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Jalankan artisan command setelah dependensi siap
RUN php artisan key:generate || true \
    && php artisan config:clear || true \
    && php artisan cache:clear || true \
    && php artisan view:clear || true \
    && php artisan route:clear || true

# Jalankan migrasi & server saat runtime
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8000

EXPOSE 8000
