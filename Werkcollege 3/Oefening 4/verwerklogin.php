<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/03/2017
 * Time: 10:51
 */
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    include("checklogin.php");

    $username = $_POST['username'];
    $pwd = $_POST['password'];

    if(checkLogin($username,$pwd)){
        session_start();
        $_SESSION['ingelogd'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $pwd;
        header("location: geheim1.php");
    }
    else{
        $error = "Ongeldige Username/Password combinatie";
        include("login.php");
    }
}


