<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:45
 */

function call($controller, $action)
{
    //Controller class require
    require_once ROOT . '/controllers/HomeController.php';
    require_once ROOT . '/controllers/' . $controller . 'Controller.php';

    //nieuwe instantie van de Controller
    switch ($controller) {
        case 'Home':
            $controller = new HomeController();
            break;
        case 'Product':
            $controller = new ProductController();
            break;
        case 'Admin':
            $controller = new AdminController();
            break;
        case 'User':
            $controller = new UserController();
            break;
        case 'Cart':
            $controller = new CartController();
            break;
        case 'Ajax':
            $controller = new AjaxController();
            break;
    }
    $controller->{$action}();
}


//lijst van geldige controllers en actions
$controllers = array(
    'Home' => ['index', 'error','contact'],
    'Product' => ['index', 'showDetail', 'showCategory'],
    'User' => ['login', 'logout', 'register'],
    'Admin' => ['index', 'productOverview', 'editProduct',
        'showProduct', 'insertProduct', 'deleteProduct',
        'categoryOverview', 'editCategory', 'insertCategory',
        'deleteCategory','orderOverview','showOrder'],
    'Cart' => ['addProduct', 'overview', 'deleteProduct', 'increaseUnits', 'decreaseUnits',
        'createOrder', 'addDeliveryAddress', 'addFacturationAddress', 'chooseDeliveryPaymentAndAcceptTerms',
        'reviewOrder','placeOrder'],
    'Ajax' => ['showCategory', 'addItemToCart', 'validateUniqueUserName', 'validateUniqueProductName']
);

//controleren of de controller en action toegestaan zijn
//indien niet, wordt de gebruiker naar de error page doorgestuurd
if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('Home', 'error');
    }
} else {
    call('Home', 'error');
}
?>