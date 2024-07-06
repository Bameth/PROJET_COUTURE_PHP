<?php
namespace ab\controllers;

use ab\core\Controller;
use ab\Model\FournisseurModel;
use ab\core\Autorisation;
use ab\core\Validator;
use ab\core\Session;

class FournisseurControllers extends Controller
{
    private FournisseurModel $fournisseurModel;
    public function __construct()
    {
        parent::__construct();
        if (!Autorisation::isConnect()) {
            parent::redirectToRoute("controller=securite&action=show-form");
        }
        $this->fournisseurModel = new FournisseurModel();
        $this->load();
    }
    public function load()
    {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "liste-fournisseur") {
                $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 0;
                $this->listerFournisseur($page);
            } elseif ($_REQUEST['action'] == "form-fournisseur") {
                $this->chargerFormulaire();
            } elseif ($_REQUEST['action'] == "modif-fournisseur") {
                if (isset($_GET['id'])) {
                    $fourId = intval($_GET['id']);
                    $this->chargerFormulaireUpdate($fourId);
                } else {
                    unset($_REQUEST['action']);
                    unset($_REQUEST['btnmodif']);
                    $this->update($_REQUEST);
                    $this->redirectToRoute("controller=fournisseur&action=liste-fournisseur");
                    exit;
                }
            } elseif ($_REQUEST['action'] == "save-four") {
                unset($_POST['action']);
                unset($_POST['btnsa']);
                unset($_POST['controller']);
                $this->storeFournisseur($_POST);
                $this->redirectToRoute("controller=fournisseur&action=liste-fournisseur");
                exit;
            } elseif ($_REQUEST['action'] == "del-four") {
                if (isset($_GET['id'])) {
                    $articleId = intval($_GET['id']);
                    $this->fournisseurModel->delete($articleId);
                    $this->redirectToRoute("controller=fournisseur&action=liste-fournisseur");
                    exit;
                }
            }
        } else {
            $this->listerFournisseur();
        }

    }
    public function listerFournisseur(int $page = 0): void
    {
        $datas = $this->fournisseurModel->findAllWithPaginate($page, 2);
        $this->renderView("fournisseurs/liste", [
            "response" => $datas,
            "currentPage" => $page
        ]);
    }

    public function chargerFormulaire(): void
    {
        $this->renderView("fournisseurs/form", [
            "fournisseur" => $this->fournisseurModel->findAll(),
        ]);

    }

    public function chargerFormulaireUpdate(int $fournisseurId): void
    {
        $this->renderView("fournisseurs/formUpdate", [
            "fournisseur" => $this->fournisseurModel->findById($fournisseurId)
        ]);
    }

    public function storeFournisseur(array $fournisseur): void
    {
        Validator::$errors = [];
        Validator::isEmpty($fournisseur['nomFournisseur'] ?? '', 'nomFournisseur', 'Le nom du Fournisseur est obligatoire.');
        Validator::isEmpty($fournisseur['adresse'] ?? '', 'adresse', "L'adresse'est obligatoire.");
        Validator::isEmpty($fournisseur['telFournisseur'] ?? '', 'telFournisseur', 'Le telephone du fournisseur est obligatoire.');
        if (!Validator::isValid()) {
            Session::add("errors", Validator::$errors);
            parent::redirectToRoute("controller=fournisseur&action=form-fournisseur");
            exit;
        }
        $fourExist = $this->fournisseurModel->findByNameType($fournisseur['nomFournisseur']);
        if ($fourExist) {
            Validator::add('nomFournisseur', 'Le nom du Fournisseur existe déjà.');
            Session::add("errors", Validator::$errors);
            parent::redirectToRoute("controller=fournisseur&action=form-fournisseur");
            exit;
        }
        $this->fournisseurModel->save(['nomFournisseur' => $fournisseur['nomFournisseur'], 'adresse' => $fournisseur['adresse'], 'telFournisseur' => $fournisseur['telFournisseur']]);
        parent::redirectToRoute("controller=fournisseur&action=liste-fournisseur");
        exit;
    }


    public function update(array $fournisseur): void
    {
        Validator::$errors = [];
        Validator::isEmpty($fournisseur['nomFournisseur'] ?? '', 'nomFournisseur', 'Le nom du Fournisseur est obligatoire.');
        Validator::isEmpty($fournisseur['adresse'] ?? '', 'adresse', "L'adresse'est obligatoire.");
        Validator::isEmpty($fournisseur['telFournisseur'] ?? '', 'telFournisseur', 'Le telephone du fournisseur est obligatoire.');
        if (!Validator::isValid()) {
            Session::add("errors", Validator::$errors);
            $this->redirectToRoute("controller=fournisseur&action=modif-fournisseur");
            exit;
        }
        $this->fournisseurModel->modifier($fournisseur);
        $this->redirectToRoute("controller=fournisseur&action=liste-fournisseur");
    }


}