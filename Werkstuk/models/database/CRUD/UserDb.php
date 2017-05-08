<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/04/2017
 * Time: 14:22
 */
require_once ROOT . '/models/database/connection/DatabaseFactory.php';
require_once ROOT . '/models/entities/User.php';


class UserDb
{
    private static function getConnection()
    {
        return DatabaseFactory::getDatabase();

    }

    /**
     * @return array met alle users uit de users tabel
     */
    public static function getAll()
    {
        $result = self::getConnection()->executeSqlQuery("SELECT * FROM TINY_CLOUDS_USERS");


        return self::getUserArrayFromResult($result);

    }

    /**
     * @param $id
     * @return bool|User false indien id niet teruggevonden en de User met id = $id indien aanwezig
     */
    public static function getById($id)
    {
        $query = 'SELECT * FROM TINY_CLOUDS_USERS WHERE id = ?';
        $parameters = array($id);
        $result = self::getConnection()->executeSqlQuery($query, $parameters);

        if ($result->num_rows == 1) {
            $user = self::convertRowToUser($result->fetch_array());
            return $user;
        } else {
            return false;
        }
    }

    /**
     * @param $username
     * @param $password
     * @return bool|User de user met $username en $password of false indien niet gevonden
     */
    public static function getByUsernameAndPassword($username,$password)
    {
        $query = "SELECT * FROM TINY_CLOUDS_USERS WHERE username='?' AND password='?'";
        $parameters = array($username,$password);
        $result = self::getConnection()->executeSqlQuery($query, $parameters);

        if ($result->num_rows == 1) {
            $user = self::convertRowToUser($result->fetch_array());
            return $user;
        } else {
            return false;
        }

    }

    /**
     * @return array met alle userName-waarden in de users tabel
     */
    public static function getUserNames()
    {
        $query = 'SELECT userName FROM TINY_CLOUDS_USERS';

        $result = self::getConnection()->executeSqlQuery($query);

        $names = array();

        for ($index = 0; $index < $result->num_rows; $index++) {
            $names[$index] = $result->fetch_array()['userName'];
        }

        return $names;
    }

    /**
     * @param $user User object dat wordt opgeslagen in db
     * @return bool|mysqli_result true indien opgeslagen, false indien userName niet uniek is
     * of niet wordt voldaan aan FK constraints voor address id's
     */
    public static function insertWithoutAddressIds($user)
    {

        if (in_array($user->getUserName(), self::getUserNames())) {
            return false;
        }

        $parameters = array(
            $user->getFirstName(), $user->getLastName(), $user->getUserName(), $user->getPassword(),
            $user->getEmail(), (int)$user->isAdmin());
        $query =
            "INSERT INTO TINY_CLOUDS_USERS(firstName, lastName, userName, password, email, facturationAdressId, deliveryAddressId,isAdmin) " .
            "VALUES ('?','?','?','?','?',NULL,NULL,?)";



        return self::getConnection()->executeSqlQuery($query, $parameters);
    }
//
//    /**
//     * @param $user User object dat wordt aangepast in db
//     * @return bool|mysqli_result true indien aangepast, false indien userName niet uniek is of niet wordt voldaan aan
//     * FK constraints voor address id's
//     */
//    public static function update($user)
//    {
//        if (in_array($user->getUserName(), self::getUserNames())) {
//            return false;
//        }
//        //TODO foreign key constraints op address id's
//
//        $query = "UPDATE TINY_CLOUDS_USERS SET firstName='?',lastName='?',userName='?',password='?',email='?'," .
//            "facturationAdressId=?,deliveryAddressId=?,isAdmin= ? WHERE id=?";
//
//        $parameters = array(
//            $user->getFirstName(), $user->getLastName(), $user->getUserName(), $user->getPassword(), $user->getEmail(), $user->getFacturationAddressId(),
//            $user->getDeliveryAddressId(), (int)$user->isAdmin());
//
//        return self::getConnection()->executeSqlQuery($query, $parameters);
//    }

//    /**
//     * @param $id int het id-nummer van de te verwijderen user
//     * @return mysqli_result true indien verwijderd, false indien niet verwijderd (door bv. FK constraints
//     * vanuit de orders tabel)
//     */
//    public static function deleteById($id)
//    {
//
//        $query = "DELETE FROM TINY_CLOUDS_USERS WHERE id = ?";
//        $parameters = array($id);
//        return self::getConnection()->executeSqlQuery($query, $parameters);
//    }

//    /**
//     * @param $user User de te verwijderen user
//     * @return mysqli_result true indien verwijderd, false indien niet verwijderd (door bv. FK constraints
//     * vanuit de orders tabel)
//     */
//    public static function delete($user)
//    {
//        return self::deleteById($user->getId());
//
//    }

    /**
     * @return array van alle address ids die gekoppeld zijn aan een user in de database
     * nodig voor FK constraints
     */
    public static function getAddressIds()
    {
        $result =
            self::getConnection()->executeSqlQuery("SELECT addressId FROM (SELECT facturationAdressId FROM TINY_CLOUDS_USERS" .
                " UNION SELECT deliveryAddressId FROM TINY_CLOUDS_USERS) AS addressIds(addressId)");
        $addressIds = array();
        FOR ($index = 0; $index < $result->num_rows; $index++) {
            $addressIds[$index] = $result->fetch_array()['addressId'];
        }
        return $addressIds;
    }

    /**
     * @param $dbRow
     * @return User
     */
    protected static function convertRowToUser($dbRow)
    {
        return new User($dbRow['id'], $dbRow['firstName'], $dbRow['lastName'], $dbRow['userName'], $dbRow['password'],
            $dbRow['email'], $dbRow['facturationAdressId'], $dbRow['deliveryAddressId'], $dbRow['isAdmin']);
    }

    /**
     * @param $result $mysqli_result
     * @return array een array met users
     */
    protected static function getUserArrayFromResult($result)
    {
        $resultArray = array();

        for ($index = 0; $index < $result->num_rows; $index++) {
            $dbRow = $result->fetch_array();
            $user = self::convertRowToUser($dbRow);
            $resultArray[$index] = $user;
        }

        return $resultArray;
    }

}