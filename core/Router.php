<?php
class Router{
    public static function run(){
        if (isset($_REQUEST['controller'])) {
            if ($_REQUEST['controller']=='article') {
                require_once("../controllers/article.controllers.php");
                $controller=new ArticleControllers();
            }elseif ($_REQUEST['controller']=='type') {
                require_once("../controllers/type.controllers.php");
                $controller=new Typecontrollers();
            }elseif ($_REQUEST['controller']=='categorie') {
                require_once("../controllers/categorie.controllers.php");
                $controller=new CategorieControllers();
            }elseif ($_REQUEST['controller']=='securite') {
                require_once("../controllers/securite.controllers.php");
                $controller=new SecuriteControllers();
            }
        }else {
            require_once("../controllers/securite.controllers.php");
            $controller=new SecuriteControllers();
        }
    }
}