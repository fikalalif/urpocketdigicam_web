# Gunakan PHP + Composer + Node bawaan
FROM richarvey/nginx-php-fpm:latest

# Set working directory
WORKDIR /var/www/html

# Copy semua project ke container
COPY . .

# Buat folder cache dan storage sebelum jalankan artisan
RUN mkdir -p bootstrap/cache \
    && mkdir -p storage/framework/{cache,sessions,views} \
    && mkdir -p storage/logs \
    && chmod -R 777 storage bootstrap/cache

# Install dependencies dan build assets
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build \
    && php artisan key:generate \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Jalankan migrasi hanya saat container running (bukan di build)
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8000

EXPOSE 8000
