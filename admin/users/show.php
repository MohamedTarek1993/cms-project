<?php

include '../header.php' ;

?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->

        <h1 class="page-header">
            Welcome To Admin
            <small> Show Users</small>
        </h1>

        <div class="table-responsive" style="border colapse overflow: auto !important">
            <table class="table w-100 table-hover" id="myTable">
                <tr>
                    <th>ID</th>
                    <th>UserName</th>
                    <th>Password</th>
                    <th> User Email</th>
                    <th> First Name </th>
                    <th> Last Name</th>
                    <th>User Image</th>   
                    <th>user Role</th>
                    <th colspan="2">Action</th>

                </tr>
                <!-- INSERT CATEGORIES -->
                <?php  showAllUsers(); ?>
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