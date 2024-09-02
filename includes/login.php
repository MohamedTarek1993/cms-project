<?php

include 'db.php';

session_start();

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


    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_user_name = $row['user_name'];
        $db_user_first_name = $row['user_firstname'];
        $db_last_name = $row['user_lastname'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];     
    }
    

    if ( $user_name === $db_user_name || $user_password === $db_user_password  ) {
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