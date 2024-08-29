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
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- HOME CARDS -->
            <?php include 'includes/template-parts/card-home.php'  ?>
            <!-- HOME CARDS -->
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