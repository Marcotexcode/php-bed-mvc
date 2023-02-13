<?php

use App\Controllers\ProductController;

    return [
        'routes' => [
            'GET' => [
                '/php-bed-mvc/public/products'           => [ProductController::class, 'index'],
                '/php-bed-mvc/public/product/create'     => [ProductController::class, 'create'],
                '/php-bed-mvc/public/product/show/:id' => [ProductController::class, 'show'],
            ],
            'POST' => [
                '/php-bed-mvc/public/product/save'     => [ProductController::class, 'save'],
                '/php-bed-mvc/public/product/update/:id'     => [ProductController::class, 'update'],
            ]
        ]
    ];