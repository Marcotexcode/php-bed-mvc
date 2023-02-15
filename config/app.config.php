<?php

use App\Controllers\ProductController;
use App\Controllers\SubscriberController;

    return [
        'routes' => [
            'GET' => [
                '/'            => [ProductController::class, 'index'],
                '/product/create'      => [ProductController::class, 'create'],
                '/product/show/:id'    => [ProductController::class, 'show'],
            ],
            'POST' => [
                '/product/delete/:id'    => [ProductController::class, 'delete'],
                '/subscriber/delete/:id' => [SubscriberController::class, 'delete'],
                '/product/save'          => [ProductController::class, 'save'],
                '/subscriber/save'       => [SubscriberController::class, 'save'],
                '/product/update/:id'    => [ProductController::class, 'update'],
            ],
        ]
    ];