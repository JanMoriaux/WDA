<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 10:24
 */
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php
    if (isset($errorMessage) && !empty($errorMessage)) { ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-danger"><?php echo $errorMessage; ?></p>
        </div>
    <?php } ?>


    <h2>Kies de betaalwijze, leveringsopties en accepteer de algemene voorwaarden</h2>



    <form method="post" action="index.php?controller=Cart&action=chooseDeliveryPaymentAndAcceptTerms">
        <!-- paymentmethod -->
        <div class="panel panel-default" id="paymentMethodPanel">
            <div class="panel-title">
                <div class="container">
                    <h3>Kies betaalwijze</h3>
                </div>
            </div>
            <div class="panel-body">

                <?php foreach ($paymentMethods as $paymentMethod) {
                    include ROOT . '/views/partial/paymentMethodPartial.php';
                } ?>

            </div>
        </div>
        <!-- /paymentmethod -->

        <!-- deliverymethod -->
        <div class="panel panel-default" id="deliveryMethodPanel">
            <div class="panel-title">
                <div class="container">
                    <h3>Kies leveringsopties</h3>
                </div>
            </div>
            <div class="panel-body">

                <?php foreach ($deliveryMethods as $deliveryMethod) {
                    include ROOT . '/views/partial/deliveryMethodPartial.php';
                } ?>

            </div>
        </div>
        <!-- /deliverymethod -->

        <!-- acceptTerms -->
        <div class="panel panel-default" id="acceptTermsPanel">
            <div class="panel-body">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="checkbox-inline">
                        <input type="checkbox" class="" name="acceptTerms" value="true"/>
                        Ik ga akkoord met de algemene voorwaarden
                    </label>
                </div>
            </div>
        </div>
        <!-- /accepTerms -->

        <!-- submit -->
        <div class="form-group">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input class="btn btn-primary btn-lg" type="submit"
                       value="Bestellen"/>
            </div>
        </div>

        <!-- /submit -->
    </form>
</div>