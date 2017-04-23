<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/03/2017
 * Time: 9:10
 */



$tijd = time();

//nodig voor up to date houden instellingenscherm
$verschilMetUTCUren = 0;

if(isset($_SESSION['timezone'])){
    $verschilMetUTCUren = $_SESSION['timezone'];
    $verschilMetUTCSeconden = $verschilMetUTCUren * 60 * 60;
    $tijd = $tijd + $verschilMetUTCSeconden;
}

$showDate = date('H:i:s', $tijd);