<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:53
 */
class HomeController
{
    public function home(){
        $title = 'Thuispagina';

        require_once ROOT . '/views/Home/home.php';
    }

    public function error(){
        require_once ROOT . '/views/Home/error.php';
    }
}

?>