<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$branchCode = $_REQUEST['branchCode'];

$BillNo = $_POST['BillNo'];

$update_can_bill = "update bill_head set cansel=1 where BillingBranch='".$branchCode."' and billNo='".$BillNo."'";
mysqli_query($con,$update_can_bill) or mysqli_error();

header("Location:CACancelBill.php?lid=$lid&home=$home");

?>