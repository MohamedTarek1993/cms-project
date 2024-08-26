<?php 

function login(){
    global  $connection ; 
 if(isset($_POST['login'])) {

    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    $user_name = mysqli_real_escape_string($connection, $user_name);
    $user_password = mysqli_real_escape_string($connection, $user_password);

    $query = "SELECT * FROM users WHERE user_name = '{$user_name}' ";
    $select_user_query = mysqli_query($connection, $query); 

    if(!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_user_name = $row['user_name'];
        $db_user_first_name = $row['first_name'];
        $db_last_name = $row['last_name'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];

    }

    if( $user_name === $db_user_name  && password_verify($user_password, $db_user_password)) {
        $_SESSION['user_name'] = $db_user_name;
        header("Location: ../admin/index.php");
    } else {
        header("Location: ../index.php");
    }
 }
}

?>

<form action="" method="post">
    <div class="form-group">
        <input name="user_name" type="text" class="form-control">
    </div>

    <div class="input-group">
        <input name="user_password" type="password" class="form-control">
        <span class="input-group-btn">
            <button name="login" class="btn btn-default" type="submit">
                <span> Login</span>
            </button>
        </span>
    </div>
</form>