<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 30/03/2017
 * Time: 20:56
 */


function validateForm(){
    global $required;
    checkRequired($required);
    if(isset($_POST['releasedate']))
        checkReleaseDate($_POST['releasedate']);
    if(isset($_POST['priceexclusive'])){
        checkPriceExclusive($_POST['priceexclusive']);
    }
    if(isset($_POST['emailpublisher'])){
        checkEmailPublisher($_POST['emailpublisher']);
    }
}


function checkRequired($required){
    foreach ($required as $value) {
        if(!isset($_POST[$value]) || empty($_POST[$value])){
            global $errors;
            $errors[$value] = "Verplicht veld";
        }
        else{
            global $values;
            $values[$value] = $_POST[$value];
        }
    }
}

function checkReleaseDate($date){
    $regex = "@^[0-3][0-9]/[0-1][0-9]/19[0-9]{2}$@";

    global $errors;
    if(empty($errors['releasedate'])){
        if(!preg_match($regex,$date)){
            global $values;
            $values['releasedate'] = "";
            $errors['releasedate'] = "Ongeldig formaat";
        }
    }
}

function checkPriceExclusive($price){
    $regex = '@^[0-9]+([,|.][0-9]{1,2})?$@';

    global $errors;
    if(empty($errors['priceexclusive'])){
        if(!preg_match($regex,$price)){
            global $values;
            $values['priceexclusive'] = "";
            $errors['priceexclusive'] = "Ongeldig formaat";
        }
    }
}

function checkEmailPublisher($email){
    $regex = '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/';

    global $errors;
    if(empty($errors['emailpublisher'])){
        if(!preg_match($regex,$email)){
            global $values;
            $values['emailpublisher'] = "";
            $errors['emailpublisher'] = "Ongeldig formaat";
        }
    }
}