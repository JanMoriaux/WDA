71263548<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/04/2017
 * Time: 13:38
 *
 * English version of the DatabaseFactory class from the solutions of the Web Development Advanced class workshops (part 4).
 * Original author (dutch version): Frauke Vanderzijpe
 *
 *
 */
require_once ROOT . '/models/database/connection/Database.php';

class DatabaseFactory
{
    //Singleton pattern
    private static $connection;

    public static function getDatabase(){

        if(self::$connection == null){
            $servername = '';
            $username = '';
            $password = '71263548';
            $databasename = '';

            self::$connection = new Database($servername,$username,$password,$databasename);
        }

        return self::$connection;
    }
}
