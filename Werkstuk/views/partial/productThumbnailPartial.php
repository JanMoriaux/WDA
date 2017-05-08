<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 23/04/2017
 * Time: 8:27
 */

?>


<div class="col-xs-12 col-sm-6 col-lg-3 col-md-3 productHolder">

    <div class="thumbnail">
        <div class="imageholder col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <a href="index.php?controller=Product&action=showDetail&id=<?php echo $product->getId(); ?>">
                <?php echo $product->isHighLighted() ?
                    '<span class="glyphicon glyphicon-star"></span>' : ''; ?>
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
        <div class="cart col-lg-12 col-md-12 col-sm-12 col-xs-12" id="cart<?php echo $product->getID(); ?>">
            <h5><span class="pull-left text-info">&euro;<?php echo sprintf('%.2f', $product->getPrice()); ?></span></h5>

            <?php

            //als item in winkelmandje zit tonen we dit in de thumbnail
            //anders is er de mogelijkheid om het toe te voegen aan het mandje
            //indien out of stock wordt dit ook getoond

            if ($product->getInStock() <= 0) { ?>

                <h5><span class="label label-danger pull-right">Uitverkocht</span></h5>

            <?php } else {

                $inCart = false;

                if (isset($_SESSION['cart'])) {
                    $cart = $_SESSION['cart'];
                    foreach ($cart->getOrderDetails() as $orderDetail) {
                        if ($orderDetail->getProductId() === $product->getId()) {
                            $inCart = true;
                            break;
                        }
                    };
                }
                if (!$inCart) {
                    ?>

                    <form class="pull-right addToCartForm" method="post"
                          action="index.php?controller=Cart&action=addProduct"
                          id="add<?php echo $product->getId(); ?>">
                        <input type="hidden" name="id" value="<?php echo $product->getId(); ?>"/>
                        <button type="submit" class="cartIcon addToCartButton"
                                id="submit<?php echo $product->getId(); ?>">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                        </button>
                    </form>

                    <?php
                } else {
                    ?>

                    <h5><span class="label label-info pull-right">Toegevoegd</span></h5><?php

                }
            } ?>
        </div>
    </div>
</div>



