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

// Check if delete request is made
if (isset($_POST['delete'])) {

    // Check if user role is set and user is an Admin
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

        // Retrieve and sanitize the category ID
        $the_cat_id = mysqli_real_escape_string($connection, $_POST['cat_id']);

        // Check if category ID is valid
        if (is_numeric($the_cat_id)) {

            // Use prepared statement to safely delete category
            $query_delete = "DELETE FROM category WHERE cat_id = ?";
            $stmt = mysqli_prepare($connection, $query_delete);
            mysqli_stmt_bind_param($stmt, 'i', $the_cat_id);
            $result = mysqli_stmt_execute($stmt);

            // Check if the deletion was successful
            if (!$result) {
                die('Query failed: ' . mysqli_error($connection));
            } else {
                echo '<script>alert("Category Deleted")</script>';
                header("Location: show.php");
                exit();
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo '<script>alert("Invalid category ID")</script>';
        }
    }
}


while($all_categories = mysqli_fetch_assoc($select_all_categories)) : ?>
<tr>
    <td><?php echo $all_categories['cat_id']; ?></td>
    <td><?php echo $all_categories['cat_title']; ?></td>
    <?php 
     if(isset($_SESSION['user_role'])  ){
        if($_SESSION['user_role'] == 'Admin' ){ 
    ?>
    <form method="post" onsubmit="return confirmDeletion()">
        <input type="hidden" name="cat_id" value="<?php echo htmlspecialchars($all_categories['cat_id']); ?>">
        <td>
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
        </td>
    </form>
    <script>
    // JavaScript function to confirm deletion
    function confirmDeletion() {
        return confirm("Are you sure you want to delete this category?");
    }
    </script>

    <td>
        <a class="btn btn-primary" href="edit.php?edit=<?php echo $all_categories['cat_id'];?>"> Update </a>
    </td>
    <?php } } ?>
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
    else{
        echo "<script> alert('Category Added'); </script>";
        header("Location: show.php");
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
// Check if delete request is made
if (isset($_POST['delete'])) {

    // Check if user role is set and user is an Admin
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

        // Retrieve and sanitize the category ID
        $the_post_id = mysqli_real_escape_string($connection, $_POST['post_id']);

        // Check if category ID is valid
        if (is_numeric($the_post_id)) {

            // Use prepared statement to safely delete category
            $query_delete = "DELETE FROM posts WHERE post_id = ?";
            $stmt = mysqli_prepare($connection, $query_delete);
            mysqli_stmt_bind_param($stmt, 'i', $the_post_id);
            $result = mysqli_stmt_execute($stmt);

            // Check if the deletion was successful
            if (!$result) {
                die('Query failed: ' . mysqli_error($connection));
            } else {
                echo '<script>alert("Post Deleted")</script>';
                header("Location: show.php");
                exit();
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo '<script>alert("Invalid Post ID")</script>';
        }
    }
}



while($all_posts = mysqli_fetch_assoc($select_all_posts)) : ?>
<tr>
    <td><?php echo $all_posts['post_id']; ?></td>
    <td><?php echo $all_posts['post_author']; ?></td>
    <td><?php echo $all_posts['post_title']; ?></td>
    <!-- SHOW RELATED CATEGORY -->
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
    <!-- SHOW RELATED CATEGORY -->
    <td><?php echo $all_posts['post_content']; ?></td>
    <td><?php echo $all_posts['post_status']; ?></td>
    <td>
        <img style="width: 100px; height: 100px; object-fit: cover; " class="img-responsive"
            src="../..//images/<?= $all_posts['post_image'] ?>" alt="" />
    </td>

    <td><?php echo $all_posts['post_tags']; ?></td>
    <td> <?php  
$post_id = $all_posts['post_id']; // Assuming $all_posts contains the current post data

// Query to count comments related to this specific post
$query = "SELECT COUNT(*) AS comment_count FROM comments WHERE comment_post_id = {$post_id} AND comment_status = 'approved'"; 
$result = mysqli_query($connection, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $comment_count = $row['comment_count']; // Get the comment count
    echo '<a href="show.php?p=' . $post_id . '"> ' . $comment_count . '</a>' ; // Display the number of comments
}
?>
    </td>

    <td><?php echo $all_posts['post_date']; ?></td>
    <?php
    if(isset($_SESSION['user_role'])  ):
        if($_SESSION['user_role'] == 'Admin' ): ?>
    <!-- delete post form -->
    <form method="post" onsubmit="return confirmDeletion()">
        <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($all_posts['post_id']); ?>">
        <td>
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
        </td>
    </form>
    <script>
    // JavaScript function to confirm deletion
    function confirmDeletion() {
        return confirm("Are you sure you want to delete this post?");
    }
    </script>
    <!-- delete post form -->

    <td>
        <a class="btn btn-primary" href="edit.php?edit=<?php echo $all_posts['post_id'];?>"> Update </a>
    </td>
    <?php endif; endif; ?>
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
     $post_comment_count = 0;
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
    } 
    // elseif ( empty($post_image  )) {
    //     echo "<p class='text-danger'>Post image must not be empty</p>";
    // } 
    elseif ($post_content == "" || empty($post_content  )) {
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
    else{
        echo "<script>
        alert('Post added successfully');
        window.location.href = 'show.php'; // Use JavaScript for redirection
      </script>";
        exit(); // Ensure the script stops after redirection
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
        // $post_comment = $post['post_comment_count'];
        // Now you have the post title and other details if needed
    } else {
        echo "Post not found.";
    }
}

