FROM php:8.4-cli

RUN apt-get update && apt-get install -y nano libzip-dev zip unzip && docker-php-ext-install pdo_mysql zip && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

COPY .env.example .env

RUN mkdir -p database && touch database/database.sqlite && chmod -R 775 storage bootstrap/cache database

RUN php artisan key:generate

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public", "public/index.php"]
