<?php
//$host_name = "34.143.152.42";
$cloud_sql_connection_name = "bbsrecruit:asia-southeast1:ttinst";
$database = "bbsrecruitdb";
$username = "bbsusr";
$password = "bbs#pwd";
$socket_dir = "/cloudsql";

$dsn = sprintf(
	'mysql:dbname=%s;unix_socket=%s/%s',
	$database,
	$socket_dir,
	$cloud_sql_connection_name
);
$pdo = new PDO($dsn, $username,$password);
$stmt = $pdo->quiery("SELECT rec_name,rec_sname FROM rec_user");
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as row){
	echo "<li>{$row['rec_name']} {$row['rec_sname']}</li>"
}
?>
