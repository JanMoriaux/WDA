<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:36
 */
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="productName">


        <h2 class="pull-left "><?php echo $product->getName(); ?>&nbsp;</h2>

        <?php if ($product->getInStock() <= 0) { ?>

            <h2 class="">
                <span class="label label-danger">Niet in voorraad</span>
            </h2>

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
            if (!$inCart) { ?>

                <form class="addToCartForm" method="post"
                      action="index.php?controller=Cart&action=addProduct"
                      id="add<?php echo $product->getId(); ?>">
                    <input type="hidden" name="id" value="<?php echo $product->getId(); ?>"/>
                    <button type="submit" class="cartIcon addToCartButtonDetail" id="submit<?php echo $product->getId(); ?>">
                        <h2 class="glyphicon glyphicon-shopping-cart"></h2>
                    </button>
                </form>

            <?php } else { ?>

                <h2 class="">
                <span class="label label-info">Toegevoegd</span>
                </h2>
            <?php
            }
        } ?>

    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="productInfo">

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6" id="productImage">
            <img src="./images/<?php echo $product->getImage(); ?>"
                 title="<?php echo $product->getName(); ?>"
                 alt="<?php echo $product->getName(); ?>"
            />
        </div>

        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-6" id="productDetails">
            <p><strong>Beschrijving: </strong></p>
            <p><?php echo $product->getDescription(); ?></p>
            <p><strong>Categorie: </strong></p>
            <p><?php echo CategoryDb::getById($product->getCategoryId())->getDescription(); ?></>
            <p><strong>Prijs: </strong></p>
            <span>&euro;<?php echo sprintf('%.2f', $product->getPrice()); ?></span>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="ratings">


    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="alsoInCategory">


    </div>

</div>











