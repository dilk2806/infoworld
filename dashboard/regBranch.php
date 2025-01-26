<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];

$BranchCode = $_POST['BranchCode'];
$BranchName = $_POST['BranchName'];
$BranchAddress = $_POST['BranchAddress'];
$BranchTel = $_POST['BranchTel'];


$add_cat = "INSERT INTO `branches`(BranchTel,BranchAddress,`branchCode`, `branchName`) VALUES ('".$BranchTel."','".$BranchAddress."','".$BranchCode."','".$BranchName."')";
$run_cat = mysqli_query($con,$add_cat);

header("Location:adminBranchReg.php?lid=$lid&home=$home");
?>