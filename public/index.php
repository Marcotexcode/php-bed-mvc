<?php

use App\DB\DbFactory;
use App\Models\Product;
use App\Controllers\ProductController;

/**
 * Cambio la directory e la faccio puntare alla cartella DIR. 
 * ___DIR__ può essere utilizzato per ottenere la directory di lavoro del codice corrente.
 */
chdir(dirname(__DIR__));

require 'db/DBPDO.php';
require 'db/DbFactory.php';
require 'helpers/functions.php';
require 'app/Models/Product.php';
require 'app/Controllers/ProductController.php'; 
$data = require 'config/database.php'; // Prendo l'array di connessione. 

try {
    $conn = (DbFactory::create($data))->getConn(); // In questo modo creiamo un oggetto che viene ritornato passando l'array di connessione ($data) e poi fuori parentesi prendiamo la connessione PDO con getConn.

    $product = new Product($conn);
    $productController = new ProductController($conn, $product); // Creo oggetto e gli passo i parametri di connessione e il risultato di model product.

    $productController->process();
    $productController->display();

} catch (\PDOException $e) {
    echo $e->getMessage(); // Stampa errore che riporta PDO se fallisce qualcosa. 
}

/**
 * Dependency injection fa dipendere ad esempio la classe PostController da una risorsa esterna 
 * ma e il post controller che decide di che tipo di risorsa ha bisogno esempio ha bisogno di creare una risorsa
 * modificare una risorsa prendere solo alcune risorse ecc....
 */