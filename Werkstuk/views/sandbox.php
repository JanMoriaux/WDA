<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 21:31
 */

define('ROOT', $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/WDA/Werkstuk');

require_once ROOT . '/models/database/CRUD/CategoryDb.php';
require_once ROOT . '/models/database/CRUD/UserDb.php';

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

//$result = CategoryDb::getAll();
//foreach($result as $category){
//    echo $category->getId() .  ':' . $category->getDescription() . '<br />';
//}
//
//$result = CategoryDb::getById(3)->getDescription();
//echo $result;
//
//$category = new Category(null,'Kledij');
//if(CategoryDb::insert($category)){
//    echo 'Categorie toegevoegd';
//}
//else{
//    echo 'categorie niet toegevoegd';
//}
//
//if(CategoryDb::hasUniqueDescription(new Category(null,'Test'))){
//    echo 'uniek';
//} else{
//    echo 'niet uniek';
//}

//$names = UserDb::getById(2);
//echo $names->getLastName();
////foreach($names as $name){
////    echo $name->getFirstName() . ' ' . $name->getLastName();
////}

$user = new User(null,'Jacqueline','Rouw','jacquelinerouw','jacqueline!123',
    'jacquelinerouw@gmail.com',null,null,true);
echo (int)$user->isAdmin();
if(UserDb::insertWithoutAddressIds($user)){
    echo 'ok';
} else{
    echo 'nok';
}



