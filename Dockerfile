FROM php:8.3-cli

# Install dependensi sistem & ekstensi PHP untuk Laravel + MySQL SSL
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev ca-certificates \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install dependensi PHP produksi
RUN composer install --no-dev --optimize-autoloader

# Atur hak akses folder storage & cache
RUN chmod -R 775 storage bootstrap/cache

# Jalankan migrasi, seeder akun awal, dan server Laravel
CMD sh -c "php artisan config:clear && php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-7860}"