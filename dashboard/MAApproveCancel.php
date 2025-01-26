<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$billNo = $_REQUEST['billNo'];
$branchCode = $_REQUEST['branchCode'];

$sel_bill_items = "select * from bill_data where BillingBranch='".$branchCode."' and billNo='".$billNo."'";
$run_bill_items = mysqli_query($con, $sel_bill_items);
while ($row = mysqli_fetch_assoc($run_bill_items)) {
    $itemCode = $row['ItemCode'];
    $QTY = $row['QTY'];
    $serialNo = $row['serialNo'];

    $sel_stock = "select * from stock where branchCode='".$branchCode."' and itemCode='".$itemCode."'";
    $run_stock = mysqli_query($con, $sel_stock);
    $row_stock = mysqli_fetch_assoc($run_stock);
    $StockQty = $row_stock['qty'];
    $newQTY = $StockQty + $QTY;

    $update_stock = "UPDATE `stock` SET qty='".$newQTY."' WHERE branchCode='".$branchCode."' and itemCode='".$itemCode."'";
    $run_update_stock = mysqli_query($con, $update_stock);

    $upd_serial = "UPDATE serial_no SET sold=0, billNo=0 where itemCode='".$itemCode."' and serialNo='".$serialNo."' and branchCode='".$branchCode."' ";
    mysqli_query($con, $upd_serial);
}

$update_bill_st = "UPDATE `bill_head` SET cansel=2 WHERE BillingBranch='".$branchCode."' and billNo='".$billNo."'";
mysqli_query($con, $update_bill_st);

header("Location:MACancelBill.php?lid=$lid&home=$home&alert=1");

?>