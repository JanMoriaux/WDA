<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 8/05/2017
 * Time: 11:09
 */
?>

<h2>Overzicht bestelling nummer <?php echo $order->getId(); ?></h2>

<!-- Gebruikersinformatie -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="text-info">Gebruikersinformatie</h3>
    </div>
    <div class="panel-body">
        <table class="table">
            <tr>
                <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Naam:</td>
                <th><?php echo $user->getLastName(); ?></th>
            </tr>
            <tr>
                <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Voornaam:</td>
                <th><?php echo $user->getFirstName(); ?></th>
            </tr>
            <tr>
                <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Email:</td>
                <th><?php echo $user->getEmail(); ?></th>
            </tr>
        </table>
    </div>
</div>
<!-- Gebruikersinformatie -->

<!-- Adresinformatie -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="text-info">Adresinformatie</h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <h4 class="text-info">Leveringsadres</h4>
            <table class="table">
                <tr>
                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Straat:</td>
                    <th><?php echo $order->getDeliveryAddress()->getStreet(); ?></th>
                </tr>
                <tr>
                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Huisnummer:</td>
                    <th><?php echo $order->getDeliveryAddress()->getNumber(); ?></th>
                </tr>
                <tr>
                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Bus:</td>
                    <th><?php echo $order->getDeliveryAddress()->getBus(); ?></th>
                </tr>
                <tr>
                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Postcode:</td>
                    <th><?php echo $order->getDeliveryAddress()->getPostalcode(); ?></th>
                </tr>
                <tr>
                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Gemeente:</td>
                    <th><?php echo $order->getDeliveryAddress()->getCity(); ?></th>
                </tr>
            </table>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <h4 class="text-info">Facturatieadres</h4>
            <table class="table">
                <tr>
                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Straat:</td>
                    <th><?php echo $order->getFacturationAddress()->getStreet(); ?></th>
                </tr>
                <tr>
                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Huisnummer:</td>
                    <th><?php echo $order->getFacturationAddress()->getNumber(); ?></th>
                </tr>
                <tr>
                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Bus:</td>
                    <th><?php echo $order->getFacturationAddress()->getBus(); ?></th>
                </tr>
                <tr>
                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Postcode:</td>
                    <th><?php echo $order->getFacturationAddress()->getPostalcode(); ?></th>
                </tr>
                <tr>
                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Gemeente:</td>
                    <th><?php echo $order->getFacturationAddress()->getCity(); ?></th>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- /Adresinformatie -->

<!-- Bestellingsoverzicht-->
<div class="panel panel-default">
    <div class="panel panel-heading">
        <h3 class="text-info">Overzicht Artikelen</h3>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Naam</th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">Eenheidsprijs</th>
                <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">Aantal</th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">Subtotaal</th>
            </tr>
            </thead>


            <?php

            $totalPrice = .0;
            foreach ($products as $productId => $product) {

                $orderDetail = $orderDetails[$productId];
                $quantity = $orderDetail->getQuantity();
                $detailPrice = $product->getPrice() * $quantity;
                $totalPrice += $detailPrice;
                ?>
                <tr>
                    <td class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo $product->getName(); ?>
                    </td>

                    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                        &euro;<?php echo sprintf('%.2f', $product->getPrice()); ?>
                    </td>

                    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                        <?php echo $quantity; ?>
                    </td>

                    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                        &euro;<?php echo sprintf('%.2f', $detailPrice); ?>
                    </td>
                </tr>
            <?php } ?>

            <!-- totaalrij en verzendingskosten-->
            <tr>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></th>
                <td class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-right">Verzendingskosten</td>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                    &euro;<?php echo $deliveryMethod->getPrice(); ?>
                </th>
            </tr>
            <tr>
                <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></td>
                <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right"><?php
                    echo $order->isPayed() ? 'Betaald:' : 'Betalen bij levering:'; ?>
                </th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                    &euro;<?php echo sprintf('%.2f', $totalPrice + $deliveryMethod->getPrice()); ?>
                </th>
            </tr>
        </table>
        <!-- /Bestellingsoverzicht-->
    </div>
</div>



