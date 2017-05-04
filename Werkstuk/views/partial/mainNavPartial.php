<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 22:16
 */
require_once ROOT . '/models/entities/User.php';
?>
<!-- navigatie -->
<nav class="navbar navbar-fixed-top" id="mainNavBar">
    <div class="container">
        <!-- navbar brand en links collapse-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Tiny Clouds</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php?controller=Product&action=index">Producten</a>
                </li>
                <li>
                    <a href="index.php?controller=Admin&action=index">Admin</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                    <a class=""
                       href="index.php?controller=Cart&action=overview">
                        Winkelmandje
                    </a>
                </li>
            </ul>
            <?php
            //loginveld indien geen user aangemeld
            //is admin aangelogd?
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['user'])) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="" href="index.php?controller=User&action=register">Registreren</a>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" method="post"
                      action="index.php?controller=User&action=login">
                    <div class="form-group">
                        <input type="text" class="form-control" name="userName" placeholder="Gebruikersnaam">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Wachtwoord">
                    </div>
                    <div class="navbar-btn checkbox">
                        <label class=small for="keeploggedin">
                            <input class="autosubmit" id="keeploggedin" type="checkbox" name="keeploggedin" value="true">
                            Onthoud mij
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Aanmelden</button>
                </form>

            <?php } else { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <p class="navbar-text" ><?php echo $_SESSION['user']->getFirstName() . ' ' . $_SESSION['user']->getLastName();  ?></p>
                    </li>
                    <li>
                        <a class=""
                           href="index.php?controller=User&action=logout">Afmelden</a>
                    </li>
                </ul>
            <?php } ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
