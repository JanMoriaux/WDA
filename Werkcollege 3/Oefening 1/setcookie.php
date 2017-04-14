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
    if(isset($_POST['lang']) && !empty($_POST['lang'])){
        setcookie('lang',$_POST['lang'],time() + 7*24*60*60);
        header('Location: geheim1.php');
    }
}


?>