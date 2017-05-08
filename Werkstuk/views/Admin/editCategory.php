<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 15:36
 */

//bericht in verband met geslaagde update
if (isset($categoryUpdated)) {
    if ($categoryUpdated) {
        ?>
        <div class="col-md-12">
            <div class="alert alert-info">Categorie gewijzigd</div>
        </div><?php
    } else { ?>
        <div class="col-md-12">
            <div class="alert alert-danger col-md-9">Probleem met database: Categorie niet gewijzigd</div>
        </div>
        <?php
    }
}
//product form tonen
if ($category != null) { ?>

    <div class="col-md-12">

        <form class="form"
              action="index.php?controller=Admin&action=editCategory&id=<?php echo $category->getId();?>"
              method="post">
            <h2>Categorie <?php echo $values['id'];?> wijzigen?</h2>

            <?php require_once ROOT . '/views/partial/categoryFormPartial.php'; ?>

        </form>
    </div>
    <?php } else { ?>
    <div class="col-md-12">
        <div class="alert alert-warning">Category niet teruggevonden!</div>
    </div>
<?php } ?>
