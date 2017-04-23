<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 17/04/2017
 * Time: 22:29
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <link href="/WDA/Werkstuk/views/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link href="/WDA/Werkstuk/views/css/bootstrap-theme.min.css" type="text/css" rel="stylesheet"/>
    <link href="/WDA/Werkstuk/views/css/custom.css" type="text/css" rel="stylesheet"/>

    <!-- todo title zetten -->
    <title>Title</title>
</head>
<body>

<!-- navigatie -->
<header>

    <?php require_once ROOT . '/views/partial/mainNavPartial.php' ?>

</header>
<!-- navigatie -->
<div class="container">

    <div class="row">

        <!-- sidebar -->
        <div class="col-md-3">
            <p class="lead">Tiny Clouds</p>
            <div class="list-group">
                <a href="#" class="list-group-item">Category 1</a>
                <a href="#" class="list-group-item">Category 2</a>
                <a href="#" class="list-group-item">Category 3</a>
            </div>
        </div>
        <!-- sidebar -->

        <!-- banner -->
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="well well-lg">
                        <h1 class="">Tiny Clouds <?php echo isset($title) ? $title : '';?></h1>
                    </div>
                </div>
            </div>
            <!-- banner -->


            <!-- routing naar page content -->
            <div class="row">
                <?php require_once ROOT . '/routes.php'; ?>
            </div>
            <!-- routing -->

        </div>
    </div>
</div>

<!-- .container -->
<div class="container">

    <hr>

    <!-- footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Tiny Clouds <?php echo date('Y'); ?> Dedicated to Felix and Abel Moriaux</p>
            </div>
        </div>
    </footer>

</div>
<!-- .container -->

<!-- scripts -->

<script src="/WDA/Werkstuk/views/js/jquery-3.2.1.min.js"></script>
<!--<script src="/WDA/Werkstuk/views/js/npm.js"></script>-->
<script src="/WDA/Werkstuk/views/js/bootstrap.min.js"></script>

<!-- scripts -->
</body>
</html>
