<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/04/2017
 * Time: 13:16
 *
 * English version of the Database class from the solutions of the Web Development Advanced class workshops (part 4).
 * Original author (dutch version): Frauke Vanderzijpe
 */
class Database
{
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;
    protected $connection;

    public function __construct($servername,$username,$password,$databasename)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->databasename = $databasename;
    }

    public function __destruct(){
        if($this->connection != null)
            $this->closeDatabaseConnection();
    }

    protected function getDatabaseConnection(){
        $this->connection = new mysqli($this->servername,
            $this->username,
            $this->password,
            $this->databasename);
        if($this->connection->connect_error)
            die("Connect Error(" . $this->connection->connect_errno . "): " .
            $this->connection->connect_error);
    }

    protected function closeDatabaseConnection(){
        if($this->connection != null){
            $this->connection->close();
            $this->connection = null;
        }
    }

    protected function preventSqlInjection($parameterValue){
        $result = $this->connection->real_escape_string($parameterValue);
        return $result;
    }

    public function executeSqlQuery($sqlQuery, $parameterArray = null){
        return $this->executeAdvancedSqlQuery($sqlQuery, true, $parameterArray);
    }

    protected function voerAdvancedSqlQueryUit($sqlQuery, $closeConnectionAutomatically = true, $parameterArray = null){
        $this->getDatabaseConnection();
        if($parameterArray != null){
            //Replace all sqlQuery questions marks by parameter values from parameterArray
            $queryParts = preg_split("/\\?/", $sqlQuery);
            if(count($queryParts) != count($parameterArray)){
                return false;
            }
            $actualQuery = $queryParts[0];
            for($index = 0; $index < count($parameterArray); $index++){
                $actualQuery = $actualQuery . $this->preventSqlInjection($parameterArray [$index]) . $queryParts[$index + 1];
            }
            $sqlQuery = $actualQuery;
        }

        $result = $this->connection->query($sqlQuery);
        if($closeConnectionAutomatically){
            $this->closeDatabaseConnection();
        }
        return $result;
    }
}