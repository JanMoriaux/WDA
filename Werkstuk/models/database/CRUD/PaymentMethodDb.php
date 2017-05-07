<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 10:16
 */
require_once ROOT . '/models/database/connection/DatabaseFactory.php';

require_once ROOT . '/models/entities/PaymentMethod.php';

class PaymentMethodDb
{
    private static function getConnection()
    {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll()
    {
        $result = self::getConnection()->executeSqlQuery("SELECT * FROM TINY_CLOUDS_PAYMENT_METHODS");

        return self::getPaymentMethodArrayFromResult($result);

    }

    public static function getById($id)
    {
        $query = 'SELECT * from TINY_CLOUDS_PAYMENT_METHODS WHERE id=?';
        $parameters = array($id);

        $result = self::getConnection()->executeSqlQuery($query,$parameters);

        if ($result->num_rows == 1) {
            return self::convertRowToPaymentMethod($result->fetch_array());

        } else {
            return false;
        }
    }

    protected static function getPaymentMethodArrayFromResult($result){
        $resultArray = array();

        for ($index = 0; $index < $result->num_rows; $index++) {
            $dbRow = $result->fetch_array();
            $paymentMethod = self::convertRowToPaymentMethod($dbRow);
            $resultArray[$index] = $paymentMethod;
        }

        return $resultArray;
    }

    protected static function convertRowToPaymentMethod($dbRow)
    {
        return new PaymentMethod($dbRow['id'], $dbRow['description']);
    }
}