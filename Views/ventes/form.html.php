<?php
namespace ab\Views;

use ab\Core\Session;

use function ab\core\dd;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'approvisionnement</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-blue-200 to-purple-300 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl mx-auto mt-4 mb-4">
        <h2 class="text-3xl font-bold mb-6 text-center text-purple-700">Ajouter une Vente</h2>
        <form action="<?= WEBROOT ?>" method="post">
            <?php $errors = Session::get('errors') ?? []; ?>
            <div class="mb-4">
                <label for="tailleurId" class="block text-gray-700 font-bold mb-2">Client:</label>
                <div class="relative">
                    <select id="clientId" name="clientId" class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <option value="">Sélectionnez un Client</option>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?= $client['id']; ?>"><?= $client['nomClient']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
            <!-- Autres champs -->
            <div class="flex flex-wrap -mx-4 mb-4">
                <div class="w-full md:w-1/2 px-4 mb-4 md:mb-0">
                    <label for="articleId" class="block text-gray-700 font-bold mb-2">Article:</label>
                    <div class="relative">
                        <select id="articleId" name="articleId" class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600">
                            <option value="">Sélectionnez un article</option>
                            <?php foreach ($articles as $article): ?>
                                <option value="<?= $article['id']; ?>"><?= $article['libelle']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-4">
                    <label for="qteVente" class="block text-gray-700 font-bold mb-2">Quantité:</label>
                    <div class="relative">
                        <input type="text" id="qteVente" name="qteVente" class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600" placeholder="Quantité">
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end">
                <input type="hidden" name="action" value="save-vente">
                <input type="hidden" name="controller" value="vente">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="btnsa" value="btnsa">Ajouter</button>
            </div>
        </form>
        <!-- Tableau du panier -->
        <div id="cart" class="mt-8">
            <?php
            if (Session::get("panier") != false): ?>
                <h3 class="text-2xl font-bold mb-4 text-purple-700 text-center">Panier</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow">
                        <thead class="bg-purple-700 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left">Article</th>
                                <th class="py-3 px-4 text-left">Quantité</th>
                                <th class="py-3 px-4 text-left">Prix Unitaire</th>
                                <th class="py-3 px-4 text-left">Montant</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <?php foreach (Session::get("panier")->articles as $article): ?>
                                <tr class="border-b border-gray-200">
                                    <td class="py-2 px-4"><?= $article['libelle']; ?></td>
                                    <td class="py-2 px-4"><?= $article['qteVente']; ?></td>
                                    <td class="py-2 px-4"><?= $article['prixAppro']; ?></td>
                                    <td class="py-2 px-4"><?= $article['montantArticle']; ?></td>
                                </tr>
                            <?php endforeach;
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="mt-4 text-right">
                    <span class="font-bold text-xl">Montant Total: </span>
                    <span id="total-amount" class="font-bold text-xl text-purple-700"><?php if (Session::get("panier") != false)
                        echo Session::get("panier")->total;
                    else
                        echo "0"; ?></span>
                    CFA
                </div>
            </div>
            <!-- Boutons Enregistrer et Annuler -->
            <div class="mt-8 flex justify-center space-x-4">
                <a href="<?= WEBROOT ?>/?controller=vente&action=add-vente" id="add-vente"
                    class="bg-green-500 text-white font-bold py-3 px-8 rounded-full hover:bg-green-700 transition duration-300">
                    Enregistrer
                </a>
                <button type="button" id="cancel-cart"
                    class="bg-red-500 text-white font-bold py-3 px-8 rounded-full hover:bg-red-700 transition duration-300"
                    name="btncancel" value="btncancel" onclick="window.location.href='<?= WEBROOT ?>'">
                    Annuler
                </button>
                <?php
            endif; ?>
        </div>
    </div>
</body>

</html>