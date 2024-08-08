<?php

include '../header.php' ;

// Step 1: Get the ID from the URL
if (isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];

    // Step 2: Query the database for the category with the specified ID
    $query = "SELECT * FROM category WHERE cat_id = $cat_id";
    $result = mysqli_query($connection, $query);

    // Check if the query was successful and if the category was found
    if ($result && mysqli_num_rows($result) > 0) {
        $category = mysqli_fetch_assoc($result);
        $cat_title = $category['cat_title'];
        // Now you have the category title and other details if needed
    } else {
        echo "Category not found.";
    }
}

// Step 3: Handle the form submission to update the category
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    if($cat_title == "" || empty($cat_title)){
        echo "<p class='text-danger'>Field must not be empty</p>";
    }
    else{
   
     $query = "UPDATE category SET cat_title = '$cat_title' WHERE cat_id = $cat_id";
    $result = mysqli_query($connection , $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($connection));
    } else {
        echo "<p class='text-success'>Category updated successfully</p>";
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
                <label for="name">edit Category</label>
                <input value="<?= $cat_title ?>" name="cat_title" class="form-control" name="cat_title" type="text">

            </div>

            <button name="submit" type="submit" class="btn btn-primary">Update Category</button>
        </form>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include '../footer.php' ;
?>