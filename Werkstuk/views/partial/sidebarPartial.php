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
               title="/WDA/Werkstuk/index.php?controller=Admin&action=productOverview">Overzicht producten</a>
            <a class="list-group-item"
               href="#">Toevoegen producten</a>
            <a class="list-group-item"
                    href="#">Overzicht categorieën</a>
            <a class="list-group-item"
                    href="#">Toevoegen categorieën</a>
            <a class="list-group-item"
               href="#">Overzicht bestellingen</a>
            <a class="list-group-item"
               href="#">Beheerder toevoegen</a>

        <?php } ?>


        <!-- TODO andere sidebar functies -->
    </div><!-- div.listgroup -->
</div><!-- div.col md 3 -->


