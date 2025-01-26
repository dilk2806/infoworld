<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];

$select_admin = "select * from `user` where `lid`='".$lid."'";
$run_admin = mysqli_query($con,$select_admin);
$row_admin = mysqli_fetch_assoc($run_admin);

$fname = $row_admin['fname'];
$wa = $row_admin['wa'];
$ut = $row_admin['user_type'];
$branchCode = $row_admin['branchCode'];

$SuplierCode = $_POST['SuplierCodeItem'];
$SuplierName = $_POST['SuplierNameItem'];
$rowData = $_POST['rowData'];

$data = json_decode($rowData, true);

if($data!=''){
    
    // Iterate over the data and insert into the database
    foreach ($data as $item) {
        $itemCode = $item['itemCode'];
        $itemName = $item['itemName'];

        if($itemCode!=''){

            // Prepare SQL statement
            $add_purch_data = "INSERT INTO supplier_item(supplier_code,item_code) 
            VALUES ('".$SuplierCode."','".$itemCode."')";
            $run_purch_data = mysqli_query($con,$add_purch_data) or mysqli_error();

        }
            
    } 

    header("Location:adminSupplierReg.php?lid=$lid&home=$home&alert=4");
    
} else {

header("Location:adminSupplierReg.php?lid=$lid&home=$home&alert=5");
}
?>