<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];

$CatagoryCode = $_POST['CatagoryCode'];
$CatagoryName = $_POST['CatagoryName'];

$sel_item = "select * from categories where catCode='".$CatagoryCode."'";
$run_item = mysqli_query($con,$sel_item);

if(mysqli_num_rows($run_item) > 0){

    header("Location:adminIndex.php?lid=$lid&home=$home&alert=5");

} else {

    $add_cat = "insert into categories(catCode,catName) values('".$CatagoryCode."','".$CatagoryName."')";
    $run_cat = mysqli_query($con,$add_cat);
    
    header("Location:adminIndex.php?lid=$lid&home=$home&alert=2");
}

?>