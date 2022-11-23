<?php
include_once 'db_utf8.php';
include 'function.php';	
$frm 				= $_POST["frm"];
$lang 			= $_POST["lang"];
$lang_val 		= $_POST["lang_val"];
$l 					= $_POST["l"];
$id 				= $_POST["id"];
$current_date 	= current_date();
$current_login = '';
if ($l != '')
	$current_login = getLogin($l , 3);
else
	$current_login = '';

if($frm=="addlang"){    
	echo AddLang();
}else if($frm=="updlang"){ 
	echo UpdateLang();
}

function AddLang(){
	global $con,$lang,$lang_val,$current_date,$current_login ;
	
	$sql  = "INSERT INTO prog_lang (lang, lang_val, ";
											$sql .= " create_date,update_date, update_by)";
											$sql .= " VALUES ('".$lang."', '".$lang_val."',";
											$sql .= " '".$current_date."', '".$current_date."','".$current_login."')";
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

function UpdateLang(){
	global $con,$id, $lang,$lang_val,$current_date,$current_login ;
	
	$sql = "UPDATE prog_lang SET 
				lang='".$lang."', lang_val='".$lang_val."',
				update_date = '".$current_date."'  , update_by = '".$current_login."' 
				WHERE lang_ID='".$id."'";
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