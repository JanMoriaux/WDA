<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 17/03/2017
 * Time: 20:18
 */

$title = 'Upload Picture';
global $error;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" lang="en"/>
    <link href="../../../Bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="../../../Style/custom.css" type="text/css" rel="stylesheet"/>
    <title><?php echo("$title"); ?></title>
</head>
<body>
<div class="container">
    <h1><?php echo("$title"); ?></h1>

    <form class="form-horizontal" method="post" action="index.php"
          enctype="multipart/form-data">
        <div class="form-group">
            <label for="picture" class="control-label col-md-4">Kies een foto om te uploaden:</label>
            <div class="col-md-4">
                <input type="file" class="form-control" id="picture" name="picture"/>
            </div>
            <label class="error-label form-control-static col-md-3"><?php echo("$error"); ?></label>
        </div>
        <input type="submit" value="Uploaden" class="btn btn-primary btn-lg col-md-2 col-md-offset-4"/>
    </form>
</div>
</body>
</html>


