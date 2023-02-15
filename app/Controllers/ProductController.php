<?php

namespace App\Controllers;
session_start();

use PDO;
use App\Models\Product;
use App\Models\Subscriber;

class ProductController extends BaseController {

    protected string $tplDir = 'app/views/'; 
    protected Product $product; 
    protected Subscriber $subscriber; 
    protected $content = ''; 
    protected $layout = 'layout/index.php'; 
    
    public function __construct(
        protected PDO $conn,
    ){
        $this->product = new Product($conn);
        $this->subscriber = new Subscriber($conn);
    }

    /**
     * Mostra un singolo prodotto in base all'id.
     */
    public function show(int $product_id)
    {
        $product = $this->product->find($product_id);
        $subscribers = $this->subscriber->find($product_id);
        
        $this->content = view('show_product', compact(['product', 'subscribers']));
    }

    /**
     * Lista di tutti i prodotti.
     */
    public function index()
    {
        $products = $this->product->all();

        $this->content = view('index_products', compact('products'));
    }

    /**
     * Mostra il form della creazione.
     */
    public function create()
    {
        $product = '';

        $this->content = view('show_product', compact('product'));
    }

    /**
     * Crea prodotto.
     */
    public function save()
    {
        $params = [ $_POST['sku'], $_POST['description'], $_POST['name'], (double)$_POST['price'], (int)$_POST['qty']]; 
        
        $this->product->create($params);

        header("location: /");
    }

    /**
     * Aggiorna prodotto.
     */
    public function update(int $product_id)
    {
        $params = [ $_POST['sku'], $_POST['description'], $_POST['name'], (double)$_POST['price'], (int)$_POST['qty']]; 
       
        $subscribers =  $this->subscriber->find($product_id);

        $notifySubscribers = false;

        if ((int)$_POST['qty'] > 0) {
            if ((int)$_POST['qty_orig'] === 0) {
                $notifySubscribers = true;
            }
        }

        if (count($subscribers) && $notifySubscribers) {

            $mailSubscribers = [];
            foreach($subscribers as $subscriber){
                $mailSubscribers[] = $subscriber['email'];
            }

            $_SESSION['message'] = 'E-mail sent to: ' . implode( ', ',  $mailSubscribers). '.';
            $_SESSION['success'] = 'success';

            // Delete subscribers
            $this->subscriber->deleteByProduct($product_id);
        }

        $this->product->update($params, $product_id);

        header("location: /");
    }

    /**
     * Elimina prodotto.
     */
    public function delete(int $product_id): void
    {
        $this->product->delete($product_id);

        header("location: /");
    }

    public function display(): void
    {
        require $this->layout;
    }
}