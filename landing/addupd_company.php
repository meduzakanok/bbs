<?php
include_once 'db_utf8.php';
include 'function.php';	
$frm 				= $_POST["frm"];
$client_company 			= $_POST["client_company"];
$client_department 		= $_POST["client_department"];
$client_contact 		= $_POST["client_contact"];
$l 					= $_POST["l"];
$id 				= $_POST["id"];
$current_date 	= current_date();
$current_login = '';
if ($l != '')
	$current_login = getLogin($l , 3);
else
	$current_login = '';

if($frm=="addcompany"){    
	echo AddCompany();
}else if($frm=="updcompany"){ 
	echo UpdateCompany();
}

function AddCompany(){
	global $con,$client_company,$client_department,$client_contact,$current_date,$current_login ;
	
	$sql  = "INSERT INTO client_company (client_company, client_department,client_contact, ";
											$sql .= " create_date,update_date, update_by)";
											$sql .= " VALUES ('".$client_company."', '".$client_department."','".$client_contact."',";
											$sql .= " '".$current_date."', '".$current_date."','".$current_login."')";
	$stmt = $con->query($sql);									
	$rows_res = $stmt->rowCount();
	if ($rows_res >0)
		$res = 1;
	else
		$res = 0;
	//$res = $sql;
	return $res;
}

function UpdateCompany(){
	global $con,$id, $client_company,$client_department,$client_contact,$current_date,$current_login ;
	
	$sql = "UPDATE client_company SET 
				client_company='".$client_company."', client_department='".$client_department."',client_contact='".$client_contact."',
				update_date = '".$current_date."'  , update_by = '".$current_login."' 
				WHERE client_ID='".$id."'";
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