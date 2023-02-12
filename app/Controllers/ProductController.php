<?php

namespace App\Controllers;

use PDO;
use App\Models\Product;

class ProductController {

    protected string $tplDir = 'app/views/'; // Imposta il percorso per i file (template) che si trovano in views. 
    
    public function __construct( // Con la sintassi di php 8 si possono definire le proprietà direttamente come parametro del costruttore 
        protected PDO $conn, // Essendo un parametro di tipo PDO possiamo passare qualsiasi classe che estenda PDO o ritorna un PDO. 
        protected Product $product, // Definiamo una chiamata product.
        protected string $layout = 'layout/index.php',  // Percorso del file. 
        protected string $content = '', // Contenuto del file. 
    ){}

    /**
     * Questo metedo processerà la richiesta dell utente 
     * la richiesta verrà catturata e controllata parsificando l'url che ci stanno richiedendo.
     * 
     * PER PRENDERE L'URL DEFINITIVO POTREI PERNDERE IL parse_url($url, PHP_URL_PATH) ED ELIMINARE TUTTO QUELLO CHE CE dopo index.php 
     */
    public function process()
    {
        $url = $_SERVER['REQUEST_URI'] ?? $_SERVER['REDIRECT_URL']; // Catturo l'url.

        $segment = parse_url($url, PHP_URL_PATH);

        // Se gli viene passato il parametro vuoto o con un products allora vai alla lista
        if ($segment === '/php-bed-mvc/public/index.php' || $segment === '/php-bed-mvc/public/index.php/products') {
            $this->content = $this->index();
        } else {
            
            $tokens = explode('/', $segment); // Divido l'url
            $method = $_SERVER['REQUEST_METHOD']; // Salvo il metodo

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
        require $this->layout; // Prende il template salvato in layout/index.php.
    }

    /**
     * Mostra un singolo prodotto in base all'id.
     */
    public function show(int $product_id): string
    {
        $product = $this->product->find($product_id);
        
        return view('show_product', compact('product'), $this->tplDir); // Passiamo i dati nella funzione view in  helpers/functions.php
    }

    /**
     * Lista di tutti i prodotti.
     */
    public function index(): string
    {
        $products = $this->product->all();

        return view('index_products', compact('products'), $this->tplDir); // Passiamo i dati nella funzione view in  helpers/functions.php
    }


}