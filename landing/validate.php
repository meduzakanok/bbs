<?php
include_once 'db_utf8.php';
$action = $_POST["action"];
//$txtIDcard = $_POST["txtIDcard"];

$candidate_ID = $_POST["candidate_ID"];
$name_th = $_POST["name_th"];
$sname_th = $_POST["sname_th"];
$name_en = $_POST["name_en"];
$sname_en = $_POST["sname_en"];

if($action=="validate-candidate"){    
	echo validate_condidate($candidate_ID, $name_th,$sname_th,$name_en,$sname_en);
}

function validate_condidate($candidate_ID, $name_th,$sname_th,$name_en,$sname_en){
	global $con;
	//$sql = "SELECT * FROM candidate where flag_delete ='N' and idcard ='".$txtIDcard."'";
	$sql = "SELECT * FROM candidate where flag_delete ='N' and candidate_ID != '".$candidate_ID."' and ((name_th ='".$name_th."' and sname_th ='".$sname_th."') OR (name_en ='".$name_en."' and sname_en ='".$sname_en."') )";
	$query = mysqli_query($con, $sql);
	$rows = mysqli_num_rows($query);
	if ($rows == 0) 
		 $res = 1;
	else
		$res = 0;
	//$res = $sql;
	return $res;
}
mysqli_close($con);
?>