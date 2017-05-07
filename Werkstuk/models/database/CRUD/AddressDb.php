<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 15:10
 */
require_once ROOT . '/models/database/connection/DatabaseFactory.php';

require_once ROOT . '/models/entities/Address.php';

class AddressDb
{
    private static function getConnection()
    {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll()
    {
        $result = self::getConnection()->executeSqlQuery("SELECT * FROM TINY_CLOUDS_ADDRESSES");

        return self::getAddressArrayFromResult($result);
    }

    public static function getById($id){
        $query = 'SELECT * FROM TINY_CLOUDS_ADDRESSES WHERE id = ?';
        $parameters = array($id);

        $result = self::getConnection()->executeSqlQuery($query,$parameters);

        if ($result->num_rows == 1) {
            $product = self::convertRowToAddress($result->fetch_array());
            return $product;
        } else {
            return false;
        }
    }

    /**
     * @param $address Address
     */
    public static function insert($address){
        $query = 'INSERT INTO TINY_CLOUDS_ADDRESSES(street, number, bus, postalCode, city) VALUES ' .
            '("?",?,"?",?,"?")';
        $parameters = array(
            $address->getStreet(),
            $address->getNumber(),
            $address->getBus(),
            $address->getPostalCode(),
            $address->getCity()
        );

        self::getConnection()->executeSqlQueryWithoutClosing($query,$parameters);
        $addressId = self::getConnection()->getInsertId();
        self::getConnection()->closeDatabaseConnection();
        return $addressId;
    }

    protected static function convertRowToAddress($dbRow)
    {
        return new Address($dbRow['id'],$dbRow['street'],$dbRow['number'],$dbRow['bus'],
            $dbRow['postalCode'],$dbRow['city']);
    }

    protected static function getAddressArrayFromResult($result){
        $resultArray = array();

        for ($index = 0; $index < $result->num_rows; $index++) {
            $dbRow = $result->fetch_array();
            $product = self::convertRowToAddress($dbRow);
            $resultArray[$index] = $product;
        }

        return $resultArray;
    }




}