<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 21:10
 */

require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/WDA/Werkstuk/models/database/connection/DatabaseFactory.php';
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/WDA/Werkstuk/models/entities/Product.php';

class ProductDb
{
    private static function getConnection()
    {
        return DatabaseFactory::getDatabase();
    }

    //alle producten uit db
    public static function getAll()
    {
        $result = self::getConnection()->executeSqlQuery("SELECT * FROM TINY_CLOUDS_PRODUCTS");
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $dbRow = $result->fetch_array();
            $product = self::convertRowToProduct($dbRow);
            $resultArray[$index] = $product;
        }
        return $resultArray;
    }

    //product op id uit db
    public static function getById($id)
    {
        $query = 'SELECT * FROM TINY_CLOUDS_PRODUCTS WHERE id = ?';
        $parameters = array($id);
        $result = self::getConnection()->executeSqlQuery($query, $parameters);

        if ($result->num_rows == 1) {
            $product = self::convertRowToProduct($result->fetch_array());
            return $product;
        } else {
            return false;
        }
    }

    //product van formulier in db (na validatie)
    public static function insert($product)
    {
        //TODO controleren op naam als unieke sleutel
        $query = "INSERT INTO TINY_CLOUDS_PRODUCTS(name, description, image, price, isHighlighted, categoryId, inStock) " .
            "VALUES ('?','?','?',?,?,?,?)";
        $parameters = array(
            $product->getName(), $product->getDescription(), $product->getImage(), $product->getPrice(), $product->isHighLighted(),
            $product->getCategoryId(), $product->getInStock()
        );
        return self::getConnection()->executeSqlQuery($query, $parameters);
    }

    //product info wijzigen
    public static function update($product)
    {
        //TODO controleren op naam als unieke sleutel
        $parameters = array(
            $product->getName(), $product->getDescription(), $product->getImage(), $product->getPrice(), $product->isHighLighted(),
            $product->getCategoryId(), $product->getInStock(), $product->getId()
        );
        $query = "UPDATE TINY_CLOUDS_PRODUCTS SET name='?',description='?',image='?',price=?," .
            "isHighlighted=?,categoryId=?,inStock=? WHERE id=?";

        return self::getConnection()->executeSqlQuery($query, $parameters);
    }

    //Product verwijderen op id
    public static function deleteById($id)
    {
        //TODO controleer of id nog voorkomt in orderdetails
        $query = "DELETE FROM TINY_CLOUDS_PRODUCTS WHERE id = ?";
        $parameters = array($id);
        return self::getConnection()->executeSqlQuery($query,$parameters);
    }

    //Product verwijderen
    public static function delete($product){
        //TODO controleren of id nog voorkomt in orderdetails
        $query = "DELETE FROM TINY_CLOUDS_PRODUCTS WHERE id = ?";
        $parameters = array($product->getId());
        return self::getConnection()->executeSqlQuery($query,$parameters);
    }

    protected static function convertRowToProduct($dbRow)
    {
        return new Product($dbRow['id'], $dbRow['name'], $dbRow['description'], $dbRow['image'], $dbRow['price'],
            $dbRow['isHighlighted'], $dbRow['categoryId'], $dbRow['inStock'], new DateTime($dbRow['dateAdded']));
    }
}

