# 🎓 Mini LMS pédagogique – Laravel

## 📌 Description

Ce projet est une **application web de type LMS (Learning Management System)** développée avec Laravel.
Il permet de gérer du contenu pédagogique structuré, des quiz et le suivi des résultats des apprenants.

L’objectif est de proposer une plateforme simple, cohérente et démontrable, proche d’un cas réel dans le domaine de la formation.

---

## 🚀 Fonctionnalités principales

### 👨‍🏫 Administrateur / Formateur

* Gestion des formations (CRUD)
* Organisation du contenu :

  * Chapitres
  * Sous-chapitres
* Ajout de contenu pédagogique (texte / HTML)
* Création de quiz :

  * Questions à choix multiple
  * Une seule bonne réponse
* Visualisation des résultats des apprenants

### 👨‍🎓 Apprenant

* Accès aux formations
* Consultation des contenus pédagogiques
* Passage des quiz
* Calcul automatique du score
* Consultation des résultats

---

## 🧠 Exemple intégré

Un module pédagogique complet est inclus :

**Les verbes irréguliers en anglais**

* Chapitres et sous-chapitres
* Contenu pédagogique
* Quiz avec plusieurs questions

---

## 🏗️ Architecture technique

* **Framework** : Laravel 11
* **Langage** : PHP 8.3
* **Base de données** : SQLite (par défaut)
* **Frontend** : Blade + Bootstrap
* **Authentification** : Laravel Breeze
* **Architecture** : MVC (Model – View – Controller)

---

## 🔐 Gestion des rôles

Deux types d’utilisateurs :

* `admin` → accès complet à la gestion
* `apprenant` → accès limité (lecture + quiz)

Middleware utilisé :

```php
CheckRole
```

---

## 🗂️ Structure du projet

* `app/Models` → modèles Eloquent
* `app/Http/Controllers/Admin` → logique admin
* `app/Http/Controllers/Apprenant` → logique apprenant
* `resources/views/admin` → interfaces admin
* `resources/views/apprenant` → interfaces apprenant
* `database/migrations` → structure base de données
* `database/seeders` → données de démonstration

---

## ⚙️ Installation

### 1. Cloner le projet

```bash
git clone https://github.com/Salah-eddine-boudi/mini-lms.git
cd mini-lms
```

### 2. Installer les dépendances

```bash
composer install
npm install
```

### 3. Configuration

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Base de données

```bash
php artisan migrate --seed
```

### 5. Lancer le projet

```bash
php artisan serve
```

---

## 🔑 Comptes de test

### 👨‍🏫 Admin

* Email : `admin@test.com`
* Mot de passe : `password`

### 👨‍🎓 Apprenant

* Email : `apprenant@test.com`
* Mot de passe : `password`

---

## 🧪 Améliorations possibles

* Ajout de tests unitaires et fonctionnels
* Limitation du nombre de tentatives de quiz
* Interface utilisateur améliorée (UX/UI)
* Ajout de statistiques avancées
* API REST pour mobile / frontend React

---

## 💡 Objectifs du projet

* Structurer une application Laravel complète
* Implémenter une logique métier réaliste
* Gérer des relations complexes (formations, quiz, résultats)
* Créer une application démontrable rapidement
* Intégrer du contenu pédagogique généré par IA

---

## 👨‍💻 Auteur

**Salah Eddine Boudi**
Étudiant en Master 1 – Développement Logiciel
JUNIA ISEN Lille

* 💼 LinkedIn : https://www.linkedin.com/in/salah-eddine-boudi-b26b59252

---

## ⭐ Conclusion

Ce projet démontre la capacité à développer une application full-stack en Laravel, en respectant une logique métier claire, une architecture propre et une expérience utilisateur fonctionnelle.
