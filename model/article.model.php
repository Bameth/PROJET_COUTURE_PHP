<?php
require_once("../core/Model.php");
class ArticleModel extends Model{
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table="article";
    }
public function findAll(): array {
   return $this->executeSelect("SELECT a.id, a.libelle, a.qteStock, a.prixAppro, a.categorieId, a.typeId, c.nomCategorie, t.nomType FROM $this->table a JOIN categorie c ON a.categorieId = c.id JOIN type t ON a.typeId = t.id");
}

public function save(array $article): int {
    return $this->executeUpdate("INSERT INTO `article` (`libelle`, `qteStock`, `prixAppro`, `typeId`, `categorieId`)
    VALUES (:libelle, :qteStock, :prixAppro, :typeId, :categorieId);", $article);
}

public function delete(int $id): int {
    return $this->executeUpdate("DELETE FROM `article` WHERE `id` = :id", ['id' => $id]);
}

public function modifier(array $article): int|null {
    return $this->executeUpdate("UPDATE `article`
    SET `libelle` = :libelle, `prixAppro` = :prixAppro, `qteStock` = :qteStock, `categorieId` = :categorieId, `typeId` = :typeId
    WHERE `id` = :articleId", [
        'libelle' => $article['libelle'],
        'prixAppro' => $article['prixAppro'],
        'qteStock' => $article['qteStock'],
        'categorieId' => $article['categorieId'],
        'typeId' => $article['typeId'],
        'articleId' => $article['articleId']
    ]);
}
public function findByLibelle(string $libelle): array|false {
    return $this->executeSelect("SELECT * FROM $this->table WHERE libelle = :libelle", ['libelle' => $libelle], true);
}




}
