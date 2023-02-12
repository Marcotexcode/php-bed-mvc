<?php

namespace App\Controllers;

use PDO;

class ProductController {

    // Imposta il percorso per i file (template) che si trovano in views. 
    protected string $tplDir = 'app/views';

    // Con la sintassi di php 8 si possono definire le proprietà direttamente come parametro del costruttore 
    public function __construct(
        /**
         * Essendo un parametro di tipo PDO possiamo passare qualsiasi classe 
         * che estenda PDO o ritorna un PDO.
         */
        protected PDO $conn,
        // Percorso del file. 
        protected string $layout = 'layout/index.php',
        
        // Contenuto del file. 
        protected string $content = '',
    ){
        // // Facciamo la query selezionando tutti i prodotti. 
        // $products = $conn->query('select * from products', PDO::FETCH_ASSOC)->fetchAll(); // PDO::FETCH_ASSOC i valori vengono dati in arr associativo. 

        // ob_start();

        // require $this->tplDir . '/index_products.php';
        // $this->content = ob_get_contents();
        
        // ob_end_clean();
    }


    /**
     * Questo metedo processerà la richiesta dell utente 
     * la richiesta verrà catturata e controllata parsificando l'url che ci stanno richiedendo.
     * 
     */
    //PER PRENDERE L'URL DEFINITIVO POTREI PERNDERE IL parse_url($url, PHP_URL_PATH) ED ELIMINARE TUTTO QUELLO CHE CE dopo index.php 

    public function process()
    {
        // Catturo l'url.
        $url = $_SERVER['REQUEST_URI'] ?? $_SERVER['REDIRECT_URL'];

        $segment = parse_url($url, PHP_URL_PATH);
        // Se gli viene passato il parametro vuoto o con un products allora vai alla lista
        if ($segment === '/php-bed-mvc/public/index.php' || $segment === '/php-bed-mvc/public/index.php/products') {
            $this->content = $this->index();
        } else {
            // Divido l'url
            $tokens = explode('/', $segment);
            // Salvo il metodo
            $method = $_SERVER['REQUEST_METHOD'];

            // Se nel 4 ci sia product e dopo non e vuoto e il metodo e get allora vai all dettaglio product.
            if ($tokens[4] === 'product' && !empty($tokens[5]) && $method === 'GET') {
                $this->content = $this->show($tokens[5]);
            }

        }

    }


    /**
     * Mostra layout/index.php.
     */
    public function display(): void
    {
        // Prende il template salvato in layout/index.php.
        require $this->layout;
    }

    /**
     * Mostra un singolo prodotto in base all'id.
     */
    public function show(int $product_id): string
    {
        // Imposta il contenuto della variabile message passata al template. 
        $product = $this->conn->query('select * from products where entity_id=' . $product_id, PDO::FETCH_ASSOC)->fetch(); // PDO::FETCH_ASSOC i valori vengono dati in arr associativo. 
        
        // Avvita buffer e permette che tutto l'output di php viene fermato 
        // e viene creato un buffer interno. 
        ob_start();

        // Prende il template del file view/show_product.php.
        require $this->tplDir . '/show_product.php';
        
        /**
         * imposta il contenuto del file. 
         * ob_get_contents() cattura il buffer cioe il template show_product e lo inserisce 
         * dentro al body dell public/index.php. 
         */
       
        $content = ob_get_contents();

        /**
         *  Alla fine distruggo il buffer. 
         *  Senno viene visto sia dal template show_product che dal template layout/index,
         *  in questo modo il contenuto del file show_product viene passato in content in modo da farlo vedere
         *  in layout/index e poi il contenuto show_product.php verra cancellato in modo da non stampare a video lo 
         *  stesso contenuto. 
         */
        ob_end_clean();
        return $content;

    }

    /**
     * Lista di tutti i prodotti.
     */
    public function index(): string
    {
        // Facciamo la query selezionando tutti i prodotti. 
        $products = $this->conn->query('select * from products', PDO::FETCH_ASSOC)->fetchAll(); // PDO::FETCH_ASSOC i valori vengono dati in arr associativo. 

        ob_start();

        require $this->tplDir . '/index_products.php';
        $content = ob_get_contents();
        
        ob_end_clean();

        return $content;
    }


}