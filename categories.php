<?php  


include('includes/header.php') ; 
?>
<?php 
  if(isset($_GET['post_category_id'])) {
    $category = $_GET['post_category_id'];
 }

 
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <!-- strat query -->
        <?php 
        $post_puplished = false;
             $select_all_posts = mysqli_query($connection, "SELECT * FROM posts WHERE post_cat_id = '{$category}' && post_status = 'published' ");
            
             ?>
        <?php   while($all_posts = mysqli_fetch_assoc($select_all_posts)): ?>
        <?php  if($all_posts['post_status'] == 'published'): ?>
        <?php  $post_puplished = true; ?>

        <div class="col-md-8">
            <h1 class="page-header">
                <?php $cat_title = mysqli_fetch_assoc( mysqli_query($connection, "SELECT * FROM category WHERE cat_id = '{$category}' ")) ?>
                Categorty : <?php echo $cat_title['cat_title']  ;?>
            </h1>

            <!-- author CARDS -->


            <!-- INCLUDE CARD TEMPLATE PART -->
            <?php include ('includes/template-parts/card-home.php') ?>

            <!-- INCLUDE CARD TEMPLATE PART -->



        </div>
        <?php endif; ?>
        <?php endwhile; ?>
        <!-- when there are no posts for this category -->
        <?php 
         if(!$post_puplished) {
             echo  " <div class='col-md-8'> <h1 class='text-center'>No Post Found In This Category</h1> </div> ";
         }
         ?>
        <!-- when there are no posts for this category -->
        <!-- Blog Sidebar Widgets Column -->
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