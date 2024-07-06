<?php
namespace ab\Model;

use ab\Core\Model;
use ab\Core\Session;

class ApproModel extends Model {
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table = "appro";
    }

    public function modifier(array $type): int|null {
        return $this->executeUpdate("UPDATE `type` SET `nomType` = :nomType WHERE `id` = :id", [
            'nomType' => $type['nomType'],
            'id' => $type['id']
        ]);
    }

    public function delete(int $id): int {
        return $this->executeUpdate("DELETE FROM `type` WHERE `id` = :id", ['id' => $id]);
    }

    public function save(PanierModel $panier): int {
        $date=new \DateTime();
        $date=$date->format('Y-m-d H:i:s');
        $userId=Session::get('userConnect')['id'];
        $this->executeUpdate("INSERT INTO `appro` (`date`, `montant`, `fournisseurId`, `userId`) VALUES ('$date',$panier->total,$panier->fournisseur,$userId);");
        $approId= $this->pdo->lastInsertId();
        foreach ($panier->articles as $article) {
            $qteAppro=$article['qteAppro'];
            $qteStock=$article['qteStock'];
            $montantArticle=$article['montantArticle'];
            $idArticle=$article['id'];
            $this->executeUpdate("INSERT INTO `detail` (`qteAppro`, `approId`, `articleId`, `montant`) VALUES ($qteAppro, $approId, $idArticle, $montantArticle);");
            $this->executeUpdate("UPDATE `article` SET `qteStock` = $qteStock+$qteAppro WHERE `article`.`id` = $idArticle;");
        }
        return 1;
    }

    public function findByNameType(string $nameType): array|false {
        return $this->executeSelect("SELECT * FROM $this->table WHERE nomType = :nomType", ['nomType' => $nameType], true);
    }
    public function findAll(): array {
        return $this->executeSelect("SELECT * FROM fournisseur f, $this->table a  WHERE a.`fournisseurId`=f.id");
    }
    public function findAllWithPaginate(int $page = 0, int $offset = OFFSET): array
    {
        $page=$page*$offset;
        $result = $this->executeSelect("SELECT COUNT(*) as nbreAppro FROM `appro`", [], true);
        $data = $this->executeSelect("SELECT * FROM fournisseur f, $this->table a  WHERE a.`fournisseurId`=f.id limit $page,$offset");
        return [
            "totalElements" => $result['nbreAppro'],
            "data" => $data,
            "pages" => ceil($result['nbreAppro'] / $offset)
        ];
    }
    public function findDetailsByApproId(int $approId): array {
        return $this->executeSelect("SELECT * FROM detail WHERE approId = :approId", ['approId' => $approId]);
    }


}


