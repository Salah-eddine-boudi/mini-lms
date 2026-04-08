# 🎓 Mini LMS Pédagogique — Laravel

> Plateforme de gestion de contenu pédagogique, de quiz et de suivi des résultats apprenants, développée en Laravel dans le cadre d'un exercice de stage.

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3-blue?style=flat-square&logo=php)
![SQLite](https://img.shields.io/badge/Database-SQLite-lightgrey?style=flat-square&logo=sqlite)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

---

## 📌 Présentation

**Mini LMS** est une application web de type *Learning Management System* permettant à un administrateur de structurer des formations pédagogiques complètes et à des apprenants de les consulter et d'y répondre via des quiz interactifs.

Le projet intègre également une fonctionnalité d'**import rapide de contenu et de quiz générés par IA** (ChatGPT), permettant d'alimenter la plateforme en quelques secondes.

---

## ✨ Fonctionnalités

### 👨‍🏫 Administrateur / Formateur

| Fonctionnalité | Description |
|---|---|
| Gestion des formations | Créer, modifier, supprimer, lister |
| Chapitres & Sous-chapitres | Organisation hiérarchique du contenu |
| Contenu pédagogique | Saisie HTML ou import depuis une IA |
| Création de quiz | Questions à choix multiple, une bonne réponse |
| Import rapide de quiz | Coller un texte formaté avec `*` pour la bonne réponse |
| Gestion des apprenants | Inscription et association à une formation |
| Suivi des résultats | Visualisation et modification des notes |

### 👨‍🎓 Apprenant

| Fonctionnalité | Description |
|---|---|
| Accès aux formations | Consultation du contenu assigné |
| Lecture des cours | Affichage HTML du contenu pédagogique |
| Passage des quiz | Interface interactive question par question |
| Score automatique | Calcul et affichage du résultat à la fin |
| Consultation des notes | Historique des résultats personnels |

---

## 🧠 Exemple intégré — Module Anglais

Un module pédagogique complet est inclus dans les seeders pour la démonstration :

```
📚 Formation     : Anglais pour débutants
 └── 📖 Chapitre     : Les verbes irréguliers en anglais
      └── 📄 Sous-chapitre : 10 verbes indispensables à connaître
           └── ❓ Quiz        : 7 questions à choix multiple
```

---

## 🏗️ Architecture technique

```
mini-lms/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Logique administrateur
│   │   │   └── Apprenant/      # Logique apprenant
│   │   └── Middleware/
│   │       └── CheckRole.php   # Contrôle d'accès par rôle
│   └── Models/                 # Modèles Eloquent
├── database/
│   ├── migrations/             # Structure base de données
│   └── seeders/                # Données de démonstration
├── resources/
│   └── views/
│       ├── admin/              # Interfaces administrateur
│       └── apprenant/          # Interfaces apprenant
└── routes/
    └── web.php                 # Définition des routes
```

| Technologie | Détail |
|---|---|
| Framework | Laravel 11 |
| Langage | PHP 8.3 |
| Base de données | SQLite (par défaut) |
| Frontend | Blade + Tailwind CSS |
| Authentification | Laravel Breeze |
| Architecture | MVC |

---

## 🔐 Gestion des rôles

L'application distingue deux profils utilisateurs, protégés par un middleware dédié :

```php
// app/Http/Middleware/CheckRole.php
```

| Rôle | Accès |
|---|---|
| `admin` | Accès complet : CRUD formations, quiz, apprenants, notes |
| `apprenant` | Accès limité : lecture des cours + passage des quiz |

---

## ⚡ Import rapide de quiz via IA

Une fonctionnalité clé du projet permet d'importer des questions générées par ChatGPT en **une seule opération** :

**Format attendu :**
```
1. Quel est le prétérit de "Go" ?
- Goed
* Went        ← astérisque = bonne réponse
- Gone
- Goes
```

> L'administrateur colle le texte généré par l'IA dans le formulaire d'import, et toutes les questions sont enregistrées automatiquement.

---

## ⚙️ Installation

### Prérequis

- PHP >= 8.2
- Composer
- Node.js & NPM

### Étapes

```bash
# 1. Cloner le dépôt
git clone https://github.com/Salah-eddine-boudi/mini-lms.git
cd mini-lms

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances JS
npm install

# 4. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 5. Créer et alimenter la base de données
php artisan migrate --seed

# 6. Compiler les assets
npm run dev

# 7. Lancer le serveur
php artisan serve
```

L'application est accessible sur : **http://localhost:8000**

---

## 🔑 Comptes de démonstration

| Rôle | Email | Mot de passe |
|---|---|---|
| 👨‍🏫 Administrateur | `admin@lms.com` | `password` |
| 👨‍🎓 Apprenant | `alice@lms.com` | `password` |

---

## 🧪 Tests

```bash
# Lancer tous les tests
php artisan test

# Tests d'authentification uniquement
php artisan test --filter AuthenticationTest
php artisan test --filter RegistrationTest
```

```
Tests:    82 passed
Duration: ~33s
```

---

## 🚀 Améliorations envisageables

- [ ] Limitation du nombre de tentatives par quiz
- [ ] Statistiques avancées pour l'administrateur
- [ ] Interface de notation enrichie
- [ ] API REST pour une intégration mobile ou React
- [ ] Support de l'upload de fichiers (PDF, vidéo)
- [ ] Notifications par email pour les résultats

---

## 👨‍💻 Auteur

**Salah Eddine Boudi**
Étudiant en Master 1 — Développement Logiciel
JUNIA ISEN Lille

[![LinkedIn](https://img.shields.io/badge/LinkedIn-Salah%20Eddine%20Boudi-blue?style=flat-square&logo=linkedin)](https://www.linkedin.com/in/salah-eddine-boudi-b26b59252)
[![GitHub](https://img.shields.io/badge/GitHub-mini--lms-black?style=flat-square&logo=github)](https://github.com/Salah-eddine-boudi/mini-lms)

---

## ⭐ Conclusion

Ce projet démontre la capacité à concevoir et développer une application full-stack en Laravel, en respectant une logique métier claire, une architecture MVC propre, une gestion des rôles sécurisée et une expérience utilisateur fonctionnelle — le tout livré en moins de 4 jours.
