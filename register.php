<?php 

include('includes/header.php') ;
 

 if( $_SERVER['REQUEST_METHOD'] == "POST" &&  isset($_POST['rigster'])){
    global  $connection ;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  if(empty($username) || empty($email) || empty($password)){
    echo "  
    <script> alert('Field must not be empty'); </script>";
  }else{
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

     // Check if the username or email already exists
     $check_query = "SELECT * FROM users WHERE user_name = '{$username}' OR user_email = '{$email}'";
     $check_result = mysqli_query($connection, $check_query);

     if (mysqli_num_rows($check_result) > 0) {
         echo "<script>alert('Username or email already exists');</script>";
     }else{
        // Encrypting password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT , array('cost' => 12));
        // Insert the user into the database
        $query = "INSERT INTO users (user_name, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}', '{$email}', '{$hashed_password}', 'subscriber')";
        $register_user_query = mysqli_query($connection, $query);

        if (!$register_user_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        } else {
            echo "<script> alert('You are now registered and can log in'); </script>";
            header("Location: index.php");
        }
    }
}
}
 ?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                    placeholder="Password">
                            </div>

                            <input type="submit" name="rigster" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                value="Register">
                        </form>
                        <p class="text-center">or <a href="login.php">Login</a></p>
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>





    <!-- Footer -->
    <?php   include 'includes/footer.php'; ?>
</div>
<!-- /.container -->