<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];

$SuplierCode = $_POST['SuplierCode'];
$SuplierName = $_POST['SuplierName'];
$SuplierAd = $_POST['SuplierAd'];
$SuplierPhone = $_POST['SuplierPhone'];


$add_cat = "INSERT INTO `suplier`(`SuplierCode`, `SuplierName`, `SuplierAd`, `SuplierPhone`) 
VALUES ('".$SuplierCode."','".$SuplierName."','".$SuplierAd."','".$SuplierPhone."')";
$run_cat = mysqli_query($con,$add_cat);

header("Location:adminSupplierReg.php?lid=$lid&home=$home");
?>