<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 21:23
 */
?>
<p>Here is a list of all products:</p>

<?php foreach($products as $product) { ?>
    <p>
        <?php echo $product->getName(); ?>
        <a href='/WDA/Werkstuk/index.php?controller=Product&action=showDetail&id=<?php echo $product->getId(); ?>'>Bekijk product</a>
    </p>
<?php } ?>