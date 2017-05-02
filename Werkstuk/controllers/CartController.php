<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 2/05/2017
 * Time: 8:54
 */
require_once ROOT . "/models/entities/ShoppingCart.php";
require_once ROOT . "/models/database/CRUD/ProductDb.php";
require_once ROOT . "/models/entities/User.php";


class CartController
{
    protected $currentController = 'Cart';



    /**
     * POST: index.php?controller=Cart&action=addProduct
     */
    public function addProduct()
    {

        //OrderDetail aan de cart toevoegen indien POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //werd er een id voor het toe te voegen product meegegeven?
            if (isset($_POST['id'])) {
                //sessie starten indien null
                $this->startSession();

                //indien cart nog niet bestaat een nieuwe sessievariabele aanmaken
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = new ShoppingCart();
                }
                $cart = $_SESSION['cart'];


                //indien product nog niet voorkomt in cart sessievariabele voegen
                //we een OrderDetail toe aan de cart met quantity 1
                //stock van ons product verlagen met 1
                $orderDetail = $cart->getOrderDetail($_POST['id']);
                if(!$orderDetail){
                    $cart->addOrderDetail($_POST['id'],1);
                    $product = ProductDb::getById($_POST['id']);
                    $product->setInStock($product->getInStock() - 1);
                }
            }
        }

        //terugkeren naar vorige controller en action
        $this->returnToPreviousPage();
    }

    //GET: index.php?controller=Cart&action=overview
    public function overview(){
        $this->startSession();

        //action informatie bewaren om eventueel terug te keren naar deze action
        $_SESSION['previousController'] = $this->currentController;
        $_SESSION['previousAction'] = 'overview';


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

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $this->startSession();
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

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $this->startSession();
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

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $this->startSession();
                if(isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
                    $orderDetail = $_SESSION['cart']->getOrderDetail($_POST['id']);
                    $orderDetail->removeUnit();
                }
            }
        }
        $this->returnToPreviousPage();

    }



    protected function startSession(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    protected function returnToPreviousPage(){
        $this->startSession();

        if (isset($_SESSION['previousController']) && isset($_SESSION['previousAction'])) {
            //vorige controller en action uit session halen

            $previousController = $_SESSION['previousController'];
            $previousAction = $_SESSION['previousAction'];


            //controller en action session variabelen verwijderen
            unset($_SESSION['previousController']);
            unset($_SESSION['previousAction']);

        } else {
            //indien geen sessie variabelen aanwezig keren we terug naar Homepage
            $previousController = 'Home';
            $previousAction = 'index';
        }
        //terug naar vorige view
        call($previousController, $previousAction);
    }



}