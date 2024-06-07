<?php
require_once("../core/Model.php");
class CategorieModel extends Model{
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table="categorie";
    }

    public function modifier(array $categorie): int|null {
        return $this->executeUpdate("UPDATE `categorie` SET `nomCategorie` = :nomCategorie WHERE `id` = :id", [
            'nomCategorie' => $categorie['nomCategorie'],
            'id' => $categorie['id']
        ]);
    }

    public function delete(int $id): int {
        return $this->executeUpdate("DELETE FROM `categorie` WHERE `id` = :id", ['id' => $id]);
    }

    public function save(array $categorie): int|null {
        return $this->executeUpdate("INSERT INTO `categorie` (`nomCategorie`) VALUES (:nomCategorie)", ['nomCategorie' => $categorie['nomCategorie']]);
    }

    public function findByNameCategorie(string $nameCategorie): array|false {
        return $this->executeSelect("SELECT * FROM $this->table WHERE nomCategorie = :nomCategorie", ['nomCategorie' => $nameCategorie], true);
    }
    
    
}