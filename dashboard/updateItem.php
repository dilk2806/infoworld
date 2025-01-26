<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];


$ItemCode = $_POST['ItemCode'];
$ItemName = $_POST['ItemName'];
$CostPrice = $_POST['CostPrice'];
$SellingPrice = $_POST['SellingPrice'];
$ReorderLevel = $_POST['ReorderLevel'];


$add_cat = "UPDATE `items` SET `itemName`='".$ItemName."',`costPrice`='".$CostPrice."',`sellingPrice`='".$SellingPrice."',`reorderLevel`='".$ReorderLevel."' WHERE `itemCode`='".$ItemCode."'";
$run_cat = mysqli_query($con,$add_cat);

header("Location:adminUpdateItem.php?lid=$lid&home=$home&alert=4");
?>