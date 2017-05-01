<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:38
 */

define('ROOT', __DIR__);

//TODO reference http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/

if(isset($_GET['controller']) && isset($_GET['action'])){
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else{
    $controller = 'Home';
    $action = 'index';
}

require_once ROOT . '/routes.php';