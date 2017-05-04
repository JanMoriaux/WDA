<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 2/05/2017
 * Time: 8:54
 */
require_once ROOT . '/controllers/Controller.php';


class CartController extends Controller
{
    protected $currentController = 'Cart';



    /**
     * POST: index.php?controller=Cart&action=addProduct
     */
    public function addProduct()
    {
        $this->setControllerAndActionSessionVariables('addProduct');

        //OrderDetail aan de cart toevoegen indien POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //werd er een id voor het toe te voegen product meegegeven?
            if (isset($_POST['id'])) {

                //indien cart nog niet bestaat een nieuwe sessievariabele aanmaken
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = new ShoppingCart();
                }
                $cart = $_SESSION['cart'];

                //indien product nog niet voorkomt in cart sessievariabele voegen
                //we een OrderDetail toe aan de cart met quantity 1
                $orderDetail = $cart->getOrderDetail($_POST['id']);
                if(!$orderDetail){
                    $cart->addOrderDetail($_POST['id'],1);
                }
            }
        }

        //terugkeren naar vorige controller en action
        $this->returnToPreviousPage();
    }

    //GET: index.php?controller=Cart&action=overview
    public function overview(){

        $this->setControllerAndActionSessionVariables('overview');

        //title en sidebar
        $title = 'Overzicht Winkelmandje';
        $categorySidebar = true;

        //associatieve array met keys= producten in cart en values=hoeveelheden
        $orderDetails = array();
        if(isset($_SESSION['cart']) && $_SESSION['cart']){

            $cart = $_SESSION['cart'];
            $orderDetails = $cart->getOrderDetails();

        }

        $view = ROOT . '/views/Cart/overview.php';
        require_once ROOT . '/views/layout.php';
    }

    //POST: index.php?controller=Cart&action=deleteProduct
    //product verwijderen uit winkelmandje
    public function deleteProduct(){

        $this->setControllerAndActionSessionVariables('deleteProduct');

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['id']) && !empty($_POST['id'])){

                if(isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
                    $_SESSION['cart']->removeOrderDetail($_POST['id']);
                }

            }
        }

        $this->returnToPreviousPage();
    }

    //POST: index.php?controller=Cart&action=increaseUnits
    //aantal eenheden van een bepaald product in cart vermeerderen
    public function increaseUnits(){

        $this->setControllerAndActionSessionVariables('increaseUnits');

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['id']) && !empty($_POST['id'])){

                if(isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
                    $orderDetail = $_SESSION['cart']->getOrderDetail($_POST['id']);
                    $orderDetail->addUnit();
                }

            }
        }

        $this->returnToPreviousPage();
    }

    //POST: index.php?controller=Cart&action=decreaseUnits
    //aantal eenheden van een bepaald product in cart verlagen
    public function decreaseUnits(){

        $this->setControllerAndActionSessionVariables('decreaseUnits');

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['id']) && !empty($_POST['id'])){

                if(isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
                    $orderDetail = $_SESSION['cart']->getOrderDetail($_POST['id']);
                    $orderDetail->removeUnit();
                }

            }
        }
        $this->returnToPreviousPage();

    }

}