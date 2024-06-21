<?php
namespace ab\Model;

use ab\Core\Model;

class UserModel extends Model {
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table = "user";
    }

    public function findByLoginAndPassword(string $login, string $password): array|false {
        $query = "SELECT * FROM role r, $this->table u WHERE u.roleId = r.id AND u.login = :login AND u.password = :password";
        $params = array(':login' => $login, ':password' => $password);
        return $this->executeSelect($query, $params, true);
    }
}
