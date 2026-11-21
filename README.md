# InternshipManagerApp — Gestion des demandes de stage

Application web qui dématérialise le traitement des demandes de stage, de la candidature du stagiaire jusqu'à sa validation par le responsable de service et l'affectation d'un encadrant.

Projet réalisé pendant mon stage à la Division des Systèmes d'Information du CHU Ibn Sina de Rabat (août – septembre 2025).

## Fonctionnalités

L'application distingue trois rôles, chacun avec son propre espace.

**Stagiaire**
- Inscription et connexion
- Dépôt et suivi de ses demandes de stage
- Dépôt des documents demandés

**Responsable de service**
- Consultation des demandes reçues
- Acceptation, refus ou transfert d'une demande vers un autre service
- Affectation d'un encadrant au stagiaire
- Validation ou refus des documents, génération des documents du stage
- Gestion des encadrants

**Administrateur**
- Tableau de bord et statistiques
- Gestion des divisions, des services, des responsables et des types de documents
- Gestion des stagiaires

Chaque demande suit un cycle de vie (en attente, en cours, validée, refusée) et les actions effectuées sont enregistrées dans un historique.

## Stack technique

| Domaine | Technologies |
| --- | --- |
| Back-end | PHP 8.2, Laravel 12, Laravel Breeze (authentification) |
| Front-end | Blade, Tailwind CSS, Alpine.js, Vite |
| Base de données | SQLite par défaut (configurable vers MySQL) |
| Tests | Pest |

L'accès à chaque espace est protégé par un middleware de contrôle des rôles.

## Modèle de données

`User` (rôles stagiaire, responsable, admin), `Division`, `Service`, `Demande`, `HistoriqueDemande`, `Document`, `TypeDocument`, `Encadrant`, `Entreprise`.

## Installation

Prérequis : PHP 8.2 ou plus, Composer, Node.js.

```bash
git clone https://github.com/Yann402/InternshipManagerApp.git
cd InternshipManagerApp

composer install
cp .env.example .env
php artisan key:generate

touch database/database.sqlite
php artisan migrate

npm install
npm run build

php artisan serve
```

L'application est ensuite disponible sur `http://localhost:8000`.

Pour le développement, `npm run dev` recompile les ressources front-end à la volée.
