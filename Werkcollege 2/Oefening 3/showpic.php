<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 17/03/2017
 * Time: 20:23
 */
$title = "Show Uploaded Picture";
global $location;
str_replace(' ','%20',$location);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" lang="en"/>
    <link href="../../Bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="../../Style/custom.css" type="text/css" rel="stylesheet"/>
    <title><?php echo("$title"); ?></title>
</head>
<body>
<div class="container">
    <h1><?php echo("$title"); ?></h1>
    <p class="">
    <img src="<?php echo($location); ?>" alt="uploaded pic" title="picture" width="600" height="auto" />
    </p>
    <p class="">
    <a class="btn btn-primary btn-lg" href="index.php" title="Upload More">Upload More</a>
    </p>
</div>
</body>
