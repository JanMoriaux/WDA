<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/03/2017
 * Time: 21:23
 */
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: geheim1.php');
}
else{
    if(isset($_POST['lang'])){
        setcookie('lang',$_POST['lang'],time() + 7*24*60*60);
    }
    if(isset($_POST['name'])){
        setcookie('name',$_POST['name']);
    }
    if(isset($_POST['color'])){
        setcookie('color', $_POST['color'], time() + 7* 24 * 60 * 60);
    }
    if(isset($_POST['timezone'])){
        setcookie('timezone', $_POST['timezone'], mktime(23,59,00,12,31,2017));
    }

    header('location: geheim1.php');

}


?>