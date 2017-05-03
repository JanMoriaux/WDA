<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:13
 */
require_once ROOT . '/models/database/CRUD/ProductDb.php';
require_once ROOT . '/models/database/CRUD/CategoryDb.php';
require_once ROOT . '/controllers/Controller.php';

class ProductController extends Controller
{
    protected $currentController = 'Product';

    /**
     * GET: verwacht url van de vorm ?controller=Product&action=index
     */
    public function index(){

        $this->setControllerAndActionSessionVariables('index');

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
        $this->setControllerAndActionSessionVariables('showDetail');

        //indien geen id redirect naar home page
        if(!isset($_GET['id']) || empty($_GET['id']))
            call('Home','index');

        //id gebruiken om product op te halen
        if(!$product = ProductDb::getById($_GET['id'])){
            call('Home','index');
        }

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

        $this->setControllerAndActionSessionVariables('showCategory');

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