<?php
include('db_utf8.php');
$sql = "SELECT SAP_ID,SAP_module,SAP_moduleVal FROM sap_modules order by SAP_ID ";
$query = mysqli_query($con, $sql);

$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);
?>