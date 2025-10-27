# ===========================================
# Stage 1: Ambil dari PHP build
# ===========================================
FROM siadik-php:latest AS builder
# 👆 gunakan image hasil build dari php/Dockerfile

# ===========================================
# Stage 2: Final Nginx image
# ===========================================
FROM nginx:1.27-alpine

RUN rm /etc/nginx/conf.d/default.conf
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy semua hasil Laravel dari builder
COPY --from=builder /var/www/html/public /var/www/html/public

RUN mkdir -p /var/log/nginx && chmod -R 755 /var/log/nginx

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
