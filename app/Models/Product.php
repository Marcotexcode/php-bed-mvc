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
        $stm = $this->conn->query('SELECT * from products', PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC i valori vengono dati in arr associativo. 
       
        if ($stm && $stm->rowCount()) {
            $result = $stm->fetchAll();
        }

        return $result;
    }

    /**
     * Trova un prodotto in base all'id.
     */
    public function find(int $product_id): array
    {
        $result = [];
        $sql = 'SELECT * from products where entity_id= :id';
        $stm = $this->conn->prepare($sql);
        if ($stm) {
            $res = $stm->execute([ 'id' => $product_id]);
            if ($res) {
                $result = $stm->fetch();
            }
        }

        return $result;
    }
}