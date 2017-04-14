<?php

//validation rules for student registration form

function validateRequiredFields($fields){
    foreach ($fields as $name){

        if(isset($_POST[$name]) && !empty($_POST[$name])){
            global $values;
            $values[$name] = $_POST[$name];
        }
        else{
            global $errors;
            $errors[$name] = 'Verplicht veld';
        }

    }
}

function validatePhoneNumbers(){

    if((!isset($_POST['phonenumber']) || empty($_POST['phonenumber'])) &&
        (!isset($_POST['cellnumber']) || empty($_POST['cellnumber']))){
        global $errors;
        $errors['phonenumber'] = 'Voer minstens een telefoonnummer of gsm-nummer in';
    }
    else{
        if(isset($_POST['phonenumber']) && !empty($_POST['phonenumber']))
            global $values;
            $values['phonenumber'] = $_POST['phonenumber'];
        if(isset($_POST['cellnumber']) && !empty($_POST['cellnumber'])){
            global $values;
            $values['cellnumber'] = $_POST['cellnumber'];
        }
    }
}




function showPostVariable(){
    foreach($_POST as $key => $value)
        echo("$key : $value<br />");

    echo $_POST;
}



?>