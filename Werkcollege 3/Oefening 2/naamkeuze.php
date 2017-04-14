<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/03/2017
 * Time: 20:43
 */

function setNaam(){
    global $naam;
    if(isset($_COOKIE['name']) && !empty($_COOKIE['name']))
        $naam = $_COOKIE['name'];
}

function setWelcomeMessage(){
    global $indextitel;
    global $naam;
    $indextitel = $indextitel.$naam;
}

setNaam();
setWelcomeMessage();

?>




