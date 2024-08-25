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
                    <th> Comment</th>
                    <th> Email</th>
                    <th>Status</th>
                    <th>in Response to</th>
                    <th>Date</th>
                    <th>Approve</th>
                    <th>Unapprove</th>
                    <th>Delete</th>
                </tr>
                <!-- INSERT CATEGORIES -->
                <?php  showAllComments(); ?>
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