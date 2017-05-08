<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 14:47
 */

require_once ROOT . '/models/database/CRUD/AddressDb.php';
require_once ROOT . '/models/database/CRUD/OrderDetailDb.php';
require_once ROOT . '/models/database/CRUD/ProductDb.php';
require_once ROOT . '/models/entities/Order.php';

class OrderDb
{

    private static function getConnection()
    {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll()
    {
        $result = self::getConnection()->executeSqlQuery("SELECT * FROM TINY_CLOUDS_ORDERS");

        return self::getOrderArrayFromResult($result);

    }

    public static function getById($id)
    {
        $query = 'SELECT * FROM TINY_CLOUDS_ORDERS WHERE id = ?';
        $parameters = array($id);
        $result = self::getConnection()->executeSqlQuery($query, $parameters);

        if ($result->num_rows == 1) {
            return self::convertRowToOrder($result->fetch_array());
        } else {
            return false;
        }
    }

    /**
     * @param $order Order
     */
    public static function insert($order){

        if(isset($order) && $order !== null){

            //eerst de adressen toevoegen om te voldoen aan de foreign key constraints
            $deliveryAddressId = AddressDb::insert($order->getDeliveryAddress());
            $facturationAddressId = AddressDb::insert($order->getFacturationAddress());


            //dan het order zelf toevoegen
            $query = 'INSERT INTO TINY_CLOUDS_ORDERS(userId, facturationAddressId, deliveryAddressId, deliveryMethodId, paymentMethodId, isPayed) ' .
                'VALUES(?,?,?,?,?,?)';
            $parameters = array($order->getUserId(),$facturationAddressId,$deliveryAddressId,$order->getDeliveryMethodId(),
                $order->getPaymentMethodId(),(int)$order->isPayed());

            self::getConnection()->executeSqlQueryWithoutClosing($query,$parameters);
            $orderId = self::getConnection()->getInsertId();
            self::getConnection()->closeDatabaseConnection();

            //daarna alle orderdetails toevoegen en product stock aanpassen
            foreach($order->getCart()->getOrderDetails() as $orderDetail){
                $orderDetail->setOrderId($orderId);
                ProductDb::updateStock($orderDetail->getProductId(),-$orderDetail->getQuantity());
                OrderDetailDb::insert($orderDetail);
            }

            return $orderId;
        }
    }

    //mapping voor Order lijn in db naar Order object
    //opvragen van alle orderdetails en in de $cart property
    //opvragen van facturationAddress en deliveryAddress
    protected static function convertRowToOrder($dbRow)
    {
        $order =  new Order($dbRow['id'], $dbRow['userId'], null, null, null,
            $dbRow['deliveryMethodId'], $dbRow['paymentMethodId'], true,(boolean)$dbRow['isPayed'], new DateTime($dbRow['dateOrdered']));

        //alle orderlijnen toevoegen aan het order
        $order->setCart(new ShoppingCart());
        $orderDetails = OrderDetailDb::getByOrderId($order->getId());
        foreach($orderDetails as $orderDetail){
            $order->getCart()->addOrderDetail($orderDetail->getProductId(),$orderDetail->getQuantity());
        }

        //adressen aan het order toevoegen
        $facturationAddress = AddressDb::getById($dbRow['facturationAddressId']);
        $deliveryAddressId = AddressDb::getById($dbRow['deliveryAddressId']);
        $order->setFacturationAddress($facturationAddress);
        $order->setDeliveryAddress($deliveryAddressId);

        return $order;
    }

    protected static function getOrderArrayFromResult($result){
        $resultArray = array();

        for ($index = 0; $index < $result->num_rows; $index++) {
            $dbRow = $result->fetch_array();
            $order = self::convertRowToOrder($dbRow);
            $resultArray[$index] = $order;
        }

        return $resultArray;
    }
}