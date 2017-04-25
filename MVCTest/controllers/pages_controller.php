<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 3/04/2017
 * Time: 16:58
 */
class PageController
{
    public function home(){
        $first_name = 'Jon';
        $last_name = 'Snow';
        require_once('views/pages/index.php');
    }

    public function error(){
        require_once('views/pages/error.php');
    }

}