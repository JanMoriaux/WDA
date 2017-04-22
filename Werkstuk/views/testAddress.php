<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/04/2017
 * Time: 15:44
 */

$errors = array();
$values = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/WDA/Werkstuk/models/validation/AddressValidator.php' ;

    $street = $_POST['street'];
    $number = $_POST['number'];
    $bus = $_POST['bus'];
    $postalCode = $_POST['postalCode'];
    $city = $_POST['city'];



    $address = new Address(null, $street, $number, $bus, $postalCode, $city);

    $av = new AddressValidator($address);
    $errors = $av->getErrors();
    $values = $av->getValues();


    $valid = true;

    foreach ($errors as $value) {
        if (!empty($value)) {
            $valid = false;
            break;
        }
    }

    if($valid){
        //TODO insert to db
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/custom.css" type="text/css"/>
    <title>Test Address</title>
</head>
<body>
<div class="container">

    <h1>Test Address Input</h1>
    <form class="form-horizontal" action="./testAddress.php" method="post">
        <div class="form-group">
            <label class="control-label col-md-2" for="street"> Straat:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="street" id="street"
                       value="<?php echo(isset($values['street']) ? $values['street'] : ''); ?>"
                       placeholder="Straat"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['street']) ? $errors['street'] : ''); ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="number">Huisnummer:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="number" id="number"
                       value="<?php echo(isset($values['number']) ? $values['number'] : ''); ?>"
                       placeholder=""/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['number']) ? $errors['number'] : ''); ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="bus">Bus:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="bus" id="bus"
                       value="<?php echo(isset($values['bus']) ? $values['bus'] : ''); ?>"
                       placeholder="bus"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['bus']) ? $errors['bus'] : ''); ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="postalCode">Postcode:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="postalCode" id="postalCode"
                       value="<?php echo(isset($values['postalCode']) ? $values['postalCode'] : ''); ?>"
                       placeholder="####"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['postalCode']) ? $errors['postalCode'] : ''); ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="city">Plaats:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="city" id="city"
                       value="<?php echo(isset($values['city']) ? $values['city'] : ''); ?>"
                       placeholder="Zwevezele"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['city']) ? $errors['city'] : ''); ?>
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

