<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 29/03/2017
 * Time: 5:50
 */

$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require_once './BoekDAO.php';

    $idToDelete = $_POST['boekid'];

    try{
        $dao = new BoekDAO();
        $result = $dao->deleteBookWithId($idToDelete);
        if($result->num_rows === 1)
            $message = "Boek $idToDelete succesvol verwijderd!";
        $result ->close;
        unset($dao);
    }
    catch(mysqli_sql_exception $e){
        $message = $e->getMessage();
    }
}

header("Location: index.php?message=$message");

?>