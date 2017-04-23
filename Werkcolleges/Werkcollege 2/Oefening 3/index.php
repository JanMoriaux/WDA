<?php

function validateExtension($mimetype){
    $valid = false;
    if($mimetype == 'image/jpg')
        $valid = true;
    else if($mimetype == 'image/jpeg')
        $valid= true;
    else if($mimetype == 'image/png')
        $valid = true;
    return $valid;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    include('./form.php');

}
else {
    if (isset($_FILES['picture']) && !empty($_FILES['picture'])) {

        $file = $_FILES['picture'];
        $type = $file['type'];
        $errorcode = $file['error'];

        if($file['error'] !== UPLOAD_ERR_OK){
            $error = "Problemen met uploaden: $errorcode";
            include('./form.php');
        }
        else{
            if(validateExtension($type)) {
                $location = '..\\images\\' . $file['name'];

                if (move_uploaded_file($file['tmp_name'], $location)) {
                    include('./showpic.php');
                } else {
                    $error = "Probleem met opslaan op de server";
                    include('./form.php');
                }
            }
            else {
                $error = 'Ongeldig bestandstype';
                include('./form.php');
            }
        }
    }
}
?>