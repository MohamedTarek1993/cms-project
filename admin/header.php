<?php 

include 'includes/db.php';
include 'functions.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
// if session is not set this will redirect to login page or dashboard if is admin
if (!isset($_SESSION['user_role']) ) {

    header("Location: ../index.php");
    exit();
}

  define('BASE_URL', '/cms-project');
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Area</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo BASE_URL; ?>/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo BASE_URL; ?>/admin/css/sb-admin.css" rel="stylesheet">

    <!-- Summernote CSS -->
    <link href="<?php echo BASE_URL; ?>/admin/css/summernote-min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo BASE_URL; ?>/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    table {
        border-collapse: collapse;
        width: 100%;
        overflow: scroll;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #load-screen {
        background: url(../../images/header-back.png);
        position: fixed;
        z-index: 10000;
        top: 0px;
        width: 100%;
        height: 1600px;

    }


    #loading {
        width: 500px;
        height: 500px;
        margin: 10% auto;
        background: url(../../images/loader.gif);
        background-size: 40%;
        background-repeat: no-repeat;
        background-position: center;

    }
    </style>
</head>

<body>
    <!-- LOADER -->
    <div id="load-screen">
        <div id="loading"></div>
    </div>
    <!-- LOADER -->
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo BASE_URL; ?>/admin">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                
                <li>
                    <a href="#">
                    <?php 
                    $count_user = users_online();
                    echo $count_user ; ?>
                        <i class="fa fa-fw fa-power-off"></i>
                        users online
                    </a>

                </li>
                <li><a href="<?php echo BASE_URL; ?>">Home</a></li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <strong>
                            <?php echo $_SESSION['first_name'] ;?> <?php echo $_SESSION['last_name'] ; ?> </strong>
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>/includes/logout.php"><i class="fa fa-fw fa-power-off"></i>
                                Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include 'sidebar.php' ?>
            <!-- /.navbar-collapse -->
        </nav>