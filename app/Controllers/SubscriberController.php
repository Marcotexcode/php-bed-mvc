<?php

namespace App\Controllers;

use PDO;
use App\Models\Subscriber;

class SubscriberController extends BaseController {

    protected string $tplDir = 'app/views/'; // Imposta il percorso per i file (template) che si trovano in views. 
    protected Subscriber $subscriber; 
    protected $content = ''; 
    protected $layout = 'layout/index.php'; 
    
    public function __construct( // Con la sintassi di php 8 si possono definire le proprietà direttamente come parametro del costruttore 
        protected PDO $conn, // Essendo un parametro di tipo PDO possiamo passare qualsiasi classe che estenda PDO o ritorna un PDO. 
    ){
        $this->subscriber = new Subscriber($conn);
    }

    /**
     * Crea abbonato.
     */
    public function save()
    {
        $params = [ (int)$_POST['product_id'], $_POST['email'] ]; 

        // $subscribers = $this->subscriber->find((int)$_POST['product_id']);

        // foreach ($subscribers as $subscriber) {
        //     if ($subscriber['email'] === $_POST['email']) {
        //         var_dump('presente'); die;
        //     } else {
        // //         $this->subscriber->create($params);
        //     }
        // }
       
        $this->subscriber->create($params);

        header("location: /php-bed-mvc/public/product/show/" . (int)$_POST['product_id']);
    }

    /**
     * Elimina abbonato.
     */
    public function delete(int $subscriber_id)
    {
        $this->subscriber->delete($subscriber_id);

        header("location: /php-bed-mvc/public/products");
    }

    public function display(): void
    {
        require $this->layout;
    }

}