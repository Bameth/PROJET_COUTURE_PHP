<?php
namespace ab\Views;
use ab\Core\Session;
$errors = [];
if (Session::get("errors")) {
    $errors = Session::get("errors");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Types</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-8">
    <!-- Conteneur principal avec marge supérieure -->
    <div class="max-w-2xl mx-auto mt-8">
        <!-- Card -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <!-- Nouvelle Catégorie Form -->
            <?php if ($_REQUEST['action'] == "liste-type"): ?>
                <h2 class="text-2xl font-bold mb-4">Ajouter un Nouveau Type</h2>
                <form action="<?= WEBROOT ?>?controller=type&action=save-type" class="mb-6" method="POST">
                    <div class="flex items-center">
                        <input type="text" name="nomType"
                            class="w-full border-gray-300 rounded-md p-3 focus:outline-none focus:ring focus:border-blue-300 <?= \ab\Core\add_class_invalid("nomType") ?>"
                            placeholder="Nom du nouveau Type">
                        <button name="btnsu" value="btnsu" type="submit"
                            class="ml-4 bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out">Ajouter</button>
                    </div>
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium"></span><?= $errors["nomType"] ?? "" ?></p>
                    <input type="hidden" name="action" value="save-type">
                </form>

            <?php endif ?>
            <?php if ($_REQUEST['action'] == "modif-type"): ?>
                <h2 class="text-2xl font-bold mb-4">Modifier le Type</h2>
                <form action="<?= WEBROOT ?>?controller=type&action=update-type" class="flex items-center mb-6"
                    method="POST">
                    <input type="text" value="<?= $types['nomType'] ?>" name="nomType"
                        class="w-full border-gray-300 rounded-md p-3 focus:outline-none focus:ring focus:border-blue-300"
                        placeholder="Entrer la modification">
                    <input type="hidden" name="id" value="<?= $types['id'] ?>">
                    <input type="hidden" name="action" value="update-type">
                    <button name="btnmodif" value="btnmodif" type="submit"
                        class="ml-4 bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out">Modifier</button>
                    <button name="btnca" value="btnca" type="submit"
                        class="ml-4 bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out">Annuler</button>
                </form>
            <?php endif ?>
            <!-- Tableau de liste -->
            <table class="w-full">
                <!-- Header -->
                <?php if ($_REQUEST['action'] == "liste-type"): ?>
                    <thead class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 text-white">
                        <tr>
                            <th class="py-3 px-4 text-center">Nom des Types</th>
                            <th class="py-3 px-4 text-center">Actions</th>
                        </tr>
                    </thead>
                <?php endif ?>
                <!-- Body -->
                <tbody class="text-gray-700">
                    <?php if ($_REQUEST['action'] == "liste-type"): ?>
                        <?php foreach ($types as $type): ?>
                            <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                                <td class="px-6 py-4 text-center"><?= $type['nomType']; ?></td>
                                <td class="px-6 py-4 flex justify-center space-x-4">
                                    <a href="<?= WEBROOT ?>/?controller=type&action=modif-type&id=<?= $type['id'] ?>"
                                        class="text-gray-500 hover:text-blue-500 mr-4 transition duration-300 ease-in-out">
                                        <svg class="h-6 w-6" fill="none" stroke="green" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19v-8m0 0V5m0 8h.01m-6 0a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </a>
                                    <a href="<?= WEBROOT ?>/?controller=type&action=del-type&id=<?= $type['id'] ?>"
                                        class="delete-button text-red-500 hover:text-red-700 transition duration-300 ease-in-out">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12M6 6l12-12"></path>
                                        </svg>
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modale de confirmation de suppression -->
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Supprimer le type</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Voulez-vous vraiment supprimer ce type ? Cette action est
                            irréversible!</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="confirmDelete" type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                        Supprimer
                    </button>
                    <button id="cancelDelete" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
Session::remove("errors");
?>
<script src="<?=WEBROOT?>/js/Script.js" ></script>
<script src="<?=WEBROOT?>/js/Type.js" ></script>