<?php
namespace ab\Model;

use ab\Core\Model;

class FournisseurModel extends Model
{
    public function __construct()
    {
        $this->ouvrirConnexion();
        $this->table = "fournisseur";
    }

    public function findAllWithPaginate(int $page = 0, int $offset = OFFSET): array
    {
        $page = $page * $offset;
        $result = $this->executeSelect("SELECT COUNT(*) as nbreFournisseur FROM `fournisseur`", [], true);
        $data = $this->executeSelect("SELECT * FROM $this->table limit $page,$offset");
        return [
            "totalElements" => $result['nbreFournisseur'],
            "data" => $data,
            "pages" => ceil($result['nbreFournisseur'] / $offset)
        ];
    }
    public function modifier(array $fournisseur): int|null
    {
        return $this->executeUpdate("UPDATE `fournisseur` SET `nomFournisseur` = :nomFournisseur, `adresse` = :adresse, `telFournisseur` = :telFournisseur WHERE `id` = :id", [
            'nomFournisseur' => $fournisseur['nomFournisseur'],
            'adresse' => $fournisseur['adresse'],
            'telFournisseur' => $fournisseur['telFournisseur'],
            'id' => $fournisseur['id'],
        ]);
    }

    public function delete(int $id): int
    {
        return $this->executeUpdate("DELETE FROM `fournisseur` WHERE `id` = :id", ['id' => $id]);
    }

    public function save(array $fournisseur): int
    {
        return $this->executeUpdate("INSERT INTO `fournisseur` (`nomFournisseur`, `adresse`, `telFournisseur`) VALUES (:nomFournisseur, :adresse, :telFournisseur);", $fournisseur);
    }

    public function findByNameType(string $nomFournisseur): array|false
    {
        return $this->executeSelect("SELECT * FROM $this->table WHERE nomFournisseur = :nomFournisseur", ['nomFournisseur' => $nomFournisseur], true);
    }
}
