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

<!-- SHOW AUTHOR  IN CARD -->
<?php 
 //  CHECK IF AUTHOR exists
 if(isset($all_posts['post_author']) && !empty($all_posts['post_author'])) :
 ?>
<p class="lead">
    by <a
        href="author.php?post_author=<?= urlencode($all_posts['post_author']) ?>&post_id=<?= urlencode($all_posts['post_id']) ?>">
        <?= htmlspecialchars($all_posts['post_author']) ?>
    </a>
</p>

<?php 
 //  IF THERE IS NO AUTHOR DISPLAY NO AUTHOR
 else: 
    echo 'No Author';

endif;//END IF
  ?>
<!-- SHOW AUTHOR  IN CARD -->

<p><span class="glyphicon glyphicon-time"></span> Posted on <?=  $all_posts['post_date'] ?></p>



<!-- SHOW CATEGORY IN CARD -->
<?php
// Check if the 'post_cat_id' is set and not empty
if (isset($all_posts['post_cat_id']) && !empty($all_posts['post_cat_id'])) {
    // Fetch the category details based on the post's category ID
    $select_category_name = mysqli_query($connection, "SELECT * FROM category WHERE cat_id = '{$all_posts['post_cat_id']}'");
    
    // Check if a category was found in the database
    if ($select_category_name && $category_list = mysqli_fetch_assoc($select_category_name)) {
        // Display the category link and title
        ?>
<a href="categories.php?post_category_id=<?= htmlspecialchars($all_posts['post_cat_id']); ?>">
    <span class="glyphicon glyphicon-time"></span>
    Category: <?= htmlspecialchars($category_list['cat_title']); ?>
</a>
<?php
    } else {
        // Display "Uncategorized" if the category is not found
        echo 'Uncategorized';
    }
} else {
    // Display "Uncategorized" if 'post_cat_id' is not set or empty
    echo 'Uncategorized';
}
?>

<!-- SHOW CATEGORY IN CARD -->

<hr>


<div class="image-wrap">
    <a href="<?php echo 'post.php?post_id=' . $all_posts['post_id'] ; ?>">
        <img class="img-responsive" src="images/<?= placeholder($all_posts['post_image']) ?>" alt="">
    </a>
</div>
<hr>
<p>
    <?=  $all_posts['post_content'] ?>

</p>
<a class="btn btn-primary" href="<?php echo 'post.php?post_id=' . $all_posts['post_id'] ; ?>">Read More <span
        class="glyphicon glyphicon-chevron-right"></span></a>
<hr>