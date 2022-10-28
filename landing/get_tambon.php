<?php
include('db_utf8.php');
//$sql = "SELECT * FROM districts WHERE amphure_id={$_GET['amphure_id']}";
$sql_tambon = "SELECT provinceID,provinceThai,districtID,districtThai ,tambonID,tambonThai,tambonThaiShort,postCodeMain FROM v_sdistrict WHERE districtID={$_GET['amphure_id']} ";
$stmt_tambon = $con->query($sql_tambon);
$json = array();
while ($result_tambon = $stmt_tambon->fetch()) {
    array_push($json, $result_tambon);
}
echo json_encode($json);
?>