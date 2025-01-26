<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$cusID = $_REQUEST['cusID'];
$cusName = $_REQUEST['cusName'];
$cusAd = $_REQUEST['cusAd'];
$cusMobile = $_REQUEST['cusMobile'];
$billNo = $_REQUEST['billNo'];

$select_admin = "select * from `user` where `lid`='".$lid."'";
$run_admin = mysqli_query($con,$select_admin);
$row_admin = mysqli_fetch_assoc($run_admin);

$fname = $row_admin['fname'];
$wa = $row_admin['wa'];
$ut = $row_admin['user_type'];
$branchCode = $row_admin['branchCode'];

if ($cusID == "") {
    if ($cusMobile!=""){
        $ins_cust = "INSERT INTO `customer`( `name`, `mobile`, `address`) 
        VALUES ('".$cusName."','".$cusMobile."','".$cusAd."')";
        $run_cust = mysqli_query($con,$ins_cust);

        echo '<script>alert("cust added.");</script>';

        $sel_cust_id = "SELECT * from customer where mobile='".$cusMobile."'";
        $run_cust_id = mysqli_query($con,$sel_cust_id);
        $row_cust_id = mysqli_fetch_assoc($run_cust_id);
        $cusID = $row_cust_id['id'];
    } else {
        $cusID = 0;
    }
    
} else {
    $upd_customer = "UPDATE customer set name='".$cusName."', mobile='".$cusMobile."', address='".$cusAd."' WHERE id='".$cusID."'";
    mysqli_query($con,$upd_customer);
}

$upd_bill_head = "UPDATE `bill_head` SET `customerID`='".$cusID."' WHERE BillingBranch='".$branchCode."' and billNo='".$billNo."'";
$run_bill_head = mysqli_query($con,$upd_bill_head);

if($run_bill_head) {
    echo '<script>alert("cust id upded.");</script>';
}

header("Location:CAIndex.php?lid=$lid&home=$home&alert=1");

?>