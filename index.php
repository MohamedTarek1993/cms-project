<?php  
include('includes/header.php'); 
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

            <h1 class="page-header">Home Page</h1>

            <?php 
            $per_page = 2;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $page_1 = ($page == "" || $page == 1) ? 0 : ($page * $per_page) - $per_page;

            // Determine if the user is an admin
            $is_admin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin';

            // Adjust query based on the user's role
            if ($is_admin) {
                // Admins see all posts including drafts
                $POST_query_count = "SELECT * FROM posts";
                $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
            } else {
                // Regular users only see published posts
                $POST_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
                $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page";
            }

            // Count the total number of posts
            $find_count = mysqli_query($connection, $POST_query_count);  
            $count = mysqli_num_rows($find_count);
            $count = ceil($count / $per_page);

            // Execute the query to fetch posts
            $select_all_posts = mysqli_query($connection, $query);
            if (!$select_all_posts) {
                die('Query failed: ' . mysqli_error($connection));
            }

            $has_posts = false; // Flag to check if there are posts to display

            // Loop through the posts
            while ($all_posts = mysqli_fetch_assoc($select_all_posts)) {
                // Check post status based on the user's role
                if ($all_posts['post_status'] == 'published' || $is_admin) {
                    $has_posts = true; // Set the flag if there's at least one post to show
                    ?>
                    <!-- HOME CARDS IN TEMPLATE PARTS -->
                    <?php include 'includes/template-parts/card-home.php'; ?>
                    <!-- HOME CARDS -->
                    <?php
                }
            }

            // Display message if no posts are found
            if (!$has_posts && !$is_admin) {
                echo '<h1 class="text-center">Sorry, No Posts Available</h1>';
            }
            ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include('includes/sidebar.php'); ?>
    </div>
    <!-- /.row -->

    <hr>
    <ul class="pager">
        <?php 
        for ($i = 1; $i <= $count; $i++) {
            echo '<li><a class="page-link ' . ($i == $page ? 'active' : '') . '" href="index.php?page=' . $i . '">' . $i . '</a></li>';
        }
        ?>
    </ul>
</div>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>
<!-- /.container -->
