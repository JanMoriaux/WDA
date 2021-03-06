<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:23
 */
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php if (isset ($errorMessage) && !empty($errorMessage)) { ?>

        <p class="alert alert-danger"><?php echo $errorMessage; ?></p>

    <?php } else { ?>

        <div id="productOverview">
            <div class="panel-default">
                <div class="panel-heading" id="pageTitle">
                    <?php if (isset($categoryId) && !empty($categoryId)) { ?>
                        <h2><?php echo CategoryDb::getById($categoryId)->getDescription(); ?></h2>
                    <?php } else { ?>
                        <h2>Alle Producten</h2>
                    <?php } ?>
                </div>
                <div class="row">

                    <?php include_once ROOT . '/views/partial/productOverviewPartial.php'; ?>

                </div>
            </div>
            
        </div>

    <?php } ?>

</div>










