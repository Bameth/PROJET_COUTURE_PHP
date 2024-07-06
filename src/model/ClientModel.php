<?php
namespace ab\Model;

use ab\Core\Model;

class ClientModel extends Model
{
    public function __construct()
    {
        $this->ouvrirConnexion();
        $this->table = "client";
    }
    public function findAllWithPaginate(int $page = 0, int $offset = OFFSET): array
    {
        $page = $page * $offset;
        $result = $this->executeSelect("SELECT COUNT(*) as nbreClient FROM `client`", [], true);
        $data = $this->executeSelect("SELECT * FROM $this->table limit $page,$offset");
        return [
            "totalElements" => $result['nbreClient'],
            "data" => $data,
            "pages" => ceil($result['nbreClient'] / $offset)
        ];
    }
    public function modifier(array $tailleur): int|null
    {
        return $this->executeUpdate("UPDATE `tailleur` SET `nomTailleur` = :nomTailleur, `adresse` = :adresse, `telTailleur` = :telTailleur WHERE `id` = :id", [
            'nomTailleur' => $tailleur['nomTailleur'],
            'adresse' => $tailleur['adresse'],
            'telTailleur' => $tailleur['telTailleur'],
            'id' => $tailleur['id'],
        ]);
    }

    public function delete(int $id): int
    {
        return $this->executeUpdate("DELETE FROM `fournisseur` WHERE `id` = :id", ['id' => $id]);
    }

    public function save(array $tailleur): int
    {
        return $this->executeUpdate("INSERT INTO `tailleur` (`nomTailleur`, `adresse`, `telTailleur`) VALUES (:nomTailleur, :adresse, :telTailleur);", $tailleur);
    }

    public function findByNameType(string $nomFournisseur): array|false
    {
        return $this->executeSelect("SELECT * FROM $this->table WHERE nomFournisseur = :nomFournisseur", ['nomFournisseur' => $nomFournisseur], true);
    }
}
