<?php

include '../header.php' ;

?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->

        <h1 class="page-header">
            Welcome To Admin
            <small> Show Posts</small>
        </h1>

        <div style="border colapse  overflow-x: auto;">
            <table id="myTable">
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th> Title</th>
                    <th>Category</th>
                    <th> Content</th>
                    <th>Status</th>
                    <th>Image</th>
                 
                 
                    
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th colspan="2">Action</th>

                </tr>
                <!-- INSERT CATEGORIES -->
                <?php  showAllPosts(); ?>
                <!-- INSERT CATEGORIES -->

            </table>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include '../footer.php' ;
?>