<?php
    include_once 'landing/db.php';	
	include_once 'landing/function.php';
    $current_date = current_date();
    extract($_POST);
	$sql = "INSERT INTO login_session(login_user ,login_name, login_sname , login_date ) VALUES('" . $txtUser . "','" . $fname . "', '" . $lname . "', '" . $current_date . "')";
    if(mysqli_query($con, $sql)) 
	{
		//echo '1';
		echo json_encode(array('success' => 1));
		exit;
    } 
	else 
	{
		//echo "Error: " . mysqli_error($con);
		echo json_encode(array('success' => 0));
		exit;
    }
    mysqli_close($con);
?>