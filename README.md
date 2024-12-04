Gestion d’un Atelier de Couture
Description
Ce projet est une application web développée en PHP pour la gestion des activités d’un atelier de couture. L’application permet de gérer le stock, la production, et la vente des articles. Elle offre un ensemble de fonctionnalités adaptées aux différents rôles dans l’atelier (Gestionnaire, Responsable de Stock, Responsable de Production, et Vendeur).

Fonctionnalités
Gestion des Stocks
Enregistrement des approvisionnements : Ajouter des approvisionnements avec les informations suivantes :

Date
Quantité
Prix unitaire
Montant total
Observation
Articles de confection (tissus, boutons, aiguilles, etc.)
Fournisseur
Recherche et filtration :

Par date
Par article
Par fournisseur
Gestion de la Production
Enregistrement des productions des articles de vente (costumes, robes, vêtements africains, etc.) :

Date
Quantité produite
Observation
Listing des productions :

Toutes les productions de la journée
Productions par article
Gestion des Ventes
Enregistrement des ventes :

Date
Quantité vendue
Prix unitaire
Montant total
Observation
Recherche et filtration :

Par date
Par article
Par client
Gestion des Ressources
Accessible uniquement par le Gestionnaire, qui peut gérer (ajouter, modifier, archiver ou lister) :

Catégories d’articles :
Articles de confection (tissus, boutons, etc.)
Articles de vente (costumes, robes, etc.)
Fournisseurs : Nom, prénom, téléphone, adresse, photo
Clients : Nom, prénom, téléphone, adresse, observations, photo
Responsables :
Responsable Stock
Responsable Production
Vendeurs
Chaque responsable a les attributs suivants : Nom, prénom, téléphone, adresse, salaire, photo
Articles :
Articles de confection : Libellé, prix d’achat, quantité d’achat, quantité en stock, montant total en stock, photo
Articles de vente : Libellé, prix de vente, quantité en stock, montant total de vente, photo
Accès au Système
Authentification sécurisée :
Les fonctionnalités sont accessibles uniquement après connexion.
Gestion des rôles :
Gestionnaire : Accès complet au système.
Responsable de Stock : Gestion des approvisionnements.
Responsable de Production : Gestion des productions.
Vendeur : Gestion des ventes.
Prérequis Techniques
Backend
Langage : PHP
Base de données : MySQL,Postgres
Serveur web : WampServer
Frontend
HTML/CSS avec un framework CSS léger (Bootstrap ou Tailwind CSS recommandé)
JavaScript pour les interactions dynamiques

Clonez le dépôt du projet :
git clone <url_du_dépôt>

Configurez la base de données :
Importez le fichier database.sql fourni dans MySQL.
Modifiez les informations de connexion à la base dans le fichier Model.php

Lancez le serveur :
php -S localhost:8010 -t public
Accédez à l'application via http://localhost:8010.

Structure du Projet
index.php : Point d'entrée principal.
Model.php : Configuration de la base de données.
controllers/ : Contient les contrôleurs pour chaque fonctionnalité.
models/ : Contient les modèles pour gérer les données.
views/ : Contient les fichiers de vue pour l'interface utilisateur.
assets/ : Contient les ressources (CSS, JS, images).
Auteur
Développé par Ameth BA étudiant en Génie Logiciel.
