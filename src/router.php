<?php

use core\controllers\Router;
use core\models\Model;

Router::get('/home', 'home');
Router::get('/about', 'about');
Router::get('/product', 'product');

Router::post('/addProduct', Model::class, 'addProduct');
Router::post('/updateProduct', Model::class, 'updateProduct');
Router::post('/deleteProduct', Model::class, 'deleteProduct');