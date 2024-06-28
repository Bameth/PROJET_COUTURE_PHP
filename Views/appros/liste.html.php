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
                <a href="<?= WEBROOT ?>/?controller=appro&action=form-appro"
                   class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                    Nouveau
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead class="bg-blue-200">
                        <tr>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Montant</th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Fournisseur</th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Telephone</th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($appros as $appro): ?>
                            <tr>
                                <td class="px-6 py-4 text-center"><?= $appro['date']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $appro['montant']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $appro['nomFournisseur']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $appro['telFournisseur']; ?></td>
                                <td class="text-center" ><a href="" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">Voir Details</a></td>
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
