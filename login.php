<?php
     include_once 'landing/db_utf8.php';	
	include_once 'landing/function.php';
     $current_date = current_date();
     extract($_POST);
	$rows=0;
	$chk_res = '';
	$rec_usr = '';
	$rec_name = '';
	$rec_sname = '';
	$sql_usrPass = "SELECT * FROM rec_user where rec_usr='".$txtUser."' and rec_pass='".$txtPass."'";
	$stmt_usrPass = $con->query($sql_usrPass);
	$rows_usrPass = $stmt_usrPass->rowCount();
	if ($rows_usrPass>0){
		while ($result_usrPass= $stmt_usrPass->fetch()) {
			$rec_usr 		= $result_usrPass['rec_usr'];
			$rec_name 	= $result_usrPass['rec_name'];
			$rec_sname	= $result_usrPass['rec_sname'];
		}
		 $chk_res = encrypt($rec_usr);
	}
	else
		$chk_res ='';
	if ($chk_res <> ''){
		
		$sql_usrDel = "Delete FROM record_login WHERE login_user='".$rec_usr."' and login_date < now() - interval 1 week";
		$stmt_usrDel = $con->query($sql_usrDel);
		
		$sql_usrSess = "SELECT * FROM record_login WHERE login_user='".$rec_usr."' and login_flag='Y' and DATE(login_date) = CURDATE()";
		$stmt_usrSess = $con->query($sql_usrSess);
		$rows_usrSess = $stmt_usrSess->rowCount();
		if ($rows_usrSess>0){
			$sql_usrUpd = "UPDATE record_login SET
				  login_flag='N'
				  WHERE login_user  = '".$rec_usr."' and login_flag='Y' ";
			$stmt_usrUpd = $con->query($sql_usrUpd);
		}
		
		$sql_usrIns  = "INSERT INTO record_login(login_user ,login_name, login_sname , login_date , browser_agent, browser_ip) ";
		$sql_usrIns .= "VALUES('" . $rec_usr . "','" . $rec_name . "', '" . $rec_sname . "', '" . $current_date . "','".$_SERVER['HTTP_USER_AGENT']."','".get_client_ip()."')";
		$stmt_usrIns = $con->query($sql_usrIns);
		
	}//end chk_res
	echo json_encode(array('success' => $chk_res));
	//mysqli_close($con);
?>