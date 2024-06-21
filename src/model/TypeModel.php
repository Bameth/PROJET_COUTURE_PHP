<?php
namespace ab\Model;

use ab\Core\Model;

class TypeModel extends Model {
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table = "type";
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

    public function save(array $type): int {
        return $this->executeUpdate("INSERT INTO `type` (`nomType`) VALUES (:nomType)", $type);
    }

    public function findByNameType(string $nameType): array|false {
        return $this->executeSelect("SELECT * FROM $this->table WHERE nomType = :nomType", ['nomType' => $nameType], true);
    }
}
