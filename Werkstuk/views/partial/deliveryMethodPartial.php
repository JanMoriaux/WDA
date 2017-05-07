<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 11:22
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label for="delivery<?php echo $deliveryMethod->getId();?>" class="deliveryMethodLabel">
        <input type="radio"
               name="deliveryMethod"
               id="delivery<?php echo $deliveryMethod->getId();?>"
               value="<?php echo $deliveryMethod->getId();?>" />
        <?php echo $deliveryMethod->getDescription(); ?>
        <span class="text-info">(+&euro;<?php echo $deliveryMethod->getPrice(); ?>)</span>
    </label>
</div>
