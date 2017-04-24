<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/04/2017
 * Time: 19:40
 */


require_once ROOT . '/models/database/CRUD/ProductDb.php';
require_once ROOT . '/models/validation/ProductValidator.php';

class AdminController
{

    //GET index.php?controller=Admin&action=index
    public function index()
    {
        $title = 'Portaal Beheerder';
        $adminfunctions = true;

        $view = ROOT . '/views/Admin/index.php';
        require_once ROOT . '/views/layout.php';
    }

    //GET index.php?controller=Admin&action=productOverview
    public function productOverview()
    {


        $title = "Overzicht producten";
        $adminfunctions = true;

        $products = ProductDb::getAll();
        $view = ROOT . '/views/Admin/productOverview.php';
        require_once ROOT . '/views/layout.php';
    }

    //GET index.php?controller=Admin&action=editProduct&id=x
    //POST
    public function editProduct()
    {
        $product = null;
        $title = "Wijzig Product";
        $adminfunctions = true;

        //GET request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if (isset($_GET['id']) && $_GET['id']) {
                //product met id uit de database halen
                if ($product = ProductDb::getById($_GET['id'])) {
                    //productId in title
                    $title = $title . ' ' . $product->getId();

                    //errors (normaal allemaal lege waarden) en values van ons product kunnen uit ProductValidator
                    //worden gehaald en ingevuld worden in de form
                    $pv = new ProductValidator($product);
                    $errors = $pv->getErrors();
                    $values = $pv->getValues();
                }
            }
            //POST request
        } else {
            //bij POST worden de ingevulde waarden gevalideerd door ProductValidator
            //indien geldig -> update van product in db en terug naar admin productoverzicht
            //indien ongeldig -> errors en values uit ProductValidor halen en form met geldige waarden
            // en foutboodschappen terug tonen

            $id = $name = $description = $image = $price = $highLighted = $categoryId = $inStock = null;

            echo $_POST['id'];

            if(isset($_POST['id'])){
                $id  = $_POST['id'];
            }
            if (isset($_POST['name'])) {
                $name = $_POST['name'];
            }
            if (isset($_POST['description'])) {
                $description = $_POST['description'];
            }
            if (isset($_FILES['image'])) {
                $image = $_FILES['image']['name'];
            }
            if (isset($_POST['price'])) {
                $price = $_POST['price'];
            }
            if (isset($_POST['highLighted'])) {
                $highLighted = $_POST['highLighted'];
            }
            if (isset($_POST['categoryId'])) {
                $categoryId = $_POST['categoryId'];
            }
            if (isset($_POST['inStock'])) {
                $inStock = $_POST['inStock'];
            }



            $product = new Product($id, $name, $description, $image, $price, $highLighted,
                $categoryId, $inStock, new DateTime());
            $pv = new ProductValidator($product);

            $errors = $pv->getErrors();
            $values = $pv->getValues();

            $valid = true;

            foreach ($errors as $error) {
                if ($error != '') {
                    $valid = false;
                }
            }

            if ($valid) {
                $productUpdated = false;


                //file uploaden en in images map zetten
                $targetDir = ROOT . '/images/';
                $target = $targetDir . $_FILES['image']['name'];
                $source = $_FILES['image']['tmp_name'];
                if (move_uploaded_file($source, $target)) {

                    //wanneer image bestand is toegevoegd kunnen we het product aanpassen
                    if (ProductDb::update($product)) {
                        $productUpdated = true;
                    }
                    //
                }
            }
        }


        $view = ROOT . '/views/Admin/editProduct.php';
        require_once ROOT . '/views/layout.php';


    }

    //GET index.php?controller=Admin&action=deleteProduct&id=x
    public function deleteProduct()
    {
        //TODO
    }

}