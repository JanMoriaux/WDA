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
require_once ROOT . '/models/database/CRUD/UserDb.php';
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

            $deliveryAddressId = $facturationAddressId =  null;
            $updateUserDeliveryAddressId = $updateUserFacturationAddressId = true;

            // nagaan of de address id aanwezig zijn
            //leveringsadres
            if(!empty($order->getDeliveryAddress()->getId())){ //er is een id aanwezig -> address al in db

                $storedAddress = AddressDb::getById($order->getDeliveryAddress()->getId());
                if(!$storedAddress->compareTo($order->getDeliveryAddress())){ //wijzigingen aangebracht => nieuw address in db

                    $deliveryAddressId = AddressDb::insert($order->getDeliveryAddress());

                } else{ //waarden die al in db zitten komen overeen met waarden in bestelling
                    $updateUserDeliveryAddressId = false;
                    $deliveryAddressId = $order->getDeliveryAddress()->getId();
                }
            } else{ //geen id aanwezig => nieuw address in db

                $deliveryAddressId = AddressDb::insert($order->getDeliveryAddress());
            }

            //facturatieadres
            if(!empty($order->getFacturationAddress()->getId())){ //er is een id aanwezig -> address al in db

                $storedAddress = AddressDb::getById($order->getFacturationAddress()->getId());

                if(!$storedAddress->compareTo($order->getFacturationAddress())){ //wijzigingen aangebracht => nieuw address in db

                    $facturationAddressId = AddressDb::insert($order->getFacturationAddress());

                } else{ //waarden die al in db zitten komen overeen met waarden in bestelling
                    $updateUserFacturationAddressId = false;
                    $facturationAddressId = $order->getFacturationAddress()->getId();
                }
            } else{ //geen id aanwezig => nieuw address in db

                $facturationAddressId = AddressDb::insert($order->getFacturationAddress());
            }

            //id  van de addressen in user table
            if($updateUserDeliveryAddressId || $updateUserDeliveryAddressId)
                UserDB::updateAddressIds($deliveryAddressId,$facturationAddressId,$order->getUserId());

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