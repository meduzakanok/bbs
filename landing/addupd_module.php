<?php
include_once 'db_utf8.php';
include 'function.php';	
$frm 				= $_POST["frm"];
$SAP_module 			= $_POST["SAP_module"];
$SAP_moduleVal 		= $_POST["SAP_moduleVal"];
$l 					= $_POST["l"];
$id 				= $_POST["id"];
$current_date 	= current_date();
$current_login = '';
if ($l != '')
	$current_login = getLogin($l , 3);
else
	$current_login = '';

if($frm=="addmodule"){    
	echo AddModule();
}else if($frm=="updmodule"){ 
	echo UpdateModule();
}

function AddModule(){
	global $con,$SAP_module,$SAP_moduleVal,$current_date,$current_login ;
	
	$sql  = "INSERT INTO sap_modules (SAP_module, SAP_moduleVal, ";
											$sql .= " create_date,update_date, update_by)";
											$sql .= " VALUES ('".$SAP_module."', '".$SAP_moduleVal."',";
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

function UpdateModule(){
	global $con,$id, $SAP_module,$SAP_moduleVal,$current_date,$current_login ;
	
	$sql = "UPDATE sap_modules SET 
				SAP_module='".$SAP_module."', SAP_moduleVal='".$SAP_moduleVal."',
				update_date = '".$current_date."'  , update_by = '".$current_login."' 
				WHERE SAP_ID='".$id."'";
	$stmt_module = $con->query($sql);
	$rows_res = $stmt_module->rowCount();
	if ($rows_res >0)
		$res = 1;
	else
		$res = 0;
	//$res = $sql;
	return $res;
}
?>