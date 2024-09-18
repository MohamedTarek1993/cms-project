<?php 
if (isset($_POST['login'])) {
    global $connection;
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($connection, "SELECT user_id, user_name, user_password, user_role FROM users WHERE user_name = ?");
    mysqli_stmt_bind_param($stmt, 's', $user_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $db_user_id, $db_user_name, $db_user_password, $db_user_role);

    if (mysqli_stmt_fetch($stmt)) {
    
        // Check if a session is not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verify the entered password with the hashed password from the database
        if (password_verify($user_password, $db_user_password)) {
            // Password matches, login successful
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['user_name'] = $db_user_name;
            $_SESSION['user_role'] = $db_user_role;
            echo "<script>
            alert('You are now logged in!');
            window.location.href = 'index.php';
                </script>";
            exit();

            echo "Login successful!";
        } else {
            // Incorrect password
            $_SESSION['login_error'] = "Incorrect password";
            echo "<script> alert('Incorrect password'); </script>";
            header("Location: login.php");
            exit();
        }
    } else {
        // Username not found
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['login_error'] = "User does not exist";
        echo "<script> alert('User does not exist!'); </script>";
        header("Location: login.php");
        exit();
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

?>

<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1><?php echo _Login; ?></h1>

                        <form method="post">
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
                            <div class="input-group" style="margin: 20px 0;">
                                <span class="pull-right">
                                    <a class="btn btn-info"
                                        href="<?php echo BASE_URL; ?>/forget.php?token=<?php echo uniqid(true); ?>">Forget
                                        Password</a>
                                </span>
                                <span class="pull-left">
                                    <a class="btn btn-success" href="<?php echo BASE_URL; ?>/register.php">Register
                                        Now</a>
                                </span>
                            </div>
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>