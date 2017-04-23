<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 2/04/2017
 * Time: 20:20
 */
if (isset($_GET['bookId']) && !empty($_GET['bookId'])) {

    $bookId = $_GET['bookId'];
    $error = '';
    $title = 'Detail Boek ' . $bookId;

    try {
        require_once('./BoekDAO.php');

        $dao = new BoekDAO();

        if ($result = $dao->getBookById($bookId)) {
            //retrieve book info
            if($result->num_rows === 1){
                $book = $result->fetch_array();
                $bookId = $book['BoekId'];
                $bookTitle = $book['Titel'];
                $yearMonthDayArray = explode('-',$book['Uitgavedatum']);
                $date = $yearMonthDayArray[2] . '/' . $yearMonthDayArray[1] . '/' . $yearMonthDayArray[0];
                $priceExclusive = $book['PrijsExclBtw'];
                $priceInclusive = $book['PrijsExclBtw'] * 1.06;
                $emailPublisher = $book['EmailUitgeverij'];
            }
            else {
                $error = "Geen detail teruggevonden voor BoekId " . $_GET['bookId'];
            }
            $result->close();
        }
        else {
            $error = "Geen detail teruggevonden voor BoekId " . $_GET['bookId'];
        }


        unset($dao);
    } catch (mysqli_sql_exception $e) {
        $error = $e->getMessage();
    } catch (exception $e) {
        $error = $e->getMessage();
    }
} else {
    header('location: ./home.php');
}
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
    if (!empty($error)) {
        ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php }
    else {
        ?>
        <div class="form form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-2">Titel</label>
                <div class="col-md-8">
                    <p class="form-control-static"><?php echo $bookTitle; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Uitgavedatum</label>
                <div class="col-md-8">
                    <p class="form-control-static"><?php echo $date; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Prijs Excl. BTW</label>
                <div class="col-md-8">
                    <p class="form-control-static"><?php echo number_format($priceExclusive, 2, ',', '.'); ?> &euro;</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Prijs Incl. BTW</label>
                <div class="col-md-8">
                    <p class="form-control-static"><?php echo number_format($priceInclusive, 2, ',', '.'); ?> &euro;</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Email Uitgeverij</label>
                <div class="col-md-8">
                    <p class="form-control-static"><?php echo $emailPublisher; ?></p>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li>
                <a href="home.php">Home</a>
            </li>
        </ul>
    </nav>
</div>
</body>
</html>



