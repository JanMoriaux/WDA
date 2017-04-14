<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 30/03/2017
 * Time: 20:39
 */
$title = "Boek Toevoegen";

$required = ["title", "releasedate", "priceexclusive", "emailpublisher"];

$errors = [
    "title" => "",
    "releasedate" => "",
    "priceexclusive" => "",
    "emailpublisher" => "",
];

$values = [
    "title" => "",
    "releasedate" => "",
    "priceexclusive" => "",
    "emailpublisher" => "",
];

$messages = [
    'succes' => '',
    'exception' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //validate posted values
    require_once("./validate.php");
    validateForm();

    //check for errors
    $valid = true;

    foreach ($errors as $value) {
        if (!empty($value)) {
            $valid = false;
            break;
        }
    }

    //insert values in database
    if ($valid) {
        try {
            require_once('./BoekDAO.php');
            $dao = new BoekDAO();
            if ($dao->insertBook($_POST['title'], $_POST['releasedate'],
                $_POST['priceexclusive'], $_POST['emailpublisher']) === TRUE
            ) {
                $messages['succes'] = 'Boek toegevoegd aan database';

                //stop showing inserted values and error messages in form
                foreach ($errors as $value){
                    $value = '';
                }
                foreach ($values as $value) {
                    $value = '';
                }
                $values = array();
            } else {
                $messages['error'] = 'Boek niet toegevoegd aan database:'.
                $dao->connection->mysqli->error;
            }
        } catch (mysqli_sql_exception $e) {
            $messages['error'] = "$e->getMessage()";
        } catch (exception $e) {
            $messages['error'] = "$e->getMessage()";
        } finally {
            unset($dao);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" lang="en"/>
    <link href="../../Bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="../../Style/custom.css" rel="stylesheet" type="text/css"/>
    <title><?php echo $title ?></title>
</head>
<body>
<?php
//foreach ($_POST as $key => $value)
//    echo $key . ':' . $value;
//
//
?>
<div class="container">
    <div class="jumbotron">
        <h1><?php echo $title; ?></h1>
    </div>
    <?php
    //display messages
    if (!empty($messages['succes'])) { ?>
        <div class="alert alert-success"><?php echo $messages['succes']; ?></div>
        <?php
    }
    if (!empty($messages['error'])) { ?>
        <div class="alert alert-danger"><?php echo $messages['error']; ?></div>
    <?php } ?>

    <form class="form-horizontal" action="./insertbook.php" method="post">
        <div class="form-group">
            <label class="control-label col-md-2" for="title"> Titel:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="title" id="title"
                       value="<?php echo(isset($values['title']) ? $values['title'] : ''); ?>"
                       placeholder="Titel"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['title']) ? $errors['title'] : ''); ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="releasedate">Datum van uitgave:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="releasedate" id="releasedate"
                       value="<?php echo(isset($values['releasedate']) ? $values['releasedate'] : ''); ?>"
                       placeholder="dd/mm/jjjj"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['releasedate']) ? $errors['releasedate'] : ''); ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="priceexclusive">Prijs (Excl. BTW):</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="priceexclusive" id="priceexclusive"
                       value="<?php echo(isset($values['priceexclusive']) ? $values['priceexclusive'] : ''); ?>" placeholder="x.xx"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['priceexclusive']) ? $errors['priceexclusive'] : ''); ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="emailpublisher">Email uitgeverij:</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="emailpublisher" id="emailpublisher"
                       value="<?php echo(isset($values['emailpublisher']) ? $values['emailpublisher'] : ''); ?>"
                       placeholder="example@publisher.com"/>
            </div>
            <div class="col-md-4">
                <label class="error-label control-label">
                    <?php echo(isset($errors['emailpublisher']) ? $errors['emailpublisher'] : ''); ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-2">
                <input class="btn btn-primary btn-lg" type="submit"
                       value="Toevoegen"/>
            </div>
        </div>
    </form>
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li>
                <a href="./home.php">Home</a>
            </li>
        </ul>
    </nav>
</div>
</body>
</html>
