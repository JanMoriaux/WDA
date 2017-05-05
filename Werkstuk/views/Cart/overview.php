<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 2/05/2017
 * Time: 10:10
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <h2>Overzicht Winkelmandje</h2>

    <?php if (isset($orderDetails) && count($orderDetails) > 0) { ?>

        <table class="table">
            <thead>
            <tr>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></th>
                <th class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Naam</th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">Eenheidsprijs</th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">Aantal</th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">Beschikbaar</th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">Subtotaal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $totalPrice = .0;
            foreach ($orderDetails as $orderDetail) {
                $product = ProductDb::getById($orderDetail->getProductId());

                //prijs van orderdetail toevoegen voor totaalprijs
                $thisPrice = $product->getPrice() * $orderDetail->getQuantity();
                $totalPrice += $thisPrice;
                ?>
                <tr>

                    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                        <img src="./images/<?php echo $product->getImage(); ?>"
                             alt="<?php echo $product->getName(); ?>"
                             title="<?php echo $product->getName(); ?>"
                        />
                    </td>

                    <td class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo $product->getName(); ?>
                    </td>

                    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                        &euro;<?php echo sprintf('%.2f', $product->getPrice()); ?>
                    </td>

                    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                        <?php echo $orderDetail->getQuantity(); ?>
                    </td>

                    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                        <?php echo $product->getInStock(); ?>
                    </td>

                    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                        <form method="post" action="index.php?controller=Cart&action=deleteProduct">
                            <input type="hidden" name="id" value="<?php echo $product->getId(); ?>"/>
                            <button type="submit" class="text-danger cartIcon" title="Verwijderen uit mandje">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
                        </form>
                    </td>

                    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                        <?php if ($orderDetail->getQuantity() < $product->getInStock()) { ?>
                            <form method="post" action="index.php?controller=Cart&action=increaseUnits">
                                <input type="hidden" name="id" value="<?php echo $product->getId(); ?>"/>
                                <button type="submit" class="text-info cartIcon" title="Hoeveelheid verhogen">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </form>
                        <?php } ?>
                    </td>

                    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                        <?php if ($orderDetail->getQuantity() > 0) { ?>
                            <form method="post" action="index.php?controller=Cart&action=decreaseUnits">
                                <input type="hidden" name="id" value="<?php echo $product->getId(); ?>"/>
                                <button type="submit" class="text-info cartIcon" title="Hoeveelheid verlagen">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </button>
                            </form>
                        <?php } ?>
                    </td>

                    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                        &euro;<?php echo sprintf('%.2f', $thisPrice); ?>
                    </td>
                </tr>

            <?php } ?>

            <!-- totaalrij -->
            <tr>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></td>
                <td class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></td>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Totaal:</th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                    &euro;<?php echo $totalPrice; ?>
                </th>
            </tr>

            </tbody>
        </table>


    <?php } else { ?>


        <p class="">
            Er zitten momenteel geen producten in het winkelmandje
        </p>


    <?php } ?>


</div>