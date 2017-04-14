<?php

//$mysqli = new mysqli("dtsl.ehb.be","WDA098","71263548","WDA098");
//
//function getConnectionObject(){
//    $mysqli = new mysqli("dtsl.ehb.be","WDA098","71263548","WDA098");
//
//    if($mysqli->connect_error){
//        throw new mysqli_sql_exception();
//    }
//    else{
//        return $mysqli;
//    }
//}
//
//function closeConnectionObject($mysqli){
//    $mysqli->close();
//}

class DbConnection{

    var $mysqli;

    function __construct($server,$user,$pass,$database){
        $this->mysqli = new mysqli($server,$user,$pass,$database);
        if($this->mysqli->connect_error){
            throw new mysqli_sql_exception($this->mysqli->connect_error,
                $this->mysqli->connect_errno);
        }
    }

    function __destruct()
    {
        if(isset($this->mysqli) && !empty($this->mysqli))
            $this->mysqli->close();
    }
}

?>