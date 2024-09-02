<?php
include('includes/header.php') ;




if (isset( $_POST['login'])) {
    global  $connection ; 
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    // Escape inputs to prevent SQL injection
    $user_name = mysqli_real_escape_string($connection, $user_name);
    $user_password = mysqli_real_escape_string($connection, $user_password);

    $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }

    $user_found = false;
    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_user_name = $row['user_name'];
        $db_user_first_name = $row['user_firstname'];
        $db_last_name = $row['user_lastname'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];      
    }

    if ($user_found && password_verify($user_password, $db_user_password)) {
        // Successful login
        $_SESSION['user_name'] = $db_user_name;
        $_SESSION['first_name'] = $db_user_first_name;
        $_SESSION['last_name'] = $db_last_name;
        $_SESSION['user_role'] = $db_user_role;
       header("Location: ../admin/index.php");
       exit();
    
    } else {
        // Failed login
        $_SESSION['login'] = "Please enter valid username or password";
        header("Location: ../index.php");
        exit();
    }
}
?>

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1>Login</h1>
                    <form role="form" action="admin\index.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="user_name">Username:</label>
                            <input name="user_name" type="text" class="form-control" id="user_name"
                                placeholder="Enter your username" required>
                        </div>
                        <div class="form-group">
                            <label for="user_password">Password:</label>
                            <input name="user_password" type="password" class="form-control" id="user_password"
                                placeholder="Enter your password" required>
                        </div>

                        <div class="input-group">
                            <span class="input-group-btn">
                                <button name="login" class="btn btn-default" type="submit">
                                    <span>Login</span>
                                </button>
                            </span>
                        </div>
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>




<!-- Footer -->
<?php   include 'includes/footer.php'; ?>
</div>
<!-- /.container -->