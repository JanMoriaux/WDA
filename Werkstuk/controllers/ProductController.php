<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:13
 */
require_once ROOT . '/models/database/CRUD/ProductDb.php';

class ProductController
{
    // ?controller=Product&action=index
    public function index(){
        //alle producten in variabele
        $products = ProductDb::getAll();
        require_once ROOT. '/views/Product/index.php';
    }

    // ?controller=Product&action=show&id=x
    public function showDetail(){


        //indien geen id redirect naar index page
        if(!isset($_GET['id']))
            return call('Home','error');

        //id gebruiken om product op te halen
        $product = ProductDb::getById($_GET['id']);
        require_once ROOT . '/views/Product/showDetail.php';


    }
}