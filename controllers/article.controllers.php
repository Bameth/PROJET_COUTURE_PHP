<?php 
require_once("../model/article.model.php");
require_once("../model/categorie.model.php");
require_once("../model/type.model.php");
require_once("../core/Controller.php");
class ArticleControllers extends Controller{
    private ArticleModel $articleModel;
    private CategorieModel $categorieModel;
    private TypeModel $typeModel;
    public function __construct() {
        parent::__construct();
       if(!Autorisation::isConnect()){
        parent::redirectToRoute("controller=securite&action=show-form");
       }
        $this->articleModel=new ArticleModel;
        $this->categorieModel=new CategorieModel;
        $this->typeModel=new TypeModel;
        $this->load();
    }
public function load(){
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == "liste-article") {
           $this-> listerArticle();
        } elseif ($_REQUEST['action'] == "form-article") {
            $this->chargerFormulaire();
        } elseif ($_REQUEST['action'] == "modif-art") {
            if (isset($_GET['id'])) {
                $articleId = intval($_GET['id']);
                $this->chargerFormulaireUpdate($articleId);
            } else {
                unset($_REQUEST['action']);
                unset($_REQUEST['btnmodif']);
                $this-> update($_REQUEST);
                $this->redirectToRoute("controller=article&action=liste-article");
                exit;
            }
        } elseif ($_REQUEST['action'] == "save-article") {
            unset($_POST['action']);
            unset($_POST['btnsa']);
            unset($_POST['controller']);
            $this-> storeArticle($_POST);
            $this->redirectToRoute("controller=article&action=liste-article");
            exit;
        } elseif ($_REQUEST['action'] == "del-art") {
            if (isset($_GET['id'])) {
                $articleId = intval($_GET['id']);
                $this->articleModel->delete($articleId); 
                $this->redirectToRoute("controller=article&action=liste-article");
                exit;
            }
        }
    } else {
        $this->listerArticle();
    }
    
}
public function listerArticle(): void {
    $datas = $this->articleModel->findAll();
    $this->renderView("article/liste",[
        "articles"=>$datas
    ]);
}

public function chargerFormulaire(): void {
    $this->renderView("article/form",[
        "categories"=>$this->categorieModel->findAll(),
        "types"=>$this->typeModel->findAll(),
    ]);
    
}

public function chargerFormulaireUpdate(int $articleId): void {
        $this->renderView("article/formUpdate",[
        "categories"=>$this->categorieModel->findAll(),
        "types"=>$this->typeModel->findAll(),
        "article"=>$this->articleModel->findById($articleId)
    ]);
}

public function storeArticle(array $article): void {
    Validator::$errors = [];
    Validator::isEmpty($article['libelle'] ?? '', 'libelle', 'Le libellé est obligatoire.');
    Validator::isEmpty($article['qteStock'] ?? '', 'qteStock', 'La quantité en stock est obligatoire.');
    Validator::isNumeric($article['qteStock'] ?? '', 'qteStock', 'La quantité en stock doit etre un numeric.');
    Validator::isEmpty($article['prixAppro'] ?? '', 'prixAppro', 'Le prix est obligatoire.');
    Validator::isNumeric($article['prixAppro'] ?? '', 'prixAppro', 'le prix doit etre un numeric.');
    Validator::isEmpty($article['categorie'] ?? '', 'categorie', 'La catégorie est obligatoire.');
    Validator::isEmpty($article['type'] ?? '', 'type', 'Le type est obligatoire.');
    if (!Validator::isValid()) {
        Session::add("errors", Validator::$errors);
        parent::redirectToRoute("controller=article&action=form-article");
        exit;
    }
    $articleExistant = $this->articleModel->findByLibelle($article['libelle']);
    if ($articleExistant) {
        Validator::add('libelle', 'Le libellé existe déjà.');
        Session::add("errors", Validator::$errors);
        parent::redirectToRoute("controller=article&action=form-article");
        exit;
    }
    $this->articleModel->save(['libelle' => $article['libelle'],'qteStock' => $article['qteStock'],'prixAppro' => $article['prixAppro'],'categorieId' => $article['categorie'],'typeId' => $article['type']]);
    parent::redirectToRoute("controller=article&action=liste-article");
    exit;
}


public function update(array $article): void {
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
    $this->articleModel->modifier($article);
    $this->redirectToRoute("controller=article&action=liste-article");
}


}