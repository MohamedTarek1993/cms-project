<?php  


include('includes/header.php') ; 
?>
<?php 
  if(isset($_GET['post_author'])) {
    $author = $_GET['post_author'];
 }

 
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <!-- strat query -->
        <?php 
        $post_author =false ;
             $select_all_posts = mysqli_query($connection, "SELECT * FROM posts WHERE post_author = '{$author}' ");
             ?>
        <?php   while($all_posts = mysqli_fetch_assoc($select_all_posts)): ?>
        <?php  if($all_posts['post_status'] == 'published'): ?>
        <?php  $post_author = true; ?>


        <div class="col-md-8">
            <h1 class="page-header">
                Author : <?php echo $author  ;?>
            </h1>

            <!-- author CARDS -->


            <!-- INCLUDE CARD TEMPLATE PART -->
            <?php include ('includes/template-parts/card-home.php') ?>

            <!-- INCLUDE CARD TEMPLATE PART -->



        </div>
        <?php endif; ?>
        <?php endwhile; ?>
        <!-- Blog Sidebar Widgets Column -->
         <?php if(!$post_author){
             echo ' <div class="col-md-8"> <h1 class="text-center">Sorry, No Posts Available</h1> </div>';
         } ?>
        <?php include('includes/sidebar.php') ; ?>

    </div>
    <!-- /.row -->

    <hr>
</div>
<!-- /.container -->
<!-- Footer -->
<?php include 'includes/footer.php'; ?>
</div>
<!-- /.container -->