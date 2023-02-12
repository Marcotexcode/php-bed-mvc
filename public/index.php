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


// Prendo l'array di connessione. 
$data = require 'config/database.php';

try {
   // Instanziamo un aclasse la connessione e gli passo l'array di connessione.
    $pdoConn = DbFactory::create($data);

    // Prendiamo la connessione PDO.
    $conn = $pdoConn->getConn();

    // Facciamo la query selezionando tutti i prodotti. 
    $stm = $conn->query('select * from products', PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC i valori vengono dati in arr associativo. 

    if ($stm) {
        foreach ($stm->fetchAll() as $row) {
            var_dump($row);
        }
    } else {
        $conn->errorInfo();
    }

} catch (\PDOException $e) {
    echo $e->getMessage(); // Stampa errore che riporta PDO se fallisce qualcosa. 
}


// Includo il file PrdoductController dove e situata la classe ProductController. 
require __DIR__ . '/../app/Controllers/ProductController.php';

// Creo un oggetto (instanza) della classe ProductController. 
$controller = new ProductController();

// Chiamo il metodo show della classe ProductController passandogli un parametro a caso. 
$controller->show(1);

// Chiamo il metodo display della classe ProductController. 
$controller->display();