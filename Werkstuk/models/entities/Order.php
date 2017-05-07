<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 7:53
 */
require_once ROOT . '/models/entities/ShoppingCart.php';
require_once ROOT . '/models/entities/Address.php';

class Order
{
    /**
     * @var ShoppingCart
     */
    protected $cart;
    /**
     * @var Address
     */
    protected $deliveryAddress;
    /**
     * @var Address
     */
    protected $facturationAddress;
    /**
     * @var int
     */
    protected $deliveryMethodId;
    /**
     * @var int
     */
    protected $paymentMethodId;
    /**
     * @var boolean
     */
    protected $termsAccepted;


    public function __construct($cart)
    {
        $this->cart = $cart;

    }

    /**
     * @return ShoppingCart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param ShoppingCart $cart
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return Address
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param Address $deliveryAddress
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return Address
     */
    public function getFacturationAddress()
    {
        return $this->facturationAddress;
    }

    /**
     * @param Address $facturationAddress
     */
    public function setFacturationAddress($facturationAddress)
    {
        $this->facturationAddress = $facturationAddress;
    }

    /**
     * @return int
     */
    public function getDeliveryMethodId()
    {
        return $this->deliveryMethodId;
    }

    /**
     * @param int $deliveryMethodId
     */
    public function setDeliveryMethodId($deliveryMethodId)
    {
        $this->deliveryMethodId = $deliveryMethodId;
    }

    /**
     * @return int
     */
    public function getPaymentMethodId()
    {
        return $this->paymentMethodId;
    }

    /**
     * @param int $paymentMethodId
     */
    public function setPaymentMethodId($paymentMethodId)
    {
        $this->paymentMethodId = $paymentMethodId;
    }

    /**
     * @return bool
     */
    public function isTermsAccepted()
    {
        return $this->termsAccepted;
    }

    /**
     * @param bool $termsAccepted
     */
    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = $termsAccepted;
    }




}