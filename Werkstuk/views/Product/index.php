<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:23
 */

if (count($products) > 0) {
    foreach ($products as $product) {
        include ROOT . '/views/partial/productOverviewPartial.php';
    }
} else { ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-warning">Geen producten teruggevonden</div>
    </div>'
<?php } ?>


