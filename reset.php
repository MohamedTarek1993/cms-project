<?php include "includes/header.php"; ?>

<?php
$varfied = false;
//if token or email are not set, redirect to 404 page 
if (!isset($_GET['token']) || !isset($_GET['email'])) {
    header("Location: 404.php");
    exit();
}

?>

<?php
// Query for token and email
$stmt = mysqli_prepare($connection, "SELECT user_name, user_email, token FROM users WHERE token = ? LIMIT 1");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $_GET['token']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_name, $user_email, $token);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Check if email and token match
    if ($_GET['email'] !== $user_email || $_GET['token'] !== $token) {
        header("Location: 404.php");
        exit();
    }

    // Handle password reset form submission
    if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
        if ($_POST['password'] !== $_POST['confirm_password']) {
            echo "<script>alert('Passwords don\'t match');</script>";
        } elseif (strlen($_POST['password']) < 6) {
            echo "<script>alert('Password must be at least 6 characters');</script>";
        } else {
            // Hash the password
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 12));

            // Prepare an update query to reset the password
            $stmt = mysqli_prepare($connection, "UPDATE users SET user_password = ?, token = '' WHERE token = ? LIMIT 1");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $password, $_GET['token']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                // Success: Password has been updated
                $varfied = true;
                echo "<script>alert('Password reset successful');</script>";
                header("Location: login.php");
                exit();
            } else {
                echo mysqli_error($connection);
            }
        }
    }

} else {
    echo mysqli_error($connection);
}
?>

<!-- Page Content -->
<div class="container">

    <?php if (!$varfied) : ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                    <div class="form-group" style="margin-bottom: 25px">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 25px">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input onkeyup="validatePassword()" type="password" name="confirm_password"
                                                id="confirmPassword" class="form-control">
                                        </div>
                                    </div>

                                    <span id="msg"></span>

                                    <div class="form-group">
                                        <input name="reset" id="reset" class="btn btn-lg btn-primary btn-block"
                                            value="Reset Password" type="submit">
                                    </div>

                                </form>
                                <script>
                                const password = document.getElementById('password');
                                const confirmPassword = document.getElementById('confirmPassword');
                                const msg = document.getElementById('msg');

                                function validatePassword() {
                                    msg.classList.add('text-danger'); // Add danger class
                                    if (password.value !== confirmPassword.value) {
                                        confirmPassword.setCustomValidity('Passwords Don\'t Match');
                                        msg.innerHTML = 'Passwords Don\'t Match';
                                    } else {
                                        confirmPassword.setCustomValidity('');
                                        msg.innerHTML = 'Password match';
                                        msg.classList.remove('text-danger');
                                        msg.classList.add('text-success'); // Add success class if match
                                    }
                                }
                                </script>

                            </div><!-- Body -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else : ?>
    <?php header("Location: login.php");
    exit();
    ?>
    <?php endif; ?>

    <hr>

    <?php include "includes/footer.php"; ?>

</div> <!-- /.container -->