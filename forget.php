<?php  include "includes/header.php"; ?>

<?php 
// if remove token redirect to home page
if (!isset($_GET['token'])) {
    header("Location: index.php");
   exit() ;
}

if(ifItIsMethod('post')){
    if(isset($_POST['email'] )){
        $email = trim($_POST['email']);
        // check if email is empery
        if(empty($email)){
            echo "<script> alert('Please Enter Email'); </script>";
        }
        // check if email is valid
        elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            echo "<script> alert('Email must be valid'); </script>";
          }
          //checkif email is not found  
          else{
            $email = mysqli_real_escape_string($connection, $email);
            $check_query = "SELECT * FROM users WHERE user_email = '{$email}'";
            $check_result = mysqli_query($connection, $check_query);

            if (mysqli_num_rows($check_result)  == 0) {
                echo "<script>alert('Email does not exist');</script>";
            }else{
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $token = $_GET['token'];
                    $token = mysqli_real_escape_string($connection, $token);
                    $email = mysqli_real_escape_string($connection, $email);

                    $stmt = mysqli_prepare($connection, "UPDATE users SET token = ? WHERE user_email = ? LIMIT 1");
                    if ($stmt) {
                        // Bind both $token and $email
                        mysqli_stmt_bind_param($stmt, "ss", $token, $email);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                    }else{
                        echo mysqli_error($connection);
                    }
                }
            }
       
        }
     
    }
    }

?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">




                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="email address"
                                                class="form-control" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block"
                                            value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->