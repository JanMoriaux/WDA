<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 4/05/2017
 * Time: 15:46
 */
require_once ROOT . '/models/database/CRUD/UserDb.php';

if ($user = UserDb::getById($rating->getUserId())) {
    ?>
    <div class="well well-sm">
        <h3><strong>"<?php echo $rating->getComment() ?>"</strong></h3>
        <h4><?php echo $user->getFirstName() . ' ' . $user->getLastName() ?> gaf dit product <?php
            echo $rating->getRatingValue() ?>/5
            op <?php echo date('d-m-Y', $rating->getDateRated()->getTimeStamp()) ?></h4>
    </div>
<?php } ?>




