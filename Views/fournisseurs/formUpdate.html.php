<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Article</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto py-6 px-8 sm:px-10 lg:px-12">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Modifier Article</h1>
            <form action="<?= WEBROOT ?>/?controller=fournisseur&action=modif-fournisseur" method="post">
                <input type="hidden" name="id" value="<?= $fournisseur['id'] ?>">
                <div class="mb-4">
                    <label for="nomFournisseur" class="block text-gray-700 font-bold mb-2">Nom Fournisseur</label>
                    <input type="text" id="nomFournisseur" name="nomFournisseur" value="<?= $fournisseur['nomFournisseur'] ?>"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['nomFournisseur']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['nomFournisseur'] ?? "" ?>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="adresse" class="block text-gray-700 font-bold mb-2">Adresse</label>
                    <input type="text" id="adresse" name="adresse" value="<?= $fournisseur['adresse'] ?>"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['adresse']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['adresse'] ?? "" ?>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="telFournisseur" class="block text-gray-700 font-bold mb-2">Telephone Fournisseur</label>
                    <input type="text" id="telFournisseur" name="telFournisseur" value="<?= $fournisseur['telFournisseur'] ?>"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['telFournisseur']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['telFournisseur'] ?? "" ?>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <input type="hidden" name="action" value="modif-fournisseur">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        name="btnmodif" value="btnmodif">modifier</button>
                    <button type="button"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        name="action" value="btnca">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>