<?php

namespace App\Models;

use PDO;

class Subscriber {

    public function __construct(protected PDO $conn){}
    
    /**
     * Trova un abbonato in base all' id del prodotto.
     */
    public function find(int $product_id): array
    {
        $stm = $this->conn->query('SELECT * FROM subscribers WHERE product_id='. $product_id);
        $stm->execute();

        $result = [];
        while ($row = $stm->fetch())
        {
            $result[] = $row;
        }

        return  $result;
    }

    /**
     * Crea abbonato.
     */
    public function create(array $params): void
    {
        $query = $this->conn->prepare('INSERT INTO subscribers (product_id, email) VALUES (?, ?)');
        $query->execute($params);
    }

    /**
     * Trova un prodotto in base all'id.
     */
    public function findEmail(string $email): array
    {
        $stm = $this->conn->prepare('SELECT * FROM subscribers WHERE email=?');
        $stm->execute([$email]);

        $result = [];
        while ($row = $stm->fetch())
        {
            $result[] = $row;
        }

        return  $result;
    }

    /**
     * Elimina abbonato.
     */
    public function delete(int $subscriber_id):void
    {
        $query = $this->conn->prepare('DELETE FROM subscribers WHERE entity_id='. $subscriber_id);
        $query->execute();
    }

    /**
     * Elimina tutti gli abbonati di quel prodotto.
     */
    public function deleteByProduct(int $product_id):void
    {
        $query = $this->conn->prepare('DELETE FROM subscribers WHERE product_id='. $product_id);
        $query->execute();
    }
}