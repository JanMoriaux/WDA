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

    <link href='//fonts.googleapis.com/css?family=Annie%20Use%20Your%20Telescope' rel='stylesheet'>
    <link href="./views/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link href="./views/css/bootstrap-theme.min.css" type="text/css" rel="stylesheet"/>
    <link href="./views/css/custom.css" type="text/css" rel="stylesheet"/>


    <!-- scripts -->

    <script src="./views/js/jquery-3.2.1.min.js"></script>
    <!--<script src="/WDA/Werkstuk/views/js/npm.js"></script>-->
    <script src="./views/js/bootstrap.min.js"></script>
    <script src="./views/js/ajax.js"></script>


    <!-- scripts -->

    <title><?php echo isset($title) ? $title : ''; ?></title>
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
        <?php require_once ROOT . '/views/partial/sidebarPartial.php' ?>
        <!-- sidebar -->
        <!-- banner -->
        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-7">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="well well-lg" id="banner">
                        <h1 class="">Tiny Clouds</h1>
                    </div>
                </div>
            </div>
            <!-- banner -->
            <!-- view -->
            <div class="row" id="pageContent">
                <?php
                if (isset($view) && !empty($view)) {
                    require_once $view;
                }
                ?>
            </div>
        </div>
        <!-- view -->
    </div>
</div>
<!-- .footer -->
<!--    <footer class="footer" id="footer">-->
<!---->
<!--        <div class="container">-->
<!--            <p class="text-muted">Copyright &copy; Tiny Clouds -->
<?php //echo date('Y'); ?><!-- Dedicated to Felix and Abel-->
<!--                Moriaux</p>-->
<!--        </div>-->
<!---->
<!--    </footer>-->
<!-- .footer -->
</body>
</html>
