<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 23/04/2017
 * Time: 19:41
 * Vult de sidebar in met een lijst van de beschikbare productcategoriën of adminfuncties
 */
require_once ROOT . '/models/database/CRUD/CategoryDb.php';

$currentAction = '';
if(isset($_SESSION['currentAction']) && !empty($_SESSION['currentAction'])){
    $currentAction = $_SESSION['currentAction'];
}

global $adminfunctions;
global $checkoutzone;

?>


<div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">
    <p class="lead"> Tiny Clouds </p>
    <div class="list-group">

        <!-- sidebar met de verschillende productcategorieën -->
        <?php if (isset($categorySidebar) && $categorySidebar) {?>
            <a href=
                "index.php?controller=Product&action=index"
                   title="Alle Producten"
                   class="categoryFilter list-group-item <?php echo (isset($allCategories) && $allCategories) ? 'active' : '';?>">
                   Alle Producten
            </a>
            <?php foreach (CategoryDb::getAll() as $category) { ?>
                <a id="category<?php echo $category->getId(); ?>"
                   href="index.php?controller=Product&action=showCategory&id=<?php echo $category->getId(); ?>"
                   title="<?php echo $category->getDescription(); ?>"
                   class="categoryFilter list-group-item <?php echo(isset($categoryId) && ($categoryId == $category->getId())) ? 'active' : '';?>">
                    <?php echo $category->getDescription(); ?>
                </a>
            <?php }
        } else if (isset($adminfunctions) && $adminfunctions) { ?>

            <!-- sidebar met de verschillende beheersfuncties -->
            <a class="list-group-item <?php echo (isset($currentAction) && $currentAction === 'productOverview') ? 'active' : ''; ?>"
               href="index.php?controller=Admin&action=productOverview"
               title="Admin Product Overview">Product Overzicht</a>
            <a class="list-group-item <?php echo (isset($currentAction) && $currentAction === 'insertProduct') ? 'active' : ''; ?>"
               href="index.php?controller=Admin&action=insertProduct"
               title="Admin Add Product">Product Toevoegen</a>
            <a class="list-group-item <?php echo (isset($currentAction) && $currentAction == 'categoryOverview') ? 'active' : ''; ?>"
               href="index.php?controller=Admin&action=categoryOverview"
               title="Admin Category Overview">Categorie Overzicht</a>
            <a class="list-group-item <?php echo (isset($currentAction) && $currentAction == 'insertCategory') ? 'active' : ''; ?>"
               href="index.php?controller=Admin&action=insertCategory"
               title="Admin Add Category">Categorie Toevoegen</a>
            <a class="list-group-item <?php echo (isset($currentAction) && $currentAction == 'orderOverview') ? 'active' : ''; ?>"
               href="index.php?controller=Admin&action=orderOverview"
               title="Admin Order Overview">Overzicht bestellingen</a>


        <?php } else if(isset($checkoutzone) && $checkoutzone){ ?>

            <!--sidebar met verschillende stappen in checkout workflow -->
            <a class="list-group-item <?php echo (isset($currentAction) && $currentAction === 'addDeliveryAddress') ? 'active' : ''; ?>"
               href="index.php?controller=Cart&action=addDeliveryAddress"
               title="Leveringsadres invoeren">Leveringsadres</a>
            <a class="list-group-item <?php echo (isset($currentAction) && $currentAction === 'addFacturationAddress') ? 'active' : ''; ?>"
               href="index.php?controller=Cart&action=addFacturationAddress"
               title="Facturatieadres invoeren">Facturatieadres</a>
            <a class="list-group-item <?php echo (isset($currentAction) && $currentAction == 'chooseDeliveryPaymentAndAcceptTerms') ? 'active' : ''; ?>"
               href="index.php?controller=Cart&action=chooseDeliveryPaymentAndAcceptTerms"
               title="Kies verzend- en betaalopties">Opties</a>
            <a class="list-group-item <?php echo (isset($currentAction) && $currentAction == 'reviewOrder') ? 'active' : ''; ?>"
               href="index.php?controller=Cart&action=reviewOrder"
               title="Kies verzend- en betaalopties">Overzicht</a>

        <?php } ?>

    </div><!-- div.listgroup -->
</div><!-- div.col md 3 -->


