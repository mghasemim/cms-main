<?php 

#for Databse connection
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "cms";

    $connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);

if(!$connection) {
    echo "db connection failed";
    
}

/* (Edwin way) dunno why -_- (yet)
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST,DB_USER.DB_PASS,DB_NAME);
if($connection) {

    echo "we are connected";

} */ 






















?>