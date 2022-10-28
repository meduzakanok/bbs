<?php
include('db_utf8.php');
//$sql = "SELECT * FROM amphures WHERE province_id={$_GET['province_id']}";
$sql_amphure = "SELECT provinceID,districtID,districtThai,districtThaiShort FROM postalcode WHERE provinceID={$_GET['province_id']} group by districtID ";
$stmt_amphure = $con->query($sql_amphure);

$json = array();
while ($result_amphure = $stmt_amphure->fetch()) {    
    array_push($json, $result_amphure);
}
echo json_encode($json);
?>