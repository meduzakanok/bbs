<?php
include_once 'db_utf8.php';

// Check connection
//if ($conn->connect_error) {
 // die("Connection failed: " . $conn->connect_error);
//}
// echo "Connected successfully";
isset( $_POST['act'] ) 		? $act = $_POST['act'] 		: $act = "";
isset( $_POST['id'] ) 			? $id = $_POST['id'] 			: $id = "";
isset( $_POST['ifield'] ) 		? $ifield = $_POST['ifield'] 	: $ifield = "";
isset( $_POST['rfield'] ) 		? $rfield = $_POST['rfield'] 	: $rfield = "";
//check which action response accordingly

if($_POST["act"]=="client_company"){    
	echo getPosition($act,$id,$rfield,$ifield);
}
else
	echo "";

//load country and return country list
function getPosition($act,$id,$rfield,$ifield){
	global $con;
	$sql_res = "SELECT ".$ifield.",".$rfield." FROM ".$act." where ".$ifield."='".$id."'";
	$stmt_res = $con->query($sql_res);
	$rows_res = $stmt_res->rowCount();
	$res = '';
	if ($rows_res ==1) {
		while ($result_res = $stmt_res->fetch()) {
			if ($id == $result_res[$ifield])
				$res = $result_res[$rfield];
			else 
				$res = "";
		  }
	} 
	//$res = $sql_res ;
	return $res;
}
?>