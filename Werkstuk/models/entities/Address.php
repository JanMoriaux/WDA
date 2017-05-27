<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/04/2017
 * Time: 13:43
 */
class Address
{
    /* @var int */
    private $id;
    /* @var string */
    private $street;
    /* @var int */
    private $number;
    /* @var string */
    private $bus;
    /* @var int */
    private $postalCode;
    /* @var string */
    private $city;

    /**
     * Address constructor.
     * @param int $id
     * @param string $street
     * @param int $number
     * @param string $bus
     * @param int $postalCode
     * @param string $city
     */
    public function __construct($id, $street, $number, $bus, $postalCode, $city)
    {
        $this->id = $id;
        $this->street = $street;
        $this->number = $number;
        $this->bus = $bus;
        $this->postalCode = $postalCode;
        $this->city = $city;
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
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getBus()
    {
        return $this->bus;
    }

    /**
     * @param string $bus
     */
    public function setBus($bus)
    {
        $this->bus = $bus;
    }

    /**
     * @return int
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param int $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param $other Address
     * @return boolean
     */
    public function compareTo($other){

        $same = true;

        if($this->getId() !== $other->getId())
            $same = false;
        if($this->getStreet() !== $other->getStreet())
            $same = false;
        if($this->getNumber() !== $other->getNumber())
            $same = false;
        if($this->getBus() !== $other->getBus())
            $same = false;
        if($this->getPostalCode() !== $other->getPostalCode())
            $same = false;
        if($this->getCity() !== $other->getCity())
            $same = false;

        return $same;
    }
}