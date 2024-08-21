<?php
namespace ab\Model;

use ab\Core\Model;

class PanierVenteModel extends Model {
    public $fournisseur=null;
    public $tailleur=null;
    public $client=null;
    public $observation='';
    public array $articles=[];
    public $total=0;
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
    public function montantArticleDeux($prix,$qteVente){
       return $prix*$qteVente;
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

