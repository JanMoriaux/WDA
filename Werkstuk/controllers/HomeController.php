<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:53
 */
class HomeController
{
    public function index(){
        $title = 'Thuispagina';
        $view = ROOT . '/views/Home/index.php';

        require_once ROOT . '/views/layout.php';

    }

    public function error(){
        $title = 'Fout';
        $view = ROOT . '/views/Home/error.php';

        require_once ROOT . '/views/layout.php';
    }
}

?>