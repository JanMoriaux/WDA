<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/03/2017
 * Time: 11:08
 */
$title = "Geheim 1";
?>
<!DOCTYPE html>
<html>
<head>
    <meta lang="en" charset="UTF-8" />
    <link href="../../Bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../../Style/custom.css" rel="stylesheet" type="text/css" />
    <title><?php echo $title; ?></title>
</head>
<body>

<div class="container">
    <div class="well">
        <h1><?php echo $title; ?></h1>
    </div>
    <div class="">
        <h2><?php echo ("welkom ".$_SESSION['username']) ?></h2>
    </div>
</div>

</body>
</html>
