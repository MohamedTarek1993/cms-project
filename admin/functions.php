<?php 

//SHOW ALL CATEGORIES

function showAllCategories(){
    global  $connection ; 
//selecting all categories in navmenu
$query = "SELECT * FROM category ";
$select_all_categories = mysqli_query($connection , $query);
if(!$select_all_categories){
    die('query failed' . mysqli_error($connection));
}

   
//DELETE CATEGORY 

if(isset($_GET['delete'])){

    $the_cat_id = $_GET['delete'];
    $query_delete = "DELETE FROM category WHERE cat_id = $the_cat_id";
    $result = mysqli_query($connection , $query_delete);
    if(!$result){
        die('query failed' . mysqli_error($connection));
    }
    else{
        echo '<script>alert("Category Deleted")</script>' ;
    }
    
}

while($all_categories = mysqli_fetch_assoc($select_all_categories)) : ?>
<tr>
    <td><?php echo $all_categories['cat_id']; ?></td>
    <td><?php echo $all_categories['cat_title']; ?></td>
    <td><a href="show.php?delete=<?php echo $all_categories['cat_id']; ?>" class="btn btn-danger">Delete
    </td>
    <td>
        <a href="edit.php?edit=<?php echo $all_categories['cat_id'];?>"> Update </a>
    </td>
</tr>
<?php endwhile; 
}

//ADD CATEGORY

function addCategory(){
    
    global  $connection ; 
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
}

// EDIT CATEGORY

function editCategory(){

    global  $connection ;

    
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
<form action="#" method="post">

    <div class="form-group">
        <label for="name">edit Category</label>
        <input value="<?= $cat_title ?>" name="cat_title" class="form-control" type="text">

    </div>

    <button name="submit" type="submit" class="btn btn-primary">Update Category</button>
</form>

<?php

}


//SHOW ALL Posts

function showAllPosts(){
    global  $connection ; 
//selecting all categories in navmenu
$query = "SELECT * FROM posts ";
$select_all_posts = mysqli_query($connection , $query);
if(!$select_all_posts){
    die('query failed' . mysqli_error($connection));
}

   
//DELETE POST 

if(isset($_GET['delete'])){

    $the_post_id = $_GET['delete'];
    $query_delete = "DELETE FROM posts WHERE post_id = $the_post_id";
    $result = mysqli_query($connection , $query_delete);
    if(!$result){
        die('query failed' . mysqli_error($connection));
    }
    else{
        header("Location: show.php");
        echo '<script>alert("Post Deleted")</script>' ;
    }
    
}

while($all_posts = mysqli_fetch_assoc($select_all_posts)) : ?>
<tr>
    <td><?php echo $all_posts['post_id']; ?></td>
    <td><?php echo $all_posts['post_author']; ?></td>
    <td><?php echo $all_posts['post_title']; ?></td>
    <td><?php  
     $post_cat_id = $all_posts['post_cat_id'];
     $query = "SELECT * FROM category";
     $select_categories = mysqli_query($connection, $query);
     while ($row = mysqli_fetch_assoc($select_categories)) {
         $cat_id = $row['cat_id'];
         $cat_title = $row['cat_title'];
         if ( $post_cat_id == $cat_id  ) {
             echo $cat_title; 
           }
         

     }
 ?></td>
    <td><?php echo $all_posts['post_content']; ?></td>
    <td><?php echo $all_posts['post_status']; ?></td>
    <td>
        <img style="width: 100px; height: 100px; object-fit: cover; " class="img-responsive"
            src="../..//images/<?= $all_posts['post_image'] ?>" alt="" />
    </td>

    <td><?php echo $all_posts['post_tags']; ?></td>
    <td><?php echo $all_posts['post_comment_count']; ?></td>
    <td><?php echo $all_posts['post_date']; ?></td>
    <td><a href="show.php?delete=<?php echo $all_posts['post_id']; ?>" class="btn btn-danger">Delete
    </td>
    <td>
        <a href="edit.php?edit=<?php echo $all_posts['post_id'];?>"> Update </a>
    </td>
</tr>
<?php endwhile; 
}

/**
 * Adds a new post to the database.
 *
 * @throws Exception if any of the required fields are empty.
 * @return void
 */

