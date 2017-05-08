<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 13:17
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php
    if (isset($errorMessage) && !empty($errorMessage)) { ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="alert alert-danger"><?php echo $errorMessage; ?></p>
        </div>
    <?php } else if (isset($order)) { ?>

        <h2>Is de volgende informatie correct?</h2>

        <!-- Adressen -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h3 class="text-info">Leveringsadres</h3>
                    <ul class="list-unstyled">
                        <li class="list-unstyled">Straat:
                            <strong><?php echo $order->getDeliveryAddress()->getStreet(); ?></strong></li>
                        <li class="list-unstyled">Nummer:
                            <strong><?php echo $order->getDeliveryAddress()->getNumber(); ?></strong></li>
                        <li class="list-unstyled">Bus:
                            <strong><?php echo $order->getDeliveryAddress()->getBus(); ?></strong></li>
                        <li class="list-unstyled">Postcode:
                            <strong><?php echo $order->getDeliveryAddress()->getPostalCode(); ?></strong></li>
                        <li class="list-unstyled">Gemeente:
                            <strong><?php echo $order->getDeliveryAddress()->getCity(); ?></strong></li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h3 class="text-info">Facturatieadres</h3>
                    <ul class="list-unstyled">
                        <li class="list-unstyled">Straat:
                            <strong><?php echo $order->getFacturationAddress()->getStreet(); ?></strong></li>
                        <li class="list-unstyled">Nummer:
                            <strong><?php echo $order->getFacturationAddress()->getNumber(); ?></strong></li>
                        <li class="list-unstyled">Bus:
                            <strong><?php echo $order->getFacturationAddress()->getBus(); ?></strong></li>
                        <li class="list-unstyled">Postcode:
                            <strong><?php echo $order->getFacturationAddress()->getPostalCode(); ?></strong>
                        </li>
                        <li class="list-unstyled">Gemeente:
                            <strong><?php echo $order->getFacturationAddress()->getCity(); ?></strong></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Adressen -->

        <!-- Betaalwijze en leveringsopties -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h3 class="text-info">Betalingswijze</h3>
                    <ul class="list-unstyled">
                        <li class="list-unstyled">
                            <?php
                            $paymentMethod = PaymentMethodDb::getById($order->getPaymentMethodId());
                            ?>
                            <img src="./images/<?php echo $paymentMethod->getDescription() ?>.png"
                                 alt="<?php echo $paymentMethod->getDescription() ?>"
                                 title="<?php echo $paymentMethod->getDescription() ?>"/>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h3 class="text text-info">Levering</h3>
                    <ul class="list-unstyled">
                        <li>
                            <?php
                            $deliveryMethod = DeliveryMethodDb::getById($order->getDeliveryMethodId());
                            echo $deliveryMethod->getDescription(); ?>
                            <span class="text-info">(+&euro;<?php echo $deliveryMethod->getPrice(); ?>)</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Betaalwijze en leveringsopties -->


        <!-- Overzicht artikelen en totaalprijs -->
        <div class="panel panel-default">
            <div class="panel panel-title">
                <div class="container">
                <h3 class="text-info">Overzicht Artikelen</h3>
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></th>
                        <th class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Naam</th>
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">Eenheidsprijs</th>
                        <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">Aantal</th>
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">Subtotaal</th>
                    </tr>
                    </thead>


                    <?php
                    $orderDetails = $order->getCart()->getOrderDetails();
                    $totalPrice = .0;

                    foreach ($orderDetails as $orderDetail) {
                        $product = ProductDb::getById($orderDetail->getProductId());
                        $detailPrice = $product->getPrice() * $orderDetail->getQuantity();
                        $totalPrice += $detailPrice;
                        ?>

                        <tr>
                            <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                <img src="./images/<?php echo $product->getImage(); ?>"
                                     alt="<?php echo $product->getName(); ?>"
                                     title="<?php echo $product->getName(); ?>"
                                />
                            </td>

                            <td class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <?php echo $product->getName(); ?>
                            </td>

                            <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                                &euro;<?php echo sprintf('%.2f', $product->getPrice()); ?>
                            </td>

                            <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                <?php echo $orderDetail->getQuantity(); ?>
                            </td>

                            <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                                &euro;<?php echo sprintf('%.2f', $detailPrice); ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- totaalrij en verzendingskosten-->

                    <tr>
                        <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></td>
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></th>
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></th>
                        <td class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-right">Verzendingskosten</td>
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                            &euro;<?php echo $deliveryMethod->getPrice(); ?>
                        </th>
                    </tr>
                    <tr>
                        <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></td>
                        <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></td>
                        <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></td>
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Totaal:</th>
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                            &euro;<?php echo sprintf('%.2f',$totalPrice + $deliveryMethod->getPrice()); ?>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Overzicht artikelen en totaalprijs -->

        <!-- Bestel button -->
        <a class="btn btn-primary btn-lg" href="index.php?controller=Cart&action=placeOrder" title="Bestellen">
            Bestellen
        </a>

        <!-- /Bestel button -->

    <?php } ?>


</div>
