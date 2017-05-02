<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:55
 */
require_once ROOT . '/models/entities/ShoppingCart.php';

?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p class="lead">Welkom in onze webwinkel!!</p>
    <div class="">
        <p class="">Onze laatste aanwinsten...</p>
        <?php if (isset($new) && $new != null) {

            foreach ($new as $product) {
                include ROOT . '/views/partial/productThumbnailPartial.php';
            }

        } ?>
    </div>
    <div class="">
        <p class="">In de kijker</p>
        <?php if (isset($highLighted) && $highLighted != null) {

            foreach($highLighted as $product){
                include ROOT . '/views/partial/productThumbnailPartial.php';
            }

        } ?>

    </div>
</div>



