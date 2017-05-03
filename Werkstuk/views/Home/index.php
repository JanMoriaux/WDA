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
    <h2>Welkom in onze webwinkel!!</h2>
    <div class="">
        <h3 class="">Onze laatste aanwinsten...</h3>
        <?php if (isset($new) && $new != null) {

            foreach ($new as $product) {
                include ROOT . '/views/partial/productThumbnailPartial.php';
            }

        } ?>
    </div>
    <div class="">
        <h3 class="">In de kijker</h3>
        <?php if (isset($highLighted) && $highLighted != null) {

            foreach($highLighted as $product){
                include ROOT . '/views/partial/productThumbnailPartial.php';
            }

        } ?>

    </div>

</div>

<script src="./views/js/cartIconScript.js" />


