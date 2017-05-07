<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 14:30
 */

if (isset($errorMessage) && !empty($errorMessage)) {
    ?>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <p class="alert alert-danger">
            <?php echo (isset($errorMessage) && !empty($errorMessage)) ?
                $errorMessage : '' ?>
        </p>
    </div>
    
<?php } ?>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <form class="form" method="post" action="index.php?controller=User&action=login">
        <h2>Gelieve aan te melden</h2>

        <?php require_once ROOT . '/views/partial/loginFormPartial.php' ?>

    </form>
</div>
