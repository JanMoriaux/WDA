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
    <link rel="stylesheet" type="text/css" href="../../../Bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../../../Style/custom.css" />
    <title><?php echo $indextitel; ?></title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <ul class="nav navbar-nav">
            <li><a class="" href="instellingen.php"><?php echo $indexlink ?></a></li>
            </ul>
        </nav>
        <div>
        <h1><?php echo $indextitel; ?></h1>
        </div>
        <div class="jumbotron">
            <?php
               echo $indextekst;
            ?>
        </div>
    </div>
</body>
</html>
