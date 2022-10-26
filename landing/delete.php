<?php
include_once 'db_utf8.php';
$frm = $_POST["frm"];
$id = $_POST["id"];

if($frm=="candidate"){    
	echo Delcandidate($id);
}

function Delcandidate($id){
	global $con;
	$sql = "UPDATE candidate SET flag_delete='Y' WHERE candidate_ID ='".$id."'";
	$query = mysqli_query($con, $sql);
	if($query) 
		$res = 1;
	else
		$res = 0;
	return $res;
}
mysqli_close($con);
?>