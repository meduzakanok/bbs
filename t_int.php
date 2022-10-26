<?php
//$host_name = "34.143.152.42";
$cloud_sql_connection_name = "bbsrecruit:asia-southeast1:ttinst";
$database = "bbsrecruitdb";
$username = "bbsusr";
$password = "bbs#pwd";
$socket_dir = "/cloudsql";

//$GCSocket ="/cloudsql/bbsrecruit:asia-southeast1:ttinst"; 
//$GCPort='3306';

$dsn = sprintf(
	'mysql:dbname=%s;unix_socket=%s/%s',
	$database,
	$socket_dir,
	$cloud_sql_connection_name
);
$pdo = new PDO($dsn, $username,$password);
$stmt = $pdo->query("SELECT rec_name,rec_sname FROM rec_user");
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $row){
	echo "<li>{$row['rec_name']} {$row['rec_sname']}</li>"
}
?>