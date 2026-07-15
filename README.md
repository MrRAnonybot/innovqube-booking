# InnovQube Booking

Application Laravel de réservation de biens immobiliers : catalogue avec recherche et filtre de disponibilité, réservation avec calcul de prix en direct, et annulation protégée par une policy. Back-office d'administration via Filament.

Stack : Laravel 12, MySQL, Livewire 3, Filament v3, TailwindCSS 3, Breeze, Pest
## Installation

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Configurer la base MySQL dans `.env`, puis :

```bash
php artisan migrate --seed
php artisan make:filament-
```

## Lancement

```bash
php artisan serve
npm run dev
```

- Application : `http://localhost:8000`
- Back-office : `http://localhost:8000/admin`
## Tests

```bash
php artisan test
```
