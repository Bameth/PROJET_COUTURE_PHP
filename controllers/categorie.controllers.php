<?php
require_once("../model/categorie.model.php");
require_once("../core/Controller.php");
require_once("../core/Validator.php");

class CategorieControllers extends Controller{
    private CategorieModel $categorieModel;
    public function __construct() {
        parent::__construct();
       if(!Autorisation::isConnect()){
        parent::redirectToRoute("controller=securite&action=show-form");
       }
        $this->categorieModel=new CategorieModel;
        $this->load();
    }
    
public function load(){
if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "liste-categorie") {
        $this->listerCategorie();
    } elseif ($_REQUEST['action'] == "modif-categorie") {
        if (isset($_GET['id'])) {
            $categoriesId = intval($_GET['id']);
            $this->chargerFormulaireUpdateCategorie($categoriesId); 
        }
    } elseif ($_REQUEST['action'] == "save-categorie") {
        unset($_POST['action']);
        unset($_POST['btna']);
        unset($_POST['controller']);
        $this->storeCategorie($_POST);
        parent::redirectToRoute("controller=categorie&action=liste-categorie");
        exit;
    } elseif ($_REQUEST['action'] == "update-categorie") {
        $this->updateCategorie($_REQUEST);
        parent::redirectToRoute("controller=categorie&action=liste-categorie");
        exit;
    } elseif ($_REQUEST['action'] == "del-categorie") {
        if (isset($_GET['id'])) {
            $categoriesId = intval($_GET['id']);
            $this->categorieModel->delete($categoriesId);
            parent::redirectToRoute("controller=categorie&action=liste-categorie");
            exit;
        }
    }
} else {
    $this->listerCategorie();
}
}
function listerCategorie(): void {
    $datas = $this->categorieModel->findAll();
    $this->renderView("categories/liste",[
        "categories"=>$datas
    ]);
}

function chargerFormulaireUpdateCategorie(int $categoriesId): void {
    $datas = $this->categorieModel->findAll();
    $this->renderView("categories/liste",[
        "categories"=>$this->categorieModel->findById($categoriesId)
    ]);
}

function storeCategorie(array $categorie): void {
    Validator::isEmpty($categorie["nomCategorie"],"nomCategorie");
    if (Validator::isValid()) {
        $Category = $this->categorieModel->findByNameCategorie($categorie["nomCategorie"]);
        if ($Category) {
            Validator::add("nomCategorie","La valeur existe déjà");
            Session::add("errors",Validator::$errors);
        } else {
            $this->categorieModel->save($categorie);
        }
    } else {
        Session::add("errors",Validator::$errors);
    }
    parent::redirectToRoute("controller=categorie&action=liste-categorie");
    exit;
}
public function updateCategorie(array $categorie): void {
    Validator::isEmpty($categorie["nomCategorie"],"nomCategorie");
    
    if (Validator::isValid()) {
        $this->categorieModel->modifier($categorie);
    } else {
        Session::add("errors",Validator::$errors);
    }
    
    parent::redirectToRoute("controller=categorie&action=liste-categorie");
    exit;
}
}
