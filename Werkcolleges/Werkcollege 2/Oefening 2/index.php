<?php
error_reporting(E_ALL);
$formIsValid = true;
$required = ['firstname','lastname','day','month','year','sex','address',
    'sosu','bankacc','course'];

$errors = [
    'firstname' => '',
    'lastname' => '',
    'day' => '',
    'month' => '',
    'year' => '',
    'sex' => '',
    'address' => '',
    'phonenumber' => '',
    'cellnumber' => '',
    'sosu' => '',
    'bankacc' => '',
    'course' => ''
];

$values = [
    'firstname' => '',
    'lastname' => '',
    'day' => '',
    'month' => '',
    'year' => '',
    'sex' => '',
    'address' => '',
    'phonenumber' => '',
    'cellnumber' => '',
    'sosu' => '',
    'bankacc' => '',
    'course' => '',
    'higheredu' => ''
];

if($_SERVER["REQUEST_METHOD"] !== 'POST'){
    //include the form
    include("./form.php");



}
else{
    //validation and result or show form again

    require_once("./validation.php");
    validateRequiredFields($required);
    validatePhoneNumbers();

    foreach($errors as $error){
        if(!empty($error)){
            $formIsValid = false;
            break;
        }
    }

    if(isset($_POST['higheredu']) && !empty($_POST['higheredu']))
        $values['higheredu'] = $_POST['higheredu'];

    if(!$formIsValid){
        include("./form.php");
    }
    else{
        include("./result.php");
    }


}




?>