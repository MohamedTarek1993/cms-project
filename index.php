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

            <?php 
            $per_page = 2;
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = "";
            }
            if($page == "" || $page == 1){
                $page_1 = 0;
            }else{
                $page_1 = ($page * $per_page) - $per_page;
            }
            
            ?>
            <?php 
            // pajination for home page
         $POST_query_count = "SELECT * FROM posts ";
         $find_count = mysqli_query($connection , $POST_query_count);  
         // COUNT THE NUMBER OF POST 
         $count = mysqli_num_rows($find_count);
         // CALCULATE THE NUMBER OF PAGES
         $count = ceil($count / 2);

            // MAKE QUERY FOR PUBLISHED POSTS ONLY
             $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1 , $per_page";
             $select_all_posts = mysqli_query($connection , $query);
             if(!$select_all_posts){
                 die('query failed' . mysqli_error($connection));
             }
            ?>
            <!-- LOOP THE POSTS -->
            <?php   while($all_posts = mysqli_fetch_assoc($select_all_posts)): ?>
            <!-- LOOP THE POSTS -->
            <!-- CHECH POST STATUS PUPLISHED SHOW OR NOT -->
            <!-- <?php  if($all_posts['post_status'] == 'published'): ?> -->
            <!-- CHECH POST STATUS PUPLISHED SHOW OR NOT -->
            <!-- HOME CARDS IN TEMPLATE PARTS -->
            <?php include 'includes/template-parts/card-home.php'  ?>
            <!-- HOME CARDS -->
            <!-- <?php endif; ?> -->
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
    <ul class="pager">
        <?php 
        for($i = 1; $i <= $count; $i++){
             echo '<li> <a class="page-link '. ($i == $page ? 'active' : '') . '" href="index.php?page=' . $i . '"> ' . $i . ' </a></li>' ;
        }
        ?>
    </ul>
</div>
<!-- Footer -->
<?php include 'includes/footer.php'; ?>
</div>
<!-- /.container -->