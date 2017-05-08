<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 8/05/2017
 * Time: 11:53
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h2>Contact</h2>
    <!-- contactgegevens -->
    <div class="panel-default">
        <div class="panel-heading">
            <h3 class="text-info">Contactgegevens</h3>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                <li>Tiny Clouds</li>
                <li>Berkendreef 305</li>
                <li>8870 Emelgem</li>
                <li>&#x260E; 0499 24 15 08</li>
            </ul>
        </div>
    </div>
    <!-- contactgegevens -->

    <!-- mailen -->
    <div class="panel-default">
        <div class="panel-heading">
            <h3 class="text-info">Laat een bericht achter</h3>
        </div>
        <div class="panel-body">
            <?php if (isset($successMessage) && !empty($successMessage)){ ?>
                <p class="alert alert-success">
                    <?php echo $successMessage ?>
                </p>


            <? } else if (isset($errorMessage) && !empty($errorMessage)){ ?>
            <p class="alert alert-error">
                <?php echo $errorMessage ?>
                <a href="mailto:janmoriaux1@gmail.com">Mail Verzenden</a>
            </p>


            <?php }?>
            <p>Voer uw e-mailadres en bericht in en wij contacteren u zo snel mogelijk</p>
            <form method="post" action="index.php?controller=Home&action=contact">

                <!-- mailadres -->
                <div class="form-group">
                    <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="emailaddress">Email:</label>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="error-label control-label" id="emailaddressError">
                            <?php echo(isset($errors['emailaddress']) ? $errors['emailaddress'] : ''); ?>
                        </label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input class="form-control" type="text" name="emailaddress" id="emailaddress"
                               value="<?php echo(isset($values['emailaddress']) ? $values['emailaddress'] : ''); ?>"
                               placeholder="jan.janssens@voorbeeld.com"/>
                    </div>
                </div>
                <!-- /mailadres -->

                <!--bericht -->
                <div class="form-group">
                    <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="message">Bericht:</label>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="error-label control-label" id="messageError">
                            <?php echo(isset($errors['message']) ? $errors['message'] : ''); ?>
                        </label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <textarea rows="4" cols="50" class="form-control" name="message" id="message"
                                  placeholder=""><?php echo(isset($values['message']) ? $values['message'] : ''); ?>
                        </textarea>
                    </div>
                </div>
                <!-- bericht -->

                <!-- submit -->
                <div class="form-group">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <input class="btn btn-primary btn-lg" type="submit"
                               value="Verzenden"/>
                    </div>
                </div>
                <!-- /submit -->
            </form>

            <!-- script -->
            <script src="./views/js/validationRules.js"></script>
            <script src="./viewS/js/mailFormValidation.js"></script>
            <!-- script -->

        </div>
    </div>
    <!-- mailen -->
</div>
