<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:36
 */

//TODO
?>



<ul>
    <li>id: <?php echo $product->getId(); ?></li>
    <li>name: <?php echo $product->getName(); ?></li>
    <li>description: <?php echo $product->getDescription(); ?></li>
    <li>price: <?php echo $product->getPrice(); ?></li>
    <li>highlighted: <?php echo $product->isHighLighted(); ?></li>
    <li>categoryId: <?php echo $product->getCategoryId(); ?></li>
</ul>
