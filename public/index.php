<?php

use App\Controllers\ProductController;


chdir(dirname(__DIR__));

require 'app/Controllers/ProductController.php';

$controller = new ProductController();

$controller->display();