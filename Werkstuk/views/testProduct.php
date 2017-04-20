<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 13:59
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/WDA/Werkstuk/models/validation/ProductValidator.php';

$errors = array();
$values = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $price = $_POST['price'];
    $highLighted = $_POST['highLighted'];
    $categoryId = $_POST['categoryId'];
    $inStock = $_POST['inStock'];

    $product = new Product(null, $name, $description, $image, $price, $highLighted, $categoryId, $inStock, new DateTime());
    $productValidator = new ProductValidator($product);

    $errors = $productValidator->getErrors();
    $values = $productValidator->getValues();

    $valid = true;
    foreach ($errors as $value) {
        if ($value != '') {
            $valid = false;
        }
    }

    if ($valid) {
        echo 'ok';
        //TODO file upload
        //TODO db insert
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="../css/custom.css" type="text/css"/>
    <title>Test Product Input</title>
</head>
<body>
<div class="container">
    <h1>Test product input</h1>
    <form class="form-horizontal" action="./testProduct.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-2" for="name">Naam:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="name" id="name"
                       value="<?php echo(isset($values['name']) ? $values['name'] : ''); ?>"
                       placeholder="Naam"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['name']) ? $errors['name'] : ''); ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="description">Beschrijving:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="description" id="description"
                       value="<?php echo(isset($values['description']) ? $values['description'] : ''); ?>"
                       placeholder="Beschrijving"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['description']) ? $errors['description'] : ''); ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="image">Afbeelding:</label>
            <div class="col-md-6">
                <label class="btn btn-default btn-file">Browse
                <input type="file" name="image" id="image" accept="image/*" style="display: none">
                </label>

            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['image']) ? $errors['image'] : ''); ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="price">Prijs:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="price" id="price"
                       value="<?php echo(isset($values['price']) ? $values['price'] : ''); ?>"
                       placeholder="Prijs"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['price']) ? $errors['price'] : ''); ?>
                </label>
            </div>
        </div>

        <!-- TODO Highlighted -->
        <div class="form-group">
            <label class="control-label col-md-2">Uitlichten:</label>
            <div class="col-md-6">

                <div class="col col-md-2"><label class="control-label" for="hlyes">Ja</label>
                    <input class="" type="radio" name="highLighted" id="hlyes" value="1"
                           checked/></div>
                <div class="col col-md-2"><label class="control-label" for="hlno">Nee</label>
                    <input class="" type="radio" name="highLighted" id="hlno" value="0"
                    /></div>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['highLighted']) ? $errors['highLighted'] : ''); ?>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="categoryId">Categorie:</label>
            <div class="col-md-6">
                <select class="btn btn-default dropdown" type="" name="categoryId" id="categoryId">
                    <option value="1">Speelgoed</option>
                    <option value="2">Kleding</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['categoryId']) ? $errors['categoryId'] : ''); ?>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="inStock">In voorraad:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="inStock" id="inStock"
                       value="<?php echo(isset($values['inStock']) ? $values['inStock'] : ''); ?>"
                       placeholder="###"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['inStock']) ? $errors['inStock'] : ''); ?>
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-2">
                <input class="btn btn-primary btn-lg" type="submit"
                       value="Registreren"/>
            </div>
        </div>
    </form>
</div>
</body>
</html>






