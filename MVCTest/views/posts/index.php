<p>Here is a list of all the posts</p>

<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 3/04/2017
 * Time: 20:25
 */
foreach($posts as $post) {?>
    <p>
        <?php echo $post->author; ?>
        <a href="'?controller=posts&action=show&id=<?php echo $post->id; ?>">See Content</a>
    </p>
<?php } ?>