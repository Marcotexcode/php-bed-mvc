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
    public function show(int $product_id)
    {
        // Imposta il contenuto della variabile message passata al template. 
        $message = 'Show Product';
        
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
       
        $this->content = ob_get_contents();

        /**
         *  Alla fine distruggo il buffer. 
         *  Senno viene visto sia dal template show_product che dal template layout/index,
         *  in questo modo il contenuto del file show_product viene passato in content in modo da farlo vedere
         *  in layout/index e poi il contenuto show_product.php verra cancellato in modo da non stampare a video lo 
         *  stesso contenuto. 
         */
        ob_end_clean();
    }

    /**
     * Lista di tutti i prodotti.
     */
    public function productIndex()
    {
        // Facciamo la query selezionando tutti i prodotti. 
        $products = $this->conn->query('select * from products', PDO::FETCH_ASSOC)->fetchAll(); // PDO::FETCH_ASSOC i valori vengono dati in arr associativo. 

        ob_start();

        require $this->tplDir . '/index_products.php';
        $this->content = ob_get_contents();
        
        ob_end_clean();
    }
}