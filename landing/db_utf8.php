<?php
/*
$dbuser = "bbsusr";
$dbpass = "bbs#pwd";
$dbname = "bbsrecruitdb";
//$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die(mysql_error());
//mysqli_query($con,"set character set utf8");
*/
$dbhost = "localhost";
$cloud_sql_connection_name = "bbsrecruit:asia-southeast1:ttinst";
$database = "bbsrecruitdb";
$username = "bbsusr";
$password = "bbs#pwd";
$socket_dir = "/cloudsql";
$dsn = sprintf('mysql:dbname=%s;unix_socket=%s/%s',$database,$socket_dir,$cloud_sql_connection_name);
//$dsn = sprintf('mysql:dbname=%s;host=%s',$database,$dbhost);
$con = new PDO($dsn, $username,$password);
$con->exec("set names utf8mb4");
?>