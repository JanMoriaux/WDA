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

        <!-- status -->
           <div class="panel-default">
               <div class="panel-heading">
                   <h3 class="text-info">Status</h3>
               </div>
               <div class="panel-body">
                   <ul class="list-unstyled">
                       <li>Betaald: <?php echo $order->isPayed() ? 'Ja' : 'Nee'; ?></li>
                       <li>BetaalWijze: <?php echo $paymentMethod->getDescription(); ?></li>
                       <li>Levering: <?php echo $deliveryMethod->getDescription(); ?></li>
                       <li>Datum: <?php echo date('d-m-Y',$order->getDateOrdered()->getTimeStamp()); ?></li>
                   </ul>

               </div>

           </div>

        <!-- /status -->

    <?php } ?>

</div>
