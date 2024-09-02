<?php  


include('includes/header.php') ; 
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="text-danger">
                <?php 
       if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']); // Clear the session message after displaying it
    }


            ?>
            </h1>


            <h1 class="page-header">
                Home Page
            </h1>
            <!-- LOOP THE POSTS -->
            <?php   while($all_posts = mysqli_fetch_assoc($select_all_posts)): ?>
            <!-- LOOP THE POSTS -->
            <!-- CHECH POST STATUS PUPLISHED SHOW OR NOT -->
            <?php  if($all_posts['post_status'] == 'published'): ?>
            <!-- CHECH POST STATUS PUPLISHED SHOW OR NOT -->
            <!-- HOME CARDS IN TEMPLATE PARTS -->
            <?php include 'includes/template-parts/card-home.php'  ?>
            <!-- HOME CARDS -->
            <?php endif; ?>
            <?php   endwhile; ?>
            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include('includes/sidebar.php') ; ?>

    </div>
    <!-- /.row -->

    <hr>
</div>
<!-- Footer -->
<?php include 'includes/footer.php'; ?>
</div>
<!-- /.container -->