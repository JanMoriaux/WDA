<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:38
 */

define('ROOT', __DIR__);


require_once ROOT . '/models/entities/ShoppingCart.php';
require_once ROOT . '/models/entities/Product.php';
require_once ROOT . '/models/entities/User.php';
require_once ROOT . '/models/entities/Order.php';
require_once ROOT . '/models/database/CRUD/UserDb.php';

//controleren op 'keeploggedin' cookie en eventueel verlengen
if (isset($_COOKIE['keeploggedin'])) {
    $cookieValue = $_COOKIE['keeploggedin'];
    $userName = explode(':', $cookieValue)[0];
    $password = explode(':', $cookieValue)[1];

    if ($user = UserDb::getByUsernameAndPassword($userName, $password)) {
        session_start();
        $_SESSION['user'] = $user;

        setcookie('keeploggedin',
            "{$user->getUserName()}:{$user->getPassword()}",
            time() + 60 * 60 * 24 * 7);
    };
}

//TODO reference http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'Home';
    $action = 'index';
}

require_once ROOT . '/routes.php';