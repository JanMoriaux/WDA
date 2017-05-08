<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 8/05/2017
 * Time: 10:36
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php if (isset ($errorMessage) && !empty($errorMessage)) { ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="alert alert-danger"><?php echo $errorMessage; ?></p>

        </div>

    <?php } else{ ?>

    <h2>Overzicht bestellingen:</h2>
    <div class="panel-default">

        <table class="table " id="admin_product_table">
            <thead>
            <tr>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Id</th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Gebruiker</th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">Datum</th>
                <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">Detail</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($orders as $order) {
                $user = UserDb::getById($order->getUserId());
                $date = date('d-m-Y', $order->getDateOrdered()->getTimeStamp()); ?>
            <tr>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><?php echo $order->getId(); ?></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><?php echo $user->getLastName() . ' ' . $user->getFirstName(); ?></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"><?php echo $date; ?></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                    <a class="text-info"
                       href="index.php?controller=Admin&action=showOrder&id=<?php echo $order->getId(); ?>"
                       title="Admin Show Detail Product <?php echo $order->getId(); ?>">
                        <span class="glyphicon glyphicon-search"></span>
                    </a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>

