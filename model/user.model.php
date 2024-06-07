<?php
require_once("../core/Model.php");
class UserModel extends Model{
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table="user";
    }

    public function findByLoginAndPassword(string $login, string $password): array|false {
        // Utilisation de requête préparée pour éviter l'injection SQL
        $query = "SELECT * FROM $this->table u, role r WHERE u.roleId=r.id AND u.login = :login AND u.password = :password";
        $params = array(':login' => $login, ':password' => $password);
        return $this->executeSelect($query, $params,true);
    }
}
