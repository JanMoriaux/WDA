<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 14:54
 */
require_once ROOT . '/models/database/connection/DatabaseFactory.php';

require_once ROOT . '/models/entities/OrderDetail.php';

class OrderDetailDb
{

    private static function getConnection()
    {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll()
    {
        $result = self::getConnection()->executeSqlQuery("SELECT * FROM TINY_CLOUDS_ORDERDETAILS");

        return self::OrderDetailArrayFromResult($result);
    }

    public static function getByOrderId($id)
    {
        $query = 'SELECT * from TINY_CLOUDS_ORDERDETAILS WHERE orderId=?';
        $parameters = array($id);

        $result = self::getConnection()->executeSqlQuery($query,$parameters);

        return self::getOrderDetailArrayFromResult($result);
    }

    public static function getProductIds(){
        $query = 'SELECT DISTINCT productId from TINY_CLOUDS_ORDERDETAILS';

        $result = self::getConnection()->executeSqlQuery($query);

        $ids = array();

        for($index = 0; $index < $result->num_rows;$index++){
            $ids[$index] = $result->fetch_array()['productId'];
        }

        return $ids;
    }

    /**
     * @param $orderDetail OrderDetail
     */
    public static function insert($orderDetail){
        $query = 'INSERT INTO TINY_CLOUDS_ORDERDETAILS(orderId, productId, quantity) VALUES ' .
            '(?,?,?)';
        $parameters =
            array($orderDetail->getOrderId(),$orderDetail->getProductId(),$orderDetail->getQuantity());

        return self::getConnection()->executeSqlQuery($query,$parameters);

    }

    protected static function convertRowToOrderDetail($dbRow)
    {
        return new OrderDetail($dbRow['orderId'],$dbRow['productId'],$dbRow['quantity']);
    }

    protected static function getOrderDetailArrayFromResult($result){
        $resultArray = array();

        for ($index = 0; $index < $result->num_rows; $index++) {
            $dbRow = $result->fetch_array();
            $orderDetail = self::convertRowToOrderDetail($dbRow);
            $resultArray[$index] = $orderDetail;
        }

        return $resultArray;
    }






}