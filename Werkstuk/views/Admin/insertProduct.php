<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 10:12
 */



//bericht in verband met geslaagde insert
if (isset($productInserted)) {
    if ($productInserted) {
        ?>
        <div class="col-md-12">
            <div class="alert alert-info">Product toegevoegd</div>
        </div><?php
    } else { ?>
        <div class="col-md-12">
            <div class="alert alert-danger col-md-9">Probleem met database: product niet toegevoegd</div>
        </div>
        <?php
    }
}

require_once ROOT . '/views/partial/productFormPartial.php';

?>



