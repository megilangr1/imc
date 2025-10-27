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
# Stage 2: PHP base image for Laravel
# ===========================================
FROM php:8.2-fpm-alpine AS backend

WORKDIR /var/www/html

RUN apk add --no-cache \
  git unzip libpng-dev libjpeg-turbo-dev freetype-dev \
  oniguruma-dev libxml2-dev libzip-dev curl bash \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy seluruh source dan hasil frontend build
COPY ./src ./
COPY --from=frontend /app/public/build ./public/build

RUN cp .env.example .env || true
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN php artisan key:generate
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
