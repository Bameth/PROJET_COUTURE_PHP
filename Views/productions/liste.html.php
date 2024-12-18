<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau Magnifique</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
                <h1 class="text-3xl font-bold text-gray-800">Liste des Productions</h1>
                <a href="<?= WEBROOT ?>/?controller=production&action=form-prod"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                    Nouveau
                </a>
            </div>
            <!-- Filtres -->
            <div class="flex items-center space-x-4 mb-4">
                <input type="date" name="filter_date" id="filter_date"
                    class="border border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md p-2"
                    placeholder="aaaa-mm-jj">
                <select name="filter_tailleur" id="filter_tailleur"
                    class="border border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md p-2">
                    <option value="">Sélectionner un tailleur</option>
                    <?php foreach ($tailleurs as $tailleur): ?>
                        <option value="<?= $tailleur['id'] ?>"><?= $tailleur['nomTailleur'] ?></option>
                    <?php endforeach ?>
                </select>
                <select name="filter_article" id="filter_article"
                    class="border border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md p-2">
                    <option value="">Sélectionner un article vente</option>
                    <?php foreach ($articles as $article): ?>
                        <option value="<?= $article['id'] ?>"><?= $article['libelle'] ?></option>
                    <?php endforeach ?>
                </select>
                <button id="filter_button"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                    Filtrer
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead class="bg-blue-200">
                        <tr>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Date
                            </th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Observation
                            </th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Nom
                                Tailleur
                            </th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Telephone
                            </th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($response['data'] as $production): ?>
                            <tr>
                                <td class="px-6 py-4 text-center"><?= $production['date']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $production['observation']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $production['nomTailleur']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $production['telTailleur']; ?></td>
                                <td class="text-center">
                                    <a href="<?= WEBROOT ?>/?controller=production&action=voir-detail&prodId=<?= $production['id']; ?>"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                                        Voir Details
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="flex justify-center mt-6">
                <?php for ($i = 0; $i < $response['pages']; $i++): ?>
                    <a href="<?= WEBROOT ?>/?controller=production&action=liste-production&page=<?= $i ?>"
                        class="mx-1 px-3 py-1 border border-gray-300 bg-white text-gray-600 rounded hover:bg-gray-200 <?= ($i == $currentPage) ? 'bg-gray-300' : '' ?>">
                        <?= $i + 1 ?>
                    </a>
                <?php endfor ?>
            </div>

        </div>
    </div>
    <script src="<?= WEBROOT ?>/js/article.js"></script>
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButton = document.getElementById('filter_button');

        filterButton.addEventListener('click', function () {
            const filterDate = document.getElementById('filter_date').value;
            const filterTailleur = document.getElementById('filter_tailleur').value;
            const filterArticle = document.getElementById('filter_article').value;

            let url = '<?= WEBROOT ?>/?controller=production&action=liste-production';

            if (filterDate) {
                url += `&filter_date=${filterDate}`;
            }
            if (filterTailleur) {
                url += `&filter_tailleur=${filterTailleur}`;
            }
            if (filterArticle) {
                url += `&filter_article=${filterArticle}`;
            }

            window.location.href = url;
        });
    });
</script>