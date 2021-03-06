<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 21:10
 */


require_once ROOT . '/models/database/connection/DatabaseFactory.php';
require_once ROOT . '/models/database/CRUD/OrderDetailDb.php';

require_once ROOT . '/models/entities/Product.php';

class ProductDb
{
    private static function getConnection()
    {
        return DatabaseFactory::getDatabase();
    }

    /**
     * @return array Product alle producten uit de products tabel
     */
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
        //productnaam moet uniek zijn
        if(in_array($product->getName(),self::getNames())){
            return false;
        }

        $query = "INSERT INTO TINY_CLOUDS_PRODUCTS(name, description, image, price, isHighlighted, categoryId, inStock) " .
            "VALUES ('?','?','?',?,?,?,?)";
        $parameters = array(
            $product->getName(), $product->getDescription(), $product->getImage(), $product->getPrice(), (int)$product->isHighLighted(),
            $product->getCategoryId(), $product->getInStock()
        );

        return self::getConnection()->executeSqlQuery($query, $parameters);
    }

    /**
     * Product informatie wijzigen
     * @param $product Product
     * @return bool|mysqli_result false indien productnaam overeenkomt met die van een ander product
     */
    public static function update($product)
    {
        //productnaam moet uniek zijn
        //alle producten met andere id dan de id van de meegegeven parameter worden gecontroleerd
        foreach(self::getAll() as $otherProduct){
            if($product->getId() != $otherProduct->getId() && $product->getName() == $otherProduct->getName()){
                return false;
            }
        }
        $parameters = array(
            $product->getName(), $product->getDescription(), $product->getImage(), $product->getPrice(), (int)$product->isHighLighted(),
            $product->getCategoryId(), $product->getInStock(), $product->getId()
        );

        $query = "UPDATE TINY_CLOUDS_PRODUCTS SET name='?',description='?',image='?',price=?," .
            "isHighlighted=?,categoryId=?,inStock=? WHERE id=?";

        return self::getConnection()->executeSqlQuery($query, $parameters);
    }

    //Product verwijderen op id
    public static function deleteById($id)
    {
        $query = "DELETE FROM TINY_CLOUDS_PRODUCTS WHERE id = ?";
        $parameters = array($id);
        return self::getConnection()->executeSqlQuery($query,$parameters);
    }

    //Product verwijderen
    public static function delete($product){
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

    public static function updateStock($id,$quantity){
        $product = self::getById($id);

        $product->setInStock($product->getInStock() + $quantity);
        self::update($product);
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

