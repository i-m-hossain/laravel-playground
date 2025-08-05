# 🚀 Laravel API Boilerplate

A Laravel 12 RESTful API starter kit featuring:

- Sanctum authentication
- Redis-backed queue + cache
- Supervisor-managed queue workers (in Docker)
- Dockerized MySQL, PHP-FPM, Nginx, Redis
- Postman collection included for testing

---

## 🧰 Tech Stack

- Laravel 12 (PHP 8.2)
- Sanctum (API authentication)
- Redis (queue + cache)
- MySQL 5.7
- Supervisor (for queue worker management)
- Docker & Docker Compose

---

## 📦 Getting Started

### 🔧 Requirements

- Docker & Docker Compose installed
- Composer

---

### 🚀 Setup

```bash
# 1. Clone the repo
git clone https://github.com/i-m-hossain/laravel-playground.git
cd laravel-playground

# 2. Copy environment files
cp .env.example .env

# 3. Start containers
docker-compose up --build -d

# 4. Run Laravel setup
docker exec -it <php-container-name> bash

# Inside the container:
php artisan key:generate
php artisan migrate
php artisan db:seed  # optional
