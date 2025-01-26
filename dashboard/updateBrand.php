<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];

$BrandCode = $_POST['BrandCode'];
$BrandName = $_POST['BrandName'];
$CatagoryCode = $_POST['CatagoryCode'];


$add_cat = "UPDATE `brand_names` SET `brandName`='".$BrandName."' WHERE brandCode='".$BrandCode."'";
$run_cat = mysqli_query($con,$add_cat);

header("Location:adminUpdateItem.php?lid=$lid&home=$home&alert=3");
?>