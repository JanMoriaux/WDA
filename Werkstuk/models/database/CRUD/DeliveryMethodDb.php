<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 10:15
 */
require_once ROOT . '/models/database/connection/DatabaseFactory.php';

require_once ROOT . '/models/entities/DeliveryMethod.php';

class DeliveryMethodDb
{
    private static function getConnection()
    {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll()
    {
        $result = self::getConnection()->executeSqlQuery("SELECT * FROM TINY_CLOUDS_DELIVERY_METHODS");

        return self::getDeliveryMethodArrayFromResult($result);

    }

    public static function getById($id)
    {
        $query = 'SELECT * from TINY_CLOUDS_DELIVERY_METHODS WHERE id=?';
        $parameters = array($id);

        $result = self::getConnection()->executeSqlQuery($query,$parameters);

        if ($result->num_rows == 1) {
            return self::convertRowToDeliveryMethod($result->fetch_array());

        } else {
            return false;
        }
    }

    protected static function getDeliveryMethodArrayFromResult($result){
        $resultArray = array();

        for ($index = 0; $index < $result->num_rows; $index++) {
            $dbRow = $result->fetch_array();
            $paymentMethod = self::convertRowToDeliveryMethod($dbRow);
            $resultArray[$index] = $paymentMethod;
        }
        return $resultArray;
    }

    protected static function convertRowToDeliveryMethod($dbRow)
    {
        return new DeliveryMethod($dbRow['id'], $dbRow['description'],$dbRow['price']);
    }


}