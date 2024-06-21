<?php
namespace ab\Api;
use ab\core\Session;
use ab\core\Validator;
use ab\core\Controller;
use ab\Model\TypeModel;
use ab\core\Autorisation;

class TypeController extends Controller{
    private TypeModel $typeModel;
    public function __construct() {
        parent::__construct();
       if(!Autorisation::isConnect()){
        parent::redirectToRoute("controller=api-type&action=show-form");
       }
        $this->typeModel=new TypeModel();
        $this->load();
    }
    public function load(){
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "api-liste-type") {
                $this->listerTypes();
            } elseif ($_REQUEST['action'] == "api-modif-type") {
                if (isset($_GET['id'])) {
                    $typesId = intval($_GET['id']);
                    $this->chargerFormulaireUpdateType($typesId);
                }
            } elseif ($_REQUEST['action'] == "api-save-type") {
                $this->storeType($_POST);
                exit;
            } elseif ($_REQUEST['action'] == "api-update-type") {
                $this->updateType($_REQUEST);
                exit;
            } elseif ($_REQUEST['action'] == "api-del-type") {
                if (isset($_GET['id'])) {
                    $typesId = intval($_GET['id']);
                    $this->typeModel->delete($typesId);
                    exit;
                }
            }
        } else {
            $this->listerTypes();
        }
        }
        function listerTypes(): void {
            $datas = $this->typeModel->findAll();
            $this->renderJson($datas);
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
