<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 3/04/2017
 * Time: 16:39
 */
class Db
{
    private static $instance = NULL;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new mysqli('dtsl.ehb.be','WDA098','71263548','WDA098');
        }
        return self::$instance;
}


}


?>