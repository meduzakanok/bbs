<?php
include_once 'db_utf8.php';
$action = $_POST["action"];

$ID = $_POST["ID"];
if($action=="validate-candidate"){    
	$name_th = $_POST["name_th"];
	$sname_th = $_POST["sname_th"];
	$name_en = $_POST["name_en"];
	$sname_en = $_POST["sname_en"];
	echo validate_condidate($ID, $name_th,$sname_th,$name_en,$sname_en);
}
elseif($action=="validate-user"){ 
	$rec_usr = $_POST["rec_usr"];
	echo validate_user($ID, $rec_usr);
}
elseif($action=="validate-position"){ 
	$position_val = $_POST["position_val"];
	echo validate_position($ID, $position_val);
}
elseif($action=="validate-company"){ 
	$client_company = $_POST["client_company"];
	echo validate_company($ID, $client_company);
}
elseif($action=="validate-lang"){ 
	$lang_val = $_POST["lang_val"];
	echo validate_lang($ID, $lang_val);
}
elseif($action=="validate-module"){ 
	$SAP_moduleVal = $_POST["SAP_moduleVal"];
	echo validate_module($ID, $SAP_moduleVal);
}
else{
	 echo "";
}

function validate_condidate($candidate_ID, $name_th,$sname_th,$name_en,$sname_en){
	global $con;
	//$sql = "SELECT * FROM candidate where flag_delete ='N' and idcard ='".$txtIDcard."'";
	$sql_vCandidate = "SELECT * FROM candidate where flag_delete ='N' and candidate_ID != '".$candidate_ID."' and ((name_th ='".$name_th."' and sname_th ='".$sname_th."') OR (name_en ='".$name_en."' and sname_en ='".$sname_en."') )";
	$stmt_vCandidate = $con->query($sql_vCandidate);
	$rows_vCandidate = $stmt_vCandidate->rowCount();
	if ($rows_vCandidate == 0) 
		 $res = 1;
	else
		$res = 0;
	//$res = $sql_vCandidate;
	return $res;
}
function validate_user($rec_ID, $rec_usr){
	global $con;
	$sql_vUser = "SELECT * FROM rec_user where rec_usr = '".$rec_usr."' ";
	if (($rec_ID != '') && ($rec_ID != '0'))
		$sql_vUser .= "and rec_ID != '".$rec_ID."'";
	$stmt_vUser = $con->query($sql_vUser);
	$rows_vUser = $stmt_vUser->rowCount();
	if ($rows_vUser == 0) 
		 $res = 1;
	else
		$res = 0;
	//$res = $sql_vCandidate;
	return $res;
}
function validate_position($position_ID, $position_val){
	global $con;
	$sql_vPosition = "SELECT * FROM position where position_val = '".$position_val."' ";
	if (($position_ID != '') && ($position_ID != '0'))
		$sql_vPosition .= "and position_ID != '".$position_ID."'";
	$stmt_vPosition = $con->query($sql_vPosition);
	$rows_vPosition = $stmt_vPosition->rowCount();
	if ($rows_vPosition == 0) 
		 $res = 1;
	else
		$res = 0;
	//$res = $sql_vPosition;
	return $res;
}
function validate_company($client_ID, $client_company){
	global $con;
	$sql_vCompany = "SELECT * FROM client_company where client_company = '".$client_company."' ";
	if (($client_ID != '') && ($client_ID != '0'))
		$sql_vCompany .= "and client_ID != '".$client_ID."'";
	$stmt_vCompany = $con->query($sql_vCompany);
	$rows_vCompany = $stmt_vCompany->rowCount();
	if ($rows_vCompany == 0) 
		 $res = 1;
	else
		$res = 0;
	//$res = $sql_vPosition;
	return $res;
}

function validate_lang($lang_ID, $lang_val){
	global $con;
	$sql_vLang = "SELECT * FROM prog_lang where lang_val = '".$lang_val."' ";
	if (($lang_ID != '') && ($lang_ID != '0'))
		$sql_vLang .= "and lang_ID != '".$lang_ID."'";
	$stmt_vLang = $con->query($sql_vLang);
	$rows_vLang = $stmt_vLang->rowCount();
	if ($rows_vLang == 0) 
		 $res = 1;
	else
		$res = 0;
	//$res = $sql_vPosition;
	return $res;
}

function validate_module($SAP_ID, $SAP_moduleVal){
	global $con;
	$sql_vModule = "SELECT * FROM sap_modules where SAP_moduleVal = '".$SAP_moduleVal."' ";
	if (($SAP_ID != '') && ($SAP_ID != '0'))
		$sql_vModule .= "and SAP_ID != '".$SAP_ID."'";
	$stmt_vModule = $con->query($sql_vModule);
	$rows_vModule = $stmt_vModule->rowCount();
	if ($rows_vModule == 0) 
		 $res = 1;
	else
		$res = 0;
	//$res = $sql_vPosition;
	return $res;
}
//mysqli_close($con);
?>