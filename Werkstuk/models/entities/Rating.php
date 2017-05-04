<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 4/05/2017
 * Time: 12:35
 */
class Rating
{
    /**
     * @var int
     */
    protected $productId;
    /**
     * @var int
     */
    protected $userId;
    /**
     * @var int
     */
    protected $ratingValue;
    /**
     * @var string
     */
    protected $comment;

    /**
     * @var DateTime
     */
    protected $dateRated;

    /**
     * Rating constructor.
     * @param int $productId
     * @param int $userId
     * @param int $ratingValue
     * @param string $comment
     */
    public function __construct($productId, $userId, $ratingValue, $comment,$dateRated)
    {
        $this->productId = $productId;
        $this->userId = $userId;
        $this->ratingValue = $ratingValue;
        $this->comment = $comment;
        $this->dateRated = $dateRated;
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
    public function getUserId()
    {
        return $this->userId;
    }


    /**
     * @return int
     */
    public function getRatingValue()
    {
        return $this->ratingValue;
    }

    /**
     * @param int $ratingValue
     */
    public function setRatingValue($ratingValue)
    {
        $this->ratingValue = $ratingValue;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return DateTime
     */
    public function getDateRated()
    {
        return $this->dateRated;
    }

    /**
     * @param DateTime $dateRated
     */
    public function setDateRated($dateRated)
    {
        $this->dateRated = $dateRated;
    }

}