<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 16:03
 */

$errors = array();
$values = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    require_once $_SERVER['DOCUMENT_ROOT'] . '/WDA/Werkstuk/models/validation/UserValidator.php';

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $user = new User(null, $firstName, $lastName, $userName, $password, $email, 0, 0, false);

    $uv = new UserValidator($user);
    $errors = $uv->getErrors();
    $values = $uv->getValues();

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
    <title>Test User</title>
</head>
<body>

<div class="container">
    <h1>Test User Input</h1>
    <form class="form-horizontal" action="./testUser.php" method="post">
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