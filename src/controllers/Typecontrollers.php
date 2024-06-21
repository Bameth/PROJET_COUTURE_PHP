<?php
namespace ab\controllers;
use ab\core\Controller;
use ab\Model\TypeModel;
use ab\core\Autorisation;
use ab\core\Validator;
use ab\core\Session;
class Typecontrollers extends Controller{
    private TypeModel $typeModel;
    public function __construct() {
        parent::__construct();
        if(!Autorisation::isConnect()){
            parent::redirectToRoute("controller=securite&action=show-form");
           }
        $this->typeModel=new TypeModel;
        $this->load();
    }
public function load(){
if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "liste-type") {
        $this->listerTypes();
    } elseif ($_REQUEST['action'] == "modif-type") {
        if (isset($_GET['id'])) {
            $typesId = intval($_GET['id']);
            $this->chargerFormulaireUpdateType($typesId);
        }
    } elseif ($_REQUEST['action'] == "save-type") {
        unset($_POST['action']);
        unset($_POST['btnsu']);
        unset($_POST['controller']);
        $this->storeType($_POST);
        parent::redirectToRoute("controller=type&action=liste-type");
        exit;
    } elseif ($_REQUEST['action'] == "update-type") {
        $this->updateType($_REQUEST);
        parent::redirectToRoute("controller=type&action=liste-type");
        exit;
    } elseif ($_REQUEST['action'] == "del-type") {
        if (isset($_GET['id'])) {
            $typesId = intval($_GET['id']);
            $this->typeModel->delete($typesId);
            parent::redirectToRoute("controller=type&action=liste-type");
            exit;
        }
    }
} else {
    $this->listerTypes();
}
}
function listerTypes(): void {
    $datas = $this->typeModel->findAll();
    $this->renderView("types/liste",[
        "types"=>$datas
    ]);
}

function chargerFormulaireUpdateType(int $typesId): void {
    $datas = $this->typeModel->findAll();
    $this->renderView("types/liste",[
        "types"=>$this->typeModel->findById($typesId)
    ]);
}

function storeType(array $type): void {
    // Vérification de la valeur obligatoire
    Validator::isEmpty($type["nomType"],"nomType"); 
    if (Validator::isValid()) {
        // Vérification de l'unicité du type
        $Type = $this->typeModel->findByNameType($type["nomType"]);
        if ($Type) {
            Validator::add("nomType","La valeur existe déjà");
            Session::add("errors",Validator::$errors);
        } else {
            $this->typeModel->save($type);
        }
    } else {
        Session::add("errors",Validator::$errors);
    }
    parent::redirectToRoute("controller=type&action=liste-type");
    exit;
}


function updateType(array $type): void {
    $this->typeModel->modifier($type);
    parent::redirectToRoute("controller=type&action=liste-type");
    exit;
}
}