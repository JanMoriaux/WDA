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
} else{
    echo '<div class="alert alert-warning">Geen producten teruggevonden</div>';
}


