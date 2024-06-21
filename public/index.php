<?php
namespace ab\public;
use ab\core\Router;
require_once "./../vendor/autoload.php";
    require_once("../src/core/tailwind.php");
        Router::run ();
?>

<?php

// require_once("../controllers/article.controllers.php");
// $controller=new ArticleControllers();
// require_once("../controllers/type.controllers.php");
// $controller=new Typecontrollers();
// require_once("../controllers/categorie.controllers.php");
// <?php echo ($_GET['action'] == 'liste-article') ? 'active-link' : ''; ?>
