# ===========================================
# Stage 1: Build frontend assets
# ===========================================
FROM node:22-alpine AS frontend

WORKDIR /app

COPY ./src/package*.json ./
RUN npm ci

COPY ./src ./
RUN npm run build


# ===========================================
# Stage 2: PHP + wkhtmltopdf (Debian based)
# ===========================================
FROM php:8.2-fpm-bullseye AS backend

WORKDIR /var/www/html

# Install system dependencies + wkhtmltopdf
RUN apt-get update && apt-get install -y \
    git unzip curl bash \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev \
    libmagickwand-dev imagemagick \
    wkhtmltopdf \
    libxrender1 libxext6 libfontconfig1 \
    fonts-dejavu fonts-liberation \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy source Laravel
COPY ./src ./

# Copy hasil build frontend
COPY --from=frontend /app/public/build ./public/build

# Laravel setup
RUN cp .env.example .env || true
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN php artisan key:generate

RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
