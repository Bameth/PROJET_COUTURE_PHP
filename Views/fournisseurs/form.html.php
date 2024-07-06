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
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Ajouter un Fournisseur</h1>
            <form action="<?= WEBROOT ?>/?controller=fournisseur&action=save-four" method="post">
                <?php $errors = Session::get('errors') ?? []; ?>
                <div class="mb-4">
                    <label for="nomFournisseur" class="block text-gray-700 text-sm font-bold mb-2">Nom Fournisseur</label>
                    <input type="text" id="nomFournisseur" name="nomFournisseur" placeholder="Entrez le nom du Fournisseur" class="form-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['nomFournisseur']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['nomFournisseur'] ?? "" ?>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="adresse" class="block text-gray-700 text-sm font-bold mb-2">Adresse</label>
                    <input type="text" id="adresse" name="adresse" placeholder="Entrez l'adresse" class="form-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['adresse']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['adresse'] ?? "" ?>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="telFournisseur" class="block text-gray-700 text-sm font-bold mb-2">Telephone Fournisseur</label>
                    <input type="text" step="0.01" id="telFournisseur" name="telFournisseur" placeholder="Entrez le telephone du Fournisseur" class="form-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['telFournisseur']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['telFournisseur'] ?? "" ?>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <input type="hidden" name="action" value="save-four">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="btnsa" value="btnsa">Enregistrer</button>
                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="action" value="btnca">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
