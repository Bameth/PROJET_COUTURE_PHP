<?php
namespace ab\controllers;

use ab\core\Controller;
use ab\Model\PanierModel;
use ab\core\Autorisation;
use ab\core\Validator;
use ab\core\Session;
use ab\Model\ApproModel;
use ab\Model\ArticleModel;
use ab\Model\FournisseurModel;

use function ab\core\dd;

class ApprovisionnementControllers extends Controller
{
    private FournisseurModel $fournisseurModel;
    private ApproModel $approModel;
    private ArticleModel $articleModel;

    public function __construct()
    {
        parent::__construct();
        if (!Autorisation::isConnect()) {
            parent::redirectToRoute("controller=securite&action=show-form");
        }
        $this->articleModel = new ArticleModel();
        $this->fournisseurModel = new FournisseurModel;
        $this->approModel = new ApproModel();
        $this->load();
    }

    public function load()
    {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "liste-appro") {
                $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 0;
                $this->listerAppro($page);
            } elseif ($_REQUEST['action'] == "form-appro") {
                $this->chargerFormulaire();
            } elseif ($_REQUEST['action'] == "voir-detail") {
                $approId = isset($_REQUEST['approId']) ? intval($_REQUEST['approId']) : 0;
                $this->voirDetail($approId);
            } elseif ($_REQUEST['action'] == "save-appro") {
                $this->storeArticleInAppro($_POST);
                exit;
            } elseif ($_REQUEST['action'] == "add-app") {
                $this->storeAppro();
            }
        } else {
            $this->listerAppro();
        }
    }

    public function listerAppro(int $page = 0): void
    {
        $datas = $this->approModel->findAllWithPaginate($page, 4);
        $this->renderView("appros/liste", [
            "response" => $datas,
            "currentPage" => $page
        ]);
    }

    public function chargerFormulaire(): void {
        $fournisseurs = $this->fournisseurModel->findAll();
        $articles = $this->articleModel->findArticlesByType("Article confection");
        $this->renderView("appros/form", [
            "fournisseurs" => $fournisseurs,
            "articles" => $articles
        ]);
    }

    public function voirDetail(int $approId): void
{
    $appro = $this->approModel->findById($approId);
    $details = $this->approModel->findDetailsByApproId($approId);
    $fournisseur = $this->fournisseurModel->findById($appro['fournisseurId']);
    foreach ($details as &$detail) {
        $article = $this->articleModel->findById($detail['articleId']);
        $detail['article'] = $article['libelle'];
    }
    $this->renderView("appros/formDetail", [
        "appro" => $appro,
        "details" => $details,
        "fournisseur" => $fournisseur
    ]);
}

    
    public function chargerFormulaireUpdate(int $articleId): void
    {
        $this->renderView("article/formUpdate", [
            "article" => $this->fournisseurModel->findById($articleId)
        ]);
    }

    public function storeAppro(): void
    {
        $panier = Session::get("panier");
        $this->approModel->save($panier);
        // $panier->clear();
        Session::remove("panier");
        $this->redirectToRoute("controller=appro&action=form-appro");
    }

    public function storeArticleInAppro(array $data): void
    {
        if (Session::get("panier") == false) {
            $panier = new PanierModel();
        } else {
            $panier = Session::get("panier");
        }
        $panier->addArticle(
            $this->articleModel->findById($data["articleId"]),
            $data["fournisseurId"],
            $data["qteAppro"]
        );
        Session::add("panier", $panier);
        $this->redirectToRoute("controller=appro&action=form-appro");
    }

    public function update(array $article): void
    {
        Validator::$errors = [];
        Validator::isEmpty($article['libelle'] ?? '', 'libelle', 'Le libellé est obligatoire.');
        Validator::isEmpty($article['qteStock'] ?? '', 'qteStock', 'La quantité en stock est obligatoire.');
        Validator::isNumeric($article['qteStock'] ?? '', 'qteStock', 'La quantité en stock doit etre un numeric.');
        Validator::isEmpty($article['prixAppro'] ?? '', 'prixAppro', 'Le prix est obligatoire.');
        Validator::isNumeric($article['prixAppro'] ?? '', 'prixAppro', 'le prix doit etre un numeric.');
        Validator::isEmpty($article['categorieId'] ?? '', 'categorieId', 'La catégorie est obligatoire.');
        Validator::isEmpty($article['typeId'] ?? '', 'typeId', 'Le type est obligatoire.');
        if (!Validator::isValid()) {
            Session::add("errors", Validator::$errors);
            $this->redirectToRoute("controller=article&action=modif-art");
            exit;
        }
        $this->fournisseurModel->modifier($article);
        $this->redirectToRoute("controller=article&action=liste-article");
    }
}