// Step 3: Handle the form submission to update the post
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
$post_author = mysqli_real_escape_string($connection, $_POST['post_author']);
$post_cat_id = mysqli_real_escape_string($connection, $_POST['post_cat_id']);
$post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
$post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
$post_status = mysqli_real_escape_string($connection, $_POST['post_status']);
    $post_date = date('Y-m-d');
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    /// check if image are empty

    if (empty($post_image)) {
        $query = "SELECT post_image FROM posts WHERE post_id = $post_id";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);
        $post_image = $row['post_image'];
    } else {
        move_uploaded_file($post_image_temp, "../../images/$post_image");
    }
   // Check if required fields are empty
if (empty($post_title) || empty($post_author) || empty($post_cat_id) || empty($post_content) || empty($post_tags) || empty($post_status)) {
    echo "<p class='text-danger'>All fields are required.</p>";
} else {
    // Process the form and update the post
    $query = "UPDATE posts SET 
              post_title = '{$post_title}', 
              post_author = '{$post_author}', 
              post_cat_id = '{$post_cat_id}', 
              post_date = '{$post_date}', 
              post_image = '{$post_image}', 
              post_content = '{$post_content}', 
              post_tags = '{$post_tags}', 
              post_status = '{$post_status}' 
              WHERE post_id = {$post_id}";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($connection));
    } else {
        echo "<script>
                alert('Post updated successfully');
                window.location.href = 'show.php';
              </script>";
        exit();
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
    <?= $post_content ?></textarea>
    </div>

    <div class="form-group">
        <label for="name">Edit Post Author</label>
        <select class="form-control" name="post_author" id="">
            <?php
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_name = $row['user_name'];
                if ($user_name == $post_author) {
                    echo "<option value='$user_name' selected>$user_name</option>";
                } else {
                    echo "<option value='$user_name'>$user_name</option>";
                }
            }

            ?>
        </select>
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
        <select class="form-control" name="post_status">
            <?php  
        if($post_status == 'published'){ ?>
            <option value="published" selected>Published</option>
            <option value="draft">Draft</option>
            <?php
        } elseif( $post_status == 'draft'){
            ?>
            <option selected value="draft">Draft</option>
            <option value="published">Published</option>
            <?php
        }
        ?>
        </select>
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



    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
</form>

<?php

}



/**
 * Comments
 * SHOW ALL COMMENTS
 * EDIT COMMENT
 * DELETE COMMENT
 * @param string $comment_id
 * @throws Exception if any of the required fields are empty.
 * @return void
 */



