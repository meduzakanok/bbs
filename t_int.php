<?php
$host_name = "34.143.152.42";
$database = "bbsrecruitdb";
$user_name = "bbsusr";
$password = "bbs#pwd";
$GCSocket ="/cloudsql/bbsrecruit:asia-southeast1:ttinst"; 
$GCPort='3306';

$connect = mysqli_connect($host_name, $user_name,$password,$database,$GCPort,$GCSocket );
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error() ."<br>";
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL ."<br>";
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL  ."<br><br>";
} else {
	echo 'DB is connected..! <BR>';
}
//return $connect;
?>