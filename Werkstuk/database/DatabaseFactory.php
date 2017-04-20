<?php

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
class DatabaseFactory
{
    //Singleton pattern
    private static $connection;

    public static function getConnection(){

        if(self::$verbinding == null){
            $servername = 'dtsl.ehb.be';
            $username = 'WDA098';
            $password = '71263548';
            $databasename = 'WDA098';

            self::$verbinding = new Database($servername,$username,$password,$databasename);
        }

        return self::$verbinding;
    }
}