<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/04/2017
 * Time: 22:07
 *
 *
 * Bij een ongeldig formulier worden de waarden terug naar de controller
 * en action die bij deze view horen gepost.
 *
 */

//require_once ROOT . '/models/database/CRUD/ProductDb.php';


//bericht in verband met geslaagde update
if (isset($productUpdated)) {
    if ($productUpdated) {
        ?>
        <div class="col-md-12">
            <div class="alert alert-info">Product gewijzigd</div>
        </div><?php
    } else { ?>
        <div class="col-md-12">
            <div class="alert alert-danger col-md-9">Probleem met database: product niet gewijzigd</div>
        </div>
        <?php
    }
}
//product form tonen
if ($product != null) {

    //product form
    require_once ROOT . '/views/partial/productFormPartial.php';


} else { ?>
    <div class="col-md-12">
        <div class="alert alert-warning">Product niet teruggevonden!</div>
    </div>
<?php } ?>