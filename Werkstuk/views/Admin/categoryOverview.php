<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 15:13
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <table class="table table-responsive" id="admin_category_table">
        <thead>
        <tr>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Id</th>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Omschrijving</th>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">Wijzig</th>
            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">Verwijder</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($allCategories as $category) {
            ?>
            <tr>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><?php echo $category->getId(); ?></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><?php echo $category->getDescription(); ?></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                    <a class="text-info"
                       href="index.php?controller=Admin&action=editCategory&id=<?php echo $category->getId(); ?>"
                       title="Admin Edit Category <?php echo $category->getId(); ?>">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a></td>
                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                    <a class="text-danger"
                       href="index.php?controller=Admin&action=deleteCategory&id=<?php echo $category->getId(); ?>"
                       title="Admin Delete Category<?php echo $category->getId(); ?>">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
