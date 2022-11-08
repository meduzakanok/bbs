<?php
include_once 'db_utf8.php';
$frm = $_POST["frm"];
$f = $_POST["f"];
$id = $_POST["id"];

if($frm=="candidate"){    
	echo DelCandidate($f,$id);
}else if($frm=="user"){ 
	echo DelRec("rec_user",$f,$id);
}else if($frm=="position"){ 
	echo DelRec("position",$f,$id);
}else if($frm=="company"){ 
	echo DelRec("client_company",$f,$id);
}else if($frm=="language"){ 
	echo DelRec("prog_lang",$f,$id);
}else if($frm=="module"){ 
	echo DelRec("sap_modules",$f,$id);
}

function DelRec($t,$f, $id){
	global $con;
	$sql = "DELETE from ".$t." WHERE ".$f."='".$id."'";
	$stmt_usr = $con->query($sql);
	$rows_res = $stmt_usr->rowCount();
	if ($rows_res >0)
		$res = 1;
	else
		$res = 0;
	return $res;
}

function DelCandidate($f,$id){
	global $con;
	$sql = "UPDATE candidate SET flag_delete='Y' WHERE ".$f."='".$id."'";
	$stmt_usr = $con->query($sql);
	$rows_res = $stmt_usr->rowCount();
	if ($rows_res >0)
		$res = 1;
	else
		$res = 0;
	return $res;
}
?>