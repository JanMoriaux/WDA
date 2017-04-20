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

    require_once('../models/Address.php');
    require_once('../models/AddressValidator.php');
    require_once('../models/User.php');
    require_once('../models/UserValidator.php');


    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    //facturation address
    $fac_street = $_POST['fac-street'];
    $fac_number = $_POST['fac-number'];
    $fac_bus = $_POST['fac-bus'];
    $fac_postalCode = $_POST['fac-postalCode'];
    $fac_city = $_POST['fac-city'];

    //delivery address
    $deliv_street = $_POST['deliv-street'];
    $deliv_number = $_POST['deliv-number'];
    $deliv_bus = $_POST['deliv-bus'];
    $deliv_postalCode = $_POST['deliv-postalCode'];
    $deliv_city = $_POST['deliv-city'];

    $fac_address = new Address(1, $fac_street,$fac_number,$fac_bus,$fac_postalCode,$fac_city);
    $deliv_address = new Address(1, $deliv_street,$deliv_number,$deliv_bus,$deliv_postalCode,$deliv_city);
    $user = new User(1,$firstName,$lastName,$userName,$password,$email,$fac_address,$deliv_address,false);

    $uv = new UserValidator($user);
    $errors = $uv->getErrors();
    $values = $uv->getValues();







    //$addressValidation = new AddressValidator($address);
    //$values = $addressValidation->getValues();
    //$errors = $addressValidation->getErrors();

    $valid = true;

    foreach ($errors as $value) {
        if (!empty($value)) {
            $valid = false;
            break;
        }
    }

    if ($valid)
        echo 'ok';
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="../css/custom.css" type="text/css"/>
    <title>Test Address</title>
</head>
<body>
<form class="form-horizontal" action="./testAddress.php" method="post">
    <div class="form-group">
        <label class="control-label col-md-2" for="firstName"> Voornaam:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="firstName" id="firstName"
                   value="<?php echo(isset($values['firstName']) ? $values['firstName'] : ''); ?>"
                   placeholder="Voornaam"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['firstName']) ? $errors['firstName'] : ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="lastName">Achternaam:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="lastName" id="lastName"
                   value="<?php echo(isset($values['lastName']) ? $values['lastName'] : ''); ?>"
                   placeholder="Achternaam"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['lastName']) ? $errors['lastName'] : ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="userName">Gebruikersnaam:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="userName" id="userName"
                   value="<?php echo(isset($values['userName']) ? $values['userName'] : ''); ?>"
                   placeholder="Gebruikersnaam"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['userName']) ? $errors['userName'] : ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="password">Wachtwoord:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="password" id="password"
                   value="<?php echo(isset($values['password']) ? $values['password'] : ''); ?>"
                   placeholder="Wachtwoord"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['password']) ? $errors['password'] : ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="email">Email:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="email" id="email"
                   value="<?php echo(isset($values['email']) ? $values['email'] : ''); ?>"
                   placeholder="jan.janssen@voorbeeld.com"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['email']) ? $errors['email'] : ''); ?>
            </label>
        </div>
    </div>

    <div class="row"><h3>Facturatie-adres</h3></div>

    <div class="form-group">
        <label class="control-label col-md-2" for="fac-street"> Straat:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="fac-street" id="fac-street"
                   value="<?php echo(isset($values['facturationAddress']['street']) ? $values['facturationAddress']['street'] : ''); ?>"
                   placeholder="Straat"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['facturationAddress']['street']) ? $errors['facturationAddress']['street'] : ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="fac-number">Huisnummer:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="fac-number" id="fac-number"
                   value="<?php echo(isset($values['facturationAddress']['number']) ? $values['facturationAddress']['number'] : ''); ?>"
                   placeholder=""/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['facturationAddress']['number']) ? $errors['facturationAddress']['number'] : ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="fac-bus">Bus:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="fac-bus" id="fac-bus"
                   value="<?php echo(isset($values['facturationAddress']['bus']) ? $values['facturationAddress']['bus'] : ''); ?>"
                   placeholder="bus"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['facturationAddress']['bus']) ? $errors['facturationAddress']['bus']: ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="fac-postalCode">Postcode:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="fac-postalCode" id="fac-postalCode"
                   value="<?php echo(isset($values['facturationAddress']['postalCode']) ? $values['facturationAddress']['postalCode'] : ''); ?>"
                   placeholder="####"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['facturationAddress']['postalCode']) ? $errors['facturationAddress']['postalCode'] : ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="fac-city">Plaats:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="fac-city" id="fac-city"
                   value="<?php echo(isset($values['facturationAddress']['city']) ? $values['facturationAddress']['city'] : ''); ?>"
                   placeholder="Zwevezele"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['facturationAddress']['city']) ? $errors['facturationAddress']['city'] : ''); ?>
            </label>
        </div>
    </div>

    <div class="row"><h3>Leveringsadres</h3></div>

    <div class="form-group">
        <label class="control-label col-md-2" for="deliv-street"> Straat:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="deliv-street" id="deliv-street"
                   value="<?php echo(isset($values['deliveryAddress']['street']) ? $values['deliveryAddress']['street'] : ''); ?>"
                   placeholder="Straat"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['deliveryAddress']['street']) ? $errors['deliveryAddress']['street'] : ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="deliv-number">Huisnummer:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="deliv-number" id="deliv-number"
                   value="<?php echo(isset($values['deliveryAddress']['number']) ? $values['deliveryAddress']['number'] : ''); ?>"
                   placeholder=""/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['deliveryAddress']['number']) ? $errors['deliveryAddress']['number'] : ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="deliv-bus">Bus:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="deliv-bus" id="deliv-bus"
                   value="<?php echo(isset($values['deliveryAddress']['bus']) ? $values['deliveryAddress']['bus'] : ''); ?>"
                   placeholder="bus"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['deliveryAddress']['bus']) ? $errors['deliveryAddress']['bus'] : ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="deliv-postalCode">Postcode:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="deliv-postalCode" id="deliv-postalCode"
                   value="<?php echo(isset($values['deliveryAddress']['postalCode']) ? $values['deliveryAddress']['postalCode'] : ''); ?>"
                   placeholder="####"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['deliveryAddress']['postalCode']) ? $errors['deliveryAddress']['postalCode'] : ''); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="deliv-city">Plaats:</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="deliv-city" id="deliv-city"
                   value="<?php echo(isset($values['deliveryAddress']['city']) ? $values['deliveryAddress']['city'] : ''); ?>"
                   placeholder="Zwevezele"/>
        </div>
        <div class="col-md-4">
            <label class="error-label control-label">
                <?php echo(isset($errors['deliveryAddress']['city']) ? $errors['deliveryAddress']['city'] : ''); ?>
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
</body>
</html>

