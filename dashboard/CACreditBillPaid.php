<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$billNo = $_REQUEST['billNo'];
$branchCode = $_REQUEST['branchCode'];

$amount = $_POST['amount'];
echo "amount : ".$amount;

$sel_bill_data = "SELECT * from bill_head where billNo='".$billNo."'";
$run_bill_data = mysqli_query($con,$sel_bill_data);
$row_bill_data = mysqli_fetch_assoc($run_bill_data);

$custPaid = $row_bill_data['custPaid'] + $amount;
echo "custpaid : ".$custPaid;
$cusBallence = $row_bill_data['cusBallence'] + $amount;
echo "cusBallence : ".$cusBallence;

$upd_bill_head = "UPDATE `bill_head` SET `custPaid`='".$custPaid."',`cusBallence`='".$cusBallence."' WHERE BillingBranch='".$branchCode."' and billNo='".$billNo."'";
$run = mysqli_query($con,$upd_bill_head);

if($run){
    echo '<script>alert("upd");</script>';
}

header("Location:CACreditBill.php?lid=$lid&home=$home");

?>

