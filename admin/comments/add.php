<?php

include '../header.php' ;

addPost();

?>
<div id="page-wrapper">


    <div class="container-fluid">

        <!-- Page Heading -->

        <h1 class="page-header">
            Welcome To Admin
            <small> Add Post</small>
        </h1>

        <form action="#" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name">Add Post Title</label>
                <input type="text" class="form-control" name="post_title">
            </div>

            <div class="form-group">
                <label for="name">Add Post Content</label>
                <textarea type="text" class="form-control" name="post_content"> </textarea>
            </div>

            <div class="form-group">
                <label for="name">Add Post Author</label>
                <input type="text" class="form-control" name="post_author">
            </div>

            <div class="form-group">
                <label for="name">Add Post Category</label>
                <select class="form-control" name="post_cat_id" id="">
                    <?php
            $query = "SELECT * FROM category";
            $select_categories = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                if ($cat_id == $post_cat_id) {
                    echo "<option value='$cat_id' selected>$cat_title</option>";
                } else {
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            }

            ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Add Post Status</label>
                <input type="text" class="form-control" name="post_status">
            </div>

            <div class="form-group">
                <label for="name">Add Post image</label>
                <input type="file" class="form-control" id="image" name="post_image">
            </div>

            <div class="form-group">
                <label for="name">Add Post tags</label>
                <input type="text" class="form-control" id="image" name="post_tags">
            </div>


            <div class="form-group">
                <label for="name">Add Post date</label>
                <input type="date" class="form-control" name="post_date">
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