FROM php:8.4-cli

# System-Abhängigkeiten (für Composer und Laravel nötig)
RUN apt-get update && apt-get install -y nano libzip-dev zip unzip && docker-php-ext-install pdo_mysql zip && rm -rf /var/lib/apt/lists/*

# Composer direkt aus dem offiziellen Image kopieren
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Arbeitsverzeichnis festlegen
WORKDIR /var/www/html

# Projektdateien kopieren
COPY . .

# Abhängigkeiten installieren
RUN composer install --no-dev --optimize-autoloader

COPY .env.example .env
RUN php artisan key:generate

# Port 8000 freigeben
EXPOSE 8000

# Der Startbefehl: Wir nutzen artisan serve, was intern php -S nutzt
# --host=0.0.0.0 ist wichtig, damit der Container von außen erreichbar ist
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
