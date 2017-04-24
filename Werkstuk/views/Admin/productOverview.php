<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/04/2017
 * Time: 20:10
 */
?>
<div class="col-md-12">
    <table class="table" id="admin_product_table">
        <thead>
        <tr>
            <th class="col-md-1">Id</th>
            <th class="col-md-1">Naam</th>
            <th class="col-md-1 text-right">Prijs</th>
            <th class="col-md-1 text-center">Uitgelicht</th>
            <th class="col-md-1 text-right">Stock</th>
            <th class="col-md-1 text-right">Toegevoegd</th>
            <th class="col-md-1">Wijzig</th>
            <th class="col-md-1">Verwijder</th>
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
                <td class="col-md-1 text-right"><?php echo $product->getInStock(); ?></td>
                <td class="col-md-1 text-right">
                    <?php echo date('d/m/Y',
                        $product->getDateAdded()->getTimestamp());
                    $product->getDateAdded(); ?></td>
                <td class="col-md-1 text-center">
                    <a class="text-info"
                       href="/WDA/Werkstuk/index.php?controller=Admin&action=editProduct&id=<?php echo $product->getId(); ?>"
                       title="/WDA/Werkstuk/index.php?controller=Admin&action=editProduct&id=<?php echo $product->getId(); ?>">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a></td>
                <td class="col-md-1 text-center">
                    <a class="text-danger"
                       href="/WDA/Werkstuk/index.php?controller=Admin&action=deleteProduct&id=<?php echo $product->getId(); ?>"
                       title="/WDA/Werkstuk/index.php?controller=Admin&action=deleteProduct&id=<?php echo $product->getId(); ?>">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

