<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 23/04/2017
 * Time: 8:27
 */
?>

<div class="col-xs-12 col-sm-4 col-lg-3 col-md-3">

    <div class="thumbnail">
        <div class="imageholder col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <a href="index.php?controller=Product&action=showDetail&id=<?php echo $product->getId(); ?>">
                <?php echo $product->isHighLighted() ?
                '<span class="glyphicon glyphicon-star pull-left"></span>' : ''; ?>
                <img src="./images/<?php echo $product->getImage(); ?>"
                     alt="<?php echo $product->getName(); ?> " class="">
            </a>
        </div>
        <div class="caption col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4><a href="index.php?controller=Product&action=showDetail&id=<?php echo $product->getId(); ?>">
                    <?php echo $product->getName(); ?>
                </a>
            </h4>
        </div>
        <div class="cart col-lg-12 col-md-12 col-sm-12 col-xs-12>
            <h4 class="pull-left">&euro;<?php echo sprintf('%.2f', $product->getPrice()); ?></h4>
            <p class="pull-right">
                <a href="#" class="cartIcon">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                </a>
            </p>
        </div>
        <div class="cart">

        </div>
    </div>


</div>
