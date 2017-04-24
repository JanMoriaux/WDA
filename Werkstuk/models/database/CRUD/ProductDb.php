<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 21:10
 */


require_once ROOT . '/models/database/connection/DatabaseFactory.php';

require_once ROOT . '/models/entities/Product.php';

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


        return self::getProductArrayFromResult($result);

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

    /**
     * @return array met alle productnamen in de Products tabel
     */
    public static function getNames(){
        $query = 'SELECT name FROM TINY_CLOUDS_PRODUCTS';

        $result = self::getConnection()->executeSqlQuery($query);

        $names = array();

        for($index= 0;$index < $result->num_rows;$index++){
            $names[$index] = $result->fetch_array()['name'];
        }

        return $names;
    }

    public static function getByCategoryId($id){
        $query = 'SELECT * FROM TINY_CLOUDS_PRODUCTS WHERE categoryId = ?';
        $parameters = array($id);
        $result = self::getConnection()->executeSqlQuery($query, $parameters);

        return self::getProductArrayFromResult($result);
    }


    /**
     * @param $product
     * @return bool|mysqli_result false indien de naam van het toe te voegen product niet uniek is
     */
    public static function insert($product)
    {
        if(in_array($product->getName(),self::getNames())){
            return false;
        }

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
        if(in_array($product->getName(),self::getNames())){
            return false;
        }

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

    public static function getCategoryIds(){
        $result =
            self::getConnection()->executeSqlQuery('SELECT DISTINCT categoryId FROM TINY_CLOUDS_PRODUCTS');
        $categoryids = array();
        for ($index = 0; $index < $result->num_rows;$index++){
            $categoryids[$index] = $result->fetch_array()['categoryId'];
        }
        return $categoryids;
    }

    protected static function convertRowToProduct($dbRow)
    {
        return new Product($dbRow['id'], $dbRow['name'], $dbRow['description'], $dbRow['image'], $dbRow['price'],
            (boolean)$dbRow['isHighlighted'], $dbRow['categoryId'], $dbRow['inStock'], new DateTime($dbRow['dateAdded']));
    }

    protected static function getProductArrayFromResult($result){
        $resultArray = array();

        for ($index = 0; $index < $result->num_rows; $index++) {
            $dbRow = $result->fetch_array();
            $product = self::convertRowToProduct($dbRow);
            $resultArray[$index] = $product;
        }

        return $resultArray;
    }
}

