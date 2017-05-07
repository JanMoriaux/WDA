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
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $userId;

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
    /**
     * @var boolean
     */
    protected $payed;
    /**
     * @var DateTime
     */
    protected $dateOrdered;

    /**
     * Order constructor.
     * @param int $id
     * @param int $userId
     * @param ShoppingCart $cart
     * @param Address $deliveryAddress
     * @param Address $facturationAddress
     * @param int $deliveryMethodId
     * @param int $paymentMethodId
     * @param bool $termsAccepted
     * @param bool $payed
     * @param DateTime $dateOrdered
     */
    public function __construct($id, $userId, ShoppingCart $cart, Address $deliveryAddress, Address $facturationAddress, $deliveryMethodId, $paymentMethodId, $termsAccepted, $payed, DateTime $dateOrdered)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->cart = $cart;
        $this->deliveryAddress = $deliveryAddress;
        $this->facturationAddress = $facturationAddress;
        $this->deliveryMethodId = $deliveryMethodId;
        $this->paymentMethodId = $paymentMethodId;
        $this->termsAccepted = $termsAccepted;
        $this->payed = $payed;
        $this->dateOrdered = $dateOrdered;
    }

    /**
     * @return bool
     */
    public function isPayed()
    {
        return $this->payed;
    }

    /**
     * @param bool $payed
     */
    public function setPayed($payed)
    {
        $this->payed = $payed;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }



    /**
     * @return DateTime
     */
    public function getDateOrdered()
    {
        return $this->dateOrdered;
    }

    /**
     * @param DateTime $dateOrdered
     */
    public function setDateOrdered($dateOrdered)
    {
        $this->dateOrdered = $dateOrdered;
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