<?php 
ob_start();

include('includes/header.php') ;
 
?>

<!-- Page Content -->
<div class="container">


    <div class="row">
        <?php
if (isset($_GET['post_id'])) :
    $post_id = $_GET['post_id'];
    // Database query to fetch the post based on $post_id
    $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
    $result = mysqli_query($connection, $query);

    if ($post_data = mysqli_fetch_assoc($result)):
?>

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <?php
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'subscriber'):
    ?>

            <div class="label label-success py-2 px-3">
                <a href="admin/posts/edit.php?edit=<?= $post_data['post_id'] ; ?>" class="btn text-white">Edit Post</a>
            </div>

            <?php endif;  ?>

            <!-- Title -->
            <h1><?php echo $post_data['post_title']; ?></h1>

            <!-- Author -->
            <p class="lead">
                by
                <a
                    href="author.php?post_author=<?= urlencode($post_data['post_author']) ?>&post_id=<?= urlencode($post_data['post_id']) ?>">
                    <?= htmlspecialchars($post_data['post_author']) ?>
                </a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> <?php  echo $post_data['post_date'];?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="images/<?= $post_data['post_image'] ?>" alt=" post image">

            <hr>

            <!-- Post Content -->

            <p class="lead"><?php echo $post_data['post_content']; ?></p>

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <?php
             if(isset($_SESSION['user_role']) ):
                $messa_comment = addComment($post_data['post_id']);
             ?>
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="post">
                    <span class="text-danger"><?= htmlspecialchars($messa_comment); ?></span>
                    <div class="form-group">
                        <label for=""> Add Author </label>
                        <input type="text" name="author" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for=""> Add Email </label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for=""> Add Comment </label>
                        <textarea name="comment" class="form-control" rows="3"></textarea>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <?php endif ; ?>
            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <?php showCommentPost($post_data['post_id']) ;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ?>

            <!-- Comment -->


        </div>
        <?php
    endif;
endif;
    ?>
        <!-- Blog Sidebar Widgets Column -->
        <?php include('includes/sidebar.php') ; ?>


    </div>
    <!-- /.row -->



    <hr>
</div>


<!-- Footer -->
<?php   include 'includes/footer.php'; 
ob_end_flush(); // Send the output buffer and turn off buffering
?>
</div>
<!-- /.container -->