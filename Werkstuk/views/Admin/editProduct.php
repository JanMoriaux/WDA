<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/04/2017
 * Time: 22:07
 *
 *
 * Bij een ongeldig formulier worden de waarden terug naar de controller
 * en action die bij deze view horen gepost.
 *
 */

require_once ROOT . '/models/database/CRUD/ProductDb.php';
require_once ROOT . '/models/database/CRUD/CategoryDb.php';

if ($product != null) { ?>
    <?php
    if (isset($productUpdated)) {
        if ($productUpdated) {
            ?>
            <div class="col-md-12">
                <div class="alert alert-info">Product gewijzigd</div>
            </div><?php
        } else { ?>
            <div class="col-md-12">
            <div class="alert alert-danger col-md-9">Probleem met database: product niet gewijzigd</div>
            </div>
            <?php
        }
    }
    ?>
    <div class="col-md-9">
        <form class="form"
              action="/WDA/Werkstuk/index.php?controller=Admin&action=editProduct&id=<?php echo $product->getId(); ?>"
              method="post" enctype="multipart/form-data">

            <div class="form-group">
                <div class="col-md-12">
                    <input class="form-control" type="hidden" name="id" id="id"
                           value="<?php echo $product->getId(); ?>"
                           placeholder=""/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-6" for="name">Naam:</label>
                <div class="col-md-6">
                    <label class="error-label control-label">
                        <?php echo(isset($errors['name']) ? $errors['name'] : ''); ?>
                    </label>
                </div>
                <div class="col-md-12">
                    <input class="form-control" type="text" name="name" id="name"
                           value="<?php echo(isset($values['name']) ? $values['name'] : ''); ?>"
                           placeholder="Naam"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-6" for="description">Beschrijving:</label>
                <div class="col-md-6">
                    <label class="error-label control-label">
                        <?php echo(isset($errors['description']) ? $errors['description'] : ''); ?>
                    </label>
                </div>
                <div class="col-md-12">
                    <textarea rows="4" cols="50" class="form-control" type="text" name="description" id="description"
                              placeholder="Beschrijving"><?php echo(isset($values['description']) ? $values['description'] : ''); ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-6" for="image">Afbeelding:</label>
                <div class="col-md-6">
                    <label class="error-label control-label">
                        <?php echo(isset($errors['image']) ? $errors['image'] : ''); ?>
                    </label>
                </div>
                <div class="col-md-12">
                    <label class="btn btn-default btn-file">Browse
                        <input type="file" name="image" id="image" accept="image/*" style="display: none">
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-6" for="price">Prijs:</label>
                <div class="col-md-6">
                    <label class="error-label control-label">
                        <?php echo(isset($errors['price']) ? $errors['price'] : ''); ?>
                    </label>
                </div>
                <div class="col-md-12">
                    <input class="form-control" type="text" name="price" id="price"
                           value="<?php echo(isset($values['price']) ? $values['price'] : ''); ?>"
                           placeholder="Prijs"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-6">Uitlichten:</label>
                <div class="col-md-6">
                    <label class="error-label control-label">
                        <?php echo(isset($errors['highLighted']) ? $errors['highLighted'] : ''); ?>
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="col col-md-2"><label class="control-label" for="hlyes">Ja</label>
                        <input class="" type="radio" name="highLighted" id="hlyes" value="1"
                            <?php echo isset($values['highLighted']) && $values['highLighted'] ?
                                'checked' : '' ?>/>
                    </div>
                    <div class="col col-md-2"><label class="control-label" for="hlno">Nee</label>
                        <input class="" type="radio" name="highLighted" id="hlno" value="0"
                            <?php echo !isset($values['highLighted']) || !$values['highLighted'] ?
                                'checked' : '' ?>/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-6" for="categoryId">Categorie:</label>
                <div class="col-md-6">
                    <label class="error-label control-label">
                        <?php echo(isset($errors['categoryId']) ? $errors['categoryId'] : ''); ?>
                    </label>
                </div>
                <div class="col-md-12">
                    <select class="btn btn-default dropdown" type="" name="categoryId" id="categoryId">
                        <?php foreach (CategoryDb::getAll() as $category) { ?>
                            <option value="<?php echo $category->getId(); ?>"
                                <?php echo $values['categoryId'] === $category->getId() ? 'selected' : ''; ?>>
                                <?php echo $category->getDescription(); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-6" for="inStock">In voorraad:</label>
                <div class="col-md-6">
                    <label class="error-label control-label">
                        <?php echo(isset($errors['inStock']) ? $errors['inStock'] : ''); ?>
                    </label>
                </div>
                <div class="col-md-12">
                    <input class="form-control" type="text" name="inStock" id="inStock"
                           value="<?php echo(isset($values['inStock']) ? $values['inStock'] : ''); ?>"
                           placeholder="###"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2">
                    <input class="btn btn-primary btn-lg" type="submit"
                           value="Registreren"/>
                </div>
            </div>
        </form>
    </div>

<?php } else { ?>
    <div class="col-md-9">
        <div class="alert alert-warning">Product niet teruggevonden!</div>
    </div>
<?php } ?>