<?php 
/**
 * Cambio la directory e la faccio puntare alla cartella DIR. 
 * ___DIR__ può essere utilizzato per ottenere la directory di lavoro del codice corrente.
 */
chdir(dirname(__DIR__));

use Core\Router;
use App\DB\DbFactory;
use App\Models\Product;
use App\Controllers\BaseController;

require 'core/bootstrap.php';
$data = require 'config/database.php'; // Prendo l'array di connessione. 
$appConfig = require 'config/app.config.php'; // Prendo l'array di connessione. 

$router = new Router($appConfig['routes']);

$arrController = $router->dispact();

$controllerParams = $arrController[2] ?? [];

try {
    $conn = (DbFactory::create($data))->getConn(); // In questo modo creiamo un oggetto che viene ritornato passando l'array di connessione ($data) e poi fuori parentesi prendiamo la connessione PDO con getConn.

    $product = new Product($conn);

    $method = $arrController[1];
    $classController = $arrController[0];

    $productController = new $classController($conn); // Creo oggetto e gli passo i parametri di connessione e il risultato di model product.

    if (method_exists($productController, $method)) {
        $productController->$method(...$controllerParams);
    }

    if ($productController instanceof BaseController ) {
        $productController->display();
    }


} catch (\PDOException $e) {
    echo $e->getMessage(); // Stampa errore che riporta PDO se fallisce qualcosa. 
}

/**
 * Dependency injection fa dipendere ad esempio la classe PostController da una risorsa esterna 
 * ma e il post controller che decide di che tipo di risorsa ha bisogno esempio ha bisogno di creare una risorsa
 * modificare una risorsa prendere solo alcune risorse ecc....
 */