# Mini LMS Pédagogique

Mini plateforme LMS développée en Laravel permettant la gestion de formations, chapitres, sous-chapitres, contenus pédagogiques, quiz et notes.

## Stack technique

- Laravel 11 / PHP 8.3
- SQLite
- Blade + Tailwind CSS
- Laravel Breeze (authentification)
- PHPUnit (tests)

## Installation

### Prérequis
- PHP 8.2+
- Composer
- Node.js 18+

### Étapes
```bash
git clone https://github.com/Salah-eddine-boudi/mini-lms.git
cd mini-lms
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan serve
```

Ouvrir http://localhost:8000

## Identifiants de démo

| Rôle | Email | Mot de passe |
|------|-------|-------------|
| Admin | admin@lms.fr | password |
| Apprenant | apprenant1@lms.fr | password |
| Apprenant | apprenant2@lms.fr | password |
| Apprenant | apprenant3@lms.fr | password |

## Fonctionnalités

### Admin
- CRUD formations, chapitres, sous-chapitres
- CRUD quiz avec questions à choix multiples
- Gestion des apprenants et inscriptions aux formations
- Saisie et gestion des notes
- Dashboard avec statistiques
- Import de contenu pédagogique (compatible IA)

### Apprenant
- Consultation des formations et contenus
- Navigation hiérarchique (Formation > Chapitre > Sous-chapitre)
- Passage de quiz avec calcul de score automatique
- Consultation des notes et résultats

## Contenu de démo

Le seeder inclut un module complet sur **les verbes irréguliers en anglais** avec :
- 3 chapitres, 5 sous-chapitres
- Contenu HTML pédagogique riche
- 2 quiz (15 questions au total)
- Notes et résultats de démo

## Structure du projet
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          (6 contrôleurs)
│   │   └── Apprenant/      (4 contrôleurs)
│   ├── Middleware/
│   │   └── CheckRole.php
│   └── Requests/Admin/     (Form Requests)
├── Models/                  (9 modèles)
database/
├── migrations/              (13 migrations)
├── seeders/
resources/views/
├── layouts/                 (2 layouts distincts)
├── admin/                   (vues admin)
└── apprenant/               (vues apprenant)

## Auteur

Salah-Eddine Boudi

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
