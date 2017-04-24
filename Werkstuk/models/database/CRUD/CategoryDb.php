<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 23/04/2017
 * Time: 19:58
 */
require_once ROOT . '/models/database/connection/DatabaseFactory.php';
require_once ROOT . '/models/entities/Category.php';
require_once ROOT . '/models/database/CRUD/ProductDb.php';

class CategoryDb extends Database
{
    /**
     * @return Database
     */
    private static function getConnection()
    {
        return DatabaseFactory::getDatabase();
    }

    /**
     * @return array alle productcategoriën uit database
     */
    public static function getAll()
    {
        $query = "SELECT * FROM TINY_CLOUDS_CATEGORIES";

        $result = self::getConnection()->executeSqlQuery($query);
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $dbRow = $result->fetch_array();
            $category = self::convertRowToCategory($dbRow);
            $resultArray[$index] = $category;
        }
        return $resultArray;
    }

    /**
     * @param $id
     * @return bool|Category het Category object met id = $id of false indien niet gevonden
     */
    public static function getById($id)
    {
        $query = "SELECT * FROM TINY_CLOUDS_CATEGORIES WHERE id = ?";
        $parameters = array($id);

        $result = self::getConnection()->executeSqlQuery($query, $parameters);

        if ($result->num_rows === 1) {
            $category = self::convertRowToCategory($result->fetch_array());
            return $category;
        } else {
            return false;
        }
    }

    /**
     * @return array met alle id-nummers van de Categories table
     */
    public static function getIds(){
        $query = "SELECT id FROM TINY_CLOUDS_CATEGORIES";

        $result = self::getConnection()->executeSqlQuery($query);
        $ids = array();

        for($index = 0; $index < $result->num_rows;$index++){
            $ids[$index] = $result->fetch_array()['id'];
        }

        return $ids;
    }

    /**
     * @param $id int
     * @return bool|mysqli_result
     * Verwijdert de categorie uit de database.
     * Geeft false terug als de categorie nog aanwezig is in de products tabel van de database.
     */
    public static function deleteById($id)
    {
        //Controleren of de categorie nog voorkomt in de products tabel
        if(in_array($id,ProductDb::getCategoryIds())){
            return false;
        }

        $query = 'DELETE FROM TINY_CLOUDS_CATEGORIES WHERE id = ?';
        $parameters = array($id);

        return self::getConnection()->executeSqlQuery($query, $parameters);
    }

    /**
     * @param $category Category
     * Category verwijderen uit database
     */
    public static function delete($category)
    {
        self::deleteById($category->getId());
    }

    /**
     * @param $category Category
     * @return mysqli_result true indien nieuwe categorie toegevoegd en false indien niet
     */
    public static function insert($category)
    {
        //Controleren of category description al voor komt in de database
        if(!(in_array($category->getDescription(),self::getAllDescriptions())))
            return false;

        $query = "INSERT INTO TINY_CLOUDS_CATEGORIES(description) VALUES ('?')";
        $parameters = array($category->getDescription());

        return self::getConnection()->executeSqlQuery($query, $parameters);
    }

    /**
     * @param $category Category
     * @return bool|mysqli_result
     * Waarden van category in data base wijzigen
     */
    public static function update($category){

        //Controleren of category description al voor komt in de database
        if(!(in_array($category->getDescription(),self::getAllDescriptions())))
            return false;

        //Category
        $query = "UPDATE TINY_CLOUDS_CATEGORIES SET description = '?' WHERE id = ?";
        $parameters = array(
            $category->getDescription(),
            $category->getId()
        );

        return self::getConnection()->executeSqlQuery($query, $parameters);
    }

    /**
     * @param $category Category
     * @return een array met alle descriptions van de Categories table
     * (om na te gaan of Category object een unieke description heeft)
     */
    public static function getAllDescriptions(){
        $result = self::getConnection()->executeSqlQuery('SELECT description FROM TINY_CLOUDS_CATEGORIES');

        $descriptions = array();
        for($index = 0; $index < $result->num_rows; $index++){
            $descriptions[$index] = $result->fetch_array()['description'];
        }

        return $descriptions;
    }

    private static function convertRowToCategory($dbRow)
    {
        return new Category($dbRow['id'], $dbRow['description']);
    }
}