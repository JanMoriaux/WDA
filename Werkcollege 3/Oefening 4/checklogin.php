<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/03/2017
 * Time: 10:39
 */

$logininfo = array(
    "janmoriaux" => "test1",
    "jacquelinerouw" => "test2"
);

function checkLogin($username, $pwd){
    global $logininfo;
    $valid = false;
    if(array_key_exists($username,$logininfo) && $logininfo[$username] === $pwd ){
        $valid = true;
    }
    return $valid;
}
?>