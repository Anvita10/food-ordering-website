<?php

session_start();

// making connections with database
// making the constant
define('SITEURL','http://localhost/PHP/');
define('LOCALHOST','localhost');
define('db_user','root');
define('db_password','');
define('db_name','food order');
$conn=mysqli_connect(LOCALHOST,db_user,db_password) or die(mysqli_error());
$db=mysqli_select_db($conn,db_name) or die(mysqli_error());

?>