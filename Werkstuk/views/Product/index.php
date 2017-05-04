<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:23
 */
?>
<div id="productOverview">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="pageTitle">
        <?php if (isset($categoryId) && !empty($categoryId)) { ?>
            <h2><?php echo CategoryDb::getById($categoryId)->getDescription(); ?></h2>
        <?php } else { ?>
            <h2>Alle Producten</h2>
        <?php } ?>
    </div>

    <?php include_once ROOT . '/views/partial/productOverviewPartial.php'; ?>

</div>




