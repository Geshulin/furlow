# Furlow

Sistem penitipan dan grooming hewan peliharaan (Laravel, Breeze, Tailwind CSS, Alpine.js, MySQL).

## Instalasi

1. Pasang Laragon, Composer, dan Node.js LTS
2. `git clone <url-repo> furlow` lalu `cd furlow`
3. `composer install` dan `npm install`
4. `copy .env.example .env` lalu `php artisan key:generate`
5. Buat database `furlow` di phpMyAdmin, atur `.env` (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
6. `php artisan migrate:fresh --seed` lalu `php artisan storage:link`
7. Terminal 1: `npm run dev`. Terminal 2: `php artisan serve`
8. Buka http://127.0.0.1:8000

## Akun demo

- Admin: admin@furlow.com / bulu321
- Pemilik hewan: lihat database/seeders/DemoSeeder.php
