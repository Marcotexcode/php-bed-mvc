<?php

// Chiamo il namespace della calsse ProductController. 
use App\Controllers\ProductController;

/**
 * Cambio la directory e la faccio puntare alla cartella DIR. 
 * ___DIR__ può essere utilizzato per ottenere la directory di lavoro del codice corrente.
 */
chdir(dirname(__DIR__));

// Per vedere tutti gli errori. 
error_reporting(E_ALL);

// Prova connessione PDO.
try {
    $conn = new \PDO('mysql:host=localhost;dbname=php_bed_db', 'root', 'root');
} catch (PDOException $e) {
    die($e->getMessage());
}


// Includo il file PrdoductController dove e situata la classe ProductController. 
require 'app/Controllers/ProductController.php';

// Creo un oggetto (instanza) della classe ProductController. 
$controller = new ProductController();

// Chiamo il metodo show della classe ProductController passandogli un parametro a caso. 
$controller->show(1);

// Chiamo il metodo display della classe ProductController. 
$controller->display();