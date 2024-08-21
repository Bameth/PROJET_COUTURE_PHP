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
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        .input-icon {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 0.375rem;
            padding: 0.5rem;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 flex items-center justify-center h-screen">
    <div id="particles-js"></div>
    <div class="w-full max-w-lg px-8 py-10 bg-white rounded-lg shadow-lg relative z-10 form-container">
        <?php if (!empty($errors)): ?>
            <div class="error-box mb-4">
                <?= $errors["error_connection"] ?? "" ?>
            </div>
        <?php endif; ?>
        <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Welcome Back!</h2>
        <form method="POST" action="<?= WEBROOT ?>" class="space-y-6">
            <div>
                <label class="block text-gray-700 text-lg font-semibold mb-2" for="login">Login</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 input-icon">
                        <svg class="h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.978 10.978 0 0112 21c2.74 0 5.244-1.016 7.121-2.696M15 10a3 3 0 110-6 3 3 0 010 6zm-6 3a6 6 0 0111.898 1H4.102A6 6 0 019 13z" />
                        </svg>
                    </span>
                    <input
                        class="shadow appearance-none border rounded-lg w-full py-3 pl-12 pr-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= \ab\Core\add_class_invalid("login") ?>"
                        id="login" type="text" name="login" placeholder="Adresse Mail">
                </div>
                <p class="text-red-500 text-xs italic"><?= $errors["login"] ?? "" ?></p>
            </div>
            <div>
                <label class="block text-gray-700 text-lg font-semibold mb-2" for="password">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 input-icon">
                        <svg class="h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c-1.306 0-2.417.835-2.83 2H9a3 3 0 006 0h-.17A2.992 2.992 0 0012 11z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 1v4m0 4v4m0 4v4m-6 0h12" />
                        </svg>
                    </span>
                    <input
                        class="shadow appearance-none border rounded-lg w-full py-3 pl-12 pr-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= \ab\Core\add_class_invalid("password") ?>"
                        id="password" type="password" name="password" placeholder="********">
                </div>
                <p class="text-red-500 text-xs italic"><?= $errors["password"] ?? "" ?></p>
            </div>
            <div class="flex items-center justify-between">
                <input type="hidden" name="controller" value="securite">
                <input type="hidden" name="action" value="connexion">
                <button
                    class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out transform hover:scale-105"
                    type="submit">
                    Sign In
                </button>
                <a class="inline-block text-blue-500 hover:text-blue-700 text-sm font-semibold" href="#">
                    Forgot Password?
                </a>
            </div>
        </form>
        <p class="text-center text-gray-600 text-xs mt-4">
            &copy;2024 Acme Corp. All rights reserved.
        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        particlesJS.load('particles-js', 'particles.json', function() {
            console.log('particles.json loaded...');
        });
    </script>
</body>
</html>
<?php
Session::remove("errors");
?>
