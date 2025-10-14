# Gunakan PHP + Composer + Node bawaan
FROM richarvey/nginx-php-fpm:latest

# Set working directory
WORKDIR /var/www/html

# Copy seluruh project ke container
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build \
    && php artisan migrate --force \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Port Laravel
EXPOSE 8000

# Jalankan Laravel dengan PHP built-in server
CMD php artisan serve --host 0.0.0.0 --port 8000
