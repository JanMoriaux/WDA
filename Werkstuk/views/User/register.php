<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 14:30
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php if (!isset($userAdded) || empty($userAdded)) { ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="pageTitle">
            <h2>Gebruiker Registreren</h2>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form class="form" method="post" action="index.php?controller=User&action=register" id="userRegistrationForm">

                <div class="form-group">
                    <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="firstName">
                        Voornaam:</label>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="error-label control-label" id="firstNameError">
                            <?php echo(isset($errors['firstName']) ? $errors['firstName'] : ''); ?>
                        </label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input class="form-control" type="text" name="firstName" id="firstName"
                               value="<?php echo(isset($values['firstName']) ? $values['firstName'] : ''); ?>"
                               placeholder="Voornaam"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="lastName">Achternaam:</label>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="error-label control-label" id="lastNameError">
                            <?php echo(isset($errors['lastName']) ? $errors['lastName'] : ''); ?>
                        </label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input class="form-control" type="text" name="lastName" id="lastName"
                               value="<?php echo(isset($values['lastName']) ? $values['lastName'] : ''); ?>"
                               placeholder="Achternaam"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="userName">Gebruikersnaam:</label>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="error-label control-label" id="userNameError">
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
                        <label class="error-label control-label" id="passwordError">
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
                    <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="repeatPassword">Herhaal Wachtwoord:</label>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="error-label control-label" id="repeatPasswordError">
                            <?php echo(isset($errors['repeatPassword']) ? $errors['repeatPassword'] : ''); ?>
                        </label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input class="form-control" type="password" name="repeatPassword" id="repeatPassword"
                               value="<?php echo(isset($values['repeatPassword']) ? $values['repeatPassword'] : ''); ?>"
                               placeholder="Herhaal wachtwoord"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="email">Email:</label>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="error-label control-label" id="emailError">
                            <?php echo(isset($errors['email']) ? $errors['email'] : ''); ?>
                        </label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input class="form-control" type="text" name="email" id="email"
                               value="<?php echo(isset($values['email']) ? $values['email'] : ''); ?>"
                               placeholder="jan.janssen@voorbeeld.com"/>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label><input type="checkbox" name="keeploggedin" value="true" id="keeploggedin" />
                        Aangemeld blijven
                    </label>
                </div>

                <div class="form-group">
                    <div class="col-md-2">
                        <input class="btn btn-primary btn-lg" type="submit"
                               value="Registreren"/>
                    </div>
                </div>
            </form>
        </div>
        <script src="./views/js/validationRules.js"></script>
        <script src="./views/js/userRegistrationFormValidation.js"></script>

    <?php } else { ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="pageTitle">
            <h2>U ben geregistreerd!</h2>
        </div>


    <?php } ?>




