<!-- $sel_itemCount = "select * from stock where branchCode='".$branchCode."' and itemCode='".$itemCode."'";
$run_itemCount = mysqli_query($con,$sel_itemCount);
$row_itemCount = mysqli_fetch_assoc($run_itemCount);
$itemCount = $row_itemCount['qty'];

$update_serialST = "UPDATE `purch_data` SET `serialAdded`=1 WHERE branchCode='".$branchCode."' AND PurchesNo='".$PurchesNo."' AND itemCode='".$itemCode."'";
mysqli_query($con,$update_serialST);

header("Location:POAddSerial.php?lid=$lid&home=$home&PurchesNo=$PurchesNo&alert=1"); -->

<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$branchCode = $_REQUEST['branchCode'];
$PurchesNo = $_REQUEST['PurchesNo'];
$itemCode = $_REQUEST['itemCode'];


$update_serialST = "UPDATE `purch_data` SET `serialAdded`=1 WHERE branchCode='".$branchCode."' AND PurchesNo='".$PurchesNo."' AND itemCode='".$itemCode."'";
mysqli_query($con,$update_serialST);

header("Location:POAddSerial.php?lid=$lid&home=$home&PurchesNo=$PurchesNo&alert=2");

?><!-- $sel_itemCount = "select * from stock where branchCode='".$branchCode."' and itemCode='".$itemCode."'";
$run_itemCount = mysqli_query($con,$sel_itemCount);
$row_itemCount = mysqli_fetch_assoc($run_itemCount);
$itemCount = $row_itemCount['qty'];

$update_serialST = "UPDATE `purch_data` SET `serialAdded`=1 WHERE branchCode='".$branchCode."' AND PurchesNo='".$PurchesNo."' AND itemCode='".$itemCode."'";
mysqli_query($con,$update_serialST);

header("Location:POAddSerial.php?lid=$lid&home=$home&PurchesNo=$PurchesNo&alert=1"); -->

<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$branchCode = $_REQUEST['branchCode'];
$PurchesNo = $_REQUEST['PurchesNo'];
$itemCode = $_REQUEST['itemCode'];


$update_serialST = "UPDATE `purch_data` SET `serialAdded`=1 WHERE branchCode='".$branchCode."' AND PurchesNo='".$PurchesNo."' AND itemCode='".$itemCode."'";
mysqli_query($con,$update_serialST);

header("Location:POAddSerial.php?lid=$lid&home=$home&PurchesNo=$PurchesNo&alert=2");

?><!-- $sel_itemCount = "select * from stock where branchCode='".$branchCode."' and itemCode='".$itemCode."'";
$run_itemCount = mysqli_query($con,$sel_itemCount);
$row_itemCount = mysqli_fetch_assoc($run_itemCount);
$itemCount = $row_itemCount['qty'];

$update_serialST = "UPDATE `purch_data` SET `serialAdded`=1 WHERE branchCode='".$branchCode."' AND PurchesNo='".$PurchesNo."' AND itemCode='".$itemCode."'";
mysqli_query($con,$update_serialST);

header("Location:POAddSerial.php?lid=$lid&home=$home&PurchesNo=$PurchesNo&alert=1"); -->

<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$branchCode = $_REQUEST['branchCode'];
$PurchesNo = $_REQUEST['PurchesNo'];
$itemCode = $_REQUEST['itemCode'];


$update_serialST = "UPDATE `purch_data` SET `serialAdded`=1 WHERE branchCode='".$branchCode."' AND PurchesNo='".$PurchesNo."' AND itemCode='".$itemCode."'";
mysqli_query($con,$update_serialST);

header("Location:POAddSerial.php?lid=$lid&home=$home&PurchesNo=$PurchesNo&alert=2");

?><!-- $sel_itemCount = "select * from stock where branchCode='".$branchCode."' and itemCode='".$itemCode."'";
$run_itemCount = mysqli_query($con,$sel_itemCount);
$row_itemCount = mysqli_fetch_assoc($run_itemCount);
$itemCount = $row_itemCount['qty'];

$update_serialST = "UPDATE `purch_data` SET `serialAdded`=1 WHERE branchCode='".$branchCode."' AND PurchesNo='".$PurchesNo."' AND itemCode='".$itemCode."'";
mysqli_query($con,$update_serialST);

header("Location:POAddSerial.php?lid=$lid&home=$home&PurchesNo=$PurchesNo&alert=1"); -->

<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$branchCode = $_REQUEST['branchCode'];
$PurchesNo = $_REQUEST['PurchesNo'];
$itemCode = $_REQUEST['itemCode'];


$update_serialST = "UPDATE `purch_data` SET `serialAdded`=1 WHERE branchCode='".$branchCode."' AND PurchesNo='".$PurchesNo."' AND itemCode='".$itemCode."'";
mysqli_query($con,$update_serialST);

header("Location:POAddSerial.php?lid=$lid&home=$home&PurchesNo=$PurchesNo&alert=2");

?>