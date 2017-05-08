<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 16:14
 */

//bericht in verband met geslaagde update
if (isset($categoryAdded)) {
    if ($categoryAdded) {
        ?>
        <div class="col-md-12">
            <div class="alert alert-info">Categorie toegevoegd</div>
        </div><?php
    } else { ?>
        <div class="col-md-12">
            <div class="alert alert-danger col-md-12">Probleem met database: Categorie niet toegevoegd</div>
        </div>
        <?php
    }
}
//product form tonen ?>
    <div class="col-md-12">

        <form class="form"
              action="index.php?controller=Admin&action=insertCategory"
              method="post">
            <div class="form-group">
                <h2>Categorie Toevoegen</h2>
            </div>

            <?php require_once ROOT . '/views/partial/categoryFormPartial.php'; ?>

        </form>
    </div>
