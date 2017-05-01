<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 23/04/2017
 * Time: 19:41
 * Vult de sidebar in met een lijst van de beschikbare productcategoriën of adminfuncties
 */
require_once ROOT . '/models/database/CRUD/CategoryDb.php';
?>

<div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">
    <p class="lead"> Tiny Clouds </p>
    <div class="list-group">

        <!-- sidebar met de verschillende productcategorieën -->
        <?php if (isset($categorySidebar) && $categorySidebar) {
            foreach (CategoryDb::getAll() as $category) { ?>
                <a href=
                   "index.php?controller=Product&action=showCategory&id=<?php echo $category->getId(); ?>"
                   title=
                   "Category <?php echo $category->getId(); ?>"
                   class="list-group-item"><?php echo $category->getDescription(); ?></a>
            <?php }
        } else if (isset($adminfunctions) && $adminfunctions) { ?>

            <!-- sidebar met de verschillende beheersfuncties -->
            <a class="list-group-item"
               href="index.php?controller=Admin&action=productOverview"
               title="Admin Product Overview">Product Overzicht</a>
            <a class="list-group-item"
               href="index.php?controller=Admin&action=insertProduct"
               title="Admin Add Product">Product Toevoegen</a>
            <a class="list-group-item"
               href="index.php?controller=Admin&action=categoryOverview"
               title="Admin Category Overview">Categorie Overzicht</a>
            <a class="list-group-item"
               href="index.php?controller=Admin&action=insertCategory"
               title="Admin Add Category">Categorie Toevoegen</a>
            <a class="list-group-item"
               href="#">Overzicht bestellingen TODO</a>
            <a class="list-group-item"
               href="#">Beheerder toevoegen TODO</a>
        <?php } ?>

        <!-- TODO andere sidebar functies -->
    </div><!-- div.listgroup -->
</div><!-- div.col md 3 -->


