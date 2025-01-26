<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$PurchesNo = $_REQUEST['PurchesNo'];

$select_admin = "select * from `user` where `lid`='".$lid."'";
$run_admin = mysqli_query($con,$select_admin);
$row_admin = mysqli_fetch_assoc($run_admin);

$fname = $row_admin['fname'];
$wa = $row_admin['wa'];
$ut = $row_admin['user_type'];
$branchCode = $row_admin['branchCode'];

$sel_bill_items = "select * from purch_data where branchCode='".$branchCode."' and PurchesNo='".$PurchesNo."'";
$run_bill_items = mysqli_query($con, $sel_bill_items);
while ($row = mysqli_fetch_assoc($run_bill_items)) {
    $itemCode = $row['itemCode'];
    $QTY = $row['qty'];

    $sel_stock = "select * from stock where branchCode='".$branchCode."' and itemCode='".$itemCode."'";
    $run_stock = mysqli_query($con, $sel_stock);
    $row_stock = mysqli_fetch_assoc($run_stock);
    $StockQty = $row_stock['qty'];
    $newQTY = $StockQty - $QTY;

    $update_stock = "UPDATE `stock` SET qty='".$newQTY."' WHERE branchCode='".$branchCode."' and itemCode='".$itemCode."'";
    $run_update_stock = mysqli_query($con, $update_stock);

    $del_serials = "DELETE FROM `serial_no` WHERE itemCode='".$itemCode."' and PurchesNo='".$PurchesNo."' and branchCode='".$branchCode."'";
    $run_serials = mysqli_query($con, $del_serials);
}

$update_can_bill = "update purch_head set cansel=2 where branchCode='".$branchCode."' and PurchesNo='".$PurchesNo."'";
mysqli_query($con,$update_can_bill) or mysqli_error();

header("Location:MACancelPurchase.php?lid=$lid&home=$home");

?><?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$PurchesNo = $_REQUEST['PurchesNo'];

$select_admin = "select * from `user` where `lid`='".$lid."'";
$run_admin = mysqli_query($con,$select_admin);
$row_admin = mysqli_fetch_assoc($run_admin);

$fname = $row_admin['fname'];
$wa = $row_admin['wa'];
$ut = $row_admin['user_type'];
$branchCode = $row_admin['branchCode'];

$sel_bill_items = "select * from purch_data where branchCode='".$branchCode."' and PurchesNo='".$PurchesNo."'";
$run_bill_items = mysqli_query($con, $sel_bill_items);
while ($row = mysqli_fetch_assoc($run_bill_items)) {
    $itemCode = $row['itemCode'];
    $QTY = $row['qty'];

    $sel_stock = "select * from stock where branchCode='".$branchCode."' and itemCode='".$itemCode."'";
    $run_stock = mysqli_query($con, $sel_stock);
    $row_stock = mysqli_fetch_assoc($run_stock);
    $StockQty = $row_stock['qty'];
    $newQTY = $StockQty - $QTY;

    $update_stock = "UPDATE `stock` SET qty='".$newQTY."' WHERE branchCode='".$branchCode."' and itemCode='".$itemCode."'";
    $run_update_stock = mysqli_query($con, $update_stock);

    $del_serials = "DELETE FROM `serial_no` WHERE itemCode='".$itemCode."' and PurchesNo='".$PurchesNo."' and branchCode='".$branchCode."'";
    $run_serials = mysqli_query($con, $del_serials);
}

$update_can_bill = "update purch_head set cansel=2 where branchCode='".$branchCode."' and PurchesNo='".$PurchesNo."'";
mysqli_query($con,$update_can_bill) or mysqli_error();

header("Location:MACancelPurchase.php?lid=$lid&home=$home");

?><?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$PurchesNo = $_REQUEST['PurchesNo'];

$select_admin = "select * from `user` where `lid`='".$lid."'";
$run_admin = mysqli_query($con,$select_admin);
$row_admin = mysqli_fetch_assoc($run_admin);

$fname = $row_admin['fname'];
$wa = $row_admin['wa'];
$ut = $row_admin['user_type'];
$branchCode = $row_admin['branchCode'];

$sel_bill_items = "select * from purch_data where branchCode='".$branchCode."' and PurchesNo='".$PurchesNo."'";
$run_bill_items = mysqli_query($con, $sel_bill_items);
while ($row = mysqli_fetch_assoc($run_bill_items)) {
    $itemCode = $row['itemCode'];
    $QTY = $row['qty'];

    $sel_stock = "select * from stock where branchCode='".$branchCode."' and itemCode='".$itemCode."'";
    $run_stock = mysqli_query($con, $sel_stock);
    $row_stock = mysqli_fetch_assoc($run_stock);
    $StockQty = $row_stock['qty'];
    $newQTY = $StockQty - $QTY;

    $update_stock = "UPDATE `stock` SET qty='".$newQTY."' WHERE branchCode='".$branchCode."' and itemCode='".$itemCode."'";
    $run_update_stock = mysqli_query($con, $update_stock);

    $del_serials = "DELETE FROM `serial_no` WHERE itemCode='".$itemCode."' and PurchesNo='".$PurchesNo."' and branchCode='".$branchCode."'";
    $run_serials = mysqli_query($con, $del_serials);
}

$update_can_bill = "update purch_head set cansel=2 where branchCode='".$branchCode."' and PurchesNo='".$PurchesNo."'";
mysqli_query($con,$update_can_bill) or mysqli_error();

header("Location:MACancelPurchase.php?lid=$lid&home=$home");

?><?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$PurchesNo = $_REQUEST['PurchesNo'];

$select_admin = "select * from `user` where `lid`='".$lid."'";
$run_admin = mysqli_query($con,$select_admin);
$row_admin = mysqli_fetch_assoc($run_admin);

$fname = $row_admin['fname'];
$wa = $row_admin['wa'];
$ut = $row_admin['user_type'];
$branchCode = $row_admin['branchCode'];

$sel_bill_items = "select * from purch_data where branchCode='".$branchCode."' and PurchesNo='".$PurchesNo."'";
$run_bill_items = mysqli_query($con, $sel_bill_items);
while ($row = mysqli_fetch_assoc($run_bill_items)) {
    $itemCode = $row['itemCode'];
    $QTY = $row['qty'];

    $sel_stock = "select * from stock where branchCode='".$branchCode."' and itemCode='".$itemCode."'";
    $run_stock = mysqli_query($con, $sel_stock);
    $row_stock = mysqli_fetch_assoc($run_stock);
    $StockQty = $row_stock['qty'];
    $newQTY = $StockQty - $QTY;

    $update_stock = "UPDATE `stock` SET qty='".$newQTY."' WHERE branchCode='".$branchCode."' and itemCode='".$itemCode."'";
    $run_update_stock = mysqli_query($con, $update_stock);

    $del_serials = "DELETE FROM `serial_no` WHERE itemCode='".$itemCode."' and PurchesNo='".$PurchesNo."' and branchCode='".$branchCode."'";
    $run_serials = mysqli_query($con, $del_serials);
}

$update_can_bill = "update purch_head set cansel=2 where branchCode='".$branchCode."' and PurchesNo='".$PurchesNo."'";
mysqli_query($con,$update_can_bill) or mysqli_error();

header("Location:MACancelPurchase.php?lid=$lid&home=$home");

?>