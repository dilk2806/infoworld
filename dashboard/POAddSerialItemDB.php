<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$branchCode = $_REQUEST['branchCode'];
$PurchesNo = $_REQUEST['PurchesNo'];
$itemCode = $_REQUEST['itemCode'];

$Warranty = $_POST['Warranty'];

$sel_itemCount = "select * from purch_data where PurchesNo='".$PurchesNo."' and branchCode='".$branchCode."' and itemCode='".$itemCode."'";
$run_itemCount = mysqli_query($con,$sel_itemCount);
$row_itemCount = mysqli_fetch_assoc($run_itemCount);
$itemCount = $row_itemCount['qty'];


$inputCount = 0;
while ($inputCount < $itemCount) {
    $Serial = $_POST['Serial'.$inputCount];
    echo $Serial."<br>";
    echo $Warranty."<br>";

    $insert_serials = "INSERT INTO `serial_no`(`branchCode`, `PurchesNo`, `itemCode`, `serialNo`, `Warranty`) 
    VALUES ('".$branchCode."','".$PurchesNo."','".$itemCode."','".$Serial."','".$Warranty."')";
    mysqli_query($con,$insert_serials);

    $update_serialST = "UPDATE `purch_data` SET `serialAdded`=1 WHERE branchCode='".$branchCode."' AND PurchesNo='".$PurchesNo."' AND itemCode='".$itemCode."'";
    mysqli_query($con,$update_serialST);

    $inputCount++ ;
}

header("Location:POAddSerial.php?lid=$lid&home=$home&PurchesNo=$PurchesNo&alert=3");
                                        
?>