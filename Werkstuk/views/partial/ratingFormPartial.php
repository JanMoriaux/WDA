<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 4/05/2017
 * Time: 14:46
 */
?>
<form class="form" method="post" action="index.php?controller=Product&action=showDetail">

    <!-- productId-->
    <input type="hidden"
           name="productId"
           value="<?php echo isset($thisProduct) ? $thisProduct->getId() : ''; ?>"/>

    <!-- userId-->
    <input type="hidden"
           name="userId"
           value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']->getId() : ''; ?>"/>

    <!-- ratingValue-->
    <div class="form-group">
        <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="ratingValue">Score:</label>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label class="error-label control-label">
                <?php echo(isset($errors['ratingValue']) ? $errors['ratingValue'] : ''); ?>
            </label>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <select class="btn btn-default dropdown" name="ratingValue" id="ratingValue">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <option
                            value="<?php echo $i; ?>" <?php echo (isset($values['ratingValue']) && $values['ratingValue'] == $i)
                        ? 'selected' : ''; ?>>
                        <?php echo $i; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <!-- comment -->
    <div class="form-group">
        <label class="control-label col-lg-6 col-md-6 col-sm-12 col-xs-12" for="comment">Beoordeling:</label>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label class="error-label control-label" id="commentError">
                <?php echo isset($errors['comment']) ? $errors['comment'] : ''; ?>
            </label>
        </div>
        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                    <textarea rows="4" cols="50" class="form-control" name="comment" id="comment"
                              placeholder="Beschrijving"><?php
                        echo isset($values['comment']) ? $values['comment'] : ''; ?>
                    </textarea>
        </div>
    </div>

    <!-- submit -->
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
            <input class="btn btn-primary btn-lg" type="submit"
                   value="Beoordelen"/>
        </div>
    </div>
</form>

<!-- script -->
<script src="./views/js/validationRules.js"></script>
<script src="./viewS/js/ratingFormValidation.js"></script>
<!-- /script -->
