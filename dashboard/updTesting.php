<?php
require("db.php");

$sel_purchase = "SELECT * from purch_data";
$run_purchase = mysqli_query($con,$sel_purchase);
while($row_purchase = mysqli_fetch_assoc($run_purchase)){
    $branchCode = $row_purchase['branchCode'];
    $PurchesNo = $row_purchase['PurchesNo'];
    $itemCode = $row_purchase['itemCode'];
    $qty = $row_purchase['qty'];

    $sel_cost = "SELECT costPrice from items where itemCode='".$itemCode."'";
    $run_cost = mysqli_query($con,$sel_cost);
    $row_cost = mysqli_fetch_assoc($run_cost);
    $cost = $row_cost['costPrice'];

    $tot = $cost * $qty ;

    $upd_purchaseHead = "UPDATE `purch_data` SET `costPrice`='".$cost."',`totalPrice`='".$tot."' WHERE branchCode='".$branchCode."' and PurchesNo='".$PurchesNo."' and itemCode='".$itemCode."'";
    mysqli_query($con,$upd_purchaseHead);
}

?>