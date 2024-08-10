<?php

include '../header.php' ;
addCategory();
?>
<div id="page-wrapper">


    <div class="container-fluid">

        <!-- Page Heading -->

        <h1 class="page-header">
            Welcome To Admin
            <small> Add Category</small>
        </h1>

        <form action="#" method="post">

            <div class="form-group">
                <label for="name">Add Category</label>
                <input type="text" class="form-control" id="name" name="cat_title">
            </div>

            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include '../footer.php' ;
?>