<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/03/2017
 * Time: 20:30
 */


$taal = "nl";

if(isset($_SESSION['lang'])){
    $taal = $_SESSION['lang'];
}
include "talen/".$taal.'.php';
?>