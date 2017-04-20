<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 12:57
 */
class Product
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var string
     */
    protected $image;
    /**
     * @var float
     */
    protected $price;
    /**
     * @var boolean
     */
    protected $highLighted;
    /**
     * @var int
     */
    protected $categoryId;
    /**
     * @var int
     */
    protected $inStock;
    /**
     * @var DateTime
     */
    protected $dateAdded;

    /**
     * Product constructor.
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $image
     * @param float $price
     * @param bool $highLighted
     * @param int $categoryId
     * @param int $inStock
     * @param DateTime $dateAdded
     */
    public function __construct($id, $name, $description, $image, $price, $highLighted, $categoryId, $inStock, DateTime $dateAdded)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->highLighted = $highLighted;
        $this->categoryId = $categoryId;
        $this->inStock = $inStock;
        $this->dateAdded = $dateAdded;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return bool
     */
    public function isHighLighted()
    {
        return $this->highLighted;
    }

    /**
     * @param bool $highLighted
     */
    public function setHighLighted($highLighted)
    {
        $this->highLighted = $highLighted;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return int
     */
    public function getInStock()
    {
        return $this->inStock;
    }

    /**
     * @param int $inStock
     */
    public function setInStock($inStock)
    {
        $this->inStock = $inStock;
    }

    /**
     * @return DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }






}