//SHOW ALL COMMENTS
ob_start() ;
function showAllComments(){
    global  $connection ; 
//selecting all categories in navmenu
$query = "SELECT * FROM comments ";
$select_all_comments = mysqli_query($connection , $query);
if(!$select_all_comments){
    die('query failed' . mysqli_error($connection));
}

   
//DELETE comment 

if(isset($_GET['delete'])){
    if(isset($_SESSION['user_role'])  ){
        if($_SESSION['user_role'] == 'Admin' ){
    $the_comment_id = mysqli_real_escape_string($connection, $_GET['delete']);
    $query_delete = "DELETE FROM comments WHERE comment_id = $the_comment_id";
    $result = mysqli_query($connection , $query_delete);
    if(!$result){
        die('query failed' . mysqli_error($connection));
    }
    else{
        echo '<script>alert("comment Deleted")</script>' ;
        header("Location: show.php");
        exit();
      
    }
    
}
}
}

while($all_comments = mysqli_fetch_assoc($select_all_comments)) : ?>
<tr>
    <td><?php echo $all_comments['comment_id']; ?></td>
    <td><?php echo $all_comments['comment_author']; ?></td>
    <td><?php echo $all_comments['comment_content']; ?></td>
    <td><?php echo $all_comments['comment_email']; ?></td>
    <td><?php echo $all_comments['comment_status']; ?></td>

    <!-- MAKE APROOVE AND DELETE COMMENT ONLY FOR ADMIN -->
    <?php
     if(isset($_SESSION['user_role'])  ){
        if($_SESSION['user_role'] == 'Admin' ){ 
    ?>
    <?php 
        $query = "SELECT * FROM posts WHERE post_id = " . (int)$all_comments['comment_post_id'];
        $select_posts_relared_comment = mysqli_query($connection , $query);
     while($all_posts = mysqli_fetch_assoc($select_posts_relared_comment)){
        ?>
    <td> <?php echo $all_posts['post_title']; ?></td>

    <?php
     }
    ?>

    <td><?php echo $all_comments['comment_date']; ?></td>
    <td>
        <?php if($all_comments['comment_status'] == 'unapproved') { ?>
        <a href="show.php?approve=<?php echo $all_comments['comment_id']; ?>" class="btn btn-success"> Approve</a>
        <?php  } else{
            echo "";
         }  ?>
    </td>
    <td>
        <?php if($all_comments['comment_status'] == 'Approved') { ?>
        <a href="show.php?unapprove=<?php echo $all_comments['comment_id']; ?>" class="btn btn-warning"> Unapprove</a>
        <?php  } else{
        echo "";  
    }
    ?>
    </td>
    <td><a href="show.php?delete=<?php echo $all_comments['comment_id']; ?>" class="btn btn-danger">Delete
    </td>
    <?php
        }
    }
    ?>
    <!-- <td>
        <a href="edit.php?edit=<?php echo $all_comments['comment_id'];?>"> Update </a>
    </td> -->
</tr>
<?php endwhile; 
}

// update comment status  to approved

if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $the_comment_id";
    $result = mysqli_query($connection , $query);
    if(!$result){
        die('query failed' . mysqli_error($connection));
    }
    else{
        header("Location: show.php");
        echo '<script>alert("comment approved")</script>' ;
        exit();
    }
}
// update comment status  to unapproved

if(isset($_GET['unapprove'])){
    $the_comment_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
    $result = mysqli_query($connection , $query);
    if(!$result){
        die('query failed' . mysqli_error($connection));
    }
    else{
        header("Location: show.php");
        echo '<script>alert("comment unapproved")</script>' ;
        exit();
    }
}
ob_end_flush() ;


/**
 * usres
 * SHOW ALL USERS
 * EDIT USER
 * DELETE USER
 * @param string $user_id
 * @throws Exception if any of the required fields are empty.
 * @return void
 */




//SHOW ALL USERS

