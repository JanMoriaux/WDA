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
    <h3>Welkom in onze webwinkel</h3>
    <div class="jumbotron">
        <p>Nieuwste producten</p>
        <?php if(isset($newProducts) && $newProducts != null){
            foreach($newProducts as $product){
                include ROOT . '/views/partial/productThumbnailPartial.php';
            }


        }?>

    </div>
    <div class="jumbotron">
        <p>In de kijker</p>

    </div>
</div>



