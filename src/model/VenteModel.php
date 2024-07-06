<?php
namespace ab\Model;

use ab\Core\Model;
use ab\Core\Session;

class VenteModel extends Model
{
    public function __construct()
    {
        $this->ouvrirConnexion();
        $this->table = "vente";
    }

    public function save(PanierModel $panier): int
    {
        $date = new \DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $userId = Session::get('userConnect')['id'];
        $this->executeUpdate("INSERT INTO `vente` (`date`, `montant`, `clientId`, `userId`) VALUES ('$date', $panier->total, $panier->client, $userId);");
        $venteId = $this->pdo->lastInsertId();
        
        foreach ($panier->articles as $article) {
            $qteVente = $article['qteVente'];
            $qteStock = $article['qteStock'];
            $montantArticle = $article['montantArticle'];
            $idArticle = $article['id'];
            $this->executeUpdate("INSERT INTO `detailvente` (`qteVente`, `venteId`, `articleId`, `montant`) VALUES ($qteVente, $venteId, $idArticle, $montantArticle);");
            $this->executeUpdate("UPDATE `article` SET `qteStock` = $qteStock - $qteVente WHERE `article`.`id` = $idArticle;");
        }
        return 1;
    }

    public function findAll(): array
    {
        return $this->executeSelect("SELECT * FROM client c, $this->table v WHERE v.`clientId` = c.id");
    }

    public function findAllWithPaginate(int $page = 0, int $offset = OFFSET, array $filters = []): array
{
    $page = $page * $offset;
    $conditions = [];
    $params = [];

    if (isset($filters['filter_date'])) {
        $conditions[] = "v.date = :date";
        $params['date'] = $filters['filter_date'];
    }
    if (isset($filters['filter_client'])) {
        $conditions[] = "c.id = :clientId";
        $params['clientId'] = $filters['filter_client'];
    }
    if (isset($filters['filter_article'])) {
        $conditions[] = "d.articleId = :articleId";
        $params['articleId'] = $filters['filter_article'];
    }

    $conditions = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

    $result = $this->executeSelect("SELECT COUNT(*) as nbreVente FROM vente v
                                    JOIN client c ON v.clientId = c.id
                                    JOIN detailvente d ON v.id = d.venteId
                                    $conditions", $params, true);

    $data = $this->executeSelect("SELECT v.*, c.nomClient, c.telClient FROM $this->table v
                                  JOIN client c ON v.clientId = c.id
                                  JOIN detailvente d ON v.id = d.venteId
                                  $conditions
                                  LIMIT $page, $offset", $params);

    return [
        "totalElements" => $result['nbreVente'],
        "data" => $data,
        "pages" => ceil($result['nbreVente'] / $offset)
    ];
}
public function findDetailsByVenteId(int $venteId): array {
    return $this->executeSelect("SELECT * FROM detailvente WHERE venteId = :venteId", ['venteId' => $venteId]);
}
}
