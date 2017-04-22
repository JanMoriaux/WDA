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
    //Algemeen

    /**
     * @param $requiredValue
     * @return bool
     * Validatie van verplichte velden
     */
    public static function valueProvided($requiredValue){
        //validatie voor correcte waarde 0
        if(self::isNumeric($requiredValue)){
            return true;
        }
        if(!isset($requiredValue) || empty($requiredValue)){
            return false;
        }
        return true;
    }

    /**
     * @param $numericValue
     * @return bool
     * Validatie van numerieke velden
     * Verandert decimale komma in decimaal punt
     */
    public static function isNumeric($numericValue){
        $numericValue = str_replace(',','.',$numericValue);
        if(!is_numeric($numericValue)){
            return false;
        }
        return true;
    }

    /**
     * @param $integer
     * @return bool
     * Validatie van strikt positief gehele getallen
     */
    public static function isStrictPosInt($integer){
        if(!self::isNumeric($integer)){
            return false;
        }
        $integer = $integer + 0;
        if(!is_integer($integer) || $integer <= 0){
            return false;
        }
        return true;
    }

    /**
     * @param $number
     * @param $min
     * @param $max
     * @return bool
     * Validatie van getallen tussen minimum en maximumwaarden (inclusief)
     */
    public static function hasValidBoundariesIncl($number,$min,$max){
        if(!self::isNumeric($number)){
            return false;
        }
        if($number >= $min && $number <= $max){
            return true;
        }
        return false;
    }

    /**
     * @param $string
     * @param $min
     * @param $max
     * @return bool
     * Validatie van strings met een maximum en minimum lengte (inclusief)
     */
    public static function hasValidLength($string,$min,$max){
        if(strlen($string) >= $min && strlen($string) <= $max){
            return true;
        }
        return false;
    }

    /**
     * @param $name
     * @return bool
     * Validatie van namen
     * $regex van http://stackoverflow.com/questions/5963228/regex-for-names-with-special-characters-unicode
     * namen (bv. voornaam, achternaam, straatnaam,..): bevatten geen getallen,
     * maar kunnen wel accenten, apostrofes, hyphens,.. bevatten
     */
    public static function isValidName($name){

        $regex = '~^(?:[\p{L}\p{Mn}\p{Pd}\'\x{2019}\s])+$~u';

        if(preg_match($regex,$name)){
            return true;
        }
        return false;
    }

    //Address

    //busnummer bevat 1 tot 3 letters
    /**
     * @param $bus
     * @return int
     * Validatie van busnummer
     * Busnummer bevat één tot drie letters
     */
    public static function isValidBusNumber($bus){
        $regex = '/^[a-zA-Z]{1,3}$/';
        return preg_match($regex, $bus);
    }

    //User

    /**
     * @param $userName
     * @return int
     * Validatie van gebruikersnaam
     * $regex van https://www.mkyong.com/regular-expressions/how-to-validate-username-with-regular-expression/
     * gebruikersnaam van 3 tot 15 karakters, alfanumerieke karakters, underscore en koppelteken
     */
    public static function isValidUserName($userName){
        $regex = '/^[a-zA-Z0-9_-]{3,15}$/';
        echo preg_match($regex, $userName);
        return preg_match($regex, $userName);
    }

    /**
     * @param $password
     * @return int
     * Validatie van wachtwoorden
     * $regex van http://stackoverflow.com/questions/2370015/regular-expression-for-password-validation
     * wachtwoord bevat minstens 8 karakters en maximaal 16 karakters, één cijfer, één letter en één karakter uit [!#$%&?]
     */
    public static function isValidPassword($password){
        $regex = '/^.*(?=.{8,16})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&? "]).*$/';
        return preg_match($regex, $password);
    }

    /**
     * @param $email
     * @return int
     * Validatie van email adressen
     * $regex van http://emailregex.com/
     */
    public static function isValidEmailAddress($email){
        $regex = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
        return preg_match($regex, $email);
    }

    //TODO validatie voor unieke username (na database CRUD voor user)


    //Product

    /**
     * @param $filename
     * @return int
     * Validatie van image files
     * $regex van http://stackoverflow.com/questions/29732756/how-to-validate-image-file-extension-with-regular-expression-using-javascript
     */
    public static function isValidImageFileName($filename){
        $regex = '/\.(jpe?g|png|gif|bmp)$/i';
        return preg_match($regex,$filename);
    }


}