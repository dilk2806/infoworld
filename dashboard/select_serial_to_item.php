<?php
require('db.php');

$ItemCode = $_POST['ItemCode'];
$branchCode = $_POST['BranchCode'];
//  and branchCode='".$branchCode."'

$query = "SELECT serialNo FROM serial_no WHERE itemCode = '".$ItemCode."'  and sold=0";
$result = mysqli_query($con, $query);

$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $prale = $row["serialNo"];
    $options .= "<option value='".$prale."'>'".$prale."'</option>";
}

echo $options;
?>
