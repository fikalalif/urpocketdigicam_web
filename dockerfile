# ==============================
# Stage 1: Build frontend assets
# ==============================
FROM node:20 AS frontend

WORKDIR /app

# Copy only the files needed for npm install
COPY package*.json vite.config.js ./
RUN npm install

# Copy the rest of the app and build assets
COPY resources ./resources
RUN npm run build


# ==============================
# Stage 2: Build Laravel app
# ==============================
FROM richarvey/nginx-php-fpm:latest

WORKDIR /var/www/html

# Allow composer run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy all backend files
COPY . .

# Copy built assets from the Node stage
COPY --from=frontend /app/public/build ./public/build

# Create required Laravel directories
RUN mkdir -p bootstrap/cache \
    && mkdir -p storage/framework/{cache,sessions,views} \
    && mkdir -p storage/logs \
    && chmod -R 777 storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts \
    && php artisan key:generate || true \
    && php artisan config:clear || true \
    && php artisan route:clear || true \
    && php artisan view:clear || true

# Jalankan migrasi & serve Laravel
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8000

EXPOSE 8000
