<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:13
 */
require_once ROOT . '/models/database/CRUD/ProductDb.php';
require_once ROOT . '/models/database/CRUD/CategoryDb.php';
require_once ROOT . '/models/database/CRUD/RatingDb.php';
require_once ROOT . '/models/validation/RatingValidator.php';

require_once ROOT . '/controllers/Controller.php';

class ProductController extends Controller
{
    protected $currentController = 'Product';

    /**
     * GET: verwacht url van de vorm ?controller=Product&action=index
     */
    public function index()
    {

        $this->setControllerAndActionSessionVariables('index');

        //alle producten in variabele
        $products = ProductDb::getAll();

        //sidebar en title
        $categorySidebar = true;
        $allCategories = true;
        $title = 'Alle Producten';

        //view wordt embedded in de layout
        $view = ROOT . '/views/Product/index.php';
        require_once ROOT . '/views/layout.php';
    }

    /**
     * GET: verwacht url van de vorm ?controller=Product&action=showDetail&id=x
     * POST: laat toe om rating te posten: index.php?controller=Product&action=showDetail
     */
    public function showDetail()
    {
        $this->setControllerAndActionSessionVariables('showDetail');

        //post naar showDetail voor validatie van rating
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = array();
            $values = array();

            $productId = $userId = $ratingValue = $comment = null;

            if (isset($_POST['productId']))
                $productId = $_POST['productId'];
            if (isset($_POST['userId']))
                $userId = $_POST['userId'];
            if (isset($_POST['ratingValue']))
                $ratingValue = $_POST['ratingValue'];
            if (isset($_POST['comment']))
                $comment = $_POST['comment'];

            $thisProduct = ProductDb::getById($productId);

            $rating = new Rating($productId, $userId, $ratingValue, $comment, new DateTime());
            $rv = new RatingValidator(($rating));

            $errors = $rv->getErrors();
            $values = $rv->getValues();

            if ($this->isValidPost($errors)) {

                if(!empty(RatingDb::insert($rating))){


                    $ratingAdded = true;

                }
            }
            //GET
        } else {

            //indien geen id redirect naar home page
            if (!isset($_GET['id']) || empty($_GET['id']))
                call('Home', 'index');

            //id gebruiken om product op te halen
            if (!$thisProduct = ProductDb::getById($_GET['id'])) {
                call('Home', 'index');
            }
        }

        $thisCategory = CategoryDb::getById($thisProduct->getCategoryId());

        //sidebar en title
        $categorySidebar = true;
        $title = "Detail {$thisProduct->getName()}";

        //view wordt embedded in de layout
        $view = ROOT . '/views/Product/showDetail.php';

        require_once ROOT . '/views/layout.php';
    }

    /**
     * GET: verwacht url van de vorm ?controller=Product&action=showCategory&id=x
     */
    public function showCategory()
    {
        $this->setControllerAndActionSessionVariables('showCategory');

        //indien geen id tonen we alle producten
        if (!isset($_GET['id']) || !$_GET['id'])
            return call('Product', 'index');

        //anders alle producten met categoryId = id ophalen
        $categoryId = $_GET['id'];
        $products = ProductDb::getByCategoryId($categoryId);


        //title en sidebar
        $categorySidebar = true;
        $title = CategoryDb::getById($_GET['id'])->getDescription();


        //view wordt embedded in de layout
        $view = ROOT . '/views/Product/index.php';
        require_once ROOT . '/views/layout.php';
    }
}
