<?php
include('db_utf8.php');
$sql = "SELECT SAP_ID,SAP_module,SAP_moduleVal FROM sap_modules order by SAP_ID ";
$stmt = $con->query($sql);

$json = array();
while ($result = $stmt->fetch()) {  
    array_push($json, $result);
}
echo json_encode($json);
?>