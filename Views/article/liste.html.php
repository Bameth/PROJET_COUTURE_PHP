<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau Magnifique</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= WEBROOT ?>/js/Script.js">
    <style>
        /* Effet de transition au survol */
        tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto py-6 px-8 sm:px-10 lg:px-12">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold text-gray-800">Liste des Produits</h1>
                <a href="<?= WEBROOT ?>/?controller=article&action=form-article"
                   class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                    Nouveau
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead class="bg-blue-200">
                        <tr>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Libellé</th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Quantité en Stock</th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Prix</th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($articles as $article): ?>
                            <tr>
                                <td class="px-6 py-4 text-center"><?= $article['libelle']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $article['qteStock']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $article['prixAppro']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $article['nomCategorie']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $article['nomType']; ?></td>
                                <td class="px-6 py-4 flex justify-center space-x-4">
                                    <a href="<?= WEBROOT ?>/?controller=article&action=del-art&id=<?= $article['id'] ?>" class="text-red-500 hover:text-red-700 delete-button" data-id="<?= $article['id'] ?>">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12M6 6l12-12"></path>
                                        </svg>
                                    </a>
                                    <a href="<?= WEBROOT ?>/?controller=article&action=modif-art&id=<?= $article['id'] ?>"
                                       class="text-green-500 hover:text-green-700">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 19v-8m0 0V5m0 8h.01m-6 0a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modale de confirmation de suppression -->
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Supprimer l'article</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Voulez-vous vraiment supprimer cet article ? Cette action est
                            irréversible.</p>
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
<script src="<?= WEBROOT ?>/js/article.js"></script>
