<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 19/04/2017
 * Time: 11:05
 */

/**
 * Class ValidationRules
 *
 */
class ValidationRules
{
    //algemene validatie (zie ook ObjectValidator class):

    //verplichte velden
    public static function valueProvided($requiredValue){
        if(!isset($requiredValue) || empty($requiredValue)){
            return false;
        }
        return true;
    }

    //numerieke velden
    public static function isNumeric($numericValue){
        //verander decimale komma in decimaal punt
        $numericValue = str_replace(',','.',$numericValue);
        if(!is_numeric($numericValue)){
            return false;
        }
        return true;
    }



    //positieve gehele getallen, bijvoorbeeld postcode, id's, ...
    //http://php.net/manual/en/function.is-numeric.php
    public static function isStrictPosInt($integer){
        //numeriek veld?
        if(!self::isNumeric($integer)){
            return false;
        }
        $integer = $integer + 0;
        if(!is_integer($integer) || $integer <= 0){
            return false;
        }
        return true;
    }
    //min en max van getallen, bv. postcode tussen 1000 en 9999
    public static function hasValidBoundariesIncl($number,$min,$max){
        if($number >= $min && $number <= $max){
            return true;
        }
        return false;
    }
    //min en maximum lengte van strings
    public static function hasValidLength($string,$min,$max){
        if(strlen($string) >= $min && strlen($string) <= $max){
            return true;
        }
        return false;
    }

    //namen (bv. voornaam, achternaam, straatnaam,..): bevatten geen getallen,
    //maar kunnen wel accenten, apostrofes, hyphens,.. bevatten
    //
    //http://stackoverflow.com/questions/5963228/regex-for-names-with-special-characters-unicode
    public static function isValidName($name){

        $regex = '~^(?:[\p{L}\p{Mn}\p{Pd}\'\x{2019}\s])+$~u';

        if(preg_match($regex,$name)){
            return true;
        }
        return false;
    }

    //Address validatie
    //
    //busnummer bevat 1 tot 3 letters
    public static function isValidBusNumber($bus){
        //busnumber contains from 1 to 3 letters
        $regex = '/^[a-zA-Z]{1,3}/';

        return preg_match($regex, $bus);
    }

    //User validatie
    //
    //gebruikersnaam
    //gebruikersnaam van 3 tot 15 karakters, alfanumerieke karakters, underscore en hyphen
    //https://www.mkyong.com/regular-expressions/how-to-validate-username-with-regular-expression/
    //
    public static function isValidUserName($userName){
        $regex = '/^[a-zA-Z0-9_-]{3,15}$/';
        echo preg_match($regex, $userName);
        return preg_match($regex, $userName);
    }
    //wachtwoord
    //http://stackoverflow.com/questions/2370015/regular-expression-for-password-validation
    //wachtwoord bevat minstens 8 karakters en maximaal 16 karakters, één cijfer, één letter en één karakter uit [!#$%&?]
    public static function isValidPassword($password){
        $regex = '/^.*(?=.{8,16})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&? "]).*$/';
        return preg_match($regex, $password);
    }
    //email adres
    ////http://emailregex.com/
    public static function isValidEmailAddress($email){
        $regex = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
        return preg_match($regex, $email);
    }
    //TODO validatie voor unieke username (na database CRUD voor user)
}