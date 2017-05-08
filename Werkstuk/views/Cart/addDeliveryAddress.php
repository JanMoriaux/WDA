<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 8:58
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php if (isset ($errorMessage) && !empty($errorMessage)) { ?>

        <p class="alert alert-danger"><?php echo $errorMessage; ?></p>

    <?php } else{ ?>
    <div class="panel-default">
        <div class="panel-heading">
            <h3>Voer het leveringsadres in:</h3>
        </div>
        <div class="panel-body">
            <?php require_once ROOT . '/views/partial/addressFormPartial.php';

            } ?>
        </div>
    </div>
</div>
