<?php
$hostname = null; //Defaults to mysqli.default_host
$username = "bbsusr";
$password = "bbs#pwd";
$database = "bbsrecruitdb"; //Defaults to "" 
$port = null; //Defaults to mysqli.default_port
$socket = "/cloudsql/bbsrecruit:asia-southeast1:ttinst";
$mysqli = mysqli($hostname, $username, $password, $database, $port, $socket);
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}else {
	echo 'DB is connected..! <BR>';
}
?>
