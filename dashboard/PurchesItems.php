<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$branchCode = $_REQUEST['branchCode'];

$SuplierCode = $_POST['SuplierCode'];
$SuplierName = $_POST['SuplierName'];
$InvoiceNo = $_POST['InvoiceNo'];
$PurchesNo = $_POST['PurchesNo'];
$rowData = $_POST['rowData'];
$rowDataPayment = $_POST['rowDataPayment'];
$purchTotal1 = $_POST['purchTotal'];
// $paymentM = $_POST['paymentM'];
// $chequeNo = $_POST['chequeNo'];
// $chequeDate = $_POST['chequeDate'];
// $chequeAmount = $_POST['chequeAmount'];

if($chequeNo==""){
    $chequeNo = "N/A";
    $chequeDate = "N/A";
    $chequeAmount = "N/A";
}

$data = json_decode($rowData, true);
$PaymentData = json_decode($rowDataPayment, true);

// echo $SuplierCode."<br>";
// echo $SuplierName."<br>";
// echo $InvoiceNo."<br>";
// echo $PurchesNo."<br>";
// echo $rowData."<br>";

if($data!=''){

    $purchTotal = 0.00;
    
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
            $add_purch_data = "INSERT INTO `purch_data`(totalPrice,costPrice,`branchCode`, `PurchesNo`, `itemCode`, `qty`) 
            VALUES ('".$totalPrice."','".$costPrice."','".$branchCode."','".$PurchesNo."','".$itemCode."','".$qty."')";
            $run_purch_data = mysqli_query($con,$add_purch_data) or mysqli_error();

            $update_item = "UPDATE `items` SET `costPrice`='".$costPrice."',`sellingPrice`='".$sellingPrice."' WHERE `itemCode`='".$itemCode."'";
            $run_update_item = mysqli_query($con,$update_item);

            $sel_stock = "select * from stock where branchCode='".$branchCode."' and itemCode='".$itemCode."'";
            $run_stock = mysqli_query($con,$sel_stock);

            if(mysqli_num_rows($run_stock) > 0){

                $row_stock = mysqli_fetch_assoc($run_stock);
                $stock_QTY = $row_stock['qty'];
                $new_QTY = $stock_QTY + $qty;

                $update_stock = "UPDATE `stock` SET qty='".$new_QTY."' WHERE branchCode='".$branchCode."' and itemCode='".$itemCode."'";
                $run_stock_update = mysqli_query($con,$update_stock);

            } else {

                $add_stock = "INSERT INTO `stock`(`branchCode`, `itemCode`, `qty`) 
                VALUES ('".$branchCode."','".$itemCode."','".$qty."')";
                $run_stock = mysqli_query($con,$add_stock) or mysqli_error();
            }

            $purchTotal += $totalPrice;

        }
        
    }

    $add_purch_head = "INSERT INTO `purch_head`(`PurchesNo`, `purchOfficer`, `SuplierCode`, `InvoiceNo`, `purchTot`, `branchCode`) 
    VALUES ('".$PurchesNo."','".$lid."','".$SuplierCode."','".$InvoiceNo."','".$purchTotal."','".$branchCode."')";
    $run_purch_head = mysqli_query($con,$add_purch_head) or mysqli_error();

    $update_purchNo = "UPDATE `branches` SET `purchesNo`='".$PurchesNo."' WHERE branchCode='".$branchCode."'";
    $run_update = mysqli_query($con,$update_purchNo);

    // Iterate over the Payment data and insert into the database
    foreach ($PaymentData as $payments) {
        $paymentType = $payments['paymentType'];
        $amount = $payments['amount'];
        $chequeNo = $payments['chequeNo'];
        $chequeDate = $payments['chequeDate'];
        $BankName = $payments['BankName'];

        if($paymentType!=''){

            // Prepare SQL statement
            $add_payment_data = "INSERT INTO `payment_method`(BankName,`BrachCode`, `perchusNo`, `paymentMethod`, `paidAmount`, `chequeNo`, `chequeDate`, `Reserve`) 
            VALUES ('".$BankName."','".$branchCode."','".$PurchesNo."','".$paymentType."','".$amount."','".$chequeNo."','".$chequeDate."',0)";
            $run_purch_data = mysqli_query($con,$add_payment_data) or mysqli_error();

        }
        
    }

    header("Location:POAddSerial.php?lid=$lid&home=$home&PurchesNo=$PurchesNo&alert=1");

} else {
header("Location:POIndex.php?lid=$lid&home=$home&alert=2");
}
?>