<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/04/2017
 * Time: 20:10
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <table class="table table-responsive" id="admin_product_table">
        <thead>
        <tr>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Id</th>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Naam</th>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">Prijs</th>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">Uitgelicht</th>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">Stock</th>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">Detail</th>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">Wijzig</th>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">Verwijder</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($products as $product) {
            ?>
            <tr>
                <td class="col-md-1"><?php echo $product->getId(); ?></td>
                <td class="col-md-1"><?php echo $product->getName(); ?></td>
                <td class="col-md-1 text-right">&euro; <?php echo sprintf('%.2f', $product->getPrice()); ?></td>
                <td class="col-md-1 text-center">
                    <?php echo $product->isHighLighted() ?
                        '<span class="glyphicon glyphicon-ok"></span>' : ''; ?></td>
                <td class="col-md-1 text-center"><?php echo $product->getInStock(); ?></td>
                <td class="col-md-1 text-center">
                    <a class="text-info"
                       href="index.php?controller=Admin&action=showProduct&id=<?php echo $product->getId(); ?>"
                       title="Admin Show Detail Product <?php echo $product->getId(); ?>">
                        <span class="glyphicon glyphicon-search"></span>
                    </a></td>
                <td class="col-md-1 text-center">
                    <a class="text-info"
                       href="index.php?controller=Admin&action=editProduct&id=<?php echo $product->getId(); ?>"
                       title="Admin Edit Product <?php echo $product->getId(); ?>">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a></td>
                <td class="col-md-1 text-center">
                    <a class="text-danger"
                       href="index.php?controller=Admin&action=deleteProduct&id=<?php echo $product->getId(); ?>"
                       title="Admin Delete Product <?php echo $product->getId(); ?>">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

