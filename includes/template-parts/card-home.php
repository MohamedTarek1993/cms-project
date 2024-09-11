<?php 
?>


<?php
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'subscriber'):
    ?>

<div class="label label-success py-2 px-3">
    <a href="admin/posts/edit.php?edit=<?= $all_posts['post_id'] ; ?>" class="btn text-white">Edit Post</a>
</div>

<?php endif;  ?>

<!-- First Blog Post -->
<h2>
    <a href="<?php echo 'post.php?post_id=' . $all_posts['post_id'] ; ?>"> <?=   $all_posts['post_title'] ?></a>
</h2>
<p class="lead">
    by <a
        href="author.php?post_author=<?= urlencode($all_posts['post_author']) ?>&post_id=<?= urlencode($all_posts['post_id']) ?>">
        <?= htmlspecialchars($all_posts['post_author']) ?>
    </a>
</p>

<p><span class="glyphicon glyphicon-time"></span> Posted on <?=  $all_posts['post_date'] ?></p>
<a href="categories.php?post_category_id=<?= $all_posts['post_cat_id'] ?>"><span
        class="glyphicon glyphicon-time"></span> Category: <?php 
        $select_category_name = mysqli_query($connection, "SELECT * FROM category WHERE cat_id = '{$all_posts['post_cat_id']}' ");
        $category_list = mysqli_fetch_assoc($select_category_name);
        echo $category_list['cat_title']; 
    ?></a>
<hr>
<div class="image-wrap">
    <a href="<?php echo 'post.php?post_id=' . $all_posts['post_id'] ; ?>">
        <img class="img-responsive" src="images/<?= $all_posts['post_image'] ?>" alt="">
    </a>
</div>
<hr>
<p>
    <?=  $all_posts['post_content'] ?>

</p>
<a class="btn btn-primary" href="<?php echo 'post.php?post_id=' . $all_posts['post_id'] ; ?>">Read More <span
        class="glyphicon glyphicon-chevron-right"></span></a>
<hr>