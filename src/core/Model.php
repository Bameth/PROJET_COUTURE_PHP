<?php
namespace ab\Core;

use PDO;
use PDOException;

class Model {
    protected string $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=ges_atelier_couture';
    protected string $username = 'root';
    protected string $password = '';
    protected PDO|null $pdo = null;
    protected string $table;

    public function ouvrirConnexion(): void {
        try {
            if ($this->pdo === null) {
                $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            }
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function fermerConnexion(): void {
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }

    protected function executeSelect(string $sql, array $params = [], bool $fetch = false): array|false {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $fetch ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return [];
    }

    protected function executeUpdate(string $sql, array $params = []): int {
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
        return $this->executeSelect("SELECT * FROM $this->table");
    }

    public function findById(int $id): ?array {
        $result = $this->executeSelect("SELECT * FROM $this->table WHERE `id` = :id", ['id' => $id], true);
        return $result ?: null;
    }
    
}
