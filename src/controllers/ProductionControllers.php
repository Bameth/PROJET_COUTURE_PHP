<?php
namespace ab\controllers;

use ab\core\Controller;
use ab\Model\PanierProdModel;
use ab\core\Autorisation;
use ab\core\Validator;
use ab\core\Session;
use ab\Model\ArticleModel;
use ab\Model\DetailProduction;
use ab\Model\FournisseurModel;
use ab\Model\PanierModel;
use ab\Model\ProductionModel;
use ab\Model\TailleurModel;

class ProductionControllers extends Controller
{
    private TailleurModel $tailleurModel;
    private ProductionModel $prodModel;
    private ArticleModel $articleModel;
    private DetailProduction $detailModel;

    public function __construct()
    {
        parent::__construct();
        if (!Autorisation::isConnect()) {
            $this->redirectToRoute("controller=securite&action=show-form");
        }
        $this->articleModel = new ArticleModel();
        $this->tailleurModel = new TailleurModel();
        $this->prodModel = new ProductionModel();
        $this->detailModel = new DetailProduction();
        $this->load();
    }

    public function load()
    {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "liste-production") {
                $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 0;
                $filters = [
                    'filter_date' => $_GET['filter_date'] ?? null,
                    'filter_tailleur' => $_GET['filter_tailleur'] ?? null,
                    'filter_article' => $_GET['filter_article'] ?? null,
                ];
                $this->listerProd($page, $filters);
            } elseif ($_REQUEST['action'] == "form-prod") {
                $this->chargerFormulaire();
            } elseif ($_REQUEST['action'] == "save-prod") {
                $this->storeArticleInProd($_POST);
                exit;
            } elseif ($_REQUEST['action'] == "voir-detail") {
                $prodId = isset($_REQUEST['prodId']) ? intval($_REQUEST['prodId']) : 0;
                $this->voirDetail($prodId);
            } elseif ($_REQUEST['action'] == "add-prod") {
                $this->storeProd();
            } elseif ($_REQUEST['action'] == "clear-cart") {
                $this->clearCart();
            }
        } else {
            $this->listerProd();
        }
    }

    public function listerProd(int $page = 0, array $filters = []): void
    {
        $datas = $this->prodModel->findAllWithPaginate($page, 4, $filters);
        $this->renderView("productions/liste", [
            "response" => $datas,
            "currentPage" => $page,
            "tailleurs" => $this->tailleurModel->findAll(),
            "articles" => $this->articleModel->findArticlesByType('Article Vente'),
        ]);
    }
    public function clearCart(): void
    {
        Session::remove("production_panier");
        $this->redirectToRoute("controller=production&action=form-prod");
    }

    public function voirDetail(int $prodId): void
    {
        $prod = $this->prodModel->findById($prodId);
        $details = $this->prodModel->findDetailsByProdId($prodId);
        $tailleur = $this->tailleurModel->findById($prod['tailleurId']);
        foreach ($details as &$detail) {
            $article = $this->articleModel->findById($detail['articleId']);
            $detail['article'] = $article['libelle'];
        }
        $this->renderView("productions/formDetail", [
            "prod" => $prod,
            "details" => $details,
            "tailleur" => $tailleur
        ]);
    }

    public function chargerFormulaire(): void
    {
        $tailleurs = $this->tailleurModel->findAll();
        $articles = $this->articleModel->findArticlesByType('Article Vente');
        $this->renderView("productions/form", [
            "tailleurs" => $tailleurs,
            "articles" => $articles
        ]);
    }

    public function storeProd(): void
    {
        $panier = Session::get("production_panier");
        $this->prodModel->save($panier);
        Session::remove("production_panier");
        $this->redirectToRoute("controller=production&action=form-prod");
    }

    public function storeArticleInProd(array $data): void
    {
        if (!Validator::isValid()) {
            Session::add("errors", Validator::$errors);
            parent::redirectToRoute("controller=production&action=form-prod");
            exit;
        }
        if (!Session::get("production_panier")) {
            $panier = new PanierModel();
        } else {
            $panier = Session::get("production_panier");
        }
        $panier->addArticleDeux(
            $this->articleModel->findById($data["articleId"]),
            $data["tailleurId"],
            $data["qteProd"]
        );
        Session::add("production_panier", $panier);
        $this->redirectToRoute("controller=production&action=form-prod");
    }
}
