<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/03/2017
 * Time: 20:52
 */

$kleur = 'white';

if(isset($_COOKIE['color']) && !empty($_COOKIE['color']))
    $kleur = $_COOKIE['color'];

$style = "style=\"background-color: $kleur\"";

?>