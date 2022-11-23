<?php
include_once 'db_utf8.php';
include 'function.php';	
$frm 				= $_POST["frm"];
$ddTitle 			= $_POST["ddTitle"];
$txtName 		= $_POST["txtName"];
$txtSurname 		= $_POST["txtSurname"];
$txtNickname 	= $_POST["txtNickname"];
$txtTelephone 	= $_POST["txtTelephone"];
$txtLineID 		= $_POST["txtLineID"];
$txtEmail 			= $_POST["txtEmail"];
$txtPassword 	= $_POST["txtPassword"];
$radRole 			= $_POST["radRole"];
$radStatus 		= $_POST["radStatus"];
$l 					= $_POST["l"];
$id 				= $_POST["id"];
$current_date 	= current_date();
$current_login = '';
if ($l != '')
	$current_login = getLogin($l , 3);
else
	$current_login = '';

if($frm=="adduser"){    
	echo AddUser();
}else if($frm=="upduser"){ 
	echo UpdateUser();
}

function AddUser(){
	global $con,$ddTitle,$txtName,$txtSurname,$txtNickname,$txtTelephone,$txtLineID,$txtEmail,$txtPassword,$radRole,$radStatus,$current_date,$current_login ;
	
	$sql  = "INSERT INTO rec_user (rec_usr, rec_pass, rec_title, rec_name,rec_sname,rec_nickname,rec_tel,rec_lineID,rec_role,rec_status, ";
											$sql .= " create_date,update_date, update_by)";
											$sql .= " VALUES ('".$txtEmail."', '".$txtPassword."', '".$ddTitle."',  '".$txtName."',  '".$txtSurname."',  '".$txtNickname."',  '".$txtTelephone."',  '".$txtLineID."',  '".$radRole."',  '".$radStatus."', ";
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

function UpdateUser(){
	global $con,$id, $ddTitle,$txtName,$txtSurname,$txtNickname,$txtTelephone,$txtLineID,$txtEmail,$txtPassword,$radRole,$radStatus,$current_date,$current_login ;
	
	$sql = "UPDATE rec_user SET 
				rec_usr='".$txtEmail."', rec_pass='".$txtPassword."',
				rec_title='".$ddTitle."', rec_name='".$txtName."', rec_sname='".$txtSurname."', rec_nickname='".$txtNickname."',
				rec_tel='".$txtTelephone."', rec_lineID='".$txtLineID."', rec_role='".$radRole."', rec_status='".$radStatus."',
				update_date = '".$current_date."'  , update_by = '".$current_login."' 
				WHERE rec_ID='".$id."'";
	insLog($current_login, $sql);
	$stmt_usr = $con->query($sql);
	$rows_res = $stmt_usr->rowCount();
	if ($rows_res >0)
		$res = 1;
	else
		$res = 0;
	//$res = $sql;
	return $res;
}
?>