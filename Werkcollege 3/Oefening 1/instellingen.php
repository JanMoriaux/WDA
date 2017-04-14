<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/03/2017
 * Time: 21:01
 */
include 'taalkeuze.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" lang="en">
    <link rel="stylesheet" type="text/css" href="../../Bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../../Style/custom.css" />
    <title><?php echo $instellingentitel; ?></title>
</head>
<body>
<div class="container">
    <h1><?php echo $instellingentitel; ?></h1>
    <div>
        <?php
            echo $instellingenuitleg;
        ?>
    </div>
    <form class="form-horizontal" method="post" action="setcookie.php">
        <div class="form-group">
            <div class="col-md-8">
                <input type="radio" name="lang" id="nl" value="nl" <?php echo($taal == 'nl' ? "checked" :""); ?> />
                <label class="control-label" for="nl">Nederlands</label>
                <input type="radio" name="lang" id="fr" value="fr" <?php echo($taal == 'fr' ? "checked" :""); ?> />
                <label class="control-label" for="fr">Francais</label>
                <input type="radio" name="lang" id="en" value="en" <?php echo($taal == 'en' ? "checked" :""); ?> />
                <label class="control-label" for="en">English</label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
            <input type="submit" class="btn btn-primary"
                   value="<?php echo $instellingenopslaan ?>" />
            <a href="index.php" class="btn btn-primary">
                <?php echo $instellingenterug; ?></a>
            </div>
        </div>
    </form>

</div>
</body>
</html>