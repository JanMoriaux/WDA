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

        //sidebar en title
        $categorySidebar = true;
        $allCategories = true;
        $title = 'Alle Producten';


        //view wordt embedded in de layout
        $view = ROOT. '/views/Product/index.php';
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

        //sidebar en title
        $categorySidebar = true;
        $title = "Detail {$product->getName()}";

        //view wordt embedded in de layout
        $view =  ROOT . '/views/Product/showDetail.php';

        require_once ROOT. '/views/layout.php';
    }

    /**
     * GET: verwacht url van de vorm ?controller=Product&action=showCategory&id=x
     */
    public function showCategory(){
        //indien geen id tonen we alle producten
        if(!isset($_GET['id']) || !$_GET['id'])
            return call('Product','index');

        //anders alle producten met categoryId = id ophalen
        $categoryId = $_GET['id'];
        $products = ProductDb::getByCategoryId($categoryId);


        //title en sidebar
        $categorySidebar = true;
        $title = CategoryDb::getById($_GET['id'])->getDescription();


        //view wordt embedded in de layout
        $view = ROOT. '/views/Product/index.php';
        require_once ROOT. '/views/layout.php';
    }


}