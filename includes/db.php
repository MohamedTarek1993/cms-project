<?php 


// cheching if db is connected succfully

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_password'] = '';
$db['db_name'] = 'cms_project';

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}
$connection =   mysqli_connect( DB_HOST , DB_USER , DB_PASSWORD , DB_NAME ); ;
if(!$connection){
    die('connection failed' . mysqli_error($connection));
}
else{
}


//selecting all categories in navmenu
$query = "SELECT * FROM category ";
$select_all_categories = mysqli_query($connection , $query);
if(!$select_all_categories){
    die('query failed' . mysqli_error($connection));
}


//selecting all categories in sidebar
$query = "SELECT * FROM category ";
$select_all_categories_sidbar = mysqli_query($connection , $query);
if(!$select_all_categories_sidbar){
    die('query failed' . mysqli_error($connection));
}


// FETCH POST QUERY
$query_post = "SELECT * FROM posts ";
$select_all_posts = mysqli_query($connection , $query_post);
if(!$select_all_posts){
    die('query failed' . mysqli_error($connection));
}

?>