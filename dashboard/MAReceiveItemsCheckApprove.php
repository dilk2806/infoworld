<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$TransferNo = $_REQUEST['TransferNo'];
$TransferBranchCode = $_REQUEST['TransferBranchCode'];
$itemCode = $_REQUEST['itemCode'];
$receiveBranch = $_REQUEST['receiveBranch'];
$TransferOfficer = $_REQUEST['TransferOfficer'];
$TransferTot = $_REQUEST['TransferTot'];
$qty = $_REQUEST['qty'];


$update_transferCheckItem = "UPDATE `transfer_data` SET `checked`=1 WHERE TransferBranchCode='".$TransferBranchCode."' and ReceiveBranchCode='".$receiveBranch."' and TransferNo='".$TransferNo."' and itemCode='".$itemCode."'";
mysqli_query($con,$update_transferCheckItem);

$sel_stock = "select * from stock where branchCode='".$receiveBranch."' and itemCode='".$itemCode."'";
$run_stock = mysqli_query($con,$sel_stock);

if(mysqli_num_rows($run_stock) > 0){

    $row_stock = mysqli_fetch_assoc($run_stock);
    $stock_QTY = $row_stock['qty'];
    $new_QTY = $stock_QTY + $qty;

    $update_stock = "UPDATE `stock` SET qty='".$new_QTY."' WHERE branchCode='".$receiveBranch."' and itemCode='".$itemCode."'";
    $run_stock_update = mysqli_query($con,$update_stock);

} else {

    $add_stock = "INSERT INTO `stock`(`branchCode`, `itemCode`, `qty`) 
    VALUES ('".$receiveBranch."','".$itemCode."','".$qty."')";
    $run_stock = mysqli_query($con,$add_stock) or mysqli_error();
}

$sel_transfer_stock = "SELECT `qty` FROM `stock` WHERE `branchCode`='".$TransferBranchCode."' AND `itemCode`='".$itemCode."'";
$run_stock = mysqli_query($con, $sel_transfer_stock);
$Row_transfer_stock = mysqli_fetch_assoc($run_stock);
$transfer_stock = $Row_transfer_stock['qty'];
$new_transfer_stock = $transfer_stock - $qty;

$Update_transfer_stock = "UPDATE `stock` SET `qty`='".$new_transfer_stock."' WHERE `branchCode`='".$TransferBranchCode."' AND `itemCode`='".$itemCode."'";
$run_stock = mysqli_query($con, $Update_transfer_stock);

$sel_all_checked = "select * from transfer_data where TransferBranchCode='".$TransferBranchCode."' and ReceiveBranchCode='".$receiveBranch."' and TransferNo='".$TransferNo."' and checked=0";
$run_all_checked = mysqli_query($con, $sel_all_checked);

if(mysqli_num_rows($run_all_checked) > 0){
    header("Location:MAReceiveItemsCheck.php?lid=$lid&home=$home&TransferNo=$TransferNo&TransferBranchCode=$TransferBranchCode&TransferOfficer=$TransferOfficer&TransferTot=$TransferTot");
} else {
    $update_THead = "UPDATE `transfer_head` SET checked=1 WHERE TransferNo='".$TransferNo."' AND TransferBranchCode='".$TransferBranchCode."' AND ReceiveBranchCode='".$receiveBranch."'";
    mysqli_query($con, $update_THead);

    header("Location:MAReceiveItems.php?lid=$lid&home=$home");
}
    

?>