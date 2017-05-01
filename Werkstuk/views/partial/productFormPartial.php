<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 10:05
 */

//voor laden van categoriën in combobox
require_once ROOT . '/models/database/CRUD/CategoryDb.php';

?>

    <form class="form"
          action="index.php?controller=Admin&action=<?php echo $currentAction;?><?php echo isset($values['id']) ? '&id=' .$values['id'] : ''; ?>"
          method="post" enctype="multipart/form-data">

        <div class="form-group">
            <div class="">
                <input class="form-control" type="hidden" name="id" id="id"
                       value="<?php echo isset($values['id']) ? $values['id'] : ''; ?>"
                       placeholder=""/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="name">Naam:</label>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="error-label control-label">
                    <?php echo(isset($errors['name']) ? $errors['name'] : ''); ?>
                </label>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <input class="form-control" type="text" name="name" id="name"
                       value="<?php echo(isset($values['name']) ? $values['name'] : ''); ?>"
                       placeholder="Naam"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="description">Beschrijving:</label>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="error-label control-label">
                    <?php echo(isset($errors['description']) ? $errors['description'] : ''); ?>
                </label>
            </div>
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                    <textarea rows="4" cols="50" class="form-control" name="description" id="description"
                              placeholder="Beschrijving"><?php echo(isset($values['description']) ? $values['description'] : ''); ?></textarea>
            </div>
        </div>

        <!-- TODO moet filename tonen-->
        <div class="form-group">
            <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="image">Afbeelding:</label>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="error-label control-label">
                    <?php echo(isset($errors['image']) ? $errors['image'] : ''); ?>
                </label>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label class="btn btn-default btn-file">Browse
                    <input type="file" name="image" id="image" accept="image/*" style="display: none">
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="price">Prijs:</label>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="error-label control-label">
                    <?php echo(isset($errors['price']) ? $errors['price'] : ''); ?>
                </label>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <input class="form-control" type="text" name="price" id="price"
                       value="<?php echo(isset($values['price']) ? $values['price'] : ''); ?>"
                       placeholder="Prijs"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12">Uitlichten:</label>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="error-label control-label">
                    <?php echo(isset($errors['highLighted']) ? $errors['highLighted'] : ''); ?>
                </label>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6"><label class="control-label" for="hlyes">Ja</label>
                    <input class="" type="radio" name="highLighted" id="hlyes" value="1"
                        <?php echo isset($values['highLighted']) && $values['highLighted'] ?
                            'checked' : '' ?>/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"><label class="control-label" for="hlno">Nee</label>
                    <input class="" type="radio" name="highLighted" id="hlno" value="0"
                        <?php echo !isset($values['highLighted']) || !$values['highLighted'] ?
                            'checked' : '' ?>/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="categoryId">Categorie:</label>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="error-label control-label">
                    <?php echo(isset($errors['categoryId']) ? $errors['categoryId'] : ''); ?>
                </label>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <select class="btn btn-default dropdown" name="categoryId" id="categoryId">
                    <?php foreach (CategoryDb::getAll() as $category) { ?>
                        <option value="<?php echo $category->getId(); ?>"
                            <?php echo (isset($values['categoryId']) && $values['categoryId'] === $category->getId())
                                ? 'selected' : ''; ?>>
                            <?php echo $category->getDescription(); ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="inStock">In voorraad:</label>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="error-label control-label">
                    <?php echo(isset($errors['inStock']) ? $errors['inStock'] : ''); ?>
                </label>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <input class="form-control" type="text" name="inStock" id="inStock"
                       value="<?php echo(isset($values['inStock']) ? $values['inStock'] : ''); ?>"
                       placeholder="###"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                <input class="btn btn-primary btn-lg" type="submit"
                       value="<?php echo $currentAction === 'insertProduct' ? 'Toevoegen' : 'Wijzigen' ;?>"/>
            </div>
        </div>

    </form>
