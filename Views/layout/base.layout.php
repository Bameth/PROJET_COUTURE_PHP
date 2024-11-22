<?php
namespace ab\Views;
use ab\Core\Session;
$errors = [];
if (Session::get("errors")) {
    $errors = Session::get("errors");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .nav-link:hover::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background: #6366f1;
            transition: width .3s;
        }

        .search-input-transition {
            transition: all 0.3s;
        }

        .nav-item {
            margin-right: 20px;
            /* Ajout d'espace entre les éléments */
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Ajout d'une ombre subtile */
        }

        /* Style pour le lien actif */
        .active-link::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background: #6366f1;
            /* Couleur de soulignement */
            transition: width .3s;
        }

        /* Dropdown styles */
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg navbar">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <!-- Left side: Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <svg class="h-8 w-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3l4 4m0 0l4-4m-4 4v14a2 2 0 002 2h6a2 2 0 002-2V7m-4 10v4a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4m0-8V3a2 2 0 012-2h4a2 2 0 012 2v4">
                        </path>
                    </svg>
                    <span class="ml-2 text-gray-800 text-lg font-bold">Gestion de Couture</span>
                </div>
                <!-- Right side: Navigation Links, User Icon, and Search Icon -->
                <div class="flex items-center">
                    <!-- User Icon and Name -->
                    <div class="flex items-center mr-4">
                        <svg class="h-6 w-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 20v-2a7 7 0 0114 0v2"></path>
                        </svg>
                        <span class="ml-2 text-gray-800">Prenom et Nom :
                            <?= $_SESSION["userConnect"]["nomComplet"] ?></span>
                    </div>
                    <!-- Navigation Links -->
                    <div class="hidden md:flex space-x-8 nav-item">
                        <div class="relative dropdown">
                            <a href="<?= WEBROOT ?>/?controller=article&action=liste-article&page=0"
                                class=" text-gray-800  px-3 py-2 rounded-md text-sm font-medium">Article</a>
                            <div class="dropdown-menu absolute mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                <a href="<?= WEBROOT ?>/?controller=type&action=liste-type"
                                    class="nav-link text-gray-800 hover:text-indigo-500 px-3 py-2 rounded-md text-sm font-medium ">Type</a>
                                <a href="<?= WEBROOT ?>/?controller=categorie&action=liste-categorie"
                                    class="nav-link text-gray-800 hover:text-indigo-500 px-3 py-2 rounded-md text-sm font-medium ">Categorie</a>
                            </div>
                        </div>
                        <a href="<?= WEBROOT ?>/?controller=appro&action=liste-appro&page=0"
                            class="nav-link text-gray-800 hover:text-indigo-500 px-3 py-2 rounded-md text-sm font-medium">Approvisionnement</a>
                        <a href="<?= WEBROOT ?>/?controller=production&action=liste-production&page=0"
                            class="nav-link text-gray-800 hover:text-indigo-500 px-3 py-2 rounded-md text-sm font-medium">Production</a>
                        <a href="<?= WEBROOT ?>/?controller=vente&action=liste-vente&page=0"
                        class="nav-link text-gray-800 hover:text-indigo-500 px-3 py-2 rounded-md text-sm font-medium">Ventes</a>
                        </div>
                    <!-- Déconnexion -->
                    <a href="<?= WEBROOT ?>/?controller=securite&action=show-form"
                        class="text-gray-800 hover:text-indigo-500">
                        <svg className="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</body>
<main>
    <?php
    echo $contentView;
    ?>
</main>
</html>
<?php
Session::remove("errors");
?>
