# InnovQube Booking

Application Laravel de réservation de propriétés (recherche, disponibilité, réservation, annulation avec politique).

## Installation

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

## Lancement

```bash
php artisan serve
npm run dev
```

L'application est accessible sur `http://localhost:8000`.

## Tests

```bash
php artisan test
```

## Choix techniques

- **Laravel 12** avec **Livewire 3** et **Filament 3** pour l'interface.
- **Pest** pour les tests (unitaires et fonctionnels).
- Contrainte SQL `overlapping` (PostgreSQL) au niveau base de données pour empêcher les réservations en double sur une même propriété.
- Calcul du prix et politique d'annulation gérés côté modèle `Booking`.
