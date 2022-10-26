<?php
include_once 'db_utf8.php';

// Check connection
//if ($conn->connect_error) {
 // die("Connection failed: " . $conn->connect_error);
//}
// echo "Connected successfully";
isset( $_POST['act'] ) ? $act = $_POST['act'] : $act = "";
isset( $_POST['position_id'] ) ? $position_id = $_POST['position_id'] : $position_id = "";
//check which action response accordingly

if($_POST["action"]=="load-position"){    
	echo loadPosition($act,$position_id);
}
else if($_POST["action"]=="load-client"){
	echo loadClient($act,$position_id);
}
//else if($_POST["action"]=="load-state"){
//	echo loadState($_POST["country_id"]);
//}

//load country and return country list
function loadPosition($act,$position_id){
	global $con;
	$sql = "SELECT position_ID, position, position_val FROM position order by position";
	$stmt = $con->query($sql);
	$rows = $stmt->rowCount();
										
	//$result = $conn->query($sql);
	$options="<option value=''>--Select Position--</option>";
	if ($rows > 0) {
	  // output data of each row
	  
	while ($result = $stmt->fetch()) {
		if ($position_id == $result['position_val'])
			$options.= "<option value='".$result['position_val']."' selected>".$result['position']."</option>";
		else 
			$options.= "<option value='".$result['position_val']."'>".$result['position']."</option>";
	  }
	} 
	return $options;
}

function loadClient($act,$position_id){
	global $con;
	$sql = "SELECT * FROM client_company order by client_company ";
	$stmt = $con->query($sql);
	$rows = $stmt->rowCount();
	//$result = $conn->query($sql);
	$options="<option value=''>--Select Company--</option>";
	if ($rows > 0) {
		// output data of each row
		 while ($result = $stmt->fetch()) {
			if ($act == '1')
				$options.= "<option value='".$result['client_ID']."|".$result['client_department']."|".$result['client_contact']."|".$result['client_company']."'>".$result['client_company']."</option>";
			elseif ($act == '2'){
				if ($position_id == $result['client_ID'])
					$options.= "<option value='".$result['client_ID']."' selected>".$result['client_company']."</option>";
				else
					$options.= "<option value='".$result['client_ID']."'>".$result['client_company']."</option>";
			}
			elseif ($act == '3'){
				if ($position_id == $result['client_ID'])
					$options.= "<option value='".$result['client_ID']."|".$result['client_department']."|".$result['client_contact']."|".$result['client_company']."' selected>".$result['client_company']."</option>";
				else
					$options.= "<option value='".$result['client_ID']."|".$result['client_department']."|".$result['client_contact']."|".$result['client_company']."'>".$result['client_company']."</option>";
			}
		  }//end while
	}//end if 
	return $options;
}

//load state and return state list 
/*function loadState($country_id){
	global $con;
	$sql = "SELECT id, name FROM states where country_id='$country_id'";
	$result = $con->query($sql);
	$options='<option>select state</option>';
	if ($result->num_rows > 0) {
	  // output data of each row
	  
	  while($row = $result->fetch_object()) {
		$options.= "<option value='$row->id'>$row->name</option>";
	  }
	}  
	return $options;
}
*/
//mysqli_close($con);
?>