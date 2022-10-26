<?php
include('db_utf8.php');
//$sql = "SELECT * FROM districts WHERE amphure_id={$_GET['amphure_id']}";
$sql = "SELECT provinceID,provinceThai,districtID,districtThai ,tambonID,tambonThai,tambonThaiShort,postCodeMain FROM postalcode WHERE districtID={$_GET['amphure_id']} group by tambonID";
$stmt = $con->query($sql);
$json = array();
while ($result = $stmt->fetch()) {
    array_push($json, $result);
}
echo json_encode($json);
?>