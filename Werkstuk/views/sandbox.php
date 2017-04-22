<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 21:31
 */

require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/WDA/Werkstuk/models/database/CRUD/ProductDb.php';

//$allproducts = ProductDb::getAll();
//
//
//foreach($allproducts as $product){
//    echo $product->getId() . '<br />';
//    echo $product->getName() . '<br />';
//    echo $product->getDescription() . '<br />';
//    echo $product->getImage() . '<br />';
//    echo date('d/m/Y h',$product->getDateAdded()->getTimeStamp()) . '<br /><br />';
//
//    $dt = new DateTime();
//}

//$product = new Product(4,'test7','dit is test 5', 'test5.jpg', 5.85, 0,
//    1,255,new DateTime());

//if($result = ProductDb::insert($product)){
//    echo 'toegevoegd';
//
//}
//else{
//    echo 'niet toegevoegd';
//}

//if($result = ProductDb::delete($product)){
//    echo 'deletet';
//} else {
//    echo 'product niet verwijderd';
//}

//if($product = ProductDb::getById(1)){
//    echo $product->getName() . ': ' . $product->getDescription();
//} else{
//    echo 'product niet gevonden';
//}


