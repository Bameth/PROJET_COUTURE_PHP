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
            <form action="<?= WEBROOT ?>/?controller=article&action=modif-art" method="post">
                <input type="hidden" name="articleId" value="<?= $article['id'] ?>">

                <div class="mb-4">
                    <label for="libelle" class="block text-gray-700 font-bold mb-2">Libellé:</label>
                    <input type="text" id="libelle" name="libelle" value="<?= $article['libelle'] ?>"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['libelle']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['libelle'] ?? "" ?>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="prixAppro" class="block text-gray-700 font-bold mb-2">Prix:</label>
                    <input type="number" id="prixAppro" name="prixAppro" value="<?= $article['prixAppro'] ?>"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['prixAppro']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['prixAppro'] ?? "" ?>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="qteStock" class="block text-gray-700 font-bold mb-2">Quantité en Stock:</label>
                    <input type="number" id="qteStock" name="qteStock" value="<?= $article['qteStock'] ?>"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['qteStock']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errors['qteStock'] ?? "" ?>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="categorieId" class="block text-gray-700 font-bold mb-2">Catégorie:</label>
                    <select id="categorieId" name="categorieId"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['categorie']) ? 'is-invalid' : '' ?>">
                        <?php foreach ($categories as $categorie): ?>
                            <option value="<?= $categorie['id']; ?>" <?= $categorie['id'] == $article['categorieId'] ? 'selected' : '' ?>>
                                <?= $categorie['nomCategorie']; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $errors['categorie'] ?? "" ?>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="typeId" class="block text-gray-700 font-bold mb-2">Type:</label>
                    <select id="typeId" name="typeId"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors['type']) ? 'is-invalid' : '' ?>">
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type['id']; ?>" <?= $type['id'] == $article['typeId'] ? 'selected' : '' ?>>
                                <?= $type['nomType']; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $errors['type'] ?? "" ?>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <input type="hidden" name="action" value="modif-art">
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