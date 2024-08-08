<?php  

include 'includes/db.php';

include('includes/header.php') ;



if(isset($_POST['submit'])){
    $search = $_POST['search'];
 
 
        // query for search
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
        $search_query = mysqli_query($connection , $query);
 
        if(!$search_query){
            die('query failed' . mysqli_error($connection));
        }
 
        $count = mysqli_num_rows($search_query);
        if($count == 0){

?>


<div class="conatiner">
    <div class="row">
        <h1 class="text-center">
            there are no results
        </h1>
    </div>
</div>
<?php   }
else{
// end if ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Search Page <?php echo $count . 'result found'; ?>
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
<?php

}
}
?>
<!-- Footer -->
<?php include 'includes/footer.php'; ?>
</div>
<!-- /.container -->