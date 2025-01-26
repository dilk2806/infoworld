<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];

$CatagoryCode = $_POST['CatagoryCode'];
$CatagoryName = $_POST['CatagoryName'];
$BrandCode = $_POST['BrandCode'];
$BrandName = $_POST['BrandName'];
$ItemCode = $_POST['ItemCode'];
$ItemName = $_POST['ItemName'];
$CostPrice = $_POST['CostPrice'];
$SellingPrice = $_POST['SellingPrice'];
$ReorderLevel = $_POST['ReorderLevel'];

$sel_item = "select * from items where itemCode='".$ItemCode."'";
$run_item = mysqli_query($con,$sel_item);

if(mysqli_num_rows($run_item) > 0){
    $row = mysqli_fetch_assoc($run_item);
    $itemC = $row['itemCode'];
    header("Location:adminIndex.php?lid=$lid&home=$home&alert=4&itemC=$itemC");

} else {
    $add_cat = "INSERT INTO `items`(`catCode`, `brandCode`, `itemCode`, `itemName`, `costPrice`, `sellingPrice`, `reorderLevel`) 
    VALUES ('".$CatagoryCode."','".$BrandCode."','".$ItemCode."','".$ItemName."','".$CostPrice."','".$SellingPrice."','".$ReorderLevel."')";
    $run_cat = mysqli_query($con,$add_cat);

    $upd_icode = "UPDATE `icode` SET `icode`='".$ItemCode."'";
    mysqli_query($con,$upd_icode);
    
    header("Location:adminIndex.php?lid=$lid&home=$home&alert=1");
}

?>