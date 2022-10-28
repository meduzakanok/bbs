<?php
include_once 'db_utf8.php';
$frm = $_POST["frm"];
$id = $_POST["id"];

if($frm=="candidate"){    
	echo Delcandidate($id);
}

function Delcandidate($id){
	global $con;
	$sql_updFlag = "UPDATE candidate SET flag_delete='Y' WHERE candidate_ID ='".$id."'";
	$stmt_updFlag = $con->query($sql_updFlag);
	if($stmt_updFlag) 
		$res = 1;
	else
		$res = 0;
	return $res;
}
//mysqli_close($con);
?>