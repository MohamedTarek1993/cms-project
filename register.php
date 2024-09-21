<?php 

include('includes/header.php') ;
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register'])) {
    global $connection;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation of fields
    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>alert('Field must not be empty');</script>";
    } elseif (strlen($username) < 4) {
        echo "<script>alert('Username must be at least 4 characters');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email must be valid');</script>";
    } elseif (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters');</script>";
    } else {
        // Check if the username or email already exists
        $stmt = mysqli_prepare($connection, "SELECT * FROM users WHERE user_name = ? OR user_email = ?");
        mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username or email already exists');</script>";
        } else {
            // Encrypt the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            // Insert the user into the database using prepared statements
            $stmt = mysqli_prepare($connection, "INSERT INTO users (user_name, user_email, user_password, user_role) VALUES (?, ?, ?, 'subscriber')");
            mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                                echo "<script>
                        alert('You are now registered and can log in');
                        window.location.href = 'login.php';
                    </script>";
                exit();
            } else {
                die("QUERY FAILED: " . mysqli_error($connection));
            }
        }
        // Close the statement
        mysqli_stmt_close($stmt);
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
                                    placeholder="Enter Desired Username"
                                    value="<?php if(!empty($username)) echo $username;  ?>">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="somebody@example.com" value="<?= isset($email) ? $email : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                    placeholder="Password">
                            </div>

                            <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                value="register">
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