<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 4/05/2017
 * Time: 11:52
 */
if (count($products) > 0) { ?>
    <div class="">

        <?php foreach ($products as $product) {
            include ROOT . '/views/partial/productThumbnailPartial.php';
        } ?>

        <script src="./views/js/cartIconScript.js"></script>

    </div>
<?php } else { ?>

    <div class="">

        <p class="alert alert-warning">Geen producten teruggevonden!</p>

    </div>

<?php } ?>