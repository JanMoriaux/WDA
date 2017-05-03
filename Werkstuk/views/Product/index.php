<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:23
 */
?>
<div id="productOverview">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="pageTitle">
        <?php if (isset($categoryId) && !empty($categoryId)) { ?>
            <h2><?php echo CategoryDb::getById($categoryId)->getDescription(); ?></h2>
        <?php } else { ?>
            <h2>Alle Producten</h2>
        <?php } ?>
    </div>

    <?php if (count($products) > 0) { ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <?php foreach ($products as $product) {
                include ROOT . '/views/partial/productThumbnailPartial.php';
            } ?>

            <script src="./views/js/cartIconScript.js"></script>

        </div>
    <?php } else { ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <p class="alert alert-warning">Geen producten teruggevonden!</p>

        </div>

    <?php } ?>
</div>




