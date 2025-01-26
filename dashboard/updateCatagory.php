<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];

$CatagoryCodeU = $_POST['CatagoryCodeU'];
$CatagoryNameU = $_POST['CatagoryNameU'];

$add_cat = "UPDATE `categories` SET `catName`='".$CatagoryNameU."' WHERE catCode='".$CatagoryCodeU."'";
$run_cat = mysqli_query($con,$add_cat);

header("Location:adminUpdateItem.php?lid=$lid&home=$home&alert=5");
?>