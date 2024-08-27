<?php  

//  include '../includes/db.php';
include('includes/header.php') ;




define('BASE_URL', '/cms-project');
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

    if($user_name !== $db_user_name && $user_password !== $db_user_password) { 
        ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header text-center ">Incorrect Login</h1>
            <!-- HOME CARDS -->

        </div>
    </div>
</div>

<?php



?>


<?php
        header("Location: ../index.php");
    } else if($user_name === $db_user_name && $user_password === $db_user_password) {
        $_SESSION['user_name'] = $db_user_name;
        $_SESSION['first_name'] = $db_user_first_name;
        $_SESSION['last_name'] = $db_last_name;
        $_SESSION['user_role'] = $db_user_role;

        header("Location: ../admin/index.php");
       
    }
 }
}

?>

<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- HOME CARDS -->
            <?php include 'includes/template-parts/card-home.php'  ?>
            <!-- HOME CARDS -->
            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include('../includes/sidebar.php') ; ?>

    </div>
    <!-- /.row -->

    <hr>


</div>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>
</div>
<!-- /.container -->