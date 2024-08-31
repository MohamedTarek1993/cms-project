<?php

include 'header.php' ;
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome To Admin
                    <small> <?php echo $_SESSION['user_name'] ?> </small>
                </h1>

            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                    <?php
                    $query = "SELECT * FROM posts ";
                    $select_all_posts = mysqli_query($connection, $query);
                    if(!$select_all_posts){
                        die('query failed' . mysqli_error($connection));
                    }
                    $posts_count = mysqli_num_rows($select_all_posts);

                    echo $posts_count;
                    ?>
                                </div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>/admin/posts/show.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                    <!-- show comments count -->
                                    <?php
                    $query = "SELECT * FROM comments ";
                    $select_all_comments = mysqli_query($connection, $query);
                    if(!$select_all_comments){
                        die('query failed' . mysqli_error($connection));
                    }
                    $comments_count = mysqli_num_rows($select_all_comments);

                    echo $comments_count;
                    ?>
                                    <!-- show comments count -->
                                </div>
                                <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>/admin/comments/show.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                    <!-- show users count -->
                                    <?php
                    $query = "SELECT * FROM users ";
                    $select_all_users = mysqli_query($connection, $query);
                    if(!$select_all_users){
                        die('query failed' . mysqli_error($connection));
                    }
                    $users_count = mysqli_num_rows($select_all_users);

                    echo $users_count;
                    ?>
                                    <!-- show users count -->

                                </div>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>/admin/users/show.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                    <!-- show users count -->
                                    <?php
                    $query = "SELECT * FROM category ";
                    $select_all_categories = mysqli_query($connection, $query);
                    if(!$select_all_categories){
                        die('query failed' . mysqli_error($connection));
                    }
                    $cats_count = mysqli_num_rows($select_all_categories);

                    echo $cats_count;
                    ?>
                                    <!-- show users count -->
                                </div>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>/admin/categories/show.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div id="columnchart_values" style="width: auto; height: 400px;"></div>

        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include 'footer.php' ; ?>

<script type="text/javascript">
google.charts.load("current", {
    packages: ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ["Element", "Density", {
            role: "style"
        }],
        ["Posts", <?php echo $posts_count; ?>, "#337ab7"],
        ["Categories", <?php echo $cats_count; ?>, "#d9534f"],
        ["Comments", <?php echo $comments_count; ?>, "#5cb85c"],
        ["Users", <?php echo $users_count; ?>, "color: #f0ad4e"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
        {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
        },
        2
    ]);

    var options = {
        title: "Show data and statistics",
        width: 600,
        height: 400,
        bar: {
            groupWidth: "95%"
        },
        legend: {
            position: "none"
        },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
    chart.draw(view, options);
}
</script>