function showAllUsers(){
    global  $connection ; 
//selecting all categories in navmenu
$query = "SELECT * FROM users ";
$select_all_users = mysqli_query($connection , $query);
if(!$select_all_users){
    die('query failed' . mysqli_error($connection));
}

   
//DELETE user 
// Check if the delete request is made
if (isset($_POST['delete'])) {

    // Check if the user role is set and the user is an Admin
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

        // Retrieve and sanitize the category ID
        $the_user_id = mysqli_real_escape_string($connection, $_POST['user_id']);

        // Check if category ID is valid
        if (is_numeric($the_user_id)) {

            // Use prepared statement to safely delete category
            $query_delete = "DELETE FROM users WHERE user_id = ?";
            $stmt = mysqli_prepare($connection, $query_delete);
            mysqli_stmt_bind_param($stmt, 'i', $the_user_id);
            $result = mysqli_stmt_execute($stmt);

            // Check if the deletion was successful
            if (!$result) {
                die('Query failed: ' . mysqli_error($connection));
            } else {
                echo '<script>alert("User Deleted"); window.location.href="show.php";</script>';
                exit(); // Stop further script execution
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo '<script>alert("Invalid category ID")</script>';
        }
    }
}

while($all_users = mysqli_fetch_assoc($select_all_users)) : ?>
<tr>
    <td><?php echo $all_users['user_id']; ?></td>
    <td><?php echo $all_users['user_name']; ?></td>
    <td><?php echo $all_users['user_password']; ?></td>
    <td><?php echo $all_users['user_email']; ?></td>
    <td><?php echo $all_users['user_firstname']; ?></td>
    <td><?php echo $all_users['user_lastname']; ?></td>
    <td>
        <img style="width: 100px; height: 100px; object-fit: cover; " class="img-responsive"
            src="../..//images/<?= $all_users['user_image'] ?>" alt="" />
    </td>
    <td><?php echo $all_users['user_role']; ?></td>
    <!-- delete user -->
    <form method="post" onsubmit="return confirmDeletion();">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($all_users['user_id']); ?>">
        <td>
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
        </td>
    </form>
    <script>
    // JavaScript function to confirm deletion
    function confirmDeletion() {
        return confirm("Are you sure you want to delete this user?");
    }
    </script>
     <!-- delete user -->
    <td>
        <a class="btn btn-success" href="edit.php?edit=<?php echo $all_users['user_id'];?>"> Edit </a>
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

 function adduser(){

    global  $connection ; 
    // 
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    // move uploaded image to images folder
    move_uploaded_file($user_image_temp, "../../images/$user_image");

   

 /// check if fields are empty
    if($user_name == "" || empty($user_name  )){
        echo "<p class='text-danger'>User title must not be empty</p>";
    } elseif ( empty($user_password  )) {
        echo "<p class='text-danger'> User password must not be empty</p>";
    } elseif ( empty($user_email  )) {
        echo "<p class='text-danger'> User email must not be empty</p>";
    } elseif (  empty($user_image  )) {
        echo "<p class='text-danger'>User image must not be empty</p>";
    } elseif ( empty($user_firstname  )) {
        echo "<p class='text-danger'>User firstname must not be empty</p>";
    } elseif ( empty($user_lastname  )) {
        echo "<p class='text-danger'>User lastname must not be empty</p>";
    } elseif ( empty($user_role  )) {
        echo "<p class='text-danger'>User role must not be empty</p>";
    } 
    // inser the data into database
    else{
   // Encrypting password
   $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);
    $query = "INSERT INTO users(user_name,user_password,user_email,user_image,user_firstname,user_lastname,user_role ) VALUES('{$user_name}','{$hashed_password}','{$user_email}','{$user_image}','{$user_firstname}','{$user_lastname}','{$user_role}')";
    $result = mysqli_query($connection , $query);

    if(!$result){
        die('query failed' . mysqli_error($connection));
    }
    else{
        header("Location: show.php");
        echo '<script>alert("User Added")</script>' ;
    }
   
}
}

}


