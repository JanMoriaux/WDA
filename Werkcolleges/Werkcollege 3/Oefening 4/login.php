<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/03/2017
 * Time: 10:41
 */
$title = "Login";
session_start();
if($_SESSION['ingelogd']){
    header('location: geheim1.php');
}
else{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta lang="en" charset="UTF-8" />
        <link href="../../../Bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../../../Style/custom.css" rel="stylesheet" type="text/css" />
        <title><?php echo $title; ?></title>
    </head>
    <body>

    <div class="container">
        <div class="well">
            <h1><?php echo $title; ?></h1>
        </div>
        <form class="form-horizontal" action="verwerklogin.php" method="post">
            <div class="form-group">
                <label class="control-label col-md-2" for="username">Username: </label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="username" id="username" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="password">Password: </label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="password" id="password" />
                </div>
            </div>
            <div class="right">
                <input class="col-md-offset-2 btn btn-primary btn-lg" type="submit" value="Inloggen" />
            </div>
            <div class="error-label"><?php echo $error; ?></div>
        </form>
    </div>

    </body>
    </html>



<?php } ?>





