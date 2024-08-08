<?php

include '../header.php' ;

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    if($cat_title == "" || empty($cat_title)){
        echo "<p class='text-danger'>Field must not be empty</p>";
    }
    else{
   
    $query = "INSERT INTO category(cat_title) VALUES('$cat_title')";
    $result = mysqli_query($connection , $query);

    if(!$result){
        die('query failed' . mysqli_error($connection));
    }
   
}
}
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