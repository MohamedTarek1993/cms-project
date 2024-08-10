<?php ?>


<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="#"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Posts
                <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="<?php echo BASE_URL; ?>/admin/posts/show.php">All Posts</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>/admin/posts/add.php">Create Post</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#Categories"><i class="fa fa-fw fa-table"></i>
                Categories <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="Categories" class="collapse">
                <li>
                    <a href="<?php echo BASE_URL; ?>/admin/categories/show.php">All Categories</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>/admin/categories/add.php">Create Categories</a>
                </li>
            </ul>
        </li>


        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#user"><i class="fa fa-fw fa-arrows-v"></i> Users
                <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="user" class="collapse">
                <li>
                    <a href="#">All Users</a>
                </li>
                <li>
                    <a href="#">Create User</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
        </li>
    </ul>
</div>