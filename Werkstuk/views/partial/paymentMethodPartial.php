<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 11:10
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<label for="payment<?php echo $paymentMethod->getId();?>" class="paymentMethodLabel">
    <input type="radio"
           name="paymentMethod"
           id="payment<?php echo $paymentMethod->getId();?>"
           value="<?php echo $paymentMethod->getId();?>" />
    <img src="./images/<?php echo $paymentMethod->getDescription();?>.png"
        alt="<?php echo $paymentMethod->getDescription();?>"
         title="<?php echo $paymentMethod->getDescription();?>"
         class="img-thumbnail"
    />
</label>
</div>
