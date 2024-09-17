<?php

?>


<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
       <?php include 'template-parts/search.php'; ?>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->

     <!-- login Well -->
     <?php if(!isset($_SESSION['user_role'])) { ?>
     <div class="well">
        <h4>Login Search</h4>
       
       <?php include 'login.php'; ?>
        
        <!-- /.input-group -->
    </div>
    <?php }elseif(isset($_SESSION['user_role'])){

        echo '
        <div class="well">
        <h4>Logged in as '.$_SESSION["first_name"].' ' .$_SESSION["last_name"]. '.</h4>
        <a href="includes/logout.php" class="btn btn-primary">Logout</a>
    </div>';
    }  ?>
    <!--login Well -->

    <?php include('categories.php'); ?>

    <!-- Side Widget Well -->
    <div class="well">
      
    </div>

</div>