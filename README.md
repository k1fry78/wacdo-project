Livrable 1 Back-End

# Wacdo - Back Office de Commande (Projet PHP MVC)

Ce projet est un back-office développé en PHP avec une architecture MVC (Modèle-Vue-Contrôleur). Il permet la gestion des commandes, des produits et des utilisateurs dans le cadre d’une application de borne de commande pour un restaurant.

## 🛠 Technologies utilisées

- PHP (POO, sans framework)
- Architecture MVC
- MySQL (phpMyAdmin)
- HTML/CSS
- Serveur local : WAMP (ou XAMPP)

## 📁 Arborescence du projet
wacdo-project/
│
├── controller/ # Contrôleurs MVC
├── model/ # Modèles (accès base de données)
├── vue/ # Vues HTML du projet
├── public/ # Dossier public avec index.php
├── config.php # Configuration de la base de données
├── router.php # Fichier de routage
├── autoloader.php # Chargement automatique des classes
└── wacdo.sql # Export de la base de données


## ⚙️ Installation locale (WAMP)

### 1. Cloner le dépôt ou copier le dossier

Place le dossier `wacdo-project` dans :


ou

### 2. Importer la base de données

- Lance **phpMyAdmin** via `http://localhost/phpmyadmin`
- Crée une base de données nommée `wacdo`
- Importe le fichier `wacdo.sql` fourni dans le dépôt

### 3. Configuration de la base de données

Dans `config.php`, vérifie ou modifie les paramètres selon ta configuration locale :

php
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'wacdo');
define('DB_USER', 'root');
define('DB_PASS', '');
?>
http://localhost/wacdo-project/public/

Voici les 3 comptes pour se connecter dans les 3 différents roles:

accueil@gmail.com
password
Role_Accueil

preparateur@gmail.com
password
Role_Preparateur

admin@gmail.com
password
Role_Admin

