<?php
$dbhost = "localhost";
$dbuser = "bbsusr";
$dbpass = "bbs#pwd";
$dbname = "bbsrecruitdb";
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die(mysql_error());
//mysqli_query($con,"set character set utf8");
?>