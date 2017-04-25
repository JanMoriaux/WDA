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

    <title><?php echo isset($title) ? $title : ''; ?></title>
</head>
<body>

<!-- navigatie -->
<header>
    <?php require_once ROOT . '/views/partial/mainNavPartial.php' ?>

    <?php //bericht in verband met geslaagde login
    if (isset($userLoggedIn)) {
        if (!$userLoggedIn) { ?>
            <div class="col-md-12">
                <div class="alert alert-danger col-md-9">Probleem met database: niet ingelogd!</div>
            </div>
        <?php }
    } ?>


</header>
<!-- navigatie -->
<div class="container">

    <div class="row">

        <!-- sidebar -->
        <?php require_once ROOT . '/views/partial/sidebarPartial.php' ?>
        <!-- sidebar -->

        <!-- banner -->
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="well well-lg">
                        <h1 class="">Tiny Clouds</h1>
                    </div>
                </div>
            </div>
            <!-- banner -->


            <!-- view -->
            <div class="row">
                <?php
                if (isset($view) && !empty($view)) {
                    require_once $view;
                }
                ?>
            </div>
            <!-- view -->

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