/**
 * Edits a user in the database.
 *
 * @throws Exception if any of the required fields are empty.
 * @return void
 */

 function editUser() {
     global $connection;
 
     // Step 1: Get the ID from the URL
     if (isset($_GET['edit'])) {
         $user_id = intval($_GET['edit']); // Ensure ID is an integer
 
         // Step 2: Query the database for the user with the specified ID
         $query = "SELECT * FROM users WHERE user_id = $user_id";
         $result = mysqli_query($connection, $query);
         
         if (!$result) {
             // Output the error if the query fails
             die("Query failed: " . mysqli_error($connection));
         } elseif ($result && mysqli_num_rows($result) > 0) {
             $user = mysqli_fetch_assoc($result);
             $user_id = $user['user_id'];
             $user_name = $user['user_name'];
             $user_password = $user['user_password'];
             $user_email = $user['user_email'];
             $user_firstname = $user['user_firstname'];
             $user_lastname = $user['user_lastname'];
             $user_image = $user['user_image'];
             $user_role = $user['user_role'];
         } else {
             die("User not found");
         }
     }
 
     // Step 3: Handle the form submission to update the user
     if (isset($_POST['submit'])) {
         $user_id = intval($_POST['user_id']); // Ensure ID is an integer
         $user_name = mysqli_real_escape_string($connection, $_POST['user_name']);
         $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
         $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
         $user_image = $_FILES['user_image']['name'];
         $user_image_temp = $_FILES['user_image']['tmp_name'];
         $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
         $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
         $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);
         if (!empty($user_password)) {
            // Hash the new password
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);
        } else {
            // Keep the existing hashed password if no new password is entered
            $hashed_password = $user_password;
        }
         // Validate form fields
         if (empty($user_name)) {
             echo "<p class='text-danger'>User Name must not be empty</p>";
         } elseif (empty($user_password)) {
             echo "<p class='text-danger'>User password must not be empty</p>";
         } elseif (empty($user_email)) {
             echo "<p class='text-danger'>User email must not be empty</p>";
         } elseif (empty($user_firstname)) {
             echo "<p class='text-danger'>User firstname must not be empty</p>";
         } elseif (empty($user_lastname)) {
             echo "<p class='text-danger'>User lastname must not be empty</p>";
         } elseif (empty($user_role)) {
             echo "<p class='text-danger'>User role must not be empty</p>";
         } else {
             // Handle image upload
             if (!empty($user_image_temp)) {
                 $upload_directory = "../../images/";
                 $upload_file = $upload_directory . basename($user_image);
 
                 if (move_uploaded_file($user_image_temp, $upload_file)) {
                     echo "<p class='text-success'>Image uploaded successfully</p>";
                 } else {
                     echo "<p class='text-danger'>Failed to upload image</p>";
                     $user_image = ''; // Clear the image name if upload fails
                 }
             } else {
                 // Fetch current image if no new image is uploaded
                 $query = "SELECT user_image FROM users WHERE user_id = $user_id";
                 $result = mysqli_query($connection, $query);
                 if ($row = mysqli_fetch_assoc($result)) {
                     $user_image = $row['user_image'];
                 }
             }
 
             // Update user details
             $query = "UPDATE users SET ";
             $query .= "user_name = '{$user_name}', ";
             $query .= "user_password = '{$user_password}', ";
             $query .= "user_email = '{$user_email}', ";
             $query .= "user_image = '{$user_image}', ";
             $query .= "user_firstname = '{$user_firstname}', ";
             $query .= "user_lastname = '{$user_lastname}', ";
             $query .= "user_role = '{$user_role}' ";
             $query .= "WHERE user_id = {$user_id}";
 
             $result = mysqli_query($connection, $query);
 
             if (!$result) {
                 die('Query failed: ' . mysqli_error($connection));
             } else {
                 // Redirect back to the admin page
                 echo "<p class='text-success'>User updated successfully</p>";
                 header("Location: show.php");
                 exit(); // Make sure to exit after header redirection
             }
         }
      
     }
     ?>

