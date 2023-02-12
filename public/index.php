<?php

// Chiamo il namespace della calsse ProductController. 
use App\Controllers\ProductController;
use App\DB\DBPDO;
use App\DB\DbFactory;

/**
 * Cambio la directory e la faccio puntare alla cartella DIR. 
 * ___DIR__ può essere utilizzato per ottenere la directory di lavoro del codice corrente.
 */
chdir(dirname(__DIR__));

require __DIR__ . '/../db/DBPDO.php';
require __DIR__ . '/../db/DbFactory.php';

// Includo il file PrdoductController dove e situata la classe ProductController. 
require __DIR__ . '/../app/Controllers/ProductController.php';


// Prendo l'array di connessione. 
$data = require 'config/database.php';

try {
    // In questo modo creiamo un oggetto che viene ritornato passando l'array di connessione ($data) e poi fuori parentesi
    // chiamiamo prendiamo la connessione PDO con getConn.
    $conn = (DbFactory::create($data))->getConn();

    // Creo un oggetto (instanza) della classe ProductController. 
    // E gli passo come parametro la connessione PDO.
    $controller = new ProductController($conn);

    // Chiamo il metodo show della classe ProductController passandogli un parametro a caso. 
   // $controller->show(1);
    $controller->productIndex();

    // Chiamo il metodo display della classe ProductController. 
    $controller->display();

} catch (\PDOException $e) {
    echo $e->getMessage(); // Stampa errore che riporta PDO se fallisce qualcosa. 
}






/**
 * Dependency injection fa dipendere ad esempio la classe PostController da una risorsa esterna 
 * ma e il post controller che decide di che tipo di risorsa ha bisogno esempio ha bisogno di creare una risorsa
 * modificare una risorsa prendere solo alcune risorse ecc....
 */