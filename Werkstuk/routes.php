<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:45
 */

//http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/


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
    'Home' => ['index', 'error'],
    'Product' => ['index', 'showDetail', 'showCategory'],
    'User' => ['login', 'logout','register'],
    'Admin' => ['index', 'productOverview', 'editProduct',
        'showProduct', 'insertProduct', 'deleteProduct',
        'categoryOverview','editCategory','insertCategory',
        'deleteCategory'],
    'Cart' => ['addProduct','overview','deleteProduct','increaseUnits','decreaseUnits'],
    'Ajax' => ['showCategory','addItemToCart','insertProduct']
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