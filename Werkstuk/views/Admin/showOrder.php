<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 8/05/2017
 * Time: 11:07
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php if (isset ($errorMessage) && !empty($errorMessage)) { ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <p class="alert alert-danger"><?php echo $errorMessage; ?></p>

    </div>

<?php } else{

        require_once ROOT . '/views/partial/orderDetailSummaryPartial.php'; ?>



    <?php } ?>

</div>
