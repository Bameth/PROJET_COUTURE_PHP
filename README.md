Gestion d’un Atelier de Couture

📋 Description
Ce projet est une application web développée en PHP pour la gestion des activités d’un atelier de couture. Elle permet de gérer :

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
🖌️ HTML/CSS (avec Bootstrap ou Tailwind CSS)
💡 JavaScript pour les interactions dynamiques
🚀 Installation

Clonez le dépôt du projet :
git clone <url_du_dépôt>
Configurez la base de données :
Importez le fichier database.sql dans votre base de données MySQL.
Modifiez les informations de connexion à la base dans le fichier Model.php.
Lancez le serveur :
php -S localhost:8010 -t public
Accédez à l'application :
🌐 http://localhost:8010
📂 Structure du Projet

index.php : Point d'entrée principal.
Model.php : Configuration de la base de données.
controllers/ : Contrôleurs pour chaque fonctionnalité.
models/ : Modèles pour gérer les données.
views/ : Fichiers de vue pour l'interface utilisateur.
assets/ : Ressources (CSS, JS, images).
👨‍💻 Auteur

Ameth BA
🎓 Étudiant en Génie Logiciel