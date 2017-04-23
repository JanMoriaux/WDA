<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/03/2017
 * Time: 11:19
 */
session_start();

if($_SESSION['ingelogd']){
    include("view2.php");
}
else{
    $error = "Gelieve eerst in te loggen";
    include("login.php");
}

?>