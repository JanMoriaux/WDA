<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 9:37
 */
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php if (isset($product) && $product) { ?>

        <h3>Detail Product: <?php echo $product->getName(); ?></h3>

        <!-- product detail -->
        <?php require_once ROOT . '/views/partial/adminProductDetailPartial.php';

    } else { ?>
        <div class="col-md-12">
            <div class="alert alert-warning">Product niet teruggevonden!</div>
        </div>

    <?php } ?>
</div>
