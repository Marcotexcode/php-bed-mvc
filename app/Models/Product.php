<?php

namespace App\Models;

use PDO;

class Product {

    public function __construct(protected PDO $conn){}
    
    /**
     * Recupera tutti i prodotti.
     */
    public function all(): array
    {
        $result = [];

        $query = $this->conn->query('SELECT p.*, count(s.product_id) as subscribers FROM products p LEFT JOIN subscribers s ON p.entity_id=s.product_id GROUP BY p.entity_id ORDER BY entity_id ASC');
    
        while ($row = $query->fetch())
        {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * Trova un prodotto in base all'id.
     */
    public function find(int $product_id): array
    {
        $stm = $this->conn->prepare('SELECT * from products where entity_id= :id');
        $stm->execute([ 'id' => $product_id]);

        return $stm->fetch();
    }

    /**
     * Crea prodotto.
     */
    public function create(array $params): void
    {
        $query = $this->conn->prepare('INSERT INTO products (sku, name, description, price, quantity) VALUES (?, ?, ?, ?, ?)');
        $query->execute($params);
    }

    /**
     * Crea prodotto.
     */
    public function update(array $params, int $product_id): void
    {
        $query = $this->conn->prepare('UPDATE products SET sku=?, name=?, description=?, price=?, quantity=? WHERE entity_id=' .  $product_id);
        $query->execute($params);
    }
}