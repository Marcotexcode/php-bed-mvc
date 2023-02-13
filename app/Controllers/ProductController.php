<?php

namespace App\Controllers;

use PDO;
use App\Models\Product;

class ProductController extends BaseController {

    protected string $tplDir = 'app/views/'; // Imposta il percorso per i file (template) che si trovano in views. 
    protected Product $product; 
    protected $content = ''; 
    protected $layout = 'layout/index.php'; 
    
    public function __construct( // Con la sintassi di php 8 si possono definire le proprietà direttamente come parametro del costruttore 
        protected PDO $conn, // Essendo un parametro di tipo PDO possiamo passare qualsiasi classe che estenda PDO o ritorna un PDO. 
    ){
        $this->product = new Product($conn);
    }

    /**
     * Mostra un singolo prodotto in base all'id.
     */
    public function show(int $product_id)
    {
        $product = $this->product->find($product_id);
        
        $this->content = view('show_product', compact('product')); // Passiamo i dati nella funzione view in  helpers/functions.php
    }

    /**
     * Lista di tutti i prodotti.
     */
    public function index()
    {
        $products = $this->product->all();

        $this->content = view('index_products', compact('products')); // Passiamo i dati nella funzione view in  helpers/functions.php
    }

    /**
     * Mostra il form della creazione.
     */
    public function create()
    {
        $product = '';

        $this->content = view('show_product', compact('product')); // Passiamo i dati nella funzione view in  helpers/functions.php
    }

    /**
     * crea prodotto.
     */
    public function save()
    {
        $params = [ $_POST['sku'], $_POST['description'], $_POST['name'], (double)$_POST['price'], (int)$_POST['qty']]; 
        
        $this->product->create($params);

        header("location: /php-bed-mvc/public/products");
    }

     /**
     * crea prodotto.
     */
    public function update(int $product_id)
    {
        $params = [ $_POST['sku'], $_POST['description'], $_POST['name'], (double)$_POST['price'], (int)$_POST['qty']]; 
        
        $this->product->update($params, $product_id);

        header("location: /php-bed-mvc/public/products");
    }

    public function display(): void
    {
        require $this->layout;
    }
}