<?php
namespace ab\Views;
use ab\Core\Session;
$errors = [];
if (Session::get("errors")) {
    $errors = Session::get("errors");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .custom-shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }
        .error-box {
            border: 1px solid #e53e3e;
            background-color: white;
            color: #9b2c2c;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.375rem;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 flex items-center justify-center h-screen ">
    <div class="flex items-center justify-center h-screen w-full">
        <div class="w-full max-w-sm">
        <div class="error-box">
        <?= $errors["error_connection"]??"" ?>
        </div>
            <form method="POST" action="<?= WEBROOT ?>" class="bg-white custom-shadow rounded-lg px-8 pt-6 pb-8 mb-4">
                <h2 class="text-2xl font-bold text-center text-gray-700 mb-4">LOG IN</h2>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="login">Login</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A10.978 10.978 0 0112 21c2.74 0 5.244-1.016 7.121-2.696M15 10a3 3 0 110-6 3 3 0 010 6zm-6 3a6 6 0 0111.898 1H4.102A6 6 0 019 13z" />
                            </svg>
                        </span>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 pl-10 pr-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= \ab\Core\add_class_invalid("login") ?>"
                            id="login" type="text" name="login" placeholder="Adresse Mail">
                    </div>
                    <p class="text-red-500 text-xs italic"><?= $errors["login"] ?? "" ?></p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c-1.306 0-2.417.835-2.83 2H9a3 3 0 006 0h-.17A2.992 2.992 0 0012 11z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 1v4m0 4v4m0 4v4m-6 0h12" />
                            </svg>
                        </span>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 pl-10 pr-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline  <?= \ab\Core\add_class_invalid("password") ?> "
                            id="password" type="password" name="password" placeholder="********">
                    </div>
                    <p class="text-red-500 text-xs italic"><?= $errors["password"] ?? "" ?></p>
                </div>
                <div class="flex items-center justify-between">
                    <input type="hidden" name="controller" value="securite">
                    <input type="hidden" name="action" value="connexion">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out transform hover:scale-105"
                        type="submit">
                        Sign In
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                        Forgot Password?
                    </a>
                </div>
            </form>

            <p class="text-center text-white text-xs">
                &copy;2024 Acme Corp. All rights reserved.
            </p>
        </div>
    </div>
</body>

</html>
<?php
Session::remove("errors");
?>