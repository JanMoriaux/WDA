<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 9:37
 */
if (isset($product)) { ?>
<!-- afbeelding -->
<div class="col-md-12">
    <div class="col-md-2">
        <img class="img-rounded"
             src="/WDA/Werkstuk/images/<?php echo $product->getImage(); ?>"
             alt="/WDA/Werkstuk/images/<?php echo $product->getImage(); ?>"
             title="/WDA/Werkstuk/images/<?php echo $product->getImage(); ?>"/>
    </div>

    <!-- product info -->
    <div class="col-md-10 pull-right">
        <table class="table">
            <tr>
                <th class="col-md-2">Id</th>
                <td class="col-md-10"><?php echo $product->getId(); ?></td>
            </tr>
            <tr>
                <th class="col-md-2">Naam</th>
                <td class="col-md-10"><?php echo $product->getName(); ?></td>
            </tr>
            <tr>
                <th class="col-md-2">Beschrijving</th>
                <td class="col-md-10"><?php echo $product->getDescription(); ?></td>
            </tr>
            <tr>
                <th class="col-md-2">Afbeelding</th>
                <td class="col-md-10"><?php echo $product->getImage(); ?></td>
            </tr>
            <tr>
                <th class="col-md-2">Prijs</th>
                <td class="col-md-10"><?php echo sprintf('%.2f', $product->getPrice()); ?></td>
            </tr>
            <tr>
                <th class="col-md-2">Uitgelicht</th>
                <td class="col-md-10"><?php echo $product->isHighlighted() ?
                        "<span class='glyphicon glyphicon-ok'></span>" : ''; ?></td>
            </tr>
            <tr>
                <th class="col-md-2">Category</th>
                <td class="col-md-10"><?php echo CategoryDb::getById($product->getCategoryId())->getDescription() ?></td>
            </tr>
            <tr>
                <th class="col-md-2">Toegevoegd op</th>
                <td class="col-md-10"><?php echo date('d-m-Y h:i:s', $product->getDateAdded()->getTimeStamp()); ?></td>
            </tr>
        </table>
    </div>
    <?php } else { ?>
        <div class="col-md-12">
            <div class="alert alert-warning">Product niet teruggevonden!</div>
        </div>
    <?php } ?>

