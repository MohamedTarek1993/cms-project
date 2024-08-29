<?php

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

if(isset($_GET['delete'])){

    $user_id = $_GET['delete'];
    $query_delete = "DELETE FROM users WHERE user_id = $user_id";
    $result = mysqli_query($connection , $query_delete);
    if(!$result){
        die('query failed' . mysqli_error($connection));
    }
    else{
        header("Location: show.php");
        echo '<script>alert("User Deleted")</script>' ;
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
    <td><a href="show.php?delete=<?php echo $all_users['user_id']; ?>" class="btn btn-danger">Delete
    </td>
    <td>
        <a href="edit.php?edit=<?php echo $all_users['user_id'];?>"> Update </a>
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
   
    $query = "INSERT INTO users(user_name,user_password,user_email,user_image,user_firstname,user_lastname,user_role ) VALUES('{$user_name}','{$user_password}','{$user_email}','{$user_image}','{$user_firstname}','{$user_lastname}','{$user_role}')";
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
