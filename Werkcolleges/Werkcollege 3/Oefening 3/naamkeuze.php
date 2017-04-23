<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/03/2017
 * Time: 20:43
 */



function setNaam(){
    global $naam;
    if(isset($_SESSION['name']) && !empty($_SESSION['name']))
        $naam = $_SESSION['name'];
}

function setWelcomeMessage(){
    global $indextitel;
    global $naam;
    $indextitel = $indextitel.$naam;
}

setNaam();
setWelcomeMessage();

?>




