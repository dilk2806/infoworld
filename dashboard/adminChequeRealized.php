<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$chequeId = $_REQUEST['chequeId'];



$add_cat = "UPDATE `payment_method` SET `Reserve`=1 WHERE id='".$chequeId."'";
$run_cat = mysqli_query($con,$add_cat);

header("Location:adminChequeReg.php?lid=$lid&home=$home&alert=1");
?>