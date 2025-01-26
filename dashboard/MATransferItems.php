<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$transferBranch = $_REQUEST['transferBranch'];

$ReceiveBranchCode = $_POST['BranchCode'];
$BranchName = $_POST['BranchName'];
$TransferNo = $_POST['TransferNo'];
$rowData = $_POST['rowData'];
$purchTotal = $_POST['purchTotal'];

$data = json_decode($rowData, true);

// echo $SuplierCode."<br>";
// echo $SuplierName."<br>";
// echo $InvoiceNo."<br>";
// echo $PurchesNo."<br>";
echo $rowData."<br>";

if($data!=''){

    $add_transfer_head = "INSERT INTO `transfer_head`(`TransferNo`, `TransferOfficer`, `TransferBranchCode`, `ReceiveBranchCode`, `TransferTot`)
    VALUES ('".$TransferNo."','".$lid."','".$transferBranch."','".$ReceiveBranchCode."','".$purchTotal."')";
    $run_purch_head = mysqli_query($con,$add_transfer_head) or mysqli_error();

    $update_purchNo = "UPDATE `branches` SET `trancferNo`='".$TransferNo."' WHERE branchCode='".$transferBranch."'";
    $run_update = mysqli_query($con,$update_purchNo);
    
    // Iterate over the data and insert into the database
    foreach ($data as $item) {
        $itemCode = $item['itemCode'];
        $itemName = $item['itemName'];
        $qty = $item['qty'];
        $costPrice = $item['costPrice'];
        $totalPrice = $item['totalPrice'];
        $sellingPrice = $item['sellingPrice'];

        if($itemCode!=''){

            // Prepare SQL statement
            $add_purch_data = "INSERT INTO `transfer_data`(`TransferBranchCode`, `ReceiveBranchCode`, `TransferNo`, `itemCode`, `qty`) 
            VALUES ('".$transferBranch."','".$ReceiveBranchCode."','".$TransferNo."','".$itemCode."','".$qty."')";
            $run_purch_data = mysqli_query($con,$add_purch_data) or mysqli_error();

        }
        
    }

    header("Location:MAIndex.php?lid=$lid&home=$home&alert=1");
} else{

header("Location:MAIndex.php?lid=$lid&home=$home&alert=2");
}
?>