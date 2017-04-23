<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 14/04/2017
 * Time: 19:48
 */
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['name'])){
        $nameVal = $_GET['name'];

        if(empty($nameVal)){
            $data['error'] = 'Geen naam verstuurd via GET';
        }
        else{
            $data['success'] = 'Welkom, '. $nameVal;
        }
    }
    else{
        $data['error'] = 'Geen naam verstuurd via GET';
    }

    echo json_encode($data);
}
else if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['name'])){
        $nameVal = $_POST['name'];

        if(empty($nameVal)){
            $data['error'] = 'Geen naam verstuurd via POST';
        }
        else{
            $data['success'] = 'Welkom, '. $nameVal;
        }
    }
    else{
        $data['error'] = 'Geen naam verstuurd via POST';
    }

    echo json_encode($data);








}
?>


