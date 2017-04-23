<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/03/2017
 * Time: 21:37
 */


$title = "Home";

require_once('./BoekDAO.php');


try {
    $dao = new BoekDAO();
    $result = $dao->getAllBooks();
    unset($dao);

} catch (mysqli_sql_exception $e) {
    $errormsg = $e->getMessage();

} catch (Exception $e) {
    $errormsg = $e->getMessage();
}

if(isset($_GET['message']) && !empty($_GET['message']))
    $message = $_GET['message'];

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../../Bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../../Style/custom.css"/>
    <meta lang="en" charset="UTF-8"/>
    <title><?php echo $title; ?></title>
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h1><?php echo $title; ?></h1>
    </div>
    <?php
    if(isset($message)){?>
        <div class="alert alert-info">
            <?php echo $message; ?></div>
        <?php
    }
    if (isset($errormsg)) { ?>
        <div class="alert alert-danger">
        <?php echo $errormsg; ?>
        </div><?php

    } //Boeken gevonden
    else if (isset($result) && $result->num_rows > 0) { ?>
        <table class="table">
        <tr>
            <th class="col-md-1">BoekId</th>
            <th class="col-md-4">Titel</th>
            <th class="col-md-2 text-center">Prijs Excl. BTW</th>
            <th class="col-md-2 text-center">Prijs Incl. BTW</th>
            <th class="col-md-1 text-center">Detail</th>
            <th class="col-md-2 text-center">Delete</th>
        </tr>
        <?php
        foreach ($result as $boek) {
            $prijsInclBtw = $boek['PrijsExclBtw'] * 1.06;
            $prijsExclBtwString = number_format($boek['PrijsExclBtw'], 2, ',', '.');
            $prijsInclBtwString = number_format($prijsInclBtw, 2, ',', '.');
            ?>
            <tr>
            <td><?php echo $boek['BoekId']; ?></td>
            <td><?php echo $boek['Titel']; ?></td>
            <td class="text-center"><?php echo '€ ' . $prijsExclBtwString; ?></td>
            <td class="text-center"><?php echo '€ ' . $prijsInclBtwString; ?></td>
            <td class="text-center">
                <a href="<?php echo "./detail.php?bookId=".$boek['BoekId']; ?>"
                   class="btn btn-info btn-xs"><span class="glyphicon glyphicon-info-sign"></span></a>
            </td>
            <td class="text-center">
                <form action="removebook.php" method="post">
                    <input type="hidden" name="boekid"
                           value="<?php echo $boek['BoekId']; ?>"/>
                    <button type="submit" class="btn btn-danger btn-xs">
                        <span class="glyphicon glyphicon-trash"/>
                    </button>
                </form>
            </td>
            </tr><?php
        }
        ?>
        </table><?php
        $result->close();
    } else {
        $result->close(); ?>
        <div class="alert alert-warning">
            Geen boeken teruggevonden in de database!
        </div><?php
    }
    ?>
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li>
                <a class="" href="insertbook.php">Insert Page</a>
            </li>
        </ul>
    </nav>
</div>
</body>
</html>