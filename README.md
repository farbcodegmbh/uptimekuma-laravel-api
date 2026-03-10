# Uptime Kuma REST Adapter

Small API adapter for **Uptime Kuma** that allows monitors to be created via a simple REST interface.

Instead of using the internal WebSocket API, this service **writes directly to the Uptime Kuma database**.
It is intended for lightweight automation scenarios where systems should be able to create monitors via HTTP.

Note: This project is intentionally **quick and dirty**.

---

# Installation

## Classic Installation

Requirements

* PHP 8.3+
* Composer

Clone the repository

```bash
git clone https://github.com/farbcodegmbh/uptimekuma-laravel-api.git
cd <repo>
```

Install dependencies

```bash
composer install
```

Create environment file

```bash
cp .env.example .env
php artisan key:generate
```

Start the server

```bash
php artisan serve
```

API will be available at

```
http://localhost:8000
```

---

## Docker Installation

Run the adapter as a container.

```yaml
services:
    kuma-api:
        image: ghcr.io/<org>/<image>:latest
        ports:
            - "8000:8000"
        environment:
            APP_ENV: production
            APP_KEY: base64:YOUR_KEY
            DB_KUMA_HOST: 127.0.0.1
            DB_KUMA_PORT: 3306
            DB_KUMA_DATABASE: UPTIMEKUMA_DATABASE
            DB_KUMA_USERNAME: UPTIMEKUMA_DATABASE_USER
            DB_KUMA_PASSWORD: UPTIMEKUMA_DATABASE_PASSWORD
            KUMA_API_TOKEN: UPTIMEKUMA_API_TOKEN (for external access to api)
            KUMA_USER_ID: 1
            KUMA_ACTIVE: 1
            KUMA_INTERVAL: 60
```

Start the container

```bash
docker compose up -d
```

---

## Example with Uptime Kuma

The adapter can run together with Uptime Kuma inside the same docker compose.

```yaml
services:
    uptime-kuma:
        image: louislam/uptime-kuma
        container_name: uptime-kuma
        volumes:
            - ./uptime-kuma-data:/app/data
            - /var/run/docker.sock:/var/run/docker.sock
        environment:
            UPTIME_KUMA_DB_TYPE: mariadb
            UPTIME_KUMA_DB_HOSTNAME: host.docker.internal
            UPTIME_KUMA_DB_NAME: UPTIMEKUMA_DATABASE
            UPTIME_KUMA_DB_USERNAME: UPTIMEKUMA_DATABASE_USER
            UPTIME_KUMA_DB_PASSWORD: UPTIMEKUMA_DATABASE_PASSWORD
        extra_hosts:
            - "host.docker.internal:host-gateway"
        ports:
            - 3001:3001  # <Host Port>:<Container Port>
        restart: always

    kuma-api:
        image: ghcr.io/farbcodegmbh/uptimekuma-laravel-api:latest
        environment:
            APP_ENV: production
            APP_KEY: base64:YOUR_KEY
            DB_KUMA_HOST: host.docker.internal
            DB_KUMA_PORT: 3306
            DB_KUMA_DATABASE: UPTIMEKUMA_DATABASE
            DB_KUMA_USERNAME: UPTIMEKUMA_DATABASE_USER
            DB_KUMA_PASSWORD: UPTIMEKUMA_DATABASE_PASSWORD
            KUMA_API_TOKEN: UPTIMEKUMA_API_TOKEN (for external access to api)
            KUMA_USER_ID: 1
            KUMA_ACTIVE: 1
            KUMA_INTERVAL: 60
```

---

# Local Docker Test

Build the image

```bash
docker build -t uptime-kuma-api:local .
```

Run the container

```bash
docker run --rm -p 8000:8000 \
  -e APP_ENV=production \
  -e APP_KEY=base64:TEST_KEY \
  uptime-kuma-api:local
```

API endpoint

```
http://localhost:8000
```
