<?php 
class Model{
    protected String $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=cours_php_ism';
    protected $username = 'root';
    protected $password = 'root';
    protected PDO|NULL $pdo=null;
    protected string $table;
public function ouvrirConnexion():void{
    try {
        if ($this->pdo==null) {
            $this->pdo = new PDO($this->dsn,$this->username,$this->password);
        }
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

public function fermerConnexion():void{
        if ( $this->pdo!=null) {
            $this->pdo = null;
        }
}
protected function executeSelect(String $sql, array $params = [], bool $fetch = false): array|false {
    try {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $fetch ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    return [];
}

protected function executeUpdate(String $sql, array $params = []): int {
    try {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    return 0;
}
public function findAll(): array {
    return $this->executeSelect("SELECT * FROM $this->table ");
}

public function findById(int $id): ?array {
    $result = $this->executeSelect("SELECT * FROM $this->table WHERE `id` = :id", ['id' => $id], true);
    return $result ?: null;
}

}