function addPost(){

    global  $connection ; 
    // 
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_cat_id = $_POST['post_cat_id'];
    $post_date = date('Y-m-d');
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_comment_count = 4;
    $post_status = $_POST['post_status'];

    // move uploaded image to images folder
    move_uploaded_file($post_image_temp, "../../images/$post_image");

 /// check if fields are empty
    if($post_title == "" || empty($post_title  )){
        echo "<p class='text-danger'>Post title must not be empty</p>";
    } elseif ($post_author == "" || empty($post_author  )) {
        echo "<p class='text-danger'>Post author must not be empty</p>";
    } elseif ($post_cat_id == "" || empty($post_cat_id  )) {
        echo "<p class='text-danger'>Post category must not be empty</p>";
    } elseif ($post_image == "" || empty($post_image  )) {
        echo "<p class='text-danger'>Post image must not be empty</p>";
    } elseif ($post_content == "" || empty($post_content  )) {
        echo "<p class='text-danger'>Post content must not be empty</p>";
    } elseif ($post_tags == "" || empty($post_tags  )) {
        echo "<p class='text-danger'>Post tags must not be empty</p>";
    } elseif ($post_status == "" || empty($post_status  )) {
        echo "<p class='text-danger'>Post status must not be empty</p>";
    } elseif ($post_date == "" || empty($post_date  )) {
        echo today('Y-m-d'); ;
    } 
    // inser the data into database
    else{
   
    $query = "INSERT INTO posts(post_title,post_author,post_cat_id,post_date,post_image,post_content,post_tags,post_comment_count,post_status) VALUES('$post_title','$post_author','$post_cat_id','$post_date','$post_image','$post_content','$post_tags','$post_comment_count','$post_status')";
    $result = mysqli_query($connection , $query);

    if(!$result){
        die('query failed' . mysqli_error($connection));
    }
   
}
}

}

/**
 * Edits a post in the database.
 *
 * @throws Exception if any of the required fields are empty.
 * @return void
 */

function editPost(){

    global  $connection ;

    
// Step 1: Get the ID from the URL
if (isset($_GET['edit'])) {
    $post_id = $_GET['edit'];

    // Step 2: Query the database for the post with the specified ID
    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $result = mysqli_query($connection, $query);

    // Check if the query was successful and if the post was found
    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
        $post_title = $post['post_title'];
        $post_author = $post['post_author'];
        $post_cat_id = $post['post_cat_id'];
        $post_date = $post['post_date'];
        $post_image = $post['post_image'];
        $post_content = $post['post_content'];
        $post_tags = $post['post_tags'];
        $post_status = $post['post_status'];
        $post_comment = $post['post_comment_count'];
        // Now you have the post title and other details if needed
    } else {
        echo "Post not found.";
    }
}

// Step 3: Handle the form submission to update the post
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_cat_id = $_POST['post_cat_id'];
    $post_date = date('Y-m-d');
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_comment_count = 4;
    $post_status = $_POST['post_status'];

    // move uploaded image to images folder

    
    /// check if fields are empty
    if($post_title == "" || empty($post_title  )){
        echo "<p class='text-danger'>Post title must not be empty</p>";
    } elseif ($post_author == "" || empty($post_author  )) {
        echo "<p class='text-danger'>Post author must not be empty</p>";
    } elseif ($post_cat_id == "" || empty($post_cat_id  )) {
        echo "<p class='text-danger'>Post category must not be empty</p>";
    } elseif ($post_image == "" || empty($post_image  )) {
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $result = mysqli_query($connection, $query);
    
    if ($row = mysqli_fetch_array($result)) {
        $post_image = $row['post_image'];
    }  else{
        move_uploaded_file($post_image_temp, "../../images/$post_image");

    }
    

    } elseif ($post_content == "" || empty($post_content  )) {
        echo "<p class='text-danger'>Post content must not be empty</p>";
    } elseif ($post_tags == "" || empty($post_tags  )) {
        echo "<p class='text-danger'>Post tags must not be empty</p>";
    } elseif ($post_status == "" || empty($post_status  )) {
        echo "<p class='text-danger'>Post status must not be empty</p>";
    } elseif ($post_date == "" || empty($post_date  )) {
        echo today('Y-m-d'); ;
    } 
    else{
   
     $query = "UPDATE posts SET (post_title,post_author,post_cat_id,post_date,post_image,post_content,post_tags,post_comment_count,post_status) = '$post_title','$post_author','$post_cat_id','$post_date','$post_image','$post_content','$post_tags','$post_comment_count','$post_status' WHERE post_id = $post_id";
    $result = mysqli_query($connection , $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($connection));
    } else {
        echo "<p class='text-success'>Post updated successfully</p>";
    }
   
}
}
?>

<form action="#" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="name">Edit Post Title</label>
        <input value="<?= $post_title ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="name">Edit Post Content</label>
        <textarea type="text" class="form-control" name="post_content">
    <?= $post_content ?>        
</textarea>
    </div>

    <div class="form-group">
        <label for="name">Edit Post Author</label>
        <input value="<?= $post_author ?>" type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="name">Edit Post Category</label>
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
        <label for="name">Edit Post Status</label>
        <input value="<?= $post_status ?>" type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="name">Edit Post image</label>
        <img style="width: 100px; height: 100px; display: block ; " src="../../images/<?= $post_image ?>" alt="">
        <input type="file" class="form-control" name="post_image">
    </div>

    <div class="form-group">
        <label for="name">Edit Post tags</label>
        <input value="<?= $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>


    <div class="form-group">
        <label for="name">Edit Post date</label>
        <input value="<?= $post_date ?>" type="date" class="form-control" name="post_date">
    </div>

    <!-- <div class="form-group">
    <label for="name">Edit Post Comment</label>
    <input value="<?= $post_comment_count ?>" type="date" class="form-control" name="post_comment_count">
</div> -->



    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
</form>

<?php

}