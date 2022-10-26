<?php
include_once 'landing/db_utf8.php';	
include_once 'landing/function.php';

echo "TEST connect DB <br/>";

$stmt = $con->query("SELECT rec_name,rec_sname FROM rec_user");
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $row){
	echo "<li>".$row['rec_name']." ".$row['rec_sname']."</li>";
}
echo "<br>";
$stmt = $con->query("SELECT * FROM sap_modules order by SAP_module");
while ($row = $stmt->fetch()) {
    echo $row['SAP_module'].'('.$row['SAP_moduleVal'].")<br />\n";  	
}
$stmt->rowCount();
?>
