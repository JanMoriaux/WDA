<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/03/2017
 * Time: 20:52
 */

$kleur = 'white';

if(isset($_SESSION['color']) && !empty($_SESSION['color']))
    $kleur = $_SESSION['color'];

$style = "style=\"background-color: $kleur\"";

?>