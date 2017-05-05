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
require_once ROOT . '/models/validation/ProductValidator.php';

class AjaxController extends Controller
{
    //AJAX call: GET geeft id van de category mee
    //geeft html met productOverview terug
    public function showCategory()
    {

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $categoryId = $_GET['id'];

            $products = ProductDb::getByCategoryId($_GET['id']);

        } else {

            $products = ProductDb::getAll();

        }

        echo include_once ROOT . '/views/product/index.php';

    }

    //AJAX call: POST voegt één eenheid van een bepaald product toe aan het winkelmandje
    public function addItemToCart()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->startSession();

            if (isset($_POST['id']) && !empty($_POST['id'])) {

                echo 'in postcheck';

                //indien cart nog niet bestaat een nieuwe sessievariabele aanmaken
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = new ShoppingCart();
                }
                $cart = $_SESSION['cart'];

                //indien product nog niet voorkomt in cart sessievariabele voegen
                //we een OrderDetail toe aan de cart met quantity 1
                $orderDetail = $cart->getOrderDetail($_POST['id']);
                if (!$orderDetail) {
                    $cart->addOrderDetail($_POST['id'], 1);
                }
            }
        }
    }

}