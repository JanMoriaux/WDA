<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 16:23
 **/

?>

<div class="col-md-12">

<?php //berichten in verband met product verwijderen
if(isset($errorMessage)){?>

    <div class="alert alert-warning">
        <?php echo $errorMessage; ?>
    </div>

<?php }
else if (!isset($categoryDeleted) && $category) { ?>

<h3>Categorie <?php echo $category->getDescription(); ?> verwijderen?</h3>

<?php } else if (!$categoryDeleted) { ?>

    <div class="alert alert-warning">
        Probleem met database: Categorie niet verwijderd!
    </div>

<?php } else if ($categoryDeleted) { ?>
    <div class="alert alert-info">
        Categorie verwijderd!
    </div>
<?php }
?>

<?php
//verwijder post form enkel tonen indien geen poging gedaan om product te verwijderen
//of geen FK constraints op category id

if (!isset($categoryDeleted) && !isset($errorMessage)) { ?>
    <div class="">
        <form class="form" method="POST"
              action="index.php?controller=Admin&action=deleteCategory">
            <input type="hidden" name="id" value="<?php echo $category->getId() ?>"/>
            <input type="submit" class="btn btn-primary col-md-2" value="Verwijder"/>
        </form>
    </div>
<?php }?>

</div>



