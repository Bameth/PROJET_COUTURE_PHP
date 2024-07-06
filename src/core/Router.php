<?php
namespace ab\Core;
use ab\controllers\Typecontrollers;
use ab\controllers\ArticleControllers;
use ab\controllers\SecuriteControllers;
use ab\controllers\CategorieControllers;
use ab\Api\TypeController as ApiTypeController;
use ab\controllers\ApprovisionnementControllers;
use ab\controllers\FournisseurControllers;
use ab\controllers\ProductionControllers;
use ab\controllers\VenteControllers;

class Router{
    public static function run(){
        if (isset($_REQUEST['controller'])) {
            if ($_REQUEST['controller']=='article') {
                $controller=new ArticleControllers();
            }elseif ($_REQUEST['controller']=='type') {
                $controller=new Typecontrollers();
            }elseif ($_REQUEST['controller']=='categorie') {
                $controller=new CategorieControllers();
            }elseif ($_REQUEST['controller']=='appro') {
                    $controller=new ApprovisionnementControllers();
            }elseif ($_REQUEST['controller']=='fournisseur') {
                    $controller=new FournisseurControllers();
            }elseif ($_REQUEST['controller']=='production') {
                    $controller=new ProductionControllers();
            }elseif ($_REQUEST['controller']=='vente') {
                    $controller=new VenteControllers();
            }elseif ($_REQUEST['controller']=='securite') {
                $controller=new SecuriteControllers();
            }elseif ($_REQUEST['controller']=='api-type') {
                $controller=new ApiTypeController();
            }
        }else {
            $controller=new SecuriteControllers();
        }
    }
}