<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 3/05/2017
 * Time: 8:07
 */
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/database/CRUD/CategoryDb.php';
require_once ROOT . '/models/database/CRUD/ProductDb.php';
require_once ROOT . '/models/validation/ValidationRules.php';

class AjaxController extends Controller
{
    //AJAX call: GET geeft id van de category mee
    //geeft html met productOverview terug
    // GET: index.php?controller=Ajax&action=showCategory&id=x
    public function showCategory()
    {
        $products = null;

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $categoryId = $_GET['id'];

            $products = ProductDb::getByCategoryId($categoryId);

        } else {

            $products = ProductDb::getAll();

        }

        echo include_once ROOT . '/views/product/index.php';

    }

    //AJAX call: POST voegt één eenheid van een bepaald product toe aan het winkelmandje
    //index.php?controller=Ajax&action=addItemToCart
    public function addItemToCart()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->startSession();

            if (isset($_POST['id']) && !empty($_POST['id'])) {

                $id = $_POST['id'];

                //indien cart nog niet bestaat een nieuwe sessievariabele aanmaken
                if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                    $_SESSION['cart'] = new ShoppingCart();
                }
                $cart = $_SESSION['cart'];

                //indien product nog niet voorkomt in cart sessievariabele voegen
                //we een OrderDetail toe aan de cart met quantity 1
                $orderDetail = $cart->getOrderDetail($id);
                if (!$orderDetail) {
                    $cart->addOrderDetail($id, 1);
                }
            }
        }
    }

    //AJAX call
    //gaat na of de ingevoerde gebruikersnaam al bestaat
    //index.php?controller=Ajax&action=validateUniqueUserName
    public function validateUniqueUserName()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['userName']) && !empty($_GET['userName'])) {

                $userName = trim($_GET['userName']);

                echo ValidationRules::isUniqueUserName($userName) ?
                    json_encode(['response' => 'true']) :
                    json_encode(['response' => 'false']);
            }
        }
    }


    //AJAX call
    //gaat na of de ingevoerde productnaam al bestaat
    //index.php?controller=Ajax&action=validateUniqueProductName
    public function validateUniqueProductName()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['productName']) && !empty($_GET['productName'])) {

                $productName = trim($_GET['productName']);

                echo ValidationRules::isUniqueProductName(
                    $productName,
                    (isset($_GET['productId']) && !empty($_GET['productId'])) ?
                        $_GET['productId'] : null) ?
                    json_encode(['response' => 'true']) :
                    json_encode(['response' => 'false']);
            }

        }
    }
}