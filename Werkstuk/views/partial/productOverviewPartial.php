<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 23/04/2017
 * Time: 8:27
 */
?>

<div class="col-xs-12 col-sm-3 col-lg-3 col-md-3">
    <div class="thumbnail">
        <div class="imageholder">
            <a href="/WDA/Werkstuk/index.php?controller=Product&action=showDetail&id=
            <?php echo $product->getId(); ?>">
                <img class=""
                     src="<?php echo '/WDA/Werkstuk/images/' . $product->getImage(); ?>"
                     alt="<?php echo $product->getName() ?>"
                     title="<?php echo $product->getName() ?>">
            </a>
        </div>
        <div class="caption">
            <h5 class="pull-right">&euro; <?php echo $product->getPrice(); ?></h5>
            <h5><a href="/WDA/Werkstuk/index.php?controller=Product&action=showDetail&id=
            <?php echo $product->getId(); ?>">
                    <?php echo $product->getName() ?></a>
            </h5>
            <!-- <p><?php echo $product->getDescription() ?></p> -->
        </div>
        <div class="cart">
            <p class="pull-right"><a href="#">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                </a></p>
        </div>
    </div>
</div>
