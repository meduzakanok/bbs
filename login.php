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
	$sql = "SELECT * FROM rec_user where rec_usr='".$txtUser."' and rec_pass='".$txtPass."'";
	$stmt = $con->query($sql);
	$rows = $stmt->rowCount();
	if ($rows>0){
		while ($result = $stmt->fetch()) {
			$rec_usr 		= $result['rec_usr'];
			$rec_name 	= $result['rec_name'];
			$rec_sname	= $result['rec_sname'];
		}
		 $chk_res = encrypt($rec_usr);
	}
	else
		$chk_res ='';
	if ($chk_res <> ''){
		
		$sql = "Delete FROM login_session WHERE login_user='".$rec_usr."' and login_date < now() - interval 1 week";
		$stmt = $con->query($sql);
		
		$sql = "SELECT * FROM login_session WHERE login_user='".$rec_usr."' and login_flag='Y' and DATE(login_date) = CURDATE()";
		$stmt = $con->query($sql);
		$rows = $stmt->rowCount();
		if ($rows>0){
			$sql = "UPDATE login_session SET
				  login_flag='N'
				  WHERE login_user  = '".$rec_usr."' and login_flag='Y' ";
			$stmt = $con->query($sql);
		}
		
		$sql = "INSERT INTO login_session(login_user ,login_name, login_sname , login_date , browser_agent, browser_ip) ";
		$sql .= "VALUES('" . $rec_usr . "','" . $rec_name . "', '" . $rec_sname . "', '" . $current_date . "','".$_SERVER['HTTP_USER_AGENT']."','".get_client_ip()."')";
		$stmt = $con->query($sql);
		
	}//end chk_res
	echo json_encode(array('success' => $chk_res));
	//mysqli_close($con);
?>