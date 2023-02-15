<?php

namespace App\Controllers;

use PDO;
use App\Models\Subscriber;

class SubscriberController extends BaseController {

    protected string $tplDir = 'app/views/'; 
    protected Subscriber $subscriber; 
    protected $content = ''; 
    protected $layout = 'layout/index.php'; 
    
    public function __construct(
        protected PDO $conn, 
    ){
        $this->subscriber = new Subscriber($conn);
    }

    /**
     * Crea abbonato.
     */
    public function save()
    {
        $params = [ (int)$_POST['product_id'], $_POST['email'] ]; 

        $sub = $this->subscriber->findEmail($_POST['email']);

        if(count($sub)) {
            
            var_dump('Gia presente'); die;

        } else {

            $this->subscriber->create($params);
        }

        header("location: /product/show/" . (int)$_POST['product_id']);
    }

    /**
     * Elimina abbonato.
     */
    public function delete(int $subscriber_id)
    {
        $this->subscriber->delete($subscriber_id);

        header("location: /");
    }

    public function display(): void
    {
        require $this->layout;
    }

}