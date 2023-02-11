<?php

namespace App\Controllers;


class ProductController {

    protected string $layout = 'layout/index.php';
    protected string $name = 'Marco';
    protected string $content;

    public function __construct()
    {
       // echo 'Product Controller';
    }

    public function display(): void
    {
        require $this->layout;
    }
}