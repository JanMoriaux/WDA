<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 11:56
 */
?>

        <div class="form-group">
            <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="userName">Gebruikersnaam:</label>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="error-label control-label">
                    <?php echo(isset($errors['userName']) ? $errors['userName'] : ''); ?>
                </label>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <input class="form-control" type="text" name="userName" id="userName"
                       value="<?php echo(isset($values['userName']) ? $values['userName'] : ''); ?>"
                       placeholder="Gebruikersnaam"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="password">Wachtwoord:</label>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="error-label control-label">
                    <?php echo(isset($errors['password']) ? $errors['password'] : ''); ?>
                </label>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <input class="form-control" type="password" name="password" id="password"
                       value="<?php echo(isset($values['password']) ? $values['password'] : ''); ?>"
                       placeholder="Wachtwoord"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input class="btn btn-primary btn-lg" type="submit"
                       value="Inloggen"/>
            </div>
        </div>

