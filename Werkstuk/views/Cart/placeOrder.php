<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 21:09
 */
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php if (isset($errorMessage) && !empty($errorMessage)) { ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-danger"><?php echo $errorMessage; ?></p>
        </div>

    <?php } else if (isset($_SESSION['orderSummary']) && !empty($_SESSION['orderSummary'])) {

        $order = $_SESSION['orderSummary'];
        $user = UserDb::getById($order->getUserId());
        $paymentMethod = PaymentMethodDb::getById($order->getPaymentMethodId());
        $deliveryMethod = DeliveryMethodDb::getById($order->getDeliveryMethodId());
        $products = array();
        $orderDetails = $order->getCart()->getOrderDetails();
        foreach ($orderDetails as $orderDetail) {
            $products[$orderDetail->getProductId()] = ProductDb::getById($orderDetail->getProductId());
        }
        ?>

        <div class="alert alert-success">
            <p>Wij hebben uw bestelling goed ontvangen en gaan meteen aan de slag om uw spullen te verzenden.
                Hieronder vindt u nog een overzicht van uw bestelling. Bedankt en tot ziens!
            </p>
        </div>

        <?php require_once ROOT . '/views/partial/orderDetailSummaryPartial.php'; ?>

    <?php } ?>
</div>