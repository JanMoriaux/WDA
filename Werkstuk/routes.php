<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:45
 */

//http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/


function call($controller, $action){
    //Controller class require
    require_once ROOT . '/controllers/' . $controller . 'Controller.php';

    //nieuwe instantie van de Controller
    switch($controller){
        case 'Home':
            $controller = new HomeController();
            break;
        case 'Product':
            $controller = new ProductController();
            break;
        case 'Admin':
            $controller = new AdminController();
            break;
        default:
            $controller = new HomeController();
            break;
        }
    $controller->{$action}();
}



//lijst van geldige controllers en actions
$controllers  = array(
    'Home' => ['home','error'],
    'Product' => ['index','showDetail','showCategory'],
    'User' => ['index'],
    'Admin' => ['index','productOverview','editProduct','deleteProduct']
    );

//controleren of de controller en action toegestaan zijn
//indien niet, wordt de gebruiker naar de error page doorgestuurd
if(array_key_exists($controller, $controllers)){
    if(in_array($action,$controllers[$controller])){
        call($controller,$action);
    } else{
        call('Home','error');
    }
} else{
    call('Home','error');
}
?>