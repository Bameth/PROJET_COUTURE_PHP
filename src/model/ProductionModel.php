<?php

namespace ab\Model;

use ab\Core\Model;
use ab\Core\Session;

class ProductionModel extends Model
{
    public function __construct()
    {
        $this->ouvrirConnexion();
        $this->table = "production";
    }

    public function save(PanierModel $panier, string $observation): int
    {
        $date = new \DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $userId = Session::get('userConnect')['id'];

        // Insérer la production avec l'observation
        $this->executeUpdate("INSERT INTO `production` (`date`, `observation`, `tailleurId`, `userId`, `montant`) VALUES ('$date', :observation, $panier->tailleur, $userId, $panier->total);", ['observation' => $observation]);

        $prodId = $this->pdo->lastInsertId();

        foreach ($panier->articles as $article) {
            $qteProd = $article['qteProd'];
            $qteStock = $article['qteStock'];
            $montantArticle = $article['montantArticle'];
            $idArticle = $article['id'];

            $this->executeUpdate("INSERT INTO `detailproduction` (`qteProd`, `prodId`, `articleId`, `montant`, `observation`) VALUES ($qteProd, $prodId, $idArticle, $montantArticle, :observation);", ['observation' => $observation]);

            $this->executeUpdate("UPDATE `article` SET `qteStock` = $qteStock + $qteProd WHERE `article`.`id` = $idArticle;");
        }

        return 1;
    }


    public function findAll(): array
    {
        return $this->executeSelect("SELECT * FROM tailleur t, $this->table p WHERE p.`tailleurId` = t.id");
    }

    public function findAllWithPaginate(int $page = 0, int $offset = OFFSET, array $filters = []): array
    {
        $page = $page * $offset;
        $conditions = [];
        $params = [];

        if (isset($filters['filter_date'])) {
            $conditions[] = "p.date = :date";
            $params['date'] = $filters['filter_date'];
        }
        if (isset($filters['filter_tailleur'])) {
            $conditions[] = "t.id = :tailleurId";
            $params['tailleurId'] = $filters['filter_tailleur'];
        }
        if (isset($filters['filter_article'])) {
            $conditions[] = "d.articleId = :articleId";
            $params['articleId'] = $filters['filter_article'];
        }

        $conditions = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

        $result = $this->executeSelect("SELECT COUNT(*) as nbreProd FROM production p
                                        JOIN tailleur t ON p.tailleurId = t.id
                                        JOIN detailproduction d ON p.id = d.prodId
                                        $conditions", $params, true);

        $data = $this->executeSelect("SELECT p.*, t.nomTailleur, t.telTailleur FROM $this->table p
                                      JOIN tailleur t ON p.tailleurId = t.id
                                      JOIN detailproduction d ON p.id = d.prodId
                                      $conditions
                                      LIMIT $page, $offset", $params);

        return [
            "totalElements" => $result['nbreProd'],
            "data" => $data,
            "pages" => ceil($result['nbreProd'] / $offset)
        ];
    }

    public function findDetailsByProdId(int $prodId): array
    {
        return $this->executeSelect("SELECT * FROM detailproduction WHERE prodId = :prodId", ['prodId' => $prodId]);
    }
}
