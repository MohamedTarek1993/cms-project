<?php 
include 'includes/db.php';
include 'includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Awab Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    .pager li .page-link.active {
        background-color: aqua;
        color: black;
    }
    </style>
</head>

<body>


    <!-- Navigation -->
    <nav class="navbar  navbar-expand-lg  navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Awab Blog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php   while($all_categories = mysqli_fetch_assoc($select_all_categories)): ?>
                            <li><a class="dropdown-item"
                                    href="categories.php?post_category_id=<?php echo $all_categories['cat_id']; ?>"><?php echo $all_categories['cat_title']; ?></a>
                            </li>
                            <?php endwhile ; ?>
                           
                        </ul>
                    </li>
                    <?php   while($all_categories = mysqli_fetch_assoc($select_all_categories)): ?>
                    <li><a
                            href="categories.php?post_category_id=<?php echo $all_categories['cat_id']; ?>"><?php echo $all_categories['cat_title']; ?></a>
                    </li>
                    <?php endwhile ; ?>
                    <?php  
                if(isset($_SESSION['user_role'])) {
                ?>
                    <li>
                        <a href="admin/index.php">Dashboard</a>
                    </li>
                    <?php } ?>

                    <li>
                        <a href=" 
                        <?php 
                          if(isset($_SESSION['user_role'])) {
                            if($_SESSION['user_role'] == 'Admin' || $_SESSION['user_role'] == 'Subscriber' || $_SESSION['user_role'] == 'contributor') { ?>
                               login.php
                                <?php } } else{ ?>
                                 register.php
                                    
                           <?php     }
                       ?>
                        ">Login / Register</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>