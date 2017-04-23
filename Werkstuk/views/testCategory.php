<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 15:39
 */
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/WDA/Werkstuk/models/validation/CategoryValidator.php';

$errors = array();
$values = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $description = $_POST['description'];

    $category = new Category(null, $description);
    $categoryValidator = new CategoryValidator($category);

    $errors = $categoryValidator->getErrors();
    $values = $categoryValidator->getValues();

    $valid = true;
    foreach ($errors as $value) {
        if (!empty($value)) {
            $valid = false;
            break;
        }
    }

    if ($valid) {
        //Todo db insert
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/custom.css" type="text/css"/>
    <title>Test Category</title>
</head>
<body>
<div class="container">
    <div class="container">
        <h1>Test Category Input</h1>
        <form class="form-horizontal" action="./testCategory.php" method="post">
            <div class="form-group">
                <label class="control-label col-md-2" for="description">Beschrijving:</label>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="description" id="description"
                           value="<?php echo(isset($values['description']) ? $values['description'] : ''); ?>"
                           placeholder="Beschrijving"/>
                </div>
                <div class="col-md-4">
                    <label class="error-label control-label">
                        <?php echo(isset($errors['description']) ? $errors['description'] : ''); ?>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-2">
                    <input class="btn btn-primary btn-lg" type="submit"
                           value="Toevoegen"/>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
