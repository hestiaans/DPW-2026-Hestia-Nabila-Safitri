FROM php:8.2-apache

# Install driver pdo_pgsql agar PHP bisa terhubung ke Supabase PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy semua file project ke dalam folder apache
COPY . /var/www/html/

# Enable rewrite module (opsional)
RUN a2enmod rewrite

EXPOSE 80