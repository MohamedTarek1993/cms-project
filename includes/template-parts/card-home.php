<?php 
?>


<?php   while($all_posts = mysqli_fetch_assoc($select_all_posts)): ?>
<!-- First Blog Post -->
<h2>
    <a href="#"> <?=   $all_posts['post_title'] ?></a>
</h2>
<p class="lead">
    by <a href="index.php"><?=  $all_posts['post_author'] ?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on <?=  $all_posts['post_date'] ?></p>
<hr>
<img class="img-responsive" src="images/<?= $all_posts['post_image'] ?>" alt="">
<hr>
<p>
    <?=  $all_posts['post_content'] ?>

</p>
<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
<hr>

<?php endwhile; ?>