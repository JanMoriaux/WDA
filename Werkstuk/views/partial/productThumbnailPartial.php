<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 23/04/2017
 * Time: 8:27
 */

?>


<div class="col-xs-12 col-sm-4 col-lg-3 col-md-3 ">

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
        <div class="cart col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class=" pull-left ">&euro;<?php echo sprintf('%.2f', $product->getPrice()); ?></h4>

            <?php

            //als item in winkelmandje zit tonen we dit in de thumbnail
            //anders is er de mogelijkheid om het toe te voegen aan het mandje
            //indien out of stock wordt dit ook getoond

            if ($product->getInStock() <= 0) { ?>

                <h4 class="label label-danger pull-right">Niet in voorraad</h4>

            <?php } else {

            $inCart = false;

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
                foreach ($cart->getOrderDetails() as $orderDetail) {
                    if ($orderDetail->getProductId() === $product->getId()) {
                        $inCart = true;
                        break;
                    }
                };
            }
            if (!$inCart){
                ?>
                <form class="pull-right" method="post"
                      action="index.php?controller=Cart&action=addProduct">
                    <input type="hidden" name="id" value="<?php echo $product->getId(); ?>"/>
                    <button type="submit" class="cartIcon">
                        <span class="glyphicon glyphicon-shopping-cart"/>
                    </button>
                </form>
                <?php
            }else{
            ?>

            <h4 class="label label-info pull-right">Toegevoegd<h4><?php
            }
            } ?>
        </div>
    </div>
</div>



