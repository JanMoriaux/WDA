<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 2/05/2017
 * Time: 9:18
 */
require_once ROOT  . '/models/database/CRUD/ProductDb.php';

class OrderDetail
{
    /**
     * @var int
     */
    protected $productId;
    /**
     * @var int
     */
    protected $quantity;

    /**
     * OrderDetail constructor.
     * @param int $productId
     * @param int $quantity
     */
    public function __construct($productId, $quantity)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity het aantal producten van het OrderDetail op een bepaalde waarde (> 0) zetten
     */
    public function setQuantity($quantity)
    {
        if ($quantity >= 0){
            $this->quantity = $quantity;
        }
        else{
            $this->quantity = 0;
        }
    }

    /**
     * aantal producten van het OrderDetail met één verhogen
     */
    public function addUnit()
    {
        $this->quantity++;
    }

    /**
     * aantal producten van het OrderDetail met één verlagen (minimum nul)
     */
    public function removeUnit()
    {
        if ($this->quantity > 0) {
            $this->quantity--;
        }
    }

    //todo delete
//    /**
//     * @return float subtotaal voor het orderDetail
//     */
//    public function getSubtotal(){
//        return ProductDb::getById($this->productId)->getPrice() * $this->quantity;
//    }


}