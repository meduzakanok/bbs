<?php
include_once 'db_utf8.php';
include 'function.php';	
$frm 				= $_POST["frm"];
$position 			= $_POST["position"];
$position_val 		= $_POST["position_val"];
$l 					= $_POST["l"];
$id 				= $_POST["id"];
$current_date 	= current_date();
$current_login = '';
if ($l != '')
	$current_login = getLogin($l , 3);
else
	$current_login = '';

if($frm=="addposition"){    
	echo AddPosition();
}else if($frm=="updposition"){ 
	echo UpdatePosition();
}

function AddPosition(){
	global $con,$position,$position_val,$current_date,$current_login ;
	
	$sql  = "INSERT INTO position (position, position_val, ";
											$sql .= " create_date,update_date, update_by)";
											$sql .= " VALUES ('".$position."', '".$position_val."',";
											$sql .= " '".$current_date."', '".$current_date."','".$current_login
	insLog($current_login, $sql);										
	$stmt = $con->query($sql);									
	$rows_res = $stmt->rowCount();
	if ($rows_res >0)
		$res = 1;
	else
		$res = 0;
	//$res = $sql;
	return $res;
}

function UpdatePosition(){
	global $con,$id, $position,$position_val,$current_date,$current_login ;
	
	$sql = "UPDATE position SET 
				position='".$position."', position_val='".$position_val."',
				update_date = '".$current_date."'  , update_by = '".$current_login."' 
				WHERE position_ID='".$id."'";
	insLog($current_login, $sql);
	$stmt_job = $con->query($sql);
	$rows_res = $stmt_job->rowCount();
	if ($rows_res >0)
		$res = 1;
	else
		$res = 0;
	//$res = $sql;
	return $res;
}
?>