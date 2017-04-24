<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:13
 */
require_once ROOT . '/models/database/CRUD/ProductDb.php';
require_once ROOT . '/models/database/CRUD/CategoryDb.php';

class ProductController
{
    /**
     * GET: verwacht url van de vorm ?controller=Product&action=index
     */
    public function index(){

        //alle producten in variabele
        $products = ProductDb::getAll();

        //alle categorieën voor de sidebar
        $categories = CategoryDb::getAll();


        //view wordt embedded in de layout
        $view = ROOT. '/views/Product/index.php';
        $title = 'Alle Producten';

        require_once ROOT. '/views/layout.php';
    }

    //


    /**
     * GET: verwacht url van de vorm ?controller=Product&action=showDetail&id=x
     */
    public function showDetail(){


        //indien geen id redirect naar error page
        if(!isset($_GET['id']))
            return call('Home','error');

        //id gebruiken om product op te halen
        $product = ProductDb::getById($_GET['id']);

        //alle categorieën voor de sidebar
        $categories = CategoryDb::getAll();

        //view wordt embedded in de layout
        $view =  ROOT . '/views/Product/showDetail.php';
        $title = "Detail {$product->getName()}";

        require_once ROOT. '/views/layout.php';
    }

    /**
     * GET: verwacht url van de vorm ?controller=Product&action=showCategory&id=x
     */
    public function showCategory(){
        //indien geen id redirect naar error page
        if(!isset($_GET['id']))
            return call('Home','error');

        //anders alle producten met categoryId = id ophalen
        $products = ProductDb::getByCategoryId($_GET['id']);

        //alle categorieën voor de sidebar
        $categories = CategoryDb::getAll();

        //view wordt embedded in de layout
        $view = ROOT. '/views/Product/index.php';
        $title = CategoryDb::getById($_GET['id'])->getDescription();

        require_once ROOT. '/views/layout.php';
    }


}