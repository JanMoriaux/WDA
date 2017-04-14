<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 26/03/2017
 * Time: 21:45
 */
include_once("./dbproperties.php");
require_once("./DbConnection.php");

class BoekDAO
{
    var $connection;

    function __construct()
    {
        try{
            $this->connection = new DbConnection(SERVER_NAME,USER_NAME,PASSWORD,DATABASE_NAME);
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }

    function __destruct(){
        if(isset($this->connection) && !empty($this->connection))
            unset($this->connection);
    }

    function getAllBooks(){
        try{
            return $this->connection->mysqli->query("SELECT * from Boek");
        }catch(mysqli_sql_exception $e){
            throw $e;
        }
    }
    function deleteBookWithId($id){
        try{
            return $this->connection->mysqli->query("DELETE FROM Boek WHERE BoekId = $id");
        }
        catch(mysqli_sql_exception $e){
            throw $e;
        }
    }

    function insertBook($title, $releasedate, $priceexclusive, $emailpublisher){

        $day = substr($releasedate,0,2);
        $month = substr($releasedate,3,2);
        $year = substr($releasedate,-4);
        $date = $year .'-'. $month . '-' . $day;

        $price = str_replace(',','.',$priceexclusive);

        try{
            $sql_stmt =
                "INSERT INTO Boek(Titel,Uitgavedatum,PrijsExclBtw,EmailUitgeverij)".
                    "VALUES('$title','$date',$price,'$emailpublisher')";
            return $this->connection->mysqli->query($sql_stmt);
        }
        catch(mysqli_sql_exception $e){
            throw $e;
        }
    }

    function getBookById($bookId){
        $sql_stmt = "SELECT * FROM Boek WHERE BoekId = $bookId";

        try{
                return $this->connection->mysqli->query($sql_stmt);
        }
        catch(mysqli_sql_exception $e){
            throw $e;
        }
    }

}