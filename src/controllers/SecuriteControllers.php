<?php
namespace ab\controllers;
use ab\core\Controller;
use ab\Model\UserModel;
use ab\core\Validator;
use ab\core\Session;
class SecuriteControllers extends Controller{
    private userModel $userModel;
    public function __construct() {
        parent::__construct();
        $this->userModel=new userModel;
        $this->layout="connexion";
        $this->load();
    }
    public function load(){
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "connexion") {
                unset($_POST['action']);
                unset($_POST['controller']);
                $this->connexion($_POST);
            }elseif ($_REQUEST['action'] == "show-form") {
                $this->showForm();
            }elseif ($_REQUEST['action'] == "logout") {
                $this->logout();
            }
        }else {
            $this->showForm();
        }
    }
    private function logout():void{
        Session::fermerSession();
        parent::redirectToRoute("controller=securite&action=show-form");
    }
    private function showForm():void{
        $this->renderView("security/form");
    }
    private function connexion(array $data):void{
        if(!Validator::isEmpty($data["login"], "login")){
            Validator::isEmail($data["login"], "login");
        }
        Validator::isEmpty($data["password"], "password");
        if (Validator::isValid()) {
            $userConnect = $this->userModel->findByLoginAndPassword($data["login"], $data["password"]);
            if ($userConnect) {
                Session::add("userConnect", $userConnect);
                parent::redirectToRoute("controller=article&action=liste-article&page=0");
            } else {
                Validator::add("error_connection", "Utilisateur introuvable");
                Session::add("errors", Validator::$errors);
            }
        } else {
            Session::add("errors", Validator::$errors);
        }
        parent::redirectToRoute("controller=securite&action=show-form");
    }
    
}
