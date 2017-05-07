<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 10:04
 */
class PaymentMethod
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
     * PaymentMethod constructor.
     * @param int $id
     * @param string $description
     */
    public function __construct($id, $description)
    {
        $this->id = $id;
        $this->description = $description;
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
}