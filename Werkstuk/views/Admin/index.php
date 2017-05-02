<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/04/2017
 * Time: 19:42
 */

//controleren of user is aangemeld en admin rechten heeft
//indien niet login form tonen
if (!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin()) {

    include_once ROOT . '/views/Admin/login.php';

} else { ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Dag <?php echo $_SESSION['user']->getUserName(); ?>! Welkom in het administratieportaal!</h3>
    </div>

<?php } ?>

