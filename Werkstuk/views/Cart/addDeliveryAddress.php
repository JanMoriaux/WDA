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

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="alert alert-danger"><?php echo $errorMessage; ?></p>

        </div>

    <?php } else{ ?>

    <h3>Voer het leveringsadres in:</h3>
    <?php require_once ROOT . '/views/partial/addressFormPartial.php';

    } ?>




</div>
