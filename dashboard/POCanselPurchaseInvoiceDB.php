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

$update_can_bill = "update purch_head set cansel=1 where branchCode='".$branchCode."' and PurchesNo='".$PurchesNo."'";
mysqli_query($con,$update_can_bill) or mysqli_error();

header("Location:POCanselPurchase.php?lid=$lid&home=$home");

?>