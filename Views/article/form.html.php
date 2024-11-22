<?php

namespace ab\Views;

use ab\Core\Session;

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .is-invalid {
            border-color: #e3342f;
        }

        .invalid-feedback {
            color: #e3342f;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-lg mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Ajouter un Article</h1>
            <form action="<?= WEBROOT ?>/?controller=article&action=save-article" method="post" enctype="multipart/form-data">
                <?php
                $errors = Session::get('errors') ?? [];
                $old = $old ?? [];
                ?>
                <div class="mb-4">
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="form-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="libelle" class="block text-gray-700 text-sm font-bold mb-2">Libellé</label>
                    <input type="text" id="libelle" name="libelle" placeholder="Entrez le libellé"
                        value="<?= htmlspecialchars($old['libelle'] ?? '') ?>"
                        class="form-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['libelle']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['libelle'] ?? "" ?>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="qteStock" class="block text-gray-700 text-sm font-bold mb-2">Quantité en Stock</label>
                    <input type="text" id="qteStock" name="qteStock" placeholder="Entrez la quantité en stock"
                        value="<?= htmlspecialchars($old['qteStock'] ?? '') ?>"
                        class="form-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['qteStock']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['qteStock'] ?? "" ?>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="prix" class="block text-gray-700 text-sm font-bold mb-2">Prix</label>
                    <input type="text" step="0.01" id="prix" name="prixAppro" placeholder="Entrez le prix"
                        value="<?= htmlspecialchars($old['prixAppro'] ?? '') ?>"
                        class="form-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['prixAppro']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['prixAppro'] ?? "" ?>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="categorie" class="block text-gray-700 text-sm font-bold mb-2">Catégorie</label>
                    <select id="categorie" name="categorie"
                        class="form-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['categorie']) ? 'is-invalid' : '' ?>">
                        <option disabled selected>Sélectionner une catégorie</option>
                        <?php foreach ($categories as $categorie): ?>
                            <option value="<?= $categorie['id']; ?>" <?= (isset($old['categorie']) && $old['categorie'] == $categorie['id']) ? 'selected' : '' ?>><?= $categorie['nomCategorie']; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $errors['categorie'] ?? "" ?>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                    <select id="type" name="type"
                        class="form-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['type']) ? 'is-invalid' : '' ?>">
                        <option disabled selected>Sélectionner un type</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type['id']; ?>" <?= (isset($old['type']) && $old['type'] == $type['id']) ? 'selected' : '' ?>><?= $type['nomType']; ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $errors['type'] ?? "" ?>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <input type="hidden" name="action" value="save-article">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        name="btnsa" value="btnsa">Enregistrer</button>
                    <button type="button"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        name="action" value="btnca">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>