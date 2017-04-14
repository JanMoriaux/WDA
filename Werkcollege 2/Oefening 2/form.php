<?php
$title = 'Inschrijving Student';

global $required;
global $values;
global $errors;

//checking the right radiobutton when trying to representing the form after validation
$isMale = $values['sex'] === 'male';
$isFemale = $values['sex'] === 'female';
$isOther = $values['sex'] === 'other';

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo("$title"); ?></title>
    <link href="../../Bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="../../Style/custom.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div class="container">

    <h1><?php echo("$title"); ?></h1>

    <form action="./index.php" method="post" class="form-horizontal">

        <div class="form-group">
            <label class="col-md-2 control-label" for="firstname">Voornaam: </label>
            <div class="col-md-6">
                <input type="text" id="firstname" name="firstname" class="form-control"
                       value="<?php echo($values['firstname']); ?>"/>

            </div>
            <label class="col-md-2 form-control-static error-label"> <?php echo($errors['firstname']); ?> </label>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="lastname">Achternaam: </label>
            <div class="col-md-6">
                <input type="text" id="lastname" name="lastname" class="form-control"
                       value="<?php echo($values['lastname']); ?>"/>
            </div>
            <label class="col-md-2 form-control-static error-label"> <?php echo($errors['lastname']); ?> </label>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Geboortedatum: </label>

            <div class="row">
                <label class="col-md-1 control-label" for="day">Dag:</label>
                <div class="col-md-1">
                    <input type="text" id="day" name="day" class="form-control"
                           value="<?php echo($values['day']); ?>"/>
                </div>
                <label class="control-label col-md-1" for="month">Maand:</label>
                <div class="col-md-1">
                    <input type="text" id="month" name="month" class="form-control"
                           value="<?php echo($values['month']); ?>"/>
                </div>
                <label class="control-label col-md-1" for="year">Jaar:</label>
                <div class="col-md-1">
                    <input type="text" id="year" name="year" class="form-control"
                           value="<?php echo($values['year']); ?>"/>
                </div>
            </div>
            <div class="row">
                <label class="form-control-static error-label col-md-2 col-md-offset-2"> <?php echo($errors['day']); ?> </label>
                <label class="error-label form-control-static col-md-2"> <?php echo($errors['month']); ?> </label>
                <label class="error-label form-control-static col-md-2"> <?php echo($errors['year']); ?> </label>
            </div>


        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Geslacht:</label>
            <div class="">
                <div class="col-md-2">
                    <input class="" type="radio" name="sex" id="male"
                           value="male" <?php if ($isMale) echo('checked'); ?> />
                    <label for="male">Man</label>
                </div>
                <div class="col-md-2">
                    <input class="" type="radio" name="sex" id="female"
                           value="female" <?php if ($isFemale) echo('checked'); ?> />
                    <label for="female">Vrouw</label>
                </div>
                <div class="col-md-2">
                    <input class="" type="radio" name="sex" id="other"
                           value="other" <?php if ($isOther) echo('checked'); ?> />
                    <label for="other">Ander</label>
                </div>
            </div>
            <label class="error-label form-control-static col-md-2"> <?php echo($errors['sex']); ?> </label>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="address">Adres: </label>
            <div class="col-md-6">
                <input type="text" id="address" name="address" class="form-control"
                       value="<?php echo($values['address']); ?>"/>
            </div>
            <label class="error-label form-control-static col-md-2"> <?php echo($errors['address']); ?> </label>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="phonenumber">Telefoonnummer: </label>
            <div class="col-md-6">
                <input type="text" id="phonenumber" name="phonenumber" class="form-control"
                       value="<?php echo($values['phonenumber']); ?>"/>
            </div>
            <label class="error-label form-control-static col-md-2"> <?php echo($errors['phonenumber']); ?>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="cellnumber">GSM-nummer: </label>
            <div class="col-md-6">
                <input type="text" id="cellnumber" name="cellnumber" class="form-control"
                       value="<?php echo($values['cellnumber']); ?>"/>
            </div>
            <label class="error-label form-control-static col-md-2"> <?php echo($errors['cellnumber']); ?>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="sosu">Rijksregisternummer: </label>
            <div class="col-md-6">
                <input type="text" id="sosu" name="sosu" class="form-control"
                       value="<?php echo($values['sosu']); ?>"/>
            </div>
            <label class="error-label col-md-2 form-control-static"> <?php echo($errors['sosu']); ?> </label>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="bankacc">Bankrekeningnummer: </label>
            <div class="col-md-6">
                <input type="text" id="bankacc" name="bankacc" class="form-control"
                       value="<?php echo($values['bankacc']); ?>"/>
            </div>
            <label class="error-label form-control-static col-md-2"> <?php echo($errors['bankacc']); ?> </label>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="course">Gewenste cursus: </label>
            <div class="col-md-6">
                <select id="course" name="course" class="form-control">
                    <option value="">Kies een cursus:</option>
                    <option value="PHP" <?php if ($values['course'] == "PHP") echo('selected'); ?> >PHP</option>
                    <option value="HTML" <?php if ($values['course'] == "HTML") echo('selected'); ?> >HTML</option>
                    <option value="C#" <?php if ($values['course'] == "C#") echo('selected'); ?> >C#</option>
                    <option value="Java" <?php if ($values['course'] == "Java") echo('selected'); ?> >Java</option>
                    <option value="Objective-C" <?php if ($values['course'] == "Objective-C") echo('selected'); ?> >
                        Objective-C
                    </option>
                </select>
            </div>
            <label class="error-label form-control-static col-md-2"> <?php echo($errors['course']); ?> </label>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <input type="checkbox" id="higheredu" name="higheredu" class="checkbox-inline form-control-static"
                    <?php if ($values['higheredu']) echo('checked'); ?> />
                <label class="control-label" for="higheredu">Student heeft reeds hoger onderwijs gevolgd </label>
            </div>
        </div>

        <div class="form-group">
            <input class="btn btn-primary btn-lg col-md-2 col-md-offset-2" type="submit" value="Verzend"/>
        </div>
    </form>
</div>
<div class="test">
    <?php
    foreach ($required as $item)
        echo($item . '<br />');
    echo('<br />');

    foreach ($values as $key => $value)
        echo("$key : $value <br />");
    echo('<br />');

    foreach ($errors as $key => $value)
        echo("$key : $value <br />");
    echo('<br />');


    ?>


</div>
</body>
</html>

