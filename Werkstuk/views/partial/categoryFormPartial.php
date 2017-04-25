<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 15:37
 */
?>
        <!-- id -->
        <input type="hidden" name="id" value="<?php echo isset($values['id']) ? $values['id'] : '' ;?>"

        <!-- description -->
        <div class="form-group">
            <label class="control-label col-md-6" for="description">Beschrijving:</label>
            <div class="col-md-6">
                <label class="error-label control-label">
                    <?php echo(isset($errors['description']) ? $errors['description'] : ''); ?>
                </label>
            </div>
            <div class="col-md-12">
                <input class="form-control" type="text" name="description" id="description"
                       value="<?php echo(isset($values['description']) ? $values['description'] : ''); ?>"
                       placeholder="Beschrijving"/>
            </div>
        </div>

        <!-- submit -->
        <div class="form-group">
            <div class="col-md-2">
                <input class="btn btn-primary btn-lg" type="submit"
                       value="<?php echo $currentAction === 'editCategory' ? 'Wijzigen' : 'Toevoegen' ;?>"/>
            </div>
        </div>
