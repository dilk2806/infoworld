<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];

$BrandCode = $_POST['BrandCode'];
$BrandName = $_POST['BrandName'];
$CatagoryCode = $_POST['CatagoryCode'];

$sel_item = "select * from brand_names where brandCode='".$BrandCode."'";
$run_item = mysqli_query($con,$sel_item);

if(mysqli_num_rows($run_item) > 0){

    header("Location:adminIndex.php?lid=$lid&home=$home&alert=6");

} else {


    $add_cat = "INSERT INTO `brand_names`(`catCode`, `brandCode`, `brandName`) VALUES ('".$CatagoryCode."','".$BrandCode."','".$BrandName."')";
    $run_cat = mysqli_query($con,$add_cat);

    header("Location:adminIndex.php?lid=$lid&home=$home&alert=3");
}

?>