<?php
namespace ab\Model;

use ab\Core\Model;

class DetailProduction extends Model
{
    public function __construct()
    {
        $this->ouvrirConnexion();
        $this->table = "detailproduction";
    }
    public function findAll(): array {
        return $this->executeSelect("SELECT * FROM $this->table d JOIN production p ON d.prodId = p.id JOIN article a ON d.articleId = a.id");
    }
    public function findByProductionId(int $prodId): array {
        return $this->executeSelect("SELECT * FROM $this->table d JOIN article a ON d.articleId = a.id WHERE d.prodId = :prodId", ['prodId' => $prodId]);
    }
    public function findDetailsByProdId(int $prodId): array {
        return $this->executeSelect("SELECT * FROM detailproduction WHERE prodId = :prodId", ['prodId' => $prodId]);
    }

    
}