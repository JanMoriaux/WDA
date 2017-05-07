<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:56
 */
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <p class="alert alert-danger">
        <?php echo (isset($errorMessage) && !empty($errorMessage)) ?
            $errorMessage : 'Er heeft zich een probleem voorgedaan' ;?>
    </p>


</div>

