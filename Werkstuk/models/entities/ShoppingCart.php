<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 2/05/2017
 * Time: 9:17
 */
require_once ROOT . '/models/entities/OrderDetail.php';

class ShoppingCart
{
    /**
     * @var array van OrderDetail objecten
     * wordt opgeslagen als associatieve array met key = productId en value = orderDetail
     */
    protected $orderDetails;

    /**
     * ShoppingCart constructor.
     *
     */
    public function __construct()
    {
        $this->orderDetails = array();
    }

    /**
     * @return array
     */
    public function getOrderDetails()
    {
        return $this->orderDetails;
    }



    /**
     * @param $id int $productId van het OrderDetail object
     * @return bool|OrderDetail het OrderDetail indien aanwezig en false indien niet
     */
    public function getOrderDetail($id)
    {
        if (isset($this->orderDetails[$id]))
            return $this->orderDetails[$id];
        else
            return false;
    }

    public function addOrderDetail($productId,$quantity){
        $orderDetail = new OrderDetail(null,$productId,$quantity);
        $this->orderDetails[$productId] = $orderDetail;
    }

    /**
     * @param $id
     * @return bool true indien OrderDetail aanwezig was en false indien niet
     */
    public function removeOrderDetail($id)
    {
        if (isset($this->orderDetails[$id])){
            unset($this->orderDetails[$id]);
            return true;
        }
        return false;
    }

}