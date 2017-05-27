<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 8:37
 */

?>
<form class="form" action="index.php?controller=Cart&action=<?php echo
(isset($_SESSION['currentAction']) && !empty($_SESSION['currentAction'])) ?
    $_SESSION['currentAction'] : ''; ?>" method="post">


    <!-- id -->
    <input type="hidden" value="<?php echo(isset($values['id']) ? $values['id'] : '' ) ?>" name="id" />
    <!-- /id -->

    <!--street -->
    <div class="form-group">
        <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="street"> Straat:</label>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label class="error-label control-label" id="streetError">
                <?php echo(isset($errors['street']) ? $errors['street'] : ''); ?>
            </label>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <input class="form-control" type="text" name="street" id="street"
                   value="<?php echo(isset($values['street']) ? $values['street'] : ''); ?>"
                   placeholder="Straat"/>
        </div>
    </div>
    <!-- /street -->

    <!-- number -->
    <div class="form-group">
        <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="number">Huisnummer:</label>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label class="error-label control-label" id="numberError">
                <?php echo(isset($errors['number']) ? $errors['number'] : ''); ?>
            </label>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <input class="form-control" type="text" name="number" id="number"
                   value="<?php echo(isset($values['number']) ? $values['number'] : ''); ?>"
                   placeholder=""/>
        </div>
    </div>
    <!-- /number -->

    <!-- bus -->
    <div class="form-group">
        <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="bus">Bus:</label>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label class="error-label control-label" id="busError">
                <?php echo(isset($errors['bus']) ? $errors['bus'] : ''); ?>
            </label>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <input class="form-control" type="text" name="bus" id="bus"
                   value="<?php echo(isset($values['bus']) ? $values['bus'] : ''); ?>"
                   placeholder="bus"/>
        </div>
    </div>
    <!-- /bus -->

    <!--- postalCode-->
    <div class="form-group">
        <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="postalCode">Postcode:</label>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label class="error-label control-label" id="postalCodeError">
                <?php echo(isset($errors['postalCode']) ? $errors['postalCode'] : ''); ?>
            </label>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <input class="form-control" type="text" name="postalCode" id="postalCode"
                   value="<?php echo(isset($values['postalCode']) ? $values['postalCode'] : ''); ?>"
                   placeholder="####"/>
        </div>
    </div>
    <!--- /postalCode-->


    <!-- city -->
    <div class="form-group">
        <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="city">Plaats:</label>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label class="error-label control-label" id="cityError">
                <?php echo(isset($errors['city']) ? $errors['city'] : ''); ?>
            </label>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <input class="form-control" type="text" name="city" id="city"
                   value="<?php echo(isset($values['city']) ? $values['city'] : ''); ?>"
                   placeholder="Zwevezele"/>
        </div>
    </div>
    <!-- city -->

    <!-- bij invoeren leveringsadres checkbox aangeven dat adressen zelfde zijn-->
    <?php
    if (isset($_SESSION['currentAction']) && !empty(['currentAction'])) {
        if ($_SESSION['currentAction'] === 'addDeliveryAddress') {
            ?>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <label><input type="checkbox" name="addressesaresame" value="true" id="addressesaresame"/>
                    Leverings- en facturatieadres zijn hetzelfde
                </label>
            </div>

        <?php
        }
    } ?>
    <!-- /checkbox -->

    <!-- submit -->
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <input class="btn btn-primary btn-lg" type="submit"
                   value="Adres toevoegen"/>
        </div>
    </div>
    <!-- /submit -->

    <!-- script -->
    <script src="./views/js/validationRules.js"></script>
    <script src="./views/js/addressFormValidation.js"></script>
    <!-- /script -->

</form>
