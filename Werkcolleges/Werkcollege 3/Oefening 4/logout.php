<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/03/2017
 * Time: 11:22
 */

session_start();
if($_SESSION['ingelogd']){
    //sessievariabelen unsetten
    session_unset();

    //sessicookie verwijderen
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), "", time() - 3600, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }

    //sessiedat op schijf verwijderen
    session_destroy();
    $error = "Sessie verwijderd";
    include('login.php');
}
else{
    $error = "Gelieve eerst in te loggen";
    include('login.php');
}

?>

