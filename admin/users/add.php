<?php

include '../header.php' ;

adduser();

?>
<div id="page-wrapper">


    <div class="container-fluid">

        <!-- Page Heading -->

        <h1 class="page-header">
            Welcome To Admin
            <small> Add User</small>
        </h1>

        <form action="#" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name">Add username</label>
                <input type="text" class="form-control" name="user_name">
            </div>

            <div class="form-group">
                <label for="name">Add User FirstName</label>
                <input type="text" class="form-control" name="user_firstname">
            </div>


            <div class="form-group">
                <label for="name">Add User LastName</label>
                <input type="text" class="form-control" name="user_lastname">
            </div>

            <div class="form-group">
                <label for="name">Add user password</label>
                <input type="password" class="form-control" name="user_password">
            </div>

            <div class="form-group">
                <label for="name">Add User Email</label>
                <input type="email" class="form-control" name="user_email">
            </div>




            <div class="form-group">
                <label for="name">Add User Image</label>
                <input type="file" class="form-control" id="image" name="user_image">
            </div>

            <div class="form-group">
                <label for="name">Add User Role</label>
                <select name="user_role" id="user_role">
                    <option value="admin">Admin</option>
                    <option value="Contrbuitor">Contrbuitor</option>
                    <option value="subscriber">Subscriber</option>

                </select>
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