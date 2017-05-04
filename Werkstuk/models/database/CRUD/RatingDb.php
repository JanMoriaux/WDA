<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 4/05/2017
 * Time: 12:57
 */

require_once ROOT . '/models/entities/Rating.php';
class RatingDb
{
    private static function getConnection()
    {
        return DatabaseFactory::getDatabase();
    }

    //alle ratings van een bepaald product
    public static function getByProductId($id)
    {
        $query = "SELECT * FROM TINY_CLOUDS_RATINGS WHERE productId = ?";
        $parameters = array($id);

        $result = self::getConnection()->executeSqlQuery($query, $parameters);

        if ($result->num_rows > 0) {
            return self::getRatingArrayFromResult($result);
        } else {
            return false;
        }
    }

    //alle ratings van een bepaalde user
    public static function getByUserId($id)
    {
        $query = "SELECT * FROM TINY_CLOUDS_RATINGS WHERE userId = ?";
        $parameters = array($id);

        $result = self::getConnection()->executeSqlQuery($query, $parameters);

        if ($result->num_rows > 0) {
            return self::getRatingArrayFromResult($result);
        } else {
            return false;
        }
    }

    //rating van een bepaalde user voor een bepaald product
    public static function getByUserIdAndProductId($userId,$productId){

        $query = "SELECT * FROM TINY_CLOUDS_RATINGS WHERE userId = ? AND productId = ?";
        $parameters = array($userId,$productId);

        $result = self::getConnection()->executeSqlQuery($query, $parameters);

        if ($result && $result->num_rows == 1) {
            $product = self::convertRowToRating($result->fetch_array());
            return $product;
        } else {
            return false;
        }
    }

    /**
     * @param $rating Rating
     * @return array|bool
     */
    public static function insert($rating)
    {
        $query = "INSERT INTO TINY_CLOUDS_RATINGS(productId, userId, ratingValue, comment) VALUES " .
        "(?,?,?,'?')";

        $parameters = array(
            $rating->getProductId(),
            $rating->getUserId(),
            $rating->getRatingValue(),
            $rating->getComment()
        );

        return self::getConnection()->executeSqlQuery($query,$parameters);
    }



    protected static function convertRowToRating($dbRow)
    {
        return new Rating($dbRow['productId'],
            $dbRow['userId'],
            $dbRow['ratingValue'],
            $dbRow['comment'],
            new DateTime($dbRow['dateRated']));
    }

    protected static function getRatingArrayFromResult($result){
        $resultArray = array();

        for ($index = 0; $index < $result->num_rows; $index++) {
            $dbRow = $result->fetch_array();
            $rating = self::convertRowToRating($dbRow);
            $resultArray[$index] = $rating;
        }

        return $resultArray;
    }


}