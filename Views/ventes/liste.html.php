<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau Magnifique</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes backgroundAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        body {
            background: linear-gradient(270deg, #ff9a9e, #fad0c4, #fad0c4);
            background-size: 600% 600%;
            animation: backgroundAnimation 10s ease infinite;
        }

        tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <div class="max-w-7xl mx-auto py-6 px-8 sm:px-10 lg:px-12">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold text-gray-800">Liste des Ventes</h1>
                <a href="<?= WEBROOT ?>/?controller=vente&action=form-vente"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                    Nouveau
                </a>
            </div>
            <!-- Filtres -->
            <div class="flex items-center space-x-4 mb-4">
                <input type="date" name="filter_date" id="filter_date"
                    class="border border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md p-2"
                    placeholder="aaaa-mm-jj">
                <select name="filter_client" id="filter_client"
                    class="border border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md p-2">
                    <option value="">Sélectionner un Client</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?= $client['id'] ?>"><?= $client['nomClient'] ?></option>
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
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Montant
                            </th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Nom
                                Client
                            </th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Telephone
                            </th>
                            <th class="px-6 py-3 text-center text-sm text-gray-600 uppercase tracking-wider">Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($response['data'] as $vente): ?>
                            <tr>
                                <td class="px-6 py-4 text-center"><?= $vente['date']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $vente['montant']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $vente['nomClient']; ?></td>
                                <td class="px-6 py-4 text-center"><?= $vente['telClient']; ?></td>
                                <td class="text-center">
                                    <a href="<?= WEBROOT ?>/?controller=vente&action=voir-detail&venteId=<?= $vente['id']; ?>"
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
                    <a href="<?= WEBROOT ?>/?controller=vente&action=liste-vente&page=<?= $i ?>"
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
            const filterClient = document.getElementById('filter_client').value;
            const filterArticle = document.getElementById('filter_article').value;

            let url = '<?= WEBROOT ?>/?controller=vente&action=liste-vente';

            if (filterDate) {
                url += `&filter_date=${encodeURIComponent(filterDate)}`;
            }
            if (filterClient) {
                url += `&filter_client=${encodeURIComponent(filterClient)}`;
            }
            if (filterArticle) {
                url += `&filter_article=${encodeURIComponent(filterArticle)}`;
            }

            window.location.href = url;
        });
    });
</script>
