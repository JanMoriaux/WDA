<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 11:56
 */
?>

        <div class="form-group">
            <label class="control-label col-md-6" for="userName">Gebruikersnaam:</label>
            <div class="col-md-6">
                <label class="error-label control-label">
                    <?php echo(isset($errors['userName']) ? $errors['userName'] : ''); ?>
                </label>
            </div>
            <div class="col-md-12">
                <input class="form-control" type="text" name="userName" id="userName"
                       value="<?php echo(isset($values['userName']) ? $values['userName'] : ''); ?>"
                       placeholder="Gebruikersnaam"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-6" for="password">Wachtwoord:</label>
            <div class="col-md-6">
                <label class="error-label control-label">
                    <?php echo(isset($errors['password']) ? $errors['password'] : ''); ?>
                </label>
            </div>
            <div class="col-md-12">
                <input class="form-control" type="text" name="password" id="password"
                       value="<?php echo(isset($values['password']) ? $values['password'] : ''); ?>"
                       placeholder="Wachtwoord"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-2">
                <input class="btn btn-primary btn-lg" type="submit"
                       value="Inloggen"/>
            </div>
        </div>

