<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 23/04/2017
 * Time: 19:41
 * Vult de sidebar in met een lijst van de beschikbare productcategoriën
 */
?>

<div class="col-md-3">
    <p class="lead"> Tiny Clouds </p>
    <div class="list-group">

        <!-- sidebar met de verschillende productcategorieën -->
        <?php if (isset($categories) && !empty($categories)) {
            foreach ($categories as $category) { ?>
                <a href=
                   "/WDA/Werkstuk/index.php?controller=Product&action=showCategory&id=<?php echo $category->getId(); ?>"
                   title=
                   "/WDA/Werkstuk/index.php?controller=Product&action=showCategory&id=<?php echo $category->getId(); ?>"
                   class="list-group-item"><?php echo $category->getDescription(); ?></a>
            <?php }
        } //sidebar met verschillende beheerfuncties
        else if (isset($adminfunctions) && $adminfunctions) { ?>
            <a class="list-group-item"
               href="/WDA/Werkstuk/index.php?controller=Admin&action=productOverview"
               title="/WDA/Werkstuk/index.php?controller=Admin&action=productOverview">Product Overzicht</a>
            <a class="list-group-item"
               href="/WDA/Werkstuk/index.php?controller=Admin&action=insertProduct"
               title="/WDA/Werkstuk/index.php?controller=Admin&action=insertProduct">Product Toevoegen</a>
            <a class="list-group-item"
               href="/WDA/Werkstuk/index.php?controller=Admin&action=categoryOverview"
               title="/WDA/Werkstuk/index.php?controller=Admin&action=categoryOverview">Categorie Overzicht</a>
            <a class="list-group-item"
               href="/WDA/Werkstuk/index.php?controller=Admin&action=insertCategory"
               title="/WDA/Werkstuk/index.php?controller=Admin&action=insertCategory">Categorie Toevoegen</a>
            <a class="list-group-item"
               href="#">Overzicht bestellingen TODO</a>
            <a class="list-group-item"
               href="#">Beheerder toevoegen TODO</a>

        <?php } ?>


        <!-- TODO andere sidebar functies ????-->
    </div><!-- div.listgroup -->
</div><!-- div.col md 3 -->


