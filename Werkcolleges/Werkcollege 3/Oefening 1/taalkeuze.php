<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/03/2017
 * Time: 20:30
 */
$taal = "nl";
if(isset($_COOKIE['lang'])){
    $taal = $_COOKIE['lang'];
}
include "talen/".$taal.'.php';
?>