<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 8:23
 */

require_once ROOT . '/models/database/CRUD/CategoryDb.php'; ?>

    <!-- product info -->
<?php ?>

    <!-- berichten in verband met product verwijderen -->
<?php if (!isset($productDeleted)) { ?>
    <div class="alert alert-warning col-md-12">
        Bent u zeker dat u het volgende product wil verwijderen?
    </div>
<?php } else if (!$productDeleted) { ?>
    <div class="alert alert-warning col-md-12">
        Probleem met de database: product niet verwijderd!
    </div>
<?php } else if ($productDeleted) { ?>
    <div class="alert alert-info col-md-12">
        Product verwijderd!
    </div>
<?php } ?>

    <!-- product detail -->
<?php require_once ROOT . '/views/Admin/showProduct.php'; ?>

    <!-- verwijder post form enkel tonen indien product niet werd verwijderd -->
<?php if (!isset($productDeleted)) { ?>
    <div class="col-md-12">
        <form class="form" method="POST"
              action="/WDA/Werkstuk/index.php?controller=Admin&action=deleteProduct">
            <input type="hidden" name="id" value="<?php echo $product->getId() ?>"/>
            <input type="submit" class="btn btn-primary col-md-2" value="Verwijder"/>
        </form>
    </div>

<?php } ?>



