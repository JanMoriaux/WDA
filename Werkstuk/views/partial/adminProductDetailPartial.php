<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 1/05/2017
 * Time: 21:35
 */
?>

<!-- afbeelding  -->
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
    <img class="img-rounded"
         src="./images/<?php echo $product->getImage(); ?>"
         alt="<?php echo $product->getImage(); ?>"
         title="<?php echo $product->getImage(); ?>"/>
</div>

<!-- product info -->
<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 pull-right">
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
            <td class="col-md-10">&euro; <?php echo sprintf('%.2f', $product->getPrice()); ?></td>
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
            <th class="col-md-2">Toegevoegd</th>
            <td class="col-md-10"><?php echo date('d-m-Y h:i:s', $product->getDateAdded()->getTimeStamp()); ?></td>
        </tr>
    </table>
</div>
