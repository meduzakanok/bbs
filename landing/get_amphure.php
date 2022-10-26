<?php
include('db_utf8.php');
//$sql = "SELECT * FROM amphures WHERE province_id={$_GET['province_id']}";
$sql = "SELECT provinceID,districtID,districtThai,districtThaiShort FROM postalcode WHERE provinceID={$_GET['province_id']} group by districtID ";
$query = mysqli_query($con, $sql);

$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);
?>