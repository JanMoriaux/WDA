<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/03/2017
 * Time: 21:01
 */
include './taalkeuze.php';
include './naamkeuze.php';
include './kleurkeuze.php';
include './tijdkeuze.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" lang="en">
    <link rel="stylesheet" type="text/css" href="../../../Bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../../Style/custom.css"/>
    <title><?php echo $instellingentitel; ?></title>
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h1><?php echo $instellingentitel; ?></h1>
    </div>
    <form class="form-horizontal" method="post" action="setinstellingen.php">
        <div class="form-group">
            <label class="col-md-12"><?php echo $instellingenuitleg; ?></label>
        </div>
        <!-- Naam -->
        <div class="form-group">
            <label class="control-label col-md-2" for="name"><?php echo $instellingennaam; ?></label>
            <div class="col-md-8">
                <input class="form-control" type="text" id="name" name="name" value="<?php echo $naam; ?>"/>
            </div>
        </div>
        <!-- Taal -->
        <div class="form-group">
            <label class="control-label col-md-2"><?php echo $instellingentaal; ?></label>
            <div class="col-md-8">
                <input type="radio" name="lang" id="nl" value="nl" <?php echo($taal == 'nl' ? "checked" : ""); ?> />
                <label class="control-label" for="nl">Nederlands</label>
                <input type="radio" name="lang" id="fr" value="fr" <?php echo($taal == 'fr' ? "checked" : ""); ?> />
                <label class="control-label" for="fr">Francais</label>
                <input type="radio" name="lang" id="en" value="en" <?php echo($taal == 'en' ? "checked" : ""); ?> />
                <label class="control-label" for="en">English</label>
            </div>
        </div>
        <!-- Kleur -->
        <div class="form-group">
            <label class="control-label col-md-2" for="color"><?php echo $instellingenkleur; ?></label>
            <div class="col-md-8">
                <select name="color" class="form-control" id="color">
                    <option value="red" <?php echo($kleur == 'red' ? 'selected' : ''); ?>>
                        <?php echo $rood; ?></option>
                    <option value="blue" <?php echo($kleur == 'blue' ? 'selected' : ''); ?>>
                        <?php echo $blauw; ?></option>
                    <option value="yellow" <?php echo($kleur == 'yellow' ? 'selected' : ''); ?>>
                        <?php echo $geel; ?></option>
                    <option value="green" <?php echo($kleur == 'green' ? 'selected' : ''); ?>>
                        <?php echo $groen; ?></option>
                </select>
            </div>
        </div>

        <!-- Tijdzone -->
        <div class="form-group">
            <label class="control-label col-md-2" for="timezone">
                <?php echo $instellingentijdzone; ?>
            </label>
            <div class="col-md-8">
                <select name="timezone" id="timezone" class="form-control col-md-8">
                    <?php
                    /*for ($i = 12; $i > 0; $i--) {
                        if($verschilMetUTCUren == $i)
                            echo("<option value='-$i' selected>UTC -$i</option>");
                        else{
                            echo("<option value='-$i'>UTC -$i</option>");
                        }
                    }
                    for ($i = 0; $i <= 12; $i++) {
                        if($verschilMetUTCUren == $i)
                            echo ($i != 0 ? "<option value='$i' selected>UTC +$i</option>" :
                                "<option value='$i' selected>UTC</option>");
                        else{
                            echo ($i != 0 ? "<option value='$i' >UTC +$i</option>" :
                                "<option value='$i' >UTC</option>");
                        }
                    }*/
                    for($i = - 12; $i <= 12; $i++){
                        if($i > 0){
                            echo "<option value='$i'".($verschilMetUTCUren == $i ?
                                "selected>" : ">")."UTC +$i</option>";
                        }
                        else if($i < 0){
                            echo "<option value='$i'".($verschilMetUTCUren == $i ?
                                    "selected>" : ">")."UTC $i</option>";
                        }
                        else{
                            echo "<option value='$i'".($verschilMetUTCUren == $i ?
                                    "selected>" : ">")."UTC</option>";
                        }
                    }

                    ?>
                </select>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <input type="submit" class="btn btn-primary"
                       value="<?php echo $instellingenopslaan ?>"/>
                <a href="index.php" class="btn btn-primary">
                    <?php echo $instellingenterug; ?></a>
            </div>
        </div>
    </form>
</div>
</body>
</html>