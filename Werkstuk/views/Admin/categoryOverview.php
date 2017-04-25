<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 15:13
 */
?>
<div class="col-md-12">
    <table class="table" id="admin_category_table">
        <thead>
        <tr>
            <th class="col-md-1">Id</th>
            <th class="col-md-1">Omschrijving</th>
            <th class="col-md-1 text-center">Wijzig</th>
            <th class="col-md-1 text-center">Verwijder</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($allCategories as $category) {
            ?>
            <tr>
                <td class="col-md-1"><?php echo $category->getId(); ?></td>
                <td class="col-md-1"><?php echo $category->getDescription(); ?></td>
                <td class="col-md-1 text-center">
                    <a class="text-info"
                       href="/WDA/Werkstuk/index.php?controller=Admin&action=editCategory&id=<?php echo $category->getId(); ?>"
                       title="/WDA/Werkstuk/index.php?controller=Admin&action=editProduct&id=<?php echo $category->getId(); ?>">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a></td>
                <td class="col-md-1 text-center">
                    <a class="text-danger"
                       href="/WDA/Werkstuk/index.php?controller=Admin&action=deleteCategory&id=<?php echo $category->getId(); ?>"
                       title="/WDA/Werkstuk/index.php?controller=Admin&action=deleteCategory&id=<?php echo $category->getId(); ?>">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
