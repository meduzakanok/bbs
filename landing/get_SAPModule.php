<?php
include('db_utf8.php');
$sql_SAPm = "SELECT SAP_ID,SAP_module,SAP_moduleVal FROM sap_modules order by SAP_module ";
$stmt_SAPm = $con->query($sql_SAPm);

$json = array();
while ($result_SAPm = $stmt_SAPm->fetch()) {  
    array_push($json, $result_SAPm);
}
echo json_encode($json);
?>