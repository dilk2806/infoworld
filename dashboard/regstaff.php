<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];

$BranchCode = $_POST['CatagoryCode'];
$BranchName = $_POST['CatagoryName'];
$Position = $_POST['Position'];
$Name = $_POST['Name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pw = $_POST['pw'];
$st = 1;


$add_cat = "INSERT INTO `user`(`user_type`, `statues`, `fname`, `lid`, `pw`, `wa`, `branchCode`) 
VALUES ('".$Position."','".$st."','".$Name."','".$email."','".$pw."','".$phone."','".$BranchCode."')";
$run_cat = mysqli_query($con,$add_cat);

header("Location:adminBranchReg.php?lid=$lid&home=$home");
?>