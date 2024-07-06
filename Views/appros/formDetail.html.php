<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de l'approvisionnement</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-blue-200 to-purple-300 min-h-screen flex items-center justify-center">
    <form action="<?= WEBROOT ?>" method="post">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl mx-auto mt-4 mb-4">
            <h2 class="text-3xl font-bold mb-6 text-center text-purple-700">Détail de l'approvisionnement</h2>
            
            <div class="mb-4">
                <p><strong>Date:</strong> <?= $appro['date']; ?></p>
                <p><strong>Fournisseur:</strong> <?= $fournisseur['nomFournisseur']; ?></p>
            </div>
            
            <!-- Tableau des articles produits -->
            <div class="overflow-x-auto mb-6">
                <table class="min-w-full bg-white rounded-lg shadow">
                    <thead class="bg-purple-700 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">Article</th>
                            <th class="py-3 px-4 text-left">Quantité </th>
                            <th class="py-3 px-4 text-left">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($details as $detail): ?>
                            <tr class="border-b border-gray-200">
                                <td class="py-2 px-4"><?= $detail['article']; ?></td>
                                <td class="py-2 px-4"><?= $detail['qteAppro']; ?></td>
                                <td class="py-2 px-4"><?= $detail['montant']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Bouton de retour -->
            <div class="flex justify-end">
                <a href="<?= WEBROOT ?>/?controller=appro&action=liste-appro"
                    class="bg-purple-700 hover:bg-purple-900 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">Retour
                    à la liste des approvisionnements</a>
            </div>
        </div>
    </form>
</body>

</html>
