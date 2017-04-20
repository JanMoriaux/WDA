<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/04/2017
 * Time: 13:43
 */
require_once 'Address.php';

class User
{
    /* @var int */
    protected $id;
    /* @var string */
    protected $firstName;
    /* @var string */
    protected $lastName;
    /* @var string */
    protected $userName;
    /* @var string */
    protected $password;
    /* @var string */
    protected $email;
    /* @var Address */
    protected $facturationAddress;
    /* @var Address */
    protected $deliveryAddress;
    /* @var boolean */
    protected $admin;

    /**
     * User constructor.
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $userName
     * @param string $password
     * @param string $email
     * @param Address $facturationAddress
     * @param Address $deliveryAddress
     * @param bool $isAdmin
     */
    public function __construct($id, $firstName, $lastName, $userName,
                                $password, $email, Address $facturationAddress,
                                Address $deliveryAddress, $admin)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->password = $password;
        $this->email = $email;
        $this->facturationAddress = $facturationAddress;
        $this->deliveryAddress = $deliveryAddress;
        $this->admin = $admin;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * @return bool
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }


}