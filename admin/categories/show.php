<?php

include '../header.php' ;

?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->

        <h1 class="page-header">
            Welcome To Admin
            <small> Show Categories</small>
        </h1>

        <div style="border colapse  overflow-x: auto;">
            <table id="myTable">
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>

                </tr>
                <!-- INSERT CATEGORIES -->
                <?php  showAllCategories(); ?>
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