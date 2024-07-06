<?php
namespace ab\Model;

use ab\Core\Model;

class PanierModel extends Model {
    public $fournisseur=null;
    public $tailleur=null;
    public $client=null;
    public $observation='';
    public array $articles=[];
    public $total=0;

    public function addArticle($article,$fournisseur,$qteAppro){
        $montantArticle=$this->montantArticle($article["prixAppro"],$qteAppro);
        $key=$this->articleExiste($article);
        if ($key!=-1) {
            $this->articles[$key]["qteAppro"]+=$qteAppro;
            $this->articles[$key]["montantArticle"]+=$montantArticle;
        }else {
            $article["qteAppro"]=$qteAppro;
            $article["montantArticle"]=$montantArticle;
            $this->articles[]=$article;
        }
        $this->fournisseur=$fournisseur;
        $this->total+=$montantArticle;
    }
    public function addArticleDeux($article,$tailleur,$qteProd){
        $montantArticle=$this->montantArticleDeux($article["prixAppro"],$qteProd);
        $key=$this->articleExiste($article);
        if ($key!=-1) {
            $this->articles[$key]["qteProd"]+=$qteProd;
            $this->articles[$key]["montantArticle"]+=$montantArticle;
        }else {
            $article["qteProd"]=$qteProd;
            $article["montantArticle"]=$montantArticle;
            $this->articles[]=$article;
        }
        $this->tailleur=$tailleur;
        $this->total+=$montantArticle;
    }
    public function addArticleTrois($article,$client,$qteVente){
        $montantArticle=$this->montantArticleDeux($article["prixAppro"],$qteVente);
        $key=$this->articleExiste($article);
        if ($key!=-1) {
            $this->articles[$key]["qteVente"]+=$qteVente;
            $this->articles[$key]["montantArticle"]+=$montantArticle;
        }else {
            $article["qteVente"]=$qteVente;
            $article["montantArticle"]=$montantArticle;
            $this->articles[]=$article;
        }
        $this->client=$client;
        $this->total+=$montantArticle;
    }
    public function montantArticle($prix,$qteAppro){
       return $prix*$qteAppro;
    }
    public function montantArticleDeux($prix,$qteProd){
       return $prix*$qteProd;
    }
    public function articleExiste($article):int{
        foreach ($this->articles as $key => $value) {
            if ($value["id"]==$article["id"]){
                return $key;
            }
        }
        return -1;
    }
    public function clear():void{
        $this->articles=[];
        $this->total=0;
        $this->fournisseur=null;
    }
}

