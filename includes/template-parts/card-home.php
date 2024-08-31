<?php 
?>


<?php   while($all_posts = mysqli_fetch_assoc($select_all_posts)): ?>
<?php  if($all_posts['post_status'] == 'published'): ?>
<?php
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'subscriber'):
    ?>

<div class="label label-success py-2 px-3">
    <a href="admin/posts/edit.php?edit=<?= $all_posts['post_id'] ; ?>" class="btn text-white">Edit Post</a>
</div>

<?php endif;  ?>

<!-- First Blog Post -->
<h2>
    <a href="#"> <?=   $all_posts['post_title'] ?></a>
</h2>
<p class="lead">
    by <a href="index.php"><?=  $all_posts['post_author'] ?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on <?=  $all_posts['post_date'] ?></p>
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
<?php endif; ?>
<?php endwhile; ?>