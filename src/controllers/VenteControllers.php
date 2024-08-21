<?php
namespace ab\controllers;

use ab\core\Controller;
use ab\Model\PanierProdModel;
use ab\core\Autorisation;
use ab\core\Validator;
use ab\core\Session;
use ab\Model\ArticleModel;
use ab\Model\DetailModel;
use ab\Model\FournisseurModel;
use ab\Model\PanierModel;
use ab\Model\VenteModel;
use ab\Model\ClientModel;
use ab\Model\PanierVenteModel;

class VenteControllers extends Controller
{
    private VenteModel $venteModel;
    private DetailModel $detailModel;
    private ClientModel $clientModel;
    private ArticleModel $articleModel;

    public function __construct()
    {
        parent::__construct();
        if (!Autorisation::isConnect()) {
            $this->redirectToRoute("controller=securite&action=show-form");
        }
        $this->articleModel = new ArticleModel();
        $this->venteModel = new VenteModel();
        $this->clientModel = new ClientModel();
        $this->detailModel = new DetailModel();
        $this->load();
    }

    public function load()
    {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "liste-vente") {
                $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 0;
            $filters = [
                'filter_date' => $_GET['filter_date'] ?? null,
                'filter_client' => $_GET['filter_client'] ?? null,
                'filter_article' => $_GET['filter_article'] ?? null,
            ];
            $this->listerProd($page, $filters);
            } elseif ($_REQUEST['action'] == "form-vente") {
                $this->chargerFormulaire();
            } elseif ($_REQUEST['action'] == "voir-detail") {
                $venteId = isset($_REQUEST['venteId']) ? intval($_REQUEST['venteId']) : 0;
                $this->voirDetail($venteId);
            } elseif ($_REQUEST['action'] == "save-vente") {
                $this->storeArticleInVente($_POST);
                exit;
            } elseif ($_REQUEST['action'] == "add-vente") {
                $this->storeProd();
            }elseif ($_REQUEST['action'] == "clear-cart") {
                $this->clearCart();
            }
        } else {
            $this->listerProd();
        }
    }
    public function clearCart(): void
    {
        Session::remove("sales_panier");
        $this->redirectToRoute("controller=vente&action=form-vente");
    }

    public function listerProd(int $page = 0, array $filters = []): void
    {
        $datas = $this->venteModel->findAllWithPaginate($page, 4, $filters);
        $this->renderView("ventes/liste", [
            "response" => $datas,
            "currentPage" => $page,
            "clients" => $this->clientModel->findAll(),
            "articles" => $this->articleModel->findArticlesByType('Article Vente'),
        ]);
    }

    public function chargerFormulaire(): void
    {
        $clients = $this->clientModel->findAll();
        $articles = $this->articleModel->findArticlesByType('Article Vente');
        $this->renderView("ventes/form", [
            "clients" => $clients,
            "articles" => $articles
        ]);
    }

    public function voirDetail(int $venteId): void
{
    $vente = $this->venteModel->findById($venteId);
    $details = $this->venteModel->findDetailsByVenteId($venteId);
    $client = $this->clientModel->findById($vente['clientId']);
    foreach ($details as &$detail) {
        $article = $this->articleModel->findById($detail['articleId']);
        $detail['article'] = $article['libelle'];
    }
    $this->renderView("ventes/formDetail", [
        "vente" => $vente,
        "details" => $details,
        "client" => $client
    ]);
}

    public function storeProd(): void
    {
        $panier = Session::get("sales_panier");
        $this->venteModel->save($panier);
        Session::remove("sales_panier");
        $this->redirectToRoute("controller=vente&action=form-vente");
    }

    public function storeArticleInVente(array $data): void
{
    Validator::isEmpty($data['clientId'], 'clientId', 'Le client est obligatoire');
    Validator::isEmpty($data['articleId'], 'articleId', 'L\'article est obligatoire');
    Validator::isEmpty($data['qteVente'], 'qteVente', 'La quantité est obligatoire');
    Validator::isNumeric($data['qteVente'], 'qteVente', 'La quantité doit être un nombre');
    
    if (!Validator::isValid()) {
        Session::add('errors', Validator::$errors);
        $this->redirectToRoute("controller=vente&action=form-vente");
        return;
    }

    if (!Session::get("sales_panier")) {
        $panier = new PanierVenteModel;
    } else {
        $panier = Session::get("sales_panier");
    }
    $panier->addArticleTrois(
        $this->articleModel->findById($data["articleId"]),
        $data["clientId"],
        $data["qteVente"]
    );
    Session::add("sales_panier", $panier);
    $this->redirectToRoute("controller=vente&action=form-vente");
}

}
