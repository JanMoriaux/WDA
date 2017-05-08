<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:36
 */
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class=""><?php echo $thisProduct->getName(); ?>&nbsp;</h3>
        </div>
        <div class="panel-body">

            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6" id="productImage">
                <!-- image -->
                <div class="panel-default">
                    <img src="./images/<?php echo $thisProduct->getImage(); ?>"
                         title="<?php echo $thisProduct->getName(); ?>"
                         alt="<?php echo $thisProduct->getName(); ?>"
                    />
                </div>
                <!-- /image -->

                <!-- status winkelmandje -->
                <div class="panel-default text-center">
                    <?php if ($thisProduct->getInStock() <= 0) { ?>
                        <h3 class="">
                            <span class="label label-danger">Niet in voorraad</span>
                        </h3>
                    <?php } else {

                        $inCart = false;

                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (isset($_SESSION['cart'])) {
                            $cart = $_SESSION['cart'];
                            foreach ($cart->getOrderDetails() as $orderDetail) {
                                if ($orderDetail->getProductId() === $thisProduct->getId()) {
                                    $inCart = true;
                                    break;
                                }
                            };
                        }
                        if (!$inCart) { ?>

                            <form class="addToCartForm" method="post"
                                  action="index.php?controller=Cart&action=addProduct"
                                  id="add<?php echo $thisProduct->getId(); ?>">
                                <input type="hidden" name="id" value="<?php echo $thisProduct->getId(); ?>"/>
                                <button type="submit" class="btn-large cartIcon addToCartButtonDetail"
                                        id="submit<?php echo $thisProduct->getId(); ?>">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                </button>
                            </form>

                        <?php } else { ?>

                            <h3 class="">
                                <span class="label label-info">Toegevoegd</span>
                            </h3>
                            <?php
                        }
                    } ?>
                </div>
                <!-- status winkelmandje -->
            </div>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-6" id="productDetails">
                <p><strong>Categorie: </strong></p>
                <p><?php echo $thisCategory->getDescription() ?></p>
                <p><strong>Beschrijving: </strong></p>
                <p><?php echo $thisProduct->getDescription(); ?></p>
                <p><strong>Prijs: </strong></p>
                <span>&euro;<?php echo sprintf('%.2f', $thisProduct->getPrice()); ?></span>
            </div>
        </div>
    </div>


    <div class="" id="ratings">

        <?php
        //indien er ratings zijn voor het product tonen we deze
        if (!empty($allRatings = RatingDB::getByProductId($thisProduct->getId()))) {
            ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Andere gebruikers over dit product:</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $teller = 0;
                    foreach ($allRatings as $rating) {
                        if ($teller == 3)
                            break;
                        include ROOT . '/views/partial/ratingViewPartial.php';
                        $teller++;
                    } ?>
                </div>
            </div>

        <?php } else { ?>

            <div class="panel-default">
                <div class="panel-footer">
                    <h4>Er zijn nog geen beoordelingen voor dit product</h4>
                </div>
            </div>

            <?php
        }

        //indien gebruiker is ingelogd kan hij een rating achterlaten
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            //indien de gebruiker al een beoordeling aan dit product heeft gegeven
            //tonen we de boodschap 'beoordeling toegevoegd', anders tonen we een form voor beoordeling
            if (RatingDb::getByUserIdAndProductId($_SESSION['user']->getId(), $thisProduct->getId())) {
                ?>


                <div class="panel-success">
                    <div class="panel-heading">
                        <h4>U heeft dit product een beoordeling gegeven</h4>
                    </div>
                </div>


            <?php } else { ?>
                <div class="panel-default">
                    <div class="panel-heading">
                        <h3> Beoordeel dit product </h3>
                    </div>
                    <div class="panel-body">
                        <?php include_once ROOT . '/views/partial/ratingFormPartial.php' ?>
                    </div>
                </div>

            <?php } ?>


        <?php } else { ?>

            <div class="panel-default">
                <div class="panel-heading">
                    <h3>Gelieve eerst aan te melden om een beoordeling aan dit product te geven</h3>
                </div>
                <div class="panel-body">
                    <?php include ROOT . '/views/User/login.php' ?>
                </div>
            </div>
        <?php } ?>
    </div>


    <div class="panel-default">
        <div class="panel-heading">
            <h3>Andere producten in categorie <?php
                echo $thisCategory->getDescription(); ?></h3>
        </div>
        <div class="row">
            <?php
            //vier andere producten uit dezelde categorie

            $productsInCategory = ProductDb::getByCategoryId($thisCategory->getId());
            $products = array();
            shuffle($productsInCategory);

            $teller = 0;
            foreach ($productsInCategory as $product) {
                if ($teller === 4) {
                    break;
                }
                if ($product->getId() !== $thisProduct->getId()) {
                    array_push($products, $product);
                    $teller++;
                }
            }
            include_once ROOT . '/views/partial/productOverviewPartial.php'
            ?>
        </div>
    </div>
</div>
