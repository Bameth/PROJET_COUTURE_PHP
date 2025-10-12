Gestion d’un Atelier de Couture

📋 Description

Ce projet est une application web From Scratch développée en PHP pour la gestion des activités d’un atelier de couture. Elle permet de gérer :

📦 Le stock,

🛠️ La production,

🛒 La vente des articles.

L’application propose des fonctionnalités adaptées aux rôles suivants :

👩‍💼 Gestionnaire,

📦 Responsable de Stock,

🛠️ Responsable de Production,

💼 Vendeur.

✨ Fonctionnalités

📦 Gestion des Stocks

Enregistrement des approvisionnements :

🗓️ Date

📊 Quantité, Prix unitaire, Montant total

📝 Observation

📌 Article (tissus, boutons, aiguilles, etc.)

🚚 Fournisseur

Recherche et filtrage :


📅 Par date

🛍️ Par article

🚚 Par fournisseur

🛠️ Gestion de la Production

Enregistrement des productions :

🗓️ Date

📊 Quantité produite

📝 Observation

Listing des productions :

📅 Productions journalières

🛍️ Productions par article

🛒 Gestion des Ventes

Enregistrement des ventes :

🗓️ Date

📊 Quantité vendue, Prix unitaire, Montant total

📝 Observation

Recherche et filtrage :


📅 Par date

🛍️ Par article

👤 Par client

👩‍💼 Gestion des Ressources (Accessible uniquement au Gestionnaire)

Catégories d’articles :

🧵 Articles de confection (tissus, boutons, etc.)

👗 Articles de vente (costumes, robes, etc.)

Fournisseurs :

👤 Nom, prénom, téléphone, adresse, photo

Clients :

👤 Nom, prénom, téléphone, adresse, observations, photo

Responsables :

📦 Responsable Stock

🛠️ Responsable Production

🛒 Vendeurs

📝 Attributs : Nom, prénom, téléphone, adresse, salaire, photo

Articles :

🧵 Articles de confection : Libellé, prix d’achat, quantité, montant total, photo

👗 Articles de vente : Libellé, prix de vente, quantité, montant total, photo

🔒 Accès au Système

Authentification sécurisée :

Les fonctionnalités sont accessibles uniquement après connexion.

Gestion des rôles :

👩‍💼 Gestionnaire : Accès complet au système.

📦 Responsable de Stock : Gestion des approvisionnements.

🛠️ Responsable de Production : Gestion des productions.

🛒 Vendeur : Gestion des ventes.

⚙️ Prérequis Techniques

Backend

💻 Langage : PHP

🗄️ Base de données : MySQL ou PostgreSQL

🌐 Serveur web : WampServer

Frontend

🖌️ Framework CSS : Tailwind CSS

💡 JavaScript pour les interactions dynamiques

🚀 Installation

1️⃣ Clonez le dépôt du projet

git clone <url_du_dépôt>

2️⃣ Installation des dépendances avec Composer

Assurez-vous que Composer est installé sur votre machine, puis exécutez :

composer install

3️⃣ Ajout de Tailwind CSS

Si Tailwind CSS n'est pas encore configuré, installez-le avec npm :

npm install -D tailwindcss postcss autoprefixer

npx tailwindcss init

Configurez Tailwind dans le fichier tailwind.config.js.

Compilez les styles avec :

npx tailwindcss -i ./src/input.css -o ./public/output.css --watch

4️⃣ Configurez la base de données

Importez le fichier database.sql dans votre base de données MySQL/PostgreSQL.

Modifiez les informations de connexion à la base dans le fichier Model.php.

5️⃣ Lancez le serveur

php -S localhost:8010 -t public

6️⃣ Accédez à l'application

🌐 Ouvrez votre navigateur à http://localhost:8010

📂 Structure du Projet

index.php : Point d'entrée principal dans /public.

Model.php : Configuration de la base de données.

controllers/ : Contrôleurs pour chaque fonctionnalité.

models/ : Modèles pour gérer les données.

views/ : Fichiers de vue pour l'interface utilisateur (avec Tailwind CSS).

public/ : Ressources (CSS, JS, images).

👨‍💻 Auteur

Ameth BA

🎓 Étudiant en Génie Logiciel
