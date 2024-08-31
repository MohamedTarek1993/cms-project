<?php 

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
                by <a href="#">Start Bootstrap</a>
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
             ?>
            <div class="well">
                <h4>Leave a Comment:</h4>
                <?php addComment($post_data['post_id']) ; ?>
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
<?php   include 'includes/footer.php'; ?>
</div>
<!-- /.container -->