<?php

namespace App\Models;

use PDO;

class Subscriber {

    public function __construct(protected PDO $conn){}
    
    /**
     * Recupera tutti i prodotti.
     */
    // public function all(): array
    // {
    //     $result = [];

    //     $query = $this->conn->query('SELECT * FROM subscribers WHERE product_id=?');
    
    //     while ($row = $query->fetch())
    //     {
    //         $result[] = $row;
    //     }

    //     return $result;
    // }

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

    // /**
    //  * Crea prodotto.
    //  */
    // public function update(array $params, int $product_id): void
    // {
    //     $query = $this->conn->prepare('UPDATE products SET sku=?, name=?, description=?, price=?, quantity=? WHERE entity_id=' .  $product_id);
    //     $query->execute($params);
    // }

    /**
     * Elimina abbonato.
     */
    public function delete(int $subscriber_id):void
    {
        $query = $this->conn->prepare('DELETE FROM subscribers WHERE entity_id='. $subscriber_id);
        $query->execute();
    }
}