<form action="edit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">

    <div class="form-group">
        <label for="name">Edit User Name</label>
        <input value="<?= htmlspecialchars($user_name) ?>" type="text" class="form-control" name="user_name">
    </div>

    <div class="form-group">
        <label for="password">Edit User Password</label>
        <input value="<?= htmlspecialchars($user_password) ?>" type="password" class="form-control"
            name="user_password">
    </div>

    <div class="form-group">
        <label for="email">Edit User Email</label>
        <input value="<?= htmlspecialchars($user_email) ?>" type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="image">Edit User Image</label>
        <img style="width: 100px; height: 100px; display: block;"
            src="../../images/<?= htmlspecialchars($user_image) ?>" alt="User Image">
        <input type="file" class="form-control" name="user_image">
    </div>

    <div class="form-group">
        <label for="firstname">Edit User Firstname</label>
        <input value="<?= htmlspecialchars($user_firstname) ?>" type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Edit User Lastname</label>
        <input value="<?= htmlspecialchars($user_lastname) ?>" type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="role">Edit User Role</label>
        <select class="form-control" name="user_role">
            <?php
                  $query = "SELECT DISTINCT user_role FROM users";
                  $select_roles = mysqli_query($connection, $query);
      
                  if (!$select_roles) {
                      die("QUERY FAILED: " . mysqli_error($connection));
                  }
      
                  while ($row = mysqli_fetch_assoc($select_roles)) {
                      $user_role_title = $row['user_role'];
                      $selected = ($user_role == $user_role_title) ? 'selected' : '';
                      echo "<option value='$user_role_title' $selected>$user_role_title</option>";
                  }
                  ?>
        </select>
    </div>

    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
 }



 
/**
* show user in profile.
*
* @throws Exception if any of the required fields are empty.
* @return void
*/


// Step 1: Get the ID from the URL
function profileUser() {
    global $connection;

    // Step 1: Fetch user data if the session is active
    if (isset($_SESSION['user_name'])) {
        $user_name = $_SESSION['user_name'];
        $query = "SELECT * FROM users WHERE user_name = '$user_name'";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $user_id = $user['user_id'];
            $user_name = $user['user_name'];
            $user_password = $user['user_password'];
            $user_email = $user['user_email'];
            $user_image = $user['user_image'];
            $user_firstname = $user['user_firstname'];
            $user_lastname = $user['user_lastname'];
            $user_role = $user['user_role'];
        } else {
            echo "<p class='text-danger'>User not found</p>";
            return;
        }
    }

    // Step 3: Handle the form submission to update the user
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        $user_id = $_POST['user_id'];
        $user_name = mysqli_real_escape_string($connection, $_POST['user_name']);
        $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
        $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
        $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
        $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);

        // Validate form fields
        if (empty($user_name)) {
            echo "<p class='text-danger'>User Name must not be empty</p>";
        } elseif (empty($user_password)) {
            echo "<p class='text-danger'>User password must not be empty</p>";
        } elseif (empty($user_email)) {
            echo "<p class='text-danger'>User email must not be empty</p>";
        } elseif (empty($user_firstname)) {
            echo "<p class='text-danger'>User firstname must not be empty</p>";
        } elseif (empty($user_lastname)) {
            echo "<p class='text-danger'>User lastname must not be empty</p>";
        } elseif (empty($user_role)) {
            echo "<p class='text-danger'>User role must not be empty</p>";
        } else {
            // Handle image upload
            if (!empty($user_image_temp)) {
                $upload_directory = "../images/";
                $upload_file = $upload_directory . basename($user_image);

                if (move_uploaded_file($user_image_temp, $upload_file)) {
                    echo "<p class='text-success'>Image uploaded successfully</p>";
                } else {
                    echo "<p class='text-danger'>Failed to upload image</p>";
                    $user_image = ''; // Clear the image name if upload fails
                }
            } else {
                // Fetch current image if no new image is uploaded
                $query = "SELECT user_image FROM users WHERE user_id = $user_id";
                $result = mysqli_query($connection, $query);
                if ($row = mysqli_fetch_assoc($result)) {
                    $user_image = $row['user_image'];
                }
            }

            // Update user details
            $query = "UPDATE users SET 
                user_name = '{$user_name}', 
                user_password = '{$user_password}', 
                user_email = '{$user_email}', 
                user_image = '{$user_image}', 
                user_firstname = '{$user_firstname}', 
                user_lastname = '{$user_lastname}', 
                user_role = '{$user_role}' 
                WHERE user_id = {$user_id}";

            $result = mysqli_query($connection, $query);

            if (!$result) {
                die('Query failed: ' . mysqli_error($connection));
            } else {
                echo "<p class='text-success'>User updated successfully</p>";
                // Optionally redirect after a successful update
                header("Location: profile.php"); // Adjust redirect path as needed
                exit();
            }
        }
    }

    ?>
