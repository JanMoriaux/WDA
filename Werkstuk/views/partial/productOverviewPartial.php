<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 4/05/2017
 * Time: 11:52
 */
if (count($products) > 0) { ?>
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