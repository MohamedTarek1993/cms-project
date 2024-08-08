<?php 
//cheching if db is connected succfully

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