<form action="profile.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">

    <div class="form-group">
        <label for="name">Edit User Name</label>
        <input value="<?= htmlspecialchars($user_name); ?>" type="text" class="form-control" name="user_name">
    </div>

    <div class="form-group">
        <label for="password">Edit User Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="email">Edit User Email</label>
        <input value="<?= htmlspecialchars($user_email); ?>" type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="image">Edit User Image</label>
        <img style="width: 100px; height: 100px; display: block;" src="../images/<?= htmlspecialchars($user_image); ?>"
            alt="User Image">
        <input type="file" class="form-control" name="user_image">
    </div>

    <div class="form-group">
        <label for="firstname">Edit User Firstname</label>
        <input value="<?= htmlspecialchars($user_firstname); ?>" type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Edit User Lastname</label>
        <input value="<?= htmlspecialchars($user_lastname); ?>" type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="role">Edit User Role</label>
        <select class="form-control" name="user_role">
            <?php
            $query = "SELECT DISTINCT user_role FROM users";
            $select_roles = mysqli_query($connection, $query);

            if (!$select_roles) {
                die("QUERY FAILED: " . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($select_roles)) {
                $user_role_title = $row['user_role'];
                $selected = ($user_role == $user_role_title) ? 'selected' : '';
                echo "<option value='$user_role_title' $selected>$user_role_title</option>";
            }
            ?>
        </select>
    </div>

    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
</form>


<?php
}



//USERS OMLINE EDIT FUNCTION ENDS
function users_online() {
    global $connection;

    // Start session if not already started
  
    // Get current session ID and time
    $session = session_id();
    $time = time(); // Get current Unix timestamp
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;

    // Query to check if the session already exists
    $query = "SELECT * FROM users_online WHERE session = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $session);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);

    // Insert or update the session in the database
    if ($count == 0) {
        // Prepared statement for inserting a new session
        $insert_query = "INSERT INTO users_online (session, time) VALUES (?, ?)";
        $insert_stmt = mysqli_prepare($connection, $insert_query);
        mysqli_stmt_bind_param($insert_stmt, "si", $session, $time);
        if (!mysqli_stmt_execute($insert_stmt)) {
            echo "Error inserting data: " . mysqli_error($connection);
        }
        mysqli_stmt_close($insert_stmt);
    } else {
        // Prepared statement for updating an existing session
        $update_query = "UPDATE users_online SET time = ? WHERE session = ?";
        $update_stmt = mysqli_prepare($connection, $update_query);
        mysqli_stmt_bind_param($update_stmt, "is", $time, $session);
        if (!mysqli_stmt_execute($update_stmt)) {
            echo "Error updating data: " . mysqli_error($connection);
        }
        mysqli_stmt_close($update_stmt);
    }

    // Query to count active sessions within the timeout period
    $user_online_query = "SELECT * FROM users_online WHERE time > ?";
    $user_online_stmt = mysqli_prepare($connection, $user_online_query);
    mysqli_stmt_bind_param($user_online_stmt, "i", $time_out);
    mysqli_stmt_execute($user_online_stmt);
    mysqli_stmt_store_result($user_online_stmt);
    $count_user = mysqli_stmt_num_rows($user_online_stmt);
    mysqli_stmt_close($user_online_stmt);

    // Return the number of users online
    return $count_user;
}