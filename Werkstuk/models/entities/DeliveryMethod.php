<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 10:06
 */
class DeliveryMethod
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var float
     */
    protected $price;

    /**
     * DeliveryMethod constructor.
     * @param int $id
     * @param string $description
     * @param float $price
     */
    public function __construct($id, $description,$price)
    {
        $this->id = $id;
        $this->description = $description;
        $this->price = $price;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * return float
     */
    public function getPrice(){
        return $this->price;
    }

}