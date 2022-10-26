<?php
include('db_utf8.php');
//$sql = "SELECT * FROM districts WHERE amphure_id={$_GET['amphure_id']}";
$sql = "SELECT provinceID,provinceThai,districtID,districtThai ,tambonID,tambonThai,tambonThaiShort,postCodeMain FROM postalcode WHERE districtID={$_GET['amphure_id']} group by tambonID";
$query = mysqli_query($con, $sql);
 
$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);
?>